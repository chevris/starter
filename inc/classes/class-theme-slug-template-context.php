<?php
/**
 * Template context
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Custom_Template_Context' ) ) :

	/**
	 * Template context class
	 */
	class Theme_Slug_Custom_Template_Context {

		/**
		 * Holds the context.
		 *
		 * @var array|null $context
		 */
		public static $context = null;

		/**
		 * Retrieves context data.
		 *
		 * @param string $key Data key.
		 * @param string $first_lvl First level parameter.
		 * @param string $second_lvl Second level parameter.
		 * @param string $third_lvl Third level parameter.
		 * @return mixed Context data.
		 */
		public static function get_context( $key, $first_lvl = '', $second_lvl = '', $third_lvl = '' ) {

			if ( is_null( self::$context ) ) {
				self::set_context();
			}

			if ( isset( self::$context[ $key ] ) && '' !== self::$context[ $key ] ) {
				$value = self::$context[ $key ];
			} else {
				return null;
			}

			if ( ! empty( $first_lvl ) ) {
				if ( isset( $value[ $first_lvl ] ) && '' !== $value[ $first_lvl ] ) {
					$value = $value[ $first_lvl ];
				} else {
					return null;
				}

				if ( ! empty( $second_lvl ) ) {
					if ( isset( $value[ $second_lvl ] ) && '' !== $value[ $second_lvl ] ) {
						$value = $value[ $second_lvl ];
					} else {
						return null;
					}

					if ( ! empty( $third_lvl ) ) {
						if ( isset( $value[ $third_lvl ] ) && '' !== $value[ $third_lvl ] ) {
							$value = $value[ $third_lvl ];
						} else {
							return null;
						}
					}
				}
			}

			return $value;
		}

		/**
		 * Initializes the context data used for this particular page.
		 */
		private static function set_context() {

			$typography = array(
				'font_size' => get_theme_mod( 'global_styles_typography_font_size', 18 ),
			);
			$colors = array(
				'background_color' => get_theme_mod( 'global_styles_colors_background_color', '#FFFFFF' ),
			);

			/**
			 * May be is a singular post, page and CPT.
			 */
			if ( is_singular() || is_admin() ) {
				$post_id   = get_the_ID();
				$post_type = get_post_type();

				// Check post meta.
				$post_font_size = get_post_meta( $post_id, '_theme_slug_meta_font_size', true );
				$post_background_color = get_post_meta( $post_id, '_theme_slug_meta_background_color', true );

				if ( isset( $post_font_size ) && ! empty( $post_font_size ) ) {
					$typography['font_size'] = $post_font_size;
				}
				if ( isset( $post_background_color ) && ! empty( $post_background_color ) ) {
					$colors['background_color'] = $post_background_color;
				}

				/**
				 * May be is an archive page : post and cpt archives, search results.
				 */
			} elseif ( is_archive() || is_search() || is_home() ) {

				if ( is_home() ) {
					$archive_type = 'post_archive';
					if ( ! is_front_page() ) {
						$post_id = get_option( 'page_for_posts' );
					}
				} elseif ( is_category() || is_tag() ) {
					$archive_type = 'post_archive';
				} elseif ( is_search() ) {
					$archive_type = 'search_archive';
				} else {
					$post_type  = get_post_type();
					$archive_type = $post_type . '_archive';
				}
			} elseif ( is_404() ) {
				$archive_type = '404';
			}

			$context_arr = array(
				'typography' => $typography,
				'colors'     => $colors,
			);

			self::$context = apply_filters( 'themesetup_filter_template_context', $context_arr );

		}

	}

endif;
