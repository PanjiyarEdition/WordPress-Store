<?php

$has_shrink = false;

if (empty($default_height)) {
	$has_shrink = true;

	$default_height = [
		'mobile' => 70,
		'tablet' => 70,
		'desktop' => 120,
	];
}

if (empty($default_background)) {
	$default_background = rishi__cb_customizer_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => 'var(--paletteColor5)',
			],
		],
	]);
}

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [

			'header_hide_row' => [
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

			'headerRowWidth' => [
				'label' => __('Container Width', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'fixed',
				'view' => 'text',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'fixed' => __('Default', 'rishi'),
					'fluid' => __('Full Width', 'rishi'),
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'headerRowHeight' => [
				'label' => __('Row Min Height', 'rishi'),
				'type' => 'rt-slider',
				'min' => 20,
				'max' => 300,
				'responsive' => true,
				'value' => $default_height,
				'setting' => ['transport' => 'postMessage'],
			],

			'has_sticky_shrink' => [
				'label' => __('Sticky State Row Shrink', 'rishi'),
				'type' => 'rara-switch',
				'type' => $has_shrink ? 'rara-switch' : 'hidden',
				'value' => 'no',
				'divider' => 'top',

				'sync' => [
					'id' => 'header_placements_1'
				]
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['has_sticky_shrink' => 'yes'],
				'options' => [

					'stickyHeaderRowShrink' => [
						'label' => __('Row Max Height', 'rishi'),
						'type' => $has_shrink ? 'rt-slider' : 'hidden',
						'min' => 30,
						'max' => 100,
						'responsive' => true,
						'value' => 70,
						'defaultUnit' => '%',
						'sync' => [
							'id' => 'header_placements_1'
						],
					],

				],
			],

		],
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Background', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerRowBackground',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderRowBackground',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderRowBackground',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerRowBackground' => [
						'label' => __('Background', 'rishi'),
						'type'  => 'rt-background',
						'design' => 'block:right',
						'responsive' => true,
						'value' => $default_background,
						'sync' => 'live'
					],

					'transparentHeaderRowBackground' => [
						'label' => __('Background', 'rishi'),
						'type'  => 'rt-background',
						'design' => 'block:right',
						'responsive' => true,
						'value' => rishi__cb_customizer_background_default_value([
							'backgroundColor' => [
								'default' => [
									'color' => 'rgba(255,255,255,0)',
								],
							],
						]),
						'sync' => 'live'
					],

					'stickyHeaderRowBackground' => [
						'label' => __('Background', 'rishi'),
						'type'  => 'rt-background',
						'design' => 'block:right',
						'responsive' => true,
						'value' => $default_background,
						'sync' => 'live'
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Top Border', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerRowTopBorder',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderRowTopBorder',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderRowTopBorder',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerRowTopBorder' => [
						'label' => __('Top Border', 'rishi'),
						'type' => 'rt-border',
						'design' => 'block',
						'responsive' => true,
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => 'rgba(44,62,80,0.2)',
							],
						]
					],

					'transparentHeaderRowTopBorder' => [
						'label' => __('Top Border', 'rishi'),
						'type' => 'rt-border',
						'design' => 'block',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						]
					],

					'stickyHeaderRowTopBorder' => [
						'label' => __('Top Border', 'rishi'),
						'type' => 'rt-border',
						'design' => 'block',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						]
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'any' => [
						'headerRowTopBorder/style:responsive' => '!none',
						'transparentHeaderRowTopBorder/style:responsive' => '!none',
						'stickyHeaderRowTopBorder/style:responsive' => '!none',
					]
				],
				'options' => [

					'headerRowTopBorderFullWidth' => [
						'label' => __('Top Border Width', 'rishi'),
						'type' => 'rt-radio',
						'value' => 'no',
						'view' => 'text',
						'design' => 'block',
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'no' => __('Default', 'rishi'),
							'yes' => __('Full Width', 'rishi'),
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Bottom Border', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerRowBottomBorder',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderRowBottomBorder',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderRowBottomBorder',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerRowBottomBorder' => [
						'label' => __('Bottom Border', 'rishi'),
						'type' => 'rt-border',
						'design' => 'block',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => 'rgba(44,62,80,0.2)',
							],
						]
					],

					'transparentHeaderRowBottomBorder' => [
						'label' => __('Bottom Border', 'rishi'),
						'type' => 'rt-border',
						'design' => 'block',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						]
					],

					'stickyHeaderRowBottomBorder' => [
						'label' => __('Bottom Border', 'rishi'),
						'type' => 'rt-border',
						'design' => 'block',
						'responsive' => true,
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						]
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'any' => [
						'headerRowBottomBorder/style:responsive' => '!none',
						'transparentHeaderRowBottomBorder/style:responsive' => '!none',
						'stickyHeaderRowBottomBorder/style:responsive' => '!none'
					]
				],
				'options' => [

					'headerRowBottomBorderFullWidth' => [
						'label' => __('Bottom Border Width', 'rishi'),
						'type' => 'rt-radio',
						'value' => 'no',
						'view' => 'text',
						'design' => 'block',
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'no' => __('Default', 'rishi'),
							'yes' => __('Full Width', 'rishi'),
						],
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Shadow', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerRowShadow',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderRowShadow',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderRowShadow',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerRowShadow' => [
						'label' => __('Shadow', 'rishi'),
						'type' => 'rt-box-shadow',
						'responsive' => true,
						'hide_shadow_placement' => true,
						'value' => rishi__cb_customizer_box_shadow_value([
							'enable' => false,
							'h_offset' => 0,
							'v_offset' => 10,
							'blur' => 20,
							'spread' => 0,
							'inset' => false,
							'color' => [
								'color' => 'rgba(44,62,80,0.05)',
							],
						])
					],

					'transparentHeaderRowShadow' => [
						'label' => __('Shadow', 'rishi'),
						'type' => 'rt-box-shadow',
						'responsive' => true,
						'hide_shadow_placement' => true,
						'value' => rishi__cb_customizer_box_shadow_value([
							'enable' => false,
							'h_offset' => 0,
							'v_offset' => 10,
							'blur' => 20,
							'spread' => 0,
							'inset' => false,
							'color' => [
								'color' => 'rgba(44,62,80,0.05)',
							],
						])
					],

					'stickyHeaderRowShadow' => [
						'label' => __('Shadow', 'rishi'),
						'type' => 'rt-box-shadow',
						'responsive' => true,
						'hide_shadow_placement' => true,
						'value' => rishi__cb_customizer_box_shadow_value([
							'enable' => false,
							'h_offset' => 0,
							'v_offset' => 10,
							'blur' => 20,
							'spread' => 0,
							'inset' => false,
							'color' => [
								'color' => 'rgba(44,62,80,0.05)',
							],
						])
					],

				],
			],

		],
	],
];
