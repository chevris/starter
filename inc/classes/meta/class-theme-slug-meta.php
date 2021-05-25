<?php
/**
 * Metas
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Meta' ) ) :

	/**
	 * Custom css variables class
	 */
	class Theme_Slug_Meta {

		/**
		 * Register meta fields
		 */
		public static function register_metas() {

			register_post_meta(
				'', // Pass an empty string to register the meta key across all existing post types.
				'_theme_slug_meta_font_size',
				array(
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => 'integer',
					'auth_callback' => '__return_true',
				)
			);

			register_post_meta(
				'', // Pass an empty string to register the meta key across all existing post types.
				'_theme_slug_meta_background_color',
				array(
					'show_in_rest'  => true,
					'single'        => true,
					'type'          => 'string',
					'auth_callback' => '__return_true',
				)
			);
		}

		/**
		 * Adds custom fields support to custom post types
		 *
		 * @param array  $args Post type args.
		 * @param string $post_type Post type.
		 */
		public static function add_custom_fields_support_to_cpt( $args, $post_type ) {
			if ( is_array( $args ) && isset( $args['public'] ) && $args['public'] && isset( $args['supports'] ) && is_array( $args['supports'] ) && ! in_array( 'custom-fields', $args['supports'], true ) ) {
				$args['supports'][] = 'custom-fields';
			}

			return $args;
		}

		/**
		 * Enqueue scripts for meta fields.
		 */
		public static function enqueue_style_meta_sidebar_assets() {

			$post_type = get_post_type();
			$post_type_object = get_post_type_object( get_post_type() );
			is_object( $post_type_object ) ? $post_type_name = $post_type_object->labels->singular_name : $post_type_name = $post_type;

			$asset_meta = include( get_template_directory() . '/assets/meta.asset.php' );

			wp_enqueue_script(
				'theme-slug-meta',
				get_template_directory_uri() . '/assets/meta.js',
				$asset_meta['dependencies'],
				theme_slug_get_asset_version( get_template_directory() . '/assets/meta.js' ),
				true
			);
			wp_set_script_translations( 'theme-slug-meta', 'themeslug', get_template_directory() . '/languages' );

			$font_size = get_theme_mod( 'global_styles_typography_font_size', 18 );
			$background_color = get_theme_mod( 'global_styles_colors_background_color', '#FFFFFF' );

			wp_localize_script(
				'theme-slug-meta',
				'themeslugMetaLocalize',
				array(
					'post_type_name' => $post_type_name,
					'typography'     => array(
						'font_size' => $font_size,
					),
					'colors'         => array(
						'background_color' => $background_color,
					),
				)
			);

			wp_enqueue_style(
				'theme-slug-meta',
				get_template_directory_uri() . '/assets/meta.css',
				array( 'wp-edit-blocks' ),
				theme_slug_get_asset_version( get_template_directory() . '/assets/meta.css' )
			);
		}

	}

	add_action( 'init', array( 'Theme_Slug_Meta', 'register_metas' ) );
	add_filter( 'register_post_type_args', array( 'Theme_Slug_Meta', 'add_custom_fields_support_to_cpt' ), 20, 2 );
	add_action( 'enqueue_block_editor_assets', array( 'Theme_Slug_Meta', 'enqueue_style_meta_sidebar_assets' ) );

endif;
