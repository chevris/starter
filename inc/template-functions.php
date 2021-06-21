<?php
/**
 * Functions which enhance the theme and hook into WordPress
 *
 * @package Theme_Slug
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
 * Retrieves reusable blocks
 *
 * @return array An array of reusable blocks
 */
function theme_slug_get_reusable_blocks() {

	$reusable_blocks = get_posts(
		array(
			'post_type'   => 'wp_block',
			'numberposts' => 100,
		)
	);

	$blocks = array();
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
 * Retrieves a reusable block object using its id.
 *
 * @param string $id The reusable block ID.
 * @return WP_Post|null reusable block post
 */
function theme_slug_get_reusable_block( $id ) {

	$wp_query_args        = array(
		'p'         => $id,
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

/**
 * Print a reusable block.
 *
 * @param string $id ID of the block to print.
 */
function theme_slug_the_reusable_block( $id ) {

	$block = theme_slug_get_reusable_block( $id );
	if ( ! $block || empty( trim( (string) $block->post_content ) ) ) {
		return;
	}
	echo do_blocks( $block->post_content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

/**
 * Retrieves public post types
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
