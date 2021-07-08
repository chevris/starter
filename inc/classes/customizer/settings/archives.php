<?php
/**
 * Archives settings
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_archives_panel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Archives', 'themeslug' ),
				'priority' => 153,
			),
			'custom_panel' => 'Theme_Slug_Nested_Panel',
		),
	)
);

// Title section settings.
Theme_Slug_Customizer::add_panels(
	array(
		'theme_slug_archives_title_section_subpanel' => array(
			'panel_args' => array(
				'title'    => esc_html__( 'Title section', 'themeslug' ),
				'panel'    => 'theme_slug_archives_panel',
				'priority' => 1,
			),
			'custom_panel' => 'Theme_Slug_Nested_Panel',
		),
	)
);

Theme_Slug_Customizer::add_sections(
	array(
		'theme_slug_archives_title_section_settings' => array(
			'section_args' => array(
				'title'    => esc_html__( 'Title section settings', 'themeslug' ),
				'panel'    => 'theme_slug_archives_title_section_subpanel',
				'priority' => 1,
			),
			'custom_section' => 'Theme_Slug_Expanded_Section',
		),
	)
);

$title_section_settings = array(
	'theme_slug_archives_title_section_home_title' => array(
		'setting_args' => array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_textarea_field',
		),
		'control_args'    => array(
			'type'        => 'textarea',
			'label'       => esc_html__( 'Title', 'themeslug' ),
			'description' => esc_html__( 'Title text of the blog (latest posts) page.', 'themeslug' ),
			'section'     => 'theme_slug_archives_title_section_settings',
			'priority'    => 10,
		),
	),
);
Theme_Slug_Customizer::add_settings( $title_section_settings );
