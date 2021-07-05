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

?>

	</div><!-- #content -->

	<?php
	$blocks = get_theme_mod( 'theme_slug_footer_replace_blocks', array() );
	var_dump( $blocks );

	$has_block = false;

	if ( ! empty( $blocks ) ) {

		foreach ( $blocks as $block ) {

			if ( Theme_Slug_Block_Area::can_show_block_area( $block ) ) {
				$has_block = true;

				if ( $block['id'] && 'none' !== $block['id'] ) {
					theme_slug_the_reusable_block( $block['id'] );
				}
			}
		}
	}

	if ( ! $has_block ) {
		get_template_part( 'template-parts/footer/footer' );
	}
	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
