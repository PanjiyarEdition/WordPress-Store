<?php
$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [
			'header_hide_trigger' => [
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
			'mobile_menu_trigger_type' => [
				'label' => false,
				'type' => 'rt-image-picker',
				'value' => 'type-1',
				'attr' => [
					'data-columns' => '3',
					'data-ratio' => '2:1',
				],
				'setting' => ['transport' => 'postMessage'],
				'choices' => [

					'type-1' => [
						'src'   => rishi__cb_customizer_image_picker_file('trigger-1'),
						'title' => __('Type 1', 'rishi'),
					],

					'type-2' => [
						'src'   => rishi__cb_customizer_image_picker_file('trigger-2'),
						'title' => __('Type 2', 'rishi'),
					],

					'type-3' => [
						'src'   => rishi__cb_customizer_image_picker_file('trigger-3'),
						'title' => __('Type 3', 'rishi'),
					],
				],
			],

			'trigger_design' => [
				'type' => 'rt-radio',
				'label' => __('Trigger Design', 'rishi'),
				'value' => 'simple',
				'view' => 'text',
				'design' => 'block',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],

				'choices' => [
					'simple' => __('Simple', 'rishi'),
					'outline' => __('Outline', 'rishi'),
					'solid' => __('Solid', 'rishi'),
				],
			],

			'has_trigger_label' => [
				'label' => __('Trigger Label', 'rishi'),
				'type' => 'rara-switch',
				'value' => 'no',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['has_trigger_label' => 'yes'],
				'options' => [

					'trigger_label' => [
						'label' => __('Label Text', 'rishi'),
						'type' => 'text',
						'design' => 'inline',
						'value' => __('Menu', 'rishi'),
						'setting' => ['transport' => 'postMessage'],
					],

					'trigger_label_alignment' => [
						'type' => 'rt-radio',
						'label' => __('Label Alignment', 'rishi'),
						'value' => 'right',
						'view' => 'text',
						'design' => 'block',
						'setting' => ['transport' => 'postMessage'],

						'choices' => [
							'left' => __('Left', 'rishi'),
							'right' => __('Right', 'rishi'),
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
				'label' => __('Trigger Color', 'rishi'),
				'choices' => [
					[
						'id' => 'triggerIconColor',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentTriggerIconColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyTriggerIconColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'triggerIconColor' => [
						'label' => __('Trigger Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => 'var(--paletteColor3)',
							],

							'hover' => [
								'color' => 'var(--paletteColor4)',
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

					'transparentTriggerIconColor' => [
						'label' => __('Trigger Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => 'var(--paletteColor3)',
							],

							'hover' => [
								'color' => 'var(--paletteColor4)',
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

					'stickyTriggerIconColor' => [
						'label' => __('Trigger Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => 'var(--paletteColor3)',
							],

							'hover' => [
								'color' =>  'var(--paletteColor4)',
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

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => [
					__('Border Color', 'rishi') => [
						'trigger_design' => 'outline'
					],

					__('Background Color', 'rishi') => [
						'trigger_design' => 'solid'
					]
				],
				'divider' => 'top',
				'choices' => [
					[
						'id' => 'triggerSecondColor',
						'label' => __('Default State', 'rishi'),
						'condition' => ['trigger_design' => '!simple'],
					],

					[
						'id' => 'transparentTriggerSecondColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'trigger_design' => '!simple',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyTriggerSecondColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'trigger_design' => '!simple',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'triggerSecondColor' => [
						'label' => __('Trigger Border Color', 'rishi'),
						'label' => [
							__('Border Color', 'rishi') => [
								'trigger_design' => 'outline'
							],

							__('Background Color', 'rishi') => [
								'trigger_design' => 'solid'
							]
						],
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' =>  'var(--paletteColor6)',
							],

							'hover' => [
								'color' =>  'var(--paletteColor6)',
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

					'transparentTriggerSecondColor' => [
						'label' => __('Trigger Border Color', 'rishi'),
						'label' => [
							__('Border Color', 'rishi') => [
								'trigger_design' => 'outline'
							],

							__('Background Color', 'rishi') => [
								'trigger_design' => 'solid'
							]
						],
						'type'  => 'rt-color-picker',
						'design' => 'inline',
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

					'stickyTriggerSecondColor' => [
						'label' => __('Trigger Border Color', 'rishi'),
						'label' => [
							__('Border Color', 'rishi') => [
								'trigger_design' => 'outline'
							],

							__('Background Color', 'rishi') => [
								'trigger_design' => 'solid'
							]
						],
						'type'  => 'rt-color-picker',
						'design' => 'inline',
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
			
			'trigger_typo' => [
				'type'  => 'rt-typography',
				'label' => __('Trigger Label Typography', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'family'    => 'Default',
					'size'      => '18px',
					'variation' => 'n4',
				]),
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'triggerMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true,
			],

		],
	],
];
