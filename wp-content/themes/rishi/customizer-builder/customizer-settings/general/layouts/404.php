<?php
/**
 * 404 Options
 */

$defaults = rishi__cb__get_breadcrumbs_defaults();

$options = [
    'layout_404_panel' => [
        'label'         => __('404 Page', 'rishi'),
        'type'          => 'rt-panel',
        'setting'       => ['transport' => 'postMessage'],
        'inner-options' => apply_filters( 'rishi__cb_:404:inneroptions', [
            '404_image' => [
				'label'        => __('Upload 404 Image', 'rishi'),
				'type'         => 'rt-image-uploader',
				'value'        => '',
				'inline_value' => true,
				'responsive'   => false,
				'attr'         => ['data-type' => 'small'],
			],
            '404_show_latest_post' => [
				'label'   => __('Show Latest Posts', 'rishi'),
				'type'    => 'rara-switch',
				'value'   => 'yes',
				'divider' => 'top',
			],
          rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['404_show_latest_post' => 'yes'],
				'options' => [
                    '404_no_of_posts' => [
                        'label'   => __('Number of Posts', 'rishi'),
                        'type'    => 'rt-number',
                        'design'  => 'inline',
                        'value'   => 3,
                        'min'     => 1,
                        'max'     => 12,
                        'divider' => 'top',
                        'responsive' => false,
                    ],
                    '404_no_of_posts_row' => [
                        'label'   => __('Number of Posts per Row', 'rishi'),
                        'type'    => 'rt-number',
                        'design'  => 'inline',
                        'value'   => 3,
                        'min'     => 1,
                        'max'     => 4,
                        'divider' => 'top',
                        'responsive' => false,
                    ],

                    '404_show_blog_page_button' => [
                        'label'   => __('Show Blog Page Button', 'rishi'),
                        'type'    => 'rara-switch',
                        'value'   => 'yes',
                        'divider' => 'top',
                    ],
                   '404_show_blog_page_button_condition' => [
                        'condition' => ['404_show_blog_page_button' => 'yes'],
                        'type'      => 'rt-condition',
                        'options' =>[
                            '404_show_blog_page_button_label' => [
                                'label'     => __('Show Blog Page Button Label ', 'rishi'),
                                'type'      => 'text',
                                'design'  => 'block',
                                'sync' => [
                                    'selector' => '.rishi-container-wrap .go-to-blog-wrap',
                                    'render'   => function() { echo rishi_404_show_blog_page_button_label(); }
                                ],
                                'value'     => __('Go To Blog', 'rishi'),
                            ],
                        ],
                    ],
                ]
            ],
        ]),
    ],
];
