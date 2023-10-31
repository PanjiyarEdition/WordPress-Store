<?php

/**
 * Breadcrumbs options
 *
 *
 * @license   http: //www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$options = [

	'breadcrumbs_panel' => [
		'label'         => __('Breadcrumb', 'rishi'),
		'type'          => 'rt-panel',
		'setting'       => ['transport' => 'postMessage'],
		'inner-options' => [

			'breadcrumb_separator' => [
				'label'   => __('Separator', 'rishi'),
				'type'    => 'rt-image-picker',
				'value'   => 'type-1',
				'attr'    => ['data-columns' => '3'],
				'divider' => 'bottom',
				'choices' => [

					'type-1' => [
						'src'   => rishi__cb_customizer_image_picker_file('breadcrumb-sep-1'),
						'title' => __('Type 1', 'rishi'),
					],

					'type-2' => [
						'src'   => rishi__cb_customizer_image_picker_file('breadcrumb-sep-2'),
						'title' => __('Type 2', 'rishi'),
					],

					'type-3' => [
						'src'   => rishi__cb_customizer_image_picker_file('breadcrumb-sep-3'),
						'title' => __('Type 3', 'rishi'),
					],
				],

				'sync' => rishi__cb_customizer_sync_whole_page([
					'loader_selector' => '.rt-breadcrumbs'
				]),
			],

			'breadcrumb_home_item' => [
				'label'   => __('Home Item', 'rishi'),
				'type'    => 'rt-radio',
				'value'   => 'text',
				'view'    => 'text',
				'choices' => [
					'text' => __('Text', 'rishi'),
					'icon' => __('Icon', 'rishi'),
				],
				'sync' => rishi__cb_customizer_sync_whole_page([
					'loader_selector' => '.rt-breadcrumbs'
				]),
			],

		 rishi__cb_customizer_rand_md5() => [
				'type'      => 'rt-condition',
				'condition' => ['breadcrumb_home_item' => 'text'],
				'options'   => [

					'breadcrumb_home_text' => [
						'label'  => __('Home Page Text', 'rishi'),
						'type'   => 'text',
						'design' => 'block',
						'value'  => __('Home', 'rishi'),
						'sync'   => rishi__cb_customizer_sync_whole_page([
							'loader_selector' => '.rt-breadcrumbs'
						]),
					],

				],
			],

			'breadcrumb_page_title' => [
				'label'   => __('Current Page/Post Title', 'rishi'),
				'type'    => 'rara-switch',
				'value'   => 'yes',
				'divider' => 'top',
				'sync'    => rishi__cb_customizer_sync_whole_page([
					'loader_selector' => '.rt-breadcrumbs'
				]),
			],

			'breadcrumb_taxonomy_title' => [
				'label'   => __('Current Taxonomy Title', 'rishi'),
				'type'    => 'rara-switch',
				'value'   => 'yes',
				'divider' => 'top',
				'sync'    => rishi__cb_customizer_sync_whole_page([
					'loader_selector' => '.rt-breadcrumbs'
				]),
			],

		],
	],

];
