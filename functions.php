<?php
/**
 * Functions and definitions
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// This theme requires WordPress 5.5 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.5', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

// ----------------------------------------------------------------------------------------------
// THEME SET UP
// Sets up theme and registers support for various WordPress features.
// ----------------------------------------------------------------------------------------------

if ( ! function_exists( 'theme_slug_setup' ) ) {
	/**
	 * Sets up theme.
	 */
	function theme_slug_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'themeslug', get_template_directory() . '/languages' );

		// Add default RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Ensure WordPress manages the document title.
		add_theme_support( 'title-tag' );

		// Ensure WordPress theme features render in HTML5 markup.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		// Add support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for full and wide aligned images.
		add_theme_support( 'align-wide' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Default editor color palette.
		$black      = '#000000';
		$dark_gray  = '#28303D';
		$gray       = '#39414D';
		$light_gray = '#f0f0f0';
		$green      = '#D1E4DD';
		$blue       = '#D1DFE4';
		$purple     = '#D1D1E4';
		$red        = '#E4D1D1';
		$orange     = '#E4DAD1';
		$yellow     = '#EEEADD';
		$white      = '#FFFFFF';

		$editor_color_palette = array(
			array(
				'name'  => esc_html__( 'Black', 'themeslug' ),
				'slug'  => 'black',
				'color' => $black,
			),
			array(
				'name'  => esc_html__( 'Dark gray', 'themeslug' ),
				'slug'  => 'dark-gray',
				'color' => $dark_gray,
			),
			array(
				'name'  => esc_html__( 'Gray', 'themeslug' ),
				'slug'  => 'gray',
				'color' => $gray,
			),
			array(
				'name'  => esc_html__( 'Light gray', 'themeslug' ),
				'slug'  => 'light-gray',
				'color' => $light_gray,
			),
			array(
				'name'  => esc_html__( 'Green', 'themeslug' ),
				'slug'  => 'green',
				'color' => $green,
			),
			array(
				'name'  => esc_html__( 'Blue', 'themeslug' ),
				'slug'  => 'blue',
				'color' => $blue,
			),
			array(
				'name'  => esc_html__( 'Purple', 'themeslug' ),
				'slug'  => 'purple',
				'color' => $purple,
			),
			array(
				'name'  => esc_html__( 'Red', 'themeslug' ),
				'slug'  => 'red',
				'color' => $red,
			),
			array(
				'name'  => esc_html__( 'Orange', 'themeslug' ),
				'slug'  => 'orange',
				'color' => $orange,
			),
			array(
				'name'  => esc_html__( 'Yellow', 'themeslug' ),
				'slug'  => 'yellow',
				'color' => $yellow,
			),
			array(
				'name'  => esc_html__( 'White', 'themeslug' ),
				'slug'  => 'white',
				'color' => $white,
			),
		);

		/**
		 * Filters the list of custom theme colors available in the block editor.
		 *
		 * @param array $editor_color_palette List of custom theme color data sets.
		 */
		$editor_color_palette = apply_filters( 'theme_slug_filter_editor_color_palette', $editor_color_palette );

		// Add support for color palettes.
		add_theme_support(
			'editor-color-palette',
			$editor_color_palette
		);

		$editor_color_gradients = array(
			array(
				'name'     => esc_html__( 'Black to gray', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $black . ' 0%, ' . $gray . ' 100%)',
				'slug'     => 'black-to-gray',
			),
			array(
				'name'     => esc_html__( 'Purple to yellow', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
				'slug'     => 'purple-to-yellow',
			),
			array(
				'name'     => esc_html__( 'Yellow to purple', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
				'slug'     => 'yellow-to-purple',
			),
			array(
				'name'     => esc_html__( 'Green to yellow', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
				'slug'     => 'green-to-yellow',
			),
			array(
				'name'     => esc_html__( 'Yellow to green', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
				'slug'     => 'yellow-to-green',
			),
			array(
				'name'     => esc_html__( 'Red to yellow', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
				'slug'     => 'red-to-yellow',
			),
			array(
				'name'     => esc_html__( 'Yellow to red', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
				'slug'     => 'yellow-to-red',
			),
			array(
				'name'     => esc_html__( 'Purple to red', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
				'slug'     => 'purple-to-red',
			),
			array(
				'name'     => esc_html__( 'Red to purple', 'themeslug' ),
				'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
				'slug'     => 'red-to-purple',
			),
		);

		/**
		 * Filters the list of theme color gradients available in the block editor.
		 *
		 * @param array $editor_color_gradients List of custom theme color gradients data sets.
		 */
		$editor_color_gradients = apply_filters( 'theme_slug_filter_editor_color_gradients', $editor_color_gradients );

		// Overwrite default gradient presets.
		add_theme_support(
			'editor-gradient-presets',
			$editor_color_gradients
		);

		// Add custom editor font sizes.
		$base_font_size = 18; // Must match --global-fs-base.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'themeslug' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'themeslug' ),
					'size'      => 14,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'themeslug' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'themeslug' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'themeslug' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'themeslug' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'themeslug' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'themeslug' ),
					'size'      => 20,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'themeslug' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'themeslug' ),
					'size'      => 24,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'themeslug' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'themeslug' ),
					'size'      => 40,
					'slug'      => 'huge',
				),
			)
		);
	}
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

// ----------------------------------------------------------------------------------------------
// REQUIRED FILES
// Include required files
// ----------------------------------------------------------------------------------------------

require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/classes/class-theme-slug-setup.php';
require get_template_directory() . '/inc/classes/customizer/class-theme-slug-customizer.php';
require get_template_directory() . '/inc/classes/meta/class-theme-slug-meta.php';
require get_template_directory() . '/inc/classes/class-theme-slug-template-context.php';
require get_template_directory() . '/inc/dynamic-style.php';

require get_template_directory() . '/inc/classes/class-theme-slug-content-archive.php';
require get_template_directory() . '/inc/classes/class-theme-slug-content-singular.php';

// ----------------------------------------------------------------------------------------------
// REGISTER STYLES
// Register and enqueue CSS.
// ----------------------------------------------------------------------------------------------

if ( ! function_exists( 'theme_slug_front_styles' ) ) {
	/**
	 * Enqueue front styles.
	 */
	function theme_slug_front_styles() {

		$css_uri = get_template_directory_uri() . '/assets/front.css';
		$css_dir = get_template_directory() . '/assets/front.css';

		// Enqueue the main front-end styles.
		wp_enqueue_style( 'theme-slug-front-style', $css_uri, array(), theme_slug_get_asset_version( $css_dir ) );

		// RTL styles.
		wp_style_add_data( 'theme-slug-front-style', 'rtl', 'replace' );

		// Output custom css variables as inline style.
		wp_add_inline_style( 'theme-slug-front-style', theme_slug_generate_dynamic_style( 'front' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_slug_front_styles' );

if ( ! function_exists( 'theme_slug_editor_styles' ) ) {
	/**
	 * Enqueue Editor styles.
	 */
	function theme_slug_editor_styles() {

		$css_uri = get_template_directory_uri() . '/assets/editor.css';
		$css_dir = get_template_directory() . '/assets/editor.css';

		// Enqueue editor styles.
		wp_enqueue_style( 'theme-slug-editor-style', $css_uri, array(), theme_slug_get_asset_version( $css_dir ) );

		// RTL styles.
		wp_style_add_data( 'theme-slug-front-style', 'rtl', 'replace' );

		// Output custom css variables as inline style.
		wp_add_inline_style( 'theme-slug-editor-style', theme_slug_generate_dynamic_style( 'editor' ) );
	}
}
add_action( 'enqueue_block_editor_assets', 'theme_slug_editor_styles' );

// ----------------------------------------------------------------------------------------------
// REGISTER SCRIPTS
// Register and enqueue JavaScript.
// ----------------------------------------------------------------------------------------------

if ( ! function_exists( 'theme_slug_front_scripts' ) ) {
	/**
	 * Enqueue front scripts.
	 */
	function theme_slug_front_scripts() {

		// If the AMP plugin is active, return early.
		if ( theme_slug_is_amp() ) {
			return;
		}

		$js_uri = get_template_directory_uri() . '/assets/main.js';
		$js_dir = get_template_directory() . '/assets/main.js';

		wp_enqueue_script( 'theme-slug-main-script', $js_uri, array(), theme_slug_get_asset_version( $js_dir ), true );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_slug_front_scripts' );
