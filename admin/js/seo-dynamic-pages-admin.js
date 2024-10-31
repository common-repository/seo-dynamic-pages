/*(function( $ ) {
	'use strict';
  console.log('ready');
  Vue.config.debug = true;
  var bus = new Vue();
  Vue.component('color-picker', {
    template: '<input/>',
    props: ['field'],
    mounted: function() {
      let self = this;
      var spectrum = $(this.$el).spectrum({
       change: function(color) {
        bus.$emit('update-color', color.toHexString(), self.field);   
      }
    });
      bus.$on('update-color-spectrum-'+ self.field, function (color) {
       spectrum.spectrum("set", color);
       jQuery('#'+self.field).val(color);
     });
      spectrum.spectrum("set", jQuery('#'+self.field).val());
    },
    beforeDestroy: function() {
    }
  });
  Vue.component('widget', {
    created: function() { 
     let self = this;
     bus.$on('update-color', function (color, field) {
       self.settings[field] = color;
     });
     
   //jQuery('#custom-css').html(this.settings.custom_css);   
 },
 data () { 
  return {
    settings: JSON.parse(jQuery('#sdp-data').html()),
    general_settings: JSON.parse(jQuery('#sdp-general').html())
  };
},
computed:{

},
mounted: function() {
  let self = this;
  //sconsole.log(this.general_settings.locations);
  this.settings.locations = this.general_settings.locations.split('|');
  this.update_data();
  this.update_url_previews();

  $( "#paragraphs table tbody" ).sortable({
   start: function(event, ui) {
    ui.item.startPos = ui.item.index();
  },
  stop: function(event, ui) {
    //swap elements
    var _tmp = self.settings.paragraphs[ui.item.startPos];
    self.settings.paragraphs[ui.item.startPos] = self.settings.paragraphs[ui.item.index()];
    self.settings.paragraphs[ui.item.index()] = _tmp;
    self.update_data();
  }
});
  $( "#paragraphs table tbody" ).disableSelection();
},

watch: {
  'settings.service_name': function(){
    this.update_url_previews();
  },
  'settings':{
   handler: function(val){
    this.update_data();
  },
  deep: true
}

},

methods: {
  update_url_previews: function( ){
    let self = this;
    let locations = self.settings.locations;
    if (0 == locations.length || '' == self.settings.service_name){
      return;
    }
    let html = '';
    let link = '';
    let base = jQuery('#url-previews').data('base');
    $.each(locations, function(idx){
      link = base + '/' + self.settings.service_name.replace(/ /g, '-').toLowerCase() + '-' + locations[idx].replace(/ /g, '-').replace(/'/g, '').toLowerCase() + '/';
      //html += `<a href="${link}">${link}</a><br/>`;
      html += `${link}<br/>`;
    });
    jQuery('#url-previews').html(html);
  },
  select_image: function( item, e, id){
   e.preventDefault();
   var options = {
    frame:    'post',
    state:    'insert',
    title:    wp.media.view.l10n.addMedia,
    multiple: true
  };
  item.image = '';
  wp.media.editor.open( id, options )
  .on('insert', function(e){
    setTimeout(function() { 
      var $input = jQuery('#' + id );
      var e = document.createEvent('HTMLEvents');
      e.initEvent('input', true, true);
      $input[0].dispatchEvent(e);
    }, 1000);
  });

},
select_bg_image: function( item, e, id){
 e.preventDefault();
 var image = wp.media({ 
  title: 'Upload Image',
  multiple: false,
   //describe: true
 }).open()
 .on('select', function(e){
  var uploaded_image = image.state().get('selection').first();
  var image_url = uploaded_image.toJSON().url;
  item.image = image_url;
});
},
select_image_url_only: function( id, e){

 var image = wp.media({ 
  title: 'Upload Image',
  multiple: false,
}).open()
 .on('select', function(ev){
  var uploaded_image = image.state().get('selection').first();
  var image_url = uploaded_image.toJSON().url;
  var $input = jQuery('#' + id );
  $input.val( image_url );
  var e = document.createEvent('HTMLEvents');
  e.initEvent('input', true, true);
  $input[0].dispatchEvent(e);
});
 e.preventDefault();
},
submit: function(){
 sdp_spin();
 $.ajax({
  type: "POST",
  url: SDP_TOOLS.ajax_url,
  data: {
    action: 'sdp_save_settings',
    settings: this.settings 
  },
  success: function (response) {
   sdp_unspin();
   sdp_show_notification('Settings were updated.');
 },

});
},
update_data: function( ){
  jQuery('#sdp-data-object').val(  JSON.stringify( this.settings ) );
},
string_to_slug: function (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes
        return str;
      }

    }
  });
new Vue({
  el: '#sdp-settings',

});
function sdp_spin(){
  jQuery('.sc-loader').show();
}

function sdp_unspin(){
  jQuery('.sc-loader').hide();
}

function sdp_show_notification( text ){
  $( "#sdp-notification" ).remove();
  $('<div id="sdp-notification"><p>' + text + '</p></div>').appendTo('body');
  $( "#sdp-notification" ).dialog({
   close: function( event, ui ) {
     $( "#sdp-notification" ).remove();
   },
   buttons: [
   {
    text: "Ok",
    click: function() {
      $( this ).dialog( "close" );
    }
      // Uncommenting the following line would hide the text,
      // resulting in the label being used as a tooltip
      //showText: false
    }
    ]
  });
}

})( jQuery );*/

/*
Pages generation
*/
function sdp_generate_pages() {
  jQuery('#sdp-service-generation .inside .spinner').css('visibility', 'visible');
  jQuery('#sdp-service-generation .inside').css('opacity', '0.6');
  jQuery('#sdp-service-generation .inside .generate').attr('disabled', 'disabled');
  var data = {
    action: 'generate_sdp_services',
    post_id: SDP.post_id,
    data: jQuery('#sdp-data-object').val(),
    nonce: SDP.generate_services_nonce
  };
  jQuery.ajax({
    type: "POST",
    url: SDP.ajax_url,
    data: data,
  }).done(function(res) {
    alert(res.data.pages + ' new pages have been created');
    jQuery('#sdp-service-generation .inside').html(res.data.html);
    jQuery('#sdp-service-generation .inside').css('opacity', '1');
  });
}
