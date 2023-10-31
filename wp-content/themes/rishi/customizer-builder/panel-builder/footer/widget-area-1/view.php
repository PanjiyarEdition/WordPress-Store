<?php

$hidden = rishi__cb_customizer_default_akg( 'footer_hide_widget_one', $atts, false );

if ( $hidden ) return '';

if (!isset($class)) {
	$class = 'footer-one';
}

if (!isset($sidebar)) {
	$sidebar = 'footer-one';
}

dynamic_sidebar($sidebar);
