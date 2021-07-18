<?php
/**
 * The template for displaying search forms
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Generate a unique ID for each form and a string containing an aria-label if one was passed to get_search_form() in the args array.
$uniq_id = wp_unique_id( 'search-form-' );
$aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';

?>
<form role="search" <?php echo $aria_label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $uniq_id ); ?>"><?php esc_html_e( 'Search For&hellip;', 'themeslug' ); ?></label>
	<input placeholder="<?php esc_attr_e( 'Search For&hellip;', 'themeslug' ); ?>" type="search" id="<?php echo esc_attr( $uniq_id ); ?>" class="search-field" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit">
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'Submit button', 'themeslug' ); ?></span>
		<?php theme_slug_the_svg( 'ui', 'search', 18, 18 ); ?>
	</button>
</form>
