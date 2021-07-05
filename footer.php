<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #page div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme_Slug
 */

?>

	</div><!-- #content -->

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

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
