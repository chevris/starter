<?php
/**
 * Template part for displaying the content for a singular post or page.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php
while ( have_posts() ) {
	the_post();
	?>

	<?php do_action( 'theme_slug_singular_page_header' ); ?>

	<section id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'template-parts/content/singular_entry', get_post_type() ); ?>

		</main><!-- .site-main -->

	</section><!-- .content-area -->

	<?php
}
