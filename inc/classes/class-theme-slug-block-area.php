<?php
/**
 * Block area context
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Theme_Slug_Block_Area' ) ) :

	/**
	 * Block area context class
	 */
	class Theme_Slug_Block_Area {

		/**
		 * Holds the current page conditions.
		 *
		 * @var array|null $current_page_conditions
		 */
		private static $current_page_conditions = null;

		/**
		 * Retrieves reusable blocks
		 *
		 * @return array An array of reusable blocks
		 */
		public static function get_reusable_blocks() {

			$reusable_blocks = get_posts(
				array(
					'post_type'   => 'wp_block',
					'numberposts' => 100,
				)
			);

			$blocks = array(
				array(
					'value' => 'none',
					'label' => __( 'None', 'themeslug' ),
				),
			);
			foreach ( $reusable_blocks as $block ) {
				$choice = array(
					'value' => $block->ID,
					'label' => $block->post_title,
				);
				$blocks[] = $choice;
			}

			return $blocks;
		}

		/**
		 * Retrieves site visibility choices.
		 *
		 * @return array Visibility choices
		 */
		public static function get_site_visibility_choices() {

			$choices_global = array(
				array(
					'label' => esc_attr__( 'Global', 'themeslug' ),
					'options' => array(
						array(
							'value' => 'global:site',
							'label' => esc_attr__( 'Entire Site', 'themeslug' ),
						),
						array(
							'value' => 'global:front_page',
							'label' => esc_attr__( 'Front Page', 'themeslug' ),
						),
						array(
							'value' => 'global:home',
							'label' => esc_attr__( 'Blog Page', 'themeslug' ),
						),
						array(
							'value' => 'global:search',
							'label' => esc_attr__( 'Search Results', 'themeslug' ),
						),
						array(
							'value' => 'global:404',
							'label' => esc_attr__( 'Not Found (404)', 'themeslug' ),
						),
						array(
							'value' => 'global:singular',
							'label' => esc_attr__( 'All Singular', 'themeslug' ),
						),
						array(
							'value' => 'global:archive',
							'label' => esc_attr__( 'All Archives', 'themeslug' ),
						),
						array(
							'value' => 'global:author',
							'label' => esc_attr__( 'Author Archives', 'themeslug' ),
						),
						array(
							'value' => 'global:date',
							'label' => esc_attr__( 'Date Archives', 'themeslug' ),
						),
					),
				),
			);

			$public_post_types = theme_slug_get_public_post_types();
			$excluded_post_types = theme_slug_get_excluded_public_post_types();
			$choices_types = array();

			foreach ( $public_post_types as $post_type ) {

				$post_type_obj = get_post_type_object( $post_type );

				$post_type_name = $post_type_obj->name;
				$post_type_label = $post_type_obj->label;
				$post_type_label_plural = $post_type_obj->labels->name;

				if ( ! in_array( $post_type_name, $excluded_post_types, true ) ) {

					$post_type_options = array(
						array(
							'value' => 'singular:' . $post_type_name,
							'label' => esc_attr__( 'Single', 'themeslug' ) . ' ' . $post_type_label_plural,
						),
					);

					$post_type_tax_objects = get_object_taxonomies( $post_type, 'objects' );
					foreach ( $post_type_tax_objects as $taxonomy_slug => $taxonomy ) {

						if ( $taxonomy->public && $taxonomy->show_ui && 'post_format' !== $taxonomy_slug ) {

							$post_type_options[] = array(
								'value' => 'tax_archive:' . $taxonomy_slug,
								/* translators: %s: taxonomy archive sufix. */
								'label' => sprintf( esc_attr__( '%1$s Archives', 'themeslug' ), $taxonomy->labels->singular_name ),
							);
						}
					}

					if ( ! empty( $post_type_obj->has_archive ) ) {
						$post_type_options[] = array(
							'value' => 'post_type_archive:' . $post_type_name,
							// 'Latest $post_type_label' or '$post_type_label archive page' might be better.
							/* translators: %s: post type archive sufix. */
							'label' => sprintf( esc_attr__( '%1$s Archive', 'themeslug' ), $post_type_label_plural ),
						);
					}

					$choices_types[] = array(
						'label' => $post_type_label,
						'options' => $post_type_options,
					);
				}
			}

			$choices = array_merge( $choices_global, $choices_types );
			return apply_filters( 'theme_slug_filter_site_visibility_choices', $choices );

		}

		/**
		 * Retrieves visibility choices for archives.
		 *
		 * @return array Visibility choices
		 */
		public static function get_archive_visibility_choices() {

			$choices_global = array(
				array(
					'label' => esc_attr__( 'Global', 'themeslug' ),
					'options' => array(
						array(
							'value' => 'global:archive',
							'label' => esc_attr__( 'All Archives', 'themeslug' ),
						),
						array(
							'value' => 'global:author',
							'label' => esc_attr__( 'Author Archives', 'themeslug' ),
						),
						array(
							'value' => 'global:date',
							'label' => esc_attr__( 'Date Archives', 'themeslug' ),
						),
					),
				),
			);

			$public_post_types = theme_slug_get_public_post_types();
			$excluded_post_types = theme_slug_get_excluded_public_post_types();
			$choices_types = array();

			foreach ( $public_post_types as $post_type ) {

				$post_type_obj = get_post_type_object( $post_type );

				$post_type_name = $post_type_obj->name;
				$post_type_label = $post_type_obj->label;
				$post_type_label_plural = $post_type_obj->labels->name;

				if ( ! in_array( $post_type_name, $excluded_post_types, true ) ) {

					$post_type_options = array();

					$post_type_tax_objects = get_object_taxonomies( $post_type, 'objects' );
					foreach ( $post_type_tax_objects as $taxonomy_slug => $taxonomy ) {

						if ( $taxonomy->public && $taxonomy->show_ui && 'post_format' !== $taxonomy_slug ) {

							$post_type_options[] = array(
								'value' => 'tax_archive:' . $taxonomy_slug,
								/* translators: %s: taxonomy archive sufix. */
								'label' => sprintf( esc_attr__( '%1$s Archives', 'themeslug' ), $taxonomy->labels->singular_name ),
							);
						}
					}

					if ( ! empty( $post_type_obj->has_archive ) ) {
						$post_type_options[] = array(
							'value' => 'post_type_archive:' . $post_type_name,
							// 'Latest $post_type_label' or '$post_type_label archive page' might be better.
							/* translators: %s: post type archive sufix. */
							'label' => sprintf( esc_attr__( '%1$s Archive', 'themeslug' ), $post_type_label_plural ),
						);
					}

					$choices_types[] = array(
						'label' => $post_type_label,
						'options' => $post_type_options,
					);
				}
			}

			$choices = array_merge( $choices_global, $choices_types );
			return apply_filters( 'theme_slug_filter_archive_visibility_choices', $choices );

		}

		/**
		 * Retrieves visibility choices for singular.
		 *
		 * @return array Visibility choices
		 */
		public static function get_singular_visibility_choices() {

			$choices_global = array(
				array(
					'label' => esc_attr__( 'Global', 'themeslug' ),
					'options' => array(
						array(
							'value' => 'global:singular',
							'label' => esc_attr__( 'All Singular', 'themeslug' ),
						),
					),
				),
			);

			$public_post_types = theme_slug_get_public_post_types();
			$excluded_post_types = theme_slug_get_excluded_public_post_types();
			$choices_types = array();

			foreach ( $public_post_types as $post_type ) {

				$post_type_obj = get_post_type_object( $post_type );

				$post_type_name = $post_type_obj->name;
				$post_type_label = $post_type_obj->label;
				$post_type_label_plural = $post_type_obj->labels->name;

				if ( ! in_array( $post_type_name, $excluded_post_types, true ) ) {

					$post_type_options = array(
						array(
							'value' => 'singular:' . $post_type_name,
							'label' => esc_attr__( 'Single', 'themeslug' ) . ' ' . $post_type_label_plural,
						),
					);

					$choices_types[] = array(
						'label' => $post_type_label,
						'options' => $post_type_options,
					);
				}
			}

			$choices = array_merge( $choices_global, $choices_types );
			return apply_filters( 'theme_slug_filter_singular_visibility_choices', $choices );

		}

		/**
		 * Gets the current front end page conditions.
		 *
		 * @return array $current_page_conditions
		 */
		public static function get_current_page_conditions() {

			if ( is_null( self::$current_page_conditions ) ) {

				// All site pages have this condition.
				$conditions = array( 'global:site' );

				// Front page additional conditions (can be singular page or latest posts page).
				if ( is_front_page() ) {
					$conditions[] = 'global:front_page';
				}

				// Latest posts page additional conditions (can be considered as an archive page).
				if ( is_home() ) {
					$conditions[] = 'global:home';
					$conditions[] = 'global:archive';
					$conditions[] = 'post_type_archive:post';

					// Search page additional conditions.
				} elseif ( is_search() ) {
					$conditions[] = 'global:search';

					// 404 page additional conditions.
				} elseif ( is_404() ) {
					$conditions[] = 'global:404';

					// Singular pages additional conditions.
				} elseif ( is_singular() ) {
					$conditions[] = 'global:singular';
					$conditions[] = 'singular:' . get_post_type();

					// Archive pages additional conditions.
				} elseif ( is_archive() ) {
					$queried_obj = get_queried_object();
					$conditions[] = 'global:archive';

						// Specific post type archive page additional conditions.
					if ( is_post_type_archive() && is_object( $queried_obj ) ) {
						$conditions[] = 'post_type_archive:' . $queried_obj->name;

						// Specific taxonomy archive page additional conditions.
					} elseif ( is_tax() || is_category() || is_tag() ) {
						if ( is_object( $queried_obj ) ) {
							$conditions[] = 'tax_archive:' . $queried_obj->taxonomy;
						}

						// Date archive page additional conditions.
					} elseif ( is_date() ) {
						$conditions[] = 'global:date';

						// Author archive page additional conditions.
					} elseif ( is_author() ) {
						$conditions[] = 'global:author';
					}
				}

				self::$current_page_conditions = $conditions;

			}
			return self::$current_page_conditions;

		}

		/**
		 * Tests if any of a post's assigned term are descendants of target term
		 *
		 * @param string $term_id The term id.
		 * @param string $tax The target taxonomy slug.
		 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
		 */
		public static function post_is_in_descendant_term( $term_id, $tax ) {
			$descendants = get_term_children( (int) $term_id, $tax );
			if ( ! is_wp_error( $descendants ) && is_array( $descendants ) ) {
				foreach ( $descendants as $child_id ) {
					if ( has_term( $child_id, $tax ) ) {
						return true;
					}
				}
			}
			return false;
		}

		/**
		 * Determines whether the block area can be displayed on this page.
		 *
		 * @param array $block An array representation of a block with rules from customizer settings.
		 * @return boolean True if the block area can be displayed on this page.
		 */
		public static function can_show_block_area( $block ) {

			$show = false;
			$current_page_conditions = self::get_current_page_conditions();

			if ( isset( $block['rule'] ) && in_array( $block['rule'], $current_page_conditions ) ) {

				$rule_parts = explode( ':', $block['rule'], 2 );

				if ( in_array( $rule_parts[0], array( 'singular', 'tax_archive' ) ) ) {

					if ( ! isset( $block['select'] ) || isset( $block['select'] ) && 'all' === $block['select'] ) {
						$show = true;
					} else if ( isset( $block['select'] ) && 'author' === $block['select'] ) {
						if ( isset( $block['sub_rule'] ) && get_post_field( 'post_author', get_queried_object_id() ) === $block['sub_rule'] ) {
							$show = true;
						}
					} else if ( isset( $block['select'] ) && 'tax' === $block['select'] ) {
						if ( isset( $block['sub_rule'] ) && isset( $block['sub_selection'] ) && is_array( $block['sub_selection'] ) ) {
							foreach ( $block['sub_selection'] as $sub_select_key => $sub_selection ) {
								if ( has_term( $sub_selection['value'], $block['sub_rule'] ) ) {
									$show = true;
								} elseif ( self::post_is_in_descendant_term( $sub_selection['value'], $block['sub_rule'] ) ) {
									$show = true;
								}
							}
						}
					} else if ( isset( $block['select'] ) && 'ids' === $block['select'] ) {
						if ( isset( $block['ids'] ) && is_array( $block['ids'] ) ) {
							foreach ( $block['ids'] as $key => $id ) {
								if ( get_the_ID() === $id ) {
									$show = true;
								}
							}
						}
					} else if ( isset( $block['select'] ) && 'individual' === $block['select'] ) {
						if ( isset( $block['sub_selection'] ) && is_array( $block['sub_selection'] ) ) {
							$queried_obj = get_queried_object();
							$selected_taxs   = array();
							foreach ( $block['sub_selection'] as $sub_select_key => $sub_selection ) {
								if ( isset( $sub_selection['value'] ) && ! empty( $sub_selection['value'] ) ) {
									$selected_taxs[] = $sub_selection['value'];
								}
							}
							if ( in_array( $queried_obj->term_id, $selected_taxs ) ) {
								$show = true;
							}
						}
					}
				} else {
					$show = true;
				}
			}

			return $show;

		}

	}

endif;

if ( ! function_exists( 'theme_slug_display_block_area' ) ) :

	/**
	 * Display blocks of a block area.
	 *
	 * @param array $blocks An array of blocks to display in this block area.
	 */
	function theme_slug_display_block_area( $blocks ) {

		// Bail early if no block block to display.
		if ( empty( $blocks ) ) {
			return;
		}

		foreach ( $blocks as $block ) {

			if ( Theme_Slug_Block_Area::can_show_block_area( $block ) ) {

				if ( $block['id'] && 'none' !== $block['id'] && is_numeric( $block['id'] ) ) {
					?>
					<section class="align-container">
						<?php
						theme_slug_the_reusable_block( $block['id'] );
						?>
					</section>
					<?php
				}
			}
		}
	}
endif;

if ( ! function_exists( 'theme_slug_the_reusable_block' ) ) :

	/**
	 * Print a reusable block.
	 *
	 * @param int $id ID of the reusable block to print.
	 */
	function theme_slug_the_reusable_block( $id ) {

		$reusable_block_id = (int) $id;

		$reusable_block = get_post( $reusable_block_id );

		if ( ! $reusable_block || empty( trim( (string) $reusable_block->post_content ) ) ) {
			return;
		}

		// Note: Similar to WP-Core. Using wp_kses_post inside the contents here is safe.
		echo do_blocks( wp_kses_post( $reusable_block->post_content ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;


/**
 * Depricated functions
 */

if ( ! function_exists( 'theme_slug_the_reusable_block_depricated' ) ) :

	/**
	 * Print a reusable block.
	 *
	 * @param int $id ID of the reusable block to print.
	 */
	function theme_slug_the_reusable_block_depricated( $id ) {

		$block = theme_slug_get_reusable_block( $id );
		if ( ! $block || empty( trim( (string) $block->post_content ) ) ) {
			return;
		}
		echo do_blocks( $block->post_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'theme_slug_get_reusable_block_depricated' ) ) :

	/**
	 * Retrieves a reusable block object using its id.
	 *
	 * @param int $id The reusable block ID.
	 * @return WP_Post|null reusable block post
	 */
	function theme_slug_get_reusable_block_depricated( $id ) {

		$wp_query_args        = array(
			'p'         => (int) $id,
			'post_type' => 'wp_block',
		);

		$reusable_block_query = new WP_Query( $wp_query_args );
		$posts               = $reusable_block_query->get_posts();

		if ( count( $posts ) > 0 ) {
			$post = $posts[0];

			if ( ! is_wp_error( $post ) ) {
				return $post;
			}
		}

		return null;
	}
endif;
