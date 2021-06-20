<?php
/**
 * Theme_Slug_Icon_Checkbox class
 * Handles data passing from args to JS.
 *
 * @package Theme_Slug
 */

/**
 * Theme_Slug_Icon_Checkbox class
 */
class Theme_Slug_Icon_Checkbox extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'theme_slug_icon_checkbox_control';

	/**
	 * Additional arguments passed to JS.
	 *
	 * @var array
	 */
	public $default = array();

	/**
	 * Additional arguments passed to JS.
	 *
	 * @var array
	 */
	public $input_attrs = array();

	/**
	 * Send to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['default']     = $this->default;
		$this->json['input_attrs'] = $this->input_attrs;
	}
}
