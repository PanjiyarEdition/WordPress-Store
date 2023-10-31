<?php

/**
 * Page title options
 *
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

if (!isset($has_hero_type)) {
	$has_hero_type = true;
}

if (!isset($enabled_label)) {
	$enabled_label = __('Page Title', 'rishi');
}

if (!isset($enabled_default)) {
	$enabled_default = 'yes';
}

if (!isset($is_cpt)) {
	$is_cpt = false;
}

if (!isset($is_bbpress)) {
	$is_bbpress = false;
}

if (!isset($is_woo)) {
	$is_woo = false;
}

if (!isset($is_page)) {
	$is_page = false;
}

if (!isset($is_author)) {
	$is_author = false;
}

if (!isset($has_default)) {
	$has_default = false;
}

if (!isset($is_home)) {
	$is_home = false;
}

if (!isset($is_single)) {
	$is_single = false;
}

if (!isset($is_search)) {
	$is_search = false;
}

if (!isset($is_archive)) {
	$is_archive = false;
}

if (!isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

$custom_description_layer_name = __('Description', 'rishi');

if ($is_author) {
	$custom_description_layer_name = __('Bio', 'rishi');
}

if (
	($is_single || $is_home) && !$is_bbpress
) {
	$custom_description_layer_name = __('Excerpt', 'rishi');
}

if ($is_search) {
	$custom_description_layer_name = __('Subtitle', 'rishi');
}

$default_hero_elements = [];

$default_hero_elements[] = array_merge([
	'id' => 'custom_title',
	'enabled' => $prefix !== 'product_',
	'heading_tag' => 'h1',
	'title' => __('Home', 'rishi')
], ($is_author ? [
	'has_author_avatar' => 'yes',
	'author_avatar_size' => 60
] : []));

$default_hero_elements[] = [
	'id' => 'custom_description',
	'enabled' => $prefix !== 'product_',
	'description_visibility' => [
		'desktop' => true,
		'tablet' => true,
		'mobile' => false,
	]
];

if (
	($is_single || $is_author) && !$is_bbpress
) {
	$default_hero_elements[] = [
		'id' => 'custom_meta',
		'enabled' => !$is_page && $prefix !== 'product_',
		'meta_elements' => rishi__cb__customizer_post_meta_defaults([
			[
				'id' => 'author',
				'has_author_avatar' => 'yes',
				'enabled' => true,
			],

			[
				'id' => 'post_date',
				'enabled' => true,
			],

			[
				'id' => 'comments',
				'enabled' => true,
			],

			[
				'id' => 'categories',
				'enabled' => !$is_page,
			],
		]),
		'page_meta_elements' => [
			'joined' => true,
			'articles_count' => true,
			'comments' => true
		]
	];
}

if ($is_author) {
	$default_hero_elements[] = [
		'id' => 'author_social_channels',
		'enabled' => true
	];
}

$default_hero_elements[] = [
	'id' => 'breadcrumbs',
	'enabled' => $prefix === 'product_',
];

$when_enabled_general_settings = [
	$has_hero_type ? [
		$prefix . 'hero_section' => [
			'label' => $has_default ? __('Type', 'rishi') : false,
			'type' => 'rt-image-picker',
			'value' => ($is_woo || $is_author) ? 'type-2' : 'type-1',
			'design' => 'block',
			'sync' => rishi__cb_customizer_sync_whole_page([
				'prefix' => $prefix,
			]),
			'choices' => [
				'type-1' => [
					'src' => rishi__cb_customizer_image_picker_url('hero-type-1.svg'),
					'title' => __('Type 1', 'rishi'),
				],

				'type-2' => [
					'src' => rishi__cb_customizer_image_picker_url('hero-type-2.svg'),
					'title' => __('Type 2', 'rishi'),
				],
			],
		],
	] : [
		$prefix . 'hero_section' => [
			'type' => 'hidden',
			'value' => ($is_woo || $is_author) ? 'type-2' : 'type-1',
		]
	],

	[

		$prefix . 'hero_elements' => [
			'label' => __('Elements', 'rishi'),
			'type' => 'rt-layers',
			'attr' => ['data-layers' => 'title-elements'],
			'design' => 'block',
			'value' => $default_hero_elements,

			'sync' => [
				[
					'selector' => '.hero-section',
					'container_inclusive' => true,
					'prefix' => $prefix,
				],

				[
					'prefix' => $prefix,
					'id' => $prefix . 'hero_elements_heading_tag',
					'loader_selector' => '.page-title',
				],

				[
					'prefix' => $prefix,
					'id' => $prefix . 'hero_elements_meta_first',
					'loader_selector' => '.entry-meta:1'
				],

				[
					'prefix' => $prefix,
					'id' => $prefix . 'hero_elements_meta_second',
					'loader_selector' => '.entry-meta:2'
				],

				[
					'prefix' => $prefix,
					'id' => $prefix . 'hero_elements_spacing',
					'loader_selector' => 'skip',
				],

				[
					'prefix' => $prefix,
					'id' => $prefix . 'hero_elements_author_avatar',
					'loader_selector' => '.rt-author-name',
				]
			],

			'settings' => [
				'breadcrumbs' => [
					'label' => __('Breadcrumb', 'rishi'),
					'options' => [
						'hero_item_spacing' => [
							'label' => __('Top Spacing', 'rishi'),
							'type' => 'rt-slider',
							'value' => 20,
							'min' => 0,
							'max' => 100,
							'responsive' => true,
							'sync' => [
								'id' => $prefix . 'hero_elements_spacing',
							],
						],
					],
				],

				'custom_title' => [
					'label' => $is_author ? __('Name & Avatar', 'rishi') : __('Title', 'rishi'),
					'options' => [
						[
							'heading_tag' => [
								'label' => __('Heading tag', 'rishi'),
								'type' => 'rt-select',
								'value' => 'h1',
								'view' => 'text',
								'design' => 'inline',
								'sync' => [
									'id' => $prefix . 'hero_elements_heading_tag',
								],
								'choices' => rishi__cb_customizer_ordered_keys(
									[
										'h1' => 'H1',
										'h2' => 'H2',
										'h3' => 'H3',
										'h4' => 'H4',
										'h5' => 'H5',
										'h6' => 'H6',
									]
								),
							],
						],

						[
							$is_home ? [
							 rishi__cb_customizer_rand_md5() => [
									'type' => 'rt-condition',
									'condition' => ['show_on_front' => 'posts'],
									'values_source' => 'global',
									'options' => [
										'title' => [
											'label' => __('Title', 'rishi'),
											'type' => 'text',
											'value' => __('Home', 'rishi'),
											'disableRevertButton' => true,
											'design' => 'inline',
										],
									]
								],
							] : []
						],

						[
							($is_archive || $is_bbpress) ? [
								'has_category_label' => [
									'label' => __('Category Label', 'rishi'),
									'type' => 'rara-switch',
									'value' => 'yes',
								]
							] : []
						],

						[
							$is_author ? [
							 rishi__cb_customizer_rand_md5() => [
									'type' => 'rt-group',
									'attr' => ['data-columns' => '1'],
									'options' => [
										'has_author_avatar' => [
											'label' => __('Author avatar', 'rishi'),
											'type' => 'rara-switch',
											'value' => 'yes',
											'sync' => [
												'id' => $prefix . 'hero_elements_author_avatar',
											],
										],

									 rishi__cb_customizer_rand_md5() => [
											'type' => 'rt-condition',
											'condition' => ['has_author_avatar' => 'yes'],
											'options' => [
												'author_avatar_size' => [
													'label' => __('Avatar Size', 'rishi'),
													'type' => 'rt-number',
													'design' => 'inline',
													'value' => 60,
													'min' => 15,
													'max' => 100,
													'sync' => [
														'id' => $prefix . 'hero_elements_spacing',
													],
												],
											],
										],

									],
								],
							] : []
						],

						'hero_item_spacing' => [
							'label' => __('Top Spacing', 'rishi'),
							'type' => 'rt-slider',
							'value' => 20,
							'min' => 0,
							'max' => 100,
							'responsive' => true,
							'sync' => [
								'id' => $prefix . 'hero_elements_spacing',
							],
						],
					],
				],

				'custom_description' => [
					'label' => $custom_description_layer_name,
					'options' => [
						[
							$is_home ? [
							 rishi__cb_customizer_rand_md5() => [
									'type' => 'rt-condition',
									'condition' => ['show_on_front' => 'posts'],
									'values_source' => 'global',
									'options' => [
										'description' => [
											'label' => false,
											'type' => 'textarea',
											'value' => '',
											'disableRevertButton' => true,
											'design' => 'block',
										],
									]
								],
							] : []
						],

						'description_visibility' => [
							'label' => __('Visibility', 'rishi'),
							'type' => 'rt-visibility',
							'design' => 'block',

							'value' => [
								'desktop' => true,
								'tablet' => true,
								'mobile' => false,
							],

							'choices' => rishi__cb_customizer_ordered_keys([
								'desktop' => __('Desktop', 'rishi'),
								'tablet' => __('Tablet', 'rishi'),
								'mobile' => __('Mobile', 'rishi'),
							]),

							'sync' => [
								'id' => $prefix . 'hero_elements_spacing',
							],
						],

						'hero_item_spacing' => [
							'label' => __('Top Spacing', 'rishi'),
							'type' => 'rt-slider',
							'value' => 20,
							'min' => 0,
							'max' => 100,
							'responsive' => true,
							'sync' => [
								'id' => $prefix . 'hero_elements_spacing',
							],
						],
					],
				],

				'custom_meta' => [
					'label' => $is_author ? __('Author Meta', 'rishi') : __('Post Meta', 'rishi'),
					'clone' => true,
					'sync' => [
						'id' => $prefix . 'hero_elements_meta'
					],
					'options' => [
						$is_author ? [
							'page_meta_elements' => [
								'label' => __('Meta Elements', 'rishi'),
								'type' => 'rt-checkboxes',
								'design' => 'block',
								'attr' => ['data-columns' => '2'],
								'allow_empty' => true,
								'choices' => rishi__cb_customizer_ordered_keys(
									[
										'joined' => __('Joined Date', 'rishi'),
										'articles_count' => __('Articles', 'rishi'),
										'comments' => __('Comments', 'rishi'),
									]
								),

								'value' => [
									'joined' => true,
									'articles_count' => true,
									'comments' => true
								],
							],
						] : [],

						[
							$is_single ? [
							 rishi__cb_customizer_get_options('general/meta', [
									'skip_sync_id' => [
										'id' => $prefix . 'hero_elements_spacing',
									],
									'is_page' => $is_page,
									'is_cpt' => $is_cpt
								])
							] : []
						],

						'hero_item_spacing' => [
							'label' => __('Top Spacing', 'rishi'),
							'type' => 'rt-slider',
							'value' => 20,
							'min' => 0,
							'max' => 100,
							'responsive' => true,
							'sync' => [
								'id' => $prefix . 'hero_elements_spacing',
							],
						],
					],
				],

				'author_social_channels' => [
					'label' => __('Social Channels', 'rishi'),
					'options' => [
						'hero_item_spacing' => [
							'label' => __('Top Spacing', 'rishi'),
							'type' => 'rt-slider',
							'value' => 20,
							'min' => 0,
							'max' => 100,
							'responsive' => true,
							'sync' => [
								'id' => $prefix . 'hero_elements_spacing',
							],
						],
					],
				],
			]
		],

	 rishi__cb_customizer_rand_md5() => [
			'type' => 'rt-divider',
		],

	 rishi__cb_customizer_rand_md5() => [
			'type' => 'rt-condition',
			'condition' => [$prefix . 'hero_section' => 'type-1'],
			'options' => [

				$prefix . 'hero_alignment1' => [
					'type' => 'rt-radio',
					'label' => __('Horizontal Alignment', 'rishi'),
					'value' => apply_filters(
						'rishi:hero:type-1:default-alignment',
						'left',
						trim($prefix, '_')
					),
					'view' => 'text',
					'attr' => ['data-type' => 'alignment'],
					'responsive' => true,
					'design' => 'block',
					'sync' => 'live',
					'choices' => [
						'left' => '',
						'center' => '',
						'right' => '',
					],
				],

				$prefix . 'hero_margin' => [
					'label' => __('Container Bottom Spacing', 'rishi'),
					'type' => 'rt-slider',
					'value' => [
						'desktop' => 50,
						'tablet' => 30,
						'mobile' => 30,
					],
					'min' => 0,
					'max' => 300,
					'responsive' => true,
					'divider' => 'top',
					'setting' => ['transport' => 'postMessage'],
				],
			],
		],

	 rishi__cb_customizer_rand_md5() => [
			'type' => 'rt-condition',
			'condition' => [$prefix . 'hero_section' => 'type-2'],
			'options' => array_merge([

				$prefix . 'hero_alignment2' => [
					'type' => 'rt-radio',
					'label' => __('Horizontal Alignment', 'rishi'),
					'value' => 'center',
					'view' => 'text',
					'attr' => ['data-type' => 'alignment'],
					'responsive' => true,
					'design' => 'block',
					'sync' => 'live',
					'choices' => [
						'left' => '',
						'center' => '',
						'right' => '',
					],
				],

				$prefix . 'hero_vertical_alignment' => [
					'type' => 'rt-radio',
					'label' => __('Vertical Alignment', 'rishi'),
					'value' => 'center',
					'view' => 'text',
					'design' => 'block',
					'responsive' => true,
					'attr' => ['data-type' => 'vertical-alignment'],
					'sync' => 'live',

					'choices' => [
						'flex-start' => '',
						'center' => '',
						'flex-end' => '',
					],
				],
			]),
		],

	],

	[

	 rishi__cb_customizer_rand_md5() => [
			'type' => 'rt-condition',
			'condition' => [$prefix . 'hero_section' => 'type-2'],
			'options' => [

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-divider',
				],

				$prefix . 'hero_structure' => [
					'label' => __('Container Width', 'rishi'),
					'type' => 'rt-radio',
					'value' => 'narrow',
					'view' => 'text',
					'design' => 'block',
					'sync' => 'live',
					'choices' => [
						'normal' => __('Default', 'rishi'),
						'narrow' => __('Narrow', 'rishi'),
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-divider',
				],

				$prefix . 'page_title_bg_type' => [
					'label' => __('Container Background Image', 'rishi'),
					'type' => 'rt-radio',
					'value' => ($is_archive || $is_author || $is_search) ? 'color' : 'featured_image',
					'view' => 'text',
					'design' => 'block',
					'attr' => ['data-radio-text' => 'small'],
					'choices' => array_merge(($is_archive || $is_author || $is_search) ? [] : [
						'featured_image' => __('Featured', 'rishi'),
					], [
						'custom_image' => __('Custom', 'rishi'),
						'color' => __('None', 'rishi'),
					]),
					'sync' => [
						'id' => $prefix . 'hero_elements',
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => [
						$prefix . 'page_title_bg_type' => 'custom_image'
					],
					'options' => [
						$prefix . 'custom_hero_background' => [
							'label' => __('Custom Image', 'rishi'),
							'type' => 'rt-image-uploader',
							'design' => false,
							'value' => ['attachment_id' => null],
							'emptyLabel' => __('Select Image', 'rishi'),
							'filledLabel' => __('Change Image', 'rishi'),
							'sync' => [
								'id' => $prefix . 'hero_elements',
							],
						],
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => [
						$prefix . 'page_title_bg_type' => 'custom_image | featured_image',
					],
					'options' => [
						$prefix . 'parallax' => [
							'label' => __('Parallax Effect', 'rishi'),
							'desc' => __('Choose for which devices you want to enable the parallax effect.', 'rishi'),
							'type' => 'rt-visibility',
							'design' => 'block',
							'allow_empty' => true,
							'sync' => 'live',
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
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-divider',
				],

				$prefix . 'hero_height' => [
					'label' => __('Container Height', 'rishi'),
					'type' => 'rt-slider',
					'value' => '250px',
					'design' => 'block',
					'units' => rishi__cb_customizer_units_config([
						[
							'unit' => 'px',
							'min' => 50,
							'max' => 1000,
						],
					]),
					'responsive' => true,
					'sync' => 'live'
				],
			],
		],
	],
];

$when_enabled_design_settings = [
 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [
			$prefix . 'hero_elements:array-ids:custom_title:enabled' => 'true',
		],
		'options' => [
			$prefix . 'pageTitleFont' => [
				'type' => 'rt-typography',
				'label' => __('Title Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => [
						'desktop' => '32px',
						'tablet'  => '30px',
						'mobile'  => '25px'
					],
				]),
				'design' => 'block',
				'sync' => 'live'
			],

			$prefix . 'pageTitleFontColor' => [
				'label' => __('Title Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'divider' => 'bottom',
				'sync' => 'live',

				'value' => [
					'default' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--headingColor)'
					],
				],
			],
		]
	],

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [
			'all' => [
				$prefix . 'hero_elements:array-ids:custom_meta:enabled' => 'true',
				'any' => [
					$prefix . 'hero_elements:array-ids:custom_meta:single_meta_elements/author' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:single_meta_elements/comments' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:single_meta_elements/date' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:single_meta_elements/updated' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:single_meta_elements/categories' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:single_meta_elements/tags' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:page_meta_elements/joined' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:page_meta_elements/articles_count' => 'true',
					$prefix . 'hero_elements:array-ids:custom_meta:page_meta_elements/comments' => 'true',
				]
			],
		],

		'options' => [
			$prefix . 'pageMetaFont' => [
				'type' => 'rt-typography',
				'label' => __('Meta Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => '12px',
					'variation' => 'n6',
					'line-height' => '1.3',
					'text-transform' => 'uppercase',
				]),
				'design' => 'block',
				'sync' => 'live'
			],

			$prefix . 'pageMetaFontColor' => [
				'label' => __('Meta Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'divider' => 'bottom',
				'sync' => 'live',

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
						'inherit' => 'var(--color)'
					],

					[
						'title' => __('Hover', 'rishi'),
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
			'all' => [
				$prefix . 'hero_elements:array-ids:custom_description:enabled' => 'true',
				'any' => [
					$prefix . 'hero_elements:array-ids:custom_description:description_visibility/desktop' => 'true',
					$prefix . 'hero_elements:array-ids:custom_description:description_visibility/tablet' => 'true',
					$prefix . 'hero_elements:array-ids:custom_description:description_visibility/mobile' => 'true',
				]
			]
		],
		'options' => [
			$prefix . 'pageExcerptFont' => [
				'type' => 'rt-typography',
				'label' => $is_single ? __('Excerpt Font', 'rishi') : __(
					'Description Font',
					'rishi'
				),
				'value' => rishi__cb_customizer_typography_default_values([
				]),
				'design' => 'block',
				'sync' => 'live'
			],

			$prefix . 'pageExcerptColor' => [
				'label' => $is_single ? __('Excerpt Font Color', 'rishi') : __(
					'Description Font Color',
					'rishi'
				),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'divider' => 'bottom',
				'sync' => 'live',

				'value' => [
					'default' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--color)'
					],
				],
			],
		],
	],

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [
			$prefix . 'hero_elements:array-ids:breadcrumbs:enabled' => 'true',
		],
		'options' => [
			$prefix . 'breadcrumbsFont' => [
				'type' => 'rt-typography',
				'label' => __('Breadcrumb Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => '12px',
					'variation' => 'n6',
					'text-transform' => 'uppercase',
				]),
				'design' => 'block',
				'sync' => 'live'
			],

			$prefix . 'breadcrumbsFontColor' => [
				'label' => __('Breadcrumb Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'inline',
				'divider' => 'bottom',
				'sync' => 'live',

				'value' => [
					'default' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],

					'initial' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],

					'hover' => [
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
					],
				],

				'pickers' => [
					[
						'title' => __('Text', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--color)'
					],

					[
						'title' => __('Link Initial', 'rishi'),
						'id' => 'initial',
						'inherit' => 'var(--linkInitialColor)'
					],

					[
						'title' => __('Link Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => 'var(--linkHoverColor)'
					],
				],
			],
		]
	],

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [
			$prefix . 'hero_section' => 'type-2'
		],
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [$prefix . 'page_title_bg_type' => '!color'],
				'options' => [

					$prefix . 'pageTitleOverlay' => [
						'label' => __('Image Overlay Color', 'rishi'),
						'type'  => 'rt-color-picker',
						'design' => 'inline',
						'divider' => 'bottom',
						'sync' => 'live',

						'value' => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword(),
							],
						],

						'pickers' => [
							[
								'title' => __('Initial color', 'rishi'),
								'id' => 'default',
							],
						],
					],

				],
			],

			$prefix . 'pageTitleBackground' => [
				'label' => __('Container Background', 'rishi'),
				'type' => 'rt-background',
				'design' => 'inline',
				'sync' => 'live',
				'value' => rishi__cb_customizer_background_default_value([
					'backgroundColor' => [
						'default' => [
							'color' => '#EDEFF2'
						],
					],
				])
			],

		],
	],
];

$when_enabled_settings = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => $when_enabled_general_settings
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => $when_enabled_design_settings
	],
];

$options_when_not_default = [
	$prefix . 'hero_enabled' => [
		'label' => $enabled_label,
		'type' => 'rt-panel',
		'switch' => true,
		'value' => $enabled_default,
		'wrapperAttr' => ['data-label' => 'heading-label'],
		'sync' => rishi__cb_customizer_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => $when_enabled_settings
	]
];

// options output for posts/pages
$options_when_default = [
	$prefix . 'has_hero_section' => [
		'label' => false,
		'type' => 'rt-radio',
		'value' => 'default',
		'view' => 'text',
		'disableRevertButton' => true,
		'design' => $is_single ? 'block' : 'inline',
		'wrapperAttr' => ['data-spacing' => 'custom'],
		'choices' => [
			'default' => __('Inherit', 'rishi'),
			'enabled' => __('Custom', 'rishi'),
			'disabled' => __('Disabled', 'rishi'),
		],
	],

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [$prefix . 'has_hero_section' => 'default'],
		'options' => [
		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-notification',
				'attr' => ['data-spacing' => 'custom'],
				'text' => __('By default these options are inherited from Customizer options.', 'rishi'),
			],
		],
	],

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [$prefix . 'has_hero_section' => 'enabled'],
		'options' => $when_enabled_settings
	],
];

// options output for taxonomies
if (!$is_single) {
	$options_when_default = [
	 rishi__cb_customizer_rand_md5() => [
			'title' => __('General', 'rishi'),
			'type' => 'tab',
			'options' => [
				$prefix . 'has_hero_section' => [
					'label' => __('Page Title', 'rishi'),
					'type' => 'rt-radio',
					'value' => 'default',
					'view' => 'text',
					'disableRevertButton' => true,
					'design' => $is_single ? 'block' : 'inline',
					'wrapperAttr' => ['data-spacing' => 'custom'],
					'choices' => [
						'default' => __('Inherit', 'rishi'),
						'enabled' => __('Custom', 'rishi'),
						'disabled' => __('Disabled', 'rishi'),
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => [$prefix . 'has_hero_section' => 'enabled'],
					'options' => $when_enabled_general_settings
				],
			]
		],

	 rishi__cb_customizer_rand_md5() => [
			'title' => __('Design', 'rishi'),
			'type' => 'tab',
			'options' => [

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => [$prefix . 'has_hero_section' => 'enabled'],
					'options' => $when_enabled_design_settings
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => [$prefix . 'has_hero_section' => '!enabled'],
					'options' => [
					 rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-notification',
							'attr' => ['data-label' => 'no-label'],
							'text' => __('Options will appear here only if you will set Custom in Page Title option.', 'rishi')
						]
					]
				],
			]
		],
	];
}

$options = $has_default ? $options_when_default : $options_when_not_default;
