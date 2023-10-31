<?php

$options = rishi__cb_customizer_get_options(
	\RISHI_CUSTOMIZER_BUILDER_DIR__ . '/panel-builder/header/middle-row/options.php',
	array(
		'default_height'     => array(
			'mobile'  => 50,
			'tablet'  => 50,
			'desktop' => 50,
		),

		'default_background' => rishi__cb_customizer_background_default_value(
			array(
				'backgroundColor' => array(
					'default' => array(
						'color' => '#f9f9f9',
					),
				),
			)
		),
	),
	false
);
