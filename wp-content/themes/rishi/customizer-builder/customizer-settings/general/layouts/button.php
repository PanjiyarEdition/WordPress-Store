<?php

/**
 * Container Options
 */

$defaults = rishi__cb__get_button_defaults();

$colordefaults = rishi__cb__get_color_defaults();

$options = [
    'layout_button_panel' => [
        'label'         => __('Button', 'rishi'),
        'type'          => 'rt-panel',
        'setting'       => ['transport' => 'postMessage'],
        'inner-options' => [
          rishi__cb_customizer_rand_md5() => [
				'title'   => __('General', 'rishi'),
				'type'    => 'tab',
				'options' => [
                    'botton_roundness' => [
                        'label'      => __('Button Roundness', 'rishi'),
                        'type'       => 'rt-slider',
                        'value' => [
                            'desktop' => $defaults['botton_roundness']['desktop'],
                            'tablet'  => $defaults['botton_roundness']['tablet'],
                            'mobile'  => $defaults['botton_roundness']['mobile'],
                        ],
                        'units' => rishi__cb_customizer_units_config([
                            ['unit' => 'px', 'min' => 0, 'max' => 100],
                        ]),
                        'responsive' => true,
                        'divider'    => 'top',
                        'setting'    => ['transport' => 'postMessage'],
                    ],
                    'button_padding' => [
                        'label'   => __('Button Padding', 'rishi'),
                        'type'    => 'rt-spacing',
                        'divider' => 'top',
                        'setting' => [ 'transport' => 'postMessage' ],
                        'value' => rishi__cb_customizer_spacing_value([
                            'linked' => false,
                            'top'    => $defaults['button_padding']['top'],
                            'left'   => $defaults['button_padding']['left'],
                            'right'  => $defaults['button_padding']['right'],
                            'bottom' => $defaults['button_padding']['bottom'],
                        ]),
                        'responsive' => true
                    ],
                ],
            ],
          rishi__cb_customizer_rand_md5() => [
				'title'   => __('Design', 'rishi'),
				'type'    => 'tab',
				'options' => [
                    'btn_text_color' => [
                        'label'           => __('Text Color', 'rishi'),
                        'type'            => 'rt-color-picker',
                        'skipEditPalette' => true,
                        'design'          => 'inline',
                        'setting'         => ['transport' => 'postMessage'],
                        'value'           => [
                            'default' => [
                                'color' => $colordefaults['btn_text_color'],
                            ],
                        ],
                        'pickers' => [
                            [
                                'title' => __('Initial', 'rishi'),
                                'id'    => 'default',
                            ],
                        ],
                    ],
                    'btn_text_hover_color' => [
                        'label'           => __('Text Hover Color', 'rishi'),
                        'type'            => 'rt-color-picker',
                        'skipEditPalette' => true,
                        'design'          => 'inline',
                        'setting'         => ['transport' => 'postMessage'],
                        'value'           => [
                            'default' => [
                                'color' => $colordefaults['btn_text_hover_color'],
                            ],
                        ],
                        'pickers' => [
                            [
                                'title' => __('Initial', 'rishi'),
                                'id'    => 'default',
                            ],
                        ],
                    ],
                    'btn_bg_color' => [
                        'label'           => __('Background Color', 'rishi'),
                        'type'            => 'rt-color-picker',
                        'skipEditPalette' => true,
                        'design'          => 'inline',
                        'setting'         => ['transport' => 'postMessage'],
                        'value'           => [
                            'default' => [
                                'color' => $colordefaults['btn_bg_color'],
                            ],
                        ],
                        'pickers' => [
                            [
                                'title' => __('Initial', 'rishi'),
                                'id'    => 'default',
                            ],
                        ],
                    ],
                    'btn_bg_hover_color' => [
                        'label'           => __('Background Hover Color', 'rishi'),
                        'type'            => 'rt-color-picker',
                        'skipEditPalette' => true,
                        'design'          => 'inline',
                        'setting'         => ['transport' => 'postMessage'],
                        'value'           => [
                            'default' => [
                                'color' => $colordefaults['btn_bg_hover_color'],
                            ],
                        ],
                        'pickers' => [
                            [
                                'title' => __('Initial', 'rishi'),
                                'id'    => 'default',
                            ],
                        ],
                    ],
                    'btn_border_color' => [
                        'label'           => __('Border Color', 'rishi'),
                        'type'            => 'rt-color-picker',
                        'skipEditPalette' => true,
                        'design'          => 'inline',
                        'setting'         => ['transport' => 'postMessage'],
                        'value'           => [
                            'default' => [
                                'color' => $colordefaults['btn_border_color'],
                            ],
                        ],
                        'pickers' => [
                            [
                                'title' => __('Initial', 'rishi'),
                                'id'    => 'default',
                            ],
                        ],
                    ],
                    'btn_border_hover_color' => [
                        'label'           => __('Border Hover Color', 'rishi'),
                        'type'            => 'rt-color-picker',
                        'skipEditPalette' => true,
                        'design'          => 'inline',
                        'setting'         => ['transport' => 'postMessage'],
                        'value'           => [
                            'default' => [
                                'color' => $colordefaults['btn_border_hover_color'],
                            ],
                        ],
                        'pickers' => [
                            [
                                'title' => __('Initial', 'rishi'),
                                'id'    => 'default',
                            ],
                        ],
                    ],
                    'button_Typo' => [
						'type'  => 'rt-typography',
						'label' => __('Typography', 'rishi'),
						'value' => rishi__cb_customizer_typography_default_values([
                            'family'    => 'Default',
							'size'      => '18px',
							'variation' => 'n4',
                            'line-height' => '1.2',
						]),
						'setting' => ['transport' => 'postMessage'],
					],
                ],
            ],
        ],
    ],
];
