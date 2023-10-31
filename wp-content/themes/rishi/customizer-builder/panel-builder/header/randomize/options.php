<?php
$cpt_choices = [
	'post'    => __('Posts', 'rishi'),
	'page'    => __('Pages', 'rishi'),
	'product' => __('Products', 'rishi')
];

$cpt_options = [
	'post'    => true,
	'page'    => true,
	'product' => true
];

foreach (rishi__cb_customizer_manager()->post_types->get_supported_post_types() as $single_cpt) {
	if (get_post_type_object($single_cpt)) {
		$cpt_choices[$single_cpt] = get_post_type_labels(
			get_post_type_object($single_cpt)
		)->singular_name;
	} else {
		$cpt_choices[$single_cpt] = ucfirst($single_cpt);
	}

	$cpt_options[$single_cpt] = true;
}

$options = [
    rishi__cb_customizer_rand_md5() => [
		'title' => __( 'General', 'rishi' ),
		'type' => 'tab',
		'options' => [
            'header_hide_randomize' => [
				'label'   => false,
				'type'    => 'hidden',
				'value'   => false,
				'sync'    => 'live',
				'setting' => [
					'type' => 'option',
				],
				'disableRevertButton' => true,
				'desc' => __('Hide', 'rishi'),
			],
			'header_randomize_icon_type' => [
				'label' => false,
				'type'  => 'rt-image-picker',
				'value' => 'type-1',
				'attr'  => [
					'data-type'    => 'background',
					'data-columns' => '3',
					'data-usage'   => 'cacb__icon',
				],
				'divider' => 'bottom',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'type-1' => [
						'src'   => rishi__cb_customizer_image_picker_url('shuffle-1.svg'),
						'title' => __('Default', 'rishi'),
					],
					'type-2' => [
						'src'   => rishi__cb_customizer_image_picker_url('shuffel-2.svg'),
						'title' => __('Icon 2', 'rishi'),
					],

					'type-3' => [
						'src'   => rishi__cb_customizer_image_picker_url('shuffle-3.svg'),
						'title' => __('Icon 3', 'rishi'),
					],

				],
			],
            'header_randomize_icon_size' => [
                'label'      => __('Icon Size', 'rishi'),
                'type'       => 'rt-slider',
                'min'        => 0,
                'max'        => 50,
                'value'      => 20,
                'responsive' => true,
                'setting'    => [ 'transport' => 'postMessage' ],
            ],
            'header_randomize_ed_title' => [
				'label'   => __('Show Label', 'rishi'),
				'type'    => 'rara-switch',
				'setting' => ['transport' => 'postMessage'],
				'value'   => 'no',
				'divider' => 'top',
			],
            'header_randomize_title_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_randomize_ed_title' => 'yes'],
				'options'   => [
                    'header_randomize_label' => [
                        'label'  => __('Label', 'rishi'),
                        'type'   => 'text',
                        'design' => 'inline',
                        'value'  => __( 'Surprise me', 'rishi' ),
                    ],
                ]
            ],
            rishi__cb_customizer_rand_md5() => [
                'type'  => 'rt-title',
                'label' => __('Randomize', 'rishi'),
                'desc'  => __('Choose what you want your visitors to see after clicking this icon.','rishi')
            ],

            'header_randomize_pages' => [
                'label'               => false,
                'type'                => 'rt-checkboxes',
                'attr'                => ['data-columns' => '1'],
                'disableRevertButton' => true,
                'choices'             => rishi__cb_customizer_ordered_keys($cpt_choices),
                'value'               => $cpt_options
            ],
        ]
    ],

    rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [
            'headerRandomizeFont' => [
				'type' => 'rt-typography',
				'label' => __('Text Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => [
						'desktop' => '18px',
						'tablet'  => '18px',
						'mobile'  => '18px'
					],
					'variation' => 'n4',
				]),
				'design' => 'block',
				'sync' => 'live'
			],

			'header_randomize_title_color_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_randomize_ed_title' => 'yes'],
				'options'   => [
					rishi__cb_customizer_rand_md5() => [
						'type' => 'cb__labeled-group',
						'label' => __('Text Color', 'rishi'),
						'choices' => [
							[
								'id' => 'headerRandomizeColor',
								'label' => __('Default State', 'rishi')
							],

							[
								'id' => 'transparentHeaderRandomizeColor',
								'label' => __('Transparent State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_transparent_header' => 'yes',
								],
							],

							[
								'id' => 'stickyHeaderRandomizeColor',
								'label' => __('Sticky State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_sticky_header' => 'yes',
								],
							],
						],
						'options' => [
							'headerRandomizeColor' => [
								'label' => __('Text Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'setting' => ['transport' => 'postMessage'],
								'value' => [
									'default' => [
										'color' =>'var(--paletteColor1)',
									],
								],
								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--headerRandomizeInitialColor)',
									],
								],
							],

							'transparentHeaderRandomizeColor' => [
								'label' => __('Text Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'setting' => ['transport' => 'postMessage'],
								'value' => [
									'default' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									]
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									]
								],
							],

							'stickyHeaderRandomizeColor' => [
								'label' => __('Text Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'setting' => ['transport' => 'postMessage'],
								'value' => [
									'default' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],
								],
							],
						],
					],
				]
			],
            rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Icon Color', 'rishi'),
				'choices' => [
					[
						'id' => 'headerRandomizeIconColor',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderRandomizeIconColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderRandomizeIconColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [
					'headerRandomizeIconColor' => [
						'label' => __('Icon Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' =>'var(--paletteColor1)',
							],
							'hover' => [
								'color' =>'var(--paletteColor4)',
							],
						],
						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--headerRandomizeInitialIconColor)',
							],
							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
								'inherit' => 'var(--headerRandomizeInitialIconHoverColor)',
							],
						],
					],

					'transparentHeaderRandomizeIconColor' => [
						'label' => __('Text Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							]
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
							],
							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
							]
						],
					],

					'stickyHeaderRandomizeIconColor' => [
						'label' => __('Text Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							]
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
							],
							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
							]
						],
					],
				],
			],
        ]
    ]
];