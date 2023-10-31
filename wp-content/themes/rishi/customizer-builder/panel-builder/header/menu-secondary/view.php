<?php


$hidden = rishi__cb_customizer_default_akg( 'header_hide_menu_two', $atts, false );

if ( $hidden ) {
	return '';
}

echo rishi__cb_customizer_render_view(
	\RISHI_CUSTOMIZER_BUILDER_DIR__ . '/panel-builder/header/menu/view.php',
	[
		'atts' => $atts,
		'attr' => $attr,
		'device' => $device,
		'class' => 'header-menu-2',
		'location' => 'menu_2'
	]
);
