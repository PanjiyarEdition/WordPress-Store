<?php

$cpt_choices = [
	'post' => __('Posts', 'rishi'),
	'page' => __('Pages', 'rishi'),
	'product' => __('Products', 'rishi')
];

$cpt_options = [
	'post' => true,
	'page' => true,
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
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [
			'header_hide_search' => [
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

			'searchHeaderIconSize' => [
				'label' => __('Icon Size', 'rishi'),
				'type' => 'rt-slider',
				'min' => 5,
				'max' => 50,
				'value' => 15,
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-title',
				'label' => __('Search Through Criteria', 'rishi'),
				'desc' => __('Choose in which post types do you want to perform searches.','rishi')
			],

			'search_through' => [
				'label' => false,
				'type' => 'rt-checkboxes',
				'attr' => ['data-columns' => '2'],
				'disableRevertButton' => true,
				'choices' => rishi__cb_customizer_ordered_keys($cpt_choices),
				'value' => $cpt_options
			],

		],
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Icon Color', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'searchHeaderIconColor',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentSearchHeaderIconColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'builderSettings/has_transparent_header' => 'yes',
						],
					],


					[
						'id' => 'stickySearchHeaderIconColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'searchHeaderIconColor' => [
						'label' => __('Icon Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor1)',
							],

							'hover' => [
								'color' => 'var(--paletteColor3)',
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],

					'transparentSearchHeaderIconColor' => [
						'label' => __('Icon Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
							],
						],
					],

					'stickySearchHeaderIconColor' => [
						'label' => __('Icon Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
							],
						],
					],
				],
			],

			'headerSearchMargin' => [
				'label' => __('Icon Margin', 'rishi'),
				'type' => 'rt-spacing',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true
			],

			'search_close_button_color' => [
				'label' => __('Close Icon Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],

				'value' => [
					'default' => [
						'color' => 'var(--paletteColor5)',
					],

					'hover' => [
						'color' => 'var(--paletteColor4)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'rgba(255, 255, 255, 0.7)'
					],

					[
						'title' => __('Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => '#ffffff'
					],
				],
			],

			'search_close_button_shape_color' => [
				'label' => __('Close Icon Background', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],

				'value' => [
					'default' => [
						'color' => '#f5585000',
					],

					'hover' => [
						'color' => '#f5585000',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'rgba(0, 0, 0, 0.5)'
					],

					[
						'title' => __('Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => 'rgba(0, 0, 0, 0.5)'
					],
				],
			],

			'searchHeaderBackground' => [
				'label' => __('Modal Background', 'rishi'),
				'type'  => 'rt-background',
				'design' => 'inline',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_background_default_value([
					'backgroundColor' => [
						'default' => [
							'color' => 'rgba(18, 21, 25, 0.98)'
						],
					],
				])
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'searchHeaderFontColor' => [
				'label' => __('Modal Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'divider' => 'bottom',
				'setting' => ['transport' => 'postMessage'],

				'value' => [
					'default' => [
						'color' => 'var(--paletteColor1)',
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


 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => ['wp_customizer_current_view' => 'mobile'],
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'header_search_visibility' => [
				'label' => __('Item Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'allow_empty' => true,
				'value' => [
					'tablet' => true,
					'mobile' => true,
				],

				'choices' => rishi__cb_customizer_ordered_keys([
					'tablet' => __('Tablet', 'rishi'),
					'mobile' => __('Mobile', 'rishi'),
				]),
			],

		],
	],
];
