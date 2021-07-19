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

$header_default_only = true;

if ( ! $header_default_only ) {

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

		'theme_slug_header_before_sep_1' => array(
			'setting_args' => array(
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			),
			'control_args' => array(
				'section'  => 'theme_slug_header_section',
				'priority' => 10,
			),
			'custom_control' => 'Theme_Slug_Page_Separator',
		),
	);
	Theme_Slug_Customizer::add_settings( $header_settings );
}

// Top bar nav settings.
Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_header_top_bar_nav_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Top bar navigation', 'themeslug' ),
				'panel'    => 'theme_slug_header_panel',
				'type'       => 'collapse',
				'priority' => 2,
			),
		),
	)
);

$header_top_bar_nav_settings = array(
	'theme_slug_header_top_bar_nav_device_visibility' => array(
		'setting_args' => array(
			'default'           => array( 'desktop' ),
			'sanitize_callback' => 'theme_slug_sanitize_multi_select',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Device Visibility', 'themeslug' ),
			'section'  => 'theme_slug_header_top_bar_nav_section',
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
			'reset_values' => array( 'desktop' ),
		),
		'custom_control' => 'Theme_Slug_React_Multi_Select',
	),
);
Theme_Slug_Customizer::add_settings( $header_top_bar_nav_settings );

// Header block area settings.
Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_header_block_area_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Header block areas', 'themeslug' ),
				'description' => esc_html__( 'Assign reusable blocks in header block areas.', 'themeslug' ),
				'panel'    => 'theme_slug_header_panel',
				'type'       => 'collapse',
				'priority' => 3,
			),
		),
	)
);

$header_block_area_settings = array(

	'theme_slug_header_before_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Before the header', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_site_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_header_after_blocks' => array(
		'setting_args' => array(
			'default'           => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'After the header', 'themeslug' ),
			'section'  => 'theme_slug_header_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_site_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

);
Theme_Slug_Customizer::add_settings( $header_block_area_settings );
