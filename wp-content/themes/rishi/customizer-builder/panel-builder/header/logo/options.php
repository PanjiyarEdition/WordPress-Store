<?php

$options = [
 rishi__cb_customizer_rand_md5() => [
		'title' => __('General', 'rishi'),
		'type' => 'tab',
		'options' => array_merge([
			
			'header_hide_logo' => [
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
			'custom_logo' => [
				'label' => __('Logo', 'rishi'),
				'type' => 'rt-image-uploader',
				'value' => '',
				'inline_value' => true,
				'responsive' => [
					'tablet' => 'skip'
				],
				'attr' => ['data-type' => 'small'],
			],

			'logo_type' => [
				'label'   => __('Logo Style', 'rishi'),
				'type'    => 'rt-radio',
				'value'   => 'logo-title',
				'view'    => 'text',
				'design'  => 'block',
				'divider' => 'top',
				'setting' => ['transport' => 'postMessage'],
				'choices' => [
					'logo' => __('Logo', 'rishi'),
					'logo-title' => __('Logo & title', 'rishi'),
					'logo-title-tagline' => __('Logo, title & tagline', 'rishi'),
				],
			],
		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'logo_type' => 'logo-title'
				],
				'options' => array_merge([
					'logo_title_layout' => [
						'type'    => 'rt-image-picker',
						'label'   => __('Site Logo and Title Layout', 'rishi'),
						'value'   => 'logotitle',
						'attr'  => [
							'data-type'    => 'background',
							'data-usage'   => 'logotitle',
							'data-columns' => '2',
						],
						'choices' => [
							'logotitle' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title-layout-1"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title-layout-1" clip-path="url(#clip-Logo-title-layout-1)"><g id="Group_5803" data-name="Group 5803" transform="translate(0 16)"><g id="Group_5801" data-name="Group 5801" transform="translate(-14.691 3)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/></g><g id="Group_5802" data-name="Group 5802"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g></g></g></svg>',
								'title' => __('Logo & Title', 'rishi'),
							],

							'titlelogo' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title-layout-2"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title-layout-2" clip-path="url(#clip-Logo-title-layout-2)"><g id="Group_5803" data-name="Group 5803" transform="translate(0 16)"><g id="Group_5802" data-name="Group 5802" transform="translate(123)"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g><g id="Group_5801" data-name="Group 5801" transform="translate(-94.691 3)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/></g></g></g></svg>',
								'title' => __('Title & Logo', 'rishi'),
							],

							'logouptitle' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title-layout-3"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title-layout-3" clip-path="url(#clip-Logo-title-layout-3)"><g id="Group_5803" data-name="Group 5803" transform="translate(40)"><g id="Group_5801" data-name="Group 5801" transform="translate(-94.691 61)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/></g><g id="Group_5802" data-name="Group 5802" transform="translate(22)"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g></g></g></svg>',
								'title' => __('Logo up Title', 'rishi'),
							],

							'logodowntitle' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title-layout-4"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title-layout-4" clip-path="url(#clip-Logo-title-layout-4)"><g id="Group_5803" data-name="Group 5803" transform="translate(40)"><g id="Group_5802" data-name="Group 5802" transform="translate(22 37)"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g><g id="Group_5801" data-name="Group 5801" transform="translate(-94.691 -19)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/></g></g></g></svg>',
								'title' => __('Logo Down Title', 'rishi'),
							],
						],
					],
				]),
			],
		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'logo_type' => 'logo-title-tagline'
				],
				'options' => array_merge([
					'logo_title_tagline_layout' => [
						'label'   => __('Site Logo, Title and Tagline Layout', 'rishi'),
						'type'    => 'rt-image-picker',
						'value'   => 'logotitletagline',
						'attr'  => [
							'data-usage'   => 'logotitletagline'
						],
						'choices' => [
							'logotitletagline' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title_tagline-layout-1"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title_tagline-layout-1" data-name="Logo-title&amp;tagline-layout-1" clip-path="url(#clip-Logo-title_tagline-layout-1)"><g id="Group_5803" data-name="Group 5803" transform="translate(0 16)"><g id="Group_5801" data-name="Group 5801" transform="translate(-14.691 -6)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1241" data-name="Rectangle 1241" width="88" height="10" transform="translate(110.691 75)" fill="#566779" opacity="0.2"/></g><g id="Group_5802" data-name="Group 5802"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g></g></g></svg>',
								'title' => __('Logo & Title Tagline', 'rishi'),
							],

							'titletaglinelogo' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title_tagline-layout-2"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title_tagline-layout-2" data-name="Logo-title&amp;tagline-layout-2" clip-path="url(#clip-Logo-title_tagline-layout-2)"><g id="Group_5803" data-name="Group 5803" transform="translate(0 16)"><g id="Group_5802" data-name="Group 5802" transform="translate(123)"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g><g id="Group_5801" data-name="Group 5801" transform="translate(-94.691 -6)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1241" data-name="Rectangle 1241" width="88" height="10" transform="translate(110.691 75)" fill="#566779" opacity="0.2"/></g></g></g></svg>',
								'title' => __('Title Tagline & Logo', 'rishi'),
							],

							'logouptitletagline' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title_tagline-layout-3"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title_tagline-layout-3" data-name="Logo-title&amp;tagline-layout-3" clip-path="url(#clip-Logo-title_tagline-layout-3)"><g id="Group_5803" data-name="Group 5803" transform="translate(40 -11)"><g id="Group_5801" data-name="Group 5801" transform="translate(-94.691 61)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1241" data-name="Rectangle 1241" width="88" height="10" transform="translate(120.691 75)" fill="#566779" opacity="0.2"/></g><g id="Group_5802" data-name="Group 5802" transform="translate(22)"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g></g></g></svg>',
								'title' => __('Logo up Title Tagline', 'rishi'),
							],

							'logodowntitletagline' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title_tagline-layout-5"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title_tagline-layout-5" data-name="Logo-title&amp;tagline-layout-5" clip-path="url(#clip-Logo-title_tagline-layout-5)"><g id="Group_5803" data-name="Group 5803" transform="translate(39 -11)"><g id="Group_5802" data-name="Group 5802" transform="translate(22 54)"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(16 27)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(30 41.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g><g id="Group_5801" data-name="Group 5801" transform="translate(-93.691 -19)"><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(110.691 46)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1241" data-name="Rectangle 1241" width="88" height="10" transform="translate(120.691 75)" fill="#566779" opacity="0.2"/></g></g></g></svg>',
								'title' => __('Logo Down Title Tagline', 'rishi'),
							],
							'titlelogotagline' => [
								'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="150" viewBox="0 0 219 150"><defs><clipPath id="clip-Logo-title_tagline-layout-4"><rect width="219" height="150"/></clipPath></defs><g id="Logo-title_tagline-layout-4" data-name="Logo-title&amp;tagline-layout-4" clip-path="url(#clip-Logo-title_tagline-layout-4)"><g id="Group_5805" data-name="Group 5805" transform="translate(0 -6)"><rect id="Rectangle_1241" data-name="Rectangle 1241" width="88" height="10" transform="translate(66 132)" fill="#566779" opacity="0.2"/><g id="Group_5804" data-name="Group 5804" transform="translate(0 -20)"><g id="Rectangle_405" data-name="Rectangle 405" transform="translate(78 75)" fill="#fff" stroke="#566779" stroke-width="3" opacity="0.3"><rect width="65" height="65" rx="20" stroke="none"/><rect x="1.5" y="1.5" width="62" height="62" rx="18.5" fill="none"/></g><g id="star" transform="translate(92 89.548)"><path id="Path_23078" data-name="Path 23078" d="M16.424.945l3.99,9.443,10.214.877a.805.805,0,0,1,.459,1.41l-7.748,6.712,2.322,9.986a.8.8,0,0,1-1.2.871L15.684,24.95,6.906,30.244a.8.8,0,0,1-1.2-.871l2.322-9.986L.279,12.674a.8.8,0,0,1,.459-1.41l10.214-.877L14.941.945a.8.8,0,0,1,1.483,0Z" transform="translate(2.659 2.536)" fill="#566779" opacity="0.7"/></g></g><rect id="Rectangle_849" data-name="Rectangle 849" width="108" height="22" transform="translate(56 21)" fill="#566779" opacity="0.4"/></g></g></svg>',
								'title' => __('Title Logo Tagline', 'rishi'),
							],
						],
					],
				]),
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'builderSettings/has_transparent_header' => 'yes',
				],
				'options' => [
					'transparent_logo' => [
						'label' => __('Transparent State Logo', 'rishi'),
						'type' => 'rt-image-uploader',
						'value' => '',
						'inline_value' => true,
						'responsive' => [
							'tablet' => 'skip'
						],
						'divider' => 'top',
						'attr' => ['data-type' => 'small'],
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'builderSettings/has_sticky_header' => 'yes',
				],
				'options' => [
					'sticky_logo' => [
						'label' => __('Sticky State Logo', 'rishi'),
						'type' => 'rt-image-uploader',
						'value' => '',
						'inline_value' => true,
						'responsive' => [
							'tablet' => 'skip'
						],
						'divider' => 'top',
						'attr' => ['data-type' => 'small'],
					],
				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'logoMaxWidth' => [
				'label'      => __('Logo Max-Width', 'rishi'),
				'type'       => 'rt-slider',
				'min'        => 0,
				'max'        => 300,
				'value'      => 150,
				'responsive' => true,
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'builderSettings/has_sticky_header' => 'yes',
					'row' => 'middle-row'
				],
				'options' => [
				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

					'has_sticky_logo_shrink' => [
						'label' => __('Sticky State Shrink', 'rishi'),
						'type' => 'rara-switch',
						'value' => 'no',
						'sync' => [
							'id' => 'header_placements_1'
						]
					],
				]
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => [
					'builderSettings/has_sticky_header' => 'yes',
					'row' => 'middle-row',
					'has_sticky_logo_shrink' => 'yes'
				],
				'options' => [

					'sticky_logo_shrink' => [
						'label' => __('Logo Height', 'rishi'),
						'type' => 'rt-slider',
						'min' => 30,
						'max' => 100,
						'responsive' => true,
						'value' => 70,
						'defaultUnit' => '%',
						'sync' => [
							'id' => 'header_placements_1'
						],
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'has_site_title' => [
				'label' => __('Site Title', 'rishi'),
				'type' => 'rara-switch',
				'value' => 'yes',
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['has_site_title' => 'yes'],
				'options' => [

					'blogname' => [
						'label' => false,
						'type' => 'text',
						'design' => 'block',
						'disableRevertButton' => true,
						'value' => get_option('blogname'),
						'disableRevertButton' => true,
					],

					'blogname_visibility' => [
						'label' => __('Site Title Visibility', 'rishi'),
						'type' => 'rt-visibility',
						'design' => 'block',
						'allow_empty' => true,
						'sync' => 'live',
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
				'type' => 'rt-divider',
			],

			'has_tagline' => [
				'label' => __('Site Tagline', 'rishi'),
				'type' => 'rara-switch',
				'value' => 'no',
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['has_tagline' => 'yes'],
				'options' => [

					'blogdescription' => [
						'label' => false,
						'type' => 'text',
						'design' => 'block',
						'disableRevertButton' => true,
						'value' => get_option('blogdescription'),
					],

					'blogdescription_visibility' => [
						'label' => __('Site Tagline Visibility', 'rishi'),
						'type' => 'rt-visibility',
						'design' => 'block',
						'allow_empty' => true,
						'sync' => 'live',

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
                'type' => 'rt-title',
				'desc' => sprintf(
					__('Configure Site Favicon from %1$shere%2$s.', 'rishi'),
					sprintf(
						'<a href="%s" data-trigger-section="title_tagline">',
						admin_url('/customize.php?autofocus[section]=title_tagline')
					),
					'</a>'
				),
            ],
		], $panel_type === 'footer' ? [
		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'footer_logo_horizontal_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Horizontal Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'responsive' => true,
				'attr' => ['data-type' => 'alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'flex-start',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

			'footer_logo_vertical_alignment' => [
				'type' => 'rt-radio',
				'label' => __('Vertical Alignment', 'rishi'),
				'view' => 'text',
				'design' => 'block',
				'divider' => 'top',
				'responsive' => true,
				'attr' => ['data-type' => 'vertical-alignment'],
				'setting' => ['transport' => 'postMessage'],
				'value' => 'CT_CSS_SKIP_RULE',
				'choices' => [
					'flex-start' => '',
					'center' => '',
					'flex-end' => '',
				],
			],

			'visibility' => [
				'label' => __('Element Visibility', 'rishi'),
				'type' => 'rt-visibility',
				'design' => 'block',
				'divider' => 'top',
				'sync' => 'live',
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
		] : []),
	],

 rishi__cb_customizer_rand_md5() => [
		'title' => __('Design', 'rishi'),
		'type' => 'tab',
		'options' => [

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['has_site_title' => 'yes'],
				'options' => [

					'siteTitle' => [
						'type' => 'rt-typography',
						'label' => __('Site Title', 'rishi'),
						'value' => rishi__cb_customizer_typography_default_values([
							'size' => '27px',
							'variation' => 'n7',
							'letter-spacing' => '0em',
							'text-transform' => 'none',
							'text-decoration' => 'none',
						]),
						'setting' => ['transport' => 'postMessage'],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'cb__labeled-group',
						'label' => __('Site Title Color', 'rishi'),
						'responsive' => true,
						'choices' => [
							[
								'id' => 'siteTitleColor',
								'label' => __('Default State', 'rishi')
							],

							[
								'id' => 'transparentSiteTitleColor',
								'label' => __('Transparent State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_transparent_header' => 'yes',
								],
							],

							[
								'id' => 'stickySiteTitleColor',
								'label' => __('Sticky State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_sticky_header' => 'yes',
								],
							],
						],
						'options' => [

							'siteTitleColor' => [
								'label' => __('Site Title Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'responsive' => true,
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => $panel_type === 'footer' ? 'var(--paletteColor5)' : 'var(--paletteColor2)',
									],

									'hover' => [
										'color' => 'var(--paletteColor3)',
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
										'inherit' => 'var(--linkHoverColor)'
									],
								],
							],

							'transparentSiteTitleColor' => [
								'label' => __('Site Title Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'responsive' => true,
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => 'var(--paletteColor2)',
									],

									'hover' => [
										'color' => 'var(--paletteColor3)',
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
									],
								],
							],

							'stickySiteTitleColor' => [
								'label' => __('Site Title Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'responsive' => true,
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => 'var(--paletteColor2)',
									],

									'hover' => [
										'color' => 'var(--paletteColor3)',
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],

									[
										'title' => __('Hover', 'rishi'),
										'id' => 'hover',
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

				],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-condition',
				'condition' => ['has_tagline' => 'yes'],
				'options' => [

					'siteTagline' => [
						'type' => 'rt-typography',
						'label' => __('Site Tagline Font', 'rishi'),
						'value' => rishi__cb_customizer_typography_default_values([
							'size' => '13px',
							'variation' => 'n5',
						]),
						'setting' => ['transport' => 'postMessage'],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'cb__labeled-group',
						'label' => __('Site Tagline Color', 'rishi'),
						'responsive' => true,
						'choices' => [
							[
								'id' => 'siteTaglineColor',
								'label' => __('Default State', 'rishi')
							],

							[
								'id' => 'transparentSiteTaglineColor',
								'label' => __('Transparent State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_transparent_header' => 'yes',
								],
							],

							[
								'id' => 'stickySiteTaglineColor',
								'label' => __('Sticky State', 'rishi'),
								'condition' => [
									'row' => '!offcanvas',
									'builderSettings/has_sticky_header' => 'yes',
								],
							],
						],
						'options' => [

							'siteTaglineColor' => [
								'label' => __('Site Tagline Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'responsive' => true,
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => 'var(--paletteColor1)',
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
										'inherit' => 'var(--color)'
									],
								],
							],

							'transparentSiteTaglineColor' => [
								'label' => __('Site Tagline Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'responsive' => true,
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],
								],
							],

							'stickySiteTaglineColor' => [
								'label' => __('Site Tagline Color', 'rishi'),
								'type'  => 'rt-color-picker',
								'design' => 'block:right',
								'responsive' => true,
								'setting' => ['transport' => 'postMessage'],

								'value' => [
									'default' => [
										'color' => \Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT'),
									],
								],

								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id' => 'default',
									],
								],
							],

						],
					],

				 rishi__cb_customizer_rand_md5() => [
						'type' => 'rt-divider',
					],

				],
			],

			'headerLogoMargin' => [
				'label' => __('Margin', 'rishi'),
				'type' => 'rt-spacing',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_spacing_value([
					'linked' => false,
					'top' => '0',
					'left' => '0',
					'right' => '0',
					'bottom' => '0',
				]),
				'responsive' => true
			],

		],
	],
];
