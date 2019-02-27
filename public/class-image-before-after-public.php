<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wpzen.ru
 * @since      1.0.0
 *
 * @package    Image_Before_After
 * @subpackage Image_Before_After/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Image_Before_After
 * @subpackage Image_Before_After/public
 * @author     Pleshakov Valery <pleshakov.valery@gmail.com>
 */
class Image_Before_After_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( 'image_before_after', array( $this, 'register_shortcode' ) );

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
		 * defined in Image_Before_After_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Image_Before_After_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/twentytwenty.css', array(), $this->version, 'all' );

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
		 * defined in Image_Before_After_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Image_Before_After_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(
			'jquery-event-move',
			plugin_dir_url( __FILE__ ) . 'js/jquery.event.move.js',
			array( 'jquery' ),
			$this->version,
			false
		);

		wp_enqueue_script(
			'jquery-twentytwenty',
			plugin_dir_url( __FILE__ ) . 'js/jquery.twentytwenty.js',
			array( 'jquery', 'jquery-event-move' ),
			$this->version,
			false
		);

		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/image-before-after-public.js',
			array( 'jquery', 'jquery-event-move', 'jquery-twentytwenty' ),
			$this->version,
			false
		);

	}

	/**
	 * Add shortcode image before and after.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcode( $atts ) {

		/**
		 * The default slider settings.
		 */
		$atts = shortcode_atts( array(
			'offset'			=> '50',
			'orientation'	=> 'horizontal',
			'before'			=> 'Before',
			'after'				=> 'After',
			'overlay'			=> 'false',
			'hover'				=> 'false',
			'handle'			=> 'true',
			'click'				=> 'false',
			'img1'				=> 0,
			'img2'				=> 0
		), $atts );

		$block = '<div class="wp-block-image-before-after-block"';

		foreach ( $atts as $key => $value ) {
			if( 'img1' != $key && 'img2' != $key )
				$block .= sprintf( ' data-%s="%s"', $key, $value );
		}

		$block .= '>';

		$img1 = wp_get_attachment_image_src( (int)$atts['img1'], 'full' );

		if( $img1 ) {
			$block .= '<img src="' . $img1[0] . '" class="image-before">';
		}

		$img2 = wp_get_attachment_image_src( (int)$atts['img2'], 'full' );

		if( $img2 ) {
			$block .= '<img src="' . $img2[0] . '" class="image-before">';
		}

		$block .= '</div>';

		return $block;

	}

}
