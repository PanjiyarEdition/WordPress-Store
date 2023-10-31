<?php

/**
 * Dynamic styles.
 */

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

$header_bookmark_size = rishi__cb_get_akv( 'header_bookmark_size', $atts, 20 );

rishi__cb_customizer_output_responsive([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.rt__bookmark a',
	'variableName' => 'bookmark-icon-size',
	'value'        => $header_bookmark_size,
	'responsive'   => true
]);

rishi__cb_customizer_output_colors(
	array(
		'value'      => rishi__cb_get_akv('headerBookmarkColor', $atts),
		'default'    => array(
			'default'   => array('color' => 'var(--paletteColor3)'),
			'hover'     => array('color' => 'var(--paletteColor4)'),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default'   => array(
				'selector' => '.rt__bookmark a',
				'variable' => 'bookmarkInitialColor',
			),

			'hover'     => array(
				'selector' => '.rt__bookmark a',
				'variable' => 'bookmarkHoverColor',
			),
		),
		'responsive' => true,
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'      => rishi__cb_get_akv('headerBookmarkCountColor', $atts),
		'default'    => array(
			'default'   => array('color' => 'var(--paletteColor5)'),
			'hover'     => array('color' => 'var(--paletteColor5)'),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default'   => array(
				'selector' => '.rt__bookmark a',
				'variable' => 'bookmarkInitialCountColor',
			),

			'hover'     => array(
				'selector' => '.rt__bookmark a',
				'variable' => 'bookmarkHoverCountColor',
			),
		),
		'responsive' => true,
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'      => rishi__cb_get_akv('headerBookmarkCountBGColor', $atts),
		'default'    => array(
			'default'   => array('color' => 'var(--paletteColor2)'),
			'hover'     => array('color' => 'var(--paletteColor2)'),
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'variables'  => array(
			'default'   => array(
				'selector' => '.rt__bookmark a',
				'variable' => 'bookmarkInitialCountBgColor',
			),

			'hover'     => array(
				'selector' => '.rt__bookmark a',
				'variable' => 'bookmarkHoverCountBgColor',
			),
		),
		'responsive' => true,
	)
);
