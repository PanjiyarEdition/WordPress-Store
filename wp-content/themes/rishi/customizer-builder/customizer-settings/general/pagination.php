<?php

if (!isset($prefix)) {
	$prefix = '';
	$initial_prefix = '';
} else {
	$initial_prefix = $prefix;
	$prefix = $prefix . '_';
}

$options = [
	$prefix . 'has_pagination' => [
		'label' => __('Pagination', 'rishi'),
		'type' => 'rt-panel',
		'switch' => true,
		'value' => 'yes',
		'sync' => rishi__cb_customizer_sync_whole_page([
			'prefix' => $prefix,
			'loader_selector' => 'section'
		]),
		'inner-options' => [

		 rishi__cb_customizer_rand_md5() => [
				'title' => __('General', 'rishi'),
				'type' => 'tab',
				'options' => [

					$prefix . 'pagination_global_type' => [
						'label' => __('Pagination Type', 'rishi'),
						'type' => 'rt-select',
						'value' => 'simple',
						'view' => 'text',
						'design' => 'inline',
						'choices' => rishi__cb_customizer_ordered_keys(
							[
								'simple' => __('Standard', 'rishi'),
								'next_prev' => __('Next/Prev', 'rishi'),
								'load_more' => __('Load More', 'rishi'),
								'infinite_scroll' => __('Infinite Scroll', 'rishi'),
							]
						),

						'sync' => [
							'selector' => '.cb__pagination',
							'prefix' => $prefix,
							'render' => function ($args) {
								echo rishi__cb_customizer_display_posts_pagination();
							}
						]
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [$prefix . 'pagination_global_type' => 'load_more'],
						'options' => [

							$prefix . 'load_more_label' => [
								'label' => __('Label', 'rishi'),
								'type' => 'text',
								'design' => 'inline',
								'value' => __('Load More', 'rishi'),
								'sync' => 'live',
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [$prefix . 'pagination_global_type' => 'simple'],
						'options' => [

							$prefix . 'numbers_visibility' => [
								'label' => __('Numbers Visibility', 'rishi'),
								'type' => 'rt-visibility',
								'design' => 'block',
								'sync' => 'live',
								'divider' => 'top',
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
							],

							$prefix . 'arrows_visibility' => [
								'label' => __('Arrows Visibility', 'rishi'),
								'type' => 'rt-visibility',
								'design' => 'block',
								'sync' => 'live',
								'divider' => 'top',
								'allow_empty' => true,
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
						'type' => 'rt-divider',
					],

					$prefix . 'paginationSpacing' => [
						'label' => __('Pagination Top Spacing', 'rishi'),
						'type' => 'rt-slider',
						'min' => 0,
						'max' => 200,
						'responsive' => true,
						'value' => [
							'mobile' => 50,
							'tablet' => 60,
							'desktop' => 80,
						],
						'sync' => 'live',
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'title' => __('Design', 'rishi'),
				'type' => 'tab',
				'options' => [

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'pagination_global_type' => 'simple|next_prev'
						],
						'options' => [

							$prefix . 'simplePaginationFontColor' => [
								'label' => __('Colors', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
								'value' => [
									'default' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],

									'active' => [
										'color' => '#ffffff',
									],

									'hover' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],
								'sync' => 'live',

								'pickers' => [
									[
										'title' => __('Text Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--color)'
									],

									[
										'title' => __('Text Active', 'rishi'),
										'id' => 'active',
										'condition' => [$prefix . 'pagination_global_type' => 'simple']
									],

									[
										'title' => __('Accent', 'rishi'),
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
							$prefix . 'pagination_global_type' => 'load_more'
						],
						'options' => [

							$prefix . 'paginationButtonText' => [
								'label' => __('Font Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
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
										'inherit' => 'var(--buttonTextInitialColor)'
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--buttonTextHoverColor)'
									],
								],
							],

							$prefix . 'paginationButton' => [
								'label' => __('Button Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'inline',
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
										'inherit' => 'var(--buttonInitialColor)'
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--buttonHoverColor)'
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-condition',
						'condition' => [
							$prefix . 'pagination_global_type' => '!infinite_scroll'
						],
						'options' => [

							$prefix . 'paginationDivider' => [
								'label' => __('Divider', 'rishi'),
								'type' => 'rt-border',
								'design' => 'inline',
								'divider' => 'top',
								'sync' => 'live',
								'value' => [
									'width' => 1,
									'style' => 'none',
									'color' => [
										'color' => 'rgba(224, 229, 235, 0.5)',
									],
								]
							],

						],
					],

				],
			],
		],
	],
];
