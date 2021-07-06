<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #page div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_Slug
 */

$before_blocks = get_theme_mod( 'theme_slug_footer_before_blocks', array() );
$after_blocks = get_theme_mod( 'theme_slug_footer_after_blocks', array() );
$replace_blocks = get_theme_mod( 'theme_slug_footer_replace_blocks', array() );
?>

	</div><!-- #content -->

	<?php Theme_Slug_Block_Area::display_block_area( $before_blocks ); ?>

	<?php
	// True if at least one block is displayed on this template.
	$has_replace_block = false;

	if ( ! empty( $replace_blocks ) ) {

		foreach ( $replace_blocks as $replace_block ) {

			if ( Theme_Slug_Block_Area::can_show_block_area( $replace_block ) ) {
				$has_replace_block = true;

				if ( $replace_block['id'] && 'none' !== $replace_block['id'] ) {
					?>
					<section class="align-container">
						<?php
						theme_slug_the_reusable_block( $replace_block['id'] );
						?>
					</section>
					<?php
				}
			}
		}
	}

	if ( ! $has_replace_block ) {
		get_template_part( 'template-parts/footer/footer' );
	}
	?>

	<?php Theme_Slug_Block_Area::display_block_area( $after_blocks ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
