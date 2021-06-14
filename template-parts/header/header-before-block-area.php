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

$visible_on = get_theme_mod( 'theme_slug_header_before_device_vis_2', array( 'desktop', 'tablet', 'mobile' ) );
$section_class = array( 'align-container' );

if ( ! in_array( 'desktop', $visible_on ) ) {
	$section_class[] = 'desktop-vis-false';
}
if ( ! in_array( 'tablet', $visible_on ) ) {
	$section_class[] = 'tablet-vis-false';
}
if ( ! in_array( 'mobile', $visible_on ) ) {
	$section_class[] = 'mobile-vis-false';
}

$section_class = implode( ' ', $section_class );
?>

<section class="<?php echo esc_attr( $section_class ); ?>">
	
	<?php theme_slug_the_reusable_block( $block_id ); ?>

</section>
