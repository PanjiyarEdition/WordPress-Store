<?php

/**
 * Forms options
 *
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$options = [

	'form_elements_panel' => [
		'label' => __('Form Elements', 'rishi'),
		'type' => 'rt-panel',
		'setting' => ['transport' => 'postMessage'],
		'inner-options' => [

			'forms_type' => [
				'label' => false,
				'type' => 'rt-image-picker',
				'value' => 'classic-forms',
				'setting' => ['transport' => 'postMessage'],
				'switchDeviceOnChange' => 'desktop',
				'choices' => [

					'classic-forms' => [
						'src'   => rishi__cb_customizer_image_picker_url('forms-type-1.svg'),
						'title' => __('Classic', 'rishi'),
					],

					'modern-forms' => [
						'src'   => rishi__cb_customizer_image_picker_url('forms-type-2.svg'),
						'title' => __('Modern', 'rishi'),
					],

				],
			],

			'formTextColor' => [
				'label' => __('Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'default' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],

					'focus' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--color)'
					],

					[
						'title' => __('Focus', 'rishi'),
						'id' => 'focus',
						'inherit' => 'var(--color)'
					],
				],
			],

			'formFontSize' => [
				'label' => __('Font Size', 'rishi'),
				'type' => 'rt-number',
				'design' => 'inline',
				'value' => 15,
				'min' => 5,
				'max' => 50,
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-title',
				'label' => __('Input & Textarea', 'rishi'),
			],

			'formBorderColor' => [
				'label' => __('Border Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'default' => [
						'color' => '#e0e5eb',
					],

					'focus' => [
						'color' => 'var(--paletteColor1)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
					],

					[
						'title' => __('Focus', 'rishi'),
						'id' => 'focus',
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['forms_type' => 'classic-forms'],
				'options' => [

					'formBackgroundColor' => [
						'label' => __('Background Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword(),
							],

							'focus' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword(),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
							],

							[
								'title' => __('Focus', 'rishi'),
								'id' => 'focus',
							],
						],
					],

				],
			],

			'formBorderSize' => [
				'label' => __('Border Size', 'rishi'),
				'type' => 'rt-number',
				'design' => 'inline',
				'value' => 1,
				'min' => 1,
				'max' => 5,
				'setting' => ['transport' => 'postMessage'],
			],

			'formInputHeight' => [
				'label' => __('Input Height', 'rishi'),
				'type' => 'rt-number',
				'design' => 'inline',
				'value' => 40,
				'min' => 20,
				'max' => 80,
				'setting' => ['transport' => 'postMessage'],
			],

			'formTextAreaHeight' => [
				'label' => __('Textarea Height', 'rishi'),
				'type' => 'rt-number',
				'design' => 'inline',
				'value' => 170,
				'min' => 50,
				'max' => 250,
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-title',
				'label' => __('Radio & Checkbox', 'rishi'),
			],

			'radioCheckboxColor' => [
				'label' => __('Colors', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],
				'value' => [
					'default' => [
						'color' => '#d5d8de',
					],

					'accent' => [
						'color' => 'var(--paletteColor1)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
					],

					[
						'title' => __('Active', 'rishi'),
						'id' => 'accent',
					],
				],
			],
		]
	]
];
