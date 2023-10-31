<?php

$selector_prefix = $prefix;

if ($selector_prefix === 'blog') {
	$selector_prefix = '';
}

// Pagination
rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_prefix_selector('.cb__pagination', $selector_prefix),
	'variableName' => 'spacing',
	'value' => get_theme_mod($prefix . '_paginationSpacing', [
		'mobile' => 50,
		'tablet' => 60,
		'desktop' => 80,
	])
]);

rishi__cb_customizer_output_border([
	'css' => $css,
	'selector' => rishi__cb_customizer_prefix_selector('.cb__pagination[data-divider]', $selector_prefix),
	'variableName' => 'border',
	'value' => get_theme_mod($prefix . '_paginationDivider', [
		'width' => 1,
		'style' => 'none',
		'color' => [
			'color' => 'rgba(224, 229, 235, 0.5)',
		],
	])
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod($prefix . '_simplePaginationFontColor', []),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'active' => ['color' => '#ffffff'],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_prefix_selector(
				'[data-pagination="simple"], [data-pagination="next_prev"]',
				$selector_prefix
			),
			'variable' => 'color'
		],

		'active' => [
			'selector' => rishi__cb_customizer_prefix_selector(
				'[data-pagination="simple"]',
				$selector_prefix
			),
			'variable' => 'colorActive'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_prefix_selector(
				'[data-pagination="simple"], [data-pagination="next_prev"]',
				$selector_prefix
			),
			'variable' => 'linkHoverColor'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod($prefix . '_paginationButtonText', []),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_prefix_selector(
				'[data-pagination="load_more"]',
				$selector_prefix
			),
			'variable' => 'buttonTextInitialColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_prefix_selector(
				'[data-pagination="load_more"]',
				$selector_prefix
			),
			'variable' => 'buttonTextHoverColor'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod($prefix . '_paginationButton', []),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_prefix_selector(
				'[data-pagination="load_more"]',
				$selector_prefix
			),
			'variable' => 'buttonInitialColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_prefix_selector(
				'[data-pagination="load_more"]',
				$selector_prefix
			),
			'variable' => 'buttonHoverColor'
		],
	],
]);
