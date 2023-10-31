<?php

/**
 * Layout options
 *
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$options = [

	'layout_panel' => [
		'label' => __('Layout', 'rishi'),
		'type' => 'rt-panel',
		'setting' => ['transport' => 'postMessage'],
		'inner-options' => [

			'maxSiteWidth' => [
				'label' => __('Maximum Site Width', 'rishi'),
				'type' => 'rt-slider',
				'value' => 1290,
				'min' => 700,
				'max' => 1900,
				'sync' => 'live'
			],

			'contentAreaSpacing' => [
				'label' => __('Content Area Spacing', 'rishi'),
				'type' => 'rt-slider',
				'value' => [
					'desktop' => '60px',
					'tablet' => '60px',
					'mobile' => '50px',
				],
				'units' => rishi__cb_customizer_units_config([
					['unit' => 'px', 'min' => 0, 'max' => 300],
				]),
				'responsive' => true,
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'desc' => __('Main content area top and bottom spacing.', 'rishi'),
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'narrowContainerWidth' => [
				'label' => __('Fullwidth Container Max-width', 'rishi'),
				'type' => 'rt-slider',
				'value' => 750,
				'min' => 400,
				'max' => 1170,
				'setting' => ['transport' => 'postMessage'],
				'desc' => __('This option will apply only on single posts & pages that have a Narrow Width page structure.', 'rishi'),
			],

			'wideOffset' => [
				'label' => __('Wide Alignment Offset', 'rishi'),
				'type' => 'rt-slider',
				'defaultUnit' => 'px',
				'value' => 130,
				'min' => 20,
				'max' => 200,
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'desc' => __('This option will apply only to those elements that have a wide alignment option.', 'rishi'),
			],

		],
	],

];
