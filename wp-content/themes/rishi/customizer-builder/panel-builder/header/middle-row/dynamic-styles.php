<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

if (empty($default_height)) {
	$default_height = [
		'mobile' => 70,
		'tablet' => 70,
		'desktop' => 120,
	];
}

if (empty($default_background)) {
	$default_background = rishi__cb_customizer_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => 'var(--paletteColor5)',
			],
		],
	]);
}

// Row height
rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'variableName' => 'height',
	'value' => rishi__cb_get_akv('headerRowHeight', $atts, $default_height)
]);

// Row background
rishi__cb_customizer_output_background_css([
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => rishi__cb_get_akv('headerRowBackground', $atts, $default_background),
	'responsive' => true,
]);


// Top Border
$headerRowTopBorderFullWidth = rishi__cb_get_akv('headerRowTopBorderFullWidth', $atts, 'no');

$top_has_border_selector = rishi__cb_customizer_mutate_selector([
	'selector' => $root_selector,
	'operation' => 'suffix',
	'to_add' => '> div'
]);

$top_has_no_border_selector = $root_selector;

if ($headerRowTopBorderFullWidth === 'yes') {
	$top_has_border_selector = $root_selector;

	$top_has_no_border_selector = rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'suffix',
		'to_add' => '> div'
	]);
}

$headerRowTopBorder = rishi__cb_get_akv('headerRowTopBorder', $atts, [
	'width' => 1,
	'style' => 'none',
	'color' => [
		'color' => 'rgba(44,62,80,0.2)',
	],
]);

rishi__cb_customizer_output_border([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($top_has_border_selector),
	'variableName' => 'borderTop',
	'value' => $headerRowTopBorder,
	'responsive' => true
]);

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($top_has_no_border_selector),
	'variableName' => 'borderTop',
	'value' => [
		'desktop' => 'none',
		'tablet' => 'none',
		'mobile' => 'none'
	],
	'unit' => ''
]);


// Bottom Border
$headerRowBottomBorderFullWidth = rishi__cb_get_akv('headerRowBottomBorderFullWidth', $atts, 'no');

$bottom_has_border_selector = rishi__cb_customizer_mutate_selector([
	'selector' => $root_selector,
	'operation' => 'suffix',
	'to_add' => '> div'
]);
$bottom_has_no_border_selector = $root_selector;

if ($headerRowBottomBorderFullWidth === 'yes') {
	$bottom_has_border_selector = $root_selector;

	$bottom_has_no_border_selector = rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'suffix',
		'to_add' => '> div'
	]);
}

$headerRowBottomBorder = rishi__cb_get_akv('headerRowBottomBorder', $atts, [
	'width' => 1,
	'style' => 'none',
	'color' => [
		'color' => 'rgba(44,62,80,0.2)',
	],
]);

rishi__cb_customizer_output_border([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($bottom_has_border_selector),
	'variableName' => 'borderBottom',
	'value' => $headerRowBottomBorder,
	'responsive' => true
]);

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($bottom_has_no_border_selector),
	'variableName' => 'borderBottom',
	'value' => [
		'desktop' => 'none',
		'tablet' => 'none',
		'mobile' => 'none'
	],
	'unit' => ''
]);

// Box shadow
rishi__cb_customizer_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'value' => rishi__cb_get_akv('headerRowShadow', $atts, rishi__cb_customizer_box_shadow_value([
		'enable' => false,
		'h_offset' => 0,
		'v_offset' => 10,
		'blur' => 20,
		'spread' => 0,
		'inset' => false,
		'color' => [
			'color' => 'rgba(44,62,80,0.05)',
		],
	])),
	'responsive' => true,
	'should_skip_output' => false
]);

// transparent state
if (isset($has_transparent_header) && $has_transparent_header) {
	// background
 rishi__cb_customizer_output_background_css([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'el-prefix',
			'to_add' => '[data-transparent-row="yes"]'
		])),

		'value' => rishi__cb_get_akv(
			'transparentHeaderRowBackground',
			$atts,
		 rishi__cb_customizer_background_default_value([
				'backgroundColor' => [
					'default' => [
						'color' => 'rgba(255,255,255,0)',
					],
				],
			])
		),
		'responsive' => true
	]);

	// Border top
	$transparentHeaderRowTopBorder = rishi__cb_get_akv(
		'transparentHeaderRowTopBorder',
		$atts,
		[
			'width' => 1,
			'style' => 'none',
			'color' => [
				'color' => 'rgba(44,62,80,0.2)',
			],
		]
	);

 rishi__cb_customizer_output_border([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $top_has_border_selector,
			'operation' => 'el-prefix',
			'to_add' => '[data-transparent-row="yes"]'
		])),
		'variableName' => 'borderTop',
		'value' => $transparentHeaderRowTopBorder,
		'responsive' => true
	]);

 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $top_has_no_border_selector,
			'operation' => 'el-prefix',
			'to_add' => '[data-transparent-row="yes"]'
		])),

		'variableName' => 'borderTop',
		'value' => [
			'desktop' => 'none',
			'tablet' => 'none',
			'mobile' => 'none'
		],
		'unit' => ''
	]);

	// Border bottom
	$transparentHeaderRowBottomBorder = rishi__cb_get_akv(
		'transparentHeaderRowBottomBorder',
		$atts,
		[
			'width' => 1,
			'style' => 'none',
			'color' => [
				'color' => 'rgba(44,62,80,0.2)',
			],
		]
	);

 rishi__cb_customizer_output_border([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $bottom_has_border_selector,
			'operation' => 'el-prefix',
			'to_add' => '[data-transparent-row="yes"]'
		])),

		'variableName' => 'borderBottom',
		'value' => $transparentHeaderRowBottomBorder,
		'responsive' => true
	]);

 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $bottom_has_no_border_selector,
			'operation' => 'el-prefix',
			'to_add' => '[data-transparent-row="yes"]'
		])),

		'variableName' => 'borderBottom',
		'value' => [
			'desktop' => 'none',
			'tablet' => 'none',
			'mobile' => 'none'
		],
		'unit' => ''
	]);

	// box shadow
 rishi__cb_customizer_output_box_shadow([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'el-prefix',
			'to_add' => '[data-transparent-row="yes"]'
		])),

		'value' => rishi__cb_get_akv('transparentHeaderRowShadow', $atts, rishi__cb_customizer_box_shadow_value([
			'enable' => false,
			'h_offset' => 0,
			'v_offset' => 10,
			'blur' => 20,
			'spread' => 0,
			'inset' => false,
			'color' => [
				'color' => 'rgba(44,62,80,0.05)',
			],
		])),
		'responsive' => true,
		'should_skip_output' => false
	]);
}

// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
	// background
 rishi__cb_customizer_output_background_css([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'to_add' => '[data-sticky*="yes"]'
		])),

		'value' => rishi__cb_get_akv('stickyHeaderRowBackground', $atts, $default_background),
		'responsive' => true
	]);

	if ( rishi__cb_get_akv('has_sticky_shrink', $atts, 'no') === 'yes') {
	 rishi__cb_customizer_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
				'selector' => $root_selector,
				'to_add' => '[data-sticky]'
			])),
			'variableName' => 'stickyShrink',
			'value' => rishi__cb_get_akv('stickyHeaderRowShrink', $atts, 70),
			'unit' => ''
		]);
	}

	// Border top
	$stickyHeaderRowTopBorder = rishi__cb_get_akv(
		'stickyHeaderRowTopBorder',
		$atts,
		[
			'width' => 1,
			'style' => 'none',
			'color' => [
				'color' => 'rgba(44,62,80,0.2)',
			],
		]
	);

 rishi__cb_customizer_output_border([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $top_has_border_selector,
			'to_add' => '[data-sticky*="yes"]'
		])),
		'variableName' => 'borderTop',
		'value' => $stickyHeaderRowTopBorder,
		'responsive' => true
	]);

 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $top_has_no_border_selector,
			'to_add' => '[data-sticky*="yes"]'
		])),

		'variableName' => 'borderTop',
		'value' => [
			'desktop' => 'none',
			'tablet' => 'none',
			'mobile' => 'none'
		],
		'unit' => ''
	]);

	// Border bottom
	$stickyHeaderRowBottomBorder = rishi__cb_get_akv(
		'stickyHeaderRowBottomBorder',
		$atts,
		[
			'width' => 1,
			'style' => 'none',
			'color' => [
				'color' => 'rgba(44,62,80,0.2)',
			],
		]
	);

 rishi__cb_customizer_output_border([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $bottom_has_border_selector,
			'to_add' => '[data-sticky*="yes"]'
		])),

		'variableName' => 'borderBottom',
		'value' => $stickyHeaderRowBottomBorder,
		'responsive' => true
	]);

 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $bottom_has_no_border_selector,
			'to_add' => '[data-sticky*="yes"]'
		])),

		'variableName' => 'borderBottom',
		'value' => [
			'desktop' => 'none',
			'tablet' => 'none',
			'mobile' => 'none'
		],
		'unit' => ''
	]);

	// box shadow
 rishi__cb_customizer_output_box_shadow([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'to_add' => '[data-sticky*="yes"]'
		])),
		'value' => rishi__cb_get_akv('stickyHeaderRowShadow', $atts, rishi__cb_customizer_box_shadow_value([
			'enable' => false,
			'h_offset' => 0,
			'v_offset' => 10,
			'blur' => 20,
			'spread' => 0,
			'inset' => false,
			'color' => [
				'color' => 'rgba(44,62,80,0.05)',
			],
		])),
		'responsive' => true,
		'should_skip_output' => false
	]);
}
