<?php

$location = 'Mobile Menu';

$options = [
	'header_hide_mobile_menu' => [
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
	'menu' => [
		'label' => __('Select Menu', 'rishi'),
		'type' => 'rt-select',
		'value' => 'rishi__cb_customizer_location',
		'view' => 'text',
		'design' => 'inline',
		'setting' => ['transport' => 'postMessage'],
		'placeholder' => __('Select menu...', 'rishi'),
		'choices' => rishi__cb_customizer_ordered_keys( rishi__cb_customizer_get_menus_items($location)),
		'desc' => sprintf(
			// translators: placeholder here means the actual URL.
			__('Manage your menus in the %1$sMenus screen%2$s.', 'rishi'),
			sprintf(
				'<a href="%s" target="_blank">',
				admin_url('/nav-menus.php')
			),
			'</a>'
		),
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [

			'mobile_menu_type' => [
				'label' => __('Menu Type', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'type-1',
				'view' => 'text',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'type-1' => __('Default', 'rishi'),
					'type-2' => __('Bordered', 'rishi'),
				],
			],

		],
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

			'mobileMenuFont' => [
				'type' => 'rt-typography',
				'label' => __('Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => [
						'desktop' => '30px',
						'tablet'  => '20px',
						'mobile'  => '16px'
					],
					'variation' => 'n4',
				]),
				'typography_responsive' => [
					'desktop' => true,
					'tablet' => true,
					'mobile' => true,
				],
				'setting' => ['transport' => 'postMessage'],
			],

			'mobileMenuColor' => [
				'label' => __('Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'default' => [
						'color' =>  'var(--paletteColor1)',
					],

					'hover' => [
						'color' =>  'var(--paletteColor3)',
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

			'mobile_menu_child_size' => [
				'label' => __('Dropdown Font Size', 'rishi'),
				'type' => 'rt-slider',
				'value' => '14px',
				'divider' => 'top',
				'units' => [
					['unit' => 'px', 'min' => 0, 'max' => 100],
					['unit' => 'pt', 'min' => 0, 'max' => 500],
					['unit' => 'em', 'min' => 0, 'max' => 100],
					['unit' => 'rem', 'min' => 0, 'max' => 100],
					['unit' => 'vw', 'min' => 0, 'max' => 50],
				],
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['mobile_menu_type' => 'type-2'],
				'options' => [

					'mobile_menu_divider' => [
						'label' => __('Items Divider', 'rishi'),
						'type' => 'rt-border',
						'design' => 'inline',
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'width' => 1,
							'style' => 'solid',
							'color' => [
								'color' =>  'var(--paletteColor6)',
							],
						]
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'mobileMenuMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'left' => 'auto',
					'right' => 'auto',
					'linked' => true,
				]),
				'responsive' => true
			],
			'mobileMenuPadding' => [
				'label' => __('Padding', 'rishi'),
				'type' => 'rt-spacing',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
					'top'    => '5px',
					'left'   => 'auto',
					'bottom' => '5px',
					'right'  => 'auto',
				]),
				'responsive' => true
			],

		],
	],
];
