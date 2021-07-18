<?php
/**
 * Template part for displaying the title section for a single post type.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<header class="title-section">

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php
	if ( has_excerpt() ) {
		?>
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<?php
	}

	theme_slug_the_single_post_meta();

	if ( has_post_thumbnail() && ! post_password_required() ) {
		?>

		<figure class="entry-media">
			<?php the_post_thumbnail(); ?>
		</figure><!-- .featured-media -->

		<?php
	};
	?>

</header><!-- .title-section -->
