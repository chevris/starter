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
	 * Theme_Slug_Medias class
	 */
	class Theme_Slug_Medias {

		/**
		 * Adds custom image sizes.
		 */
		public static function add_image_sizes() {

			add_image_size( 'themesetup-featured-image', 1200, 9999 );
		}

	}

	add_action( 'after_setup_theme', array( 'Theme_Slug_Medias', 'add_image_sizes' ) );

endif;
