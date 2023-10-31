<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => [
			'footer_hide_copyright' => [
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

			'copyright_text' => [
				'label' => __('Copyright text', 'rishi'),
				'type' => 'wp-editor',
				'value' => __('Copyright &copy; {current_year} {site_title} - Powered by {theme_author}', 'rishi'),
				'desc' => __('You can insert some arbitrary HTML code tags: {current_year}, {site_title} and {theme_author}', 'rishi'),
				'disableRevertButton' => true,
				'setting' => ['transport' => 'postMessage'],

				'quicktags' => false,
				'mediaButtons' => false,
				'tinymce' => [
					'toolbar1' => 'bold,italic,link,undo,redo',
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footerCopyrightAlignment' => [
				'type' => 'rt-radio',
				'label' => __('Horizontal Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'disableRevertButton' => true,
				'responsive' => true,
				'attr' => ['data-type' => 'alignment'],
				'setting' => ['transport' => 'postMessage'],

				'choices' => [
					'left' => '',
					'center' => '',
					'right' => '',
				],

				'value' => [
					'desktop' => 'center',
					'tablet' => 'center',
					'mobile' => 'center'
				],
			],

			'footerCopyrightVerticalAlignment' => [
				'type' => 'rt-radio',
				'label' => __('Vertical Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'divider' => 'top',
				'disableRevertButton' => true,
				'responsive' => true,
				'attr' => ['data-type' => 'vertical-alignment'],
				'setting' => ['transport' => 'postMessage'],

				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],

				'value' => [
					'desktop' => 'flex-start',
					'tablet' => 'flex-start',
					'mobile' => 'flex-start'
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footer_copyright_visibility' => [
				'label' => __('Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				// 'allow_empty' => true,
				'setting' => ['transport' => 'postMessage'],
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

		],
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

			'copyrightFont' => [
				'type' => 'rt-typography',
				'label' => __('Font', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size' => '14px',
					'variation' => 'n4',
					'line-height' => '1.75',
					'letter-spacing  : 0.6px'
				]),
				'setting' => ['transport' => 'postMessage'],
			],

			'copyrightColor' => [
				'label' => __('Font Color', 'rishi'),
				'type'  => 'rt-color-picker',
				'design' => 'block:right',
				'responsive' => true,
				'setting' => ['transport' => 'postMessage'],

				'value' => [
					'default' => [
						'color' => 'rgba(255,255,255,0.6)',
					],

					'link_initial' => [
						'color' => 'var(--paletteColor5)',
					],

					'link_hover' => [
						'color' => 'var(--paletteColor3)',
					],
				],

				'pickers' => [
					[
						'title' => __('Initial', 'rishi'),
						'id' => 'default',
						'inherit' => 'var(--color)'
					],

					[
						'title' => __('Link Initial', 'rishi'),
						'id' => 'link_initial',
						'inherit' => 'var(--linkInitialColor)'
					],

					[
						'title' => __('Link Hover', 'rishi'),
						'id' => 'link_hover',
						'inherit' => 'var(--linkHoverColor)'
					],
				],
			],

			'copyrightMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => true,
				]),
				'responsive' => true
			],

		],
	],
];
