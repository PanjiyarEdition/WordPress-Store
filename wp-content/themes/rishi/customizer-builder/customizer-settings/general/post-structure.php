<?php
/**
 * Post Structure Options
 */
if (!isset($has_hero_type)) {
	$has_hero_type = true;
}

if (!isset($enabled_label)) {
	$enabled_label = __('Page Title', 'rishi');
}

if (!isset($enabled_default)) {
	$enabled_default = 'yes';
}

if (!isset($is_cpt)) {
	$is_cpt = false;
}

if (!isset($is_bbpress)) {
	$is_bbpress = false;
}

if (!isset($is_woo)) {
	$is_woo = false;
}

if (!isset($is_page)) {
	$is_page = false;
}

if (!isset($is_author)) {
	$is_author = false;
}

if (!isset($has_default)) {
	$has_default = false;
}

if (!isset($is_home)) {
	$is_home = false;
}

if (!isset($is_single)) {
	$is_single = false;
}

if (!isset($is_search)) {
	$is_search = false;
}

if (!isset($is_archive)) {
	$is_archive = false;
}

if (!isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$custom_description_layer_name = __('Description', 'rishi');

if ($is_author) {
	$custom_description_layer_name = __('Bio', 'rishi');
}

if (
	($is_single) && !$is_bbpress
) {
	$custom_description_layer_name = __('Content', 'rishi');
}

if (
	($is_home) && !$is_bbpress
) {
	$custom_description_layer_name = __('Excerpt', 'rishi');
}

if ($is_search) {
	$custom_description_layer_name = __('Subtitle', 'rishi');
}

$options = [
    $prefix . 'post_structure' => [
        'label'  => __('Post Elements', 'rishi'),
        'type'   => 'rt-layers',
        'attr'   => ['data-layers' => 'title-elements'],
        'design' => 'block',
        'value'  => rishi__cb__get_default_post_structure(),
        'settings' => apply_filters( 'rishi__cb__add_post_structure_settings', [
            'breadcrumbs' => [
                'label' => __('Breadcrumb', 'rishi'),
                'options' => [
                    'hero_item_spacing' => [
                        'label' => __('Top Spacing', 'rishi'),
                        'type' => 'rt-slider',
                        'value' => 20,
                        'min' => 0,
                        'max' => 100,
                        'responsive' => true,
                        'sync' => [
                            'id' => $prefix . 'hero_elements_spacing',
                        ],
                    ],
                ],
            ],

            'excerpt' => [
                'label' => __('Excerpt', 'rishi'),
                'options' => [
                    'excerpt_length' => [
                        'label' => __('Length', 'rishi'),
                        'type' => 'rt-number',
                        'design' => 'inline',
                        'value' => 40,
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
            ],

            'read_more' => [
                'label' => __('Read More Button', 'rishi'),
                'options' => [
                    'button_type' => [
                        'label' => false,
                        'type' => 'rt-radio',
                        'value' => 'background',
                        'view' => 'text',
                        'choices' => [
                            'simple' => __('Simple', 'rishi'),
                            'background' => __('Background', 'rishi'),
                            'outline' => __('Outline', 'rishi'),
                        ],

                        'sync' => [
                            'id' => $prefix . 'archive_order_skip',
                        ]
                    ],

                    'read_more_text' => [
                        'label' => __('Text', 'rishi'),
                        'type' => 'text',
                        'design' => 'inline',
                        'value' => __('Read More', 'rishi'),
                        'sync' => [
                            'id' => $prefix . 'archive_order_skip',
                        ]
                    ],

                    'read_more_arrow' => [
                        'label' => __('Show Arrow', 'rishi'),
                        'type' => 'rara-switch',
                        'value' => 'no',
                        'sync' => [
                            'id' => $prefix . 'archive_order_button',
                        ]
                    ],

                    'read_more_alignment' => [
                        'type' => 'rt-radio',
                        'label' => __('Alignment', 'rishi'),
                        'value' => 'left',
                        'view' => 'text',
                        'attr' => ['data-type' => 'alignment'],
                        'design' => 'block',
                        'sync' => [
                            'prefix' => $prefix,
                            'id' => $prefix . 'archive_order_skip',
                        ],
                        'choices' => [
                            'left' => '',
                            'center' => '',
                            'right' => '',
                        ],
                    ],
                ],
            ],

            'divider' => [
                'label' => __('Divider', 'rishi'),
                'clone' => true,
                'sync' => [
                    'id' => $prefix . 'archive_order_meta'
                ],
            ],

            'featured_image' => [
                'label' => __('Featured Image', 'rishi'),
                'options' => rishi__cb_customizer_get_options( 'single-elements/featured-image' ),
            ],

            'custom_title' => [
                'label' => __('Title', 'rishi'),
                'options' => [
                    'heading_tag' => [
                        'label' => __('Heading tag', 'rishi'),
                        'type' => 'rt-select',
                        'value' => 'h2',
                        'view' => 'text',
                        'design' => 'inline',
                        'sync' => [
                            'id' => $prefix . 'archive_order_heading_tag',
                        ],
                        'choices' => rishi__cb_customizer_ordered_keys(
                            [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                            ]
                        ),
                    ],

                ],
            ],

            'custom_description' => [
                'label' => $custom_description_layer_name,
                'options' => [
                    [
                        $is_home ? [
                            rishi__cb_customizer_rand_md5() => [
                                'type' => 'rt-condition',
                                'condition' => ['show_on_front' => 'posts'],
                                'values_source' => 'global',
                                'options' => [
                                    'description' => [
                                        'label' => false,
                                        'type' => 'textarea',
                                        'value' => '',
                                        'disableRevertButton' => true,
                                        'design' => 'block',
                                    ],
                                ]
                            ],
                        ] : []
                    ],

                    'description_visibility' => [
                        'label' => __('Visibility', 'rishi'),
                        'type' => 'rt-visibility',
                        'design' => 'block',

                        'value' => [
                            'desktop' => true,
                            'tablet' => true,
                            'mobile' => false,
                        ],

                        'choices' => rishi__cb_customizer_ordered_keys([
                            'desktop' => __('Desktop', 'rishi'),
                            'tablet' => __('Tablet', 'rishi'),
                            'mobile' => __('Mobile', 'rishi'),
                        ]),

                        'sync' => [
                            'id' => $prefix . 'hero_elements_spacing',
                        ],
                    ],

                    'hero_item_spacing' => [
                        'label' => __('Top Spacing', 'rishi'),
                        'type' => 'rt-slider',
                        'value' => 20,
                        'min' => 0,
                        'max' => 100,
                        'responsive' => true,
                        'sync' => [
                            'id' => $prefix . 'hero_elements_spacing',
                        ],
                    ],
                ],
            ],

            'custom_meta' => [
                'label' => $is_author ? __('Author Meta', 'rishi') : __('Post Meta', 'rishi'),
                'clone' => true,
                'cloneNumber' => 3,
                'sync' => [
                    'id' => $prefix . 'hero_elements_meta'
                ],
                'options' => [
                    $is_author ? [
                        'page_meta_elements' => [
                            'label' => __('Meta Elements', 'rishi'),
                            'type' => 'rt-checkboxes',
                            'design' => 'block',
                            'attr' => ['data-columns' => '2'],
                            'allow_empty' => true,
                            'choices' => rishi__cb_customizer_ordered_keys(
                                [
                                    'joined' => __('Joined Date', 'rishi'),
                                    'articles_count' => __('Articles', 'rishi'),
                                    'comments' => __('Comments', 'rishi'),
                                ]
                            ),

                            'value' => [
                                'joined' => true,
                                'articles_count' => true,
                                'comments' => true
                            ],
                        ],
                    ] : [],

                    [
                        $is_single || $is_home ? [
                            rishi__cb_customizer_get_options('general/meta', [
                                'skip_sync_id' => [
                                    'id' => $prefix . 'hero_elements_spacing',
                                ],
                                'is_page' => $is_page,
                                'is_cpt' => $is_cpt
                            ])
                        ] : []
                    ],
                ],
            ],
        ])
    ],
];
