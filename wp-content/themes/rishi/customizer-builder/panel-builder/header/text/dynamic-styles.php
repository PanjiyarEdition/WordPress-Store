<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Container max-width
rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'variableName' => 'maxWidth',
	'value' => rishi__cb_get_akv('headerTextMaxWidth', $atts, [
		'mobile' => 100,
		'tablet' => 100,
		'desktop' => 100,
	]),
	'unit' => '%',
	'responsive' => true,
]);

// Font
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv(
		'headerTextFont',
		$atts,
	 rishi__cb_customizer_typography_default_values([
			'size' => '15px',
			'line-height' => '1.5',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector)
]);

// Font color
rishi__cb_customizer_output_colors(
	array(
		'value'      => rishi__cb_get_akv( 'headerTextColor', $atts ),
		'default'    => array(
			'default'      => array( 'color' => $panel_type === 'footer' ? 'var(--paletteColor5)' : 'var(--paletteColor1)' ),
			'link_initial' => array( 'color' => 'var(--paletteColor3)' ),
			'link_hover'   => array( 'color' => $panel_type === 'footer' ? 'var(--paletteColor5)' : 'var(--paletteColor2)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default'   => array(
				'selector' => rishi__cb_customizer_assemble_selector($root_selector),
				'variable' => 'color',
			),

			'link_initial' => array(
				'selector' => rishi__cb_customizer_assemble_selector($root_selector),
				'variable' => 'linkInitialColor',
			),

			'link_hover'   => array(
				'selector' => rishi__cb_customizer_assemble_selector($root_selector),
				'variable' => 'linkHoverColor',
			),
		),
		'responsive' => true,
	)
);


if ( isset( $has_transparent_header ) && $has_transparent_header ) {
	rishi__cb_customizer_output_colors(
		array(
			'value'      => rishi__cb_get_akv( 'transparentHeaderTextColor', $atts ),
			'default'    => array(
				'default'      => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'link_initial' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'link_hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			),
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,

			'variables'  => array(
				'default'   => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__header-text',
									)
								),
								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'color',
				),

				'link_initial' => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__header-text',
									)
								),
								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'linkInitialColor',
				),

				'link_hover' => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__header-text',
									)
								),
								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'linkHoverColor',
				),
			),
			'responsive' => true,
		)
	);
}

// sticky state
if ( isset( $has_sticky_header ) && $has_sticky_header ) {
	rishi__cb_customizer_output_colors(
		array(
			'value'      => rishi__cb_get_akv( 'stickyHeaderTextColor', $atts ),
			'default'    => array(
				'default'      => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'link_initial' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'link_hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			),
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,

			'variables'  => array(
				'default'   => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__header-text',
									)
								),
								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'color',
				),

				'link_initial'     => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__header-text',
									)
								),
								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'linkInitialColor',
				),


				'link_hover' => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__header-text',
									)
								),
								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'linkHoverColor',
				),
			),
			'responsive' => true,
		)
	);
}

// Margin
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'important' => true,
	'value' => rishi__cb_customizer_default_akg(
		'headerTextMargin',
		$atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		])
	)
]);


// transparent state
if (isset($has_transparent_header) && $has_transparent_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('transparentHeaderTextColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'link_initial' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'link_hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'color'
			],

			'link_initial' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'linkInitialColor'
			],

			'link_hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-transparent-row="yes"]'
					])
				),
				'variable' => 'linkHoverColor'
			],
		],
		'responsive' => true
	]);
}


// sticky state
if (isset($has_sticky_header) && $has_sticky_header) {
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv('stickyHeaderTextColor', $atts),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'link_initial' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'link_hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		],
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,

		'variables' => [
			'default' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'color'
			],

			'link_initial' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'linkInitialColor'
			],

			'link_hover' => [
				'selector' => rishi__cb_customizer_assemble_selector(
				 rishi__cb_customizer_mutate_selector([
						'selector' => $root_selector,
						'operation' => 'between',
						'to_add' => '[data-sticky*="yes"]'
					])
				),
				'variable' => 'linkHoverColor'
			],
		],
		'responsive' => true
	]);
}


// footer html
$horizontal_alignment = rishi__cb_get_akv('footer_html_horizontal_alignment', $atts, 'flex-start');

if ($horizontal_alignment !== 'flex-start') {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
			'selector' => $root_selector,
			'operation' => 'replace-last',
			'to_add' => $column_selector
		])),
		'variableName' => 'horizontal-alignment',
		'value' => $horizontal_alignment,
		'unit' => '',
	]);
}


$vertical_alignment = rishi__cb_get_akv('footer_html_vertical_alignment', $atts, 'CT_CSS_SKIP_RULE');

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector( rishi__cb_customizer_mutate_selector([
		'selector' => $root_selector,
		'operation' => 'replace-last',
		'to_add' => $column_selector
	])),
	'variableName' => 'vertical-alignment',
	'value' => $vertical_alignment,
	'unit' => '',
]);
