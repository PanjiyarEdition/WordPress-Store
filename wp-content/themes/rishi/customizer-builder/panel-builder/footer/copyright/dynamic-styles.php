<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Font
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_customizer_default_akg(
		'copyrightFont',
		$atts,
	 rishi__cb_customizer_typography_default_values([
			'size' => '14px',
			'variation' => 'n4',
			'line-height' => '1.75',
			'letter-spacing' => '0.6px',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector)
]);

// Font color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_customizer_default_akg('copyrightColor', $atts),
	'default' => [
		'default' => ['color' => 'rgba(255,255,255,0.6)'],
		'link_initial' => ['color' =>'var(--paletteColor5)'],
		'link_hover' => ['color' => 'var(--paletteColor3)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'color'
		],

		'link_initial' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'linkInitialColor'
		],

		'link_hover' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'linkHoverColor'
		],
	],
]);

// Alignment
rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,

	'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'replace-last',
		'to_add' => '[data-column="copyright"]'
	])),

	'variableName' => 'horizontal-alignment',
	'unit' => '',
	'value' => rishi__cb_customizer_default_akg('footerCopyrightAlignment', $atts, [
		'desktop' => 'center',
		'tablet' => 'center',
		'mobile' => 'center'
	])
]);

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'replace-last',
		'to_add' => '[data-column="copyright"]'
	])),
	'variableName' => 'vertical-alignment',
	'unit' => '',
	'value' => rishi__cb_customizer_default_akg('footerCopyrightVerticalAlignment', $atts, [
		'desktop' => 'flex-start',
		'tablet' => 'flex-start',
		'mobile' => 'flex-start'
	])
]);

rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'important' => true,
	'value' => rishi__cb_customizer_default_akg(
		'copyrightMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		])
	)
]);
