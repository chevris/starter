<?php
/**
 * Functions which enhance the theme and hook into WordPress
 *
 * @package Theme_Slug
 */

/*
 * theme_slug_get_version()
 * theme_slug_get_asset_version()
 * theme_slug_is_amp()
 * theme_slug_the_html_classes()
 * theme_slug_get_public_post_types()
 * theme_slug_get_excluded_public_post_types()
 * add_filter( 'get_the_archive_title_prefix', '__return_false' );
 * theme_slug_get_archive_title_prefix()
 * add_filter( 'get_the_archive_title', 'theme_slug_filter_archive_title' )
 * theme_slug_the_archive_post_meta()
 * theme_slug_the_single_post_meta()
 * theme_slug_get_post_meta()
 * theme_slug_get_post_types_with_post_meta()
 * theme_slug_get_fallback_image()
*/

/**
 * Gets the theme version.
 *
 * @return string Theme version number.
 */
function theme_slug_get_version() {
	static $theme_version = null;

	if ( null === $theme_version ) {
		$theme_version = wp_get_theme( get_template() )->get( 'Version' );
	}

	return $theme_version;
}

/**
 * Gets the version for a given asset.
 *
 * Returns filemtime when WP_DEBUG is true, otherwise the theme version.
 *
 * @param string $filepath Asset file path.
 * @return string Asset version number.
 */
function theme_slug_get_asset_version( $filepath ) {
	if ( WP_DEBUG ) {
		return (string) filemtime( $filepath );
	}

	return theme_slug_get_version();
}

/**
 * Determines whether this is an AMP response.
 *
 * Note that this must only be called after the parse_query action.
 *
 * @return bool Whether the AMP plugin is active and the current request is for an AMP endpoint.
 */
function theme_slug_is_amp() {
	return function_exists( 'is_amp_endpoint' ) && \is_amp_endpoint();
}

/**
 * Print classes for the main <html> element.
 */
function theme_slug_the_html_classes() {
	$classes = apply_filters( 'theme_slug_filter_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Retrieves public post types names
 *
 * @return array An array of public post types names
 */
function theme_slug_get_public_post_types() {

	static $post_types = null;

	if ( null === $post_types ) {
		$args = array(
			'public' => true,
			'show_in_rest' => true,
			'_builtin' => false,
		);
		$builtin = array(
			'post',
			'page',
		);
		$output = 'names'; // names or objects, note names is the default.
		$operator = 'and';
		$post_types = get_post_types( $args, $output, $operator );

		$post_types = apply_filters( 'theme_slug_filter_public_post_type', array_merge( $builtin, $post_types ) );
	}

	return $post_types;
}

/**
 * Retrieves public post types to exclude
 */
function theme_slug_get_excluded_public_post_types() {

	static $excluded_post_types = null;

	if ( null === $excluded_post_types ) {
		$excluded_post_types = array(
			'elementor_library',
		);

		$excluded_post_types = apply_filters( 'theme_slug_filter_excluded_public_post_type', $excluded_post_types );
	}

	return $excluded_post_types;
}

/**
 * Removes core archive title prefix ( handled separatly with theme_slug_get_archive_title_prefix() )
 */
add_filter( 'get_the_archive_title_prefix', '__return_false' );

/**
 * Gets a custom archive title prefix
 *
 * @return string
 */
function theme_slug_get_archive_title_prefix() {

	$prefix = '';

	if ( is_search() ) {
		$prefix = get_theme_mod( 'theme_slug_search_results_title_section_title_prefix', '' );
	} elseif ( is_category() ) {
		$prefix = esc_html_x( 'Category', 'category archive title prefix', 'themeslug' );
	} elseif ( is_tag() ) {
		$prefix = esc_html_x( 'Tag', 'tag archive title prefix', 'themeslug' );
	} elseif ( is_author() ) {
		$prefix = esc_html_x( 'Author', 'author archive title prefix', 'themeslug' );
	} elseif ( is_year() ) {
		$prefix = esc_html_x( 'Year', 'date archive title prefix', 'themeslug' );
	} elseif ( is_month() ) {
		$prefix = esc_html_x( 'Month', 'date archive title prefix', 'themeslug' );
	} elseif ( is_day() ) {
		$prefix = esc_html_x( 'Day', 'date archive title prefix', 'themeslug' );
	} elseif ( is_post_type_archive() ) {
		// No prefix for post type archives.
		$prefix = '';
	} elseif ( is_tax() ) {
		$queried_object = get_queried_object();
		if ( $queried_object ) {
			$tax    = get_taxonomy( $queried_object->taxonomy );
			$prefix = sprintf(
				/* translators: %s: Taxonomy singular name. */
				esc_html_x( '%s:', 'taxonomy term archive title prefix', 'themeslug' ),
				$tax->labels->singular_name
			);
		}
	} elseif ( is_home() && is_paged() ) {
		$prefix = esc_html_x( 'Archives', 'general archive title prefix', 'themeslug' );
	}

	return apply_filters( 'theme_slug_filter_archive_title_prefix', $prefix );
}


if ( ! function_exists( 'theme_slug_filter_archive_title' ) ) :
	/**
	 * Filters the default archive titles.
	 *
	 * @param string $title the name of the archive.
	 *
	 * @return string Archive title.
	 */
	function theme_slug_filter_archive_title( $title ) {

		if ( is_home() && ! is_paged() ) {
			$title = get_theme_mod( 'theme_slug_blog_title_section_title', '' );
		} elseif ( is_home() && is_paged() ) {
			global $wp_query;
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$max = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
			/* translators: 1: Current page number, 2: Number of pages */
			$title = sprintf( esc_html_x( 'Page %1$s of %2$s', '%1$s = Current page number, %2$s = Number of pages', 'themeslug' ), $paged, $max );
		} elseif ( is_search() ) {
			$title = '&ldquo;' . get_search_query() . '&rdquo;';
		}

		return $title;
	}
	add_filter( 'get_the_archive_title', 'theme_slug_filter_archive_title' );
endif;

/**
 * Print post meta on archive pages.
 */
function theme_slug_the_archive_post_meta() {
	global $post;

	echo theme_slug_get_post_meta( $post->ID, 'archive' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Print post meta on single posts.
 */
function theme_slug_the_single_post_meta() {
	global $post;

	echo theme_slug_get_post_meta( $post->ID, 'single' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Returns the post meta markup for a given post and context.
 *
 * @see Based on a solution in Eksell theme ( https://andersnoren.se/teman/eksell-wordpress-theme/ ) *
 * @param int    $post_id ID of the post.
 * @param string $context Whether to return the post meta for the single or archive context.
 * @return string
 */
function theme_slug_get_post_meta( $post_id, $context = 'archive' ) {

	// Current post type.
	$post_type = get_post_type( $post_id );

	// Get the list of the post types that support post meta, and only proceed if the current post type is supported.
	$post_type_has_post_meta = false;
	$post_types_with_post_meta = theme_slug_get_post_types_with_post_meta();

	foreach ( $post_types_with_post_meta as $post_type_with_post_meta => $data ) {
		if ( $post_type === $post_type_with_post_meta ) {
			$post_type_has_post_meta = true;
			break;
		}
	}

	// Bail early if the current post type can't have post meta.
	if ( ! $post_type_has_post_meta ) {
		return;
	}

	// Get the default post meta for this post type.
	$post_meta_default = isset( $post_types_with_post_meta[ $post_type ]['default'][ $context ] ) ? $post_types_with_post_meta[ $post_type ]['default'][ $context ] : array();

	// Determine the customizer setting name based on post type and context. Must be `theme_slug_post_meta_[$post_type]`, with `_single` suffix for single posts.
	$theme_mod_name = 'theme_slug_post_meta_' . $post_type;
	if ( 'single' === $context ) {
		$theme_mod_name .= '_single';
	}

	// Get the post meta for this post type from the customizer. Default to theme_slug_get_post_types_with_post_meta().
	$post_meta = get_theme_mod( $theme_mod_name, $post_meta_default );

	// Sort it if there are post meta.
	if ( $post_meta ) {

		// Set the output order of the post meta.
		$post_meta_order = array( 'author', 'date', 'categories', 'tags', 'comments', 'edit-link' );

		// post meta items added with the theme_slug_filter_post_meta_items filter will not be affected by this sorting.
		$post_meta_order = apply_filters( 'theme_slug_post_meta_order', $post_meta_order, $post_id );

		// Store any custom post meta items in a separate array, so we can append them after sorting.
		$post_meta_custom = array_diff( $post_meta, $post_meta_order );

		// Loop over the intended order, and sort $post_meta_reordered accordingly.
		$post_meta_reordered = array();
		foreach ( $post_meta_order as $i => $post_meta_name ) {
			$original_i = array_search( $post_meta_name, $post_meta );
			if ( false === $original_i ) {
				continue;
			}
			$post_meta_reordered[ $i ] = $post_meta[ $original_i ];
		}

		// Reassign the reordered post meta with custom post meta items appended, and update the indexes.
		$post_meta = array_values( array_merge( $post_meta_reordered, $post_meta_custom ) );

	}

	$post_meta = apply_filters( 'theme_slug_filter_post_meta_items', $post_meta, $post_id );

	if ( ! $post_meta ) {
		return;
	}

	$post_meta_wrapper_classes = apply_filters( 'theme_slug_filter_post_meta_wrapper_classes', array( 'post-meta-wrapper' ), $post_id, $post_meta );
	$post_meta_classes = apply_filters( 'theme_slug_filter_post_meta_classes', array( 'post-meta' ), $post_id, $post_meta );

	// Convert the class arrays to strings for output.
	$post_meta_wrapper_classes_str = implode( ' ', $post_meta_wrapper_classes );
	$post_meta_classes_str = implode( ' ', $post_meta_classes );

	// Global $theme_slug_has_meta variable to be modified in actions.
	global $theme_slug_has_meta;

	// Default it to false, to make sure we don't output an empty container.
	$theme_slug_has_meta = false;

	global $post;
	$post = get_post( $post_id ); // phpcs:ignore 
	setup_postdata( $post );

	ob_start();
	?>

	<div class="<?php echo esc_attr( $post_meta_wrapper_classes_str ); ?>">
		<ul class="<?php echo esc_attr( $post_meta_classes_str ); ?>">

		<?php
		foreach ( $post_meta as $post_meta_item ) {
			switch ( $post_meta_item ) {

				case 'date':
					$theme_slug_has_meta = true;

					$entry_time = get_the_time( get_option( 'date_format' ) );
					$entry_time_str = '<time><a href="' . get_permalink() . '">' . $entry_time . '</a></time>';

					?>
					<li class="date">
						<?php
						if ( 'single' == $context ) {
							/* translators: %s: date of the post. */
							printf( esc_html_x( 'Published %s', '%s = The date of the post', 'themeslug' ), $entry_time_str ); // phpcs:ignore WordPress.Security.EscapeOutput
						} else {
							echo $entry_time_str; // phpcs:ignore WordPress.Security.EscapeOutput
						}
						?>
					</li>
					<?php
					break;

				case 'author':
					$theme_slug_has_meta = true;
					?>
					<li class="author">
						<?php
						/* Translators: %s = author name */
						printf( esc_html_x( 'By %s', '%s = author name', 'themeslug' ), '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>' );
						?>
					</li>
					<?php
					break;

				case 'categories':
					// Determine which taxonomy to use for categories. This defaults to jetpack-portfolio-type for the jetpack-portfolio post type, and to category for posts.
					$category_taxonomy = ( 'jetpack-portfolio' === $post_type ) ? 'jetpack-portfolio-type' : 'category';

					$category_taxonomy = apply_filters( 'theme_slug_filter_post_meta_category_taxonomy', $category_taxonomy, $post_id );

					if ( ! has_term( '', $category_taxonomy, $post_id ) ) {
						break;
					}
					$theme_slug_has_meta = true;
					$prefix = ( 'single' === $context ) ? esc_html__( 'Posted in', 'themeslug' ) : esc_html__( 'In', 'themeslug' );
					?>
					<li class="categories">
						<?php the_terms( $post_id, $category_taxonomy, $prefix . ' ', ', ' ); ?>
					</li>
					<?php
					break;

				case 'comments':
					if ( post_password_required() || ! comments_open() || ! get_comments_number() ) {
						break;
					}
					$theme_slug_has_meta = true;
					?>
					<li class="comments">
						<?php comments_popup_link(); ?>
					</li>
					<?php
					break;

				case 'edit-link':
					if ( ! current_user_can( 'edit_post', $post_id ) ) {
						break;
					}
					$theme_slug_has_meta = true;
					?>
					<li class="edit">
						<a href="<?php echo esc_url( get_edit_post_link() ); ?>">
							<?php esc_html_e( 'Edit', 'themeslug' ); ?>
						</a>
					</li>
					<?php
					break;

				case 'tags':
					// Determine which taxonomy to use for tags. This defaults to jetpack-portfolio-tag for the jetpack-portfolio post type, and to post_tag for posts.
					$tag_taxonomy = ( 'jetpack-portfolio' === $post_type ) ? 'jetpack-portfolio-tag' : 'post_tag';

					$tag_taxonomy = apply_filters( 'theme_slug_filter_post_meta_tag_taxonomy', $tag_taxonomy, $post_id );

					if ( ! has_term( '', $tag_taxonomy, $post_id ) ) {
						break;
					}
					$theme_slug_has_meta = true;
					?>
					<li class="tags">
						<?php
						// Theme check workaround for missing tag output.
						if ( 'post_tag' === $tag_taxonomy ) {
							echo get_the_tag_list( esc_html__( 'Tagged', 'themeslug' ) . ' ', ', ', '', $post_id ); // phpcs:ignore WordPress.Security.EscapeOutput
						} else {
							the_terms( $post_id, $tag_taxonomy, esc_html__( 'Tagged', 'themeslug' ) . ' ', ', ' ); // phpcs:ignore WordPress.Security.EscapeOutput
						}
						?>
					</li>
					<?php
					break;

				default:
					/**
					 * Action for handling of custom post meta items.
					 *
					 * This action gets called if the post meta looped over doesn't match any of the types supported. Custom post meta type can be output here by hooking
					 * into theme_slug_filter_post_meta_[post-meta-key]. Make sure global $theme_slug_has_meta is included and set to true.
					 */
					do_action( 'theme_slug_post_meta_' . $post_meta_item, $post_id );
			}
		}
		?>
		</ul>
	</div>

	<?php
	wp_reset_postdata();

	// Get the recorded output.
	$meta_output = ob_get_clean();

	// If there is post meta, return it.
	return ( $theme_slug_has_meta && $meta_output ) ? $meta_output : '';
}

/**
 * Returns post types with post meta.
 *
 * @return array An array of post types with post meta
 */
function theme_slug_get_post_types_with_post_meta() {

	return apply_filters(
		'theme_slug_filter_post_types_with_post_meta',
		array(
			'post' => array(
				'default' => array(
					'archive' => array( 'author', 'date' ),
					'single' => array( 'author', 'date', 'edit-link' ),
				),
			),
			'jetpack-portfolio' => array(
				'default' => array(
					'archive' => array( 'author', 'date' ),
					'single' => array( 'author', 'date', 'edit-link' ),
				),
			),
		)
	);
}

/**
 * Gets a fallback image from Customizer or the theme default.
 *
 * @return string Fallback image marckup
 */
function theme_slug_get_fallback_image() {

	// If a valid fallback image is set in the Customizer, return the markup for it.
	$fallback_image_id = get_theme_mod( 'theme_slug_fallback_image' );

	if ( $fallback_image_id ) {
		$fallback_image = wp_get_attachment_image( $fallback_image_id, 'full' );
		if ( $fallback_image ) {
			return $fallback_image;
		}
	}

	// If not, return the default fallback image.
	$fallback_image_url = get_template_directory_uri() . '/assets/images/default-fallback-image.png';
	$fallback_image = '<img src="' . esc_attr( $fallback_image_url ) . '" class="fallback-featured-image fallback-image-regular" />';

	return $fallback_image;
}
