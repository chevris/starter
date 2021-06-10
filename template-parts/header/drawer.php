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
	<amp-sidebar id="drawer-header-amp" layout="nodisplay" side="left" class="drawer-header">
<?php } else { ?>
	<div id="drawer-header-js" class="drawer-header drawer-header-js" hidden>
<?php } ?>

		<div class="drawer-header-inner">

			<button class="drawer-toggle drawer-header-toggle"
				<?php if ( theme_slug_is_amp() ) { ?>
					on="tap:drawer-header-amp.toggle"
				<?php } ?>
			>
				<span class="screen-reader-text"><?php esc_html_e( 'Close', 'themeslug' ); ?></span>
				<?php theme_slug_the_svg( 'ui', 'close', 24 ); ?>
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
		
		</div><!-- .drawer-header-inner -->

<?php if ( theme_slug_is_amp() ) { ?>
	</amp-sidebar><!-- .drawer-header -->
<?php } else { ?>
	</div><!-- .drawer-header -->
<?php } ?>
