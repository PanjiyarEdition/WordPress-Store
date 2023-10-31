<?php


$hidden = rishi__cb_customizer_default_akg( 'header_hide_mobile_menu', $atts, false );

if ( $hidden ) {
	return '';
}

$attr['data-type'] = rishi__cb_customizer_default_akg( 'mobile_menu_type', $atts, 'type-1' );

ob_start();

$menu_args = array();

$rt_menu = rishi__cb_customizer_default_akg( 'menu', $atts, 'rishi__cb_customizer_location' );

if ( $rt_menu !== 'rishi__cb_customizer_location' ) {
	$menu_args['menu'] = $rt_menu;
}

add_filter(
	'nav_menu_item_title',
	'rishi__cb_customizer_handle_nav_menu_item_title',
	10,
	4
);

wp_nav_menu(
	$rt_menu === 'rishi__cb_customizer_location' ? array(
		'container'                   => false,
		'menu_class'                  => false,
		'fallback_cb'                 => 'rishi__cb_customizer_main_menu_fallback',
		'rishi__cb_customizer_advanced_item' => true,
		'theme_location'              => 'menu_mobile',
	) : array_merge(
		array(
			'container'                   => false,
			'menu_class'                  => false,
			'fallback_cb'                 => 'rishi__cb_customizer_main_menu_fallback',
			'rishi__cb_customizer_advanced_item' => true,
		),
		$menu_args
	)
);

remove_filter(
	'nav_menu_item_title',
	'rishi__cb_customizer_handle_nav_menu_item_title',
	10,
	4
);

$menu_output = ob_get_clean();

$class = 'mobile-menu';

if ( strpos( $menu_output, 'sub-menu' ) ) {
	$class .= ' has-submenu';
}

?>

<nav class="<?php echo $class; ?>" <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?>>
	<?php echo $menu_output; ?>
</nav>
