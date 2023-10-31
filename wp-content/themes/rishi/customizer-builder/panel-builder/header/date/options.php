<?php
$sync_id = 'header_placements_item:date';
if (! isset($panel_type)) {
	$panel_type = 'header';
}
$options = [
	rishi__cb_customizer_rand_md5() => [
		'title' => __( 'General', 'rishi' ),
		'type' => 'tab',
		'options' => [
			'header_hide_date' => [
				'label' => false,
				'type' => 'hidden',
				'value' => false,
				'sync' => 'live',
				'setting' => [
					'type' => 'option',
				],
				'disableRevertButton' => true,
				'desc' => __('Hide', 'rishi'),
			],
			'header_date_format_type' => [
				'label'   => __('Date Format', 'rishi'),
				'type'    => 'rt-radio',
				'value'   => 'format_1',
				'view'    => 'radio',
				'design'  => 'block',
				'divider' => 'bottom',
				'attr'    => ['data-design' => 'block'],
				'sync'    => ['id' => $sync_id ],
				'choices' => [
					'format_1' => esc_html( date_i18n( 'l, F j, Y' ) ),
					'format_2' => esc_html( date_i18n('F j, Y') ),
					'format_3' => esc_html( date_i18n('m-d-Y' ) ),
					'format_4' => esc_html( date_i18n('m/d/Y' ) ),
					'format_5' => __( 'Custom', 'rishi' )
				],
			],
			'header_date_format_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_date_format_type' => 'format_5'],
				'options'   => [				
					'header_date_format_custom' => [
						'label'  => __('Custom', 'rishi'),
						'type'   => 'text',
						'design' => 'inline',
						'value'  => __('Y-m-d', 'rishi'),
					],
				]
			],
			'header_date_ed_icon' => [
				'label'   => __('Enable Icon', 'rishi'),
				'type'    => 'rara-switch',
				'setting' => ['transport' => 'postMessage'],
				'value'   => 'no',
				'divider' => 'top',
			],
			'header_date_icon_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_date_ed_icon' => 'yes'],
				'options'   => [				
					'header_date_icon_size' => [
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
		'title' => __( 'Design', 'rishi' ),
		'type' => 'tab',
		'options' => [
			'headerDateFont' => [
				'type' => 'rt-typography',
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
				'sync' => 'live'
			],
			rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Text Color', 'rishi'),
				'choices' => [
					[
						'id' => 'headerDateColor',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderDateColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderDateColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [
					'headerDateColor' => [
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
								'inherit' => 'var(--headerDateInitialColor)',
							],
						],
					],

					'transparentHeaderDateColor' => [
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

					'stickyHeaderDateColor' => [
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
			'header_date_icon_color_condition' => [
				'type'      => 'rt-condition',
				'condition' => ['header_date_ed_icon' => 'yes'],
				'options'   => [
					rishi__cb_customizer_rand_md5() => [
						'type' => 'cb__labeled-group',
						'label' => __('Icon Color', 'rishi'),
						'choices' => [
							[
								'id' => 'headerDateIconColor',
								'label' => __('Default State', 'rishi')
							],

							[
								'id' => 'transparentHeaderDateIconColor',
								'label' => __('Transparent State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_transparent_header' => 'yes',
								],
							],

							[
								'id' => 'stickyHeaderDateIconColor',
								'label' => __('Sticky State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_sticky_header' => 'yes',
								],
							],
						],
						'options' => [
							'headerDateIconColor' => [
								'label' => __('Icon Color', 'rishi'),
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
										'inherit' => 'var(--headerDateInitialIconColor)',
									],
								],
							],

							'transparentHeaderDateIconColor' => [
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

							'stickyHeaderDateIconColor' => [
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
			]
		]
	]
];