<?php
/**
 * Template part for displaying grid entry in the archive loop.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$article_classes = array( 'entry', 'entry-grid' );
$article_classes = implode( ' ', $article_classes );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $article_classes ); ?>>

	<div class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
