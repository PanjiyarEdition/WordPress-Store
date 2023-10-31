<?php
$options = [

	'has_sticky_header' => [
		'label' => __( 'Sticky Header', 'rishi-companion' ),
		'type' => 'rara-switch',
		'value' => 'no',

		'sync' => [
			'id' => 'header_placements_1'
		]
	],

	rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [ 'has_sticky_header' => 'yes' ],
		'options' => [

			'sticky_rows' => [
				'label' => false,
				'type' => 'rt-image-picker',
				'value' => 'middle',
				'design' => 'block',
				'sync' => [
					'id' => 'header_placements_1'
				],
				'attr'                 => [
					'data-usage' => 'sticky-header-type',
				],

				'choices' => [
					'middle' => [
						'src' => rishi__cb_customizer_image_picker_url('sticky-main.svg'),
						'title' => __('Only Main Row', 'rishi-companion'),
					],

					'top_middle' => [
						'src' => rishi__cb_customizer_image_picker_url('sticky-top-main.svg'),
						'title' => __('Top & Main Row', 'rishi-companion'),
					],

					'entire_header' => [
						'src' => rishi__cb_customizer_image_picker_url('sticky-all.svg'),
						'title' => __('All Rows', 'rishi-companion'),
					],

					'middle_bottom' => [
						'src' => rishi__cb_customizer_image_picker_url('sticky-main-bottom.svg'),
						'title' => __('Main & Bottom Row', 'rishi-companion'),
					],

					'top' => [
						'src' => rishi__cb_customizer_image_picker_url('sticky-top.svg'),
						'title' => __('Only Top Row', 'rishi-companion'),
					],

					'bottom' => [
						'src' => rishi__cb_customizer_image_picker_url('sticky-bottom.svg'),
						'title' => __('Only Bottom Row', 'rishi-companion'),
					],
				],
			],

			'sticky_behaviour' => [
				'label' => __( 'Enable on', 'rishi-companion' ),
				'type' => 'rt-visibility',
				'design' => 'block',
				'value' => [
					'desktop' => true,
					// 'tablet' => true,
					'mobile' => true,
				],

				'choices' => rishi__cb_customizer_ordered_keys([
					'desktop' => __('Desktop', 'rishi-companion'),
					// 'tablet' => __('Tablet', 'rishi-companion'),
					'mobile' => __('Mobile', 'rishi-companion'),
				]),

				'sync' => [
					'id' => 'header_placements_1'
				],
			],
		],
	],

	rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-divider',
	],

	'has_transparent_header' => [
		'label' => __( 'Transparent Header', 'rishi-companion' ),
		'type' => 'rara-switch',
		'value' => 'no',
		'sync' => [
			'id' => 'header_placements_1'
		]
	],

	rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [
			'has_transparent_header' => 'yes',
			// 'id' => 'type-1'
		],
		'options' => [
			'transparent_conditions' => [
				'type' => 'rishi-display-condition',
				'value' => [
					[
						'type' => 'include',
						'rule' => 'everywhere'
					],

					[
						'type' => 'exclude',
						'rule' => '404'
					],

					[
						'type' => 'exclude',
						'rule' => 'search'
					],

					[
						'type' => 'exclude',
						'rule' => 'archives'
					]
				],
				'label' => __( 'Display Conditions', 'rishi-companion' ),
				'display' => 'modal',
				'design' => 'block',
				// 'divider' => 'top',
				'sync' => [
					'id' => 'header_placements_1'
				]
			],
		]
	],

	rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-condition',
		'condition' => [ 'has_transparent_header' => 'yes' ],
		'options' => [
			'transparent_behaviour' => [
				'label' => __( 'Enable on', 'rishi-companion' ),
				'type' => 'rt-visibility',
				'design' => 'block',
				'sync' => 'live',
				'value' => [
					'desktop' => true,
					// 'tablet' => true,
					'mobile' => true,
				],

				'choices' => rishi__cb_customizer_ordered_keys([
					'desktop' => __('Desktop', 'rishi-companion'),
					// 'tablet' => __('Tablet', 'rishi-companion'),
					'mobile' => __('Mobile', 'rishi-companion'),
				]),
			],

		],
	],

];
