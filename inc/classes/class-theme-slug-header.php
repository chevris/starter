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
		 * Display the header
		 */
		public static function display_header() {
			get_template_part( 'template-parts/header/header' );
		}

	}

	add_action( 'theme_slug_header', array( 'Theme_Slug_Header', 'display_header' ) );

endif;
