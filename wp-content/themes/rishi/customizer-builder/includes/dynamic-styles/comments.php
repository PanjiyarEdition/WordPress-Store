<?php

if (get_theme_mod($prefix . '_has_comments', 'yes') !== 'yes') {
	return;
}

$comments_narrow_width = get_theme_mod($prefix . '_comments_narrow_width', 750);

if ($comments_narrow_width !== 750) {
	$css->put(
	 rishi__cb_customizer_prefix_selector('.rt-comments-container', $prefix),
		'--narrow-container-max-width: ' . $comments_narrow_width . 'px'
	);
}

rishi__cb_customizer_output_colors([
	'value' => get_theme_mod(
		$prefix . '_comments_font_color',
		[
			'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
			'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		]
	),
	'default' => [
		'default' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
		'hover' => ['color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT')],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_prefix_selector('.rt-comments', $prefix),
			'variable' => 'color'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_prefix_selector('.rt-comments', $prefix),
			'variable' => 'linkHoverColor'
		],
	],
]);

rishi__cb_customizer_output_background_css([
	'selector' => rishi__cb_customizer_prefix_selector('.rt-comments-container', $prefix),
	'css' => $css,
	'value' => get_theme_mod(
		$prefix . '_comments_background',
	 rishi__cb_customizer_background_default_value([
			'backgroundColor' => [
				'default' => [
					'color' => \Rishi_CSS_Injector::get_skip_rule_keyword()
				],
			],
		])
	)
]);
