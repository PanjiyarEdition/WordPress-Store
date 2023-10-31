<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Icon size
rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.cb__icon-container'
		])
	),
	'variableName' => 'icon-size',
	'value' => rishi__cb_get_akv('cartIconSize', $atts, [
		'mobile' => 15,
		'tablet' => 15,
		'desktop' => 15,
	])
]);


// Icon color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cartHeaderIconColor', $atts),
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

// Text color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cartHeaderTextColor', $atts),
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
			'variable' => 'textInitialColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'textHoverColor'
		],
	],
	'responsive' => true
]);

// Badge color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cartBadgeColor', $atts),
	'default' => [
		'background' => ['color' => 'var(--paletteColor3)'],
		'text' => ['color' => 'var(--paletteColor5)'],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'background' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'cartBadgeBackground'
		],

		'text' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'cartBadgeText'
		],
	],
	'responsive' => true
]);


// transparent state
if (isset($has_transparent_header) && $has_transparent_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentCartHeaderIconColor', $atts),
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
							'to_add' => '> a'
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
							'to_add' => '> a'
						]),

						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'icon-hover-color'
			],
		],
		'responsive' => true
	]);

	// Text Color
	rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentCartHeaderTextColor', $atts),
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
							'to_add' => '> a'
						]),

						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'textInitialColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> a'
						]),

						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'textHoverColor'
			],
		],
		'responsive' => true
	]);

	// Badge color
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentCartBadgeColor', $atts),
		'default' => [
			'background' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'text' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'background' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'cartBadgeBackground'
			],

			'text' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'cartBadgeText'
			],
		],
		'responsive' => true
	]);
}


// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyCartHeaderIconColor', $atts),
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
							'to_add' => '> a'
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
							'to_add' => '> a'
						]),

						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'icon-hover-color'
			],
		],
		'responsive' => true
	]);

	rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyCartHeaderTextColor', $atts),
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
							'to_add' => '> a'
						]),

						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'textInitialColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> a'
						]),

						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'textHoverColor'
			],
		],
		'responsive' => true
	]);

	// Badge color
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyCartBadgeColor', $atts),
		'default' => [
			'background' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'text' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'background' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'cartBadgeBackground'
			],

			'text' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'cartBadgeText'
			],
		],
		'responsive' => true
	]);
}


// Dropdown top offset
$cartDropdownTopOffset = rishi__cb_get_akv('cartDropdownTopOffset', $atts, 15);
$css->put(
 rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.cb__cart-content'
		])
	),
	'--dropdownTopOffset: ' . $cartDropdownTopOffset . 'px'
);

// Cart font color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cartFontColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
		'hover' => ['color' => 'var(--paletteColor3)'],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.cb__cart-content'
				])
			),
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.cb__cart-content'
				])
			),
			'variable' => 'linkHoverColor'
		],
	],
]);

// Cart dropdown
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cartDropDownBackground', $atts),
	'default' => ['default' => ['color' => 'var(--paletteColor5)']],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.cb__cart-content'
				])
			),
			'variable' => 'backgroundColor'
		]
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
		'headerCartMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		])
	)
]);

// panel type
rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '#woo-cart-panel',
	'variableName' => 'side-panel-width',
	'responsive' => true,
	'unit' => '',
	'value' => rishi__cb_get_akv('cart_panel_width', $atts, [
		'desktop' => '500px',
		'tablet' => '65vw',
		'mobile' => '90vw',
	])
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cart_panel_font_color', $atts),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'link_initial' => ['color' => 'var(--headingColor)'],
		'link_hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '#woo-cart-panel',
			'variable' => 'color'
		],

		'link_initial' => [
			'selector' => '#woo-cart-panel',
			'variable' => 'linkInitialColor'
		],

		'link_hover' => [
			'selector' => '#woo-cart-panel',
			'variable' => 'linkHoverColor'
		],
	],
	'responsive' => true
]);

rishi__cb_customizer_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '#woo-cart-panel',
	'value' => rishi__cb_get_akv('cart_panel_shadow', $atts, rishi__cb_customizer_box_shadow_value([
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

rishi__cb_customizer_output_background_css([
	'selector' => '#woo-cart-panel > section',
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'responsive' => true,
	'value' => rishi__cb_get_akv(
		'cart_panel_background',
		$atts,
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'var(--paletteColor5)'
				],
			],
		])
	)
]);

rishi__cb_customizer_output_background_css([
	'selector' => '#woo-cart-panel',
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'responsive' => true,
	'value' => rishi__cb_get_akv(
		'cart_panel_backdrop',
		$atts,
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'rgba(18, 21, 25, 0.6)'
				],
			],
		])
	)
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cart_panel_close_button_color', $atts),
	'default' => [
		'default' => ['color' => 'rgba(0, 0, 0, 0.5)'],
		'hover' => ['color' => 'rgba(0, 0, 0, 0.5)'],
	],
	'css' => $css,

	'variables' => [
		'default' => [
			'selector' => '#woo-cart-panel .close-button',
			'variable' => 'closeButtonColor'
		],

		'hover' => [
			'selector' => '#woo-cart-panel .close-button',
			'variable' => 'closeButtonHoverColor'
		]
	],
]);


rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('cart_panel_close_button_shape_color', $atts),
	'default' => [
		'default' => ['color' => 'rgba(0, 0, 0, 0)'],
		'hover' => ['color' => 'rgba(0, 0, 0, 0)'],
	],
	'css' => $css,

	'variables' => [
		'default' => [
			'selector' => '#woo-cart-panel .close-button',
			'variable' => 'closeButtonBackground'
		],

		'hover' => [
			'selector' => '#woo-cart-panel .close-button',
			'variable' => 'closeButtonHoverBackground'
		]
	],
]);