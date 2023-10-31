<?php

if (!isset($location)) {
	$location = 'Footer Menu';
}

if (!isset($rt_id)) {
	$rt_id = '_one';
}

$options = [
	'footer_hide_menu'.$rt_id => [
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
		'type' => 'rt-divider',
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [

			'footerMenuItemsSpacing' => [
				'label' => __('Items Spacing', 'rishi'),
				'type' => 'rt-slider',
				'value' => 25,
				'min' => 10,
				'max' => 100,
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
			],

			'stretch_menu' => [
				'label' => __('Stretch Menu', 'rishi'),
				'type' => 'rara-switch',
				'value' => 'no',
				'divider' => 'top',
				'desc' => __('Enabling this option will make the menu to stretch and fit the width of its parent column. ', 'rishi'),
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footerMenuAlignment' => [
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

			'footerMenuVerticalAlignment' => [
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

			'footer_menu_visibility' => [
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

			'footerMenuFont' => [
				'type' => 'rt-typography',
				'label' => __('Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => '14px',
					'variation' => 'n4',
					'line-height' => '1.3',
					'text-transform' => 'normal',
					'letter-spacing' => '0.3px'

				]),
				'setting' => ['transport' => 'postMessage'],
			],

			'footerMenuFontColor' => [
				'label' => __('Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
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
						'title' => __('Hover/Active', 'rishi'),
						'id' => 'hover',
						'inherit' => 'var(--linkHoverColor)',
					],
				],
			],

			'footerMenuMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true
			],

		],
	],
];
