<?php
/**
 * Metas
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Metas' ) ) :

	/**
	 * Custom css variables class
	 */
	class Theme_Slug_Metas {

		/**
		 * Register meta fields
		 */
		public static function register_metas() {

			$post_style_sidebar_metas = apply_filters(
				'theme_slug_filter_post_style_sidebar_metas',
				array(

					// Typography.
					array(
						'id'        => '_theme_slug_meta_font_size',
						'control'   => 'range',
						'post_type' => '',
					),
				)
			);

			foreach ( $post_style_sidebar_metas as $meta ) {

				$type = 'string';
				if ( 'range' === $meta['control'] ) {
					$type = 'integer';
				}

				register_post_meta(
					$meta['post_type'],
					$meta['id'],
					array(
						'show_in_rest'      => true,
						'single'            => true,
						'type'              => $type,
						'sanitize_callback' => 'sanitize_text_field',
						'auth_callback'     => function () {
							return current_user_can( 'edit_posts' );
						},
					)
				);
			}
		}

		/**
		 * Enqueue scripts for meta fields.
		 */
		public static function enqueue_post_style_plugin_sidebar_assets() {

			if ( 'post' !== get_current_screen()->post_type && 'page' !== get_current_screen()->post_type ) {
				return;
			}

			$asset_sidebar = include( get_template_directory() . '/assets/post-style-plugin-sidebar/sidebar.asset.php' );

			wp_enqueue_script(
				'theme-slug-post-style-plugin-sidebar',
				get_template_directory_uri() . '/assets/post-style-plugin-sidebar/sidebar.js',
				$asset_sidebar['dependencies'],
				theme_slug_get_asset_version( get_template_directory() . '/assets/post-style-plugin-sidebar/sidebar.js' ),
				true
			);
			wp_set_script_translations( 'theme-slug-post-style-plugin-sidebar', 'themeslug', get_template_directory() . '/languages' );

			wp_enqueue_style(
				'theme-slug-post-style-plugin-sidebar',
				get_template_directory_uri() . '/assets/post-style-plugin-sidebar/sidebar.css',
				array( 'wp-edit-blocks' ),
				theme_slug_get_asset_version( get_template_directory() . '/assets/post-style-plugin-sidebar/sidebar.css' )
			);
		}

	}

	add_action( 'init', array( 'Theme_Slug_Metas', 'register_metas' ) );

	add_action( 'enqueue_block_editor_assets', array( 'Theme_Slug_Metas', 'enqueue_post_style_plugin_sidebar_assets' ) );

endif;
