<?php
/**
 * Template part for displaying the default header.
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<?php if ( theme_slug_is_amp() ) : ?>

	<amp-lightbox id='search-modal-amp' class="share-modal-amp" layout="nodisplay">

		<div class="search-modal__inner">

			<div class="search-modal__overlay" tabindex="-1" on="tap:search-modal-amp.close"></div>
			
			<div class="search-modal__container" role="dialog" aria-labelledby="search-modal-title">

				<button class="search-modal-close" on="tap:search-modal-amp.close">
					<?php theme_slug_the_svg( 'ui', 'close', 24 ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Close', 'themeslug' ); ?></span>
				</button>

				<?php get_search_form(); ?>
			
			</div>
		
		</div>

	</amp-lightbox>

<?php else : ?>

	<div class="search-modal" id="search-modal" aria-hidden="true">

		<div class="search-modal__inner">

			<div class="search-modal__overlay" tabindex="-1" data-micromodal-close></div>
			
			<div class="search-modal__container" role="dialog" aria-modal="true" aria-labelledby="search-modal-title">

				<button class="search-modal-close" data-micromodal-close>
					<?php theme_slug_the_svg( 'ui', 'close', 24 ); ?>
					<span class="screen-reader-text"><?php esc_html_e( 'Close', 'themeslug' ); ?></span>
				</button>

				<?php get_search_form(); ?>
			
			</div>

		</div>

	</div>

	<?php
endif;
