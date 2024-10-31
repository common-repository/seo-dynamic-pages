<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Seo_dynamic_pages
 * @subpackage Seo_dynamic_pages/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Seo_dynamic_pages
 * @subpackage Seo_dynamic_pages/admin
 * @author     Your Name <email@example.com>
 */
class Seo_dynamic_pages_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $seo_dynamic_pages    The ID of this plugin.
	 */
	private $seo_dynamic_pages;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $seo_dynamic_pages       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	protected $settings;


	public function __construct( $seo_dynamic_pages, $version, $settings ) {

		$this->seo_dynamic_pages = $seo_dynamic_pages;
		$this->version = $version;
		$this->settings = $settings;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seo_dynamic_pages_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seo_dynamic_pages_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		global $post;
		if ($post->post_type != 'page') return;
		/*wp_enqueue_style( $this->seo_dynamic_pages.'-spectrum', plugin_dir_url( __FILE__ ) . 'css/spectrum.css', array(), $this->version, 'all' );
		wp_enqueue_style('bootstrap-grid', plugin_dir_url( __FILE__ ) . '../public/css/bootstrap-grid.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->seo_dynamic_pages.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );*/
		wp_enqueue_style( $this->seo_dynamic_pages, plugin_dir_url( __FILE__ ) . 'css/seo-dynamic-pages-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Seo_dynamic_pages_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Seo_dynamic_pages_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		global $post;
		if ($post->post_type != 'page') return;
		/*wp_enqueue_script( $this->seo_dynamic_pages.'-spectrum', plugin_dir_url( __FILE__ ) . 'js/spectrum.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->seo_dynamic_pages.'-vue', plugin_dir_url( __FILE__ ) . 'js/vue.js', array( 'jquery' ), $this->version, true );*/

		wp_register_script( $this->seo_dynamic_pages.'-admin', plugin_dir_url( __FILE__ ) . 'js/seo-dynamic-pages-admin.js', array(), $this->version, true );
		wp_localize_script($this->seo_dynamic_pages.'-admin', 'SDP', [ 'ajax_url' => admin_url('admin-ajax.php'), 'post_id' => $post->ID, 'generate_services_nonce' => wp_create_nonce('generate_sdp_services') ] );
		wp_enqueue_script( $this->seo_dynamic_pages.'-admin' );

	}
	public function admin_menu() {
		global $sdp_page_hook_suffix;
		$sdp_page_hook_suffix = add_menu_page(
			'SDP Settings',
			'SDP Settings',
			'manage_options',
			'sdp',
			array( $this, 'settings_page' ),
			'dashicons-admin-tools',
			21
		);

	}
	public function admin_init() {
		$section_group = 'sdp';
		
		$settings_section = 'sdp_main';
		$page = $section_group;
		
		add_settings_section(
			$settings_section,
			'SDP Settings',
			function(){
				return;
			},
			$page
		);
		$setting_name = 'sdp_locations';
		register_setting( $section_group , $setting_name );
		add_settings_field(
			$setting_name,
			'Locations',
			function(){
				echo '<textarea id="sdp_locations" name="sdp_locations"  col="50" row="50" style="min-height: 300px; min-width: 400px;">'.get_option('sdp_locations', null ).'</textarea><div class="toolt">(1 per line)</div>';
			},
			$page,
			$settings_section
		);

	/*	$setting_name = 'sdp_company_name';
		register_setting( $section_group , $setting_name );
		add_settings_field(
			$setting_name,
			'Company Name',
			function(){
				echo '<input type="text" id="sdp_company_name" name="sdp_company_name" value="'.get_option('sdp_company_name', null ).'"/>';
			},
			$page,
			$settings_section
		);*/
	}
/*	public function init() {
		register_post_type( 'sdp-service',
			array(
				'labels'          => array(
					'name'               => 'SDP Services',
					'singular_name'      => 'SDP Service',
					'add_new'            => 'Add New',
					'add_new_item'       => 'Add New SDP Service',
					'edit'               => 'Edit',
					'edit_item'          => 'Edit SDP Service',
					'new_item'           => 'New SDP Service',
					'view'               => 'View',
					'view_item'          => 'View SDP Services',
					'search_items'       => 'Search SDP Services',
					'not_found'          => 'No SDP Services found',
					'not_found_in_trash' => 'No SDP Services found in Trash',
					'parent'             => 'Parent SDP Service',
				),
				'public'          => true,
				'menu_position'   => 21,
				'supports'        => array(
					'title',
				),
				//'taxonomies'      => array( 'animalcategory' ),
				'menu_icon'       => 'dashicons-testimonial',
				'has_archive'     => false,
				'capability_type' => 'post',
				'rewrite' => array( 'slug' => 'sdp-service' ),
			)
		);
		$this->update_rewrite_rules();
	}*/
	/*public function update_rewrite_rules(){
		global $wp;
		$wp->add_query_var( 'location' );
		$wp->add_query_var( 'sdp-include' );
		$posts = get_posts([
			'number' => -1,
			'post_type' => 'sdp-service',
			'post_status' => 'publish',
		]);

		if ( !$posts ){
			return;
		}
		$site_rules = get_option( 'rewrite_rules' );
		$rules = [];
		//$rules['^sitemap.xml/?$'] = 'index.php?sdp-include=sitemap';
		$rules['^services-and-locations/?$'] = 'index.php?sdp-include=sitemap';
		

		$rules['^wp-content/plugins/seo-dynamic-pages/public/css/seo-dynamic-pages-public-custom.css/?$'] = 'index.php?sdp-include=customcss';
		$flush = false;
		$locations = explode("\r\n", get_option('sdp_locations', '') );
		//var_dump($locations); die();
		foreach ( $posts as $post ){
			$meta =	get_post_meta( $post->ID, 'sdp-data-object', true );
			$settings = json_decode( stripcslashes( $meta ) );
			if ($settings && $settings->locations && $settings->service_name ){
				
				$service_name = strtolower(str_replace(' ', '-', ( trim( $settings->service_name ) ) ));
				if (0 < count($locations)){
					foreach ($locations as $location){
						$location = strtolower(strtr( trim( $location ) , ['\'' => '', ' ' => '-']));
						//$query = '^'.$location.'-'.$service_name.'$';
						$query = '^'.$service_name.'-'.$location.'$';
						$rules[$query] = 'index.php?post_type=sdp-service&p='.$post->ID.'&location='.$location;
						if ( !isset( $site_rules[$query]) ){
							$flush = true;
						}
					}
				}
			}
		}
		
		foreach( $rules as $k => $v ) {
			add_rewrite_rule( $k, $v , 'top' );
		}
		if ($flush){
			flush_rewrite_rules();
		}
	}*/
	/*public function save_sdp_post( $post_id, $post ){
		global $wpdb;

		$post_type = get_post_type($post_id);

		if ( "sdp-service" != $post_type ) return;

		if ( isset( $_POST['sdp-data-object'] ) ) {
			update_post_meta( $post_id, 'sdp-data-object', wp_slash(( $_POST['sdp-data-object'] ) ));
			flush_rewrite_rules();
		}
	}*/
	/*public function options_page(){
		global $post;

		$settings = get_post_meta( $post->ID, 'sdp-data-object', true );

		if (!$settings){
			$settings = json_encode([
				//'locations' => get_option('sdp_locations', '' ) , 
				'service_name' => '', 
				'h1_tag' => '', 
				'meta_description' => '', 
				'meta_keywords' => '', 
				'bg_image' => '',
				'paragraphs' => [], 
				'sections_label' => '', 
				'sections' => [], 
				'cta_button' => [], //call to action buttons
				'output_agg_rating' => false,
				'agg_company_name' => '',
				'agg_company_address' => '',
				'agg_company_city' => '',
				'agg_company_state' => '',
				'agg_company_phone' => ''
			]);
		}
		$general_settings = json_encode(  ['locations' => str_replace("\r\n", '|', get_option('sdp_locations', '')) ]);
		include_once( 'partials/seo-dynamic-pages-admin-edit-service.php' );
	}
*/
	public function load_wp_media_files() {
		wp_enqueue_media();
	}

	function settings_page() {
		?>
		<div class="wrap">
			<form action="options.php" method="post"> 
				<?php
				settings_fields( 'sdp' );	
				do_settings_sections( 'sdp' ); 	
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
	public function save_settings() {
		if (isset($_POST['sdp-settings'])){
			update_option('sdp_settings', $_POST['sdp-settings'] );
		}
		die('1');
	}
	public function add_meta_boxes(){
		add_meta_box(
			'sdp-service-generation',
			'SDP Service Generation ',
			[ $this, 'service_generation_metabox'],
			'page');
	}
	public function service_generation_metabox( $post_id ){
		if (is_object($post_id)){
			$post_id = $post_id->ID;
		}
		$pages = get_post_meta($post_id, 'sdp_generated_pages', true);
		?>
		<p class="actions"><input type="button" onclick="sdp_generate_pages();" class="btn button generate" value="Generate"/><span class="spinner" style="float: none;"></span></p>
		<?php if ($pages){ ?>
			<h4>Generated pages for this page(<?php echo count($pages); ?>):</h4>
			<ul>
				<?php foreach ($pages as $page_id) {
					$link = get_permalink($page_id);
					if ( !$link || 'trash' == get_post_status($page_id) ){
						continue;
					}
					?>
					<li><a href="<?php echo $link; ?>"><?php echo $link; ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php 
		}
	}
	public function generate_sdp_services( ){
		check_ajax_referer( 'generate_sdp_services', 'nonce' );
		$pages = $this->generate_pages( $_POST['post_id'], $_POST['data'] );
		ob_start();
		$this->service_generation_metabox( $_POST['post_id'] );
		$html = ob_get_clean();
		wp_send_json_success(['html' => $html, 'pages' => $pages ]);
		wp_die();
	}
	public function generate_pages( $post_id, $json_data ){
		$settings = json_decode(  stripcslashes( $json_data ) );
		global $user_ID;
		$post = get_post( $post_id );
		$args = [
			'post_status' => 'publish',
			//'post_date' => date('Y-m-d H:i:s'),
			'post_author' => $user_ID,
			'post_type' => 'page',
			'post_category' => $post->post_category,
			'post_parent' => $post->post_parent,
		];
		$locations = explode("\r\n", get_option('sdp_locations', '') );
		$new_pages = [];
		$meta = get_post_meta($post_id);

		foreach ($locations as $location ) {
			$args['post_title'] = str_replace( '[location]', $location, $post->post_title );
			$args['post_content'] = str_replace( '[location]', $location, $post->post_content );
			
			$wds_title =  str_replace( '[location]', $location,  $meta['_wds_title'][0] );
			$wds_description =  str_replace( '[location]', $location,  $meta['_wds_metadesc'][0] );
			$new_post_id = wp_insert_post( $args );
			update_post_meta($new_post_id, 'sdp_location', $location);
			/*update_post_meta($new_post_id, 'sdp_description', Seo_dynamic_pages_Public::get_var( $settings->meta_description, $settings, $location ));
			update_post_meta($new_post_id, 'sdp_keywords', Seo_dynamic_pages_Public::get_var( $settings->meta_keywords, $settings, $location ));*/
			if ($meta['_aviaLayoutBuilderCleanData'][0]){
				$enfold_content = str_replace( '[location]', $location, $meta['_aviaLayoutBuilderCleanData'][0] );
				update_post_meta($new_post_id, '_aviaLayoutBuilderCleanData', $enfold_content); 
				update_post_meta($new_post_id, '_aviaLayoutBuilder_active', $meta['_aviaLayoutBuilder_active'][0]); 
				update_post_meta($new_post_id, '_avia_sc_parser_state', $meta['_avia_sc_parser_state'][0]);  
				update_post_meta($new_post_id, '_av_el_mgr_version', $meta['_av_el_mgr_version'][0]);  
				update_post_meta($new_post_id, '_avia_builder_shortcode_tree', unserialize($meta['_avia_builder_shortcode_tree'][0]));  

				update_post_meta($new_post_id, '_edit_last', $meta['_edit_last'][0]);
				update_post_meta($new_post_id, 'hefo_before', $meta['hefo_before'][0]);
				update_post_meta($new_post_id, 'hefo_after', $meta['hefo_after'][0]);
				update_post_meta($new_post_id, '_av_alb_posts_elements_state', unserialize($meta['_av_alb_posts_elements_state'][0]));
				update_post_meta($new_post_id, 'layout', $meta['layout'][0]);

				update_post_meta($new_post_id, 'sidebar', $meta['sidebar'][0]);
				update_post_meta($new_post_id, 'footer', $meta['footer'][0]);
				update_post_meta($new_post_id, 'header_title_bar', $meta['header_title_bar'][0]);
				update_post_meta($new_post_id, 'header_transparency', $meta['header_transparency'][0]);
				update_post_meta($new_post_id, '_yoast_wpseo_content_score', $meta['_yoast_wpseo_content_score'][0]);
				update_post_meta($new_post_id, '_edit_lock', $meta['_edit_lock'][0]);



				
			}
			update_post_meta($new_post_id, '_wds_title', $wds_title);
			update_post_meta($new_post_id, '_wds_metadesc', $wds_description);
			if ( $new_post_id ){
				$new_pages[] =  $new_post_id ;
			}
		}
		$pages = get_post_meta($post_id, 'sdp_generated_pages', true);
		if (!$pages){
			$pages = [];
		}
		update_post_meta( $post_id, 'sdp_generated_pages', array_merge($pages, $new_pages) );
		return count($new_pages);
	}
	/*public function get_aggregate_rating(){
		ob_start();
		?>
		<div class="sdp-aggreagate-rating" itemscope itemtype="http://schema.org/LocalBusiness">
			<img itemprop="image" src="<?php echo get_option('sdp_company_logo', null );?>" alt="<?php echo get_option('sdp_company_logo_alt', null );?>" />
			<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"> 
				Rated <span itemprop="ratingValue">5</span>/
				<span itemprop="bestRating">5</span> 
				based on <span itemprop="reviewCount"><?php echo rand(20, 60); ?></span> customer reviews
			</div>
			<span itemprop="name"><?php echo get_option('sdp_company_name', null );?></span>
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="streetAddress"><?php echo get_option('sdp_company_address', null );?></span>
				<span itemprop="addressLocality"><?php echo get_option('sdp_company_city', null );?></span>
				<span itemprop="addressRegion"><?php echo get_option('sdp_company_state', null );?></span>
			</div> 
			Phone: <span itemprop="telephone"><?php echo get_option('sdp_company_phone', null );?></span>
		</div>
		<?php
		return ob_get_clean();
	}*/
}
