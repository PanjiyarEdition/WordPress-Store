<?php
// Margin
rishi__cb_customizer_output_spacing([
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector' => rishi__cb_customizer_assemble_selector($root_selector),
	'important' => true,
	'value' => rishi__cb_customizer_default_akg(
		'contacts_margin', $atts,
	 rishi__cb_customizer_spacing_value([
			'linked' => true,
		])
	)
]);

$contacts_icon_size = rishi__cb_get_akv( 'contacts_icon_size', $atts, 15 );

if ($contacts_icon_size !== 15) {
 rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info',
		'variableName' => 'icon-size',
		'value'        => $contacts_icon_size,
		'responsive'   => true
	]);
}

$contacts_spacing = rishi__cb_get_akv( 'contacts_spacing', $atts, 15 );

if ($contacts_spacing !== 15) {
 rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info',
		'variableName' => 'items-spacing',
		'value'        => $contacts_spacing,
		'responsive'   => true
	]);
}

rishi__cb_customizer_output_font_css([
	'font_value' => rishi__cb_get_akv( 'contacts_font', $atts,
	 rishi__cb_customizer_typography_default_values([
			'size'        => '14px',
			'line-height' => '1.3',
		])
	),
	'css'        => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'selector'   => '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
]);


// default state
rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('contacts_font_color', $atts),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor5)' ],
		'link_initial' => [ 'color' => 'var(--paletteColor5)' ],
		'link_hover' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,
	'variables' => [
		'default' => [
			'selector' => '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
			'variable' => 'color'
		],

		'link_initial' => [
			'selector' => '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
			'variable' => 'linkInitialColor'
		],

		'link_hover' => [
			'selector' => '[data-footer*="type-1"] [data-id="contacts"].cb__footer-contact-info .contact-info',
			'variable' => 'linkHoverColor'
		],
	],
	'responsive' => true
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('contacts_icon_color', $atts),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor5)' ],
		'hover' => [ 'color' => 'var(--paletteColor3)' ],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'icon-color'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'icon-hover-color'
		]
	],

	'responsive' => true
]);

rishi__cb_customizer_output_colors([
	'value' => rishi__cb_get_akv('contacts_icon_background', $atts),
	'default' => [
		'default' => [ 'color' => 'var(--paletteColor6)' ],
		'hover' => [ 'color' => 'rgba(218, 222, 228, 0.7)' ],
	],
	'css' => $css,
	'tablet_css' => $tablet_css,
	'mobile_css' => $mobile_css,

	'variables' => [
		'default' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'background-color'
		],

		'hover' => [
			'selector' => rishi__cb_customizer_assemble_selector($root_selector),
			'variable' => 'background-hover-color'
		]
	],
	'responsive' => true
]);
