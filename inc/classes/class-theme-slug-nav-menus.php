<?php
/**
 * Nav menus class
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
					'top-bar' => esc_html_x( 'Top Bar', 'nav menu', 'themeslug' ),
					'drawer' => esc_html_x( 'Drawer Navigation', 'nav menu', 'themeslug' ),
				)
			);
		}

		/**
		 * Add a sub-menu dropdown icon for wp_nav_menu with `dropdown_toggles` arg.
		 *
		 * @param stdClass $args An array of arguments.
		 * @param string   $item Menu item.
		 * @param int      $depth Depth of the current menu item.
		 *
		 * @return stdClass $args An object of wp_nav_menu() arguments.
		 */
		public static function filter_nav_menu_dropdown_icon( $args, $item, $depth ) {

			if ( isset( $args->dropdown_toggles ) && $args->dropdown_toggles ) {

				if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

					$icon = theme_slug_get_svg( 'ui', 'keyboard_arrow_down', 20 );

					$args->after = sprintf(
						'<button class="dropdown-toggle">%s</button>',
						$icon
					);
				} else {
					$args->after = '';
				}
			}

			return $args;
		}

	}

	add_action( 'after_setup_theme', array( 'Theme_Slug_Nav_Menus', 'register_nav_menus' ) );
	add_action( 'nav_menu_item_args', array( 'Theme_Slug_Nav_Menus', 'filter_nav_menu_dropdown_icon' ), 10, 3 );

endif;
