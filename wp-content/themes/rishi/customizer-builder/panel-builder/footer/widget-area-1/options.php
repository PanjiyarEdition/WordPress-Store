<?php

if (!isset($sidebarId)) {
	$sidebarId = 'footer-one';
}

if (!isset($rt_id)) {
	$rt_id = '_one';
}

$options = [
	'footer_hide_widget'.$rt_id => [
		'label' => false,
		'type' => 'hidden',
		'value' => false,
		'sync' => 'live',
		'setting' => [
			'type' => 'option',
			// 'transport' => 'postMessage'
		],
		'disableRevertButton' => true,
		'desc' => __('Hide', 'rishi'),
	],
	'widget' => [
		'type' => 'rt-widget-area',
		'sidebarId' => $sidebarId
	],

];
