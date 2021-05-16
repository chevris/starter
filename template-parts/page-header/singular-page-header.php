<?php
/**
 * Template part for displaying the page-header for a singular post or page.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<header class="page-header">

	<h1 class="entry-title"><?php echo wp_kses_post( get_the_title() ); ?></h1>

</header>
