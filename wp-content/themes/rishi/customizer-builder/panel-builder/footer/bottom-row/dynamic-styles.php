<?php

rishi__cb_customizer_get_variables_from_file(
	\RISHI_CUSTOMIZER_BUILDER_DIR__ . '/panel-builder/footer/middle-row/dynamic-styles.php',
	[],
	[
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'atts' => $atts,
		'root_selector' => $root_selector,
		'primary_item' => $primary_item,

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

	]
);
