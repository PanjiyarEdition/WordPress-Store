<?php

$config = [
	'name' => __('Offcanvas Menu', 'rishi'),
	'visibilityKey' 	=> 'header_hide_mobile_menu',
	'typography_keys' => ['mobileMenuFont'],
	'devices' => ['mobile'],
	'allowed_in' => ['offcanvas'],
	'selective_refresh' => ['menu']
];
