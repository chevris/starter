<?php
/**
 * Template part for displaying the navigation.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<nav class="header-navigation">

	<button class="header-navigation__container-open" aria-expanded="false" aria-haspopup="true" aria-label="<?php esc_html_e( 'Open menu', 'themeslug' ); ?>"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><rect x="4" y="7.5" width="16" height="1.5" /><rect x="4" y="15" width="16" height="1.5" /></svg></button>

	<div class="header-navigation__container" id="navigation-modal" aria-hidden="true">

		<div class="header-navigation__overlay" tabindex="-1">

			<div class="header-navigation__dialog" role="dialog" aria-modal="true" aria-labelledby="navigation-modal-title">

				<button class="header-navigation__container-close" aria-label="<?php esc_html_e( 'Close menu', 'themeslug' ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" role="img" aria-hidden="true" focusable="false"><path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path></svg></button>

				<div class="header-navigation__container-body">
					menu
				</div>

			</div>

		</div>

	</div>

</nav>
