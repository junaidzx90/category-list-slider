<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.fiverr.com/junaidzx90
 * @since             1.0.0
 * @package           Category_List_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Category List Slider
 * Plugin URI:        https://github.com/junaidzx90/category-list-slider
 * Description:       Use: <strong>[cls_slider style="single" taxonomy="category"]</strong> OR <strong>[cls_slider style="carousel" taxonomy="category" slide="3"]</strong>.
 * Version:           1.0.0
 * Author:            junaidzx90
 * Author URI:        https://www.fiverr.com/junaidzx90
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       category-list-slider
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
define( 'CATEGORY_LIST_SLIDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-category-list-slider-activator.php
 */
function activate_category_list_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-category-list-slider-activator.php';
	Category_List_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-category-list-slider-deactivator.php
 */
function deactivate_category_list_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-category-list-slider-deactivator.php';
	Category_List_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_category_list_slider' );
register_deactivation_hook( __FILE__, 'deactivate_category_list_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-category-list-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_category_list_slider() {

	$plugin = new Category_List_Slider();
	$plugin->run();

}
run_category_list_slider();
