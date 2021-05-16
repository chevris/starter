<?php
/**
 * Template part for displaying the archive content
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php do_action( 'theme_slug_archive_page_header' ); ?>

<section id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) {

			get_template_part( 'template-parts/content/archive-content-loop', get_post_type() );

		} else {
			get_template_part( 'template-parts/content/none' );
		}
		?>

	</main><!-- .site-main -->

</section><!-- .content-area -->

