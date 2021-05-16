<?php
/**
 * Content Archive class
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Init class
 */
class Theme_Slug_Content_Archive {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	protected static $instance;

	/**
	 * Instance control
	 *
	 * @return Theme_Slug_Content_Archive
	 */
	public static function get_instance() {

		if ( null === static::$instance ) {
				static::$instance = new static();
		}
		return static::$instance;

	}

	/**
	 * Constructor
	 */
	public function __construct() {}

}
Theme_Slug_Content_Archive::get_instance();
