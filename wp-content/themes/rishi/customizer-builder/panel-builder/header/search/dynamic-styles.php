<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Icon size
$search_header_icon_size = rishi__cb_get_akv('searchHeaderIconSize', $atts, 15);

if ($search_header_icon_size !== 15) {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($root_selector),
		'variableName' => 'icon-size',
		'value' => $search_header_icon_size
	]);
}

// Icon color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('searchHeaderIconColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
		'hover' => ['color' => 'var(--paletteColor3)'],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'icon-color'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'icon-hover-color'
		],
	],
	'responsive' => true
]);

// transparent state
if (isset($has_transparent_header) && $has_transparent_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentSearchHeaderIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-transparent-row="yes"]'
				])),
				'variable' => 'icon-color'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-transparent-row="yes"]'
				])),
				'variable' => 'icon-hover-color'
			],
		],
		'responsive' => true
	]);
}


// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickySearchHeaderIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-sticky*="yes"]'
				])),
				'variable' => 'icon-color'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-sticky*="yes"]'
				])),
				'variable' => 'icon-hover-color'
			],
		],
		'responsive' => true
	]);
}

// Links color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('searchHeaderFontColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
				$root_selector[0] . ' .search-toggle-form .search-field'
			),
			'variable' => 'searchHeaderFontColor'
		],
	],
]);

// Close button
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('search_close_button_color', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)'],
		'hover' => ['color' => 'var(--paletteColor4)'],
	],
	'css' => $css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
				$root_selector[0] . ' .search-toggle-form .btn-form-close'
			),
			'variable' => 'closeIconColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector(
				$root_selector[0] . ' .search-toggle-form .btn-form-close'
			),
			'variable' => 'closeIconHoverColor'
		]
	],
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('search_close_button_shape_color', $atts),
	'default' => [
		'default' => ['color' => '#f5585000'],
		'hover' => ['color' => '#f5585000'],
	],
	'css' => $css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
				$root_selector[0] . ' .search-toggle-form .btn-form-close'
			),
			'variable' => 'closeButtonBackground'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector(
				$root_selector[0] . ' .search-toggle-form .btn-form-close'
			),
			'variable' => 'closeButtonHoverBackground'
		]
	],
]);


// Modal background
rishi__cb_customizer_output_background_css([
	'selector' => rishi__cb_customizer_assemble_selector(
		$root_selector[0] . ' .search-toggle-form'
	),
	'css' => $css,
	'value' => rishi__cb_get_akv(
		'searchHeaderBackground',
		$atts,
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'rgba(18, 21, 25, 0.98)'
				],
			],
		])
	)
]);


// Icon margin
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'important' => true,
	'value' => rishi__cb_customizer_default_akg(
		'headerSearchMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		])
	)
]);
