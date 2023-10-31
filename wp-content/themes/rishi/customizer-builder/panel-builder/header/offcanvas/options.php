<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [

			'offcanvas_behavior' => [
				'label' => __('Reaveal as', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'panel',
				'view' => 'text',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'modal' => __('Modal', 'rishi'),
					'panel' => __('Side Panel', 'rishi'),
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['offcanvas_behavior' => 'panel'],
				'options' => [

					'side_panel_position' => [
						'label' => __('Reveal From', 'rishi'),
						'type' => 'rt-radio',
						'value' => 'right',
						'view' => 'text',
						'design' => 'block',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'left' => __('Left Side', 'rishi'),
							'right' => __('Right Side', 'rishi'),
						],
					],

					'side_panel_width' => [
						'label' => __('Panel Width', 'rishi'),
						'type' => 'rt-slider',
						'value' => [
							'desktop' => '500px',
							'tablet' => '65vw',
							'mobile' => '90vw',
						],
						'units' => rishi__cb_customizer_units_config([
							['unit' => 'px', 'min' => 0, 'max' => 1000],
						]),
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'offcanvas_content_vertical_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Vertical Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'responsive' => true,
				'attr' => ['data-type' => 'vertical-alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'flex-start',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

			'offcanvasContentAlignment' => [
				'type' => 'rt-radio',
				'label' => __('Horizontal Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'divider' => 'top',
				'responsive' => true,
				'attr' => ['data-type' => 'horizontal-alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'flex-start',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

		],
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

			'offcanvasBackground' => [
				'label' => __('Panel Background', 'rishi'),
				'type'  => 'rt-background',
				'design' => 'block:right',
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_background_default_value([
					'backgroundColor' => [
						'default' => [
							'color' => 'var(--paletteColor5)'
						],
					],
				])
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['offcanvas_behavior' => 'panel'],
				'options' => [

					'offcanvasBackdrop' => [
						'label' => __('Panel Backdrop', 'rishi'),
						'type'  => 'rt-background',
						'design' => 'block:right',
						'responsive' => true,
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'value' => rishi__cb_customizer_background_default_value([
							'backgroundColor' => [
								'default' => [
									'color' => 'rgba(255,255,255,0)'
								],
							],
						])
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['offcanvas_behavior' => 'panel'],
				'options' => [

					'headerPanelShadow' => [
						'label' => __('Shadow', 'rishi'),
						'type' => 'rt-box-shadow',
						'design' => 'block',
						'responsive' => true,
						'divider' => 'top',
						'value' => rishi__cb_customizer_box_shadow_value([
							'enable' => true,
							'h_offset' => 0,
							'v_offset' => 0,
							'blur' => 70,
							'spread' => 0,
							'inset' => false,
							'color' => [
								'color' => 'rgba(0, 0, 0, 0.35)',
							],
						])
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'menu_close_button_color' => [
				'label' => __('Close Icon Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],

				'value' => [
					'default' => [
						'color' => 'var(--paletteColor3)',
					],

					'hover' => [
						'color' => 'var(--paletteColor2)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'rgba(255, 255, 255, 0.7)'
					],

					[
						'title' => __('Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => '#ffffff'
					],
				],
			],

			'menu_close_button_shape_color' => [
				'label' => __('Close Icon Background', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'setting' => ['transport' => 'postMessage'],

				'value' => [
					'default' => [
						'color' => 'transparent',
					],

					'hover' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'rgba(0, 0, 0, 0.5)'
					],

					[
						'title' => __('Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => 'rgba(0, 0, 0, 0.5)'
					],
				],
			],

		],
	],

];
