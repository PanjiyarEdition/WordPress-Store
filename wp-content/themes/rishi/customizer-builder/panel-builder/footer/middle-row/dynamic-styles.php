<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Row top & bottom spacing
if (empty($default_top_bottom_spacing)) {
	$default_top_bottom_spacing = [
		'desktop' => '70px',
		'tablet' => '50px',
		'mobile' => '40px',
	];
}

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '> div'
		])
	),
	'variableName' => 'container-spacing',
	'unit' => '',
	'value' => rishi__cb_customizer_default_akg(
		'rowTopBottomSpacing',
		$atts,
		$default_top_bottom_spacing
	)
]);


// Items gap
if (empty($default_items_spacing)) {
	$default_items_spacing = [
		'desktop' => 60,
		'tablet' => 40,
		'mobile' => 40,
	];
}

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '> div'
		])
	),
	'variableName' => 'items-gap',
	'value' => rishi__cb_customizer_default_akg(
		'footerItemsGap',
		$atts,
		$default_items_spacing
	)
]);

// vertical alignment
$vertical_alignment = rishi__cb_customizer_default_akg('footer_row_vertical_alignment', $atts, 'flex-start');

if ($vertical_alignment !== 'flex-start') {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector(
		 rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'operation' => 'suffix',
				'to_add' => '> div'
			])
		),
		'variableName' => 'vertical-alignment',
		'value' => $vertical_alignment,
		'unit' => '',
	]);
}

// Widgets title font & color
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_customizer_default_akg(
		'footerWidgetsTitleFont',
		$atts,
	 rishi__cb_customizer_typography_default_values([
			'size' => '16px',
			'line-height' => '1.75',
			'letter-spacing' => '0.4px',
			'text-transform' => 'uppercase',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.widget-title'
		])
	),
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_customizer_default_akg('footerWidgetsTitleColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.widget-title'
				])
			),
			'variable' => 'headingColor'
		],
	],
]);


// Widgets font & color
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_customizer_default_akg(
		'footerWidgetsFont',
		$atts,
	 rishi__cb_customizer_typography_default_values([
			// 'size' => '16px',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '.widget > *:not(.widget-title)'
		])
	),
]);

// Widgets font color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_customizer_default_akg('rowFontColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)'],
		'link_initial' => ['color' => 'var(--paletteColor5)'],
		'link_hover' => ['color' => 'var(--paletteColor5)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.widget > *:not(.widget-title)'
				])
			),
			'variable' => 'color'
		],

		'link_initial' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.widget'
				])
			),
			'variable' => 'linkInitialColor'
		],

		'link_hover' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.widget'
				])
			),
			'variable' => 'linkHoverColor'
		],
	],
]);

// Widgets headings color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_customizer_default_akg('rowHeadingFontColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
			 rishi__cb_customizer_mutate_selector([
					'selector' => $root_selector,
					'operation' => 'suffix',
					'to_add' => '.widget > *:not(.widget-title)'
				])
			),
			'variable' => 'headingColor'
		],
	],
]);


// Columns divider
rishi__cb_customizer_output_border([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector(
	 rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'suffix',
			'to_add' => '[data-divider="columns"]'
		])
	),
	'variableName' => 'border',
	'value' => rishi__cb_customizer_default_akg('footerColumnsDivider', $atts, [
		'width' => 1,
		'style' => 'none',
		'color' => [
			'color' => '#dddddd',
		],
	]),
]);


// Top border
$footerRowTopBorderFullWidth = rishi__cb_customizer_default_akg('footerRowTopBorderFullWidth', $atts, 'no');

$top_has_border_selector = rishi__cb_customizer_mutate_selector([
	'selector' => $root_selector,
	'operation' => 'suffix',
	'to_add' => '> div'
]);

$top_has_no_border_selector = $root_selector;

if ($footerRowTopBorderFullWidth === 'yes') {
	$top_has_border_selector = $root_selector;

	$top_has_no_border_selector = rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'suffix',
		'to_add' => '> div'
	]);
}

$footerRowTopDivider = rishi__cb_customizer_default_akg('footerRowTopDivider', $atts, [
	'width' => 1,
	'style' => 'none',
	'color' => [
		'color' => '#dddddd',
	],
]);

if (isset($footerRowTopDivider['desktop']) || is_customize_preview()) {
 rishi__cb_customizer_output_border([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($top_has_border_selector),
		'variableName' => 'border-top',
		'value' => $footerRowTopDivider,
		'responsive' => true
	]);

 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($top_has_no_border_selector),
		'variableName' => 'border-top',
		'value' => [
			'desktop' => 'none',
			'tablet' => 'none',
			'mobile' => 'none'
		],
		'unit' => ''
	]);
}



// Bottom border
$footerRowBottomBorderFullWidth = rishi__cb_customizer_default_akg('footerRowBottomBorderFullWidth', $atts, 'no');

$bottom_has_border_selector = rishi__cb_customizer_mutate_selector([
	'selector' => $root_selector,
	'operation' => 'suffix',
	'to_add' => '> div'
]);
$bottom_has_no_border_selector = $root_selector;

if ($footerRowBottomBorderFullWidth === 'yes') {
	$bottom_has_border_selector = $root_selector;

	$bottom_has_no_border_selector = rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'suffix',
		'to_add' => '> div'
	]);
}

$footerRowBottomDivider = rishi__cb_customizer_default_akg('footerRowBottomDivider', $atts, [
	'width' => 1,
	'style' => 'none',
	'color' => [
		'color' => '#dddddd',
	],
]);

if (isset($footerRowBottomDivider['desktop']) || is_customize_preview()) {
 rishi__cb_customizer_output_border([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($bottom_has_border_selector),
		'variableName' => 'border-bottom',
		'value' => $footerRowBottomDivider,
		'responsive' => true
	]);

 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector($bottom_has_no_border_selector),
		'variableName' => 'border-bottom',
		'value' => [
			'desktop' => 'none',
			'tablet' => 'none',
			'mobile' => 'none'
		],
		'unit' => ''
	]);
}


// Row background
if (empty($default_background)) {
	$default_background = rishi__cb_customizer_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => 'var(--paletteColor2)'
			],
		],
	]);
}

rishi__cb_customizer_output_background_css([
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'css' => $css,
	'value' => rishi__cb_customizer_default_akg(
		'footerRowBackground',
		$atts,
		$default_background
	)
]);


$count = count($primary_item['columns']);

$gridTemplate = [
	'desktop' => 'initial',
	'tablet' => 'initial',
	'mobile' => 'initial'
];

if ($count === 2) {
	$gridTemplate = rishi__cb_customizer_default_akg('2_columns_layout', $atts, [
		'desktop' => 'repeat(2, 1fr)',
		'tablet' => 'initial',
		'mobile' => 'initial'
	]);
}

if ($count === 3) {
	$gridTemplate = rishi__cb_customizer_default_akg('3_columns_layout', $atts, [
		'desktop' => 'repeat(3, 1fr)',
		'tablet' => 'initial',
		'mobile' => 'initial',
	]);
}

if ($count === 4) {
	$gridTemplate = rishi__cb_customizer_default_akg('4_columns_layout', $atts, [
		'desktop' => 'repeat(4, 1fr)',
		'tablet' => 'initial',
		'mobile' => 'initial'
	]);
}

if ($count === 5) {
	$gridTemplate = rishi__cb_customizer_default_akg('5_columns_layout', $atts, [
		'desktop' => 'repeat(5, 1fr)',
		'tablet' => 'initial',
		'mobile' => 'initial'
	]);
}

if ($count === 6) {
	$gridTemplate = rishi__cb_customizer_default_akg('6_columns_layout', $atts, [
		'desktop' => 'repeat(6, 1fr)',
		'tablet' => 'initial',
		'mobile' => 'initial'
	]);
}

$css->put(
 rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'suffix',
		'to_add' => '> div'
	])),
	'--grid-template-colummns: ' . $gridTemplate['desktop']
);

$tablet_css->put(
 rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'suffix',
		'to_add' => '> div'
	])),
	'--grid-template-colummns: ' . $gridTemplate['tablet']
);

$mobile_css->put(
 rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'suffix',
		'to_add' => '> div'
	])),
	'--grid-template-colummns: ' . $gridTemplate['mobile']
);
