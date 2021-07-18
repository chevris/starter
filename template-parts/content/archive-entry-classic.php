<?php
/**
 * Template part for displaying classic entry in the archive loop.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$article_classes = array( 'archive-entry', 'archive-entry-classic' );
$article_classes = implode( ' ', $article_classes );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $article_classes ); ?>>

	<?php
	$fallback_image_enabled = true;
	$fallback_image = theme_slug_get_fallback_image();

	if ( ( has_post_thumbnail() && ! post_password_required() ) || ( $fallback_image_enabled && $fallback_image ) ) {
		?>

		<figure class="archive-entry-media">
			<a href="<?php the_permalink(); ?>" class="archive-entry-media-link">
				<?php
				if ( has_post_thumbnail() && ! post_password_required() ) {
					the_post_thumbnail( 'themesetup-featured-image' );
				} elseif ( $fallback_image_enabled && $fallback_image ) {
					echo $fallback_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</a>
		</figure>

		<?php
	}
	?>

	<div class="archive-entry-header">
		<?php the_title( '<h2 class="archive-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div>

	<?php theme_slug_the_archive_post_meta(); ?>

</article><!-- #post-<?php the_ID(); ?> -->
