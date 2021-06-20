<?php
/**
 * Theme_Slug_Page_Visibility class
 * Handles data passing from args to JS.
 *
 * @package Theme_Slug
 */

/**
 * Theme_Slug_Page_Visibility class
 */
class Theme_Slug_Page_Visibility extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'theme_slug_page_visibility_control';

	/**
	 * Additional arguments passed to JS.
	 *
	 * @var array
	 */
	public $choices = array();

	/**
	 * Send to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = $this->choices;
	}
}
