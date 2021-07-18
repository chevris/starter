<?php
/**
 * Template part for displaying the entry content of a singular post or page.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content align-container">

		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<nav class="post-nav-links"><div class="post-nav-links-list">',
				'after' => '</div></nav>',
			)
		);

		// Only display Jetpack post sharing on single posts.
		if ( is_single() ) {
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
		}
		?>

	</div><!-- .entry-content -->

	<div class="entry-content-below">
	
		<?php
		// Show post navigation only when the post type is 'post' or has an archive.
		if ( 'post' === get_post_type() || get_post_type_object( get_post_type() )->has_archive ) {
			get_template_part( 'template-parts/content/single-post-navigation' );
		}

		// Show comments only when the post type supports it and when comments are open or at least one comment exists.
		if ( post_type_supports( get_post_type(), 'comments' ) && ( comments_open() || get_comments_number() ) ) {
			?>
			<div class="comments-wrapper">
				<?php comments_template(); ?>
			</div><!-- .comments-wrapper -->
			<?php
		}
		?>
	
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
