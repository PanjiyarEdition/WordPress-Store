<?php

$hidden = rishi__cb_customizer_default_akg( 'footer_hide_contacts', $atts, false );

if ( $hidden ) return '';

$class = 'cb__contact-info cb__footer-contact-info';

$contact_items = rishi__cb_customizer_default_akg(
	'contact_items',
	$atts,
	[
		[
			'id' => 'email',
			'enabled' => true,
			'title' => __('Email:', 'rishi'),
			'content' => 'contact@yourwebsite.com',
			'link' => 'mailto:contact@yourwebsite.com',
		],

		[
			'id' => 'phone',
			'enabled' => true,
			'title' => __('Phone:', 'rishi'),
			'content' => '123-456-7890',
			'link' => 'tel:123-456-7890',
		],
	]
);

echo rishi__cb_html_tag(
	'div',
	array_merge([
		'class' => $class,
	], $attr),
	rishi__cb_get_contacts_output([
		'data' => $contact_items,
		'link_target' => rishi__cb_customizer_default_akg('link_target', $atts, 'no'),
		'type' => rishi__cb_get_akv('contacts_icon_shape', $atts, 'rounded'),
		'fill' => rishi__cb_get_akv('contacts_icon_fill_type', $atts, 'solid')
	])
);
