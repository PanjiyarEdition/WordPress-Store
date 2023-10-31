<?php
/**
 * Back to top options
 *
 *
 * @license   http: //www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */
$defaults      = rishi__cb__get_layout_defaults();
$colordefaults = rishi__cb__get_color_defaults();
$options = [
	'ed_scroll_to_top' => [
		'label'         => __('Scroll to Top', 'rishi'),
		'type'          => 'rt-panel',
		'switch'        => true,
		'value'         => $defaults['ed_scroll_to_top'],
		'inner-options' => apply_filters( 'rishi__cb_:scroll_to_top:inneroptions', [
		 rishi__cb_customizer_rand_md5() => [
				'title'   => __('General', 'rishi'),
				'type'    => 'tab',
				'options' => [

					'top_button_type' => [
						'label' => false,
						'type'  => 'rt-image-picker',
						'value' => 'type-1',
						'attr'  => [
							'data-type'    => 'background',
							'data-usage'    => 'totop',
							'data-columns' => '3',
						],
						'choices' => [

							'type-1' => [
								'src'   => rishi__cb_customizer_image_picker_file('top-1'),
								'title' => __('Type 1', 'rishi'),
							],

							'type-2' => [
								'src'   => rishi__cb_customizer_image_picker_file('top-2'),
								'title' => __('Type 2', 'rishi'),
							],

							'type-3' => [
								'src'   => rishi__cb_customizer_image_picker_file('top-3'),
								'title' => __('Type 3', 'rishi'),
							],
							'type-4' => [
								'src'   => rishi__cb_customizer_image_picker_file('top-4'),
								'title' => __('Type 4', 'rishi'),
							],
						],
					],

					'top_button_shape' => [
						'label'   => __('Button Shape', 'rishi'),
						'type'    => 'rt-radio',
						'value'   => 'square',
						'view'    => 'text',
						'design'  => 'block',
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'sync'    => "live",
						'choices' => [
							'square' => __('Square', 'rishi'),
							'circle' => __('Circle', 'rishi'),
						],
					],

					'topButtonSize' => [
						'label'      => __('Icon Size', 'rishi'),
						'type'       => 'rt-slider',
						'value' => [
							'desktop' => '14px',
							'tablet' => '14px',
							'mobile' => '14px',
						],
						'units' => rishi__cb_customizer_units_config([
							['unit' => 'px', 'min' => 12, 'max' => 50],
						]),
						'responsive' => true,
						'divider'    => 'top',
						'setting'    => ['transport' => 'postMessage'],
					],

					'topButtonOffset' => [
						'label'      => __('Bottom Offset', 'rishi'),
						'type'       => 'rt-slider',
						'value' => [
							'desktop' => '25px',
							'tablet' => '25px',
							'mobile' => '25px',
						],
						'units' => rishi__cb_customizer_units_config([
							['unit' => 'px', 'min' => 5, 'max' => 300],
						]),
						'responsive' => true,
						'divider'    => 'top',
						'setting'    => ['transport' => 'postMessage'],
					],

					'sideButtonOffset' => [
						'label'      => __('Side Offset', 'rishi'),
						'type'       => 'rt-slider',
						'value' => [
							'desktop' => '25px',
							'tablet' => '25px',
							'mobile' => '25px',
						],
						'units' => rishi__cb_customizer_units_config([
							['unit' => 'px', 'min' => 5, 'max' => 300],
						]),
						'responsive' => true,
						'setting'    => ['transport' => 'postMessage'],
					],

					'top_button_alignment' => [
						'label'   => __('Alignment', 'rishi'),
						'type'    => 'rt-radio',
						'value'   => 'right',
						'setting' => ['transport' => 'postMessage'],
						'sync' 	  => 'live',
						'view'    => 'text',
						'divider' => 'top',
						'attr'    => ['data-type' => 'alignment'],
						'choices' => [
							'left'  => '',
							'right' => '',
						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					'back_top_visibility' => [
						'label'   => __('Visibility', 'rishi'),
						'type'    => 'rt-visibility',
						'design'  => 'block',
						'setting' => ['transport' => 'postMessage'],

						'value' => [
							'desktop' => true,
							'tablet'  => true,
							'mobile'  => false,
						],

						'choices' => rishi__cb_customizer_ordered_keys([
							'desktop' => __('Desktop', 'rishi'),
							'tablet'  => __('Tablet', 'rishi'),
							'mobile'  => __('Mobile', 'rishi'),
						]),
						'sync' => 'live'
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'title'   => __('Design', 'rishi'),
				'type'    => 'tab',
				'options' => [
					'top_button_scroll_style' => [
						'label'   => __('Scroll Button Style', 'rishi'),
						'type'    => 'rt-radio',
						'value'   => 'filled',
						'view'    => 'text',
						'design'  => 'block',
						'divider' => 'bottom',
						'setting' => ['transport' => 'postMessage'],
						'sync'    => 'live',
						'choices' => [
							'filled' => __('Filled', 'rishi'),
							'outline' => __('Outline', 'rishi'),
						],
					],
					'topButtonIconColor' => [
						'label'   => __('Icon Color', 'rishi'),
						'type'    => 'rt-color-picker',
						'design'  => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => $colordefaults['topButtonIconColorDefault'],
							],

							'hover' => [
								'color' => $colordefaults['topButtonIconColorHover'],
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id'    => 'default',
							],

							[
								'title' => __('Hover', 'rishi'),
								'id'    => 'hover',
							],
						],
					],
				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => ['top_button_scroll_style' => 'filled'],
						'options' => [
							'topButtonShapeBackground' => [
								'label'   => __('Shape Background Color', 'rishi'),
								'type'    => 'rt-color-picker',
								'design'  => 'inline',
								'setting' => ['transport' => 'postMessage'],
								'value' => [
									'default' => [
										'color' => $colordefaults['topButtonShapeBackgroundDefault'],
									],

									'hover' => [
										'color' => $colordefaults['topButtonShapeBackgroundHover'],
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id'    => 'default',
									],

									[
										'title' => __('Hover', 'rishi'),
										'id'    => 'hover',
									],
								],
							],
						],
					],


					'topButtonBorderColor' => [
						'label'   => __('Border Color', 'rishi'),
						'type'    => 'rt-color-picker',
						'design'  => 'inline',
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => $colordefaults['topButtonBorderDefaultColor'],
							],

							'hover' => [
								'color' => $colordefaults['topButtonBorderHoverColor'],
							],
						],

						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id'    => 'default',
							],

							[
								'title' => __('Hover', 'rishi'),
								'id'    => 'hover',
							],
						],
					],
					'top_button_border' => [
						'label' => __('Border', 'rishi'),
						'type' => 'rt-slider',
						'value' => 1,
						'min' => 1,
						'max' => 50,
						'sync' => 'live'
					],
				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [ 'top_button_shape' => 'square' ],
						'options' => [
							'top_button_border_radius' => [
								'label' => __('Border Radius', 'rishi'),
								'type' => 'rt-slider',
								'value' => 1,
								'min' => 1,
								'max' => 50,
								'sync' => 'live'
							],
						],
					],

					'top_button_padding' => [
						'label'   => __('Scroll Button Padding', 'rishi'),
						'type'    => 'rt-spacing',
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'value' => rishi__cb_customizer_spacing_value([
							'linked' => true,
							'top'    => '10px',
							'left'   => '10px',
							'right'  => '10px',
							'bottom' => '10px',
						]),
						'responsive' => false
					],

					'topButtonShadow' => [
						'label'      => __('Shadow', 'rishi'),
						'type'       => 'rt-box-shadow',
						'divider'    => 'top',
						'responsive' => true,
						'setting'    => ['transport' => 'postMessage'],
						'value'      => rishi__cb_customizer_box_shadow_value([
							'enable'   => false,
							'h_offset' => 0,
							'v_offset' => 5,
							'blur'     => 20,
							'spread'   => 0,
							'inset'    => false,
							'color'    => [
								'color' => 'rgba(210, 213, 218, 0.2)',
							],
						])
					],

				],
			],

		]),
	],
];
