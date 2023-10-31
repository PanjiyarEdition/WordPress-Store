<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => array_merge([
			'header_hide_bookmark' => [
				'label' => false,
				'type' => 'hidden',
				'value' => false,
				'disableRevertButton' => true,
				'desc' => __('Hide', 'rishi'),
			],
			'header_bookmark_type' => [
				'label' => false,
				'type' => 'rt-image-picker',
				'value' => 'bookmark-one',
				'attr'  => [
					'data-type'    => 'background',
					'data-usage'   => 'readitlater',
					'data-columns' => '3',
				],
				'choices'     => [
					'bookmark-one' => [
						'src'   => rishi__cb_customizer_image_picker_file('bookmark-1'),
						'title' => __('Type 1', 'rishi'),
					],
	
					'bookmark-two' => [
						'src'   => rishi__cb_customizer_image_picker_file('bookmark-2'),
						'title' => __('Type 2', 'rishi'),
					],
	
					'bookmark-three' => [
						'src'   => rishi__cb_customizer_image_picker_file('bookmark-3'),
						'title' => __('Type 3', 'rishi'),
					],
				],
			],	
			'header_bookmark_text' => [
				'label' => __('Bookmark Hover Text', 'rishi'),
				'type' => 'text',
				'design' => 'inline',
				'value' => __('Bookmark', 'rishi'),
			],
			'header_bookmark_size' => [
				'label' => __('Size', 'rishi'),
				'type' => 'rt-slider',
				'min' => 0,
				'max' => 100,
				'value' => 20,
				'responsive' => true,
				'divider' => 'top',
			],
			'bookmark_visibility' => [
				'label' => __('Bookmark Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'allow_empty' => true,
				'sync' => 'live',
				// 'view' => 'modal',
				'value' => [
					'desktop' => true,
					'tablet' => true,
					'mobile' => true,
				],
				'choices' => rishi__cb_customizer_ordered_keys([
					'desktop' => __('Desktop', 'rishi'),
					'tablet' => __('Tablet', 'rishi'),
					'mobile' => __('Mobile', 'rishi'),
				]),
			],
		]),
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [
			'headerBookmarkColor' => [
				'label' => __('Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'block:right',
				'responsive' => true,
				'value' => [
					'default' => [
						'color' => 'var(--paletteColor3)',
					],

					'hover' => [
						'color' => 'var(--paletteColor4)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--bookmarkInitialColor)',
					],

					[
						'title' => __('Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => 'var(--bookmarkHoverColor)',
					],
				],
			],

			'headerBookmarkCountColor' => [
				'label' => __('Count Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'block:right',
				'responsive' => true,
				'value' => [
					'default' => [
						'color' => 'var(--paletteColor5)',
					],

					'hover' => [
						'color' => 'var(--paletteColor5)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--bookmarkCountInitialColor)',
					],

					[
						'title' => __('Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => 'var(--bookmarkCountHoverColor)',
					],
				],
			],

			'headerBookmarkCountBGColor' => [
				'label' => __('Count Background Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'block:right',
				'responsive' => true,
				'value' => [
					'default' => [
						'color' => 'var(--paletteColor2)',
					],

					'hover' => [
						'color' => 'var(--paletteColor2)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--bookmarkCountBgInitialColor)',
					],

					[
						'title' => __('Hover', 'rishi'),
						'id' => 'hover',
						'inherit' => 'var(--bookmarkCountBgHoverColor)',
					],
				],
			],
		],
	],
];