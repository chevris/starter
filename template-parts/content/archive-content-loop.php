<?php
/**
 * Template part for displaying the archive loop
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$archive_loop_classes = array();
$archive_loop_classes = implode( ' ', $archive_loop_classes );

?>

<div id="archive-loop" class="archive-loop <?php echo esc_attr( $archive_loop_classes ); ?>">
	<?php
	// Start loop.
	$post_count = 0;
	while ( have_posts() ) {
		$post_count++;
		the_post();

		get_template_part( 'template-parts/content/archive-entry', get_post_type() );

	}
	?>
</div>

