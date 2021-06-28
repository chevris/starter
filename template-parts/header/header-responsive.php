<?php
/**
 * Template part for displaying the header responsive.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<header id="masthead" class="site-header top-bar">

	<div class="top-bar-inner">

		<?php get_template_part( 'template-parts/header/branding' ); ?>

		<?php get_template_part( 'template-parts/header/responsive-navigation' ); ?>

	</div>

</header>
