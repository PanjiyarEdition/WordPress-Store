<?php

$options = rishi__cb_customizer_get_options(
	\RISHI_CUSTOMIZER_BUILDER_DIR__ . '/panel-builder/header/middle-row/options.php',
	[
		'default_height' => [
			'mobile' => 80,
			'tablet' => 80,
			'desktop' => 80,
		],

		'default_background' => rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'var(--paletteColor5)',
				],
			],
		])
	],
	false
);
