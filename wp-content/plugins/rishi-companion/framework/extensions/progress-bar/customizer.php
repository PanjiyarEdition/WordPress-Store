<?php

$options = [
	'title' => __('Reading Progress Bar', 'rishi-companion'),
	'container' => [ 'priority' => 8 ],
	'options' => [

		'reading_progress_bar_section_options' => [
			'type' => 'rt-options',
			'setting' => [ 'transport' => 'postMessage' ],
			'inner-options' => [
				rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-title',
					'label' => __( 'Reading Progress Bar', 'rishi-companion' ),
				],

				rishi__cb_customizer_rand_md5() => [
					'title' => __( 'General', 'rishi-companion' ),
					'type' => 'tab',
					'options' => [
						'progressThickness' => [
                            'label' => __( 'Thickness', 'rishi-companion' ),
                            'type' => 'rt-slider',
                            'value' => 5,
                            'min' => 1,
                            'max' => 30,
                            'setting' => [ 'transport' => 'postMessage' ],
                        ],
						'displayProgress' => [
							'label'   => __('Display Condition', 'rishi-companion'),
							'type'    => 'rt-radio',
							'value'   => 'post',
							'view'    => 'text',
								'choices' => [
									'everywhere' => __('Everywhere', 'rishi-companion'),
									'post'  	 => __('Post', 'rishi-companion'),
									'page'  	 => __('Page', 'rishi-companion'),
								],
						],
						'display_top_bottom' => [
							'label'   => __('Position', 'rishi-companion'),
							'type'    => 'rt-radio',
							'value'   => 'top',
							'view'    => 'text',
								'choices' => [
									'top'   => __('Top', 'rishi-companion'),
									'bottom'  => __('Bottom', 'rishi-companion'),
								],
						],
					],
				],
				rishi__cb_customizer_rand_md5() => [
					'title' => __( 'Design', 'rishi-companion' ),
					'type' => 'tab',
					'options' => [
                        'progressBarColor' => [
							'label' => __( 'Color', 'rishi-companion' ),
							'type'  => 'rt-color-picker',
							'design' => 'inline',
							'setting' => [ 'transport' => 'postMessage' ],
							'value' => [
								'default' => [
									'color' => 'var(--paletteColor5)',
								],

								'progress' => [
									'color' => 'var(--paletteColor3)',
								],
							],

							'pickers' => [
								[
									'title' => __( 'Background Color', 'rishi-companion' ),
									'id' => 'default',
								],

								[
									'title' => __( 'Progress Color', 'rishi-companion' ),
									'id' => 'progress',
								],
							],
						],
					],
				],
			],
		],
	],
];
