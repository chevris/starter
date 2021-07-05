<?php
/**
 * Template part for displaying the footer.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<footer class="site-footer">
	<div class="site-footer-inner">

		<div class="footer-start">
			<span class="footer-copyright">&copy; <?php echo esc_html( date_i18n( esc_html__( 'Y', 'themeslug' ) ) ); ?> <a href="<?php echo esc_url( home_url() ); ?>" rel="home"><?php echo bloginfo( 'name' ); ?></a></span>

			<span class="footer-theme-credits">
				<?php
				// Translators: $s = name of the theme developer.
				printf( esc_html_x( 'Theme by %s', 'Translators: $s = name of the theme developer', 'themeslug' ), '<a href="#">Téva</a>' );
				?>
			</span>

			<?php
			if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '', '' );
			}
			?>
		</div>
	
	</div>
</footer>
