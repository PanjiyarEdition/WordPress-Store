<?php

$prefix = 'single_blog_post_';

$options = [
		$prefix . 'social_sharing_panel' => [
		'label'         => __('Social Sharing', 'rishi'),
		'type'          => 'rt-panel',
		'switch'	    => true,
		'value'         => 'yes',
		'wrapperAttr'   => ['data-panel' => 'only-arrow'],
		'inner-options' => [
			apply_filters(
				'rishi__cb_customizer_social_share_end_customizer_options',
				[]
			),
			rishi__cb_customizer_rand_md5() => [
				'title' => __('General', 'rishi'),
				'type' => 'tab',
				'options' => [

					$prefix . 'has_share_box_title' => [
						'label' => __( 'Title', 'rishi' ),
						'type' => 'rara-switch',
						'value' => 'no',
					],
		
					rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [ $prefix . 'has_share_box_title' => 'yes' ],
						'options' => [
							$prefix . 'share_box_title' => [
								'label' => false,
								'type' => 'text',
								'design' => 'block',
								'value' => __( 'SHARE THIS POST', 'rishi' ),
								'disableRevertButton' => true,
								'sync' => [
									'selector' => '.cb__share-box .rt-module-title',
									'render' => function() { 
										echo rishi_companion_title();
									}
								],
							],
						],
					],

					'ed_og_tags' => [
						'label'   => __('Open Graph Meta Tags', 'rishi'),
						'desc'   => __('Disable this option if you’re using Jetpack, Yoast or other plugins to maintain Open Graph Meta Tags', 'rishi'),
						'type'    => 'rara-switch',
						'value'   => 'yes',
					],

					$prefix . 'box_sticky' => [
						'label'   => __('Sticky Share', 'rishi'),
						'type'    => 'rara-switch',
						'value'   => 'no',
					],
					rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [ $prefix . 'box_sticky' => 'yes'],
						'options'   => [
							$prefix . 'box_float' => [
								'label'  => __( 'Float', 'rishi' ),
								'type'    => 'rt-radio',
								'value'   => 'left',
								'view'    => 'text',
								'attr'    => ['data-type' => 'boxfloat'],
								'choices' => [
									'left' => __( 'Left', 'rishi' ),
									'right' => __( 'Right', 'rishi' ),
								],
							],
						],
					],

					rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [ $prefix . 'box_sticky' => 'yes'],
						'options'   => [
							$prefix . 'sticky_top_offset' => [
								'label' => __( 'Top Offset', 'rishi' ),
								'type' => 'rt-slider',
								'units' => rishi__cb_customizer_units_config([
									[
										'unit' => 'px',
										'min' => 5,
										'max' => 500,
									],
								]),
								'value' => '170px',
								'responsive' => true,
								'setting' => [ 'transport' => 'postMessage' ],
								'divider' => 'bottom:full',
							],	
						],
					],

					rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [ $prefix . 'box_sticky' => 'yes'],
						'options'   => [
							$prefix . 'sticky_side_offset' => [
								'label' => __( 'Side Offset', 'rishi' ),
								'type' => 'rt-slider',
								'units' => rishi__cb_customizer_units_config([
									[
										'unit' => 'px',
										'min' => 5,
										'max' => 100,
									],
								]),
								'value' => '0',
								'responsive' => true,
								'divider' => 'bottom:full',
								'setting' => [ 'transport' => 'postMessage' ],
							],	
						],
					],

					rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [ $prefix . 'box_sticky' => '!yes'],
						'options'   => [
							$prefix . 'box_location' => [
								'label'  => __( 'Location', 'rishi' ),
								'type'   => 'rt-checkboxes',
								'design' => 'block',
								'view'   => 'text',
								'value' => [
									'top' => true,
									'bottom' => false,
								],
				
								'divider' => 'top:bottom',
				
								'choices' => rishi__cb_customizer_ordered_keys([
									'top' => __( 'Top', 'rishi' ),
									'bottom' => __( 'Bottom', 'rishi' ),
								]),
							],
						],
					],

					rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [ $prefix . 'box_sticky' => '!yes'],
						'options'   => [
							$prefix . 'share_alignment' => [
								'type'       => 'rt-radio',
								'label'      => __('Alignment', 'rishi'),
								'value'      => 'left',
								'view'       => 'text',
								'attr'       => ['data-type' => 'alignment'],
								'responsive' => false,
								'design'     => 'block',
								'sync' => 'live',
								'choices' => [
									'left' => '',
									'center' => '',
									'right' => '',
								],
							],	
						],
					],	

					$prefix . 'box_shape' => [
						'label'  => __( 'Shape', 'rishi' ),
						'type'    => 'rt-radio',
						'value'   => 'square',
						'view'    => 'text',
						'attr'    => ['data-type' => 'boxshape'],
						'sync'    => "live",
						'choices' => [
							'square' => __( 'Square', 'rishi' ),
							'circle' => __( 'Circle', 'rishi' ),
						],
					],

				rishi__cb_customizer_rand_md5() => [
					'label'   => __('Social Networks', 'rishi'),
					'type'    => 'rt-title',
				],
			
				$prefix . 'share_facebook' => [
					'label' => __( 'Facebook', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'yes',
				],
	
				$prefix . 'share_twitter' => [
					'label' => __( 'Twitter', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'yes',
				],
	
				$prefix . 'share_pinterest' => [
					'label' => __( 'Pinterest', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'yes',
				],
	
				$prefix . 'share_linkedin' => [
					'label' => __( 'LinkedIn', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'yes',
				],
				$prefix . 'share_email' => [
					'label' => __( 'Email', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'true',
				],
	
				$prefix . 'share_reddit' => [
					'label' => __( 'Reddit', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no',
				],

				$prefix . 'share_telegram' => [
					'label' => __( 'Telegram', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no',
				],

				$prefix . 'share_viber' => [
					'label' => __( 'Viber', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no',
				],

				$prefix . 'share_whatsapp' => [
					'label' => __( 'WhatsApp', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_vk' => [
					'label' => __( 'VKontakte', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_tumblr' => [
					'label' => __( 'Tumblr', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_getpocket' => [
					'label' => __( 'GetPocket', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_evernote' => [
					'label' => __( 'Evernote', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],
	
				$prefix . 'share_hacker_news' => [
					'label' => __( 'Hacker News', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_flipboard' => [
					'label' => __( 'Flipboard', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_weibo' => [
					'label' => __( 'Weibo', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_ok' => [
					'label' => __( 'Odnoklassniki', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],
				
				$prefix . 'share_xing' => [
					'label' => __( 'Xing', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_threema' => [
					'label' => __( 'Threema', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_skype' => [
					'label' => __( 'Skype', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],

				$prefix . 'share_line' => [
					'label' => __( 'Line', 'rishi' ),
					'type' => 'rara-switch',
					'value' => 'no'
				],
				rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-divider',
				],
	
				$prefix . 'share_links_nofollow' => [
					'type'  => 'rara-switch',
					'label' => __( 'Set links to nofollow', 'rishi' ),
					'value' => 'yes',
				],

				$prefix . 'share_box_icon_size' => [
					'label' => __( 'Icon Size', 'rishi' ),
					'type' => 'rt-slider',
					'units' => rishi__cb_customizer_units_config([
						[
							'unit' => 'px',
							'min' => 5,
							'max' => 50,
						],
					]),
					'value' => '15px',
					'responsive' => true,
					'divider' => 'bottom:full',
					'setting' => [ 'transport' => 'postMessage' ],
				],

				$prefix . 'icons_spacing' => [
					'label' => __( 'Icons Spacing', 'rishi' ),
					'type'    => 'rt-spacing',
					'divider' => 'top',
					'value'   => rishi__cb_customizer_spacing_value([
						'linked' => false,
						'top'    => '0',
						'left'   => '0',
						'right'  => '10px',
						'bottom' => '10px',
					]),
					'responsive' => true,
					'sync'       => 'live',
				],

				rishi__cb_customizer_rand_md5() => [
					'type'      => 'rt-condition',
					'condition' => [ $prefix . 'box_location/top' => 'true'],
					'options'   => [
						$prefix . 'top_share_box_spacing' => [
							'label' => __( 'Vertical Spacing', 'rishi' ),
							'type' => 'rt-slider',
							'units' => rishi__cb_customizer_units_config([
								[
									'unit' => 'px',
									'min' => 0,
									'max' => 100,
								],
							]),
							'value' => '10px',
							'responsive' => true,
							'divider' => 'bottom:full',
							'setting' => [ 'transport' => 'postMessage' ],
						],
					],
				],

				rishi__cb_customizer_rand_md5() => [
					'type'      => 'rt-condition',
					'condition' => [ $prefix . 'box_location/bottom' => 'true'],
					'options'   => [
						$prefix . 'bottom_share_box_spacing' => [
							'label' => __( 'Bottom Spacing', 'rishi' ),
							'type' => 'rt-slider',
							'units' => rishi__cb_customizer_units_config([
								[
									'unit' => 'px',
									'min' => 0,
									'max' => 100,
								],
							]),
							'value' => '10px',
							'responsive' => true,
							'divider' => 'bottom:full',
							'setting' => [ 'transport' => 'postMessage' ],
						],
					],
				],

				

				$prefix . 'visibility' => [
					'label'  => __( 'Visibility', 'rishi' ),
					'type'   => 'rt-visibility',
					'design' => 'block',
					'sync'   => 'live',
	
					'value' => [
						'desktop' => true,
						'tablet' => true,
						'mobile' => false,
					],
	
					'choices' => rishi__cb_customizer_ordered_keys([
						'desktop' => __( 'Desktop', 'rishi' ),
						'tablet' => __( 'Tablet', 'rishi' ),
						'mobile' => __( 'Mobile', 'rishi' ),
					]),
				],
				],
			],

			rishi__cb_customizer_rand_md5() => [
				'title' => __('Design', 'rishi'),
				'type' => 'tab',
				'options' => [
					rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [ $prefix . 'has_share_box_title' => 'yes' ],
						'options' => [
							$prefix . 'title_color' => [
								'label'           => __( 'Title Color', 'rishi' ),
								'type'            => 'rt-color-picker',
								'skipEditPalette' => true,
								'design'          => 'inline',
								'setting'         => ['transport' => 'postMessage'],
								'value'           => [
									'default' => [
										'color' => 'var(--paletteColor1)',
									],
								],
								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id'    => 'default',
									],
								],
							],
						],
					],

					rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [ $prefix . 'has_share_box_title' => 'yes' ],
						'options' => [
							$prefix .'title_typo' => [
								'type'  => 'rt-typography',
								'label' => __('Title Typography', 'rishi'),
								'value' => rishi__cb_customizer_typography_default_values([
									'size'      => '14px',
									'variation' => 'n5',
								]),
								'setting' => ['transport' => 'postMessage'],
							],
						],
					],
					
					'social_share_color_option' => [
						'label'  => __( 'Icon Color', 'rishi' ),
						'type'    => 'rt-radio',
						'value'   => 'brand',
						'view'    => 'text',
						'attr'    => ['data-type' => 'boxshape'],
						// 'sync'    => "live",
						'choices' => [
							'brand' => __( 'Brand', 'rishi' ),
							'custom' => __( 'Custom', 'rishi' ),
						],
					],
					rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => ['social_share_color_option' => 'custom'],
						'options'   => [

							$prefix . 'share_items_icon_color' => [
								'label' => __( 'Icons Color', 'rishi' ),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'sync' => 'live',
		
								'value' => [
									'default' => [
										'color' => 'var(--paletteColor5)',
									],
		
									'hover' => [
										'color' => 'var(--paletteColor5)',
									],
								],
		
								'pickers' => [
									[
										'title' => __( 'Initial', 'rishi' ),
										'id' => 'default',
									],
		
									[
										'title' => __( 'Hover', 'rishi' ),
										'id' => 'hover',
									],
								],
							],
		
							$prefix . 'share_items_background' => [
								'label' => __( 'Background Color', 'rishi' ),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'sync' => 'live',
		
								'value' => [
									'default' => [
										'color' => 'var(--paletteColor3)',
									],
		
									'hover' => [
										'color' => 'var(--paletteColor4)',
									],
								],
		
								'pickers' => [
									[
										'title' => __( 'Initial', 'rishi' ),
										'id' => 'default',
									],
		
									[
										'title' => __( 'Hover', 'rishi' ),
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
];
