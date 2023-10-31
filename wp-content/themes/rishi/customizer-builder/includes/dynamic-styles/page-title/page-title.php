<?php


if (! isset($page_title_source)) {
	$page_title_source = [
		'strategy' => 'customizer',
		'prefix' => $prefix
	];
}

if (!$page_title_source) {
	return;
}

$default_type = 'type-1';

$default_hero_elements = [];

$default_hero_elements[] = [
	'id' => 'custom_title',
	'enabled' => true,
];

$default_hero_elements[] = [
	'id' => 'custom_description',
	'enabled' => true,
];

if (is_singular() || is_author()) {
	$default_hero_elements[] = [
		'id' => 'custom_meta',
		'enabled' => true,
	];
}

if (is_author()) {
	$default_hero_elements[] = [
		'id' => 'author_social_channels',
		'enabled' => true,
	];
}

$default_hero_elements[] = [
	'id' => 'breadcrumbs',
	'enabled' => false,
];

$hero_elements = rishi__cb_get_akv_or_customizer(
	'hero_elements',
 rishi__cb_customizer_get_page_title_source(),
	$default_hero_elements
);

if (
 rishi__cb_customizer_get_page_title_source()['strategy'] === 'customizer'
	&& ( rishi__cb_customizer_get_page_title_source()['prefix'] === 'woo_categories'
		||
	 rishi__cb_customizer_get_page_title_source()['prefix'] === 'author')
) {
	$default_type = 'type-2';
}

if (
	((function_exists('is_woocommerce')
		&&
		(is_product_category()
			||
			is_product_tag()
			||
			is_shop())) || is_author())
	&&
	isset($page_title_source['strategy'])
	&&
	$page_title_source['strategy'] === 'customizer'
) {
	$default_type = 'type-2';
}

$rt_type = rishi__cb_get_akv_or_customizer(
	'hero_section',
	$page_title_source,
	$default_type
);

$hero_elements = rishi__cb_get_akv_or_customizer(
	'hero_elements',
 rishi__cb_customizer_get_page_title_source(),
	$default_hero_elements
);

// title
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv_or_customizer(
		'pageTitleFont',
		$page_title_source,
	 rishi__cb_customizer_typography_default_values([
			'size' => [
				'desktop' => '32px',
				'tablet'  => '30px',
				'mobile'  => '25px'
			],
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.entry-header .page-title'
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv_or_customizer('pageTitleFontColor', $page_title_source),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-header .page-title',
			'variable' => 'headingColor'
		],
	],
]);


// meta
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv_or_customizer(
		'pageMetaFont',
		$page_title_source,
	 rishi__cb_customizer_typography_default_values([
			'size' => '12px',
			'variation' => 'n6',
			'line-height' => '1.5',
			'text-transform' => 'uppercase',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.entry-header .entry-meta'
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv_or_customizer('pageMetaFontColor', $page_title_source),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-header .entry-meta',
			'variable' => 'color'
		],

		'hover' => [
			'selector' => '.entry-header .entry-meta',
			'variable' => 'linkHoverColor'
		],
	],
]);

// excerpt
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv_or_customizer(
		'pageExcerptFont',
		$page_title_source,
	 rishi__cb_customizer_typography_default_values([
			// 'variation' => 'n5',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.entry-header .page-description'
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv_or_customizer('pageExcerptColor', $page_title_source),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-header .page-description',
			'variable' => 'color'
		],
	],
]);

// breadcrumbs
rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv_or_customizer(
		'breadcrumbsFont',
		$page_title_source,
	 rishi__cb_customizer_typography_default_values([
			'size' => '12px',
			'variation' => 'n6',
			'text-transform' => 'uppercase',
		])
	),
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.entry-header .rt-breadcrumbs'
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv_or_customizer('breadcrumbsFontColor', $page_title_source),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'initial' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '.entry-header .rt-breadcrumbs',
			'variable' => 'color'
		],

		'initial' => [
			'selector' => '.entry-header .rt-breadcrumbs',
			'variable' => 'linkInitialColor'
		],

		'hover' => [
			'selector' => '.entry-header .rt-breadcrumbs',
			'variable' => 'linkHoverColor'
		],
	],
]);

if ($rt_type === 'type-1') {
	$hero_alignment1 = rishi__cb_get_akv_or_customizer(
		'hero_alignment1',
		$page_title_source,
		apply_filters(
			'rishi:hero:type-1:default-alignment',
			'left',
			rishi__cb_customizer_manager()->screen->get_prefix()
		)
	);

	if ($hero_alignment1 !== 'left') {
	 rishi__cb_customizer_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section[data-type="type-1"]',
			'variableName' => 'alignment',
			'unit' => '',
			'value' => $hero_alignment1,
		]);
	}

 rishi__cb_customizer_output_responsive([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.hero-section[data-type="type-1"]',
		'variableName' => 'margin-bottom',
		'value' => rishi__cb_get_akv_or_customizer('hero_margin', $page_title_source, [
			'desktop' => 50,
			'tablet' => 30,
			'mobile' => 30,

		])
	]);
}


if ($rt_type === 'type-2') {

	$template_args = apply_filters('rishi:header:item-template-args', []);

	if (
		isset($template_args['has_transparent_header'])
		&&
		$template_args['has_transparent_header']
	) {
		$render = new \Rishi_Header_Builder_Render();
		$header_height = $render->get_header_height();

		if (!in_array('desktop', $template_args['has_transparent_header'])) {
			$header_height['desktop'] = 0;
		}

		if (!in_array('mobile', $template_args['has_transparent_header'])) {
			$header_height['tablet'] = 0;
			$header_height['mobile'] = 0;
		}

	 rishi__cb_customizer_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => ':root',
			'variableName' => 'headerHeight',
			'value' => $header_height
		]);
	}

	$hero_alignment2 = rishi__cb_get_akv_or_customizer('hero_alignment2', $page_title_source, 'center');

	if ($hero_alignment2 !== 'center') {
	 rishi__cb_customizer_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section[data-type="type-2"]',
			'variableName' => 'alignment',
			'unit' => '',
			'value' => $hero_alignment2,
		]);
	}

	$hero_vertical_alignment = rishi__cb_get_akv_or_customizer('hero_vertical_alignment', $page_title_source, 'center');

	if ($hero_vertical_alignment !== 'center') {
	 rishi__cb_customizer_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section[data-type="type-2"]',
			'variableName' => 'vertical-alignment',
			'unit' => '',
			'value' => $hero_vertical_alignment,
		]);
	}

	// height
	$hero_height = rishi__cb_get_akv_or_customizer('hero_height', $page_title_source, '250px');

	if ($hero_height !== '250px') {
	 rishi__cb_customizer_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => '.hero-section[data-type="type-2"]',
			'variableName' => 'min-height',
			'unit' => '',
			'value' => $hero_height,
		]);
	}

	// overlay color
 rishi__cb_customizer_output_colors([
		'value' => rishi__cb_get_akv_or_customizer(
			'pageTitleOverlay',
			$page_title_source
		),
		'default' => [
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword()]
		],
		'css' => $css,
		'variables' => [
			'default' => [
				'selector' => '.hero-section[data-type="type-2"]',
				'variable' => 'page-title-overlay'
			],
		],
	]);

	// background
 rishi__cb_customizer_output_background_css([
		'selector' => '.hero-section[data-type="type-2"]',
		'css' => $css,
		'value' => rishi__cb_get_akv_or_customizer(
			'pageTitleBackground',
			$page_title_source,
		 rishi__cb_customizer_background_default_value([
				'backgroundColor' => [
					'default' => [
						'color' => '#EDEFF2'
					],
				],
			])
		)
	]);
}

$selectors_map = [
	// custom_meta is a bit specially handled
	'author_social_channels' => '.hero-section .author-box-social',
	'custom_description' => '.hero-section .page-description',
	'custom_title' => '.hero-section .page-title, .hero-section .rt-author-name',
	'breadcrumbs' => '.hero-section .rt-breadcrumbs',
	'custom_meta' => '.hero-section .entry-meta'
];

$meta_indexes = [
	'first' => null,
	'second' => null
];

foreach ($hero_elements as $index => $single_hero_element) {
	if (!isset($single_hero_element['enabled'])) {
		continue;
	}

	if ($single_hero_element['id'] === 'custom_meta') {
		if ($meta_indexes['first'] === null) {
			$meta_indexes['first'] = $index;
		} else {
			$meta_indexes['second'] = $index;
		}
	}
}

foreach ($hero_elements as $index => $single_hero_element) {
	if (!$single_hero_element['enabled']) {
		continue;
	}

	if (
		$single_hero_element['id'] === 'custom_meta'
		&&
		$index === $meta_indexes['second']
	) {
		$selectors_map['custom_meta'] = '.entry-meta[data-id="second"]';
	}

	$hero_item_spacing = rishi__cb_get_akv('hero_item_spacing', $single_hero_element, 20);

	if (intval($hero_item_spacing) !== 20) {
	 rishi__cb_customizer_output_responsive([
			'css' => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector' => $selectors_map[$single_hero_element['id']],
			'variableName' => 'itemSpacing',
			'value' => $hero_item_spacing
		]);
	}
}

$post_atts = rishi__cb_customizer_get_post_options();

$source = [
	'strategy' => $post_atts
];

if ( rishi__cb_customizer_default_akg(
	'page_title_hero_section',
	$post_atts,
	'default'
) === 'default') {
	$source = [
		'strategy' => 'customizer'
	];
}

$alignment = rishi__cb_customizer_akg_or_customizer(
	'single_page_alignment',
	$source,
	apply_filters(
        'rishi:hero:type-1:default-alignment',
        'CT_CSS_SKIP_RULE',
        rishi__cb_customizer_manager()->screen->get_prefix()
    )
);

rishi__cb_customizer_output_responsive([
	'css' => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector' => '.page .main-content-wrapper .entry-header',
    'variableName' => 'alignment',
    'value' => $alignment,
    'unit' => '',
]);


rishi__cb_customizer_output_responsive([
    'css' => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector' => '.page .main-content-wrapper .entry-header',
    'variableName' => 'margin-bottom',
    'value' => rishi__cb_get_akv_or_customizer('single_page_margin', $source, [
        'desktop' => 50,
        'tablet' => 30,
        'mobile' => 30,

    ])
]);

if ( rishi__cb_customizer_default_akg(
	'content_style_source',
	$post_atts,
	'inherit'
) === 'inherit') {
	$source = [
		'strategy' => 'customizer'
	];
}
if ( rishi__cb_customizer_default_akg(
	'content_style_source',
	$post_atts,
	'inherit'
) === 'custom') {

rishi__cb_customizer_output_background_css([
	'selector'   => '.box-layout.page #main-container .main-content-wrapper, .content-box-layout.page #main-container .main-content-wrapper',
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => rishi__cb_get_akv_or_customizer(
		'single_page_content_background', $source,
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => '#ffffff'
				],
			],
		])
	),
	'responsive' => true,
]);

rishi__cb_customizer_output_box_shadow([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.box-layout.page #main-container .main-content-wrapper, .content-box-layout.page #main-container .main-content-wrapper',
	'variableName' => 'box-shadow',
	'value' => rishi__cb_get_akv_or_customizer( 'single_page_content_boxed_shadow', $source, rishi__cb_customizer_box_shadow_value([
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
	'selector' => '.box-layout.page #main-container .main-content-wrapper, .content-box-layout.page #main-container .main-content-wrapper',
	'property' => 'padding',
	'value' => rishi__cb_get_akv_or_customizer(
		'single_page_boxed_content_spacing', $source,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		    'top'    => '40px',
		    'left'   => '40px',
		    'right'  => '40px',
		    'bottom' => '40px',
		])
	)
]);

rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => '.box-layout.page #main-container .main-content-wrapper, .content-box-layout.page #main-container .main-content-wrapper',
	'property' => 'box-radius',
	'value' => rishi__cb_get_akv_or_customizer(
		'single_page_content_boxed_radius', $source,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
			'top'    => '3px',
			'left'   => '3px',
			'right'  => '3px',
			'bottom' => '3px',
		])
	)
]);

}
