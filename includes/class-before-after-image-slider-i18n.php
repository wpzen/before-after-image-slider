<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wpzen.ru
 * @since      1.0.0
 *
 * @package    Before_After_Image_Slider
 * @subpackage Before_After_Image_Slider/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Before_After_Image_Slider
 * @subpackage Before_After_Image_Slider/includes
 * @author     Pleshakov Valery <pleshakov.valery@gmail.com>
 */
class Before_After_Image_Slider_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'before-after-image-slider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
