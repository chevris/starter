<?php
/**
 * Customizer class
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class for managing Customizer settings.
 */
class Theme_Slug_Register_Settings {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	protected static $instance;

	/**
	 * Instance control
	 *
	 * @return Theme_Slug_Register_Settings
	 */
	public static function get_instance() {

		if ( null === static::$instance ) {
				static::$instance = new static();
		}
		return static::$instance;

	}

	/**
	 * WP_Customize object
	 *
	 * @var WP_Customize_Manager $wp_customize object
	 */
	protected $customizer;

	/**
	 * Panels to register.
	 *
	 * @var array Panels that will be registered.
	 */
	public static $panels = array();

	/**
	 * Sections to register.
	 *
	 * @var array Sections that will be registered.
	 */
	public static $sections = array();

	/**
	 * Settings to register.
	 *
	 * @var array Settings that will be registered.
	 */
	public static $settings = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'action_customize_register' ) );
	}

	/**
	 * Register controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function action_customize_register( $wp_customize ) {
		$this->customizer = $wp_customize;
		$this->register_controls(); // Has to be at the top.
		$this->create_settings_array();
		$this->register_panels();
		$this->register_sections();
		$this->register_settings();

	}

	/**
	 * Register control types.
	 */
	public function register_controls() {}

	/**
	 * Set settings array.
	 */
	public function create_settings_array() {
		require_once get_template_directory() . '/inc/classes/customizer/settings/global-styles.php';
	}

	/**
	 * Register panels.
	 */
	private function register_panels() {

		$panels = self::$panels;
		foreach ( $panels as $panel_key => $panel ) {
			if ( isset( $panel['custom_panel'] ) && ! empty( $panel['custom_panel'] ) ) {
				$panel_class = $panel['custom_panel'];
				$this->customizer->add_panel( new $panel_class( $this->customizer, $panel_key, $panel['panel_args'] ) );
			} else {
				$this->customizer->add_panel( $panel_key, $panel['panel_args'] );
			}
		}

	}

	/**
	 * Register sections.
	 */
	private function register_sections() {

		$sections = self::$sections;
		foreach ( $sections as $section_key => $section ) {
			if ( isset( $section['custom_section'] ) && ! empty( $section['custom_section'] ) ) {
				$section_class = $section['custom_section'];
				$this->customizer->add_section( new $section_class( $this->customizer, $section_key, $section['section_args'] ) );
			} else {
				$this->customizer->add_section( $section_key, $section['section_args'] );
			}
		}

	}

	/**
	 * Register settings.
	 */
	private function register_settings() {

		$settings = self::$settings;
		foreach ( $settings as $setting_key => $setting ) {

			// Add setting.
			$this->customizer->add_setting( $setting_key, $setting['setting_args'] );

			// Add control.
			if ( isset( $setting['custom_control'] ) && ! empty( $setting['custom_control'] ) ) {
				$control_class = $setting['custom_control'];
				$this->customizer->add_control( new $control_class( $this->customizer, $setting_key, $setting['control_args'] ) );
			} else {
				$new_control  = $this->customizer->add_control( $setting_key, $setting['control_args'] );
			}

			// Add partial.
			if ( isset( $setting['partial_args'] ) && ! empty( $setting['partial_args'] ) ) {
				if ( isset( $this->customizer->selective_refresh ) ) {
					$this->customizer->selective_refresh->add_partial(
						$setting_key,
						$setting['partial_args']
					);
				}
			}
		}

	}

	/**
	 * Adds panels to panels array.
	 *
	 * @param array $new_panels an array of panels.
	 */
	public function add_panels( $new_panels ) {
		self::$panels = array_merge( $new_panels, self::$panels );
	}

	/**
	 * Adds sections to settings array.
	 *
	 * @param array $new_sections an array of settings.
	 */
	public function add_sections( $new_sections ) {
		self::$sections = array_merge( $new_sections, self::$sections );
	}

	/**
	 * Adds settings to settings array.
	 *
	 * @param array $new_settings an array of settings.
	 */
	public function add_settings( $new_settings ) {
		self::$settings = array_merge( $new_settings, self::$settings );
	}

}
Theme_Slug_Register_Settings::get_instance();
