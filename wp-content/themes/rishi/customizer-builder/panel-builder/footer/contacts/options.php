<?php

$sync_id = 'header_placements_item:contacts';

if (isset($panel_type) && $panel_type === 'footer') {
	$sync_id = 'footer_placements_item:contacts';
}

if (! isset($panel_type)) {
	$panel_type = 'header';
}

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __( 'General', 'rishi' ),
		'type' => 'tab',
		'options' => [
			'footer_hide_contacts' => [
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
			'contact_items' => [
				'label' => false,
				'type' => 'rt-layers',
				'manageable' => true,
				'sync' => [
					'id' => $sync_id
				],
				'value' => [

					[
						'id' => 'email',
						'enabled' => true,
						'title' => __('Email:', 'rishi'),
						'content' => 'contact@yourwebsite.com',
						'link' => 'mailto:contact@yourwebsite.com',
					],

					[
						'id' => 'phone',
						'enabled' => true,
						'title' => __('Phone:', 'rishi'),
						'content' => '123-456-7890',
						'link' => 'tel:123-456-7890',
					],

				],

				'settings' => [
					'address' => [
						'label' => __( 'Address', 'rishi' ),
						'options' => [
							'title' => [
								'type' => 'text',
								'label' => __('Title', 'rishi'),
								'value' => __('Address:', 'rishi'),
								'design' => 'inline',
							],

							'content' => [
								'type' => 'text',
								'label' => __('Content', 'rishi'),
								'value' => 'Street Name, NY 48734',
								'design' => 'inline',
							],

							'link' => [
								'type' => 'text',
								'label' => __('Link (optional)', 'rishi'),
								'design' => 'inline',
							]
						]
					],

					'phone' => [
						'label' => __( 'Phone', 'rishi' ),
						'options' => [

							'title' => [
								'type' => 'text',
								'label' => __('Title', 'rishi'),
								'value' => __('Phone:', 'rishi'),
								'design' => 'inline',
							],

							'content' => [
								'type' => 'text',
								'label' => __('Content', 'rishi'),
								'value' => '123-456-7890',
								'design' => 'inline',
							],

							'link' => [
								'type' => 'text',
								'label' => __('Link (optional)', 'rishi'),
								'value' => 'tel:123-456-7890',
								'design' => 'inline',
							]

						]
					],

					'mobile' => [
						'label' => __( 'Mobile', 'rishi' ),
						'options' => [
							'title' => [
								'type' => 'text',
								'label' => __('Title', 'rishi'),
								'value' => __('Mobile:', 'rishi'),
								'design' => 'inline',
							],

							'content' => [
								'type' => 'text',
								'label' => __('Content', 'rishi'),
								'value' => '123-456-7890',
								'design' => 'inline',
							],

							'link' => [
								'type' => 'text',
								'label' => __('Link (optional)', 'rishi'),
								'value' => 'tel:123-456-7890',
								'design' => 'inline',
							],

						]
					],

					'hours' => [
						'label' => __( 'Work Hours', 'rishi' ),
						'options' => [
							'title' => [
								'type' => 'text',
								'label' => __('Title', 'rishi'),
								'value' => __('Opening hours', 'rishi'),
								'design' => 'inline',
							],

							'content' => [
								'type' => 'text',
								'label' => __('Content', 'rishi'),
								'value' => '9AM - 5PM',
								'design' => 'inline',
							],

							'link' => [
								'type' => 'text',
								'label' => __('Link (optional)', 'rishi'),
								'value' => '',
								'design' => 'inline',
							],

						]
					],

					'fax' => [
						'label' => __( 'Fax', 'rishi' ),
						'options' => [
							'title' => [
								'type' => 'text',
								'label' => __('Title', 'rishi'),
								'value' => __('Fax:', 'rishi'),
								'design' => 'inline',
							],

							'content' => [
								'type' => 'text',
								'label' => __('Content', 'rishi'),
								'value' => '123-456-7890',
								'design' => 'inline',
							],

							'link' => [
								'type' => 'text',
								'label' => __('Link (optional)', 'rishi'),
								'value' => 'tel:123-456-7890',
								'design' => 'inline',
							],

						]
					],

					'email' => [
						'label' => __( 'Email', 'rishi' ),
						'options' => [
							'title' => [
								'type' => 'text',
								'label' => __('Title', 'rishi'),
								'value' => __('Email:', 'rishi'),
								'design' => 'inline',
							],

							'content' => [
								'type' => 'text',
								'label' => __('Content', 'rishi'),
								'value' => 'contact@yourwebsite.com',
								'design' => 'inline',
							],

							'link' => [
								'type' => 'text',
								'label' => __('Link (optional)', 'rishi'),
								'value' => 'mailto:contact@yourwebsite.com',
								'design' => 'inline',
							],

						]
					],

					'website' => [
						'label' => __( 'Website', 'rishi' ),
						'options' => [
							'title' => [
								'type' => 'text',
								'label' => __('Title', 'rishi'),
								'value' => __('Website:', 'rishi'),
								'design' => 'inline',
							],

							'content' => [
								'type' => 'text',
								'label' => __('Content', 'rishi'),
								'value' => 'yourwebsite.com',
								'design' => 'inline',
							],

							'link' => [
								'type' => 'text',
								'label' => __('Link (optional)', 'rishi'),
								'value' => 'https://yourwebsite.com',
								'design' => 'inline',
							],

						]
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'link_target' => [
				'type'  => 'rara-switch',
				'label' => __( 'Open Links In New Tab', 'rishi' ),
				'value' => 'no',
				'disableRevertButton' => true,
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'contacts_icon_size' => [
				'label' => __( 'Icons Size', 'rishi' ),
				'type' => 'rt-slider',
				'min' => 5,
				'max' => 50,
				'value' => 15,
				'responsive' => true,
				'setting' => [ 'transport' => 'postMessage' ],
			],

			'contacts_spacing' => [
				'label' => __( 'Items Spacing', 'rishi' ),
				'type' => 'rt-slider',
				'min' => 0,
				'max' => 50,
				'value' => 15,
				'responsive' => true,
				'divider' => 'bottom',
				'setting' => [ 'transport' => 'postMessage' ],
			],

			'contacts_icon_shape' => [
				'label' => __('Icons Shape Type', 'rishi'),
				'type' => 'rt-radio',
				'value' => 'rounded',
				'view' => 'text',
				'design' => 'block',
				'setting' => [ 'transport' => 'postMessage' ],
				'choices' => [
					'simple' => __( 'None', 'rishi' ),
					'rounded' => __( 'Rounded', 'rishi' ),
					'square' => __( 'Square', 'rishi' ),
				],
				'sync' => 'live',
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [ 'contacts_icon_shape' => '!simple' ],
				'options' => [

					'contacts_icon_fill_type' => [
						'label' => __('Shape Fill Type', 'rishi'),
						'type' => 'rt-radio',
						'value' => 'solid',
						'view' => 'text',
						'design' => 'block',
						'sync' => 'live',
						'choices' => [
							'solid' => __( 'Solid', 'rishi' ),
							'outline' => __( 'Outline', 'rishi' ),
						],
					],

				],
			],

		],
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __( 'Design', 'rishi' ),
		'type' => 'tab',
		'options' => [

			'contacts_font' => [
				'type' => 'rt-typography',
				'label' => __( 'Font', 'rishi' ),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => '14px',
					'line-height' => '1.3',
				]),
				'setting' => [ 'transport' => 'postMessage' ],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __( 'Font Color', 'rishi' ),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'contacts_font_color',
						'label' => __('Default State', 'rishi')
					]
				],
				'options' => [

					'contacts_font_color' => [
						'label' => __( 'Font Color', 'rishi' ),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'divider' => 'bottom',
						'responsive' => true,
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor5)',
							],

							'link_initial' => [
								'color' => 'var(--paletteColor5)',
							],

							'link_hover' => [
								'color' => 'var(--paletteColor3)',
							],
						],

						'pickers' => [
							[
								'title' => __( 'Text Initial', 'rishi' ),
								'id' => 'default',
								'inherit' => 'var(--color)'
							],

							[
								'title' => __( 'Link Initial', 'rishi' ),
								'id' => 'link_initial',
								'inherit' => 'var(--linkInitialColor)'
							],

							[
								'title' => __( 'Link Hover', 'rishi' ),
								'id' => 'link_hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'builderSettings/has_transparent_header' => 'yes',
					'builderSettings/has_sticky_header' => 'yes',
					'row' => '!offcanvas',
				],
				'options' => [
				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => __( 'Icons Color', 'rishi' ),
				'responsive' => true,
				'choices' => [
					[
						'id' => 'contacts_icon_color',
						'label' => __('Default State', 'rishi')
					],
				],
				'options' => [

					'contacts_icon_color' => [
						'label' => __( 'Icons Color', 'rishi' ),
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'setting' => [ 'transport' => 'postMessage' ],

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
								'title' => __( 'Initial', 'rishi' ),
								'id' => 'default',
							],

							[
								'title' => __( 'Hover', 'rishi' ),
								'id' => 'hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'builderSettings/has_transparent_header' => 'yes',
					'builderSettings/has_sticky_header' => 'yes',
					'row' => '!offcanvas',
				],
				'options' => [
				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],
				],
			],


		 rishi__cb_customizer_rand_md5() => [
				'type' => 'cb__labeled-group',
				'label' => [
					__('Icons Background Color', 'rishi') => [
						'contacts_icon_fill_type' => 'solid'
					],

					__('Icons Border Color', 'rishi') => [
						'contacts_icon_fill_type' => 'outline'
					]
				],
				'responsive' => true,
				'choices' => [
					[
						'id' => 'contacts_icon_background',
						'label' => __('Default State', 'rishi'),
						'condition' => [
							'contacts_icon_shape' => '!simple'
						],
					],
				],
				'options' => [

					'contacts_icon_background' => [
						'label' => [
							__('Icons Background Color', 'rishi') => [
								'contacts_icon_fill_type' => 'solid'
							],

							__('Icons Border Color', 'rishi') => [
								'contacts_icon_fill_type' => 'outline'
							]
						],
						'type'  => 'rt-color-picker',
						'design' => 'block:right',
						'responsive' => true,
						'divider' => 'top',
						'setting' => [ 'transport' => 'postMessage' ],

						'value' => [
							'default' => [
								'color' => 'var(--paletteColor6)',
							],

							'hover' => [
								'color' => 'rgba(218, 222, 228, 0.7)',
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

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'contacts_margin' => [
				'label' => __( 'Margin', 'rishi' ),
				'type' => 'rt-spacing',
				'setting' => [ 'transport' => 'postMessage' ],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true
			],

		],
	],
];
