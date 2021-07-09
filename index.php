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

get_header();
?>

<?php
if ( have_posts() ) {

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
}
?>

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

<?php
get_footer();
