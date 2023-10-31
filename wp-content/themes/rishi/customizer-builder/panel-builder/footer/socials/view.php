<?php

$hidden = rishi__cb_customizer_default_akg( 'footer_hide_social', $atts, false );

if ( $hidden ) return '';

$class = trim('cb__footer-socials' . ' ' . rishi__cb_customizer_visibility_classes( rishi__cb_customizer_default_akg(
	'footer_socials_visibility',
	$atts,
	[
		'desktop' => true,
		'tablet' => true,
		'mobile' => true,
	]
)));

$socialsColor = rishi__cb_customizer_default_akg('footerSocialsColor', $atts, 'custom');
$socialsType = rishi__cb_customizer_default_akg('socialsType', $atts, 'simple');

$socials = rishi__cb_customizer_default_akg(
	'footer_socials',
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
