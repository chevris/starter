<?php
/**
 * Back compat functionality
 *
 * Prevents the theme from running on WordPress versions prior to 5.5.
 *
 * @package Starter
 */

/**
 * Display upgrade notice on theme switch.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function theme_slug_switch_theme() {
	add_action( 'admin_notices', 'theme_slug_upgrade_notice' );
}
add_action( 'after_switch_theme', 'theme_slug_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * the theme on WordPress versions prior to 5.5.
 *
 * @global string $wp_version WordPress version.
 */
function theme_slug_upgrade_notice() {
	echo '<div class="error"><p>';
	printf(
		/* translators: %s: WordPress Version. */
		esc_html__( 'This theme requires WordPress 5.5 or newer. You are running version %s. Please upgrade.', 'themeslug' ),
		esc_html( $GLOBALS['wp_version'] )
	);
	echo '</p></div>';
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 5.5.
 *
 * @global string $wp_version WordPress version.
 */
function theme_slug_customize() {
	wp_die(
		sprintf(
			/* translators: %s: WordPress Version. */
			esc_html__( 'This theme requires WordPress 5.5 or newer. You are running version %s. Please upgrade.', 'themeslug' ),
			esc_html( $GLOBALS['wp_version'] )
		),
		'',
		array(
			'back_link' => true,
		)
	);
}
add_action( 'load-customize.php', 'theme_slug_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 5.5.
 *
 * @global string $wp_version WordPress version.
 */
function theme_slug_preview() {
	if ( isset( $_GET['preview'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
		wp_die(
			sprintf(
				/* translators: %s: WordPress Version. */
				esc_html__( 'This theme requires WordPress 5.5 or newer. You are running version %s. Please upgrade.', 'themeslug' ),
				esc_html( $GLOBALS['wp_version'] )
			)
		);
	}
}
add_action( 'template_redirect', 'theme_slug_preview' );
