<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => array_merge([
			'header_hide_button' => [
				'label' => false,
				'type' => 'hidden',
				'value' => false,
				'sync' => 'live',
				'setting' => [
					'type' => 'option',
					// 'transport' => 'postMessage'
				],
				'disableRevertButton' => true,
				'desc' => __('Hide', 'rishi'),
			],
			'header_button_type' => [
				'label' => false,
				'type' => 'rt-image-picker',
				'value' => 'type-1',
				'attr' => [
					'data-usage' => 'button-icon',
				],
				'choices' => [

					'type-1' => [
						'src'   => rishi__cb_customizer_image_picker_file('button-1'),
						'title' => __('Default', 'rishi'),
					],

					'type-2' => [
						'src'   => rishi__cb_customizer_image_picker_file('button-2'),
						'title' => __('Outline', 'rishi'),
					],

				],
			],

			'header_button_size' => [
				'label' => __('Size', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'small',
				'view' => 'text',
				'design' => 'block',
				'divider' => 'bottom',
				'choices' => [
					'small' => __('Small', 'rishi'),
					'medium' => __('Medium', 'rishi'),
					'large' => __('Large', 'rishi'),
				],
			],

			'header_button_text' => [
				'label' => __('Label', 'rishi'),
				'type' => 'text',
				'design' => 'inline',
				'value' => __('Download', 'rishi'),
			],

			'header_button_link' => [
				'label' => __('URL', 'rishi'),
				'type' => 'text',
				'design' => 'inline',
				'value' => '',
			],
			'header_button_minwidth' => [
				'label' => __('Min Width ', 'rishi'),
				'type' => 'rt-slider',
				'min' => 0,
				'max' => 300,
				'value' => 50,
				'responsive' => true,
				'divider' => 'top',
			],
			'header_button_target' => [
				'label' => __('Open in new tab', 'rishi'),
				'type'  => 'rara-switch',
				'value' => 'no',
				'divider' => 'top',
			],
			'header_button_ed_nofollow' => [
				'label' => __('Set link to nofollow', 'rishi'),
				'type'  => 'rara-switch',
				'value' => 'no',
				'divider' => 'top',
			],
			'header_button_ed_sponsored' => [
				'label' => __('Set link attribute Sponsored', 'rishi'),
				'type'  => 'rara-switch',
				'value' => 'no',
				'divider' => 'top',
			],
			'header_button_ed_download' => [
				'label' => __('Set link to Download', 'rishi'),
				'type'  => 'rara-switch',
				'value' => 'no',
				'divider' => 'top',
			],
			'button_visibility' => [
				'label' => __('Button Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'allow_empty' => true,
				'sync' => 'live',
				// 'view' => 'modal',
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


		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['wp_customizer_current_view' => 'mobile'],
				'options' => [

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					'visibility' => [
						'label' => __('Visibility', 'rishi'),
						'type' => 'rt-visibility',
						'design' => 'block',
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
		], $panel_type === 'footer' ? [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footer_button_horizontal_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Horizontal Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'responsive' => true,
				'attr' => ['data-type' => 'alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'flex-start',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

			'footer_button_vertical_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Vertical Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'divider' => 'top',
				'responsive' => true,
				'attr' => ['data-type' => 'vertical-alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'CT_CSS_SKIP_RULE',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

			'visibility' => [
				'label' => __('Element Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'sync' => 'live',
				'divider' => 'top',
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
		] : []),
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Font Color', 'rishi'),
				'divider' => 'bottom',
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerButtonFontColor',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderButtonFontColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderButtonFontColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerButtonFontColor' => [
						'label' => __('Font Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'value' => [
							'default' => [
								'color' => 'var(--paletteColor5)',
							],

							'hover' => [
								'color' => 'var(--paletteColor5)',
							],

							'default_2' => [
								'color' => 'var(--paletteColor3)',
							],

							'hover_2' => [
								'color' => 'var(--paletteColor2)',
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--buttonTextInitialColor)',
								'condition' => ['header_button_type' => 'type-1']
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
								'inherit' => 'var(--buttonTextHoverColor)',
								'condition' => ['header_button_type' => 'type-1']
							],

							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default_2',
								'condition' => ['header_button_type' => 'type-2']
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover_2',
								'condition' => ['header_button_type' => 'type-2']
							],
						],
					],

					'transparentHeaderButtonFontColor' => [
						'label' => __('Font Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'default_2' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover_2' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'condition' => ['header_button_type' => 'type-1']
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
								'condition' => ['header_button_type' => 'type-1']
							],

							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default_2',
								'condition' => ['header_button_type' => 'type-2']
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover_2',
								'condition' => ['header_button_type' => 'type-2']
							],
						],
					],

					'stickyHeaderButtonFontColor' => [
						'label' => __('Font Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'default_2' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover_2' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'condition' => ['header_button_type' => 'type-1']
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
								'condition' => ['header_button_type' => 'type-1']
							],

							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default_2',
								'condition' => ['header_button_type' => 'type-2']
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover_2',
								'condition' => ['header_button_type' => 'type-2']
							],
						],
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Button Color', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerButtonForeground',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentHeaderButtonForeground',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderButtonForeground',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerButtonForeground' => [
						'label' => __('Button Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'value' => [
							'default' => [
								'color' => 'var(--paletteColor3)',
							],

							'hover' => [
								'color' => 'var(--paletteColor2)',
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--buttonInitialColor)'
							],

							[
								'title' => __('Hover', 'rishi'),
								'id' => 'hover',
								'inherit' => 'var(--buttonHoverColor)'
							],
						],
					],

					'transparentHeaderButtonForeground' => [
						'label' => __('Button Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
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

					'stickyHeaderButtonForeground' => [
						'label' => __('Button Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
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
			'header_button_border_color' => [
				'label'   => __('Border Color', 'rishi'),
				'type'    => 'rt-color-picker',
				'design'  => 'inline',
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'default' => [
						'color' => 'var(--paletteColor3)',
					],

					'hover' => [
						'color' => 'var(--paletteColor2)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],

					[
						'title' => __('Hover', 'rishi'),
						'id'    => 'hover',
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'headerCTAShadow' => [
				'label' => __('Button Shadow', 'rishi'),
				'type' => 'rt-box-shadow',
				'responsive' => true,
				'value' => rishi__cb_customizer_box_shadow_value([
					'enable'   => false,
					'h_offset' => 0,
					'v_offset' => 10,
					'blur'     => 20,
					'spread'   => 0,
					'inset'    => false,
					'color' => [
						'color' => 'var(--paletteColor7)',
					],
				])
			],
			'headerCTAShadowHover' => [
				'label' => __('Button Hover Shadow', 'rishi'),
				'type' => 'rt-box-shadow',
				'responsive' => true,
				'value' => rishi__cb_customizer_box_shadow_value([
					'enable'   => false,
					'h_offset' => 0,
					'v_offset' => 10,
					'blur'     => 20,
					'spread'   => 0,
					'inset'    => false,
					'color' => [
						'color' => 'var(--paletteColor7)',
					],
				])
			],

			'headerCtaRadius' => [
				'label' => __('Border Radius', 'rishi'),
				'type' => 'rt-spacing',
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true
			],

			'headerCtaMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'divider' => 'top',
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true,
			],
			'headerCtaPadding' => [
				'label' => __('Padding', 'rishi'),
				'type' => 'rt-spacing',
				'divider' => 'top',
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => false,
					'top'    => '10px',
					'left'   => '20px',
					'right'  => '20px',
					'bottom' => '10px',
				]),
				'responsive' => true,
			],

		],
	],
];
