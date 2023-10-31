<?php

if (!function_exists('is_woocommerce')) {
	return;
}
$colordefaults = rishi__cb__get_color_defaults();

//woo page
$prefixwoo = 'woo_';

rishi__cb_customizer_output_background_css([
	'selector' => '.box-layout.woocommerce .main-content-wrapper, .content-box-layout.woocommerce .main-content-wrapper',
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod(
		$prefixwoo . 'content_background',
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'var(--paletteColor5)'
				],
			],
		])
	),
	'responsive' => true,
]);


rishi__cb_customizer_output_responsive([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.woocommerce.archive .site-content .archive-title-wrapper',
	'variableName' => 'alignment',
	'value'        => get_theme_mod( 'woo_alignment', 'left'),
	'unit'		   => '',
]);

rishi__cb_customizer_output_responsive([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.woocommerce.archive .site-content .archive-title-wrapper',
	'variableName' => 'wooMargin',
	'value'        => get_theme_mod('woo_margin', [
		'desktop' => 85,
		'tablet' => 60,
		'mobile' => 30,
	]),
	'responsive'   => false,
]);

rishi__cb_customizer_output_box_shadow([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.box-layout.woocommerce .main-content-wrapper, .content-box-layout.woocommerce .main-content-wrapper',
	'variableName' => 'box-shadow',
	'value' => get_theme_mod( $prefixwoo . 'content_boxed_shadow', rishi__cb_customizer_box_shadow_value([
		'enable'   => false,
		'h_offset' => 0,
		'v_offset' => 12,
		'blur'     => 18,
		'spread'   => -6,
		'inset'    => false,
		'color' => [
			'color' => 'rgba(34, 56, 101, 0.04)',
		],
	])),
	'responsive' => true
]);

rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.box-layout.woocommerce .main-content-wrapper, .content-box-layout.woocommerce .main-content-wrapper',
	'property' => 'padding',
	'value' => get_theme_mod(
		$prefixwoo . 'boxed_content_spacing',
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
	)
]);

rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.box-layout.woocommerce .main-content-wrapper, .content-box-layout.woocommerce .main-content-wrapper',
	'property' => 'box-radius',
	'value' => get_theme_mod(
		$prefixwoo . 'content_boxed_radius',
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
			'top'    => '3px',
			'left'   => '3px',
			'right'  => '3px',
			'bottom' => '3px',
		])
	)
]);

//card alignment
rishi__cb_customizer_output_responsive([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.woocommerce .wholewrapper',
	'variableName' => 'cardAlignment',
	'value'        => get_theme_mod( 'shop_cards_alignment', 'center'),
	'unit'		   => '',
	'responsive'   => false,
]);

// Store notice
rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('wooNoticeContent'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)']
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.demo_store',
			'variable' => 'color'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('wooNoticeBackground'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor3)']
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.demo_store',
			'variable' => 'backgroundColor'
		],
	],
]);



rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '[data-products]',
	'variableName' => 'cardsGap',
	'value' => get_theme_mod('shopCardsGap', [
		'mobile' => 30,
		'tablet' => 30,
		'desktop' => 30,
	])
]);

$shop_columns = get_theme_mod('woocommerce_columns', 4 );

rishi__cb_customizer_output_responsive([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => 'woocommerce .wholewrapper',
	'variableName' => 'shop-columns',
	'value' => $shop_columns,
	'unit' => ''
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('cardProductTitleColor'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor2)'],
		'hover' => ['color' => 'var(--paletteColor3)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce .wholewrapper .woocommerce-loop-product__title',
			'variable' => 'color'
		],

		'hover' => [
			'selector' => '.woocommerce .wholewrapper .woocommerce-loop-product__title',
			'variable' => 'colorHover'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('cardProductPriceColor'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)']
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce .wholewrapper .price',
			'variable' => 'color'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('salesBagdgeColor'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)' ],
		'background' => ['color' => '#E71919' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce span.onsale',
			'variable' => 'color'
		],

		'background' => [
			'selector' => '.woocommerce span.onsale',
			'variable' => 'colorBg'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('woo_shopCategoryColor'),
	'default' => [
		'default'	=> ['color' => 'var(--paletteColor1)' ],
		'hover' 	=> ['color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce .caption-content-wrapper .cat-wrap',
			'variable' => 'catColor'
		],

		'hover' => [
			'selector' => '.woocommerce .caption-content-wrapper .cat-wrap',
			'variable' => 'catHoverColor'
		],
	],
]);


rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('cardCaptionBgColor'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)']
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce .wholewrapper',
			'variable' => 'cardCaptionBgColor'
		],
	],
]);

// Box shadow
rishi__cb_customizer_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.woocommerce .wholewrapper',
	'value' => get_theme_mod('cardCaptionBoxShadow', rishi__cb_customizer_box_shadow_value([
		'enable'   => true,
		'h_offset' => 0,
		'v_offset' => 12,
		'blur'     => 18,
		'spread'   => -6,
		'inset'    => false,
		'color' => [
			'color' => 'rgba(34, 56, 101, 0.04)',
		],
	])),
	'responsive' => true
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('cardProductButtonText'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor5)'],
		'hover' => ['color' => 'var(--paletteColor5)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce .wholewrapper ul.products li.product .button',
			'variable' => 'buttonTextInitialColor'
		],

		'hover' => [
			'selector' => '.woocommerce .wholewrapper ul.products li.product :is(.button:hover, .added_to_cart:hover)',
			'variable' => 'buttonTextHoverColor'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('cardProductButtonBackground'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor3)'],
		'hover' => ['color' => 'var(--paletteColor4)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce .wholewrapper ul.products li.product .button',
			'variable' => 'buttonInitialColor'
		],

		'hover' => [
			'selector' => '.woocommerce .wholewrapper ul.products li.product :is(.button:hover, .added_to_cart:hover)',
			'variable' => 'buttonHoverColor'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('cardProductButtonBorder'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor3)'],
		'hover' => ['color' => 'var(--paletteColor4)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.woocommerce .wholewrapper ul.products li.product .button',
			'variable' => 'btnBorderColor'
		],

		'hover' => [
			'selector' => '.woocommerce .wholewrapper ul.products li.product :is(.button:hover, .added_to_cart:hover)',
			'variable' => 'btnBorderHoverColor'
		],
	],
]);

rishi__cb_customizer_output_font_css( [
    'font_value' => get_theme_mod( 'woo_shop_button_typo',
        rishi__cb_customizer_typography_default_values( [
            'size'   => [
                'desktop' => '11px',
                'tablet'  => '11px',
                'mobile'  => '11px'
            ],
            'variation'   => 'n4',
            'line-height' => '1',
			'letter-spacing' => '1px'
        ] )
    ),
    'css'        => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector'   => '.post-type-archive-product .caption-content-wrapper a',
    'variable'   => 'FontFamily',
	'prefix'     => 'btn'
] );

rishi__cb_customizer_output_font_css( [
    'font_value' => get_theme_mod( 'cardProductTitleTypo',
        rishi__cb_customizer_typography_default_values( [
            'size'   => [
				'desktop' => '20px',
				'tablet'  => '16px',
				'mobile'  => '16px'
            ],
            'variation'   => 'n4',
            'line-height' => '1.5',
			'letter-spacing' => '1px'
        ] )
    ),
    'css'        => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector'   => '.woocommerce .wholewrapper ul.products .product .woocommerce-loop-product__title',
    'variable'   => 'FontFamily',
] );

rishi__cb_customizer_output_font_css( [
    'font_value' => get_theme_mod( 'cardProductTitlePriceTypo',
        rishi__cb_customizer_typography_default_values( [
            'size'   => [
				'desktop' => '20px',
				'tablet'  => '16px',
				'mobile'  => '16px'
            ],
            'variation'   => 'n4',
            'line-height' => '1.33',
			'letter-spacing' => '1px'
        ] )
    ),
    'css'        => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector'   => '.woocommerce .wholewrapper ul.products .product .price',
    'variable'   => 'FontFamily',
] );

// Buttons
$buttondefaults = rishi__cb__get_button_defaults();

rishi__cb_customizer_output_responsive(
	array(
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.post-type-archive-product .caption-content-wrapper a',
		'variableName' => 'bottonRoundness',
		'value'        => get_theme_mod(
			'shop_button_roundness',
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
		'selector'   => '.post-type-archive-product .caption-content-wrapper a',
		'property'   => 'buttonPadding',
		'value'      => get_theme_mod(
			'shop_button_padding',
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

// Border radius
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.woocommerce .wholewrapper ul.products .product',
	'property' => 'borderRadius',
	'value' => get_theme_mod(
		'cardProductRadius',
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
			'top' => '3px',
			'left' => '3px',
			'right' => '3px',
			'bottom' => '3px',

		])
	)
]);

// Box shadow
rishi__cb_customizer_output_box_shadow([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '[data-products="type-2"]',
	'value' => get_theme_mod('cardProductShadow', rishi__cb_customizer_box_shadow_value([
		'enable' => true,
		'h_offset' => 0,
		'v_offset' => 12,
		'blur' => 18,
		'spread' => -6,
		'inset' => false,
		'color' => [
			'color' => 'rgba(34, 56, 101, 0.03)',
		],
	])),
	'responsive' => true
]);

// woo single product
$product_thumbs_spacing = get_theme_mod('product_thumbs_spacing', '15px');

if ($product_thumbs_spacing !== '15px') {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.rt-product-view',
		'variableName' => 'thumbs-spacing',
		'unit' => '',
		'value' => $product_thumbs_spacing
	]);
}



$productGalleryWidth = get_theme_mod('productGalleryWidth', 50);

if ($productGalleryWidth !== 50) {
	$css->put(
		'.product-entry-wrapper',
		'--product-gallery-width: ' . $productGalleryWidth . '%'
	);
}

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('singleProductTitleColor'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor2)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary .product_title',
			'variable' => 'headingColor'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('singleProductPriceColor'),
	'default' => [
		'default' => ['color' => 'var(--paletteColor1)'],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary .price',
			'variable' => 'productColor'
		],
	],
]);

rishi__cb_customizer_output_font_css([
	'font_value' => get_theme_mod(
		'cardProductTitleFont',
	 rishi__cb_customizer_typography_default_values([
			'size' => '17px',
			'variation' => 'n6',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '[data-products] .woocommerce-loop-product__title, [data-products] .woocommerce-loop-category__title'
]);

rishi__cb_customizer_output_responsive_switch([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.single-product .up-sells',
	'value' => get_theme_mod('upsell_products_visibility', [
		'desktop' => true,
		'tablet' => false,
		'mobile' => false,
	])
]);

rishi__cb_customizer_output_responsive_switch([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.single-product .related',
	'value' => get_theme_mod('related_products_visibility', [
		'desktop' => true,
		'tablet' => false,
		'mobile' => false,
	])
]);

// messages
rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('infoMessageColor'),
	'default' => [
		'text' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'background' => ['color' => '#F0F1F3'],
	],
	'css' => $css,
	'variables' => [
		'text' => [
			'selector' => '.woocommerce-info, .woocommerce-message',
			'variable' => 'color'
		],

		'background' => [
			'selector' => '.woocommerce-info, .woocommerce-message',
			'variable' => 'background-color'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('errorMessageColor'),
	'default' => [
		'text' => ['color' => 'var(--paletteColor5)'],
		'background' => ['color' => 'var(--paletteColor7)'],
	],
	'css' => $css,
	'variables' => [
		'text' => [
			'selector' => '.woocommerce-error',
			'variable' => 'color'
		],

		'background' => [
			'selector' => '.woocommerce-error',
			'variable' => 'background-color'
		],
	],
]);


// add to cart actions
$add_to_cart_button_width = get_theme_mod('add_to_cart_button_width', '100%');

if ($add_to_cart_button_width !== '100%') {
 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.entry-summary form.cart',
		'variableName' => 'button-width',
		'unit' => '',
		'value' => $add_to_cart_button_width,
	]);
}


rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('quantity_color'),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary form.cart .quantity',
			'variable' => 'quantity-initial-color'
		],

		'hover' => [
			'selector' => '.entry-summary form.cart .quantity',
			'variable' => 'quantity-hover-color'
		],
	],
]);

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('quantity_arrows'),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary form.cart .quantity',
			'variable' => 'quantity-arrows-initial-color'
		],

		'hover' => [
			'selector' => '.entry-summary form.cart .quantity',
			'variable' => 'quantity-arrows-hover-color'
		],
	],
]);


rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('add_to_cart_text'),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary .single_add_to_cart_button',
			'variable' => 'buttonTextInitialColor'
		],

		'hover' => [
			'selector' => '.entry-summary .single_add_to_cart_button',
			'variable' => 'buttonTextHoverColor'
		],
	],
	'responsive' => true
]);


rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('add_to_cart_background'),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary .single_add_to_cart_button',
			'variable' => 'buttonInitialColor'
		],

		'hover' => [
			'selector' => '.entry-summary .single_add_to_cart_button',
			'variable' => 'buttonHoverColor'
		],
	],
	'responsive' => true
]);


rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('view_cart_button_text'),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary .rt-cart-actions .added_to_cart',
			'variable' => 'buttonTextInitialColor'
		],

		'hover' => [
			'selector' => '.entry-summary .rt-cart-actions .added_to_cart',
			'variable' => 'buttonTextHoverColor'
		],
	],
	'responsive' => true
]);


rishi__cb_customizer_output_colors([
	'value' => get_theme_mod('view_cart_button_background'),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '.entry-summary .rt-cart-actions .added_to_cart',
			'variable' => 'buttonInitialColor'
		],

		'hover' => [
			'selector' => '.entry-summary .rt-cart-actions .added_to_cart',
			'variable' => 'buttonHoverColor'
		],
	],
	'responsive' => true
]);


rishi__cb_customizer_output_background_css([
	'selector'   => '.woocommerce.archive .site-content .archive-title-wrapper',
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod(
		'shop_page_content_background',
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'var(--paletteColor7)'
				],
			],
		])
	),
	'responsive' => true,
]);

rishi__cb_customizer_output_colors([
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value'      => get_theme_mod('shop_font_color'),
	'default'    => [
		'default'  => ['color' => 'var(--paletteColor1)'],
		'selector' => '.woocommerce.archive .site-content .archive-title-wrapper',
	],
	'variables' => [
		'default' => ['variable' => 'shopFontColor'],
	],
]);

rishi__cb_customizer_output_colors([
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod('woo_btn_text_color'),
	'default' => [
		'default' => ['color' => $colordefaults['woo_btn_text_color']],
		'selector' => '.woocommerce-cart .woocommerce, .woocommerce-checkout .woocommerce, .woocommerce-account .woocommerce, .single-product.woocommerce div.product .summary form.cart .button',
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'wooTextColor'],
	],
]);

rishi__cb_customizer_output_colors([
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod('woo_btn_text_hover_color'),
	'default' => [
		'default' => ['color' => $colordefaults['woo_btn_text_hover_color']],
		'selector' => '.woocommerce-cart .woocommerce, .woocommerce-checkout .woocommerce, .woocommerce-account .woocommerce, .single-product.woocommerce div.product .summary form.cart .button',
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'wooHoverColor'],
	],
]);

rishi__cb_customizer_output_colors([
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod('woo_btn_bg_color'),
	'default' => [
		'default' => ['color' => $colordefaults['woo_btn_bg_color']],
		'selector' => '.woocommerce-cart .woocommerce, .woocommerce-checkout .woocommerce, .woocommerce-account .woocommerce, .single-product.woocommerce div.product .summary form.cart .button',
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'wooBgColor'],
	],
]);

rishi__cb_customizer_output_colors([
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod('woo_btn_bg_hover_color'),
	'default' => [
		'default' => ['color' => $colordefaults['woo_btn_bg_hover_color']],
		'selector' => '.woocommerce-cart .woocommerce, .woocommerce-checkout .woocommerce, .woocommerce-account .woocommerce, .single-product.woocommerce div.product .summary form.cart .button',
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'wooBgHoverColor'],
	],
]);

rishi__cb_customizer_output_colors([
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod('woo_btn_border_color'),
	'default' => [
		'default' => ['color' => $colordefaults['woo_btn_border_color']],
		'selector' => '.woocommerce-cart .woocommerce, .woocommerce-checkout .woocommerce, .woocommerce-account .woocommerce, .single-product.woocommerce div.product .summary form.cart .button',
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'wooBorderColor'],
	],
]);

rishi__cb_customizer_output_colors([
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod('woo_btn_border_hover_color'),
	'default' => [
		'default' => ['color' => $colordefaults['woo_btn_border_hover_color']],
		'selector' => '.woocommerce-cart .woocommerce, .woocommerce-checkout .woocommerce, .woocommerce-account .woocommerce, .single-product.woocommerce div.product .summary form.cart .button',
	],
	'css' => $css,
	'variables' => [
		'default' => ['variable' => 'wooBorderHoverColor'],
	],
]);

//Single product gallery options

rishi__cb_customizer_output_responsive([
    'css' => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector' => '.product-entry-wrapper',
    'variableName' => 'product-gallery-width',
    'value' =>  get_theme_mod( 'gallery_img_width', '50'),
    'unit' => '%',
]);

rishi__cb_customizer_output_responsive([
    'css' => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector' => '.product-entry-wrapper',
    'variableName' => 'thumbs-width',
    'value' => get_theme_mod( 'gallery_thumbnail_spacing', '10'),
    'unit' => 'px',
    'responsive' => true
]);