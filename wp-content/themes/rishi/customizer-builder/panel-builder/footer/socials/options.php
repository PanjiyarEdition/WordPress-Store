<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [
			'footer_hide_social' => [
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
			'footer_socials' => [
				'label' => false,
				'type' => 'rt-layers',
				'manageable' => true,
				'desc' => sprintf(
					// translators: placeholder here means the actual URL.
					__('You can configure social URLs %1$shere%2$s.', 'rishi'),
					sprintf(
						'<a href="%s" data-trigger-section="social_accounts">',
						admin_url('/customize.php?autofocus[section]=social_accounts')
					),
					'</a>'
				),
				'divider' => 'bottom',
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

				'settings' => rishi__cb_customizer_get_social_networks_list()
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

			'footerSocialsColor' => [
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

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footerSocialsAlignment' => [
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

			'footerSocialsVerticalAlignment' => [
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

			'footer_socials_visibility' => [
				'label' => __('Element Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'divider' => 'top',
				// 'allow_empty' => true,
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

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['footerSocialsColor' => 'custom'],
				'options' => [

					'footerSocialsIconColor' => [
						'label' => __('Icons Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'divider' => 'bottom',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor5)',
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

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['socialsType' => '!simple'],
				'options' => [

					'footerSocialsIconBackground' => [
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
						'divider' => 'bottom',
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

				],
			],

			'footerSocialsMargin' => [
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
