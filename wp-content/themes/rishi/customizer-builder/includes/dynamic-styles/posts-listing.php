<?php
rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			$prefix . '_cardTitleFont',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'        => array(
						'desktop' => '20px',
						'tablet'  => '20px',
						'mobile'  => '18px',
					),
					'line-height' => '1.3',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_prefix_selector( '.entry-card .entry-title', $prefix ),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardTitleColor' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-card .entry-title', $prefix ),
				'variable' => 'headingColor',
			),
			'hover'   => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-card .entry-title', $prefix ),
				'variable' => 'linkHoverColor',
			),
		),
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			$prefix . '_cardExcerptFont',
			rishi__cb_customizer_typography_default_values(
				array(
					'size' => array(
						'desktop' => '16px',
						'tablet'  => '16px',
						'mobile'  => '16px',
					),
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_prefix_selector( '.entry-excerpt', $prefix ),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardExcerptColor' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-excerpt', $prefix ),
				'variable' => 'color',
			),
		),
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			$prefix . '_cardMetaFont',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'           => array(
						'desktop' => '12px',
						'tablet'  => '12px',
						'mobile'  => '12px',
					),
					'variation'      => 'n6',
					'text-transform' => 'uppercase',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_prefix_selector( '.entry-card .entry-meta', $prefix ),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardMetaColor' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-card .entry-meta', $prefix ),
				'variable' => 'color',
			),

			'hover'   => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-card .entry-meta', $prefix ),
				'variable' => 'linkHoverColor',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardButtonSimpleTextColor' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button[data-type="simple"]', $prefix ),
				'variable' => 'linkInitialColor',
			),

			'hover'   => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button[data-type="simple"]', $prefix ),
				'variable' => 'linkHoverColor',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardButtonBackgroundTextColor' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button[data-type="background"]', $prefix ),
				'variable' => 'buttonTextInitialColor',
			),

			'hover'   => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button[data-type="background"]', $prefix ),
				'variable' => 'buttonTextHoverColor',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardButtonOutlineTextColor' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button[data-type="outline"]', $prefix ),
				'variable' => 'linkInitialColor',
			),

			'hover'   => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button[data-type="outline"]', $prefix ),
				'variable' => 'linkHoverColor',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardButtonColor' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button', $prefix ),
				'variable' => 'buttonInitialColor',
			),

			'hover'   => array(
				'selector' => rishi__cb_customizer_prefix_selector( '.entry-button', $prefix ),
				'variable' => 'buttonHoverColor',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( $prefix . '_cardBackground' ),
		'default'   => array(
			'default' => array( 'color' => '#ffffff' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => rishi__cb_customizer_prefix_selector( '[data-cards="boxed"] .entry-card', $prefix ),
				'variable' => 'cardBackground',
			),
		),
	)
);

rishi__cb_customizer_output_border(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => rishi__cb_customizer_prefix_selector( '[data-cards="boxed"] .entry-card', $prefix ),
		'variableName' => 'border',
		'value'        => get_theme_mod(
			$prefix . '_cardBorder',
			array(
				'width' => 1,
				'style' => 'none',
				'color' => array(
					'color' => 'rgba(44,62,80,0.2)',
				),
			)
		),
		'responsive'   => true,
	)
);

rishi__cb_customizer_output_border(
	array(
		'css'          => $css,
		'selector'     => rishi__cb_customizer_prefix_selector( '.entry-card', $prefix ),
		'variableName' => 'entry-divider',
		'value'        => get_theme_mod(
			$prefix . '_entryDivider',
			array(
				'width' => 1,
				'style' => 'solid',
				'color' => array(
					'color' => 'rgba(224, 229, 235, 0.8)',
				),
			)
		),
	)
);

rishi__cb_customizer_output_border(
	array(
		'css'          => $css,
		'selector'     => rishi__cb_customizer_prefix_selector( '[data-cards="simple"] .entry-card', $prefix ),
		'variableName' => 'border',
		'value'        => get_theme_mod(
			$prefix . '_cardDivider',
			array(
				'width' => 1,
				'style' => 'dashed',
				'color' => array(
					'color' => 'rgba(224, 229, 235, 0.8)',
				),
			)
		),
	)
);

$cards_gap = get_theme_mod( $prefix . '_cardsGap', 30 );

if ( $cards_gap !== 30 ) {
	rishi__cb_customizer_output_responsive(
		array(
			'css'          => $css,
			'tablet_css'   => $tablet_css,
			'mobile_css'   => $mobile_css,
			'selector'     => rishi__cb_customizer_prefix_selector( '.entries', $prefix ),
			'variableName' => 'cardsGap',
			'value'        => $cards_gap,
		)
	);
}

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => rishi__cb_customizer_prefix_selector( '[data-cards="boxed"] .entry-card', $prefix ),
		'variableName' => 'cardSpacing',
		'value'        => get_theme_mod(
			$prefix . '_card_spacing',
			array(
				'mobile'  => 25,
				'tablet'  => 35,
				'desktop' => 35,
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
		'selector'   => rishi__cb_customizer_prefix_selector( '[data-cards="boxed"] .entry-card', $prefix ),
		'property'   => 'borderRadius',
		'value'      => get_theme_mod(
			$prefix . '_cardRadius',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
				)
			)
		),
	)
);

// Box shadow
rishi__cb_customizer_output_box_shadow(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_prefix_selector( '[data-cards="boxed"] .entry-card', $prefix ),
		'value'      => get_theme_mod(
			$prefix . '_cardShadow',
			rishi__cb_customizer_box_shadow_value(
				array(
					'enable'   => true,
					'h_offset' => 0,
					'v_offset' => 12,
					'blur'     => 18,
					'spread'   => -6,
					'inset'    => false,
					'color'    => array(
						'color' => 'rgba(34, 56, 101, 0.04)',
					),
				)
			)
		),
		'responsive' => true,
	)
);

// Featured Image Radius
rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => rishi__cb_customizer_prefix_selector( '.entry-card .rt-image-container', $prefix ),
		'property'   => 'borderRadius',
		'value'      => get_theme_mod(
			$prefix . '_cardThumbRadius',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
				)
			)
		),
	)
);

// divider style
$defaults         = rishi__cb__get_layout_defaults();
$blog_structure   = get_theme_mod( 'archive_blog_post_structure', rishi__cb__get_default_blogpost_structure() );
$position         = 'First';
$divider_position = 'First';
$default          = 'blogCategoryDividerInitialColor';
$hover            = 'blogCategoryDividerHoverColor';
$heading_font     = 'blogHeadingFontSize';
$divider_margin   = 'blogDividerMargin';

if ( is_archive() ) {
	if ( is_author() ) {
		$blog_structure = get_theme_mod( 'author_post_structure', rishi__cb__get_default_blogpost_structure() );
		$default        = 'authorCategoryDividerInitialColor';
		$hover          = 'authorCategoryDividerHoverColor';
		$heading_font   = 'authorHeadingFontSize';
		$divider_margin = 'authorDividerMargin';
	} else {
		$blog_structure = get_theme_mod( 'archive_post_structure', rishi__cb__get_default_blogpost_structure() );
		$default        = 'archiveCategoryDividerInitialColor';
		$hover          = 'archiveCategoryDividerHoverColor';
		$heading_font   = 'archiveHeadingFontSize';
		$divider_margin = 'archiveDividerMargin';
	}
}

if ( is_search() ) {
	$blog_structure = get_theme_mod( 'search_post_structure', rishi__cb__get_default_blogpost_structure() );
	$default        = 'searchCategoryDividerInitialColor';
	$hover          = 'searchCategoryDividerHoverColor';
	$heading_font   = 'searchHeadingFontSize';
	$divider_margin = 'searchDividerMargin';
}

foreach ( $blog_structure as $structure ) {
	if ( $structure['enabled'] == true && $structure['id'] == 'custom_meta' ) {
		foreach ( $structure['meta_elements'] as $meta ) {
			if ( $meta['enabled'] == true && $meta['id'] == 'categories' ) {
				rishi__cb_customizer_output_colors(
					array(
						'value'     => $meta['divider_color'],
						'default'   => array(
							'default' => array( 'color' => 'var(--paletteColor1)' ),
							'hover'   => array( 'color' => 'var(--paletteColor3)' ),
						),
						'css'       => $css,
						'variables' => array(
							'default' => array( 'variable' => $default . $position ),
							'hover'   => array( 'variable' => $hover . $position ),
						),
					)
				);
			}
		}
		$position = 'Second';
	}
	if ( $structure['enabled'] == true && $structure['id'] == 'custom_title' ) {
		rishi__cb_customizer_output_responsive(
			array(
				'css'          => $css,
				'tablet_css'   => $tablet_css,
				'mobile_css'   => $mobile_css,
				'selector'     => ':root',
				'variableName' => $heading_font,
				'value'        => $structure['font_size'],
				'unit'         => '',
			)
		);
	}
	if ( $structure['enabled'] == true && $structure['id'] == 'divider' ) {
		rishi__cb_customizer_output_spacing(
			array(
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
				'selector'   => ':root',
				'property'   => $divider_margin . $divider_position,
				'value'      => $structure['divider_margin'],
			)
		);
		$divider_position = 'Second';
	}
}
