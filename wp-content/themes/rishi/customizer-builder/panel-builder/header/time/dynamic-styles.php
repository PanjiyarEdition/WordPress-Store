<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Typography
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv( 'headerTimeFont', $atts,
	 rishi__cb_customizer_typography_default_values([
			'size'      => '18px',
			'variation' => 'n4',
		])
	),
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector'   => '.time-wrapper',
]);

$icon_size = rishi__cb_get_akv( 'header_time_icon_size', $atts, 18 );

rishi__cb_customizer_output_responsive([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.time-wrapper',
	'variableName' => 'icon-size',
	'value'        => $icon_size,
	'responsive'   => true
]);

// Header Time Color
rishi__cb_customizer_output_colors([
	'value'   => rishi__cb_get_akv('headerTimeColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
	],
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables'  => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector(
				rishi__cb_customizer_mutate_selector(
					array(
						'selector'  => $root_selector,
						'operation' => 'suffix',
						'to_add'    => '.time-wrapper',
					)
				)
			),
			'variable' => 'headerTimeInitialColor'
		],
	],
	'responsive' => true
]);

//Icon Color
rishi__cb_customizer_output_colors([
	'value'   => rishi__cb_get_akv('headerTimeIconColor', $atts),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
	],
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables'  => [
		'default' => [
			'selector'  => rishi__cb_customizer_assemble_selector(
				rishi__cb_customizer_mutate_selector(
					array(
						'selector'  => $root_selector,
						'operation' => 'suffix',
						'to_add'    => '.time-wrapper',
					)
				)
			),
			'variable' => 'headerTimeInitialIconColor'
		],
	],
	'responsive' => true
]);


// transparent state
if ( isset( $has_transparent_header ) && $has_transparent_header ) {
	rishi__cb_customizer_output_colors([
		'value'   => rishi__cb_get_akv('transparentHeaderTimeColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css'        => $css,
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
									'to_add'    => '.time-wrapper',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-transparent-row="yes"]',
						)
					)
				),
				'variable' => 'headerTimeInitialColor'
			],
		]
	]);

	// Transparent Icon Color
	rishi__cb_customizer_output_colors([
		'value'   => rishi__cb_get_akv('transparentHeaderTimeIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css'        => $css,
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
									'to_add'    => '.time-wrapper',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-transparent-row="yes"]',
						)
					)
				),
				'variable' => 'headerTimeInitialIconColor'
			],
		]
	]);
}

// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
	rishi__cb_customizer_output_colors([
		'value'   => rishi__cb_get_akv('stickyHeaderTimeColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css'        => $css,
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
									'to_add'    => '.time-wrapper',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-sticky*="yes"]',
						)
					)
				),
				'variable' => 'headerTimeInitialColor'
			],
		]
	]);

	//Sticky Icon Color
	rishi__cb_customizer_output_colors([
		'value'   => rishi__cb_get_akv('stickyHeaderTimeIconColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css'        => $css,
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
									'to_add'    => '.time-wrapper',
								)
							),
							'operation' => 'between',
							'to_add'    => '[data-sticky*="yes"]',
						)
					)
				),
				'variable' => 'headerTimeInitialIconColor'
			],
		]
	]);
}