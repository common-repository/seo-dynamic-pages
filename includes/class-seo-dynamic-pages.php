<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Seo_dynamic_pages
 * @subpackage Seo_dynamic_pages/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Seo_dynamic_pages
 * @subpackage Seo_dynamic_pages/includes
 * @author     Your Name <email@example.com>
 */
class Seo_dynamic_pages {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Seo_dynamic_pages_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $seo_dynamic_pages    The string used to uniquely identify this plugin.
	 */
	protected $seo_dynamic_pages;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	const SECTION_TYPE_PARAGRAPH = 0;
	const SECTION_TYPE_REGULAR = 1;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'SEO_DYNAMIC_PAGES_VERSION' ) ) {
			$this->version = SEO_DYNAMIC_PAGES_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->seo_dynamic_pages = 'seo-dynamic-pages';
		$this->settings = get_option('gdpr-tools-settings');
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Seo_dynamic_pages_Loader. Orchestrates the hooks of the plugin.
	 * - Seo_dynamic_pages_i18n. Defines internationalization functionality.
	 * - Seo_dynamic_pages_Admin. Defines all hooks for the admin area.
	 * - Seo_dynamic_pages_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-seo-dynamic-pages-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-seo-dynamic-pages-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-seo-dynamic-pages-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-seo-dynamic-pages-public.php';

		$this->loader = new Seo_dynamic_pages_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Seo_dynamic_pages_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Seo_dynamic_pages_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Seo_dynamic_pages_Admin( $this->get_seo_dynamic_pages(), $this->get_version(), $this->settings  );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts', 11 );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu'  );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'admin_init'  );
		//$this->loader->add_action( 'init', $plugin_admin, 'init' , 15 );
		//$this->loader->add_action( 'save_post', $plugin_admin, 'save_sdp_post', 10, 2 );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'load_wp_media_files' );

		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes' );

		$this->loader->add_action( 'wp_ajax_generate_sdp_services', $plugin_admin, 'generate_sdp_services' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Seo_dynamic_pages_Public( $this->get_seo_dynamic_pages(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 15 );
		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts', 15 );
		//$this->loader->add_filter( 'single_template', $plugin_public, 'cpt_template', 20, 1 );
		//$this->loader->add_action( 'init', $plugin_public, 'init' );
		//$this->loader->add_filter( 'pre_get_document_title', $plugin_public, 'smart_crawl_title' , 101 );
		//$this->loader->add_filter( 'wds_metadesc', $plugin_public, 'smart_crawl_description' , 101 );
		
		//$this->loader->add_action( 'wp_head', $plugin_public, 'wp_head' );


		//$this->loader->add_action( 'wp', $plugin_public, 'wp' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_seo_dynamic_pages() {
		return $this->seo_dynamic_pages;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Seo_dynamic_pages_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
