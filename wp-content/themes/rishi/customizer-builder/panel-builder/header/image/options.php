<?php
$sync_id = 'header_placements_item:image';
if (! isset($panel_type)) {
	$panel_type = 'header';
}
$options = [
    'header_hide_image' => [
		'label' => false,
		'type' => 'hidden',
		'value' => false,
		'sync' => 'live',
		'setting' => [
			'type' => 'option',
		],
		'disableRevertButton' => true,
		'desc' => __('Hide', 'rishi'),
	],
    'rt_header_image' => [
        'label'        => __('Upload Image', 'rishi'),
        'type'         => 'rt-image-uploader',
        'emptyLabel' => __('Select Image', 'rishi'),
		'filledLabel' => __('Change Image', 'rishi'),
        'value'        => '',
        'inline_value' => true,
        'responsive'   => false,
        'attr'         => ['data-type' => 'small'],
        'divider' => 'top',
    ],
    'header_image_max_width' => [
        'label'      => __('Image Max-Width', 'rishi'),
        'type'       => 'rt-slider',
        'min'        => 0,
        'max'        => 300,
        'value'      => 150,
        'responsive' => true,
        'setting' => ['transport' => 'postMessage']
    ],
    'header_image_link' => [
        'label' => __('URL', 'rishi'),
        'type' => 'text',
        'design' => 'inline',
        'value' => '',
    ],
    'header_image_target' => [
        'label' => __('Open in new tab', 'rishi'),
        'type'  => 'rara-switch',
        'value' => 'no',
        'divider' => 'top',
    ],
    'header_image_ed_nofollow' => [
        'label' => __('Set link to nofollow', 'rishi'),
        'type'  => 'rara-switch',
        'value' => 'no',
        'divider' => 'top',
    ],
    'header_image_ed_sponsored' => [
        'label' => __('Set link attribute Sponsored', 'rishi'),
        'type'  => 'rara-switch',
        'value' => 'no',
        'divider' => 'top',
    ]
];