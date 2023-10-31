<?php
/**
 * Dynamic styles.
 */



if ( ! function_exists( 'rishi__cb_customizer_assemble_selector' ) ) {
	return;
}

// Button Minwidth
$header_button_minwidth = rishi__cb_get_akv( 'header_button_minwidth', $atts, 50 );
rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => rishi__cb_customizer_assemble_selector( $root_selector ),
		'variableName' => 'buttonMinWidth',
		'value'        => $header_button_minwidth,
		'responsive'   => true,
	)
);

// Font color
rishi__cb_customizer_output_colors(
	array(
		'value'      => rishi__cb_get_akv( 'headerButtonFontColor', $atts ),
		'default'    => array(
			'default'   => array( 'color' => 'var(--paletteColor5)' ),
			'hover'     => array( 'color' => 'var(--paletteColor5)' ),

			'default_2' => array( 'color' => 'var(--paletteColor3)' ),
			'hover_2'   => array( 'color' => 'var(--paletteColor2)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default'   => array(
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  => $root_selector,
							'operation' => 'suffix',
							'to_add'    => '.cb__button',
						)
					)
				),
				'variable' => 'buttonTextInitialColor',
			),

			'hover'     => array(
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  => $root_selector,
							'operation' => 'suffix',
							'to_add'    => '.cb__button',
						)
					)
				),
				'variable' => 'buttonTextHoverColor',
			),


			'default_2' => array(
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  => $root_selector,
							'operation' => 'suffix',
							'to_add'    => '.cb__button-ghost',
						)
					)
				),
				'variable' => 'buttonTextInitialColor',
			),

			'hover_2'   => array(
				'selector' => rishi__cb_customizer_assemble_selector(
					rishi__cb_customizer_mutate_selector(
						array(
							'selector'  => $root_selector,
							'operation' => 'suffix',
							'to_add'    => '.cb__button-ghost',
						)
					)
				),
				'variable' => 'buttonTextHoverColor',
			),
		),
		'responsive' => true,
	)
);

// Background color
rishi__cb_customizer_output_colors(
	array(
		'value'      => rishi__cb_get_akv( 'headerButtonForeground', $atts ),
		'default'    => array(
			'default' => array( 'color' => 'var(--paletteColor3)' ),
			'hover'   => array( 'color' => 'var(--paletteColor2)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default' => array(
				'selector' => rishi__cb_customizer_assemble_selector( $root_selector ),
				'variable' => 'buttonInitialColor',
			),

			'hover'   => array(
				'selector' => rishi__cb_customizer_assemble_selector( $root_selector ),
				'variable' => 'buttonHoverColor',
			),
		),
		'responsive' => true,
	)
);


rishi__cb_customizer_output_colors(
	array(
		'value'      => rishi__cb_get_akv( 'header_button_border_color', $atts ),
		'default'    => array(
			'default' => array( 'color' => 'var(--paletteColor3)' ),
			'hover'   => array( 'color' => 'var(--paletteColor2)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default' => array(
				'selector' => rishi__cb_customizer_assemble_selector( $root_selector ),
				'variable' => 'headerButtonBorderColor',
			),
			'hover'   => array(
				'selector' => rishi__cb_customizer_assemble_selector( $root_selector ),
				'variable' => 'headerButtonBorderHoverColor',
			),
		),
		'responsive' => false,
	)
);

if ( isset( $has_transparent_header ) && $has_transparent_header ) {
	rishi__cb_customizer_output_colors(
		array(
			'value'      => rishi__cb_get_akv( 'transparentHeaderButtonFontColor', $atts ),
			'default'    => array(
				'default'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'hover'     => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),

				'default_2' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'hover_2'   => array( 'color' => '#292929' ),
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
										'to_add'    => '.cb__button',
									)
								),
								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'buttonTextInitialColor',
				),

				'hover'     => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__button',
									)
								),

								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'buttonTextHoverColor',
				),

				'default_2' => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__button-ghost',
									)
								),

								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'buttonTextInitialColor',
				),

				'hover_2'   => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__button-ghost',
									)
								),

								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'buttonTextHoverColor',
				),
			),
			'responsive' => true,
		)
	);

	// Background color
	rishi__cb_customizer_output_colors(
		array(
			'value'      => rishi__cb_get_akv( 'transparentHeaderButtonForeground', $atts ),
			'default'    => array(
				'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'hover'   => array( 'color' => '#292929' ),
			),
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,

			'variables'  => array(
				'default' => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => $root_selector,
								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'buttonInitialColor',
				),

				'hover'   => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => $root_selector,
								'operation' => 'between',
								'to_add'    => '[data-transparent-row="yes"]',
							)
						)
					),
					'variable' => 'buttonHoverColor',
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
			'value'      => rishi__cb_get_akv( 'stickyHeaderButtonFontColor', $atts ),
			'default'    => array(
				'default'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'hover'     => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),

				'default_2' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'hover_2'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
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
										'to_add'    => '.cb__button',
									)
								),

								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'buttonTextInitialColor',
				),

				'hover'     => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__button',
									)
								),

								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'buttonTextHoverColor',
				),


				'default_2' => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__button-ghost',
									)
								),

								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'buttonTextInitialColor',
				),

				'hover_2'   => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => rishi__cb_customizer_mutate_selector(
									array(
										'selector'  => $root_selector,
										'operation' => 'suffix',
										'to_add'    => '.cb__button-ghost',
									)
								),

								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'buttonTextHoverColor',
				),
			),
			'responsive' => true,
		)
	);

	rishi__cb_customizer_output_colors(
		array(
			'value'      => rishi__cb_get_akv( 'stickyHeaderButtonForeground', $atts ),
			'default'    => array(
				'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			),
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,

			'variables'  => array(
				'default' => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => $root_selector,
								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'buttonInitialColor',
				),

				'hover'   => array(
					'selector' => rishi__cb_customizer_assemble_selector(
						rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => $root_selector,
								'operation' => 'between',
								'to_add'    => '[data-sticky*="yes"]',
							)
						)
					),
					'variable' => 'buttonHoverColor',
				),
			),
			'responsive' => true,
		)
	);
}


// Margin
rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_assemble_selector( $root_selector ),
		'important'  => true,
		'value'      => rishi__cb_customizer_default_akg(
			'headerCtaMargin',
			$atts,
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
				)
			)
		),
	)
);

// Border radius
rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_assemble_selector( $root_selector ),
		'property'   => 'buttonBorderRadius',
		'value'      => rishi__cb_customizer_default_akg(
			'headerCtaRadius',
			$atts,
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
				)
			)
		),
	)
);

// padding header
rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_assemble_selector( $root_selector ),
		'property'   => 'headerCtaPadding',
		'value'      => rishi__cb_customizer_default_akg(
			'headerCtaPadding',
			$atts,
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => false,
					'top'    => '10px',
					'left'   => '20px',
					'right'  => '20px',
					'bottom' => '10px',
				)
			)
		),
	)
);


// footer button
$horizontal_alignment = rishi__cb_get_akv( 'footer_button_horizontal_alignment', $atts, 'flex-start' );

if ( $horizontal_alignment !== 'flex-start' ) {
	rishi__cb_customizer_output_responsive(
		array(
			'css'          => $css,
			'tablet_css'   => $tablet_css,
			'mobile_css'   => $mobile_css,
			'selector'     => rishi__cb_customizer_assemble_selector(
				rishi__cb_customizer_mutate_selector(
					array(
						'selector'  => $root_selector,
						'operation' => 'replace-last',
						'to_add'    => $column_selector,
					)
				)
			),
			'variableName' => 'horizontal-alignment',
			'value'        => $horizontal_alignment,
			'unit'         => '',
		)
	);
}


$vertical_alignment = rishi__cb_get_akv( 'footer_button_vertical_alignment', $atts, 'CT_CSS_SKIP_RULE' );

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => rishi__cb_customizer_assemble_selector(
			rishi__cb_customizer_mutate_selector(
				array(
					'selector'  => $root_selector,
					'operation' => 'replace-last',
					'to_add'    => $column_selector,
				)
			)
		),
		'variableName' => 'vertical-alignment',
		'value'        => $vertical_alignment,
		'unit'         => '',
	)
);

// Box shadow
rishi__cb_customizer_output_box_shadow(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_assemble_selector(
			rishi__cb_customizer_mutate_selector(
				array(
					'selector'  => $root_selector,
					'operation' => 'suffix',
					'to_add'    => 'a',
				)
			)
		),
		'value'      => rishi__cb_get_akv(
			'headerCTAShadow',
			$atts,
			rishi__cb_customizer_box_shadow_value(
				array(
					'enable'   => true,
					'h_offset' => 0,
					'v_offset' => 5,
					'blur'     => 20,
					'spread'   => 0,
					'inset'    => false,
					'color'    => array(
						'color' => 'rgba(44,62,80,0.05)',
					),
				)
			)
		),
		'responsive' => true,
	)
);

rishi__cb_customizer_output_box_shadow(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_assemble_selector(
			rishi__cb_customizer_mutate_selector(
				array(
					'selector'  => $root_selector,
					'operation' => 'suffix',
					'to_add'    => 'a:hover',
				)
			)
		),
		'value'      => rishi__cb_get_akv(
			'headerCTAShadowHover',
			$atts,
			rishi__cb_customizer_box_shadow_value(
				array(
					'enable'   => true,
					'h_offset' => 0,
					'v_offset' => 5,
					'blur'     => 20,
					'spread'   => 0,
					'inset'    => false,
					'color'    => array(
						'color' => 'rgba(44,62,80,0.05)',
					),
				)
			)
		),
		'responsive' => true,
	)
);
