<?php
/**
 * The template for displaying 404 page
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<section id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<div class="error404-inner">

			<h1 class="archive-title"><?php esc_html_e( 'Page Not Found', 'themeslug' ); ?></h1>
				
			<p>
				<?php
				/* translators: 1: Opening tag for front page link, 2: Closing tag for front page link */
				printf( esc_html_x( 'The page you are looking for could not be found. It might have been deleted, renamed, or it did not exist in the first place. You can search the site with the form below, or return to the %1$sfront page%2$s.', '$1%s = Opening tag for front page link, $2%s = Closing tag for front page link', 'themeslug' ), '<a href="' . esc_url( home_url() ) . '">', '</a>' );
				?>
			</p>

			<?php get_search_form(); ?>

		</div><!-- .error404-inner -->

	</main><!-- .site-main -->

</section><!-- .content-area -->

<?php
get_footer();
