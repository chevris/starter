<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>
<?php
while ( have_posts() ) {
	the_post();
	?>

	<?php get_template_part( 'template-parts/title-section/title-section', get_post_type() ); ?>

	<section id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'template-parts/content/singular_entry', get_post_type() ); ?>

		</main><!-- .site-main -->

	</section><!-- .content-area -->

	<?php
}
?>

<?php
get_footer();
