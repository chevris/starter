<?php
/**
 * Set up
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Setup' ) ) :

	/**
	 * Set up class
	 */
	class Theme_Slug_Setup {

		/**
		 * Sets the $content_width in pixels, based on the theme design.
		 *
		 * $content_width variable defines the maximum allowed width for images,
		 * videos, and oEmbeds displayed within a theme.
		 *
		 * @global int $content_width
		 */
		public static function content_width() {

			$content_width = absint( get_theme_mod( 'theme_slug_wide_content_width', 1240 ) );

			$GLOBALS['content_width'] = absint(
				/**
				 * Filters WordPress $content_width global variable.
				 *
				 * @param  int $content_width
				 */
				apply_filters( 'theme_slug_filter_content_width', $content_width )
			);
		}

		/**
		 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
		 */
		public static function pingback_header() {
			if ( is_singular() && pings_open() ) {
				echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
			}
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array Filtered body classes.
		 */
		public static function body_classes( $classes ) {

			// Helps detect if JS is enabled or not.
			$classes[] = 'no-js';

			// Adds `singular` to singular pages, and `hfeed` to all other pages.
			$classes[] = is_singular() ? 'singular' : 'hfeed';

			return $classes;
		}

		/**
		 * Remove the `no-js` class from body if JS is supported.
		 */
		public static function js_support() {
			echo '<script>document.body.classList.remove("no-js");</script>';
		}

	}

	add_action( 'after_setup_theme', array( 'Theme_Slug_Setup', 'content_width' ) );
	add_action( 'wp_head', array( 'Theme_Slug_Setup', 'pingback_header' ) );
	add_action( 'body_class', array( 'Theme_Slug_Setup', 'body_classes' ) );
	add_action( 'wp_footer', array( 'Theme_Slug_Setup', 'js_support' ) );

endif;
