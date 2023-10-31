<?php

$hidden = rishi__cb_customizer_default_akg( 'footer_hide_menu_one', $atts, false );

if ( $hidden ) return '';

if (!isset($location)) {
	$location = 'footer';
}

if (empty($class)) {
	$class = 'footer-menu';
}

$class .= ' ' . rishi__cb_customizer_visibility_classes( rishi__cb_customizer_default_akg(
	'footer_menu_visibility',
	$atts,
	[
		'desktop' => true,
		'tablet' => true,
		'mobile' => true,
	]
));

$stretch_output = '';

if ( rishi__cb_customizer_default_akg('stretch_menu', $atts, 'no') === 'yes') {
	$stretch_output = 'data-stretch';
}

$menu_args = [
	'container' => false,
	'menu_class' => 'menu',
	'depth' => 1,
	'fallback_cb' => 'rishi__cb_customizer_main_menu_fallback',
	'rishi__cb_customizer_advanced_item' => true,
	'theme_location' => $location
];

$rt_menu = rishi__cb_customizer_default_akg('menu', $atts, 'rishi__cb_customizer_location');

if ($rt_menu !== 'rishi__cb_customizer_location') {
	$menu_args['menu'] = $rt_menu;
}

ob_start();
wp_nav_menu($rt_menu === 'rishi__cb_customizer_location' ? [
	'container' => false,
	'menu_class' => 'menu',
	'depth' => 1,
	'fallback_cb' => 'rishi__cb_customizer_main_menu_fallback',
	'rishi__cb_customizer_advanced_item' => true,
	'theme_location' => $location
] : array_merge([
	'container' => false,
	'menu_class' => 'menu',
	'depth' => 1,
	'fallback_cb' => 'rishi__cb_customizer_main_menu_fallback',
	'rishi__cb_customizer_advanced_item' => true,
], $menu_args));
$menu_content = ob_get_clean();

?>

<nav id="<?php echo esc_attr($class) ?>" class="<?php echo esc_attr($class) ?>" <?php echo rishi__cb_customizer_attr_to_html($attr) ?> <?php echo esc_attr( $stretch_output ) ?> <?php echo rishi__cb_customizer_schema_org_definitions('navigation') ?>>

	<?php echo $menu_content; ?>
</nav>
