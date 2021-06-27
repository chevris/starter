<?php
/**
 * Template part for displaying the aside.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<aside class="header-aside">

	<button class="drawer-toggle" aria-expanded="false" aria-haspopup="true"
		<?php if ( theme_slug_is_amp() ) { ?>
			on="tap:drawer-header-amp.toggle"
		<?php } else { ?>
			data-micromodal-trigger="drawer-header"
		<?php } ?>
	>
		<div class="drawer-toggle-inner">
			<?php theme_slug_the_svg( 'ui', 'menu', 24 ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'themeslug' ); ?></span>
		</div>
	</button>

</aside>
