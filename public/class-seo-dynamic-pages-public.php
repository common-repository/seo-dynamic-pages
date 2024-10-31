<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Seo_dynamic_pages
 * @subpackage Seo_dynamic_pages/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Seo_dynamic_pages
 * @subpackage Seo_dynamic_pages/public
 * @author     Your Name <email@example.com>
 */
class Seo_dynamic_pages_Public {

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
	 * @param      string    $seo_dynamic_pages       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $seo_dynamic_pages, $version ) {

		$this->seo_dynamic_pages = $seo_dynamic_pages;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->seo_dynamic_pages, plugin_dir_url( __FILE__ ) . 'css/seo-dynamic-pages-public.css', array(), $this->version, 'all' );
		/*wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap-grid.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap-helpers', plugin_dir_url( __FILE__ ) . 'css/bootstrap-helpers.css', array(), $this->version, 'all' );*/

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		/*wp_enqueue_script( $this->seo_dynamic_pages, plugin_dir_url( __FILE__ ) . 'js/seo-dynamic-pages-public.js', array( 'jquery' ), $this->version, false );*/

	}

/*	public function cpt_template( $single ){
		global $wp_query, $post;
		if ( $post->post_type == 'sdp-service' ) { 
			if ( file_exists( plugin_dir_path(  __FILE__ ) . '/partials/seo-dynamic-pages-public-display.php' ) ) {
				return plugin_dir_path(  __FILE__ )  . '/partials/seo-dynamic-pages-public-display.php';
			}
		}
		return $single;
	}*/
/*	public function wp_head(){
		global $wp_query, $post;
		if ( $post->post_type == 'sdp-service' ) { 
			$location = get_query_var( 'location' );
			$locations = explode("\r\n", get_option('sdp_locations', '') );
			//need to find location to detect if it has upper case if they are present
			foreach ( $locations as $loc ){
				if (strtolower( strtr( trim( $loc ) , ['\'' => '', ' ' => '-']) ) == $location ){
					$location = $loc;
					break;
				}
			}
			$meta =	get_post_meta( $post->ID, 'sdp-data-object', true );
			$settings = json_decode( stripcslashes( $meta ) );
			$html_meta = [];
			$html_meta['description'] = esc_html( Seo_dynamic_pages_Public::get_var( $settings->meta_description, $settings, $location ));
			$html_meta['keywords'] = esc_html( Seo_dynamic_pages_Public::get_var( $settings->meta_keywords, $settings, $location ));
			foreach ( $html_meta as $k => $v ){
				echo "<meta name=\"$k\" content=\"$v\"/>\n";
			}

		}
	}*/
/*	public function wp_head(){
		global $wp_query, $post;
		$meta = get_post_meta($post->ID );
		$location = $meta['sdp_location'][0];
		$html_meta = [];
		if ( $location ) { 
			if (!$meta['_wds_metadesc'][0] ){
				$description =	$meta['sdp_description'][0];
				$html_meta['description'] = $description;
			}
			if (!$meta['_wds_keywords'][0] ){
				$keywords =	$meta['sdp_keywords'][0]; 
				$html_meta['keywords'] = $keywords;
			}
			if ($html_meta){
				foreach ( $html_meta as $k => $v ){
					echo "<meta name=\"$k\" content=\"$v\"/>\n";
				}
			}
		}
	}*/
	
	/*public function smart_crawl_description($description){
		global $post;
		$meta = get_post_meta($post->ID );
		$location = $meta['sdp_location'][0];
		if ( $location ) { 
			$description = str_replace('[location]', $location, $description);
		}
		return $description;
	}
	public function smart_crawl_title($title){
		global $post;
		$meta = get_post_meta($post->ID );
		$location = $meta['sdp_location'][0];
		if ( $location ) { 
			$title = str_replace('[location]', $location, $title);
		}
		return $title;
	}*/
/*	public function document_title_parts( $title ){
		global $wp_query, $post;
		$meta = get_post_meta($post->ID );
		$location = $meta['sdp_location'][0];
		if ( $location ) { 
			$meta =	get_post_meta( $post->ID, 'sdp-data-object', true );
			$settings = json_decode( stripcslashes( $meta ) );
			$title['title'] = esc_html( Seo_dynamic_pages_Public::get_var( $settings->h1_tag, $settings, $location ));
		}
		return $title;
	}*/
	/*public function document_title_parts( $title ){
		global $wp_query, $post;
		if ( $post->post_type == 'sdp-service' ) { 
			$location = get_query_var( 'location' );
			$locations = explode("\r\n", get_option('sdp_locations', '') );
			//need to find location to detect if it has upper case if they are present
			foreach ( $locations as $loc ){
				if (strtolower( strtr( trim( $loc ) , ['\'' => '', ' ' => '-']) ) == $location ){
					$location = $loc;
					break;
				}
			}
			$meta =	get_post_meta( $post->ID, 'sdp-data-object', true );
			$settings = json_decode( stripcslashes( $meta ) );
			$title['title'] = esc_html( Seo_dynamic_pages_Public::get_var( $settings->h1_tag, $settings, $location ));
		}
		return $title;
	}*/
/*	public static function get_var( $var, $settings, $location ){
		$replaced = str_replace( ['[service-name]', '[location]'], [ $settings->service_name, $location ], $var );
		return $replaced;
	}*/
	/*public function init(){
		//add_shortcode( 'sdp-services-sitemap', [ $this, 'get_sitemap'] );
	}*/
	/*public function get_sitemap(){
		ob_start();
		$posts = get_posts([
			'number' => -1,
			'post_type' => 'sdp-service',
			'post_status' => 'publish',
		]);

		if ( !$posts ){
			return '<p>No services found</p>';
		}
		$services = [];
		$locations = explode("\r\n", get_option('sdp_locations', '') );
		foreach ( $posts as $post ){
			$meta =	get_post_meta( $post->ID, 'sdp-data-object', true );
			$settings = json_decode( stripcslashes( $meta ) );
			if ($settings && $settings->locations && $settings->service_name ){
				$service_name = strtolower( str_replace(' ', '-', ( trim( $settings->service_name ) ) ) );
				$services[$post->ID]['name'] = $settings->service_name; //$service_name;
				if (0 < count($locations)){
					$i = 0;
					foreach ($locations as $location){
						$location = strtr( trim( $location ) , ['\'' => '', ' ' => '-']);
						$services[$post->ID]['data'][$i]['h1_tag'] = Seo_dynamic_pages_Public::get_var( $settings->h1_tag, $settings, $location ); 
						$services[$post->ID]['data'][$i]['link'] = site_url() . '/' . $service_name  .'-'. strtolower( $location );
						$i++;
					}
				}
			}
		}
		require_once('partials/seo-dynamic-pages-sitemap.php');
		return ob_get_clean();
	}
	public function get_sitemap_xml(){
		ob_start();
		$posts = get_posts([
			'number' => -1,
			'post_type' => 'sdp-service',
			'post_status' => 'publish',
		]);

		$services = [];
		$locations = explode("\r\n", get_option('sdp_locations', '') );
		foreach ( $posts as $post ){
			$meta =	get_post_meta( $post->ID, 'sdp-data-object', true );
			$settings = json_decode( stripcslashes( $meta ) );
			if ($settings && $settings->locations && $settings->service_name ){
				$service_name = strtolower( str_replace(' ', '-', ( trim( $settings->service_name ) ) ) );
				$services[$post->ID]['name'] = $settings->service_name; //$service_name;
				if (0 < count($locations)){
					$i = 0;
					foreach ($locations as $location){
						$location = strtr( trim( $location ) , ['\'' => '', ' ' => '-']);
						$services[$post->ID]['data'][$i]['h1_tag'] = Seo_dynamic_pages_Public::get_var( $settings->h1_tag, $settings, $location ); 
						$services[$post->ID]['data'][$i]['link'] = site_url() . '/' . $service_name  .'-'. strtolower( $location );
						$i++;
					}
				}
			}
		}
		header('Content-type: text/xml');
		require_once('partials/seo-dynamic-pages-sitemap-xml.php');
		return ob_get_clean();
	}*/
	public function wp(){
		/*$include =  get_query_var( 'sdp-include' ) ;
		if ( 'sitemap' == $include ){
			echo $this->get_sitemap_xml();
			die;
		}elseif ( 'customcss' == $include ){
			header("Content-type: text/css; charset: UTF-8");
			echo get_option('sdp_custom_css', '');
			die;
		}*/
		
	}
}
