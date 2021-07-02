<?php
/**
 * Template part for displaying the header before block area.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$blocks = get_theme_mod( 'theme_slug_header_before_blocks', array() );

// Bail early if no reusable block to display.
if ( empty( $blocks ) ) {
	return;
}

foreach ( $blocks as $block ) {

	if ( $block && $block['id'] && '' !== $block['id'] && '' !== $block['rule'] ) {

		if ( Theme_Slug_Block_Area_Context::can_show_block_area( $block ) ) {
			?>
			<section class="block-area-header-before align-container">
				<?php
				theme_slug_the_reusable_block( $block['id'] );
				?>
			</section>
			<?php
		}
	}
}
