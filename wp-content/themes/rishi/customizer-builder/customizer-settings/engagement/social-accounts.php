<?php

/**
 * Social Accounts
 *
 * @copyright 2020-present Rishi Theme
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$social_networks_options = [];

foreach ( rishi__cb_customizer_get_social_networks_list() as $networkid => $network) {
	$social_section_options[$networkid] = [
		'label' => $network['label'],
		'type' => 'text',
		'design' => 'inline',
		'value' => '',
		'setting' => ['transport' => 'postMessage'],
	];
}

$options = [
	'social_section_options' => [
		'type' => 'rt-options',
		'setting' => ['transport' => 'postMessage'],
		'inner-options' => [
			[
			 rishi__cb_customizer_rand_md5() => [
					'label' => __('Social Network Accounts', 'rishi'),
					'type' => 'rt-title',
					'desc' => __(' Add the links to your social media accounts and display them across your site.', 'rishi'),
				],
			],

			$social_section_options
		],
	],
];
