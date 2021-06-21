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

			$classes[] = 'has-' . Theme_Slug_Template_Context::get_context( 'header', 'layout' );

			return $classes;
		}

		/**
		 * Display the header
		 */
		public static function display_header() {

			$layout = Theme_Slug_Template_Context::get_context( 'header', 'layout' );
			get_template_part( 'template-parts/header/' . $layout );
		}

		/**
		 * Display the header before block area
		 */
		public static function display_header_before_block_area() {
			get_template_part( 'template-parts/header/header-before-block-area' );
		}

		/**
		 * Display the header after block area
		 */
		public static function display_header_after_block_area() {
			get_template_part( 'template-parts/header/header-after-block-area' );
		}

	}

	add_filter( 'body_class', array( 'Theme_Slug_Header', 'filter_body_classes' ) );
	add_action( 'theme_slug_header', array( 'Theme_Slug_Header', 'display_header' ) );
	add_action( 'theme_slug_header_before', array( 'Theme_Slug_Header', 'display_header_before_block_area' ) );
	add_action( 'theme_slug_header_after', array( 'Theme_Slug_Header', 'display_header_after_block_area' ) );

endif;
