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

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'themeslug' ); ?></a>

	<header id="masthead" class="site-header">

		<?php if ( ! empty( get_bloginfo( 'name' ) ) ) { ?>
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</p>
		<?php } ?>

		<?php
		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) :
			?>
			<p class="site-description">
				<?php echo $description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</p>
		<?php endif; ?>
	
	</header>

	<div id="content" class="site-content">
