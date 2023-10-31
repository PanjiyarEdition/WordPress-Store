<?php

$defaults = rishi__cb__get_color_defaults();

// Color palette
$colorPalette = rishi__cb_customizer_get_colors(
	get_theme_mod( 'colorPalette' ),
	array(
		'color1' => array( 'color' => 'rgba(41, 41, 41, 0.9)' ),
		'color2' => array( 'color' => '#292929' ),
		'color3' => array( 'color' => '#216BDB' ),
		'color4' => array( 'color' => '#5081F5' ),
		'color5' => array( 'color' => '#ffffff' ),
		'color6' => array( 'color' => '#EDF2FE' ),
		'color7' => array( 'color' => '#e9f1fa' ),
		'color8' => array( 'color' => '#F9FBFE' ),
	)
);

$css->put(
	':root',
	"--paletteColor1: {$colorPalette['color1']}"
);

$css->put(
	':root',
	"--paletteColor2: {$colorPalette['color2']}"
);

$css->put(
	':root',
	"--paletteColor3: {$colorPalette['color3']}"
);

$css->put(
	':root',
	"--paletteColor4: {$colorPalette['color4']}"
);

$css->put(
	':root',
	"--paletteColor5: {$colorPalette['color5']}"
);

$css->put(
	':root',
	"--paletteColor6: {$colorPalette['color6']}"
);

$css->put(
	':root',
	"--paletteColor7: {$colorPalette['color7']}"
);

$css->put(
	':root',
	"--paletteColor8: {$colorPalette['color8']}"
);


// base color
rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'base_color' ),
		'default'   => array(
			'default'  => array( 'color' => $defaults['base_color'] ),
			'selector' => ':root .block-editor-page',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'adminBaseColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'genheadingColor' ),
		'default'   => array(
			'default'  => array( 'color' => $defaults['genheadingColor'] ),
			'selector' => ':root .block-editor-page',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'adminGenHeadingColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'primary_color' ),
		'default'   => array(
			'default'  => array( 'color' => $defaults['primary_color'] ),
			'selector' => ':root .block-editor-page',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'adminprimaryColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'base_color' ),
		'default'   => array(
			'default'  => array( 'color' => $defaults['base_color'] ),
			'selector' => ':root .block-editor-page',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'adminbaseColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'genheadingColor' ),
		'default'   => array(
			'default'  => array( 'color' => $defaults['genheadingColor'] ),
			'selector' => ':root .block-editor-page',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'admingenheadingColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'genLinkColor' ),
		'default'   => array(
			'default' => array( 'color' => $defaults['genLinkColor'] ),
			'hover'   => array( 'color' => $defaults['genLinkHoverColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'admingenLinkColor' ),
			'hover'   => array( 'variable' => 'admingenLinkHoverColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'textSelectionColor' ),
		'default'   => array(
			'default' => array( 'color' => '#ffffff' ),
			'hover'   => array( 'color' => $defaults['textSelectionColor'] ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'admintextSelectionColor' ),
			'hover'   => array( 'variable' => 'admintextSelectionHoverColor' ),
		),
	)
);


rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'genborderColor' ),
		'default'   => array(
			'default'  => array( 'color' => $defaults['genborderColor'] ),
			'selector' => ':root .block-editor-page',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'admingenborderColor' ),
		),
	)
);

$layoutsdefaults = rishi__cb__get_layout_defaults();

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => ':root',
		'variableName' => 'adminContainerWidth',
		'unit'         => '',
		'value'        => get_theme_mod(
			'container_width',
			array(
				'desktop' => $layoutsdefaults['container_width']['desktop'],
				'tablet'  => $layoutsdefaults['container_width']['tablet'],
				'mobile'  => $layoutsdefaults['container_width']['mobile'],
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
		'variableName' => 'adminContainerContentMaxWidth',
		'unit'         => '',
		'value'        => get_theme_mod(
			'container_content_max_width',
			array(
				'desktop' => $layoutsdefaults['container_content_max_width']['desktop'],
				'tablet'  => $layoutsdefaults['container_content_max_width']['tablet'],
				'mobile'  => $layoutsdefaults['container_content_max_width']['mobile'],
			)
		),
	)
);

// Buttons
$buttondefaults = rishi__cb__get_button_defaults();

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => ':root',
		'variableName' => 'adminBottonRoundness',
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
		'property'   => 'adminButtonPadding',
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

$buttonTextColor = rishi__cb_customizer_get_colors(
	get_theme_mod( 'buttonTextColor' ),
	array(
		'default' => array( 'color' => '#ffffff' ),
		'hover'   => array( 'color' => '#ffffff' ),
	)
);

$colordefaults = rishi__cb__get_color_defaults();

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'btn_text_color' ),
		'default'   => array(
			'default'  => array( 'color' => $colordefaults['btn_text_color'] ),
			'selector' => ':root .block-editor-page',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'adminBtnTextColor' ),
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
			'default' => array( 'variable' => 'adminBtnTextHoverColor' ),
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
			'default' => array( 'variable' => 'adminBtnBgColor' ),
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
			'default' => array( 'variable' => 'adminBtnBgHoverColor' ),
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
			'default' => array( 'variable' => 'adminBtnBorderColor' ),
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
			'default' => array( 'variable' => 'adminBtnBorderHoverColor' ),
		),
	)
);

$css->put(
	':root .block-editor-page',
	"--buttonTextInitialColor: {$buttonTextColor['default']}"
);

$css->put(
	':root .block-editor-page',
	"--buttonTextHoverColor: {$buttonTextColor['hover']}"
);

$button_color = rishi__cb_customizer_get_colors(
	get_theme_mod( 'buttonColor' ),
	array(
		'default' => array( 'color' => 'var(--paletteColor1)' ),
		'hover'   => array( 'color' => 'var(--paletteColor2)' ),
	)
);

$css->put(
	':root .block-editor-page',
	"--buttonInitialColor: {$button_color['default']}"
);

$css->put(
	':root .block-editor-page',
	"--buttonHoverColor: {$button_color['hover']}"
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'global_quantity_color' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => ':root .block-editor-page',
				'variable' => 'quantity-initial-color',
			),

			'hover'   => array(
				'selector' => ':root .block-editor-page',
				'variable' => 'quantity-hover-color',
			),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'global_quantity_arrows' ),
		'default'   => array(
			'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
		),
		'css'       => $css,
		'variables' => array(
			'default' => array(
				'selector' => ':root .block-editor-page',
				'variable' => 'quantity-arrows-initial-color',
			),

			'hover'   => array(
				'selector' => ':root .block-editor-page',
				'variable' => 'quantity-arrows-hover-color',
			),
		),
	)
);

if (
	function_exists( 'get_current_screen' )
	&&
	get_current_screen()
	&&
	get_current_screen()->is_block_editor()
) {
	if ( get_current_screen()->base === 'post' ) {
		rishi__cb_customizer_theme_get_dynamic_styles(
			array(
				'name'       => 'editor',
				'css'        => $css,
				'mobile_css' => $mobile_css,
				'tablet_css' => $tablet_css,
				'context'    => $context,
				'chunk'      => 'admin',
			)
		);
	}

	rishi__cb_customizer_theme_get_dynamic_styles(
		array(
			'name'       => 'typography',
			'css'        => $css,
			'mobile_css' => $mobile_css,
			'tablet_css' => $tablet_css,
			'context'    => 'inline',
			'chunk'      => 'admin',
		)
	);

	rishi__cb_customizer_output_responsive(
		array(
			'css'          => $css,
			'tablet_css'   => $tablet_css,
			'mobile_css'   => $mobile_css,
			'selector'     => ':root .block-editor-page',
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

	rishi__cb_customizer_output_spacing(
		array(
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector'   => ':root .block-editor-page',
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
}
