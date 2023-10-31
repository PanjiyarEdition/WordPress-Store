<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Icon size
$socialsIconSize = rishi__cb_get_akv('socialsIconSize', $atts, 15);

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
$socialsIconSpacing = rishi__cb_get_akv('socialsIconSpacing', $atts, 15);

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

// Icons custom color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('headerSocialsIconColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
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
	'value' => rishi__cb_get_akv('headerSocialsIconBackground', $atts),
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
		'headerSocialsMargin',
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

// transparent state
if (isset($has_transparent_header) && $has_transparent_header) {

	// Icons custom color
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentHeaderSocialsIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'icon-color'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'icon-hover-color'
			]
		],

		'responsive' => true
	]);

	// Icons custom background
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentHeaderSocialsIconBackground', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'background-color'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'background-hover-color'
			]
		],

		'responsive' => true
	]);
}


// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {

	// Icons custom color
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyHeaderSocialsIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'icon-color'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'icon-hover-color'
			]
		],

		'responsive' => true
	]);

	// Icons custom background
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyHeaderSocialsIconBackground', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'background-color'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '[data-color="custom"]'
						]),
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'background-hover-color'
			]
		],

		'responsive' => true
	]);
}
