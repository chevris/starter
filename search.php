<?php
/**
 * The template for displaying search results pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$search_results_title_prefix = theme_slug_get_archive_title_prefix();
$search_results_title = get_the_archive_title();

get_header();
?>

<?php
if ( have_posts() ) {
	?>
	<header class="title-section">
		<?php
		if ( $search_results_title_prefix ) {
			?>
			<div class="search-results-title-prefix"><?php echo wp_kses_post( wpautop( $search_results_title_prefix ) ); ?></div>
			<?php
		}
		?>
	
		<h1 class="search-results-title"><?php echo $search_results_title; // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
	</header>
	<?php
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
