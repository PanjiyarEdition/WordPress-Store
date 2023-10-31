<?php

/**
 * General options
 *
 *
 * @license   http: //www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */
$defaults = rishi__cb__get_breadcrumbs_defaults();

$layouts_defaults = rishi__cb__get_layout_defaults();

$colordefaults = rishi__cb__get_color_defaults();

$options = [
	'layouts_seooptions_options' => [
		'type'               => 'rt-options',
		'customizer_section' => 'container',
		'inner-options'      => [
		 rishi__cb_customizer_rand_md5() => [
				'title' => __('Breadcrumb', 'rishi'),
				'type' => 'tab',
				'options' => array_merge([
					'breadcrumbs_position' => [
						'label'   => __('Breadcrumb Position', 'rishi'),
						'type'    => 'rt-select',
						'value'   => $defaults['breadcrumbs_position'],
						'view'    => 'text',
						'design'  => 'inline',
						'choices' => rishi__cb_customizer_ordered_keys([
							'none'   => __('None', 'rishi'),
							'before' => __('Before Title', 'rishi'),
						]),
					],
					'breadcrumbs_separator' => [
						'label'   => __('Separator', 'rishi'),
						'type'    => 'rt-image-picker',
						'value'   => $defaults['breadcrumbs_separator'],
						'attr'    => ['data-columns' => '3'],
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
					],

					'breadcrumbs_alignment' => [
						'type'       => 'rt-radio',
						'label'      => __('Horizontal Alignment', 'rishi'),
						'value'      => $defaults['breadcrumbs_alignment'],
						'view'       => 'text',
						'attr'       => ['data-type' => 'alignment'],
						'responsive' => false,
						'design'     => 'block',
						'sync'       => 'live',
						'choices' => [
							'left' => '',
							'center' => '',
							'right' => '',
						],
					],

					'enable_schema_org_markup' => [
						'label' => __('Schema Markup', 'rishi'),
						'type' => 'rara-switch',
						'value' => 'yes',
						'desc' => __('This option will be enable schema markup.', 'rishi'),
					],
			]),
			],
		 rishi__cb_customizer_rand_md5() => [
				'title' => __('Design', 'rishi'),
				'type' => 'tab',
				'options' => [
					'breadcrumbs_color' => [
						'label'           => __('Breadcrumb Color', 'rishi'),
						'type'            => 'rt-color-picker',
						'skipEditPalette' => true,
						'design'          => 'inline',
						'setting'         => ['transport' => 'postMessage'],
						'value'           => [
							'default' => [
								'color' => $colordefaults['breadcrumbsColor'],
							],
						],
						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id'    => 'default',
							],
						],
					],
					'breadcrumbs_current_color' => [
						'label'           => __('Breadcrumb Current Color', 'rishi'),
						'type'            => 'rt-color-picker',
						'skipEditPalette' => true,
						'design'          => 'inline',
						'setting'         => ['transport' => 'postMessage'],
						'value'           => [
							'default' => [
								'color' => $colordefaults['breadcrumbsCurrentColor'],
							],
						],
						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id'    => 'default',
							],
						],
					],
					'breadcrumbsSeparatorColor' => [
						'label'           => __('Breadcrumb Separator Color', 'rishi'),
						'type'            => 'rt-color-picker',
						'skipEditPalette' => true,
						'design'          => 'inline',
						'setting'         => ['transport' => 'postMessage'],
						'value'           => [
							'default' => [
								'color' => $colordefaults['breadcrumbsSeparatorColor'],
							],
						],
						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id'    => 'default',
							],
						],
					],
					'breadcrumbsTypo' => [
						'type'  => 'rt-typography',
						'label' => __('Typography', 'rishi'),
						'value' => rishi__cb_customizer_typography_default_values([
							'family'    => 'System Default',
							'size'      => '14px',
							'variation' => 'n5',
						]),
						'setting' => ['transport' => 'postMessage'],
					],
					'breadcrumbsPadding' => [
						'label'   => __('Breadcrumb Padding', 'rishi'),
						'type'    => 'rt-spacing',
						'divider' => 'top',
						'setting' => ['transport' => 'postMessage'],
						'value' => rishi__cb_customizer_spacing_value([
							'linked' => false,
							'top'    => '0px',
							'left'   => '0px',
							'right'  => '0px',
							'bottom' => '10px',
						]),
						'responsive' => false
					],
				],
			],
		],

		apply_filters('rishi:options:seooptions:bottom', [])
	],
];
