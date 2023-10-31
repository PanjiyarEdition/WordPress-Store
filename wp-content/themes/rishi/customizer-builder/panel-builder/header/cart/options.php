<?php

$options = [

 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [
			'header_hide_cart' => [
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

			'mini_cart_type' => [
				'label' => false,
				'type' => 'rt-image-picker',
				'value' => 'type-1',
				'attr' => [
					'data-type' => 'background',
					'data-columns' => '3',
					'data-usage' => 'cacb__icon',
				],
				'divider' => 'bottom',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [

					'type-1' => [
						'src'   => rishi__cb_customizer_image_picker_file('cart-1'),
						'title' => __('Type 1', 'rishi'),
					],

					'type-2' => [
						'src'   => rishi__cb_customizer_image_picker_file('cart-2'),
						'title' => __('Type 2', 'rishi'),
					],

					'type-3' => [
						'src'   => rishi__cb_customizer_image_picker_file('cart-3'),
						'title' => __('Type 3', 'rishi'),
					],
				],
			],

			'cartIconSize' => [
				'label' => __('Icon Size', 'rishi'),
				'type' => 'rt-slider',
				'min' => 5,
				'max' => 50,
				'value' => 15,
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],
			],

			'has_cart_badge' => [
				'label' => __('Icon Badge', 'rishi'),
				'type' => 'rara-switch',
				'value' => 'yes',
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'cart_subtotal_visibility' => [
				'label' => __('Cart Total Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'allow_empty' => true,
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
				'type' => 'cb__labeled-group',
				'label' => __('Text Color', 'rishi'),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'cartHeaderTextColor',
						'label' => __('Default State', 'rishi')
					],

					[
						'id' => 'transparentCartHeaderTextColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyCartHeaderTextColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [
					'cartHeaderTextColor' => [
						'label' => __('Text Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' =>'var(--paletteColor1)',
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

					'transparentCartHeaderTextColor' => [
						'label' => __('Text Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
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

					'stickyCartHeaderTextColor' => [
						'label' => __('Text Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
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
		rishi__cb_customizer_rand_md5() => [
			'type' => 'cb__labeled-group',
			'label' => __('Icon Color', 'rishi'),
			'responsive' => true,
			'choices' => [
				[
					'id' => 'cartHeaderIconColor',
					'label' => __('Default State', 'rishi')
				],

				[
					'id' => 'transparentCartHeaderIconColor',
					'label' => __('Transparent State', 'rishi'),
					'condition' => [
						'row' => '!offcanvas',
						'builderSettings/has_transparent_header' => 'yes',
					],
				],

				[
					'id' => 'stickyCartHeaderIconColor',
					'label' => __('Sticky State', 'rishi'),
					'condition' => [
						'row' => '!offcanvas',
						'builderSettings/has_sticky_header' => 'yes',
					],
				],
			],
			'options' => [
				'cartHeaderIconColor' => [
					'label' => __('Icon Color', 'rishi'),
					'type'  => 'rt-color-picker',
					'design' => 'block:right',
					'responsive' => true,
					'setting' => ['transport' => 'postMessage'],
					'value' => [
						'default' => [
							'color' =>'var(--paletteColor1)',
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

				'transparentCartHeaderIconColor' => [
					'label' => __('Icon Color', 'rishi'),
					'type'  => 'rt-color-picker',
					'design' => 'block:right',
					'responsive' => true,
					'setting' => ['transport' => 'postMessage'],
					'value' => [
						'default' => [
							'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
						],

						'hover' => [
							'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
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

				'stickyCartHeaderIconColor' => [
					'label' => __('Icon Color', 'rishi'),
					'type'  => 'rt-color-picker',
					'design' => 'block:right',
					'responsive' => true,
					'setting' => ['transport' => 'postMessage'],
					'value' => [
						'default' => [
							'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
						],

						'hover' => [
							'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
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
		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __('Badge Color', 'rishi'),
				'responsive' => true,
				'divider' => 'top',
				'choices' => [
					[
						'id' => 'cartBadgeColor',
						'label' => __('Default State', 'rishi'),
						'condition' => [
							'has_cart_badge' => 'yes',
						],
					],

					[
						'id' => 'transparentCartBadgeColor',
						'label' => __('Transparent State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'has_cart_badge' => 'yes',
							'builderSettings/has_transparent_header' => 'yes',
						],
					],

					[
						'id' => 'stickyCartBadgeColor',
						'label' => __('Sticky State', 'rishi'),
						'condition' => [
							'row' => '!offcanvas',
							'has_cart_badge' => 'yes',
							'builderSettings/has_sticky_header' => 'yes',
						],
					],
				],
				'options' => [

					'cartBadgeColor' => [
						'label' => __('Badge Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'background' => [
								'color' => 'var(--paletteColor3)',
							],

							'text' => [
								'color' => 'var(--paletteColor5)',
							],
						],

						'pickers' => [
							[
								'title' => __('Background', 'rishi'),
								'id' => 'background',
							],

							[
								'title' => __('Text', 'rishi'),
								'id' => 'text',
							],
						],
					],

					'transparentCartBadgeColor' => [
						'label' => __('Badge Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'divider' => 'top',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'background' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'text' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Background', 'rishi'),
								'id' => 'background',
							],

							[
								'title' => __('Text', 'rishi'),
								'id' => 'text',
							],
						],
					],

					'stickyCartBadgeColor' => [
						'label' => __('Badge Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'divider' => 'top',
						'responsive' => true,
						'setting' => ['transport' => 'postMessage'],
						'value' => [
							'background' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'text' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title' => __('Background', 'rishi'),
								'id' => 'background',
							],

							[
								'title' => __('Text', 'rishi'),
								'id' => 'text',
							],
						],
					],

				],
			],

			'headerCartMargin' => [
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

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-divider',
	],

	'has_cart_dropdown' => [
		'label' => __('Cart Drawer', 'rishi'),
		'type' => 'rara-switch',
		'value' => 'yes',
		'wrapperAttr' => ['data-label' => 'heading-label'],
		'setting' => ['transport' => 'postMessage'],
	],

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => ['has_cart_dropdown' => 'yes'],
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'title' => __('General', 'rishi'),
				'type' => 'tab',
				'options' => [

					'cart_drawer_type' => [
						'label' => __('Cart Drawer Type', 'rishi'),
						'type' => apply_filters(
							'rishi:header:cart:cart_drawer_type:option',
							'hidden'
						),
						'value' => 'dropdown',
						'divider' => 'bottom',
						'setting' => ['transport' => 'postMessage'],
						'choices' => [
							'dropdown' => [
								'src' => rishi__cb_customizer_image_picker_url('cart-1.svg'),
								'title' => __('Dropdown', 'rishi'),
							],

							'offcanvas' => [
								'src' => rishi__cb_customizer_image_picker_url('cart-2.svg'),
								'title' => __('Off Canvas', 'rishi'),
							],
						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => ['cart_drawer_type' => 'dropdown'],
						'options' => [
							'cartDropdownTopOffset' => [
								'label' => __('Dropdown Top Offset', 'rishi'),
								'type' => 'rt-slider',
								'value' => 15,
								'min' => 0,
								'max' => 50,
								'setting' => ['transport' => 'postMessage'],
							],
						]
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => ['cart_drawer_type' => 'offcanvas'],
						'options' => [

							'cart_panel_position' => [
								'label' => __('Panel Reveal', 'rishi'),
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

							'cart_panel_width' => [
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

							'auto_open_cart' => [
								'label' => __('Open Cart Automatically On', 'rishi'),
								'type' => 'rt-checkboxes',
								'view' => 'text',
								'design' => 'block',
								'divider' => 'top',
								'allow_empty' => true,
								'setting' => ['transport' => 'postMessage'],
								'desc' => __('Automatically open the cart drawer after a product is added to cart.', 'rishi'),
								'value' => [
									'archive' => false,
									'product' => false,
								],
								'choices' => rishi__cb_customizer_ordered_keys([
									'archive' => __('Archive Page', 'rishi'),
									'product' => __('Product Page', 'rishi'),
								]),
							],

						],
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'title' => __('Design', 'rishi'),
				'type' => 'tab',
				'options' => [

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => ['cart_drawer_type' => 'dropdown'],
						'options' => [

							'cartFontColor' => [
								'label' => __('Font Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'setting' => ['transport' => 'postMessage'],
								'value' => [
									'default' => [
										'color' => 'var(--paletteColor1)',
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

							'cartDropDownBackground' => [
								'label' => __('Background Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => 'var(--paletteColor5)',
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => ['cart_drawer_type' => 'offcanvas'],
						'options' => [

							'cart_panel_font_color' => [
								'label' => __('Font Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'responsive' => true,
								'setting' => ['transport' => 'postMessage'],
								'value' => [
									'default' => [
										'color' => 'var(--paletteColor1)',
									],

									'link_initial' => [
										'color' => 'var(--paletteColor1)',
									],

									'link_hover' => [
										'color' => 'var(--paletteColor3)',
									],
								],

								'pickers' => [
									[
										'title' => __('Text Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--color)'
									],

									[
										'title' => __('Link Initial', 'rishi'),
										'id' => 'link_initial',
										'inherit' => 'var(--linkInitialColor)'
									],

									[
										'title' => __('Link Hover', 'rishi'),
										'id' => 'link_hover',
										'inherit' => 'var(--linkHoverColor)'
									],
								],
							],

							'cart_panel_shadow' => [
								'label' => __('Panel Shadow', 'rishi'),
								'type' => 'rt-box-shadow',
								'design' => 'block',
								'divider' => 'top',
								'responsive' => true,
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

							'cart_panel_background' => [
								'label' => __('Panel Background', 'rishi'),
								'type'  => 'rt-background',
								'design' => 'block:right',
								'responsive' => true,
								'divider' => 'top',
								'setting' => ['transport' => 'postMessage'],
								'value' => rishi__cb_customizer_background_default_value([
									'backgroundColor' => [
										'default' => [
											'color' => 'var(--paletteColor5)'
										],
									],
								])
							],

							'cart_panel_backdrop' => [
								'label' => __('Panel Backdrop', 'rishi'),
								'type'  => 'rt-background',
								'design' => 'block:right',
								'responsive' => true,
								'divider' => 'top',
								'setting' => ['transport' => 'postMessage'],
								'value' => rishi__cb_customizer_background_default_value([
									'backgroundColor' => [
										'default' => [
											'color' => 'rgba(18, 21, 25, 0.6)'
										],
									],
								])
							],

							'cart_panel_close_button_color' => [
								'label' => __('Close Icon Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'divider' => 'top',
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => 'rgba(0, 0, 0, 0.5)',
									],

									'hover' => [
										'color' => 'rgba(0, 0, 0, 0.8)',
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

							'cart_panel_close_button_shape_color' => [
								'label' => __('Close Icon Background', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => 'rgba(0, 0, 0, 0)',
									],

									'hover' => [
										'color' => 'rgba(0, 0, 0, 0)',
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

				],
			],

		],
	],


 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => ['wp_customizer_current_view' => 'mobile'],
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'header_cart_visibility' => [
				'label' => __('Item Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'setting' => ['transport' => 'postMessage'],
				'allow_empty' => true,
				'value' => [
					'tablet' => true,
					'mobile' => true,
				],

				'choices' => rishi__cb_customizer_ordered_keys([
					'tablet' => __('Tablet', 'rishi'),
					'mobile' => __('Mobile', 'rishi'),
				]),
			],

		],
	],

];
