<?php

/**
 * Performance options
 *
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$options = [
	'performance_section_options' => [
		'type' => 'rt-options',
		'setting' => ['transport' => 'postMessage'],
		'inner-options' => [
			apply_filters(
				'rishi__cb_customizer_performance_end_customizer_options',
				[]
			),

			[
				'has_lazy_load' => [
					'label' => __('Lazy Load Images', 'rishi'),
					'type' => 'rara-switch',
					'value' => 'yes',
					'setting' => ['transport' => 'postMessage'],
					'desc' => __('This option will be auto disabled if you have JetPack\'s lazy load option enabled.', 'rishi'),
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => ['has_lazy_load' => 'yes'],
					'options' => [

						'lazy_load_type' => [
							'label' => __('Images Loading Animation Type', 'rishi'),
							'type' => 'rt-radio',
							'value' => 'fade',
							'view' => 'text',
							'choices' => [
								'fade' => __('Fade', 'rishi'),
								'circle' => __('Circles', 'rishi'),
								'none' => __('None', 'rishi'),
							],
						],

					],
				],
			],
		],
	],
];
