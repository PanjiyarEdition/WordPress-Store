<?php

$defaults = rishi__cb__get_layout_defaults();

$breaddefaults = rishi__cb__get_breadcrumbs_defaults();

$_inner_options = apply_filters( 'rishi_woo_single_product_customizer_settings', 
    [
        rishi__cb_customizer_rand_md5() => [
                'type'  => 'rt-title',
                'label' => __( 'Page Structure', 'rishi' ),
            ],
        rishi__cb_customizer_rand_md5() => [
                'title' => __( 'General', 'rishi' ),
                'type' => 'tab',
                'options' => [
                    'breadcrumbs_ed_single_product' => [
                        'label'   => __('Breadcrumb', 'rishi'),
                        'type'    => 'rara-switch',
                        'value'   => $breaddefaults['breadcrumbs_ed_single_product'],
                    ],
                    'single_product_gallery_options_panel' => [
                        'label' => __( 'Gallery Options', 'rishi' ),
                        'type' => 'rt-panel',
                        'wrapperAttr' => [ 'data-panel' => 'only-arrow' ],
                        'inner-options' => [
                            'gallery_img_width' => [
                                'label' => __( 'Product Width', 'rishi' ),
                                'type' => 'rt-slider',
                                'min' => 0,
                                'max' => 90,
                                'value' => '50',
                                'defaultUnit' => '%',
                            ],
            
                            'gallery_thumbnail_spacing' => [
                                'label' => __( 'Thumbnails Spacing', 'rishi' ),
                                'type' => 'rt-slider',
                                'min' => 0,
                                'max' => 100,
                                'value' => '10',
                                'defaultUnit' => 'px',
                                'responsive' => true,
                                'setting' => [ 'transport' => 'postMessage' ],
                            ],
            
                            'gallery_thumbnail_position' => [
                                'label'   => __('Gallery Position', 'rishi'),
                                'type'    => 'rt-radio',
                                'setting' => [ 'transport' => 'refresh' ],
                                'value'   => 'horizontal',
                                'view'    => 'text',
                                'choices' => [
                                    'horizontal'   	=> __('Horizontal', 'rishi'),
                                    'vertical'  	=> __('Vertical', 'rishi'),
                                ],
                            ],
            
                            'gallery_image_options' => [
                                'label' => __('Image', 'rishi'),
                                'type' => 'rt-ratio',
                                'value' => 'original',
                                'design' => 'inline',
                                'preview_width_key' => 'woocommerce_single_image_width',
                                'inner-options' => [
                                    'woocommerce_single_image_width' => [
                                        'type' => 'text',
                                        'label' => __('Image Width', 'rishi'),
                                        'desc' => __('Image height will be automatically calculated based on the image ratio.', 'rishi'),
                                        'value' => 600,
                                        'design' => 'inline',
                                        'setting' => [
                                            'type' => 'option',
                                            'capability' => 'manage_woocommerce',
                                        ]
                                    ],
                                ],
                            ],
            
                            'gallery_ed_lightbox' => [
                                'label' => __( 'Enable Lightbox', 'rishi' ),
                                'type' => 'rara-switch',
                                'value' => 'no'
                            ],
            
                            'gallery_ed_zoom_effect' => [
                                'label' => __( 'Enable Zoom Effect', 'rishi' ),
                                'type' => 'rara-switch',
                                'value' => 'no',
                                'setting' => ['transport' => 'postMessage'],
                            ],
                        ]
                    ],
                    rishi__cb_customizer_rand_md5() => [
                        'type'      => 'rt-condition',
                        'condition' => [ 'ed_new_item_product' => 'yes' ],
                        'options'   => [
                            'woo_new_tag' => [
                                'label'  => __( 'Title', 'rishi' ),
                                'type'   => 'text',
                                'design' => 'block',
                                'sync'   => [
                                    'selector' => '.single-product .itsnew',
                                    'render'   => function() { echo rishi_pro_newtag_title(); }
                                ],
                                'value'   => __('New', 'rishi'),
                            ],
                            'woo_new_num_dates' => [
                                'label'      => __('Newer Days', 'rishi'),
                                'type'       => 'rt-number',
                                'design'     => 'inline',
                                'value'      => 30,
                                'min'        => 1,
                                'max'        => 45,
                                'divider'    => 'top',
                                'responsive' => false,
                            ],
                            'shop_cards_new_badge_design' => [
                                'label'   => __('New Badge Design', 'rishi'),
                                'type'    => 'rt-image-picker',
                                'value'   => 'square',
                                'view'    => 'text',
                                'setting' => ['transport' => 'postMessage'],
                                'attr'    => ['data-columns' => '4'],
                                'choices' => [
                                    'circle' => [
                                        'src'   => rishi__cb_customizer_image_picker_file('new-circle'),
                                        'title' => __('Circle', 'rishi'),
                                    ],
                                    'square' => [
                                        'src'   => rishi__cb_customizer_image_picker_file('new-square'),
                                        'title' => __('Rectangle', 'rishi'),
                                    ],                                    
                                    'oval' => [
                                        'src'   => rishi__cb_customizer_image_picker_file('new-oval'),
                                        'title' => __('Oval', 'rishi'),
                                    ],
                                    'semi-oval' => [
                                        'src'   => rishi__cb_customizer_image_picker_file('new-semi-oval'),
                                        'title' => __('Semi Oval', 'rishi'),
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'has_product_single_rating' => [
                        'label' => __( 'Star Rating', 'rishi' ),
                        'type' => 'rara-switch',
                        'value' => 'yes',
                    ],

                    'has_product_single_meta' => [
                        'label' => __( 'Product Meta', 'rishi' ),
                        'type' => 'rara-switch',
                        'value' => 'yes',
                    ],

                    'single_product_upsell_options_panel' => [
                        'label' => __( 'Upsell Products Options', 'rishi' ),
                        'type' => 'rt-panel',
                        'wrapperAttr' => [ 'data-panel' => 'only-arrow' ],
                        'inner-options' => [
                            'woo_ed_upsell_tab' => [
                                'label'   => __('Move Upsell Products', 'rishi'),
                                'desc'    => __('This setting will move upsell products to default tab section', 'rishi'),
                                'type'    => 'rara-switch',
                                'value'   => 'no',
                                'divider' => 'top',
                            ],
                            rishi__cb_customizer_rand_md5() => [
                                'type' => 'rt-condition',
                                'condition' => ['woo_ed_upsell_tab' => 'yes'],
                                'options' => [
                                    'woo_upsell_tab_label' => [
                                        'label'   => __('Upsell Products Label', 'rishi'),
                                        'desc'    => __( 'This label will on tab section for upsell product', 'rishi' ),
                                        'type'    => 'text',
                                        'design'  => 'block',
                                        'value'   => __('Upsell Products', 'rishi'),
                                        'sync' => [
                                            'selector' => '.single-product .wc-tabs .rishi_upsell_products_tab',
                                            'render' => function() { echo rishi_single_product_upsell_activecallback(); }
                                        ],
                                    ],
                                ],
                            ],

                            'woo_single_no_of_upsell' => [
                                'label'   => __('Upsell Products', 'rishi'),
                                'type'    => 'rt-number',
                                'design'  => 'inline',
                                'value'   => 24,
                                'min'     => 1,
                                'max'     => 100,
                                'divider' => 'top',
                                'responsive' => false,
                            ],
                            'woo_single_no_of_upsell_row' => [
                                'label'   => __('Upsell Products per Row', 'rishi'),
                                'type'    => 'rt-number',
                                'design'  => 'inline',
                                'value'   => 4,
                                'min'     => 1,
                                'max'     => 5,
                                'divider' => 'top',
                                'responsive' => false,
                            ],
                        ]
                    ],
                    'single_product_related_options_panel' => [
                        'label' => __( 'Related Products Options', 'rishi' ),
                        'type' => 'rt-panel',
                        'wrapperAttr' => [ 'data-panel' => 'only-arrow' ],
                        'inner-options' => [
                    
                            'single_related_products'     => array(
                                'label'  => __( 'Related Products Title', 'rishi' ),
                                'type'   => 'text',
                                'design' => 'block',
                                'sync'   => array(
                                    'selector' => '.single-product.woocommerce .related.products h2',
                                    'render'   => function() {
                                        echo rishi_get_related_products_info(); },
                                ),
                                'value'  => $defaults['single_related_products'],
                            ),

                            'woo_single_no_of_posts' => [
                                'label'   => __('Related Products', 'rishi'),
                                'type'    => 'rt-number',
                                'design'  => 'inline',
                                'value'   => 24,
                                'min'     => 1,
                                'divider' => 'top',
                                'responsive' => false,
                            ],
                            'woo_single_no_of_posts_row' => [
                                'label'   => __('Related Products per Row', 'rishi'),
                                'type'    => 'rt-number',
                                'design'  => 'inline',
                                'value'   => 4,
                                'min'     => 1,
                                'max'     => 5,
                                'divider' => 'top',
                                'responsive' => false,
                            ],
                        ]
                    ]
                ],
            ],
        rishi__cb_customizer_rand_md5() => [
                'title' => __( 'Design', 'rishi' ),
                'type' => 'tab',
                'options' => [
                    'singleProductTitleColor' => [
                        'label' => __( 'Product Title Color', 'rishi' ),
                        'type'  => 'rt-color-picker',
                        'design' => 'inline',
                        'setting' => [ 'transport' => 'postMessage' ],

                        'value' => [
                            'default' => [
                                'color' => 'var(--paletteColor1)',
                            ],
                        ],

                        'pickers' => [
                            [
                                'title' => __( 'Initial', 'rishi' ),
                                'id' => 'default',
                            ],
                        ],
                    ],
                    'singleProductPriceColor' => [
                        'label' => __( 'Product Price Color', 'rishi' ),
                        'type'  => 'rt-color-picker',
                        'design' => 'inline',
                        'setting' => [ 'transport' => 'postMessage' ],

                        'value' => [
                            'default' => [
                                'color' => 'var(--paletteColor1)',
                            ],
                        ],

                        'pickers' => [
                            [
                                'title' => __( 'Initial', 'rishi' ),
                                'id' => 'default',
                                'inherit' => 'var(--color)'
                            ],
                        ],
                    ],
                ],
            ],
    ]
);

$options = [
    'woo_single_section_options' => [
        'type'     => 'rt-options',
        'setting'  => ['transport' => 'postMessage'],
        'priority' => 3,
        'inner-options' => $_inner_options
    ],
];