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

</header>
