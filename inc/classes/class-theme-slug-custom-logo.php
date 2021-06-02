<?php
/**
 * Class for adding custom logo support.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Custom_Logo' ) ) :

	/**
	 * Custom logo class
	 */
	class Theme_Slug_Custom_Logo {

		/**
		 * Adds support for the Custom Logo feature.
		 */
		public static function add_custom_logo_support() {
			add_theme_support(
				'custom-logo',
				apply_filters(
					'theme_slug_filter_custom_logo_args',
					array(
						'flex-width'  => true,
						'flex-height' => true,
					)
				)
			);
		}

		/**
		 * Add support for logo resizing by filtering `get_custom_logo`.
		 *
		 * @param string $html The custom logo HTML.
		 * @return string Filtered custom logo HTML.
		 */
		public static function filter_get_custom_logo( $html ) {

			$size           = get_theme_mod( 'theme_slug_logo_size', 50 );
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			// set the short side minimum.
			$min = 48;

			// don't use empty() because we can still use a 0.
			if ( is_numeric( $size ) && is_numeric( $custom_logo_id ) ) {

				// we're looking for $img['width'] and $img['height'] of original image.
				$logo = wp_get_attachment_metadata( $custom_logo_id );
				if ( ! $logo ) {
					return $html;
				}

				// get the logo support size.
				$sizes = get_theme_support( 'custom-logo' );

				$logo_max_width = ( $logo['width'] > 600 ) ? 600 : $logo['width'];

				// Check for max height and width, default to image sizes if none set in theme.
				$max = array();
				$max['height'] = isset( $sizes[0]['height'] ) ? $sizes[0]['height'] : $logo['height'];
				$max['width']  = isset( $sizes[0]['width'] ) ? $sizes[0]['width'] : $logo_max_width;

				// landscape or square.
				if ( $logo['width'] >= $logo['height'] ) {
					$output = self::logo_resize_min_max(
						$logo['height'],
						$logo['width'],
						$max['height'],
						$max['width'],
						$size,
						$min
					);
					$img = array(
						'height' => $output['short'],
						'width'  => $output['long'],
					);
					// portrait.
				} elseif ( $logo['width'] < $logo['height'] ) {
					$output = self::logo_resize_min_max( $logo['width'], $logo['height'], $max['width'], $max['height'], $size, $min );
					$img    = array(
						'height' => $output['long'],
						'width'  => $output['short'],
					);
				}

				$mobile_max_width  = 175;
				$mobile_max_height = 65;

				$mobile = self::logo_small_sizes( $img['width'], $img['height'], $mobile_max_width, $mobile_max_height );

				// add the CSS.
				$css = '
				<style>
				.site-header .custom-logo {
					height: ' . $img['height'] . 'px;
					max-height: ' . $max['height'] . 'px;
					max-width: ' . $max['width'] . 'px;
					width: ' . $img['width'] . 'px;
				}

				@media (max-width: 781px) {
					.site-header .custom-logo {
						max-width: ' . $mobile['width'] . 'px;
						max-height: ' . $mobile['height'] . 'px;
					}
				}
				</style>';

				$html = $css . $html;
			}

			return $html;

		}

		/**
		 * Helper function to determine the max size of the logo.
		 *
		 * @param int $short $short.
		 * @param int $long $long.
		 * @param int $short_max $short_max.
		 * @param int $long_max $long_max.
		 * @param int $percent $percent.
		 * @param int $min $min.
		 * @return array $size
		 */
		protected static function logo_resize_min_max( $short, $long, $short_max, $long_max, $percent, $min ) {
			$ratio        = ( $long / $short );
			$max          = array();
			$max['long']  = ( $long_max >= $long ) ? $long : $long_max;
			$max['short'] = ( $short_max >= ( $max['long'] / $ratio ) ) ? floor( $max['long'] / $ratio ) : $short_max;

			$ppp = ( $max['short'] - $min ) / 100;

			$size          = array();
			$size['short'] = round( $min + ( $percent * $ppp ) );
			$size['long']  = round( $size['short'] / ( $short / $long ) );

			return $size;
		}

		/**
		 * Helper function to return smaller version of the logo size
		 *
		 * @param int $width $width.
		 * @param int $height $height.
		 * @param int $max_width $max_width.
		 * @param int $max_height $max_height.
		 * @return array
		 */
		protected static function logo_small_sizes( $width, $height, $max_width, $max_height ) {
			$size = array(
				'width'  => round( $max_height * ( $width / $height ) ),
				'height' => $max_height,
			);

			if ( $size['width'] > $max_width ) {
				$size['height'] = round( $max_width * ( $height / $width ) );
				$size['width']  = $max_width;
			}

			return $size;
		}

	}

	add_action( 'after_setup_theme', array( 'Theme_Slug_Custom_Logo', 'add_custom_logo_support' ) );
	add_filter( 'get_custom_logo', array( 'Theme_Slug_Custom_Logo', 'filter_get_custom_logo' ) );

endif;
