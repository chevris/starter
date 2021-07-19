<?php
/**
 * Header
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Header' ) ) :

	/**
	 * Header class
	 */
	class Theme_Slug_Header {

		/**
		 * Adds custom classes to the array of body classes to indicate which header is displayed.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array Filtered body classes.
		 */
		public static function filter_body_classes( $classes ) {

			$classes[] = 'header-is-' . Theme_Slug_Template_Context::get_context( 'header', 'layout' );

			return $classes;
		}

		/**
		 * Display the header
		 */
		public static function display_header() {

			$header_before_blocks = get_theme_mod( 'theme_slug_header_before_blocks', array() );
			theme_slug_display_block_area( $header_before_blocks );

			$layout = get_theme_mod( 'theme_slug_header_layout', 'default' );
			if ( 'none' !== $layout ) {
				get_template_part( 'template-parts/header/header', 'default' !== $layout ? $layout : '' );
			}

			$header_after_blocks = get_theme_mod( 'theme_slug_header_after_blocks', array() );
			theme_slug_display_block_area( $header_after_blocks );
		}

		/**
		 * Display the drawer-header
		 */
		public static function display_header_drawer() {

			get_template_part( 'template-parts/header/drawer' );
		}

		/**
		 * Display the header after block area
		 */
		public static function display_search_modal() {
			get_template_part( 'template-parts/header/search-modal' );
		}

	}

	add_filter( 'body_class', array( 'Theme_Slug_Header', 'filter_body_classes' ) );
	add_action( 'theme_slug_header', array( 'Theme_Slug_Header', 'display_header' ) );
	add_action( 'wp_head', array( 'Theme_Slug_Header', 'display_header_drawer' ) );
	add_action( 'wp_footer', array( 'Theme_Slug_Header', 'display_search_modal' ) );

endif;
