<?php

/**
 * Buttons options
 *
 *
 * @license   http: //www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$options = [

	'buttons_panel' => [
		'label'         => __('Buttons', 'rishi'),
		'type'          => 'rt-panel',
		'setting'       => ['transport' => 'postMessage'],
		'inner-options' => [

			'buttonMinHeight' => [
				'label'      => __('Min Height', 'rishi'),
				'type'       => 'rt-slider',
				'min'        => 30,
				'max'        => 100,
				'value'      => 45,
				'responsive' => true,
				'setting'    => ['transport' => 'postMessage'],
			],

			'buttonHoverEffect' => [
				'label'   => __('Hover Effect', 'rishi'),
				'type'    => 'rara-switch',
				'value'   => 'yes',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
			],

			'buttonRadius' => [
				'label'   => __('Border Radius', 'rishi'),
				'type'    => 'rt-spacing',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'value'   => rishi__cb_customizer_spacing_value([
					'linked' => true,
					'top'    => '3px',
					'left'   => '3px',
					'right'  => '3px',
					'bottom' => '3px',
				]),
				'responsive' => true
			],

			'buttonTextColor' => [
				'label'           => __('Font Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'design'          => 'inline',
				'divider'         => 'top',
				'skipEditPalette' => true,
				'setting'         => ['transport' => 'postMessage'],

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
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],

					[
						'title' => __('Hover', 'rishi'),
						'id'    => 'hover',
					],
				],
			],

			'buttonColor' => [
				'label'           => __('Background Color', 'rishi'),
				'type'            => 'rt-color-picker',
				'design'          => 'inline',
				'skipEditPalette' => true,
				'setting'         => ['transport' => 'postMessage'],

				'value' => [
					'default' => [
						'color' => 'var(--paletteColor1)',
					],

					'hover' => [
						'color' => 'var(--paletteColor2)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id'    => 'default',
					],

					[
						'title' => __('Hover', 'rishi'),
						'id'    => 'hover',
					],
				],
			],

		],
	],

];
