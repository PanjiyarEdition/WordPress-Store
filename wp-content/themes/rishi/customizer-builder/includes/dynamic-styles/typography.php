<?php

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'rootTypography',
			rishi__cb_customizer_typography_default_values(
				array(
					'family'          => 'System Default',
					'variation'       => 'n4',
					'size'            => '18px',
					'line-height'     => '1.75',
					'letter-spacing'  => '0em',
					'text-transform'  => 'none',
					'text-decoration' => 'none',
				),
				'rootTypography'
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => ':root',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'h1Typography',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'        => '40px',
					'variation'   => 'n7',
					'line-height' => '1.5',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => 'h1, .block-editor-page .editor-styles-wrapper h1, .block-editor-page .editor-post-title__block .editor-post-title__input',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'h2Typography',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'        => '36px',
					'variation'   => 'n7',
					'line-height' => '1.5',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => 'h2',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'h3Typography',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'        => '30px',
					'variation'   => 'n7',
					'line-height' => '1.5',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => 'h3',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'h4Typography',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'        => '26px',
					'variation'   => 'n7',
					'line-height' => '1.5',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => 'h4',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'h5Typography',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'        => '22px',
					'variation'   => 'n7',
					'line-height' => '1.5',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => 'h5',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'h6Typography',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'        => '18px',
					'variation'   => 'n7',
					'line-height' => '1.5',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => 'h6',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'blockquote',
			rishi__cb_customizer_typography_default_values(
				array(
					'family'    => 'Georgia',
					'size'      => '25px',
					'variation' => 'n6',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.wp-block-quote.is-style-large p, .wp-block-pullquote p, .rt-quote-widget blockquote',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'pre',
			rishi__cb_customizer_typography_default_values(
				array(
					'family'    => 'monospace',
					'size'      => '16px',
					'variation' => 'n4',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => 'code, kbd, samp, pre',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'sidebarWidgetsTitleFont',
			rishi__cb_customizer_typography_default_values(
				array(
					'size' => '18px',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.rt-sidebar .widget-title',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'sidebarWidgetsFont',
			rishi__cb_customizer_typography_default_values(
				array(
				// 'size' => '18px',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.rt-sidebar .widget > *:not(.widget-title):not(blockquote)',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'singleProductTitleFont',
			rishi__cb_customizer_typography_default_values(
				array(
					'size' => '30px',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.entry-summary > .product_title',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'singleProductPriceFont',
			rishi__cb_customizer_typography_default_values(
				array(
					'size'      => '20px',
					'variation' => 'n7',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.entry-summary .price',
	)
);

// breadcrumbs_typo
rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'breadcrumbsTypo',
			rishi__cb_customizer_typography_default_values(
				array(
					'family'    => 'System Default',
					'variation' => 'n5',
					'size'      => '14px',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.rishi-breadcrumb-main-wrap .rishi-breadcrumbs',
		'variable'   => 'breadcrumbsTypo',
	)
);

// WooCoomerce Store Notice Typography
rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'wooNoticeTypo',
			rishi__cb_customizer_typography_default_values(
				array(
					'variation' => 'n4',
					'size'      => '18px',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.woocommerce-store-notice.demo_store',
		'variable'   => 'wooNoticeTypo',
	)
);

rishi__cb_customizer_output_font_css( [
    'font_value' => get_theme_mod( 'woo_shop_title_typo',
        rishi__cb_customizer_typography_default_values( [
            'size'   => [
                'desktop' => '40px',
                'tablet'  => '40px',
                'mobile'  => '40px'
            ],
            'variation'   => 'n7',
            'line-height' => '1.75'
        ] )
    ),
    'css'        => $css,
    'tablet_css' => $tablet_css,
    'mobile_css' => $mobile_css,
    'selector'   => '.woocommerce-page .archive-title-wrapper .tagged-in-wrapper h1',
] );

// button_typo
rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'button_Typo',
			rishi__cb_customizer_typography_default_values(
				array(
					'family'    => 'Default',
					'variation' => 'n4',
					'size'      => '18px',
					'line-height' => '1.2',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => ':root',
		'variable'   => 'FontFamily',
		'prefix'     => 'btn'
	)
);

// trigger_typo
rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'trigger_typo',
			rishi__cb_customizer_typography_default_values(
				array(
					'family'    => 'Default',
					'variation' => 'n4',
					'size'      => '18px',
				)
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.cb__menu-trigger .cb__label',
	)
);

rishi__cb_customizer_output_font_css(
	array(
		'font_value' => get_theme_mod(
			'featured_image_caption_typo',
			rishi__cb_customizer_typography_default_values(
				array(
					'variation'       => 'n4',
					'size'            => '14px',
					'line-height'     => '1.5',
				),
				'featured_image_caption_typo'
			)
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.rt-featured-image .rt-caption-wrap',
	)
);
