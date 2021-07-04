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
		 * Retrieves all page visibility choices.
		 *
		 * @return array Page visibility choices
		 */
		public static function get_page_visibility_choices() {

			$choices_global = array(
				array(
					'label' => esc_attr__( 'General', 'themeslug' ),
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
			$choices_singular = array();

			/* phpcs:disable ---WIP
			foreach ( $public_post_types as $post_type ) {
				$post_type_obj  = get_post_type_object( $post_type );
				$post_type_name  = $post_type_obj->name;
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
								'label' => sprintf( esc_attr__( '%1$s Archives', 'themeslug' ), $taxonomy->labels->singular_name ),
							);
						}
					}
					if ( ! empty( $post_type_obj->has_archive ) ) {
						$post_type_options[] = array(
							'value' => 'post_type_archive:' . $post_type_name,
							'label' => sprintf( esc_attr__( '%1$s Archive', 'themeslug' ), $post_type_label_plural ),
						);
					}

					$choices_singular[] = array(
						'label' => $post_type_label,
						'options' => $post_type_options,
					);
				}
			}
			phpcs:enable */

			$choices = array_merge( $choices_global, $choices_singular );
			return apply_filters( 'theme_slug_filter_page_visibility_choices', $choices );

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
