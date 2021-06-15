<?php
/**
 * Theme_Slug_React_Multi_Select class
 * Handles data passing from args to JS.
 *
 * @package Theme_Slug
 */

/**
 * Theme_Slug_React_Multi_Select class
 */
class Theme_Slug_React_Multi_Select extends \WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'theme_slug_react_multi_select_control';

	/**
	 * Additional arguments passed to JS.
	 *
	 * @var array
	 */
	public $choices = array();

	/**
	 * Additional arguments passed to JS.
	 *
	 * @var array
	 */
	public $reset_values = array();

	/**
	 * Send to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = $this->choices;
		$this->json['reset_values'] = $this->reset_values;
	}
}
