<?php

if (! isset($prefix)) {
	$prefix = '';
} else {
	$prefix = $prefix . '_';
}
$options = [

	$prefix . 'featured_image_ratio' => [
		'label'  => __( 'Image Ratio', 'rishi' ),
		'type'   => 'rt-ratio',
		'value'  => 'original',
		'design' => 'inline',
		'sync'   => 'live',
	],

	rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [$prefix . 'featured_image_ratio' => 'original'],
		'options' => [
			$prefix . 'featured_image_scale' => [
				'label'   => __('Image Scale', 'rishi'),
				'type'    => 'rt-select',
				'value'   => 'contain',
				'view'    => 'text',
				'design'  => 'inline',
				'choices' => rishi__cb_customizer_ordered_keys([
					'contain' => __('Contain', 'rishi'),
					'cover'   => __('Cover', 'rishi'),
					'fill'    => __('Fill', 'rishi'),
				]),
			],
		],
	],

	$prefix . 'featured_image_size' => [
		'label'   => __('Image Size', 'rishi'),
		'type'    => 'rt-select',
		'value'   => 'full',
		'view'    => 'text',
		'design'  => 'inline',
		'choices' => rishi__cb_customizer_ordered_keys( rishi__cb_customizer_get_all_image_sizes())
	],

	$prefix . 'featured_image_visibility' => [
		'label' => __( 'Image Visibility', 'rishi' ),
		'type' => 'rt-visibility',
		'design' => 'block',

		'value' => [
			'desktop' => true,
			'tablet' => true,
			'mobile' => true,
		],

		'choices' => rishi__cb_customizer_ordered_keys([
			'desktop' => __( 'Desktop', 'rishi' ),
			'tablet' => __( 'Tablet', 'rishi' ),
			'mobile' => __( 'Mobile', 'rishi' ),
		]),

		'sync' => 'live'
	]
];
