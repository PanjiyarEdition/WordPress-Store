<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// link font
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv(
		'mobileMenuFont',
		$atts,
	 rishi__cb_customizer_typography_default_values([
			'size' => [
				'desktop' => '30px',
				'tablet'  => '20px',
				'mobile'  => '16px'
			],
			'variation' => 'n4',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector)
]);

// link color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('mobileMenuColor', $atts),
	'default' => [
		'default' => ['color' =>  'var(--paletteColor1)'],
		'hover' => ['color' =>  'var(--paletteColor3)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'linkHoverColor'
		],
	],
]);

$mobile_menu_child_size = rishi__cb_get_akv('mobile_menu_child_size', $atts, '16px');

$css->put(
	rishi__cb_customizer_assemble_selector($root_selector),
	'--mobile_menu_child_size: ' . $mobile_menu_child_size
);

$mobile_menu_type = rishi__cb_get_akv('mobile_menu_type', $atts, 'type-1');

if ($mobile_menu_type !== 'type-1' || is_customize_preview()) {
 rishi__cb_customizer_output_border([
		'css' => $css,
		'selector' => rishi__cb_customizer_assemble_selector($root_selector),
		'variableName' => 'mobile-menu-divider',
		'value' => rishi__cb_get_akv('mobile_menu_divider', $atts, [
			'width' => 1,
			'style' => 'solid',
			'color' => [
				'color' =>  'var(--paletteColor6)',
			],
		])
	]);
}


// Margin
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'value' => rishi__cb_customizer_default_akg(
		'mobileMenuMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'left' => 'auto',
			'right' => 'auto',
			'linked' => true,
		])
	)
]);

//padding
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'value' => rishi__cb_customizer_default_akg(
		'mobileMenuPadding',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
			'top'    => '5px',
			'left'   => 'auto',
			'bottom' => '5px',
			'right'  => 'auto',
		])
	 ),
	 'property'   => 'padding',
]);
