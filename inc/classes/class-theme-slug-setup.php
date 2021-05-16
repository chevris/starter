<?php
/**
 * Set up class
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Init class
 */
class Theme_Slug_Setup {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	protected static $instance;

	/**
	 * Instance control
	 *
	 * @return Theme_Slug_Setup
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
		add_action( 'after_setup_theme', array( $this, 'content_width' ) );
		add_action( 'wp_head', array( $this, 'pingback_header' ) );
		add_action( 'body_class', array( $this, 'body_classes' ) );
	}

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	public function pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array Filtered body classes.
	 */
	public function body_classes( $classes ) {

		// Helps detect if JS is enabled or not.
		$classes[] = 'no-js';

		// Adds `singular` to singular pages, and `hfeed` to all other pages.
		$classes[] = is_singular() ? 'singular' : 'hfeed';

		return $classes;
	}

	/**
	 * Sets the $content_width in pixels, based on the theme design.
	 *
	 * $content_width variable defines the maximum allowed width for images,
	 * videos, and oEmbeds displayed within a theme.
	 *
	 * @global int $content_width
	 */
	public function content_width() {

		$content_width = absint( get_theme_mod( 'theme_slug_wide_content_width', 1240 ) );

		$GLOBALS['content_width'] = absint(
			/**
			 * Filters WordPress $content_width global variable.
			 *
			 * @param  int $content_width
			 */
			apply_filters( 'theme_slug_filter_content_width', $content_width )
		);
	}

}
Theme_Slug_Setup::get_instance();
