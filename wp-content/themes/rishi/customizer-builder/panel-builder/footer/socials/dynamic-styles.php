<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Icon size
$socialsIconSize = rishi__cb_customizer_default_akg('socialsIconSize', $atts, 15);

if ($socialsIconSize !== 15) {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($root_selector),
		'variableName' => 'icon-size',
		'value' => $socialsIconSize,
		'responsive' => true
	]);
}

// Icon spacing
$socialsIconSpacing = rishi__cb_customizer_default_akg('socialsIconSpacing', $atts, 15);

if ($socialsIconSpacing !== 15) {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($root_selector),
		'variableName' => 'spacing',
		'value' => $socialsIconSpacing,
		'responsive' => true
	]);
}


// Horizontal alignment
$horizontal_alignment = rishi__cb_customizer_default_akg('footerSocialsAlignment', $atts, 'flex-start');

if ($horizontal_alignment !== 'flex-start') {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'replace-last',
			'to_add' => $column_selector
		])),
		'variableName' => 'horizontal-alignment',
		'value' => $horizontal_alignment,
		'unit' => '',
	]);
}


// Vertical alignment
$vertical_alignment = rishi__cb_customizer_default_akg('footerSocialsVerticalAlignment', $atts, 'CT_CSS_SKIP_RULE');

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'replace-last',
		'to_add' => $column_selector
	])),
	'variableName' => 'vertical-alignment',
	'value' => $vertical_alignment,
	'unit' => '',
]);


// Icons custom color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_customizer_default_akg('footerSocialsIconColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)'],
		'hover' => ['color' => 'var(--paletteColor3)'],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '[data-color="custom"]'
			])),
			'variable' => 'icon-color'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '[data-color="custom"]'
			])),
			'variable' => 'icon-hover-color'
		]
	],

	'responsive' => true
]);

// Icons custom background
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_customizer_default_akg('footerSocialsIconBackground', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor7)'],
		'hover' => ['color' => 'var(--paletteColor6)'],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '[data-color="custom"]'
			])),
			'variable' => 'background-color'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '[data-color="custom"]'
			])),
			'variable' => 'background-hover-color'
		]
	],

	'responsive' => true
]);

// Margin
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'important' => true,
	'value' => rishi__cb_customizer_default_akg(
		'footerSocialsMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		])
	)
]);

if (function_exists('rishi__cb_customizer_output_responsive_switch')) {
 rishi__cb_customizer_output_responsive_switch([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.cb__label'
		])),
		'value' => rishi__cb_customizer_default_akg(
			'socialsLabelVisibility',
			$atts,
			[
				'desktop' => false,
				'tablet' => false,
				'mobile' => false,
			]
		),
		'on' => 'block'
	]);
}
