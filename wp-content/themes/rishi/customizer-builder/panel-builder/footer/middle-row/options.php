<?php

if (empty($default_background)) {
	$default_background = rishi__cb_customizer_background_default_value([
		'backgroundColor' => [
			'default' => [
				'color' => 'var(--paletteColor2)'
			],
		],
	]);
}

if (empty($default_top_bottom_spacing)) {
	$default_top_bottom_spacing = [
		'desktop' => '70px',
		'tablet' => '50px',
		'mobile' => '40px',
	];
}

if (empty($default_items_spacing)) {
	$default_items_spacing = [
		'desktop' => 60,
		'tablet' => 40,
		'mobile' => 40,
	];
}

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [

			'hide_footer_row' => [
				'label'   => false,
				'type'    => 'hidden',
				'value'   => false,
				'sync'    => 'live',
				'setting' => [
					'type' => 'option',
					// 'transport' => 'postMessage'
				],
				'disableRevertButton' => true,
				'desc'                => __('Hide', 'rishi'),
			],

			'items_per_row' => [
				'label' => __('Columns per row', 'rishi'),
				'type' => 'rt-radio',
				'value' => '3',
				'view' => 'text',
				'design' => 'block',
				'allow_empty' => true,
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
					'5' => 5,
					'6' => 6,
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['items_per_row' => '2'],
				'options' => [

					'2_columns_layout' => [
						'label' => __('Columns Layout', 'rishi'),
						'type' => 'rt-image-picker',
						'attr' => [
							'data-ratio' => '2:1',
							'data-usage' => 'footer-layout',
						],
						'value' => [
							'desktop' => 'repeat(2, 1fr)',
							'tablet' => 'initial',
							'mobile' => 'initial'
						],
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
							],

							'2fr 1fr' => [
								'src' => rishi__cb_customizer_image_picker_file('2-1'),
							],

							'1fr 2fr' => [
								'src' => rishi__cb_customizer_image_picker_file('1-2'),
							],

							'3fr 1fr' => [
								'src' => rishi__cb_customizer_image_picker_file('3-1'),
							],

							'1fr 3fr' => [
								'src' => rishi__cb_customizer_image_picker_file('1-3'),
							],
						],

						'tabletChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],

						'mobileChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['items_per_row' => '3'],
				'options' => [

					'3_columns_layout' => [
						'label' => __('Columns Layout', 'rishi'),
						'type' => 'rt-image-picker',
						'attr' => [
							'data-ratio' => '2:1',
							'data-usage' => 'footer-layout',
						],
						'value' => [
							'desktop' => 'repeat(3, 1fr)',
							'tablet' => 'initial',
							'mobile' => 'initial',
						],
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'repeat(3, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1-1'),
							],

							'1fr 2fr 1fr' => [
								'src' => rishi__cb_customizer_image_picker_file('1-2-1'),
							],

							'2fr 1fr 1fr' => [
								'src' => rishi__cb_customizer_image_picker_file('2-1-1'),
							],

							'1fr 1fr 2fr' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1-2'),
							],
						],

						'tabletChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],

						'mobileChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['items_per_row' => '4'],
				'options' => [

					'4_columns_layout' => [
						'label' => __('Columns Layout', 'rishi'),
						'type' => 'rt-image-picker',
						'attr' => ['data-ratio' => '2:1'],
						'value' => [
							'desktop' => 'repeat(4, 1fr)',
							'tablet' => 'initial',
							'mobile' => 'initial'
						],
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'repeat(4, 1fr)' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-1-1'),
							],

							'1fr 2fr 2fr 1fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-2-2-1'),
							],

							'2fr 1fr 1fr 1fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('2-1-1-1'),
							],

							'1fr 1fr 1fr 2fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-1-2'),
							],
						],

						'tabletChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],

						'mobileChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['items_per_row' => '5'],
				'options' => [

					'5_columns_layout' => [
						'label' => __('Columns Layout', 'rishi'),
						'type' => 'rt-image-picker',
						'attr' => ['data-ratio' => '2:1'],
						'value' => [
							'desktop' => 'repeat(5, 1fr)',
							'tablet' => 'initial',
							'mobile' => 'initial'
						],
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'repeat(5, 1fr)' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-1-1-1'),
							],

							'2fr 1fr 1fr 1fr 1fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('2-1-1-1-1'),
							],

							'1fr 1fr 1fr 1fr 2fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-1-1-2'),
							],

							'1fr 1fr 2fr 1fr 1fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-2-1-1'),
							],
						],

						'tabletChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],

						'mobileChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['items_per_row' => '6'],
				'options' => [

					'6_columns_layout' => [
						'label' => __('Columns Layout', 'rishi'),
						'type' => 'rt-image-picker',
						'attr' => ['data-ratio' => '2:1'],
						'value' => [
							'desktop' => 'repeat(6, 1fr)',
							'tablet' => 'initial',
							'mobile' => 'initial'
						],
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'repeat(6, 1fr)' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-1-1-1-1'),
							],

							'2fr 1fr 1fr 1fr 1fr 1fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('2-1-1-1-1-1'),
							],

							'1fr 1fr 1fr 1fr 1fr 2fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-1-1-1-2'),
							],

							'1fr 1fr 2fr 2fr 1fr 1fr' => [
								'src'   => rishi__cb_customizer_image_picker_file('1-1-2-2-1-1'),
							],
						],

						'tabletChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],

						'mobileChoices' => [
							'initial' => [
								'src' => rishi__cb_customizer_image_picker_file('stacked'),
								'title' => __('Stacked', 'rishi'),
							],

							'repeat(2, 1fr)' => [
								'src' => rishi__cb_customizer_image_picker_file('1-1'),
								'title' => __('Two Columns', 'rishi'),
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['items_per_row' => '!1'],
				'options' => [

					'footerItemsGap' => [
						'label' => __('Items Spacing', 'rishi'),
						'type' => 'rt-slider',
						'min' => 0,
						'max' => 200,
						'value' => $default_items_spacing,
						'responsive' => true,
						'divider' => 'bottom',
						'desc' => __('Space between columns, elements and widgets.', 'rishi'),
						'setting' => ['transport' => 'postMessage'],
					],

				],
			],

			'rowTopBottomSpacing' => [
				'label' => __('Row Vertical Spacing', 'rishi'),
				'type' => 'rt-slider',
				'value' => $default_top_bottom_spacing,
				'units' => rishi__cb_customizer_units_config([
					['unit' => 'px', 'min' => 0, 'max' => 500],
				]),
				'responsive' => true,
				'desc' => __('Set the container\'s top and bottom inner spacing.', 'rishi'),
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footer_row_vertical_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Vertical Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'responsive' => true,
				'attr' => ['data-type' => 'vertical-alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'flex-start',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footerRowWidth' => [
				'label' => __('Row Container Width', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'fixed',
				'view' => 'text',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'fixed' => __('Fixed', 'rishi'),
					'fluid' => __('Fluid', 'rishi'),
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footerRowVisibility' => [
				'label' => __('Row Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],

				'value' => [
					'desktop' => true,
					'tablet' => true,
					'mobile' => true,
				],

				'choices' => rishi__cb_customizer_ordered_keys([
					'desktop' => __('Desktop', 'rishi'),
					'tablet' => __('Tablet', 'rishi'),
					'mobile' => __('Mobile', 'rishi'),
				]),
			],

		],
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

			'footerRowBackground' => [
				'label' => __('Row Background', 'rishi'),
				'type'  => 'rt-background',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],
				'value' => $default_background
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footerRowTopDivider' => [
				'label' => __('Row Top Divider', 'rishi'),
				'type' => 'rt-border',
				'design' => 'block',
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'width' => 1,
					'style' => 'none',
					'color' => [
						'color' => '#dddddd',
					],
				]
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['footerRowTopDivider/style:responsive' => '!none'],
				'options' => [

					'footerRowTopBorderFullWidth' => [
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

			'footerRowBottomDivider' => [
				'label' => __('Row Bottom Divider', 'rishi'),
				'type' => 'rt-border',
				'design' => 'block',
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'width' => 1,
					'style' => 'none',
					'color' => [
						'color' => '#dddddd',
					],
				]
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['footerRowBottomDivider/style:responsive' => '!none'],
				'options' => [

					'footerRowBottomBorderFullWidth' => [
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
				'type' => 'rt-condition',
				'condition' => ['items_per_row' => '!1'],
				'options' => [

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					'footerColumnsDivider' => [
						'label' => __('Items Divider', 'rishi'),
						'type' => 'rt-border',
						'design' => 'inline',
						'desc' => __('This divider will be placed between columns, elements and widgets.', 'rishi'),
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'width' => 1,
							'style' => 'none',
							'color' => [
								'color' => '#dddddd',
							],
						]
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['has_widget_areas' => 'yes'],
				'options' => [
				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					'footerWidgetsTitleFont' => [
						'type' => 'rt-typography',
						'label' => __('Widgets Title Font', 'rishi'),
						'value' => rishi__cb_customizer_typography_default_values([
							'size' => '16px',
							'line-height' => '1.75',
							'letter-spacing' => '0.4px',
							'text-transform' => 'uppercase',
						]),
						'setting' => ['transport' => 'postMessage'],
					],

					'footerWidgetsTitleColor' => [
						'label' => __('Widgets Title Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor5)',
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--headingColor)'
							],
						],
					],

					'footerWidgetsFont' => [
						'type' => 'rt-typography',
						'label' => __('Widgets Font', 'rishi'),
						'value' => rishi__cb_customizer_typography_default_values([
							//'size' => '16px',

						]),
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
					],

					'rowFontColor' => [
						'label' => __('Widgets Font Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor5)',
							],

							'link_initial' => [
								'color' => 'var(--paletteColor5)',
							],

							'link_hover' => [
								'color' => 'var(--paletteColor3)',
							],
						],

						'pickers' => [
							[
								'title' => __('Text Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--color)'
							],

							[
								'title' => __('Link Initial', 'rishi'),
								'id' => 'link_initial',
							],

							[
								'title' => __('Link Hover', 'rishi'),
								'id' => 'link_hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],

					'rowHeadingFontColor' => [
						'label' => __('Widgets Headings Font Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor5)',
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--headingColor)'
							],
						],
					],
				]
			]


		],
	],
];
