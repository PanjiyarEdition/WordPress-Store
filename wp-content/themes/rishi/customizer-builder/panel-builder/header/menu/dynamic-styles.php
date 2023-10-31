<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Items spacing
$headerMenuItemsSpacing = rishi__cb_get_akv('headerMenuItemsSpacing', $atts, 25);

if ($headerMenuItemsSpacing !== 25) {
	$css->put(
	 rishi__cb_customizer_assemble_selector($root_selector),
		'--menu-items-spacing: ' . $headerMenuItemsSpacing . 'px'
	);
}


// Items height
$headerMenuItemsHeight = rishi__cb_get_akv('headerMenuItemsHeight', $atts, 100);

if ($headerMenuItemsHeight !== 100) {
	$css->put(
	 rishi__cb_customizer_assemble_selector(
		 rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '> ul > li > a'
			])
		),
		'--menu-item-height: ' . $headerMenuItemsHeight . '%'
	);
}


// Top level font
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv(
		'headerMenuFont',
		$atts,
	 rishi__cb_customizer_typography_default_values([
			'size' => '16px',
			'variation' => 'n4',
			'line-height' => '2.25',
			'text-transform' => 'normal',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '> ul > li > a'
		])
	)
]);

// Font color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('menuFontColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
		'hover' => ['color' => 'var(--paletteColor3)'],
		'hover-type-3' => ['color' => '#ffffff'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '> ul > li > a'
				])
			),
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '> ul > li > a'
				])
			),
			'variable' => 'linkHoverColor'
		],

		'hover-type-3' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '> ul > li > a'
				])
			),
			'variable' => 'colorHoverType3'
		],
	],
]);

// Active indicator color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('menuIndicatorColor', $atts),
	'default' => [
		'active' => ['color' => 'var(--paletteColor3)'],
	],
	'css' => $css,
	'variables' => [
		'active' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'menu-indicator-active-color'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('activeIndicatorbackgroundColor', $atts),
	'default' => [
		'default' => ['color' => 'rgba(80, 129, 245, 0.05)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'activeIndicatorbackgroundColor'
		],
	],
]);

// transparent state
if (isset($has_transparent_header) && $has_transparent_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentMenuFontColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover-type-3' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> ul > li > a'
						]),
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'linkInitialColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> ul > li > a'
						]),
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'linkHoverColor'
			],

			'hover-type-3' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> ul > li > a'
						]),
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'colorHoverType3'
			],
		],
	]);

 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentMenuIndicatorColor', $atts),
		'default' => [
			'active' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,

		'variables' => [
			'active' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'menu-indicator-active-color'
			],
		],
	]);
}

// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyMenuFontColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover-type-3' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> ul > li > a'
						]),
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'linkInitialColor'
			],

			'hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> ul > li > a'
						]),
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'linkHoverColor'
			],

			'hover-type-3' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => rishi__cb_customizer_mutate_selector([
							'selector' => $root_selector,
							'operation' => 'suffix',
							'to_add' => '> ul > li > a'
						]),
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'colorHoverType3'
			],
		],
	]);

 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyMenuIndicatorColor', $atts),
		'default' => [
			'active' => ['color' => 'var(--paletteColor2)'],
		],
		'css' => $css,

		'variables' => [
			'active' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'menu-indicator-active-color'
			],
		],
	]);
}

// Top level margin
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'important' => true,
	'value' => rishi__cb_customizer_default_akg(
		'headerMenuMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'top' => 'auto',
			'bottom' => 'auto',
			'left' => '20px',
			'right' => '20px',
			'linked' => true,
		])
	)
]);

// Dropdown top offset
$dropdownTopOffset = rishi__cb_get_akv('dropdownTopOffset', $atts, 0);

if ($dropdownTopOffset !== 0) {
	$css->put(
	 rishi__cb_customizer_assemble_selector(
		 rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '.sub-menu'
			])
		),
		'--dropdown-top-offset: ' . $dropdownTopOffset . 'px'
	);
}


// Dropdown box width
$dropdownMenuWidth = rishi__cb_get_akv('dropdownMenuWidth', $atts, 200);

if ($dropdownMenuWidth !== 200) {
	$css->put(
	 rishi__cb_customizer_assemble_selector(
		 rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '.sub-menu'
			])
		),
		'--dropdown-width: ' . $dropdownMenuWidth . 'px'
	);
}


// Dropdown items spacing
$dropdownItemsSpacing = rishi__cb_get_akv('dropdownItemsSpacing', $atts, 13);

if ($dropdownItemsSpacing !== 13) {
	$css->put(
	 rishi__cb_customizer_assemble_selector(
		 rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '.sub-menu'
			])
		),
		'--dropdown-items-spacing: ' . $dropdownItemsSpacing . 'px'
	);
}


// Dropdown font
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv(
		'headerDropdownFont',
		$atts,
	 rishi__cb_customizer_typography_default_values([
			'size' => '16px',
			'variation' => 'n4',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.sub-menu'
		])
	),
]);


// Dropdown font color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('headerDropdownFontColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
		'hover' => ['color' => 'var(--paletteColor3)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.sub-menu'
				])
			),
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.sub-menu'
				])
			),
			'variable' => 'linkHoverColor'
		],
	],
]);

// Dropdown divider
$headerDropdownDivider = rishi__cb_get_akv('headerDropdownDivider', $atts, [
	'width' => 1,
	'style' => 'dashed',
	'color' => [
		'color' => 'var(--paletteColor6)',
	],
]);

rishi__cb_customizer_output_border([
	'css' => $css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.sub-menu'
		])
	),
	'variableName' => 'dropdown-divider',
	'value' => $headerDropdownDivider
]);

if ( rishi__cb_customizer_default_akg('dropdown_items_type', $atts, 'simple') === 'padded') {
	if ($headerDropdownDivider['style'] !== 'none') {
		$css->put(
		 rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.sub-menu'
				])
			),
			'--dropdown-items-padding: 0px'
		);
	} else {
		$css->put(
		 rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.menu'
				])
			),
			'--dropdown-divider-margin: 0px'
		);
	}
}

// Dropdown background
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('headerDropdownBackground', $atts),
	'default' => [
		'default' => ['color' => '#29333C'],
		'hover' => ['color' => 'rgba(41,41,41,0.9)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.sub-menu'
				])
			),
			'variable' => 'background-color'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.sub-menu'
				])
			),
			'variable' => 'background-hover-color'
		],
	],
]);

// Box shadow
rishi__cb_customizer_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.sub-menu'
		])
	),
	'value' => rishi__cb_get_akv('headerDropdownShadow', $atts, rishi__cb_customizer_box_shadow_value([
		'enable' => true,
		'h_offset' => 0,
		'v_offset' => 10,
		'blur' => 20,
		'spread' => 0,
		'inset' => false,
		'color' => [
			'color' => 'rgba(41, 51, 61, 0.1)',
		],
	])),
	'responsive' => true
]);

// Border radius
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.sub-menu'
		])
	),
	'property' => 'border-radius',
	'value' => rishi__cb_customizer_default_akg(
		'headerDropdownRadius',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => false,
			'top' => '0px',
			'left' => '2px',
			'right' => '0px',
			'bottom' => '2px',
		])
	)
]);
