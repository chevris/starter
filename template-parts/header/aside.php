<?php
/**
 * Template part for displaying the aside.
 *
 * @package Theme_Slug
 */

/*
<button class="drawer-header-toggle"
	<?php if ( theme_slug_is_amp() ) { ?>
		on="tap:drawer-header-amp.toggle"
	<?php } ?>
>
	<?php theme_slug_the_svg( 'ui', 'menu', 24 ); ?>
</button>
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<aside class="header-aside">

	<button class="drawer-toggle drawer-header-toggle"
		<?php if ( theme_slug_is_amp() ) { ?>
			on="tap:drawer-header-amp.toggle"
		<?php } ?>
	>
		<div class="drawer-toggle-inner">
			<div class="bars">
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'themeslug' ); ?></span>
			</div>
		</div>
		</button>

</aside>
