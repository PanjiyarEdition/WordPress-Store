<?php


$hidden = rishi__cb_customizer_default_akg( 'header_hide_social', $atts, false );

if ( $hidden ) {
	return '';
}

$class = 'cb__header-socials';

$visibility = rishi__cb_customizer_default_akg('visibility', $atts, [
	'tablet' => true,
	'mobile' => true,
]);

$class .= ' ' . rishi__cb_customizer_visibility_classes($visibility);

$socialsColor = rishi__cb_customizer_default_akg('headerSocialsColor', $atts, 'custom');
$socialsType = rishi__cb_customizer_default_akg('socialsType', $atts, 'simple');

$socials = rishi__cb_customizer_default_akg(
	'header_socials',
	$atts,
	[
		[
			'id' => 'facebook',
			'enabled' => true,
		],

		[
			'id' => 'twitter',
			'enabled' => true,
		],

		[
			'id' => 'instagram',
			'enabled' => true,
		],
	]
);

?>

<div class="<?php echo esc_attr($class) ?>" <?php echo rishi__cb_customizer_attr_to_html($attr) ?>>

	<?php echo rishi__cb_customizer_social_icons($socials, [
		'type' => $socialsType,
		'icons-color' => $socialsColor,
		'fill' => rishi__cb_customizer_default_akg(
			'socialsFillType',
			$atts,
			'solid'
		),
		'hide_labels' => rishi__cb_customizer_some_device( rishi__cb_customizer_default_akg(
			'socialsLabelVisibility',
			$atts,
			[
				'desktop' => false,
				'tablet' => false,
				'mobile' => false,
			]
		))
	]) ?>

</div>
