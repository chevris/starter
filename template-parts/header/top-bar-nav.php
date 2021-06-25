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
?>

<nav class="top-bar-nav" role="navigation">

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
