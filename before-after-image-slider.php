<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpzen.ru/plugins/image-before-image-slider/
 * @since             1.0.0
 * @package           Before_After_Image_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Before & After Image Slider – Gutenberg Block
 * Plugin URI:        https://github.com/wpzen/image-before-image-slider
 * Description:       Highlight the differences between the two images.
 * Version:           1.0.0
 * Author:            Pleshakov Valery
 * Author URI:        https://wpzen.ru
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       before-after-image-slider
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
define( 'BEFORE_AFTER_IMAGE_SLIDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-before-after-image-slider-activator.php
 */
function activate_before_after_image_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-before-after-image-slider-activator.php';
	Before_After_Image_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-before-after-image-slider-deactivator.php
 */
function deactivate_before_after_image_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-before-after-image-slider-deactivator.php';
	Before_After_Image_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_before_after_image_slider' );
register_deactivation_hook( __FILE__, 'deactivate_before_after_image_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-before-after-image-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_before_after_image_slider() {

	$plugin = new Before_After_Image_Slider();
	$plugin->run();

}
run_before_after_image_slider();
