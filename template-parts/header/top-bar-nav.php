<?php
/**
 * Template part for displaying the top-bar navigation.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Bail early if no top bar menu.
if ( ! has_nav_menu( 'top-bar' ) ) {
	return;
}

$device_visibility = get_theme_mod( 'theme_slug_header_top_bar_nav_device_visibility', array( 'desktop' ) );

$top_bar_class = array( 'top-bar-nav' );

if ( ! in_array( 'desktop', $device_visibility ) ) {
	$top_bar_class[] = 'desktop-vis-false';
}
if ( ! in_array( 'tablet', $device_visibility ) ) {
	$top_bar_class[] = 'tablet-vis-false';
}
if ( ! in_array( 'mobile', $device_visibility ) ) {
	$top_bar_class[] = 'mobile-vis-false';
}

$top_bar_class = implode( ' ', $top_bar_class );
?>

<nav class="<?php echo esc_attr( $top_bar_class ); ?>" role="navigation">

	<?php
	// Top-bar menu is 1 level only for now.
	$is_dropdown = false;
	$dropdown_class = $is_dropdown ? ' is-dropdown' : '';

	$args = array(
		'theme_location'   => 'top-bar',
		'container'        => false,
		'menu_class'       => 'menu horizontal-menu' . $dropdown_class,
		'items_wrap'       => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'dropdown_toggles' => $is_dropdown,
		'depth'            => $is_dropdown ? 0 : 1,
	);

	wp_nav_menu( $args );
	?>

</nav><!-- .top-bar-nav -->
