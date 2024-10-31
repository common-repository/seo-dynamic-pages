<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Seo_dynamic_pages
 *
 * @wordpress-plugin
 * Plugin Name:       SEO Dynamic Pages
 * Plugin URI:        http://example.com/seo-dynamic-pages-uri/
 * Description:       SEO Dynamic Pages allows a website owner to identify services their business offers as well as cities and towns. The plugin will dynamically create pages on your WordPress website with a combination of city and service without the need of physically creating each page.
 * Version:           1.0.27
 * Author:            118GROUP Web Design
 * Author URI:        http://118group.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       seo-dynamic-pages
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SEO_DYNAMIC_PAGES_VERSION', '1.0.27' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-seo-dynamic-pages-activator.php
 */
function activate_seo_dynamic_pages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seo-dynamic-pages-activator.php';
	Seo_dynamic_pages_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-seo-dynamic-pages-deactivator.php
 */
function deactivate_seo_dynamic_pages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-seo-dynamic-pages-deactivator.php';
	Seo_dynamic_pages_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_seo_dynamic_pages' );
register_deactivation_hook( __FILE__, 'deactivate_seo_dynamic_pages' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-seo-dynamic-pages.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_seo_dynamic_pages() {

	$plugin = new Seo_dynamic_pages();
	$plugin->run();

}
run_seo_dynamic_pages();
