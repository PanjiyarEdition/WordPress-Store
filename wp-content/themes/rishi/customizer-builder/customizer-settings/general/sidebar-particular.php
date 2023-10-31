<?php

if (!isset($prefix)) {
	$prefix = '';
	$initial_prefix = '';
} else {
	$initial_prefix = $prefix;
	$prefix = $prefix . '_';
}

$options = [

 rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [
			$prefix . 'structure' => '!gutenberg'
		],
		'options' => [
			$prefix . 'has_sidebar' => [
				'label' => __('Sidebar', 'rishi'),
				'type' => 'rt-panel',
				'switch' => true,
				'value' => 'no',
				'sync' => rishi__cb_customizer_sync_whole_page([
					'prefix' => $prefix,
					'loader_selector' => '[class*="cb__container"]'
				]),
				'inner-options' => [
					$prefix . 'sidebar_position' => [
						'label' => __('Sidebar Position', 'rishi'),
						'type' => 'rt-image-picker',
						'value' => 'right',
						'divider' => 'bottom',
						'condition' => [$prefix . 'has_sidebar' => 'yes'],
						'sync' => 'live',
						'choices' => [
							'left' => [
								'src'   => rishi__cb_customizer_image_picker_url('left-sidebar.svg'),
								'title' => __('Left Sidebar', 'rishi'),
							],

							'right' => [
								'src'   => rishi__cb_customizer_image_picker_url('right-sidebar.svg'),
								'title' => __('Right Sidebar', 'rishi'),
							],
						],
					],

				],
			],

		]
	],

];
