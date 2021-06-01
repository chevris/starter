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
