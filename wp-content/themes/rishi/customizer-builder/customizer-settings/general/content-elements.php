<?php

/**
 * Content elements options
 *
 *
 * @license   http: //www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$options = [

	'content_elements_panel' => [
		'label'         => __('Entry Content Elements', 'rishi'),
		'type'          => 'rt-panel',
		'setting'       => ['transport' => 'postMessage'],
		'inner-options' => [

			'contentSpacing' => [
				'label'   => __('Content Spacing', 'rishi'),
				'type'    => 'rt-select',
				'value'   => 'comfortable',
				'view'    => 'text',
				'design'  => 'inline',
				'choices' => rishi__cb_customizer_ordered_keys([
					'none'        => __('None', 'rishi'),
					'compact'     => __('Compact', 'rishi'),
					'comfortable' => __('Comfortable', 'rishi'),
					'spacious'    => __('Spacious', 'rishi'),
				]),
				'setting' => ['transport' => 'postMessage'],
				'desc'    => __('Vertical spacing value between entry content elements & blocks.', 'rishi'),
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'left_right_wide' => [
				'label'   => __('Left & Right Blocks Offset', 'rishi'),
				'type'    => 'rara-switch',
				'value'   => 'yes',
				'setting' => ['transport' => 'postMessage'],
				'desc'    => __('This option will add offset to all left and right aligned blocks in Gutenberg editor.', 'rishi'),
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'content_link_type' => [
				'label'   => __('Links Type', 'rishi'),
				'type'    => 'rt-select',
				'value'   => 'type-2',
				'view'    => 'text',
				'design'  => 'inline',
				'setting' => ['transport' => 'postMessage'],
				'choices' => rishi__cb_customizer_ordered_keys(
					[
						'type-1' => __('Type 1', 'rishi'),
						'type-2' => __('Type 2', 'rishi'),
						'type-3' => __('Type 3', 'rishi'),
						'type-4' => __('Type 4', 'rishi'),
						'type-5' => __('Type 5', 'rishi'),
					]
				),
			],
		],
	],

];
