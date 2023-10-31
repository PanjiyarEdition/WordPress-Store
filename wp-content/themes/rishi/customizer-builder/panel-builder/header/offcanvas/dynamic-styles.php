<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Offcanvas background
$offcanvas_behavior = rishi__cb_get_akv('offcanvas_behavior', $atts, 'panel');

$offcanvasBackground = rishi__cb_get_akv(
	'offcanvasBackground',
	$atts,
 rishi__cb_customizer_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => 'var(--paletteColor5)'
			],
		],
	])
);

$offcanvasBackdrop = rishi__cb_get_akv(
	'offcanvasBackdrop',
	$atts,
 rishi__cb_customizer_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => 'rgba(255,255,255,0)'
			],
		],
	])
);

if ($offcanvas_behavior === 'panel') {
 rishi__cb_customizer_output_background_css([
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '> section'
		])),
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'responsive' => true,
		'value' => $offcanvasBackground
	]);
}

// Offcanvas backdrop
rishi__cb_customizer_output_background_css([
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'responsive' => true,
	'value' => $offcanvas_behavior === 'panel' ? $offcanvasBackdrop : $offcanvasBackground,
]);

rishi__cb_customizer_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector[0] . ' [data-behaviour*="side"]'),
	'value' => rishi__cb_get_akv('headerPanelShadow', $atts, rishi__cb_customizer_box_shadow_value([
		'enable' => true,
		'h_offset' => 0,
		'v_offset' => 0,
		'blur' => 70,
		'spread' => 0,
		'inset' => false,
		'color' => [
			'color' => 'rgba(0, 0, 0, 0.35)',
		],
	])),
	'responsive' => true
]);

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'variableName' => 'side-panel-width',
	'unit' => '',
	'value' => rishi__cb_get_akv('side_panel_width', $atts, [
		'desktop' => '500px',
		'tablet' => '65vw',
		'mobile' => '90vw',
	])
]);

$vertical_alignment = rishi__cb_get_akv('offcanvas_content_vertical_alignment', $atts, 'flex-start');

if ($vertical_alignment !== 'flex-start') {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($root_selector),
		'variableName' => 'vertical-alignment',
		'unit' => '',
		'value' => $vertical_alignment,
	]);
}

$horizontal_alignment = rishi__cb_get_akv('offcanvasContentAlignment', $atts, 'flex-start');

if ($horizontal_alignment !== 'flex-start') {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($root_selector),
		'variableName' => 'horizontal-alignment',
		'unit' => '',
		'value' => $horizontal_alignment,
	]);
}


rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('menu_close_button_color', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor3)'],
		'hover' => ['color' => 'var(--paletteColor2)'],
	],
	'css' => $css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '.close-button'
			])),
			'variable' => 'closeButtonColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '.close-button'
			])),
			'variable' => 'closeButtonHoverColor'
		]
	],
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('menu_close_button_shape_color', $atts),
	'default' => [
		'default' => ['color' => 'none'],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '.close-button'
			])),
			'variable' => 'closeButtonBackground'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '.close-button'
			])),
			'variable' => 'closeButtonHoverBackground'
		]
	],
]);
