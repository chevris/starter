<?php
/**
 * Template part for displaying the header before block area.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$block_id = get_theme_mod( 'theme_slug_header_before_content', 0 );

// Bail early if no reusable block to display.
if ( empty( $block_id ) ) {
	return;
}

// Retrieves the header_before block area visibility rule from customizer.
$visibility_rule = get_theme_mod(
	'theme_slug_header_before_page_visibility',
	array(
		'rule' => 'global:site',
		'select' => '',
		'sub_rule' => '',
		'sub_selection' => array(), // array of arrays ` array( array( 'value' => 1, 'label => 'uncategorized' ), array( 'value' => 20, 'label => 'val 1' ) ) `.
		'ids' => array(), // array of ids ` array( 1545, 1564 ) `.
	)
);

if ( ! Theme_Slug_Block_Area_Context::can_show_block_area( $visibility_rule ) ) {
	return;
}


$device_visibility = get_theme_mod( 'theme_slug_header_before_device_visibility', array( 'desktop', 'tablet', 'mobile' ) );

$header_before_class = array( 'header-before align-container' );

if ( ! in_array( 'desktop', $device_visibility ) ) {
	$header_before_class[] = 'desktop-vis-false';
}
if ( ! in_array( 'tablet', $device_visibility ) ) {
	$header_before_class[] = 'tablet-vis-false';
}
if ( ! in_array( 'mobile', $device_visibility ) ) {
	$header_before_class[] = 'mobile-vis-false';
}

$header_before_class = implode( ' ', $header_before_class );
?>

<section class="<?php echo esc_attr( $header_before_class ); ?>">
	
	<?php theme_slug_the_reusable_block( $block_id ); ?>

</section>
