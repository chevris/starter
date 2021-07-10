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


<?php //phpcs:disable

// var_dump( Theme_Slug_Block_Area::get_current_page_conditions() );

//phpcs:enable?>

<?php do_action( 'theme_slug_before_page' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'themeslug' ); ?></a>

	<?php
	$header_before_blocks = get_theme_mod( 'theme_slug_header_before_blocks', array() );
	Theme_Slug_Block_Area::display_block_area( $header_before_blocks );
	?>

	<?php do_action( 'theme_slug_header' ); ?>

	<?php
	$header_after_blocks = get_theme_mod( 'theme_slug_header_after_blocks', array() );
	Theme_Slug_Block_Area::display_block_area( $header_after_blocks );
	?>

	<div id="content" class="site-content">
