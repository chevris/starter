<?php
/**
 * Theme_Slug_Presets class
 * Handles data passing from args to JS.
 *
 * @package Theme_Slug
 */

/**
 * Theme_Slug_Presets class
 */
class Theme_Slug_Presets extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'theme_slug_presets_control';

	/**
	 * Additional arguments passed to JS.
	 *
	 * @var array
	 */
	public $presets = array();

	/**
	 * Send to JS.
	 */
	public function to_json() {
		parent::to_json();
		$this->json['presets'] = $this->presets;
	}
}
