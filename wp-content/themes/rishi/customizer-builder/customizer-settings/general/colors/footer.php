<?php

/**
 * Container Options
 */

$defaults = rishi__cb__get_color_defaults();

$options = [
	'layout_footer_colors_panel' => [
		'label'         => __('Footer', 'rishi'),
		'type'          => 'rt-panel',
		'setting'       => ['transport' => 'postMessage'],
		'inner-options' => [
		 rishi__cb_customizer_rand_md5() => [
				'type'  => 'rt-title',
				'label' => __('Footer Widget Colors', 'rishi'),
			],
			'footer_bg_color' => [
				'label'           => __('Background', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_bg_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_widget_title_color' => [
				'label'           => __('Widget Title Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_widget_title_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_text_color' => [
				'label'           => __('Text Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_text_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_link_hover_color' => [
				'label'           => __('Link Hover Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_link_hover_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_border_top_color' => [
				'label'           => __('Border Top Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_border_top_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_list_item_border_bottom_color' => [
				'label'           => __('List Item Border Bottom Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_list_item_border_bottom_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
		 rishi__cb_customizer_rand_md5() => [
				'type'  => 'rt-title',
				'label' => __('Footer Bar Colors', 'rishi'),
			],
			'footer_bar_border_top_color' => [
				'label'           => __('Border Top Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_bar_border_top_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_bar_bg_color' => [
				'label'           => __('Background Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_bar_bg_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_bar_text_color' => [
				'label'           => __('Text Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_bar_text_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_bar_link_color' => [
				'label'           => __('Link Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_bar_link_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'footer_bar_link_hover_color' => [
				'label'           => __('Link Hover Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['footer_bar_link_hover_color'],
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
];
