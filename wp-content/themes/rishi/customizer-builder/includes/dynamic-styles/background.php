<?php

$defaults = rishi__cb__get_color_defaults();
// Site background
rishi__cb_customizer_output_background_css([
	'selector' => 'body',
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'value' => get_theme_mod(
		'site_background',
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => $defaults['site_background'],
				],
			],
		])
	),
	'responsive' => true,
]);
