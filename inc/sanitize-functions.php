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

/**
 * Sanitize react multi select output
 *
 * @param array $value The control's value.
 * @return array
 */
function theme_slug_sanitize_react_multi_select( $value ) {

	$valid_ids = array( 'value', 'label' );

	// Make sure $value an array.
	$value = ( ! is_array( $value ) ) ? array() : $value;

	foreach ( $value as $row_id => $row_value ) {

		// Make sure the row is formatted as an array.
		if ( ! is_array( $row_value ) ) {
			$value[ $row_id ] = array();
			continue;
		}

		// Start parsing sub-fields in rows.
		foreach ( $row_value as $subfield_id => $subfield_value ) {

			// Make sure this is a valid id. If it's not, then unset it.
			if ( ! in_array( $subfield_id, $valid_ids ) ) {
				unset( $value[ $row_id ][ $subfield_id ] );
			} else {
				$value[ $row_id ][ $subfield_id ] = sanitize_text_field( $subfield_value );
			}
		}
	}

	return $value;
}
