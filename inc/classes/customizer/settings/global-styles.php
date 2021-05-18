<?php
/**
 * Global styles settings
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Theme_Slug_Register_Settings::add_panels(
	array(
		'global_styles_panel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Global Styles', 'themeslug' ),
				'description' => esc_html__( 'Site wide styles.', 'themeslug' ),
				'priority' => 300,
			),
		),
	)
);

/**
 * Typography section.
 */

Theme_Slug_Register_Settings::add_sections(
	array(
		'global_styles_typography_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Typography', 'themeslug' ),
				'panel'    => 'global_styles_panel',
				'priority' => 1,
			),
		),
	)
);

Theme_Slug_Register_Settings::add_settings(
	array(
		'global_styles_typography_font_size' => array(
			'setting_args' => array(
				'default'           => 18,
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			),
			'control_args' => array(
				'type'     => 'number',
				'label'    => esc_html__( 'Font size (px):', 'themeslug' ),
				'section'  => 'global_styles_typography_section',
				'priority' => 10,
			),
			'partial_args' => array(
				'selector'        => '#theme-slug-front-style-inline-css',
				'render_callback' => function() {
					Theme_Slug_Custom_CSS_Variables::generate_custom_css_variables( 'front', true );
				},
			),
		),
	)
);
