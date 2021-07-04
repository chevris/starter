<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until header
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_Slug
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php theme_slug_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body id="body" <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php do_action( 'theme_slug_before_page' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'themeslug' ); ?></a>

	<?php do_action( 'theme_slug_header_before' ); ?>

	<?php
	$blocks = get_theme_mod( 'theme_slug_header_replace_blocks', array() );
	if ( ! empty( $blocks ) ) {
		$block_is_displayed = false;
		$should_header_display = false;

		foreach ( $blocks as $block ) {

			if ( Theme_Slug_Block_Area::can_show_block_area( $block ) ) {

				$block_is_displayed = true;
				$should_header_display = false;
				if ( 'none' !== $block['id'] ) {
					theme_slug_the_reusable_block( $block['id'] );
				}
			} else {
				if ( ! $block_is_displayed ) {
					$should_header_display = true;
				}
			}
		}

		if ( $should_header_display ) {
			do_action( 'theme_slug_header' );
		}
	} else {
		do_action( 'theme_slug_header' );
	}
	?>

	<?php do_action( 'theme_slug_header_after' ); ?>

	<div id="content" class="site-content">
