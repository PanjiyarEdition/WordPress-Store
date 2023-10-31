<?php

$topButtonOffset  = get_theme_mod( 'topButtonOffset',25 );
$sideButtonOffset = get_theme_mod( 'sideButtonOffset',25 );

$colordefaults = rishi__cb__get_color_defaults();

rishi__cb_customizer_output_colors([
    'value' => get_theme_mod( 'topButtonIconColor', []),
    'default' => [
        'default' => ['color' => $colordefaults['topButtonIconColorDefault']],
        'hover'   => ['color' => $colordefaults['topButtonIconColorHover']],
    ],
    'css' => $css,
    'variables' => [
        'default' => [
            'selector' => ".to_top",
            'variable' => 'topButtonIconColorDefault'
        ],

        'hover' => [
            'selector' => ".to_top",
            'variable' => 'topButtonIconColorHover'
        ],
    ],
]);

rishi__cb_customizer_output_colors([
    'value' => get_theme_mod( 'topButtonShapeBackground', []),
    'default' => [
        'default' => ['color' => $colordefaults['topButtonShapeBackgroundDefault']],
        'hover'   => ['color' => $colordefaults['topButtonShapeBackgroundHover']],
    ],
    'css' => $css,
    'variables' => [
        'default' => [
            'selector' => ".to_top",
            'variable' => 'topButtonShapeBackgroundDefault'
        ],

        'hover' => [
            'selector' => ".to_top",
            'variable' => 'topButtonShapeBackgroundHover'
        ],
    ],
]);


rishi__cb_customizer_output_colors([
    'value' => get_theme_mod( 'topButtonBorderColor', []),
    'default' => [
        'default' => ['color' => $colordefaults['topButtonBorderDefaultColor']],
        'hover'   => ['color' => $colordefaults['topButtonBorderHoverColor']],
    ],
    'css' => $css,
    'variables' => [
        'default' => [
            'selector' => ".to_top",
            'variable' => 'topButtonBorderDefaultColor'
        ],

        'hover' => [
            'selector' => ".to_top",
            'variable' => 'topButtonBorderHoverColor'
        ],
    ],
]);

$top_button_scroll_style  = get_theme_mod( 'top_button_scroll_style','filled' );
$top_button_border        = get_theme_mod( 'top_button_border',1 );
$top_button_border_radius = get_theme_mod( 'top_button_border_radius',1 );
$top_button_padding       = get_theme_mod( 'top_button_padding' );


rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => '.to_top',
    'variableName' => 'topButtonSize',
    'unit'         => '',
    'value' => get_theme_mod('topButtonSize', [
        'mobile' => '12px',
        'tablet' => '12px',
        'desktop' => '12px',
    ]),
]);

rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => '.to_top',
    'variableName' => 'topButtonOffset',
    'unit'         => '',
    'value' => get_theme_mod('topButtonOffset', [
        'mobile' => '25px',
        'tablet' => '25px',
        'desktop' => '25px',
    ]),
]);
rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => '.to_top',
    'variableName' => 'sideButtonOffset',
    'unit'         => '',
    'value' => get_theme_mod('sideButtonOffset', [
        'mobile' => '25px',
        'tablet' => '25px',
        'desktop' => '25px',
    ]),
]);

rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => '.to_top',
    'variableName' => 'top-button-border',
    'value'        => get_theme_mod('top_button_border','1'),
    'responsive'   => false,
]);

rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => '.to_top',
    'variableName' => 'top-button-border-radius',
    'value'        => get_theme_mod('top_button_border_radius','1'),
    'responsive'   => false,
]);

rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.to_top',
	'property' => 'top_button_padding',
	'value' => get_theme_mod(
		'top_button_padding',
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
			'top' => '10px',
			'left' => '10px',
			'right' => '10px',
			'bottom' => '10px',
		])
    ),
    'responsive' => false
]);

// Box shadow
rishi__cb_customizer_output_box_shadow([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.to_top',
	'property'     => 'topButtonShadow',
	'variableName' => 'topButtonShadow',
	'value' => get_theme_mod('topButtonShadow', rishi__cb_customizer_box_shadow_value([
		'enable'   => false,
		'h_offset' => 0,
		'v_offset' => 5,
		'blur'     => 20,
		'spread'   => 0,
		'inset'    => false,
		'color'    => [
			'color' => 'rgba(210, 213, 218, 0.2)',
		],
	])),
	'responsive' => true
]);
