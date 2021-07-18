<?php
/**
 * Jetpack integration
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Jetpack' ) ) :

	/**
	 * Theme_Slug_Jetpack class
	 */
	class Theme_Slug_Jetpack {

		/**
		 * Adds theme support for the Jetpack plugin.
		 */
		public static function add_jetpack_support() {

			/**
			 * Add theme support for Infinite Scroll.
			 *
			 * @see https://jetpack.com/support/infinite-scroll/
			 * @todo There is a conflict between Jetpack Infinite scroll and amp plugin. That's why infinite scroll support
			 *       is disabled when Amp plugin is active.
			 * @see https://github.com/Automattic/newspack-theme/issues/1108
			 */
			if ( ! function_exists( 'is_amp_endpoint' ) ) {
				add_theme_support(
					'infinite-scroll',
					array(
						'container' => 'posts-inner',
						'footer'    => 'page',
						'wrapper'   => false,
						'render'    => array( 'Theme_Slug_Jetpack', 'jetpack_infinite_scroll_render' ),
					)
				);
			}
		}

		/**
		 * Render function for Infinite Scroll.
		 */
		public static function jetpack_infinite_scroll_render() {

			if ( is_home() ) {
				$layout = get_theme_mod( 'theme_slug_blog_content_posts_layout', 'classic' );
			} else {
				$layout = get_theme_mod( 'theme_slug_archives_content_posts_layout', 'classic' );
			}

			while ( have_posts() ) {
				the_post();

				if ( 'grid' === $layout || 'classic-grid' == $layout ) {
					get_template_part( 'template-parts/content/archive-entry-grid' );
				} elseif ( 'list' === $layout || 'classic-list' == $layout ) {
					get_template_part( 'template-parts/content/archive-entry-list' );
				} else {
					get_template_part( 'template-parts/content/archive-entry-classic' );
				}
			}
		}

		/**
		 * Custom Filter to replace footer credits for JetPack Infinite Scroll.
		 *
		 * @param string $credit Jetpack default credit string.
		 */
		public function infinite_scroll_footer_credit( $credit ) {

			return '';

		}

		/**
		 * Remove Jetpack Share icons from standard location.
		 */
		public static function remove_jetpack_share() {

			remove_filter( 'the_excerpt', 'sharing_display', 19 );
			remove_filter( 'the_content', 'sharing_display', 19 );
		}

	}

	add_action( 'after_setup_theme', array( 'Theme_Slug_Jetpack', 'add_jetpack_support' ) );
	add_filter( 'infinite_scroll_credit', array( 'Theme_Slug_Jetpack', 'infinite_scroll_footer_credit' ) );
	add_filter( 'loop_start', array( 'Theme_Slug_Jetpack', 'remove_jetpack_share' ) );

endif;
