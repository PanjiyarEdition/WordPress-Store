<?php

$options = [
	'title' 	=> __('Performance', 'rishi-companion'),
	'container' => ['priority' => 8],
	'options' 	=> [
		'performance_section_options' => [
			'type' => 'rt-options',
			'setting' => ['transport' => 'postMessage'],
			'inner-options' => [
				apply_filters(
					'rishi__cb_customizer_performance_end_customizer_options',
					[]
				),
				'performance_images_listing_panel' => [
					'label' => __('Images', 'travel-monster'),
					'type' => 'rt-panel',
					'value' => 'yes',
					'wrapperAttr' => ['data-panel' => 'only-arrow'],
					'inner-options' => [
						'has_lazy_load' => [
							'label' => __('Lazy Load Images', 'rishi-companion'),
							'type' => 'rara-switch',
							'value' => 'yes',
							'setting' => ['transport' => 'postMessage'],
							'desc' => __('This option will be auto disabled if you have JetPack\'s lazy load option enabled.', 'rishi-companion'),
						],
						'exclude_lazy_load_images' => [
							'label' => __('Exclude Lazy Load Images', 'rishi-companion'),
							'type' => 'rara-switch',
							'value' => 'no',
							'setting' => ['transport' => 'postMessage'],
						],
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['exclude_lazy_load_images' => 'yes'],
							'options' => [
								'exclude_leading_images' => [
									'label'   => __('Exclude Above-the-fold Images', 'rishi-companion'),
									'desc'    => __('Select the number of Above-the-fold images you want to exlude from lazy loading.', 'rishi-companion'),
									'type'    => 'rt-number',
									'design'  => 'inline',
									'value'   => 3,
									'min'     => 0,
									'divider' => 'top',
									'responsive' => false,
								],
							]
						],	
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['exclude_lazy_load_images' => 'yes'],
							'options' => [
								'excluded_images_list' => [
									'label'   => __('Excluded images list', 'rishi-companion'),
									'desc'    => __('Specify keywords (e.g. image filename, CSS class, domain) from the image to be excluded (one per line).', 'rishi-companion'),
									'type' 	  => 'textarea',
								],
							],
						],	
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['has_lazy_load' => 'yes'],
							'options' => [
								'lazy_load_type' => [
									'label' => __('Images Loading Animation Type', 'rishi-companion'),
									'type' => 'rt-radio',
									'value' => 'fade',
									'view' => 'text',
									'choices' => [
										'fade' => __('Fade', 'rishi-companion'),
										'circle' => __('Circles', 'rishi-companion'),
										'none' => __('None', 'rishi-companion'),
									],
								],
							],
						],
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['has_lazy_load' => 'yes'],
							'options' => [
								'lazy_load_featured_img' => [
									'label' => __('Disable Lazy Load on Featured Image', 'rishi-companion'),
									'desc'    => __('This option will disable lazy loading for the featured image on single post.', 'rishi-companion'),
									'type'    => 'rara-switch',
									'value'   => 'no',
								],
							],
						],			
						'lightbox_for_img' => [
							'label'   => __('Lightbox for Images and Galleries', 'rishi-companion'),
							'desc'    => __('This settings will enable the lightbox feature for your images.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'responsive_images' => [
							'label'   => __('Disable Responsive Images', 'rishi-companion'),
							'desc'    => __('Enable this option to disable responsive images on your website.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'missing_img_dimensions' => [
							'label'   => __('Add Missing Image Dimensions', 'rishi-companion'),
							'desc'    => __('This features add width and height attributes to the images to improve the CLS.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'featured_image' => [
							'label'   => __('Image Dimensions', 'rishi-companion'),
							'desc'    => __('This option will enable the crop size for the featured images. You can disable the ones that you are not using to save your hosting space.', 'rishi-companion'),
							'type'    => 'rt-title',
							'value'   => 'no',
							'divider' => 'top',
						],						
						'featured_image_360_240' => [
							'label'   => __('360x240', 'rishi-companion'),
							'desc'    => __('This image size is used on blog and archive pages.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'yes',
						],
						'featured_image_750_520' => [
							'label'   => __('750x520', 'rishi-companion'),
							'desc'    => __('This image size is used on single post with a sidebar.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'yes',
						],
						'featured_image_1170_650' => [
							'label'   => __('1170x650', 'rishi-companion'),
							'desc'    => __('This image size is used on single post without a sidebar.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'yes',
						],
					],
				],

				'performance_wordpress_listing_panel' => [
					'label' => __('WordPress', 'travel-monster'),
					'type' => 'rt-panel',
					'value' => 'yes',
					'wrapperAttr' => ['data-panel' => 'only-arrow'],
					'inner-options' => [
						'ed_favicon' => [
							'label'   => __('Prevent Automatic Favicon Request', 'rishi-companion'),
							'desc'    => __('Disable the automatic favicon request to speed up your site.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'yes',
							'divider' => 'top',
						],
						'ed_emoji' => [
							'label'   => __('Remove Emojis from frontend', 'rishi-companion'),
							'desc'    => __('Removes WordPress Emojis JavaScript file (wp-emoji-release.min.js).', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_self_pingbacks' => [
							'label'   => __('Disable Self Pingbacks', 'rishi-companion'),
							'desc'    => __('Disable Self Pingbacks (generated when linking to an article on your own blog).', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_rssfeed' => [
							'label'   => __('Disable RSS Feeds', 'rishi-companion'),
							'desc'    => __('Disable WordPress generated RSS feeds and 301 redirect URL to parent.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_rssfeed_links' => [
							'label'   => __('Remove RSS Feed Links', 'rishi-companion'),
							'desc'    => __('Disable WordPress generated RSS feed link tags.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_embeds' => [
							'label'   => __('Disable WordPress Embeds', 'rishi-companion'),
							'desc'    => __('Removes WordPress Embeds Javascript file.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_local_gravatar' => [
							'label'   => __('Local Gravatars', 'rishi-companion'),
							'desc'    => __('It will enable to load Gravatars from your servers (instead of making requests to the Gravatar site), to improve loading time.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
					],
				],
				'performance_cssandjs_listing_panel' => [
					'label' => __('CSS/JS Optimization', 'travel-monster'),
					'type' => 'rt-panel',
					'value' => 'yes',
					'wrapperAttr' => ['data-panel' => 'only-arrow'],
					'inner-options' => [
						'ed_ver' => [
							'label'   => __('Remove "ver" parameter from CSS and JS file calls.', 'rishi-companion'),
							'desc'    => __('Removes version query strings from your static resources to improve the caching of those resources.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_gutenberg_style' => [
							'label'   => __('Disable Gutenberg style on Page Builder', 'rishi-companion'),
							'desc'    => __('Disable the block style css on the page built with Elementor.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_preload_css' => [
							'label'   => __('Preload CSS', 'rishi-companion'),
							'desc'    => __('Preloading your CSS helps the pages load quicker.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
						'ed_js_optimization' => [
							'label'   => __('JavaScript Optimization', 'rishi-companion'),
							'desc'    => __('Manage Javascript files loading on your site.', 'rishi-companion'),
							'type'    => 'rt-title',
							'divider' => 'top',
						],
						'ed_defer_js' => [
							'label'   => __('Defer JavaScript Files', 'rishi-companion'),
							'desc'    => __('Defer loading of render-blocking JavaScript files for faster website loading.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['ed_defer_js' => 'yes'],
							'options' => [
								'excluded_js_list' => [
									'label'   => __('Deferred Excluded JavaScript Files', 'rishi-companion'),
									'desc'    => __('Specify JavaScript files to be excluded from defer (one per line).', 'rishi-companion'),
									'type' 	  => 'textarea',
									'value'   => 'jQuery.min.js',
								]
							]
						],
						'ed_delay_js' => [
							'label'   => __('Delay JavaScript Files', 'rishi-companion'),
							'desc'    => __('It Improves the loading speed by delaying the loading of JS files until user interaction such as click, scroll, etc.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['ed_delay_js' => 'yes'],
							'options' => [
								'delay_behaviour' => [
									'label'	  => __('Delay Behaviour', 'rishi-companion'),
									'type'	  => 'rt-select',
									'choices' => [
										'all_scripts' 		=> __('All Scripts', 'rishi-companion'),
										'specific_scripts' 	=> __('Specific Scripts', 'rishi-companion'),
									],
									'value'	  => 'all_scripts',
								],
							]
						],
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['ed_delay_js' => 'yes', 'delay_behaviour' => 'all_scripts'],
							'options' => [
								'excluded_delay_list' => [
									'label'   => __('Excluded from Delay', 'rishi-companion'),
									'desc'    => __('Specify JavaScript files to be excluded from delaying execution (one per line).', 'rishi-companion'),
									'type' 	  => 'textarea',
								],
							],
						],
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['ed_delay_js' => 'yes', 'delay_behaviour' => 'specific_scripts'],
							'options' => [
								'included_delay_list' => [
									'label'   => __('Delayed Scripts', 'rishi-companion'),
									'desc'    => __('Specify JavaScript files to be included while delaying execution (one per line).', 'rishi-companion'),
									'type' 	  => 'textarea',
								],
							],
						],
						rishi__cb_customizer_rand_md5() => [
							'type' => 'rt-condition',
							'condition' => ['ed_delay_js' => 'yes'],
							'options' => [
								'delay_timeout' => [
									'label'   => __('Delay Timeout', 'rishi-companion'),
									'desc'    => __('Set the time to load the delayed scripts if no user interaction is detected.', 'rishi-companion'),
									'type' 	  => 'rt-select',
									'choices' => [
										'none'  => __('None', 'rishi-companion'),
										'1' 	=> __('One second', 'rishi-companion'),
										'2'		=> __('Two seconds', 'rishi-companion'),
										'3' 	=> __('Three seconds', 'rishi-companion'),
										'4' 	=> __('Four seconds', 'rishi-companion'),
										'5' 	=> __('Five seconds', 'rishi-companion'),
										'6' 	=> __('Six seconds', 'rishi-companion'),
										'7' 	=> __('Seven seconds', 'rishi-companion'),
										'8' 	=> __('Eight seconds', 'rishi-companion'),
										'9' 	=> __('Nine seconds', 'rishi-companion'),
										'10' 	=> __('Ten seconds', 'rishi-companion'),
									],
									'value'	=> 'none'
								],
							]
						],
					],
				],
				'performance_fonts_listing_panel' => [
					'label' => __('Fonts', 'travel-monster'),
					'type' => 'rt-panel',
					'value' => 'yes',
					'wrapperAttr' => ['data-panel' => 'only-arrow'],
					'inner-options' => [
						'ed_display_swap' => [
							'label'   => __('Display Swap', 'rishi-companion'),
							'desc'    => __('It adds font display swap property to your Google fonts to improve its rendering.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'yes',
						],
						'ed_google_fonts_local' => [
							'label'   => __('Load Google Fonts Locally', 'rishi-companion'),
							'desc'    => __('This will load Google fonts from your server to speed up your site.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						rishi__cb_customizer_rand_md5() => [
							'type'      => 'rt-condition',
							'condition' => [ 'ed_google_fonts_local' => 'yes'],
							'options'   => [
								'ed_preload_local_fonts' => [
									'label'   => __( 'Preload Local Fonts', 'rishi' ),
									'desc'    => __( 'Preloading Google fonts will speed up your website speed.', 'rishi-companion'),
									'type'    => 'rara-switch',
									'value'   => 'no',
								],
							],
						],
						rishi__cb_customizer_rand_md5() => [
							'type'      => 'rt-condition',
							'condition' => [ 'ed_google_fonts_local' => 'yes'],
							'options'   => [

								'ed_flush_local_fonts' => [
									'label' => __( 'Flush Local Fonts Cache', 'rishi-companion' ),
									'desc' 	=> __( 'Click the button to reset the cache of local fonts.', 'rishi-companion' ),
									'disableRevertButton' => true,
									'type' 		=> 'rt-simple-button',
									'value' 	=> ''
								],			
								
							],
						],
					],
				],
				'performance_elementor_listing_panel' => [
					'label' => __('Elementor', 'travel-monster'),
					'type' => 'rt-panel',
					'value' => 'yes',
					'wrapperAttr' => ['data-panel' => 'only-arrow'],
					'inner-options' => [
						'ed_elementor_google_fonts' => [
							'label'   => __('Disable Google fonts', 'rishi-companion'),
							'desc'    => __('Enabling this option will prevent Elementor Google fonts from loading.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'ed_elementor_icons' => [
							'label'   => __('Disable Icons', 'rishi-companion'),
							'desc'    => __('Enabling this option will prevent Elementor icons from loading.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'ed_elementor_font_awesome' => [
							'label'   => __('Disable Font Awesome', 'rishi-companion'),
							'desc'    => __('Enabling this option will prevent Elementor Font Awesome icons from loading.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'ed_elementor_frontend_script' => [
							'label'   => __('Disable Frontend Script', 'rishi-companion'),
							'desc'    => __('Enabling this option will prevent Elementor frontend scripts (such as swiper, dialog, share link) from loading.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'ed_elementor_elementor_pro_script' => [
							'label'   => __('Disable Elementor Pro scripts', 'rishi-companion'),
							'desc'    => __('Enabling this option will prevent some of the scripts of Elementor Pro from loading.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],					
					],
				],
				'performance_woo_listing_panel' => [
					'label' => __('WooCommerce', 'travel-monster'),
					'type' => 'rt-panel',
					'value' => 'yes',
					'wrapperAttr' => ['data-panel' => 'only-arrow'],
					'inner-options' => [
						'ed_woo_scripts' => [
							'label'   => __('Disable Scripts and Styles', 'rishi-companion'),
							'desc'    => __('Disables WooCommerce scripts and styles except on product, cart, and checkout pages.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
						],
						'ed_woo_cart_fragramentation' => [
							'label'   => __('Disable Cart Fragmentation', 'rishi-companion'),
							'desc'    => __('Completely disables WooCommerce cart fragmentation script.', 'rishi-companion'),
							'type'    => 'rara-switch',
							'value'   => 'no',
							'divider' => 'top',
						],
					],
				],
			],
		],
	]
];
