<?php
/**
 * Template part for displaying the header before block area.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$block_id = get_theme_mod( 'theme_slug_header_before_content', 0 );

if ( empty( $block_id ) ) {
	return;
}

$devices = get_theme_mod(
	'theme_slug_header_before_device_visibility',
	array(
		array(
			'value' => 'desktop',
			'label' => __( 'Desktop', 'themeslug' ),
		),
		array(
			'value' => 'tablet',
			'label' => __( 'Tablet', 'themeslug' ),
		),
		array(
			'value' => 'mobile',
			'label' => __( 'Mobile', 'themeslug' ),
		),
	)
);

$header_before_class = array( 'header_before align-container' );
$selected_devices = array();

foreach ( $devices as $device ) {
	$selected_devices[] = $device['value'];
}

if ( ! in_array( 'desktop', $selected_devices ) ) {
	$header_before_class[] = 'desktop-vis-false';
}
if ( ! in_array( 'tablet', $selected_devices ) ) {
	$header_before_class[] = 'tablet-vis-false';
}
if ( ! in_array( 'mobile', $selected_devices ) ) {
	$header_before_class[] = 'mobile-vis-false';
}

$header_before_class = implode( ' ', $header_before_class );
?>

<section class="<?php echo esc_attr( $header_before_class ); ?>">
	
	<?php theme_slug_the_reusable_block( $block_id ); ?>

</section>
