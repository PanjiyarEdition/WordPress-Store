<?php

$colordefaults = rishi__cb__get_color_defaults();

$primary_color = get_theme_mod( 'primary_color' );
// Color primary
rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'primary_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['primary_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'primaryColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'base_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['base_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'baseColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'genheadingColor' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['genheadingColor'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'genheadingColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'genLinkColor' ),
		'default'   => array(
			'default' => array( 'color' => $colordefaults['genLinkColor'] ),
			'hover'   => array( 'color' => $colordefaults['genLinkHoverColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'genLinkColor' ),
			'hover'   => array( 'variable' => 'genLinkHoverColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'textSelectionColor' ),
		'default'   => array(
			'default' => array( 'color' => 'var(--paletteColor5)' ),
			'hover'   => array( 'color' => $colordefaults['textSelectionColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'textSelectionColor' ),
			'hover'   => array( 'variable' => 'textSelectionHoverColor' ),
		),
	)
);


rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'genborderColor' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['genborderColor'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'genborderColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'btn_text_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['btn_text_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'btnTextColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'btn_text_hover_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['btn_text_hover_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'btnTextHoverColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'btn_bg_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['btn_bg_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'btnBgColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'btn_bg_hover_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['btn_bg_hover_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'btnBgHoverColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'btn_border_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['btn_border_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'btnBorderColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'btn_border_hover_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['btn_border_hover_color'] ),
			'selector' => ':root',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'btnBorderHoverColor' ),
		),
	)
);


// $css->put(':root', '--primaryColor: ' . get_theme_mod('primary_color') );

// color pallette
rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'colorPalette' ),
		'default'   => apply_filters( 'rishi__cb_:colorPalette:default', array(
			'color1' => array( 'color' => 'rgba(41, 41, 41, 0.9)' ),
			'color2' => array( 'color' => '#292929' ),
			'color3' => array( 'color' => '#216BDB' ),
			'color4' => array( 'color' => '#5081F5' ),
			'color5' => array( 'color' => '#ffffff' ),
			'color6' => array( 'color' => '#EDF2FE' ),
			'color7' => array( 'color' => '#e9f1fa' ),
			'color8' => array( 'color' => '#F9FBFE' ),
		) ),
		'css'       => $css,
		'variables' => array(
			'color1' => array( 'variable' => 'paletteColor1' ),
			'color2' => array( 'variable' => 'paletteColor2' ),
			'color3' => array( 'variable' => 'paletteColor3' ),
			'color4' => array( 'variable' => 'paletteColor4' ),
			'color5' => array( 'variable' => 'paletteColor5' ),
			'color6' => array( 'variable' => 'paletteColor6' ),
			'color7' => array( 'variable' => 'paletteColor7' ),
			'color8' => array( 'variable' => 'paletteColor8' ),
		),
	)
);

// Colors
rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'fontColor' ),
		'default'   => array(
			'default' => array( 'color' => 'var(--paletteColor2)' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'color' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'linkColor' ),
		'default'   => array(
			'default' => array( 'color' => 'var(--paletteColor1)' ),
			'hover'   => array( 'color' => 'var(--paletteColor2)' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'linkInitialColor' ),
			'hover'   => array( 'variable' => 'linkHoverColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'selectionColor' ),
		'default'   => array(
			'default' => array( 'color' => 'var(--paletteColor5)' ),
			'hover'   => array( 'color' => 'var(--paletteColor1)' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'selectionTextColor' ),
			'hover'   => array( 'variable' => 'selectionBackgroundColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'border_color' ),
		'default'   => array(
			'default' => array( 'color' => 'rgba(224, 229, 235, 0.9)' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'border-color' ),
		),
	)
);


// Heading
rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'headingColor' ),
		'default'   => array(
			'default' => array( 'color' => 'var(--paletteColor4)' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => ':root',
				'variable' => 'headingColor',
			),
		),
	)
);

// Content spacing
$contentSpacingMap = array(
	'none'        => '0',
	'compact'     => '0.8em',
	'comfortable' => '1.5em',
	'spacious'    => '2em',
);

$contentSpacing = get_theme_mod( 'contentSpacing', 'comfortable' );

$contentSpacing = isset(
	$contentSpacingMap[ $contentSpacing ]
) ? $contentSpacingMap[ $contentSpacing ] : $contentSpacingMap['comfortable'];

$css->put( ':root', '--contentSpacing: ' . $contentSpacing );

// Buttons
$buttondefaults = rishi__cb__get_button_defaults();

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => ':root',
		'variableName' => 'bottonRoundness',
		'value'        => get_theme_mod(
			'botton_roundness',
			array(
				'desktop' => $buttondefaults['botton_roundness']['desktop'],
				'tablet'  => $buttondefaults['botton_roundness']['tablet'],
				'mobile'  => $buttondefaults['botton_roundness']['mobile'],
			)
		),
		'unit'         => '',
	)
);


rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => ':root',
		'property'   => 'buttonPadding',
		'value'      => get_theme_mod(
			'button_padding',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
					'top'    => $buttondefaults['button_padding']['top'],
					'left'   => $buttondefaults['button_padding']['left'],
					'right'  => $buttondefaults['button_padding']['right'],
					'bottom' => $buttondefaults['button_padding']['bottom'],
				)
			)
		),
	)
);


rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => ':root',
		'variableName' => 'buttonMinHeight',
		'value'        => get_theme_mod(
			'buttonMinHeight',
			array(
				'mobile'  => 45,
				'tablet'  => 45,
				'desktop' => 45,
			)
		),
	)
);

if ( get_theme_mod( 'buttonHoverEffect', 'yes' ) !== 'yes' ) {
	$css->put( ':root', '--buttonShadow: none' );
	$css->put( ':root', '--buttonTransform: none' );
}

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => ':root',
		'property'   => 'buttonBorderRadius',
		'value'      => get_theme_mod(
			'buttonRadius',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
					'top'    => '3px',
					'left'   => '3px',
					'right'  => '3px',
					'bottom' => '3px',
				)
			)
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'buttonTextColor' ),
		'default'   => array(
			'default' => array( 'color' => 'var(--paletteColor5)' ),
			'hover'   => array( 'color' => 'var(--paletteColor5)' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'buttonTextInitialColor' ),
			'hover'   => array( 'variable' => 'buttonTextHoverColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'buttonColor' ),
		'default'   => array(
			'default' => array( 'color' => 'var(--paletteColor3)' ),
			'hover'   => array( 'color' => 'var(--paletteColor2)' ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'buttonInitialColor' ),
			'hover'   => array( 'variable' => 'buttonHoverColor' ),
		),
	)
);

// Layout
$max_site_width = get_theme_mod( 'maxSiteWidth', 1290 );
$css->put(
	':root',
	'--container-max-width: ' . $max_site_width . 'px'
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => ':root',
		'variableName' => 'content-vertical-spacing',
		'unit'         => '',
		'value'        => get_theme_mod(
			'contentAreaSpacing',
			array(
				'desktop' => '60px',
				'tablet'  => '60px',
				'mobile'  => '50px',

			)
		),
	)
);

$narrowContainerWidth = get_theme_mod( 'narrowContainerWidth', 750 );
$css->put(
	':root',
	'--narrow-container-max-width: ' . $narrowContainerWidth . 'px'
);

$wideOffset = get_theme_mod( 'wideOffset', 130 );
$css->put(
	':root',
	'--wide-offset: ' . $wideOffset . 'px'
);

// Sidebar
$sidebar_width = get_theme_mod( 'sidebarWidth', '27' );
$css->put( ':root', '--sidebarWidth: ' . $sidebar_width . '%' );
$css->put( ':root', '--sidebarWidthNoUnit: ' . intval( $sidebar_width ) );

$sidebarGap = rishi__cb_customizer_get_with_percentage( 'sidebarGap', '4%' );
$css->put( ':root', '--sidebarGap: ' . $sidebarGap );

$sidebarOffset = get_theme_mod( 'sidebarOffset', '50' );
$css->put( ':root', '--sidebarOffset: ' . $sidebarOffset . 'px' );

$defaults = rishi__cb__get_layout_defaults();

$content_sidebar_width = get_theme_mod( 'content_sidebar_width', $defaults['content_sidebar_width'] );

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => ':root',
		'variableName' => 'contentSidebarWidth',
		'unit'         => '%',
		'value'        => $content_sidebar_width,
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => ':root',
		'variableName' => 'sidebarWidgetSpacing',
		'unit'         => '',
		'value'        => get_theme_mod(
			'sidebar_widget_spacing',
			array(
				'desktop' => $defaults['sidebar_widget_spacing']['desktop'],
				'tablet'  => $defaults['sidebar_widget_spacing']['tablet'],
				'mobile'  => $defaults['sidebar_widget_spacing']['mobile'],
			)
		),
	)
);


rishi__cb_customizer_output_colors(
	array(
		'value'      => get_theme_mod( 'sidebarWidgetsTitleColor' ),
		'default'    => array(
			'default' => array( 'color' => 'var(--sidebarWidgetsTitleColor)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default' => array(
				'selector' => '#secondary',
				'variable' => 'widgetsHeadingColor',
			),
		),
		'responsive' => true,
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'      => get_theme_mod( 'widgets_link_color' ),
		'default'    => array(
			'default' => array( 'color' => 'var(--primaryColor)' ),
			'hover'   => array( 'color' => 'var(--paletteColor3)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default' => array(
				'selector' => '.widget-area > *',
				'variable' => 'widgetsLinkColor',
			),
			'hover'   => array(
				'selector' => '.widget-area',
				'variable' => 'widgetsLinkHoverColor',
			),
		),
		'responsive' => true,
	)
);


rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '#secondary',
		'variableName' => 'widgetsFontSize',
		'value'        => get_theme_mod(
			'widgets_font_size',
			array(
				'desktop' => $defaults['widgets_font_size']['desktop'],
				'tablet'  => $defaults['widgets_font_size']['tablet'],
				'mobile'  => $defaults['widgets_font_size']['mobile'],
			)
		),
		'unit'         => '',
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => ':root',
		'property'   => 'widgetsContentAreaSpacing',
		'value'      => get_theme_mod(
			'widgets_content_area_spacing',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
					'top'    => '0',
					'left'   => '20px',
					'right'  => '0',
					'bottom' => '20px',
				)
			)
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'      => get_theme_mod( 'sidebarWidgetsHeadingFontColor' ),
		'default'    => array(
			'default' => array( 'color' => 'var(--paletteColor2)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default' => array(
				'selector' => '.widget > *:not(.widget-title)',
				'variable' => 'headingColor',
			),
		),
		'responsive' => true,
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'      => get_theme_mod( 'sidebarBackgroundColor' ),
		'default'    => array(
			'default' => array( 'color' => 'var(--paletteColor5)' ),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default' => array(
				'selector' => '.widget-area',
				'variable' => 'sidebarBackgroundColor',
			),
		),
		'responsive' => true,
	)
);

// Sidebar border
rishi__cb_customizer_output_border(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.widget-area',
		'variableName' => 'border',
		'value'        => get_theme_mod(
			'sidebarBorder',
			array(
				'width' => 1,
				'style' => 'none',
				'color' => array(
					'color' => 'var(--paletteColor6)',
				),
			)
		),
		'responsive'   => true,
	)
);

rishi__cb_customizer_output_border(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.widget-area',
		'variableName' => 'border',
		'value'        => get_theme_mod(
			'sidebarDivider',
			array(
				'width' => 1,
				'style' => 'solid',
				'color' => array(
					'color' => 'var(--paletteColor6)',
				),
			)
		),
		'responsive'   => true,
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.widget-area',
		'variableName' => 'sidebar-widgets-spacing',
		'value'        => get_theme_mod(
			'sidebarWidgetsSpacing',
			array(
				'desktop' => 60,
				'tablet'  => 40,
				'mobile'  => 40,
			)
		),
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.widget-area',
		'variableName' => 'sidebarInnerSpacing',
		'value'        => get_theme_mod(
			'sidebarInnerSpacing',
			array(
				'mobile'  => 35,
				'tablet'  => 35,
				'desktop' => 35,
			)
		),
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.widget-area',
		'property'   => 'borderRadius',
		'value'      => get_theme_mod(
			'sidebarRadius',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
				)
			)
		),
	)
);

// Sidebar shadow
rishi__cb_customizer_output_box_shadow(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.widget-area',
		'value'      => get_theme_mod(
			'sidebarShadow',
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
// Passepartout
$has_passepartout = get_theme_mod( 'has_passepartout', 'no' );

if ( $has_passepartout !== 'no' || is_customize_preview() ) {
	rishi__cb_customizer_output_responsive(
		array(
			'css'          => $css,
			'tablet_css'   => $tablet_css,
			'mobile_css'   => $mobile_css,
			'selector'     => '[data-frame]',
			'variableName' => 'frame-size',
			'value'        => get_theme_mod( 'passepartoutSize', 10 ),
		)
	);

	rishi__cb_customizer_output_colors(
		array(
			'value'     => get_theme_mod( 'passepartoutColor' ),
			'default'   => array(
				'default' => array( 'color' => 'var(--paletteColor1)' ),
			),
			'css'       => $css,
			'variables' => array(
				'default' => array(
					'selector' => '[data-frame]',
					'variable' => 'frame-color',
				),
			),
		)
	);
}

// breadcrumbs
rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'breadcrumbs_color' ),
		'default'   => array(
			'default' => array( 'color' => $colordefaults['breadcrumbsColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => ':root',
				'variable' => 'breadcrumbsColor',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'breadcrumbs_current_color' ),
		'default'   => array(
			'default' => array( 'color' => $colordefaults['breadcrumbsCurrentColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => ':root',
				'variable' => 'breadcrumbsCurrentColor',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'breadcrumbsSeparatorColor' ),
		'default'   => array(
			'default' => array( 'color' => $colordefaults['breadcrumbsSeparatorColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => ':root',
				'variable' => 'breadcrumbsSeparatorColor',
			),
		),
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.rishi-breadcrumb-main-wrap',
		'variableName' => 'alignment',
		'value'        => get_theme_mod( 'breadcrumbs_alignment', 'left' ),
		'unit'         => '',
		'responsive'   => false,
	)
);

// pages settings

$prefixpage = 'single_page_';

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.page .entry-header',
		'variableName' => 'alignment',
		'value'        => get_theme_mod( $prefixpage . 'alignment', 'left' ),
		'unit'         => '',
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.page .entry-header',
		'variableName' => 'margin-bottom',
		'value'        => get_theme_mod(
			$prefixpage . 'margin',
			array(
				'desktop' => 50,
				'tablet'  => 30,
				'mobile'  => 30,
			)
		),
	)
);

rishi__cb_customizer_output_background_css(
	array(
		'selector'   => '.box-layout.page .main-content-wrapper, .content-box-layout.page .main-content-wrapper',
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod(
			$prefixpage . 'content_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => 'var(--paletteColor5)',
						),
					),
				)
			)
		),
		'responsive' => true,
	)
);


rishi__cb_customizer_output_box_shadow(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.box-layout.page .main-content-wrapper, .content-box-layout.page .main-content-wrapper',
		'variableName' => 'box-shadow',
		'value'        => get_theme_mod(
			$prefixpage . 'content_boxed_shadow',
			rishi__cb_customizer_box_shadow_value(
				array(
					'enable'   => false,
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
		'responsive'   => true,
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.box-layout.page .main-content-wrapper, .content-box-layout.page .main-content-wrapper',
		'property'   => 'padding',
		'value'      => get_theme_mod(
			$prefixpage . 'boxed_content_spacing',
			array(
				'desktop' => rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '40px',
						'left'   => '40px',
						'right'  => '40px',
						'bottom' => '40px',
					)
				),
				'tablet'  => rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '15px',
						'left'   => '15px',
						'right'  => '15px',
						'bottom' => '15px',
					)
				),
				'mobile'  => rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '15px',
						'left'   => '15px',
						'right'  => '15px',
						'bottom' => '15px',
					)
				),
			)
		),
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.box-layout.page .main-content-wrapper, .content-box-layout.page .main-content-wrapper',
		'property'   => 'box-radius',
		'value'      => get_theme_mod(
			$prefixpage . 'content_boxed_radius',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
					'top'    => '3px',
					'left'   => '3px',
					'right'  => '3px',
					'bottom' => '3px',
				)
			)
		),
	)
);

// single post

$prefixpost = 'single_post_';

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'linkHighlightColor' ),
		'default'   => array(
			'default' => array( 'color' => $colordefaults['linkHighlightColor'] ),
			'hover'   => array( 'color' => $colordefaults['linkHighlightHoverColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'linkHighlightColor' ),
			'hover'   => array( 'variable' => 'linkHighlightHoverColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'linkHighlightBackgroundColor' ),
		'default'   => array(
			'default' => array( 'color' => $colordefaults['linkHighlightBackgroundColor'] ),
			'hover'   => array( 'color' => $colordefaults['linkHighlightBackgroundHoverColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'linkHighlightBackgroundColor' ),
			'hover'   => array( 'variable' => 'linkHighlightBackgroundHoverColor' ),
		),
	)
);



rishi__cb_customizer_output_background_css([
		'selector'   => '.box-layout.single .main-content-wrapper, .content-box-layout.single .main-content-wrapper',
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod(
			$prefixpost . 'content_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => 'var(--paletteColor5)',
						),
					),
				)
			)
		),
		'responsive' => true,
	]);

rishi__cb_customizer_output_box_shadow(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.box-layout.single .main-content-wrapper, .content-box-layout.single .main-content-wrapper',
		'variableName' => 'box-shadow',
		'value'        => get_theme_mod(
			$prefixpost . 'content_boxed_shadow',
			rishi__cb_customizer_box_shadow_value(
				array(
					'enable'   => false,
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
		'responsive'   => true,
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.box-layout.single .main-content-wrapper, .content-box-layout.single .main-content-wrapper',
		'property'   => 'padding',
		'value'      => get_theme_mod(
			$prefixpost . 'boxed_content_spacing',
			array(
				'desktop' => rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '40px',
						'left'   => '40px',
						'right'  => '40px',
						'bottom' => '40px',
					)
				),
				'tablet'  => rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '15px',
						'left'   => '15px',
						'right'  => '15px',
						'bottom' => '15px',
					)
				),
				'mobile'  => rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '15px',
						'left'   => '15px',
						'right'  => '15px',
						'bottom' => '15px',
					)
				),
			)
		),
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.box-layout.single .main-content-wrapper, .content-box-layout.single .main-content-wrapper',
		'property'   => 'box-radius',
		'value'      => get_theme_mod(
			$prefixpost . 'content_boxed_radius',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
					'top'    => '3px',
					'left'   => '3px',
					'right'  => '3px',
					'bottom' => '3px',
				)
			)
		),
	)
);

// author page
rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.archive.author .site-content .archive-title-wrapper',
		'variableName' => 'width',
		'value'        => get_theme_mod(
			'author_page_avatar_size',
			array(
				'desktop' => 142,
				'tablet'  => 100,
				'mobile'  => 80,
			)
		),
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.archive.author .site-content .archive-title-wrapper',
		'variableName' => 'margin',
		'value'        => get_theme_mod(
			'author_page_margin',
			array(
				'desktop' => 78,
				'tablet'  => 30,
				'mobile'  => 30,
			)
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod( 'author_page_color' ),
		'default'    => array(
			'default'  => array( 'color' => 'var(--paletteColor2)' ),
			'selector' => '.archive.author .site-content .archive-title-wrapper',
		),
		'variables'  => array(
			'default' => array( 'variable' => 'authorFontColor' ),
		),
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.archive.author .site-content .archive-title-wrapper',
		'variableName' => 'alignment',
		'value'        => get_theme_mod( 'author_page_alignment', 'left' ),
		'unit'         => '',
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.archive.author .site-content .archive-title-wrapper',
		'variableName' => 'authorMargin',
		'value'        => get_theme_mod( 'author_page_author_margin', 30 ),
		'responsive'   => false,
	)
);

rishi__cb_customizer_output_background_css(
	array(
		'selector'   => '.archive.author .site-content .archive-title-wrapper',
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod(
			'author_page_header_content_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => 'var(--paletteColor7)',
						),
					),
				)
			)
		),
		'responsive' => true,
	)
);

// search page
rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.search .site-content .archive-title-wrapper',
		'variableName' => 'alignment',
		'value'        => get_theme_mod( 'search_page_alignment', 'left' ),
		'unit'         => '',
		'responsive'   => false,
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.search .site-content .archive-title-wrapper',
		'variableName' => 'margin',
		'value'        => get_theme_mod(
			'search_page_margin',
			array(
				'desktop' => 78,
				'tablet'  => 30,
				'mobile'  => 30,
			)
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'search_font_color' ),
		'default'   => array(
			'default'  => array( 'color' => 'var(--paletteColor2)' ),
			'selector' => '.search .site-content .archive-title-wrapper',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'searchFontColor' ),
		),
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.search .site-content .archive-title-wrapper',
		'variableName' => 'searchMargin',
		'value'        => get_theme_mod( 'search_page_search_margin', 30 ),
		'responsive'   => false,
	)
);

rishi__cb_customizer_output_background_css(
	array(
		'selector'   => '.search .site-content .archive-title-wrapper',
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod(
			'search_page_header_content_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => 'var(--paletteColor7)',
						),
					),
				)
			)
		),
		'responsive' => true,
	)
);

// archive pages
rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.archive .site-content .archive-title-wrapper',
		'variableName' => 'margin',
		'value'        => get_theme_mod(
			'archive_page_margin',
			array(
				'desktop' => 60,
				'tablet'  => 30,
				'mobile'  => 30,
			)
		),
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.archive .site-content .archive-title-wrapper',
		'variableName' => 'alignment',
		'value'        => get_theme_mod( 'archive_page_alignment', 'left' ),
		'unit'         => '',
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.archive .site-content .archive-title-wrapper',
		'variableName' => 'archiveMargin',
		'value'        => get_theme_mod( 'archive_page_archive_margin', 30 ),
		'responsive'   => false,
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'archive_font_title_color' ),
		'default'   => array(
			'default'  => array( 'color' => 'var(--paletteColor2)' ),
			'selector' => '.archive .site-content .archive-title-wrapper',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'archiveFontColor' ),
		),
	)
);

rishi__cb_customizer_output_background_css(
	array(
		'selector'   => '.archive .site-content .archive-title-wrapper',
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod(
			'archive_page_header_content_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => 'var(--paletteColor7)',
						),
					),
				)
			)
		),
		'responsive' => true,
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'blog_font_title_color' ),
		'default'   => array(
			'default'  => array( 'color' => 'var(--paletteColor2)' ),
			'selector' => '.blog .site-content .archive-title-wrapper',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'blogFontColor' ),
		),
	)
);

rishi__cb_customizer_output_background_css(
	array(
		'selector'   => '.blog .site-content .archive-title-wrapper',
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod(
			'blog_page_header_content_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => 'var(--paletteColor7)',
						),
					),
				)
			)
		),
		'responsive' => true,
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.blog .site-content .archive-title-wrapper',
		'variableName' => 'alignment',
		'value'        => get_theme_mod( 'blog_page_alignment', 'left' ),
		'unit'         => '',
	)
);

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.blog .site-content .archive-title-wrapper',
		'variableName' => 'margin',
		'value'        => get_theme_mod(
			'blog_page_margin',
			array(
				'desktop' => 20,
				'tablet'  => 20,
				'mobile'  => 20,
			)
		),
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.rishi-breadcrumb-main-wrap',
		'property'   => 'padding',
		'value'      => get_theme_mod(
			'breadcrumbsPadding',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => false,
					'top'    => '0px',
					'left'   => '0px',
					'right'  => '0px',
					'bottom' => '10px',
				)
			)
		)
	)
);