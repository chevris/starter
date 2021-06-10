<?php
/**
 * Nav menu
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Nav_Menus' ) ) :

	/**
	 * Nav menu class
	 */
	class Theme_Slug_Nav_Menus {

		/**
		 * Registers the navigation menus.
		 */
		public static function register_nav_menus() {
			register_nav_menus(
				array(
					'drawer' => esc_html_x( 'Drawer Navigation', 'nav menu', 'themeslug' ),
				)
			);
		}

	}

	add_action( 'after_setup_theme', array( 'Theme_Slug_Nav_Menus', 'register_nav_menus' ) );

endif;
