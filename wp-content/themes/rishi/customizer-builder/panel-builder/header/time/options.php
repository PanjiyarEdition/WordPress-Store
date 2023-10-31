<?php
$sync_id = 'header_placements_item:time';
if (! isset($panel_type)) {
	$panel_type = 'header';
}

$options = [
	rishi__cb_customizer_rand_md5() => [
		'title'   => __( 'General', 'rishi' ),
		'type'    => 'tab',
		'options' => [
			'header_hide_time' => [
				'label'   => false,
				'type'    => 'hidden',
				'value'   => false,
				'sync'    => 'live',
				'setting' => [
					'type' => 'option',
				],
				'disableRevertButton' => true,
				'desc'   => __('Hide', 'rishi'),
			],

			'header_time_format_type' => [
				'label'   => __('Time Format', 'rishi'),
				'type'    => 'rt-radio',
				'value'   => 'format_1',
				'view'    => 'radio',
				'design'  => 'block',
				'divider' => 'bottom',
				'attr'    => [
					'data-columns' => '3',
					'data-design' => 'time'
							],
				// 'sync'    => [ 'id' => $sync_id ],
				'choices' => [
					'format_1' => current_time('g:i a'),
					'format_2' => current_time('g:i A'),
					'format_3' => current_time('H:i'),
					'format_4' => __( 'Custom', 'rishi' )
				],
				'setting'             => ['transport' => 'postMessage'],
			],

			'header_time_format_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_time_format_type' => 'format_4'],
				'options'   => [				
					'header_time_format_custom' => [
						'label'  => __('Custom', 'rishi'),
						'type'   => 'text',
						'design' => 'inline',
						'value'  => __('H:i:s', 'rishi'),
					],
				]
			],

			'header_time_ed_icon' => [
				'label'   => __('Enable Icon', 'rishi'),
				'type'    => 'rara-switch',
				'setting' => ['transport' => 'postMessage'],
				'value'   => 'no',
				'divider' => 'top',
			],

			'header_time_icon_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_time_ed_icon' => 'yes'],
				'options'   => [				
					'header_time_icon_size' => [
						'label'      => __('Icon Size', 'rishi'),
						'type'       => 'rt-slider',
						'min'        => 0,
						'max'        => 50,
						'value'      => 18,
						'responsive' => true,
						'setting'    => [ 'transport' => 'postMessage' ],
					],
				]
			],
		]
	],
	
	rishi__cb_customizer_rand_md5() => [
		'title'   => __( 'Design', 'rishi' ),
		'type'    => 'tab',
		'options' => [
			'headerTimeFont' => [
				'type'  => 'rt-typography',
				'label' => __('Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => [
						'desktop' => '18px',
						'tablet'  => '18px',
						'mobile'  => '18px'
					],
					'variation' => 'n4',
				]),
				'design' => 'block',
				'sync'   => 'live'
			],

			rishi__cb_customizer_rand_md5() => [
				'type'    => 'cb__labeled-group',
				'label'   => __('Text Color', 'rishi'),
				'choices' => [
					[
						'id'    => 'headerTimeColor',
						'label' => __('Default State', 'rishi')
					],

					[
						'id'        => 'transparentHeaderTimeColor',
						'label'     => __('Transparent State', 'rishi'),
						'condition' => [
							'row'  => '!offcanvas',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id'        => 'stickyHeaderTimeColor',
						'label'     => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [
					'headerTimeColor' => [
						'label'   => __('Text Color', 'rishi'),
						'type'    => 'rt-color-picker',
						'design'  => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value'   => [
							'default' => [
								'color' => 'var(--paletteColor1)',
							],
						],
						'pickers' => [
							[
								'title'   => __('Initial', 'rishi'),
								'id'      => 'default',
								'inherit' => 'var(--headerTimeInitialColor)',
							],
						],
					],

					'transparentHeaderTimeColor' => [
						'label'   => __('Text Color', 'rishi'),
						'type'    => 'rt-color-picker',
						'design'  => 'block:right',
						'setting' => ['transport' => 'postMessage'],
						'value'   => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							]
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id'    => 'default',
							]
						],
					],

					'stickyHeaderTimeColor' => [
						'label'   => __('Text Color', 'rishi'),
						'type'    => 'rt-color-picker',
						'design'  => 'block:right',
						'setting' => ['transport' => 'postMessage'],
						'value'   => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id'    => 'default',
							],
						],
					],
				],
			],

			'header_time_format_color_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_time_ed_icon' => 'yes'],
				'options'   => [
					rishi__cb_customizer_rand_md5() => [
						'type'    => 'cb__labeled-group',
						'label'   => __('Icon Color', 'rishi'),
						'choices' => [
							[
								'id'    => 'headerTimeIconColor',
								'label' => __('Default State', 'rishi')
							],

							[
								'id'        => 'transparentHeaderTimeIconColor',
								'label'     => __('Transparent State', 'rishi'),
								'condition' => [
									'row'  => '!offcanvas',
									'builderSettings/has_transparent_header' => 'yes',
								],
							],

							[
								'id'        => 'stickyHeaderTimeIconColor',
								'label'     => __('Sticky State', 'rishi'),
								'condition' => [
									'row'  => '!offcanvas',
									'builderSettings/has_sticky_header' => 'yes',
								],
							],
						],
						'options' => [
							'headerTimeIconColor' => [
								'label'   => __('Icon Color', 'rishi'),
								'type'    => 'rt-color-picker',
								'design'  => 'inline',
								'setting' => ['transport' => 'postMessage'],
								'value'   => [
									'default' => [
										'color' => 'var(--paletteColor1)',
									],
								],
								'pickers' => [
									[
										'title'   => __('Initial', 'rishi'),
										'id'      => 'default',
										'inherit' => 'var(--headerTimeInitialIconColor)',
									],
								],
							],

							'transparentHeaderTimeIconColor' => [
								'label'   => __('Text Color', 'rishi'),
								'type'    => 'rt-color-picker',
								'design'  => 'block:right',
								'setting' => ['transport' => 'postMessage'],
								'value'   => [
									'default' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									]
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id'    => 'default',
									]
								],
							],

							'stickyHeaderTimeIconColor' => [
								'label'   => __('Text Color', 'rishi'),
								'type'    => 'rt-color-picker',
								'design'  => 'block:right',
								'setting' => ['transport' => 'postMessage'],
								'value'   => [
									'default' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id'    => 'default',
									],
								],
							],
						],
					],
				]
			]
		]
	]
];

