<?php
/**
 * Theme_Slug_Nested_Panel class
 * Handles data passing from args to JS.
 *
 * @package Theme_Slug
 * @see https://wordpress.stackexchange.com/a/256103/17078
 */

/**
 * Theme_Slug_Nested_Panel class
 */
class Theme_Slug_Nested_Panel extends \WP_Customize_Panel {

	/**
	 * The parent panel.
	 *
	 * @var string
	 */
	public $panel;

	/**
	 * Control type.
	 *
	 * @var string
	 */
	public $type = 'theme_slug_nested_panel';

	/**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 * @return array The array to be exported to the client as JSON.
	 */
	public function json() {
		$array = wp_array_slice_assoc(
			(array) $this,
			array(
				'id',
				'description',
				'priority',
				'type',
				'panel',
			)
		);

		$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
		$array['content']        = $this->get_content();
		$array['active']         = $this->active();
		$array['instanceNumber'] = $this->instance_number;

		return $array;
	}
}
