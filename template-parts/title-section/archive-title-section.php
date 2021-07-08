<?php
/**
 * Template part for displaying the title section for archives.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$archive_title_prefix = theme_slug_get_archive_title_prefix();
$archive_title = get_the_archive_title();
$archive_description = get_the_archive_description( '<div>', '</div>' );

?>

<?php
if ( $archive_title || $archive_description ) :
	?>

	<header class="title-section">

		<?php
		if ( $archive_title_prefix ) {
			?>
			<p class="archive-title-prefix">
				<?php echo $archive_title_prefix; // phpcs:ignore WordPress.Security.EscapeOutput ?>
			</p>
			<?php
		}

		if ( $archive_title ) {

			// Output dynamic text inside a div to allow multiple lines.
			if ( ( is_home() && ! is_paged() ) ) {
				?>
				<div class="archive-title"><?php echo wp_kses_post( wpautop( $archive_title ) ); ?></div>
				<?php
			} else {
				?>
				<h1 class="archive-title"><?php echo $archive_title; // phpcs:ignore WordPress.Security.EscapeOutput ?></h1>
				<?php
			}
		}

		the_archive_description( '<div class="archive-description">', '</div>' );
		?>

	</header>

	<?php
endif;
