<?php
/**
 * Header settings
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_header_panel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Header', 'themeslug' ),
				'description' => esc_html__( 'Header settings.', 'themeslug' ),
				'priority' => 151,
			),
		),
	)
);

// Classic header settings.
Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_header_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Header settings', 'themeslug' ),
				'panel'    => 'theme_slug_header_panel',
				'priority' => 1,
			),
			'custom_section' => 'Theme_Slug_Expanded_Section',
		),
	)
);

$header_settings = array(
	'theme_slug_header_layout' => array(
		'setting_args' => array(
			'default'           => 'default',
			'sanitize_callback' => function ( $value ) {
				$allowed_values = array( 'default', 'aside', 'responsive', 'none' );
				if ( ! in_array( $value, $allowed_values, true ) ) {
					return 'default';
				}
				return esc_html( $value );
			},
			'transport'         => 'refresh',
		),
		'control_args' => array(
			'type'     => 'select',
			'label'    => esc_html__( 'Header layout', 'themeslug' ),
			'section'  => 'theme_slug_header_section',
			'priority' => 10,
			'choices'  => array(
				'default' => esc_html__( 'Default', 'themeslug' ),
				'aside' => esc_html__( 'Aside', 'themeslug' ),
				'responsive' => esc_html__( 'Responsive', 'themeslug' ),
				'none' => esc_html__( 'No header', 'themeslug' ),
			),
		),
	),
);
Theme_Slug_Customizer::add_settings( $header_settings );

// Header block area settings.
Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_header_block_area_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Header Block Areas', 'themeslug' ),
				'description' => esc_html__( 'Assign reusable blocks.', 'themeslug' ),
				'panel'    => 'theme_slug_header_panel',
				'priority' => 2,
			),
		),
	)
);

$header_block_area_settings = array(

	'theme_slug_header_before_sep_1' => array(
		'setting_args' => array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		),
		'control_args' => array(
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
		),
		'custom_control' => 'Theme_Slug_Page_Separator',
	),

	'theme_slug_header_before_content' => array(
		'setting_args' => array(
			'default'           => '',
			'sanitize_callback' => function( $value ) {
				return '' !== $value ? absint( $value ) : '';
			},
		),
		'control_args' => array(
			'label'    => esc_html__( 'Before the header', 'themeslug' ),
			'description' => esc_html__( 'Select a reusable block.', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'choices'  => theme_slug_get_reusable_blocks(),
		),
		'custom_control' => 'Theme_Slug_Select_Reusable_Block',
	),

	'theme_slug_header_before_device_visibility' => array(
		'setting_args' => array(
			'default'           => array( 'desktop', 'tablet', 'mobile' ),
			'sanitize_callback' => 'theme_slug_sanitize_multi_select',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Device Visibility', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'choices'  => array(
				array(
					'value' => 'desktop',
					'label' => __( 'Desktop', 'themeslug' ),
				),
				array(
					'value' => 'tablet',
					'label' => __( 'Tablet', 'themeslug' ),
				),
				array(
					'value' => 'mobile',
					'label' => __( 'Mobile', 'themeslug' ),
				),
			),
			'reset_values' => array( 'desktop', 'tablet', 'mobile' ),
			'active_callback' => function() {
				return get_theme_mod( 'theme_slug_header_before_content' ) !== '';
			},
		),
		'custom_control' => 'Theme_Slug_React_Multi_Select',
	),

	'theme_slug_header_before_page_visibility' => array(
		'setting_args' => array(
			'default'           => array(
				'rule' => 'global:site',
				'select' => '',
				'sub_rule' => '',
				'sub_selection' => array(),
				'ids' => array(),
			),
			'sanitize_callback' => 'theme_slug_sanitize_page_visibility',
			'transport'         => 'refresh',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Page Visibility', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'active_callback' => function() {
				return get_theme_mod( 'theme_slug_header_before_content' ) !== '';
			},
			'choices' => Theme_Slug_Block_Area_Context::get_page_visibility_choices(),
		),
		'custom_control' => 'Theme_Slug_Page_Visibility',
	),

	'theme_slug_header_before_sep_2' => array(
		'setting_args' => array(
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		),
		'control_args' => array(
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
		),
		'custom_control' => 'Theme_Slug_Page_Separator',
	),

	'theme_slug_header_after_content' => array(
		'setting_args' => array(
			'default'           => '',
			'sanitize_callback' => function( $value ) {
				return '' !== $value ? absint( $value ) : '';
			},
		),
		'control_args' => array(
			'label'    => esc_html__( 'After the header', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'choices'  => theme_slug_get_reusable_blocks(),
		),
		'custom_control' => 'Theme_Slug_Select_Reusable_Block',
	),

	'theme_slug_header_after_device_visibility' => array(
		'setting_args' => array(
			'default'           => array( 'desktop', 'tablet', 'mobile' ),
			'sanitize_callback' => 'theme_slug_sanitize_multi_select',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Device Visibility', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'choices'  => array(
				array(
					'value' => 'desktop',
					'label' => __( 'Desktop', 'themeslug' ),
				),
				array(
					'value' => 'tablet',
					'label' => __( 'Tablet', 'themeslug' ),
				),
				array(
					'value' => 'mobile',
					'label' => __( 'Mobile', 'themeslug' ),
				),
			),
			'reset_values' => array( 'desktop', 'tablet', 'mobile' ),
			'active_callback' => function() {
				return get_theme_mod( 'theme_slug_header_after_content' ) !== '';
			},
		),
		'custom_control' => 'Theme_Slug_React_Multi_Select',
	),

	'theme_slug_header_after_page_visibility' => array(
		'setting_args' => array(
			'default'           => array(
				'rule' => 'global:site',
				'select' => '',
				'sub_rule' => '',
				'sub_selection' => array(),
				'ids' => array(),
			),
			'sanitize_callback' => 'theme_slug_sanitize_page_visibility',
			'transport'         => 'refresh',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Page Visibility', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'active_callback' => function() {
				return get_theme_mod( 'theme_slug_header_after_content' ) !== '';
			},
			'choices' => Theme_Slug_Block_Area_Context::get_page_visibility_choices(),
		),
		'custom_control' => 'Theme_Slug_Page_Visibility',
	),

);
Theme_Slug_Customizer::add_settings( $header_block_area_settings );
