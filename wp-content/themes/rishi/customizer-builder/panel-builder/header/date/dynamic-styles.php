<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Typography
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv( 'headerDateFont', $atts,
	 rishi__cb_customizer_typography_default_values([
			'size' => '18px',
			'variation' => 'n4',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.header-date-section',
]);

// Icon Size
$icon_size = rishi__cb_get_akv( 'header_date_icon_size', $atts, 18 );

rishi__cb_customizer_output_responsive([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.header-date-section',
	'variableName' => 'icon-size',
	'value'        => $icon_size,
	'responsive'   => true
]);

// Header Date Color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('headerDateColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.header-date-section',
			'variable' => 'headerDateInitialColor'
		],
	],
	'responsive' => true
]);

// Icon Color
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('headerDateIconColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.header-date-section',
			'variable' => 'headerDateInitialIconColor'
		],
	],
	'responsive' => true
]);


// transparent state
if ( isset( $has_transparent_header ) && $has_transparent_header ) {
	rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentHeaderDateColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  =>  rishi__cb_customizer_mutate_selector(
								array(
									'selector'  => $root_selector,
									'operation' => 'suffix',
									'to_add'    => '.header-date-section',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-transparent-row="yes"]',
						)
					)
				),
				'variable' => 'headerDateInitialColor'
			],
		]
	]);

	// Icon Transparent Color
	rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentHeaderDateIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  =>  rishi__cb_customizer_mutate_selector(
								array(
									'selector'  => $root_selector,
									'operation' => 'suffix',
									'to_add'    => '.header-date-section',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-transparent-row="yes"]',
						)
					)
				),
				'variable' => 'headerDateInitialIconColor'
			],
		]
	]);
}

// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
	rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyHeaderDateColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  =>  rishi__cb_customizer_mutate_selector(
								array(
									'selector'  => $root_selector,
									'operation' => 'suffix',
									'to_add'    => '.header-date-section',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-sticky*="yes"]',
						)
					)
				),
				'variable' => 'headerDateInitialColor'
			],
		]
	]);

	rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyHeaderDateIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  =>  rishi__cb_customizer_mutate_selector(
								array(
									'selector'  => $root_selector,
									'operation' => 'suffix',
									'to_add'    => '.header-date-section',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-sticky*="yes"]',
						)
					)
				),
				'variable' => 'headerDateInitialIconColor'
			],
		]
	]);
}