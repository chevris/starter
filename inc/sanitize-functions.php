<?php
/**
 * Functions used for sanitization
 *
 * @package Theme_Slug
 */

/**
 * Sanitize icon checkbox output.
 *
 * @param array $values values to be sanitized.
 * @return array
 */
function theme_slug_sanitize_icon_checkbox( $values ) {
	foreach ( $values as $key => $value ) {
		$values[ $key ] = ( ( isset( $value ) && true === $value ) ? true : false );
	}
	return $values;
}
/**
 * Sanitize multi select output
 *
 * @param string|array $values The control's values.
 * @return array
 */
function theme_slug_sanitize_multi_select( $values ) {
	$values = ( ! is_array( $values ) ) ? explode( ',', $values ) : $values;
	return ( ! empty( $values ) ) ? array_map( 'sanitize_text_field', $values ) : array();
}

