<?php
/**
 * Footer settings
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_footer_panel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Footer', 'themeslug' ),
				'description' => esc_html__( 'Footer settings.', 'themeslug' ),
				'priority' => 152,
			),
		),
	)
);

// Footer block area settings.
Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_footer_block_area_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Footer block areas', 'themeslug' ),
				'description' => esc_html__( 'Assign reusable blocks in footer block areas.', 'themeslug' ),
				'panel'    => 'theme_slug_footer_panel',
				'type'       => 'collapse',
				'priority' => 3,
			),
		),
	)
);

$footer_block_area_settings = array(

	'theme_slug_footer_before_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Before the footer', 'themeslug' ),
			'section'  => 'theme_slug_footer_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => theme_slug_get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_site_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_footer_after_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'After the footer', 'themeslug' ),
			'section'  => 'theme_slug_footer_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => theme_slug_get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_site_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_footer_replace_blocks' => array(
		'setting_args' => array(
			'default'           => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Replace the footer', 'themeslug' ),
			'section'  => 'theme_slug_footer_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => theme_slug_get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_site_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

);
Theme_Slug_Customizer::add_settings( $footer_block_area_settings );
