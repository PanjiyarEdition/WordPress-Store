<?php

$config = [
    'enabled' => class_exists('WooCommerce'),
	'visibilityKey' => 'header_hide_cart',
	'selective_refresh' => [
		'has_cart_dropdown',
		'mini_cart_type'
	]
];
