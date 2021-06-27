<?php
/**
 * Template part for displaying the header-aside.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php get_template_part( 'template-parts/header/aside' ); ?>

<header id="masthead" class="site-header top-bar">

	<div class="top-bar-inner">

		<?php get_template_part( 'template-parts/header/branding' ); ?>

		<?php get_template_part( 'template-parts/header/top-bar-nav' ); ?>

		<button class="search-modal-toggle" aria-expanded="false" aria-haspopup="true"
			<?php if ( theme_slug_is_amp() ) { ?>
				on="tap:search-modal-amp.open"
			<?php } else { ?>
				data-micromodal-trigger="search-modal"
			<?php } ?>
		>
			<?php theme_slug_the_svg( 'ui', 'search', 24 ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'themeslug' ); ?></span>
		</button>

		<button class="drawer-toggle drawer-header-toggle tablet-vis-false desktop-vis-false" aria-expanded="false" aria-haspopup="true"
			<?php if ( theme_slug_is_amp() ) { ?>
				on="tap:drawer-header-amp.toggle"
			<?php } else { ?>
				data-micromodal-trigger="drawer-header"
			<?php } ?>
		>
			<?php theme_slug_the_svg( 'ui', 'menu', 24 ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'themeslug' ); ?></span>
		</button>

	</div>

</header>
