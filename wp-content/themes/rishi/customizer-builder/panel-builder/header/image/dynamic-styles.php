<?php

if (!function_exists('rishi__cb_customizer_assemble_selector')) {
	return;
}

// Image Max Width
$image_max_width = rishi__cb_get_akv( 'header_image_max_width', $atts, 150 );

rishi__cb_customizer_output_responsive([
	'css'          => $css,
	'tablet_css'   => $tablet_css,
	'mobile_css'   => $mobile_css,
	'selector'     => '.header-image-section',
	'variableName' => 'max-width',
	'value'        => $image_max_width,
	'responsive'   => true
]);