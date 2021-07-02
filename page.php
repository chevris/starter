<?php
/**
 * The template for displaying all single pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/content/singular-content', get_post_type() );

get_footer();
