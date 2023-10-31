<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Icon color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('triggerIconColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor3)'],
		'hover' => ['color' => 'var(--paletteColor4)'],
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

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('triggerSecondColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor7)'],
		'hover' => ['color' => 'var(--paletteColor7)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'secondColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'secondColorHover'
		],
	],
]);

// Margin
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'important' => true,
	'value' => rishi__cb_customizer_default_akg(
		'triggerMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		])
	)
]);


// transparent state
if (isset($has_transparent_header) && $has_transparent_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentTriggerIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-transparent-row="yes"]'
				])),
				'variable' => 'linkInitialColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-transparent-row="yes"]'
				])),
				'variable' => 'linkHoverColor'
			],
		],
	]);

 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentTriggerSecondColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-transparent-row="yes"]'
				])),
				'variable' => 'secondColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-transparent-row="yes"]'
				])),
				'variable' => 'secondColorHover'
			],
		],
	]);
}


// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyTriggerIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-sticky*="yes"]'
				])),
				'variable' => 'linkInitialColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-sticky*="yes"]'
				])),
				'variable' => 'linkHoverColor'
			],
		],
	]);

 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyTriggerSecondColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-sticky*="yes"]'
				])),
				'variable' => 'secondColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'between',
					'to_add' => '[data-sticky*="yes"]'
				])),
				'variable' => 'secondColorHover'
			],
		],
	]);
}

rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv( 'trigger_typo', $atts,
	 rishi__cb_customizer_typography_default_values([
			'family'    => 'Default',
			'variation' => 'n4',
			'size'      => '18px',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector'   => rishi__cb_customizer_assemble_selector($root_selector)
]);