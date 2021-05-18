<?php
/**
 * Customizer class
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Init class
 */
class Theme_Slug_Customizer {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	protected static $instance;

	/**
	 * Instance control
	 *
	 * @return Theme_Slug_Customizer
	 */
	public static function get_instance() {

		if ( null === static::$instance ) {
				static::$instance = new static();
		}
		return static::$instance;

	}

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'modify_native_settings' ) );
	}

	/**
	 * Modify default options.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function modify_native_settings( WP_Customize_Manager $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => function() {
						bloginfo( 'name' );
					},
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => function() {
						bloginfo( 'description' );
					},
				)
			);
		}
	}

}
Theme_Slug_Customizer::get_instance();
