<?php
/**
 * Theme_Slug_Select_Blocks class
 * Handles data passing from args to JS.
 *
 * @package Theme_Slug
 */

/**
 * Theme_Slug_Select_Blocks class
 */
class Theme_Slug_Select_Blocks extends WP_Customize_Control {
	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'theme_slug_select_blocks_control';

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
	public $new_default_value = array();

	/**
	 * Send to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices'] = $this->choices;
		$this->json['new_default_value'] = $this->new_default_value;
	}
}
