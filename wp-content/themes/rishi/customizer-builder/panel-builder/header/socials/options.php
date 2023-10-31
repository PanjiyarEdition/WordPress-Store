<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [
			'header_hide_social' => [
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
			'header_socials' => [
				'label' => false,
				'type' => 'rt-layers',
				'manageable' => true,
				'desc' => sprintf(
					// translators: placeholder here means the actual URL.
					__('You can add links to your social media profiles %1$shere%2$s.', 'rishi'),
					sprintf(
						'<a href="%s" data-trigger-section="social_accounts">',
						admin_url('/customize.php?autofocus[section]=social_accounts')
					),
					'</a>'
				),
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					[
						'id' => 'facebook',
						'enabled' => true,
					],

					[
						'id' => 'twitter',
						'enabled' => true,
					],

					[
						'id' => 'instagram',
						'enabled' => true,
					],
				],

				'settings' => rishi__cb_customizer_get_social_networks_list(),
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'socialsIconSize' => [
				'label' => __('Icons Size', 'rishi'),
				'type' => 'rt-slider',
				'min' => 5,
				'max' => 50,
				'value' => 15,
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
			],

			'socialsIconSpacing' => [
				'label' => __('Icons Spacing', 'rishi'),
				'type' => 'rt-slider',
				'min' => 0,
				'max' => 50,
				'value' => 15,
				'responsive' => true,
				'divider' => 'bottom',
				'setting' => ['transport' => 'postMessage'],
			],

			'headerSocialsColor' => [
				'label' => __('Icons Color', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'custom',
				'view' => 'text',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'custom' => __('Custom', 'rishi'),
					'official' => __('Official', 'rishi'),
				],
			],

			'socialsType' => [
				'label' => __('Icons Shape Type', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'simple',
				'view' => 'text',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'simple' => __('None', 'rishi'),
					'rounded' => __('Rounded', 'rishi'),
					'square' => __('Square', 'rishi'),
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['socialsType' => '!simple'],
				'options' => [

					'socialsFillType' => [
						'label' => __('Shape Fill Type', 'rishi'),
						'type' => 'rt-radio',
						'value' => 'solid',
						'view' => 'text',
						'design' => 'block',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'solid' => __('Solid', 'rishi'),
							'outline' => __('Outline', 'rishi'),
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

					'visibility' => [
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

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'socialsLabelVisibility' => [
				'label' => __('Label Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'allow_empty' => true,
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'desktop' => false,
					'tablet' => false,
					'mobile' => false,
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

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Icons Color', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerSocialsIconColor',
						'label' => __('Default State', 'rishi'),
						'condition' => ['headerSocialsColor' => 'custom'],
					],

					[
						'id' => 'transparentHeaderSocialsIconColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'headerSocialsColor' => 'custom',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderSocialsIconColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'headerSocialsColor' => 'custom',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerSocialsIconColor' => [
						'label' => __('Icons Color', 'rishi'),
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

					'transparentHeaderSocialsIconColor' => [
						'label' => __('Icons Color', 'rishi'),
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

					'stickyHeaderSocialsIconColor' => [
						'label' => __('Icons Color', 'rishi'),
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

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['socialsType' => '!simple'],
				'options' => [
				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => [
					__('Icons Background Color', 'rishi') => [
						'socialsFillType' => 'solid'
					],

					__('Icons Border Color', 'rishi') => [
						'socialsFillType' => 'outline'
					]
				],
				'responsive' => true,
				'choices' => [
					[
						'id' => 'headerSocialsIconBackground',
						'label' => __('Default State', 'rishi'),
						'condition' => [
							'headerSocialsColor' => 'custom',
							'socialsType' => '!simple'
						],
					],

					[
						'id' => 'transparentHeaderSocialsIconBackground',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'headerSocialsColor' => 'custom',
							'socialsType' => '!simple',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyHeaderSocialsIconBackground',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'headerSocialsColor' => 'custom',
							'socialsType' => '!simple',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'headerSocialsIconBackground' => [
						'label' => [
							__('Icons Background Color', 'rishi') => [
								'socialsFillType' => 'solid'
							],

							__('Icons Border Color', 'rishi') => [
								'socialsFillType' => 'outline'
							]
						],
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor7)',
							],

							'hover' => [
								'color' => 'var(--paletteColor6)',
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

					'transparentHeaderSocialsIconBackground' => [
						'label' => [
							__('Icons Background Color', 'rishi') => [
								'socialsFillType' => 'solid'
							],

							__('Icons Border Color', 'rishi') => [
								'socialsFillType' => 'outline'
							]
						],
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

					'stickyHeaderSocialsIconBackground' => [
						'label' => [
							__('Icons Background Color', 'rishi') => [
								'socialsFillType' => 'solid'
							],

							__('Icons Border Color', 'rishi') => [
								'socialsFillType' => 'outline'
							]
						],
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


		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'headerSocialsMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true
			],

		],
	],

];
