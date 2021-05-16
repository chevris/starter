<?php
/**
 * Content Singular class
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Init class
 */
class Theme_Slug_Content_Singular {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	protected static $instance;

	/**
	 * Instance control
	 *
	 * @return Theme_Slug_Content_Singular
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
	public function __construct() {
		add_action( 'theme_slug_singular_page_header', array( $this, 'display_singular_page_header' ) );
	}

	/**
	 * Display singular page header
	 */
	public function display_singular_page_header() {
		get_template_part( 'template-parts/page-header/singular-page-header', get_post_type() );
	}

}
Theme_Slug_Content_Singular::get_instance();
