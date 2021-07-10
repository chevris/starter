<?php
/**
 * Customizer class
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Init class
 */
class Theme_Slug_Customizer {

	/**
	 * Instance
	 *
	 * @var object $instance
	 */
	protected static $instance;

	/**
	 * Instance control
	 *
	 * @return Theme_Slug_Customizer
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
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customizer_pane_assets' ) );
		add_action( 'customize_register', array( $this, 'modify_native_settings' ) );
		add_action( 'customize_register', array( $this, 'register' ) );
	}

	/**
	 * Enqueues CSS and JS for customizer controls panel.
	 */
	public function enqueue_customizer_pane_assets() {

		/**
		 * Global scripts for customizer panel.
		 */
		wp_enqueue_script(
			'theme-slug-customizer-pane',
			get_template_directory_uri() . '/assets/customizer-pane.js',
			array( 'customize-controls', 'jquery' ),
			theme_slug_get_asset_version( get_template_directory() . '/assets/customizer-pane.js' ),
			true
		);

		/**
		 * Scripts for customizer controls.
		 */
		$asset_controls = ( include get_template_directory() . '/assets/customizer-controls.asset.php' );
		wp_enqueue_script(
			'theme-slug-customizer-controls',
			get_template_directory_uri() . '/assets/customizer-controls.js',
			$asset_controls['dependencies'],
			theme_slug_get_asset_version( get_template_directory() . '/assets/customizer-controls.js' ),
			true
		);
		wp_localize_script(
			'theme-slug-customizer-controls',
			'themeslugCustomizeControlLocalize',
			array()
		);

		/**
		 * Style for customizer controls.
		 */
		wp_enqueue_style(
			'theme-slug-customizer-controls',
			get_template_directory_uri() . '/assets/customizer-controls.css',
			array(),
			theme_slug_get_asset_version( get_template_directory() . '/assets/customizer-controls.css' )
		);
	}

	/**
	 * Modify default options.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function modify_native_settings( $wp_customize ) {

		// Change site-title & description to postMessage.
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {

			// Add partial for blogname.
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => function() {
						bloginfo( 'name' );
					},
				)
			);

			// Add partial for blogdescription.
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => function() {
						bloginfo( 'description' );
					},
				)
			);
		}
	}

	/**
	 * Register controls.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
	 */
	public function register( $wp_customize ) {
		$this->customizer = $wp_customize;
		$this->register_controls(); // Has to be at the top.
		$this->create_settings();
		$this->register_panels();
		$this->register_sections();
		$this->register_settings();
	}

	/**
	 * Register control types.
	 */
	public function register_controls() {

		// Load customize control classes.
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-separator.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-nested-panel.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-expanded-section.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-presets.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-range.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-select-blocks.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-select-reusable-block.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-react-multi-select.php';
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-page-visibility.php';

		// To remove.
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-multi-select.php';
		// WIP : not used for now.
		require_once get_template_directory() . '/inc/classes/customizer/controls/class-theme-slug-icon-checkbox.php';

		// Register JS control types.
		$this->customizer->register_section_type( 'theme_slug_nested_panel' );
		$this->customizer->register_section_type( 'theme_slug_expanded_section' );
		$this->customizer->register_control_type( 'Theme_Slug_Presets' );
		$this->customizer->register_control_type( 'Theme_Slug_Range' );
		$this->customizer->register_control_type( 'Theme_Slug_Select_Blocks' );
		$this->customizer->register_control_type( 'Theme_Slug_Select_Reusable_Block' );
		$this->customizer->register_control_type( 'Theme_Slug_React_Multi_Select' );
		$this->customizer->register_control_type( 'Theme_Slug_Page_Visibility' );

		// To remove.
		$this->customizer->register_control_type( 'Theme_Slug_Multi_Select' );
		// WIP : not used for now.
		$this->customizer->register_control_type( 'Theme_Slug_Icon_Checkbox' );
	}

	/**
	 * Set settings.
	 */
	public function create_settings() {
		require_once get_template_directory() . '/inc/classes/customizer/settings/global-styles.php';
		require_once get_template_directory() . '/inc/classes/customizer/settings/custom-logo.php';
		require_once get_template_directory() . '/inc/classes/customizer/settings/header.php';
		require_once get_template_directory() . '/inc/classes/customizer/settings/footer.php';
		require_once get_template_directory() . '/inc/classes/customizer/settings/singular.php';
		require_once get_template_directory() . '/inc/classes/customizer/settings/archives.php';
		require_once get_template_directory() . '/inc/classes/customizer/settings/blog.php';
		require_once get_template_directory() . '/inc/classes/customizer/settings/search-results.php';
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
Theme_Slug_Customizer::get_instance();
