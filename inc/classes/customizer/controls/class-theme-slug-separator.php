<?php
/**
 * Theme_Slug_Page_Separator class
 *
 * @package Theme_Slug
 */

/**
 * Theme_Slug_Page_Separator class
 */
class Theme_Slug_Page_Separator extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'theme_slug_separator_control';

	/**
	 * Render content
	 */
	public function render_content() {
		echo '<hr/>';
	}
}
