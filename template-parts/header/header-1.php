<?php
/**
 * Template part for displaying the header-1.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php get_template_part( 'template-parts/header/drawer' ); ?>

<header id="masthead" class="site-header">

	<?php do_action( 'theme_slug_header_content_top' ); ?>

	<div class="site-header-inner">

		<?php get_template_part( 'template-parts/header/branding' ); ?>

		<button class="drawer-header-toggle"
			<?php if ( theme_slug_is_amp() ) { ?>
				on="tap:drawer-header-amp.toggle"
			<?php } ?>
		>
			<?php theme_slug_the_svg( 'ui', 'menu', 24 ); ?>
			<span><?php esc_html_e( 'Menu', 'themeslug' ); ?></span>
		</button>

	</div>

	<?php do_action( 'theme_slug_header_content_bottom' ); ?>

</header>
