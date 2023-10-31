<?php

$options = [
	'has_reveal_effect' => [
		'label'       => __('Enable Reveal Effect on', 'rishi'),
		'type'        => 'rt-visibility',
		'design'      => 'block',
		'allow_empty' => true,
		'desc'        => __('This setting adds a nice reveal effect as you scroll down.', 'rishi'),
		'setting'     => ['transport' => 'postMessage'],
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
		'type' => 'rt-condition',
		'condition' => ['has_reveal_effect:visibility' => 'yes'],
		'options' => [

			'footerShadow' => [
				'label' => __('Shadow', 'rishi'),
				'type' => 'rt-box-shadow',
				'responsive' => true,
				'divider' => 'top',
				'hide_shadow_placement' => true,
				'value' => rishi__cb_customizer_box_shadow_value([
					'enable' => true,
					'h_offset' => 0,
					'v_offset' => 30,
					'blur' => 50,
					'spread' => 0,
					'inset' => false,
					'color' => [
						'color' => 'rgba(0, 0, 0, 0.1)',
					],
				])
			],

		],
	],

];
