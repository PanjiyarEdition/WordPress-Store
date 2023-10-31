<?php

$config = [
	'name' => __('Menu 2', 'rishi'),
	'visibilityKey' 	=> 'header_hide_menu_two',
	'typography_keys' => ['headerMenuFont', 'headerDropdownFont'],
    'devices' => ['desktop'],
	'selective_refresh' => ['menu'],
	'excluded_from' => ['offcanvas']
];
