<?php
/**
 * Template part for displaying the header sitewide.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<header id="masthead" class="site-header">

	<?php do_action( 'theme_slug_header_content_top' ); ?>

	<?php get_template_part( 'template-parts/header/branding' ); ?>

	<?php do_action( 'theme_slug_header_content_bottom' ); ?>

</header>
