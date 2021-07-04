<?php
/**
 * Template part for displaying the header after block area.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$blocks = get_theme_mod(
	'theme_slug_header_after_blocks',
	array(
		array(
			'id'            => '',
			'rule'          => 'global:site',
			'select'        => 'all',
			'sub_rule'      => '',
			'sub_selection' => array(),
			'ids'           => array(),
		),
	)
);

// Bail early if no reusable block to display.
if ( 1 === count( $blocks ) && '' === $blocks[0]['id'] ) {
	return;
}
?>

<section class="block-area-header-after align-container">
	
	<?php
	foreach ( $blocks as $block ) {

		if ( $block && $block['id'] && '' !== $block['id'] && '' !== $block['rule'] ) {

			if ( Theme_Slug_Block_Area::can_show_block_area( $block ) ) {

				theme_slug_the_reusable_block( $block['id'] );
			}
		}
	}
	?>

</section>
