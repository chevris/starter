<?php
/**
 * The template for displaying pagination
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

the_posts_pagination(
	array(
		'mid_size'           => 2,
		'prev_text'          => sprintf(
			'%s <span class="nav-prev-text">%s</span>',
			theme_slug_get_svg( 'ui', 'chevron_left', 24 ),
			__( 'Newer posts', 'themeslug' )
		),
		'next_text'          => sprintf(
			'<span class="nav-next-text">%s</span> %s',
			__( 'Older posts', 'themeslug' ),
			theme_slug_get_svg( 'ui', 'chevron_right', 24 )
		),
		'screen_reader_text' => __( 'Page navigation', 'themeslug' ),
	)
);
