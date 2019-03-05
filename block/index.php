<?php

/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Load all translations for our plugin from the MO file.
 */
function before_after_image_slider_load_textdomain() {
	load_plugin_textdomain( 'before-after-image-slider', false, basename( __DIR__ ) . '/languages' );
}
add_action( 'init', 'before_after_image_slider_load_textdomain' );

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function before_after_image_slider_register_block() {

	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

	wp_register_script(
		'before-after-image-slider-block',
		plugins_url( 'block.js', __FILE__ ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);

	wp_register_style(
		'before-after-image-slider-block',
		plugins_url( 'style.css', __FILE__ ),
		array( ),
		filemtime( plugin_dir_path( __FILE__ ) . 'style.css' )
	);

	register_block_type( 'before-after-image-slider/block', array(
		'style'			=> 'before-after-image-slider-block',
		'editor_script' => 'before-after-image-slider-block',
	) );

  if ( function_exists( 'wp_set_script_translations' ) ) {
    /**
     * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
     * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
     * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
     */
    wp_set_script_translations( 'before-after-image-slider-block', 'before-after-image-slider' );
  }

}
add_action( 'init', 'before_after_image_slider_register_block' );
