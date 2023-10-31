<?php

/**
 * Container Options
 */

$defaults = rishi__cb__get_color_defaults();

$options = [
	'layout_header_colors_panel' => [
		'label'         => __('Header', 'rishi'),
		'type'          => 'rt-panel',
		'setting'       => ['transport' => 'postMessage'],
		'inner-options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type'  => 'rt-title',
				'label' => __('Top Header Colors', 'rishi'),
			],
			'top_header_bg_color' => [
				'label'           => __('Background', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['top_header_bg_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'top_header_text_color' => [
				'label'           => __('Top Header Text', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['top_header_text_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'top_header_link_color' => [
				'label'           => __('Link', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['top_header_link_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'top_header_link_hover_color' => [
				'label'           => __('Link Hover', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['top_header_link_hover_color'],
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
				'label' => __('Primary Header', 'rishi'),
			],
			'primary_header_bg_color' => [
				'label'           => __('Background Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['primary_header_bg_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'primary_header_bottom_border_color' => [
				'label'           => __('Bottom Border', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['primary_header_bottom_border_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'primary_header_menu_item_color' => [
				'label'           => __('Menu Item', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['primary_header_menu_item_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'primary_header_menu_item_hover_color' => [
				'label'           => __('Menu Item Hover', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['primary_header_menu_item_hover_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'primary_header_menu_item_active_color' => [
				'label'           => __('Menu Item Active', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['primary_header_menu_item_active_color'],
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
				'label' => __('Header Button Colors', 'rishi'),
			],
			'header_btn_text_color' => [
				'label'           => __('Text', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['header_btn_text_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'header_btn_text_hover_color' => [
				'label'           => __('Text Hover', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['header_btn_text_hover_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'header_btn_bg_color' => [
				'label'           => __('Background', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['header_btn_bg_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'header_btn_bg_hover_color' => [
				'label'           => __('Background Hover', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['header_btn_bg_hover_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'header_btn_border_color' => [
				'label'           => __('Border', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['header_btn_border_color'],
					],
				],
				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],
				],
			],
			'header_btn_border_hover_color' => [
				'label' 		  => __('Border Hover', 'rishi'),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => ['transport' => 'postMessage'],
				'value'           => [
					'default' => [
						'color' => $defaults['header_btn_border_hover_color'],
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
