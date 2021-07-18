<?php
/**
 * Template part for displaying single post navigation.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$show_feat_img = false;

$nav = array();
$nav['prev'] = get_previous_post();
$nav['next'] = get_next_post();

if ( ! ( $nav['prev'] || $nav['next'] ) ) {
	return;
}

$nav_element_class = ( $nav['prev'] && $nav['next'] ) ? ' has-both' : ( ! $nav['prev'] ? ' only-next' : ( ! $nav['next'] ? ' only-prev' : '' ) );
$nav_feat_img_class = $show_feat_img ? ' has-feat-img' : ' no-feat-img';
?>

<nav class="single-nav<?php echo esc_attr( $nav_element_class ); ?><?php echo esc_attr( $nav_feat_img_class ); ?>">

	<div class="single-nav-grid">

		<?php
		foreach ( $nav as $slug => $nav_post ) {

			if ( ! $nav_post ) {
				continue;
			}

			$fallback_image_enabled = true;
			$fallback_image = theme_slug_get_fallback_image();
			$has_media = ( $show_feat_img && has_post_thumbnail( $nav_post->ID ) && ! post_password_required( $nav_post->ID ) ) || ( $show_feat_img && $fallback_image_enabled && $fallback_image );

			$icon = ( 'prev' == $slug ) ? 'arrow_left' : 'arrow_right';

			$link_classes = ' ' . $slug . '-post';
			$link_classes .= $has_media ? ' has-media' : ' no-media';
			?>

			<div class="col">

				<a class="single-nav-item<?php echo esc_attr( $link_classes ); ?>" href="<?php echo esc_url( get_permalink( $nav_post->ID ) ); ?>">

					<figure class="single-nav-item-media">

						<?php
						if ( $has_media ) {
							if ( has_post_thumbnail( $nav_post->ID ) && ! post_password_required( $nav_post->ID ) ) {
								echo get_the_post_thumbnail( $nav_post->ID, 'themesetup-featured-image' );
							} else {
								echo $fallback_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
						}
						?>

						<div class="arrow">
							<?php theme_slug_the_svg( 'ui', $icon, 80 ); ?>
						</div><!-- .arrow -->

					</figure><!-- .single-nav-item-media -->

					<?php
					$nav_post_title = get_the_title( $nav_post->ID );
					if ( $nav_post_title ) {
						?>

						<header class="single-nav-item-header">
							<h3 class="single-nav-item-title">
								<?php echo esc_html( $nav_post_title ); ?>
							</h3><!-- .single-nav-item-title -->
						</header><!-- .single-nav-item-header -->

						<?php
					};
					?>

				</a>

			</div>
			<?php
		};
		?>

	</div><!-- .single-nav-grid -->
	
</nav><!-- .single-nav -->
