<?php
//font
rishi__cb_customizer_output_font_css( [
	'font_value' => get_theme_mod( 'cookieContenttypo',
		rishi__cb_customizer_typography_default_values( [
			'family'         => 'System Default',
			'size' => [
				'desktop' => '16px',
				'tablet'  => '16px',
				'mobile'  => '16px'
			],
			'variation'   => 'n4',
			'line-height' => '1.5'
		] )
	),
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector'   => '.cookie-notification',
] );

// Content color
rishi__cb_customizer_output_colors ( [
	'value' => get_theme_mod('cookieContentColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor1)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'color'
		],
	],
]);

// Icon color
rishi__cb_customizer_output_colors ( [
	'value' => get_theme_mod('cookieIconColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'iconColor'
		],
	],
]);

// Primary Button color
rishi__cb_customizer_output_colors( [
	'value' => get_theme_mod('cookieButtonBackground'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor5)' ],
		'hover' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonInitialColor'
		],

		'hover' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonHoverColor'
		]
	],
]);

// Primary Button Text color
rishi__cb_customizer_output_colors( [
	'value' => get_theme_mod('cookieButtonText'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor3)' ],
		'hover' => [ 'color' => 'var(--paletteColor5)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonTextInitialColor'
		],

		'hover' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonTextHoverColor'
		]
	],
]);


// Secondary Button color
rishi__cb_customizer_output_colors( [
	'value' => get_theme_mod('cookieSecondaryButtonBackground'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor3)' ],
		'hover' => [ 'color' => 'var(--paletteColor5)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonSecondaryInitialColor'
		],

		'hover' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonSecondaryHoverColor'
		]
	],
]);

// Secondary Button Text color
rishi__cb_customizer_output_colors( [
	'value' => get_theme_mod('cookieSecondaryButtonText'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor5)' ],
		'hover' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonSecondaryTextInitialColor'
		],

		'hover' => [
			'selector' => '.cookie-notification',
			'variable' => 'buttonSecondaryTextHoverColor'
		]
	],
]);


// Background color
rishi__cb_customizer_output_colors ([
	'value' => get_theme_mod('cookieBackground'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor5)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'backgroundColor'
		],
	],
]);

// Border color
rishi__cb_customizer_output_colors ([
	'value' => get_theme_mod('cookieBorderColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'borderColor'
		],
	],
]);

// Content color
rishi__cb_customizer_output_colors ( [
	'value' => get_theme_mod('cookieLink'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor1)' ],
		'hover' => [
			'color' => 'var(--paletteColor3)',
		],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.cookie-notification',
			'variable' => 'colorLink'
		],

		'hover' => [
			'selector' => '.cookie-notification',
			'variable' => 'colorLinkHover'
		]
	],
]);

$cookie_consent_type = get_theme_mod( 'cookie_consent_type', 'type-1' );
if( $cookie_consent_type == 'type-1' ) {

	$cookieMaxWidth = get_theme_mod( 'cookieMaxWidth', 455 );
	$css->put(
		'.cookie-notification',
		'--maxWidth: ' . $cookieMaxWidth . 'px'
	);
}

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $css,
		'mobile_css'   => $css,
		'selector'     => '.cookie-notification',
		'variableName' => 'maxWidthTypeThree',
		'unit'         => 'px',
		'responsive'   => true,
		'value'        => get_theme_mod(
			'cookieTypeThreeMaxWidth',
			850
		),
	)
);