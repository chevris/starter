<?php
/**
 * Functions which enhance the theme and hook into WordPress
 *
 * @package Theme_Slug
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function theme_slug_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'theme_slug_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array Filtered body classes.
 */
function theme_slug_filter_body_classes( $classes ) {

	// Helps detect if JS is enabled or not.
	$classes[] = 'no-js';

	// Adds `singular` to singular pages, and `hfeed` to all other pages.
	$classes[] = is_singular() ? 'singular' : 'hfeed';

	return $classes;
}
add_filter( 'body_class', 'theme_slug_filter_body_classes' );

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
