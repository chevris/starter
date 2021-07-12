<?php
/**
 * Medias
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Medias' ) ) :

	/**
	 * Set up class
	 */
	class Theme_Slug_Medias {

		/**
		 * Sets the $content_width in pixels, based on the theme design.
		 */
		public static function add_image_sizes() {

			add_image_size( 'themesetup-featured-image', 1200, 9999 );
		}

	}

	add_action( 'after_setup_theme', array( 'Theme_Slug_Medias', 'add_image_sizes' ) );

endif;
