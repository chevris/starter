<?php
/**
 * Singular settings
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_singular_panel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Singular', 'themeslug' ),
				'priority' => 153,
			),
			'custom_panel' => 'Theme_Slug_Nested_Panel',
		),
	)
);

// Title section settings.
Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_singular_title_section_subpanel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Title section', 'themeslug' ),
				'panel'    => 'theme_slug_singular_panel',
				'priority' => 1,
			),
			'custom_panel' => 'Theme_Slug_Nested_Panel',
		),
	)
);

// Title section block area settings.
Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_singular_title_section_block_area_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Title section block areas', 'themeslug' ),
				'description' => esc_html__( 'Assign reusable blocks in title section block areas.', 'themeslug' ),
				'panel'    => 'theme_slug_singular_title_section_subpanel',
				'type'       => 'collapse',
				'priority' => 2,
			),
		),
	)
);

$title_section_block_area_settings = array(

	'theme_slug_singular_title_section_before_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Before the title section', 'themeslug' ),
			'section'  => 'theme_slug_singular_title_section_block_area_section',
			'priority' => 10,
			'new_default_value' => array(
				array(
					'id' => 'none',
					'rule' => 'global:singular',
					'select' => 'all',
					'sub_rule' => '',
					'sub_selection' => array(),
					'ids' => array(),
				),
			),
			'choices'  => array(
				'blocks' => theme_slug_get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_singular_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_singular_title_section_after_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'After the title section', 'themeslug' ),
			'section'  => 'theme_slug_singular_title_section_block_area_section',
			'priority' => 10,
			'new_default_value' => array(
				array(
					'id' => 'none',
					'rule' => 'global:singular',
					'select' => 'all',
					'sub_rule' => '',
					'sub_selection' => array(),
					'ids' => array(),
				),
			),
			'choices'  => array(
				'blocks' => theme_slug_get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_singular_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_singular_title_section_replace_blocks' => array(
		'setting_args' => array(
			'default'           => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Replace the title section', 'themeslug' ),
			'section'  => 'theme_slug_singular_title_section_block_area_section',
			'priority' => 10,
			'new_default_value' => array(
				array(
					'id' => 'none',
					'rule' => 'global:singular',
					'select' => 'all',
					'sub_rule' => '',
					'sub_selection' => array(),
					'ids' => array(),
				),
			),
			'choices'  => array(
				'blocks' => theme_slug_get_reusable_blocks(),
				'templates' => Theme_Slug_Block_Area::get_singular_visibility_choices(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

);
Theme_Slug_Customizer::add_settings( $title_section_block_area_settings );
