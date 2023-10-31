<?php

// Content color
rishi__cb_customizer_output_colors ( [
	'value' => get_theme_mod('progressBarColor'),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor5)' ],
		'progress' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => '#rt-progress-bar',
			'variable' => 'colorDefault'
		],

		'progress' => [
			'selector' => '#rt-progress-bar',
			'variable' => 'colorProgress'
		]
	],
]);

$cookieMaxWidth = get_theme_mod( 'progressThickness', 5 );
$css->put(
	'#rt-progress-bar',
	'--Thickness: ' . $cookieMaxWidth . 'px'
);

