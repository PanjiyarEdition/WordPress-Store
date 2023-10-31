<?php
/**
 * General options
 *
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$options = [
	'layouts_section_options' => [
		'type' => 'rt-options',
		'setting' => ['transport' => 'postMessage'],
		'customizer_section' => 'container',
		'inner-options' => [

		 rishi__cb_customizer_get_options('general/layouts/container'),

		 rishi__cb_customizer_get_options('general/layouts/contentsidebar'),

		 rishi__cb_customizer_get_options('general/layouts/button'),

		 rishi__cb_customizer_get_options('general/layouts/back-to-top'),

		 rishi__cb_customizer_get_options('general/layouts/404'),

			apply_filters('rishi:options:general:bottom', [])
		],
	],

	'customizer_color_scheme' => [
		'label' => __('Color scheme', 'rishi'),
		'type' => 'hidden',
		'label' => '',
		'value' => 'no',
		'setting' => ['transport' => 'postMessage'],
	],
];
