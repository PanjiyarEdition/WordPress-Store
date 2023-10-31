<?php

$options = rishi__cb_customizer_get_options(
	\RISHI_CUSTOMIZER_BUILDER_DIR__ . '/panel-builder/footer/middle-row/options.php',
	[
		'default_background' => rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => 'var(--paletteColor2)',
				],
			],
		]),

		'default_top_bottom_spacing' => [
			'mobile' => '15px',
			'tablet' => '25px',
			'desktop' => '25px',
		]
	],
	false
);
