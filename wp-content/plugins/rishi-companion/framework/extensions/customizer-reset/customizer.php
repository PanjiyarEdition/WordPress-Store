<?php

$options = [
	'title' 	=> __( 'Customizer Reset', 'rishi-companion' ),
	'container' => [ 'priority' => 8 ],
	'options' 	=> [
		'customizer_reset_section_options' => [
			'type' => 'rt-options',
			'setting' => [ 'transport' => 'postMessage' ],
			'inner-options' => [
				rishi__cb_customizer_rand_md5() => [
					'type' 	=> 'rt-title',
					'label' => __( 'Reset Options', 'rishi-companion' ),
					'desc' 	=> __( 'Click this button if you want to reset all settings to their default values. This action is irreversible.', 'rishi-companion' ),
				],

				'rt-reset-customizer-options' => [
					'label' 	=> false,
					'disableRevertButton' => true,
					'type' 		=> 'rt-customizer-reset-options',
					'value' 	=> ''
				]
			],
		],
	],
];
