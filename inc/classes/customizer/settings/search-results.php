<?php
/**
 * Search results settings
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_search_results_panel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Search results page', 'themeslug' ),
				'priority' => 156,
			),
			'custom_panel' => 'Theme_Slug_Nested_Panel',
		),
	)
);

// Title section settings.

Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_search_results_title_section_subpanel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Title section', 'themeslug' ),
				'panel'    => 'theme_slug_search_results_panel',
				'priority' => 1,
			),
			'custom_panel' => 'Theme_Slug_Nested_Panel',
		),
	)
);

Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_search_results_title_section_settings' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Title section settings', 'themeslug' ),
				'panel'    => 'theme_slug_search_results_title_section_subpanel',
				'priority' => 1,
			),
			'custom_section' => 'Theme_Slug_Expanded_Section',
		),
	)
);

$title_section_settings = array(
	'theme_slug_search_results_title_section_title_prefix' => array(
		'setting_args' => array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		),
		'control_args'    => array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Title', 'themeslug' ),
			'description' => esc_html__( 'Title prefix text of the search result page.', 'themeslug' ),
			'section'     => 'theme_slug_search_results_title_section_settings',
			'priority'    => 10,
		),
	),
);
Theme_Slug_Customizer::add_settings( $title_section_settings );

Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_search_results_title_section_block_area_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Title section block areas', 'themeslug' ),
				'description' => esc_html__( 'Assign reusable blocks in title section block areas.', 'themeslug' ),
				'panel'    => 'theme_slug_search_results_title_section_subpanel',
				'type'       => 'collapse',
				'priority' => 2,
			),
		),
	)
);

$title_section_block_area_settings = array(

	'theme_slug_search_results_title_section_before_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Before the title section', 'themeslug' ),
			'section'  => 'theme_slug_search_results_title_section_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_search_results_title_section_after_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'After the title section', 'themeslug' ),
			'section'  => 'theme_slug_search_results_title_section_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_search_results_title_section_replace_blocks' => array(
		'setting_args' => array(
			'default'           => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Replace the title section', 'themeslug' ),
			'section'  => 'theme_slug_search_results_title_section_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

);
Theme_Slug_Customizer::add_settings( $title_section_block_area_settings );

// Content settings.

Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_search_results_content_subpanel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Content', 'themeslug' ),
				'panel'    => 'theme_slug_search_results_panel',
				'priority' => 2,
			),
			'custom_panel' => 'Theme_Slug_Nested_Panel',
		),
	)
);

Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_search_results_content_block_area_section' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Content block areas', 'themeslug' ),
				'panel'    => 'theme_slug_search_results_content_subpanel',
				'type'       => 'collapse',
				'priority' => 2,
			),
		),
	)
);

$content_block_area_settings = array(

	'theme_slug_search_results_content_before_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Before the content', 'themeslug' ),
			'section'  => 'theme_slug_search_results_content_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_search_results_content_after_blocks' => array(
		'setting_args' => array(
			'default' => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'After the content', 'themeslug' ),
			'section'  => 'theme_slug_search_results_content_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

	'theme_slug_search_results_content_replace_blocks' => array(
		'setting_args' => array(
			'default'           => array(),
			'sanitize_callback' => 'theme_slug_sanitize_select_blocks',
		),
		'control_args' => array(
			'label'    => esc_html__( 'Replace the content', 'themeslug' ),
			'section'  => 'theme_slug_search_results_content_block_area_section',
			'priority' => 10,
			'choices'  => array(
				'blocks' => Theme_Slug_Block_Area::get_reusable_blocks(),
			),
		),
		'custom_control' => 'Theme_Slug_Select_Blocks',
	),

);
Theme_Slug_Customizer::add_settings( $content_block_area_settings );
