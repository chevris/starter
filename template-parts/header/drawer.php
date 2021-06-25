<?php
/**
 * Template part for displaying the drawer.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( theme_slug_is_amp() ) { ?>
	<amp-sidebar class="drawer-header-amp" id="drawer-header-amp" layout="nodisplay" side="left">
<?php } else { ?>
	<div class="drawer-header" id="drawer-header" aria-hidden="true">
		<div class="drawer-header__overlay" tabindex="-1" data-micromodal-close></div>
<?php } ?>

	<div class="drawer-header__container">

		<button class="drawer-toggle drawer-header-toggle"
			<?php if ( theme_slug_is_amp() ) { ?>
				on="tap:drawer-header-amp.toggle"
			<?php } else { ?>
				data-micromodal-close
			<?php } ?>
		>
			<?php theme_slug_the_svg( 'ui', 'close', 24 ); ?>
			<span class="screen-reader-text"><?php esc_html_e( 'Close', 'themeslug' ); ?></span>
		</button>
	
		<div class="drawer-body">
			<?php
			if ( has_nav_menu( 'drawer' ) ) {
				?>
				<nav class="drawer-nav" role="navigation">
					<?php
					$args = array(
						'theme_location' => 'drawer',
						'container'  => false,
						'menu_class' => 'menu',
						'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					);

					wp_nav_menu( $args );
					?>
				</nav>
				<?php
			}
			?>
		</div><!-- .drawer-body -->
	
		<div class="drawer-footer">
			drawer footer
		</div><!-- .drawer-footer -->


	</div><!-- .drawer-header__container -->


<?php if ( theme_slug_is_amp() ) { ?>
	</amp-sidebar>
<?php } else { ?>
	</div><!-- .drawer-header -->
<?php } ?>
