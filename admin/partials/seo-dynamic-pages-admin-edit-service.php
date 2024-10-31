<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Seo admin pages
 * @subpackage Seo admin pages/admin/partials
 */

?>
<div id="sdp-settings" class="container">
    <input type="hidden" name="sdp-data-object" id="sdp-data-object"/>
    <script id="sdp-data" type="application/json"><?php echo stripcslashes($settings); ?></script>
    <script id="sdp-general" type="application/json"><?php echo ($general_settings); ?></script>
    <div class="sc-loader"></div>
    <widget inline-template>
       <form v-on:submit.prevent="submit()">
        <div >
            <div class="form-group">
                <h5>Main configuration</h5>
                <div class="input-group">
                    <label>Service Name <input type="text" class="form-control valid" name="service_name" id="h1_tag" v-model="settings.service_name" aria-invalid="false"></label><div class="toolt">(required)</div>
                </div>
             <!--    <div class="input-group">
                   <label>Locations <textarea class="form-control valid" v-model="settings.locations" name="locations"  col="50" row="50" style="min-height: 100px;"></textarea></label><div class="toolt">(minimum 1 required)</div>
               </div> -->
               <div class="input-group">
                <h5>Links preview</h5>
                <div id="url-previews" data-base="<?php echo site_url(); ?>">
                </div>
            </div>
            <div class="input-group">
                <label>H1 Tag <input type="text" class="form-control valid" name="user_input_bg_color" id="h1_tag" v-model="settings.h1_tag" aria-invalid="false"></label><div class="toolt">(you can use [service-name] or [location] to automatically find and replace text)</div>
            </div>
            <div class="input-group">
                <label>Meta description <input type="text" class="form-control valid" name="meta_description" id="meta_description" v-model="settings.meta_description" aria-invalid="false"></label><div class="toolt">(you can use [service-name] or [location] to automatically find and replace text)</div>
            </div>
            <div class="input-group">
                <label>Meta keywords <input type="text" class="form-control valid" name="meta_keywords" id="meta_keywords" v-model="settings.meta_keywords" aria-invalid="false"></label><div class="toolt">(you can use [service-name] or [location] to automatically find and replace text)</div>
            </div>
            <div class="input-group">
                <label>Background heading image <input type="text" class="form-control valid" name="bg_image" id="bg_image" v-model="settings.bg_image" aria-invalid="false"></label>
            </div>
            <div class="input-group">
                <label>Show footer and header <input type="checkbox" name="show_footer_header" id="show_footer_header" v-model="settings.show_footer_header" aria-invalid="false"></label>
            </div>
            <h4>Aggregate rating</h4>
            <div class="input-group">
                <label>Output Aggregate Rating <input type="checkbox" name="output_agg_rating" id="output_agg_rating" v-model="settings.output_agg_rating" aria-invalid="false"></label>
            </div>
            <template v-if="settings.output_agg_rating">
             <div class="input-group">
                <label>Company name <input type="text" class="form-control valid" name="agg_company_name" id="agg_company_name" v-model="settings.agg_company_name" aria-invalid="false"></label>
            </div>
            <div class="input-group">
                <label>Company address <input type="text" class="form-control valid" name="agg_company_address" id="agg_company_address" v-model="settings.agg_company_address" aria-invalid="false"></label>
            </div>
            <div class="input-group">
                <label>Company city <input type="text" class="form-control valid" name="agg_company_city" id="agg_company_city" v-model="settings.agg_company_city" aria-invalid="false"></label>
            </div>
            <div class="input-group">
                <label>Company state <input type="text" class="form-control valid" name="agg_company_state" id="agg_company_state" v-model="settings.agg_company_state" aria-invalid="false"></label>
            </div>
            <div class="input-group">
                <label>Company phone <input type="text" class="form-control valid" name="agg_company_phone" id="agg_company_phone" v-model="settings.agg_company_phone" aria-invalid="false"></label>
            </div>
             <div class="input-group">
                <label>Company logo <input type="text" class="form-control valid" id="agg_company_logo" v-model="settings.agg_company_logo" /><button class="ui-button ui-widget ui-corner-all" v-on:click="select_image_url_only( 'agg_company_logo', $event);">Select Image</button>
                </label>
            </div>
             <div class="input-group">
                <label>Company logo alt <input type="text" class="form-control valid" name="agg_company_logo_alt" id="agg_company_logo_alt" v-model="settings.agg_company_logo_alt" aria-invalid="false"></label>
            </div>
        </template>
    </div>
    <div class="form-group" >
       <h5>Page Content</h5>

       <div id="paragraphs">
        <table>
            <thead v-show="(settings.paragraphs.length > 0)" >
                <th>Heading</th>
                <th>HTML</th>
                <th>Image</th>
                <th>Actions</th>
            </thead>
            <tbody>
              <tr class="ui-state-default" v-for="(item, index) in settings.paragraphs" >
                <template v-if="<?php echo Seo_dynamic_pages::SECTION_TYPE_PARAGRAPH; ?> == item.type">
                    <td><input type="text" v-model="item.heading"/></td>
                    <td><textarea v-model="item.html" cols="50" rows="5"></textarea>
                       <div v-if="item.cta_button" >
                        <h4>CTA Button</h4>
                        <table>
                            <thead >
                                <th>Text</th>
                                <th>Button Text</th>
                                <th>Link URL</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                              <tr class="ui-state-default" >
                                <td><input type="text" v-model="item.cta_button.text"/></td>
                                <td><input type="text" v-model="item.cta_button.button_text"/></td>
                                <td><input type="text" v-model="item.cta_button.link_url"/></td>
                                <td> <input type="button" class="ui-button ui-widget ui-corner-all remove" v-on:click="item.cta_button = null;" value="Remove" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row" v-else> 
                    <input type="button" class="ui-button ui-widget ui-corner-all" v-on:click="Vue.set(item, 'cta_button', { text:'', button_text:''})" value="Add CTA Button" />
                </div>
            </td>
            <td><div class="image-wrapper" v-html="item.image" ></div>
                <input type="text" v-model="item.image" v-bind:id="'img-par-'+index" /><button class="ui-button ui-widget ui-corner-all select-image" v-on:click="select_image(item, $event,'img-par-'+index )">Select image</button>
                   <?php /* <label>Alt <input type="text" v-model="item.image_alt"/></label>
                    <label>Width <input type="text" v-model="item.image_width"/></label>
                    <label>Height <input type="text" v-model="item.image_height"/></label>
                    <label>Title <input type="text" v-model="item.image_title"/></label>
                    
                    <label>Class <input type="text" v-model="item.class"/></label>
                    */ ?>
                    <label>Display on left side <input type="checkbox" v-model="item.image_position_left"></label>
                </td>
                <td> <input type="button" class="ui-button ui-widget ui-corner-all remove" v-on:click="settings.paragraphs.splice(settings.paragraphs.indexOf(item), 1)" value="Remove" /></td>
            </tr>
        </template>
        <template v-else-if="<?php echo Seo_dynamic_pages::SECTION_TYPE_REGULAR; ?> == item.type">
            <td><input type="text" v-model="item.heading" /></td>
            <!--   <td><input type="text" v-model="item.name"/></td> -->
            <td><textarea v-model="item.text" cols="50" rows="5"></textarea>
               <div class="input-group">
                <p><label>Full Width <input type="checkbox" class="" name="full_width"  v-model="item.full_width"></label></p>
                <p><label>Text Width, % <input type="text" size="5" class="form-control valid" name="item.text_strench"  v-model="item.text_strench" aria-invalid="false"></label></p>
                <p><label>Height, px <input type="text" size="5" class="form-control valid" name="item.height"  v-model="item.height" aria-invalid="false"></label></p>
            </div> 
        </td>
        <td><div class="image-wrapper"><img :src="item.image"></div>
            <input type="text" v-model="item.image" v-bind:id="'img-sec-'+index" /><button class="ui-button ui-widget ui-corner-all select-image" v-on:click="select_bg_image(item, $event, 'img-sec-'+index);">Select Background Image</button>

        </td>
        <td> <input type="button" class="ui-button ui-widget ui-corner-all remove" v-on:click="settings.sections.splice(settings.sections.indexOf(item), 1)" value="Remove" /></td>

    </template>
</tbody>
</table>
</div>
<div class="row"> 
    <input type="button" class="ui-button ui-widget ui-corner-all" v-on:click="settings.paragraphs.push({type:'<?php echo Seo_dynamic_pages::SECTION_TYPE_PARAGRAPH; ?>', heading:'', html:'', image:''});" value="Add Paragraph" />
    <input type="button" class="ui-button ui-widget ui-corner-all" v-on:click="settings.paragraphs.push({type:'<?php echo Seo_dynamic_pages::SECTION_TYPE_REGULAR; ?>', heading:'', html:'', image:''});" value="Add Section" />
</div>

</div>
<?php /*
<div class="form-group" >
   <h5>Sections</h5>
   <div class="input-group">
    <p><label>Sections Background Image <input type="text" class="form-control valid" name="sections_bg_image"  v-model="settings.sections_bg_image" aria-invalid="false"></label></p>
    <p><label>Sections to Full Width <input type="checkbox" class="" name="sections_full_width"  v-model="settings.sections_full_width"></label></p>
    <p><label>Sections Text Width % <input type="text" size="5" class="form-control valid" name="sections_text_strench"  v-model="settings.sections_text_strench" aria-invalid="false"></label></p>
</div> <div>
    <table>
        <thead v-show="(settings.sections.length > 0)" >
            <th>Heading</th>
            <!--   <th>Name</th> -->
            <th>Text</th>
            <th>Action</th>
        </thead>
        <tbody>
          <tr class="ui-state-default" v-for="item in settings.sections" >
            <td><input type="text" v-model="item.heading" /></td>
            <!--   <td><input type="text" v-model="item.name"/></td> -->
            <td><textarea v-model="item.text" cols="50" rows="5"></textarea></td>
            <td> <input type="button" class="ui-button ui-widget ui-corner-all remove" v-on:click="settings.sections.splice(settings.sections.indexOf(item), 1)" value="Remove" /></td>
        </tr>
    </tbody>
</table>
</div>
<div class="row"> 
    <input type="button" class="ui-button ui-widget ui-corner-all" v-on:click="settings.sections.push({heading:'', name:'', text:''});" value="Add Section" />
</div>

</div> */ ?>

<!-- <div class="form-group" >
 <h5>Call to Action buttons</h5>
 <div>
    <table>
        <thead v-show="(settings.cta_buttons.length > 0)" >
            <th>Text</th>
            <th>Button Text</th>
            <th>Link URL</th>
            <th>Action</th>
        </thead>
        <tbody>
          <tr class="ui-state-default" v-for="item in settings.cta_buttons" >
            <td><input type="text" v-model="item.text"/></td>
            <td><input type="text" v-model="item.button_text"/></td>
            <td><input type="text" v-model="item.link_url"/></td>
            <td> <input type="button" class="ui-button ui-widget ui-corner-all remove" v-on:click="settings.cta_buttons.splice(settings.cta_buttons.indexOf(item), 1)" value="Remove" /></td>
        </tr>
    </tbody>
</table>
</div>
<div class="row" v-show="(settings.cta_buttons.length == 0)"> 
    <input type="button" class="ui-button ui-widget ui-corner-all" v-on:click="settings.cta_buttons.push({text:'', button_text:''});" value="Add CTA Button" />
</div>

</div> -->

</form>
</widget>
</div>
