<?php
/**
 * Custom logo settings
 *
 * @package Theme_Slug
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

Theme_Slug_Customizer::add_settings(
	array(
		'theme_slug_logo_size' => array(
			'setting_args' => array(
				'default'           => 50,
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage',
			),
			'control_args' => array(
				'label'       => esc_html__( 'Logo Size (%)', 'themeslug' ),
				'section'     => 'title_tagline',
				'priority'    => 8,
				'input_attrs' => array(
					'min'        => 0,
					'max'        => 100,
					'defaultVal' => 50, // For reset.
				),
			),
			'custom_control' => 'Theme_Slug_Range',
			'partial_args' => array(
				'selector'        => '.branding-logo',
				'render_callback' => function() {
					the_custom_logo();
				},
			),
		),
	)
);
