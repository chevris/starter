<?php
/**
 * Custom css variables
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Custom_CSS_Variables' ) ) :

	/**
	 * Custom css variables class
	 */
	class Theme_Slug_Custom_CSS_Variables {

		/**
		 * Generate custom CSS variables.
		 *
		 * @param string|null $destination Can be "editor" or null.
		 * @param bool        $echo Echo the styles.
		 *
		 * @return string
		 */
		public static function generate_custom_css_variables( $destination = 'front', $echo = false ) {

			$css = 'editor' === $destination ? ':root .editor-styles-wrapper{' : ':root{';

			$global_font_size = Theme_Slug_Custom_Template_Context::get_context( 'typography', 'font_size' );
			$global_background_color = Theme_Slug_Custom_Template_Context::get_context( 'colors', 'background_color' );

			if ( $global_font_size ) {
				$css .= '--global-fs-base:' . $global_font_size . 'px;';
			}
			if ( $global_background_color ) {
				$css .= '--global-cl-bg:' . $global_background_color;
			}

			$css .= '}';

			if ( $echo ) {
				/**
				 * $css is included inside <style> tags and can only be interpreted as CSS on the browser.
				 * Using wp_strip_all_tags() here is sufficient escaping to avoid malicious attempts to close </style> and open a <script>.
				 */
				echo wp_strip_all_tags( $css ); // phpcs:ignore WordPress.Security.EscapeOutput
			}

			return $css;
		}

	}

endif;
