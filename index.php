<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$title_before_blocks = get_theme_mod( 'theme_slug_blog_title_section_before_blocks', array() );
$title_after_blocks = get_theme_mod( 'theme_slug_blog_title_section_after_blocks', array() );
$title_replace_blocks = get_theme_mod( 'theme_slug_blog_title_section_replace_blocks', array() );
$content_before_blocks = get_theme_mod( 'theme_slug_blog_content_before_blocks', array() );
$content_after_blocks = get_theme_mod( 'theme_slug_blog_content_after_blocks', array() );
$content_replace_blocks = get_theme_mod( 'theme_slug_blog_content_replace_blocks', array() );

get_header();
?>

<?php
Theme_Slug_Block_Area::display_block_area( $title_before_blocks );

// True if at least one title replace block is displayed on this template.
$has_title_replace_block = false;

if ( ! empty( $title_replace_blocks ) ) {

	foreach ( $title_replace_blocks as $title_replace_block ) {

		if ( Theme_Slug_Block_Area::can_show_block_area( $title_replace_block ) ) {
			$has_title_replace_block = true;

			if ( $title_replace_block['id'] && 'none' !== $title_replace_block['id'] ) {
				?>
				<section class="align-container">
					<?php
					theme_slug_the_reusable_block( $title_replace_block['id'] );
					?>
				</section>
				<?php
			}
		}
	}
}

if ( ! $has_title_replace_block ) {
	get_template_part( 'template-parts/title-section/archive-title-section' );
}

Theme_Slug_Block_Area::display_block_area( $title_after_blocks );
?>

<section id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) {

			Theme_Slug_Block_Area::display_block_area( $content_before_blocks );

			// True if at least one content replace block is displayed on this template.
			$has_content_replace_block = false;

			if ( ! empty( $content_replace_blocks ) ) {

				foreach ( $content_replace_blocks as $content_replace_block ) {

					if ( Theme_Slug_Block_Area::can_show_block_area( $content_replace_block ) ) {
						$has_content_replace_block = true;

						if ( $content_replace_block['id'] && 'none' !== $content_replace_block['id'] ) {
							?>
							<section class="align-container">
								<?php
								theme_slug_the_reusable_block( $content_replace_block['id'] );
								?>
							</section>
							<?php
						}
					}
				}
			}

			if ( ! $has_content_replace_block ) {
				$posts_layout = get_theme_mod( 'theme_slug_blog_content_posts_layout', 'classic' );
				?>
				<div class="posts">
					<div id="posts-inner" class="posts-<?php echo esc_attr( $posts_layout ); ?>">
						<?php
						// Start loop.
						$post_count = 0;
						while ( have_posts() ) {
							$post_count++;
							the_post();

							switch ( $posts_layout ) {
								case 'classic':
									get_template_part( 'template-parts/content/archive-entry-classic' );
									break;

								case 'grid':
									get_template_part( 'template-parts/content/archive-entry-grid' );
									break;

								case 'classic-grid':
									get_template_part( 'template-parts/content/archive-entry-classic' );

									if ( 1 === $post_count && ! is_paged() ) {
										get_template_part( 'template-parts/content/archive-entry-classic' );
									} else {
										get_template_part( 'template-parts/content/archive-entry-grid' );
									}
									break;
								case 'list':
									get_template_part( 'template-parts/content/archive-entry-list' );
									break;

								case 'classic-list':
									if ( 1 === $post_count && ! is_paged() ) {
										get_template_part( 'template-parts/content/archive-entry-classic' );
									} else {
										get_template_part( 'template-parts/content/archive-entry-list' );
									}
									break;
							}
						}
						?>
					</div>
				</div><!-- .posts -->
				<?php
				get_template_part( 'pagination' );
			}

			Theme_Slug_Block_Area::display_block_area( $content_after_blocks );

		}
		?>

	</main><!-- .site-main -->

</section><!-- .content-area -->

<?php
get_footer();
