<?php

if (!isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}

if (!isset($enabled)) {
	$enabled = 'yes';
}

$options = [
	$prefix . 'has_comments' => [
		'label'  => __('Comments', 'rishi'),
		'type'   => 'rt-panel',
		'switch' => true,
		'value'  => $enabled,
		'sync'   => rishi__cb_customizer_sync_whole_page([
			'prefix' => $prefix,
		]),
		'inner-options' => [

		 rishi__cb_customizer_rand_md5() => [
				'title'   => __('General', 'rishi'),
				'type'    => 'tab',
				'options' => [

					$prefix . 'has_comments_website' => [
						'label' => __('Website Input Field', 'rishi'),
						'type'  => 'rara-switch',
						'value' => 'yes',
						'sync'  => rishi__cb_customizer_sync_whole_page([
							'prefix' => $prefix,
						]),
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					$prefix . 'comments_containment' => [
						'label'   => __('Module Placement', 'rishi'),
						'type'    => 'rt-radio',
						'value'   => 'separated',
						'view'    => 'text',
						'design'  => 'block',
						'desc'    => __('Separate or unify the comments module from or with the entry content area.', 'rishi'),
						'choices' => [
							'separated' => __('Separated', 'rishi'),
							'contained' => __('Contained', 'rishi'),
						],

						'sync' => rishi__cb_customizer_sync_whole_page([
							'prefix' => $prefix,
						]),
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

				 rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [$prefix . 'comments_containment' => 'separated'],
						'options'   => [

							$prefix . 'comments_structure' => [
								'label'   => __('Container Structure', 'rishi'),
								'type'    => 'rt-radio',
								'value'   => 'narrow',
								'view'    => 'text',
								'design'  => 'block',
								'choices' => [
									'narrow' => __('Narrow', 'rishi'),
									'normal' => __('Normal', 'rishi'),
								],
								'sync' => 'live'
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [
							$prefix . 'comments_containment' => 'separated',
							$prefix . 'comments_structure'   => 'narrow'
						],
						'options' => [
							$prefix . 'comments_narrow_width' => [
								'label'   => __('Container Max Width', 'rishi'),
								'type'    => 'rt-slider',
								'value'   => 750,
								'min'     => 500,
								'max'     => 800,
								'divider' => 'bottom',
								'sync'    => 'live'
							],
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'title'   => __('Design', 'rishi'),
				'type'    => 'tab',
				'options' => [

					$prefix . 'comments_font_color' => [
						'label'  => __('Font Color', 'rishi'),
						'type'   => 'rt-color-picker',
						'design' => 'inline',
						'sync'   => 'live',
						'value'  => [
							'default' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],

							'hover' => [
								'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
							],
						],

						'pickers' => [
							[
								'title'   => __('Initial', 'rishi'),
								'id'      => 'default',
								'inherit' => 'var(--color)'
							],

							[
								'title'   => __('Hover', 'rishi'),
								'id'      => 'hover',
								'inherit' => 'var(--linkHoverColor)'
							],
						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type'      => 'rt-condition',
						'condition' => [$prefix . 'comments_containment' => 'separated'],
						'options'   => [

							$prefix . 'comments_background' => [
								'label'   => __('Container Background', 'rishi'),
								'type'    => 'rt-background',
								'design'  => 'inline',
								'divider' => 'top',
								'sync'    => 'live',
								'value'   => rishi__cb_customizer_background_default_value([
									'backgroundColor' => [
										'default' => [
											'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
										],
									],
								])
							],

						],
					],

				],
			],

		],
	],
];
