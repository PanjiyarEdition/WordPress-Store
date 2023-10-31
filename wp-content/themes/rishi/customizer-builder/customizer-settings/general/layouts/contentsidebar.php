<?php
/**
 * Container Options
 */

$defaults = rishi__cb__get_layout_defaults();

$options = [
    'layout_contentsidebar_panel' => [
        'label'         => __('Sidebar', 'rishi'),
        'type'          => 'rt-panel',
        'inner-options' => [
          rishi__cb_customizer_rand_md5() => [
				'title' => __( 'Sidebar', 'rishi' ),
				'type' => 'tab',
				'options' => [
                    'content_sidebar_width' => [
                        'label'       => __('Sidebar Width', 'rishi'),
                        'type'        => 'rt-slider',
                        'min'         => 1,
                        'max'         => 50,
                        'value'       => $defaults['content_sidebar_width'],
                        'defaultUnit' => '%',
                        'responsive'  => false,
                        'setting'     => ['transport' => 'postMessage'],
                    ],
                    'sidebar_widget_spacing' => [
                        'label'      => __('Widget Spacing', 'rishi'),
                        'type'       => 'rt-slider',
                        'responsive' => true,
                        'value'      => [
                            'desktop' => $defaults['sidebar_widget_spacing']['desktop'],
                            'tablet'  => $defaults['sidebar_widget_spacing']['tablet'],
                            'mobile'  => $defaults['sidebar_widget_spacing']['mobile'],
                        ],
                        'units' => rishi__cb_customizer_units_config([
                            ['unit' => 'px', 'min' => 1, 'max' => 200],
                        ]),
                        'divider' => 'top',
                        'setting' => ['transport' => 'postMessage'],
                        'desc'    => __( 'This setting adds the spacing between the widgets in the sidebar.', 'rishi'),
                    ],
                    //default style
                    'layout_style' => [
                        'type'    => 'rt-image-picker',
                        'label' => __('Default Sidebar Layout', 'rishi'),
                        'value'   => $defaults['layout_style'],
                        'attr'  => [
                            'data-type'    => 'background',
                            'data-usage'   => 'layout-style',
                            'data-columns' => '2',
                        ],
                        'desc' => __('This setting sets the default sidebar layout of the site.', 'rishi'),
                        'divider' => 'top',
                        'choices' => [
                            'right-sidebar' => [
                                'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="130" height="177" viewBox="0 0 275 275"><defs><clipPath id="clip-_1"><rect width="275" height="275"/></clipPath></defs><g id="_1" data-name="1" clip-path="url(#clip-_1)"><rect width="230" height="275" transform="translate(23)"></rect><g id="Group_5677" data-name="Group 5677"><g id="Group_5722" data-name="Group 5722"><g id="Group_5720" data-name="Group 5720" transform="translate(-0.268)"><path id="Path_264" data-name="Path 264" d="M0,0H53.568V265H0Z" transform="translate(182 10)" fill="#566779" opacity="0.1"/></g><g id="Group_5721" data-name="Group 5721" transform="translate(0)"><g id="Group_5712" data-name="Group 5712"><g id="Group_5714" data-name="Group 5714" transform="translate(0 -6.598)"><rect id="Rectangle_356" data-name="Rectangle 356" width="5.81" transform="translate(58.398 113.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352" data-name="Rectangle 352" width="87.684" height="1.937" transform="translate(40 109.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353" data-name="Rectangle 353" width="95.431" height="1.937" transform="translate(40 114.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370" data-name="Rectangle 370" width="42.608" height="1.937" transform="translate(40 119.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385" data-name="Rectangle 385" width="101.338" height="5" transform="translate(40 100.953)" fill="#566779" opacity="0.3"/></g><g id="Group_5713" data-name="Group 5713" transform="translate(0 -6.851)"><rect id="Rectangle_457" data-name="Rectangle 457" width="30" height="3" transform="translate(60 92)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456" data-name="Rectangle 456" width="18" height="3" transform="translate(40 92)" fill="#566779" opacity="0.25"/></g><g id="Group_5717" data-name="Group 5717"><path id="Path_304" data-name="Path 304" d="M0,0H121.732V69.149H0Z" transform="translate(40 10)" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(83 31)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M90.305,116.384A4.384,4.384,0,1,0,94.689,112,4.384,4.384,0,0,0,90.305,116.384Zm8.768,21.921H64l8.768-23.382L84.46,129.537l5.846-4.384Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5718" data-name="Group 5718" transform="translate(0 124.923)"><g id="Group_5714-2" data-name="Group 5714" transform="translate(0 -6.598)"><rect id="Rectangle_356-2" data-name="Rectangle 356" width="5.81" transform="translate(58.398 113.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-2" data-name="Rectangle 352" width="87.684" height="1.937" transform="translate(40 109.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-2" data-name="Rectangle 353" width="95.431" height="1.937" transform="translate(40 114.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-2" data-name="Rectangle 370" width="42.608" height="1.937" transform="translate(40 119.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385-2" data-name="Rectangle 385" width="101.338" height="5" transform="translate(40 100.953)" fill="#566779" opacity="0.3"/></g><g id="Group_5713-2" data-name="Group 5713" transform="translate(0 -6.851)"><rect id="Rectangle_457-2" data-name="Rectangle 457" width="30" height="3" transform="translate(60 92)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456-2" data-name="Rectangle 456" width="18" height="3" transform="translate(40 92)" fill="#566779" opacity="0.25"/></g><g id="Group_5717-2" data-name="Group 5717"><path id="Path_304-2" data-name="Path 304" d="M0,0H121.732V69.149H0Z" transform="translate(40 10)" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(83 31)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M90.305,116.384A4.384,4.384,0,1,0,94.689,112,4.384,4.384,0,0,0,90.305,116.384Zm8.768,21.921H64l8.768-23.382L84.46,129.537l5.846-4.384Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5719" data-name="Group 5719" transform="translate(0 249.846)"><path id="Path_304-3" data-name="Path 304" d="M0,0H121.732V15.154H0Z" transform="translate(40 10)" fill="#566779" opacity="0.2"/></g></g></g></g></g></svg>',
                                'title' => __('Right Sidebar', 'rishi'),
                            ],

                            'left-sidebar' => [
                                'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="130" height="177" viewBox="0 0 275 275"><defs><clipPath id="clip-_2"><rect width="275" height="275"/></clipPath></defs><g id="_2" data-name="2" clip-path="url(#clip-_2)"><rect width="230" height="275" transform="translate(23)"></rect><g id="Group_5677" data-name="Group 5677"><g id="Group_5722" data-name="Group 5722"><g id="Group_5721" data-name="Group 5721" transform="translate(73.568)"><g id="Group_5712" data-name="Group 5712"><g id="Group_5714" data-name="Group 5714" transform="translate(0 -6.598)"><rect id="Rectangle_356" data-name="Rectangle 356" width="5.81" transform="translate(58.398 113.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352" data-name="Rectangle 352" width="87.684" height="1.937" transform="translate(40 109.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353" data-name="Rectangle 353" width="95.431" height="1.937" transform="translate(40 114.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370" data-name="Rectangle 370" width="42.608" height="1.937" transform="translate(40 119.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385" data-name="Rectangle 385" width="101.338" height="5" transform="translate(40 100.953)" fill="#566779" opacity="0.3"/></g><g id="Group_5713" data-name="Group 5713" transform="translate(0 -6.851)"><rect id="Rectangle_457" data-name="Rectangle 457" width="30" height="3" transform="translate(60 92)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456" data-name="Rectangle 456" width="18" height="3" transform="translate(40 92)" fill="#566779" opacity="0.25"/></g><g id="Group_5717" data-name="Group 5717"><path id="Path_304" data-name="Path 304" d="M0,0H121.732V69.149H0Z" transform="translate(40 10)" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(83 31)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M90.305,116.384A4.384,4.384,0,1,0,94.689,112,4.384,4.384,0,0,0,90.305,116.384Zm8.768,21.921H64l8.768-23.382L84.46,129.537l5.846-4.384Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5718" data-name="Group 5718" transform="translate(0 124.923)"><g id="Group_5714-2" data-name="Group 5714" transform="translate(0 -6.598)"><rect id="Rectangle_356-2" data-name="Rectangle 356" width="5.81" transform="translate(58.398 113.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-2" data-name="Rectangle 352" width="87.684" height="1.937" transform="translate(40 109.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-2" data-name="Rectangle 353" width="95.431" height="1.937" transform="translate(40 114.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-2" data-name="Rectangle 370" width="42.608" height="1.937" transform="translate(40 119.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385-2" data-name="Rectangle 385" width="101.338" height="5" transform="translate(40 100.953)" fill="#566779" opacity="0.3"/></g><g id="Group_5713-2" data-name="Group 5713" transform="translate(0 -6.851)"><rect id="Rectangle_457-2" data-name="Rectangle 457" width="30" height="3" transform="translate(60 92)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456-2" data-name="Rectangle 456" width="18" height="3" transform="translate(40 92)" fill="#566779" opacity="0.25"/></g><g id="Group_5717-2" data-name="Group 5717"><path id="Path_304-2" data-name="Path 304" d="M0,0H121.732V69.149H0Z" transform="translate(40 10)" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(83 31)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M90.305,116.384A4.384,4.384,0,1,0,94.689,112,4.384,4.384,0,0,0,90.305,116.384Zm8.768,21.921H64l8.768-23.382L84.46,129.537l5.846-4.384Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5719" data-name="Group 5719" transform="translate(0 249.846)"><path id="Path_304-3" data-name="Path 304" d="M0,0H121.732V15.154H0Z" transform="translate(40 10)" fill="#566779" opacity="0.2"/></g></g><g id="Group_5720" data-name="Group 5720" transform="translate(-142)"><path id="Path_264" data-name="Path 264" d="M0,0H53.568V265H0Z" transform="translate(182 10)" fill="#566779" opacity="0.1"/></g></g></g></g></svg>',
                                'title' => __('Left Sidebar', 'rishi'),
                            ],

                            'no-sidebar' => [
                                'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="130" height="177" viewBox="0 0 275 275"><defs><clipPath id="clip-_3"><rect width="275" height="275"/></clipPath></defs><g id="_3" data-name="3" clip-path="url(#clip-_3)"><rect width="220" height="275" transform="translate(30)"></rect><g id="Group_5677" data-name="Group 5677"><g id="Group_5731" data-name="Group 5731" transform="translate(27)"><g id="Group_5712" data-name="Group 5712" transform="translate(40 10)"><g id="Group_5714" data-name="Group 5714" transform="translate(0 95.257)"><rect id="Rectangle_356" data-name="Rectangle 356" width="6.699" transform="translate(21.212 14.89)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352" data-name="Rectangle 352" width="101.095" height="2.233" transform="translate(0 10.388)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353" data-name="Rectangle 353" width="110.027" height="2.233" transform="translate(0 15.934)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370" data-name="Rectangle 370" width="49.125" height="2.233" transform="translate(0 21.48)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385" data-name="Rectangle 385" width="116.837" height="5.765" fill="#566779" opacity="0.3"/></g><g id="Group_5713" data-name="Group 5713" transform="translate(0 86.643)"><rect id="Rectangle_457" data-name="Rectangle 457" width="34.588" height="3.459" transform="translate(23.059)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456" data-name="Rectangle 456" width="20.753" height="3.459" fill="#566779" opacity="0.25"/></g><g id="Group_5717" data-name="Group 5717" transform="translate(0 0)"><path id="Path_304" data-name="Path 304" d="M0,0H140.35V79.726H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(49.577 24.212)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M94.328,117.055A5.055,5.055,0,1,0,99.383,112,5.055,5.055,0,0,0,94.328,117.055Zm10.109,25.274H64L74.109,115.37l13.479,16.849,6.74-5.055Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5718" data-name="Group 5718" transform="translate(40 146.029)"><g id="Group_5714-2" data-name="Group 5714" transform="translate(0 97.257)"><rect id="Rectangle_356-2" data-name="Rectangle 356" width="6.699" transform="translate(21.212 14.89)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-2" data-name="Rectangle 352" width="101.095" height="2.233" transform="translate(0 10.388)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-2" data-name="Rectangle 353" width="110.027" height="2.233" transform="translate(0 15.934)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-2" data-name="Rectangle 370" width="49.125" height="2.233" transform="translate(0 21.48)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385-2" data-name="Rectangle 385" width="116.837" height="5.765" fill="#566779" opacity="0.3"/></g><g id="Group_5713-2" data-name="Group 5713" transform="translate(0 87.643)"><rect id="Rectangle_457-2" data-name="Rectangle 457" width="34.588" height="3.459" transform="translate(23.059)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456-2" data-name="Rectangle 456" width="20.753" height="3.459" fill="#566779" opacity="0.25"/></g><g id="Group_5717-2" data-name="Group 5717" transform="translate(0 0)"><path id="Path_304-2" data-name="Path 304" d="M0,0H140.35V79.726H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(49.577 24.212)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M94.328,117.055A5.055,5.055,0,1,0,99.383,112,5.055,5.055,0,0,0,94.328,117.055Zm10.109,25.274H64L74.109,115.37l13.479,16.849,6.74-5.055Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g></g></g></g></svg>',
                                'title' => __('No Sidebar', 'rishi'),
                            ],
                        ],
                    ],
                ],
            ],
          rishi__cb_customizer_rand_md5() => [
				'title' => __( 'Design', 'rishi' ),
				'type' => 'tab',
				'options' => [
                    'sidebarWidgetsTitleColor' => [
						'label'      => __('Widgets Title Font Color', 'rishi'),
						'type'       => 'rt-color-picker',
						'design'     => 'block:right',
						'responsive' => true,
						'setting'    => ['transport' => 'postMessage'],
						'value' => [
							'default' => [
								'color' => 'var(--paletteColor2)',
							],
						],
						'pickers' => [
							[
								'title' => __('Initial', 'rishi'),
								'id' => 'default',
								'inherit' => 'var(--paletteColor2)'
							],
						],
					],
                    'widgets_font_size' => [
                        'label'      => __('Widget Title Font Size', 'rishi'),
                        'type'       => 'rt-slider',
                        'value' => [
                            'desktop' => $defaults['widgets_font_size']['desktop'],
                            'tablet'  => $defaults['widgets_font_size']['tablet'],
                            'mobile'  => $defaults['widgets_font_size']['mobile'],
                        ],
                        'units' => rishi__cb_customizer_units_config([
                            ['unit' => 'px', 'min' => 1, 'max' => 80],
                        ]),
                        'responsive' => true,
                        'divider'    => 'top',
                        'setting'    => ['transport' => 'postMessage'],
                    ],
                    'widgets_link_color' => [
                        'label'      => __( 'Widget Link Color', 'rishi' ),
                        'type'       => 'rt-color-picker',
                        'design'     => 'inline',
                        'responsive' => false,
                        'divider'    => 'top',
                        'setting' => ['transport' => 'postMessage'],
                        'value' => [
                            'default' => [
                                'color' => 'var(--paletteColor1)',
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

                    'widgets_content_area_spacing' => [
                        'label'   => __( 'Content Area Spacing', 'rishi' ),
                        'type'    => 'rt-spacing',
                        'divider' => 'top',
                        'setting' => [ 'transport' => 'postMessage' ],
                        'value' => [
                            'desktop' =>    rishi__cb_customizer_spacing_value([
                                'linked' => true,
                                'top'    => '0',
                                'left'   => '20px',
                                'right'  => '0',
                                'bottom' => '20px',
                            ]),
                            'tablet' =>    rishi__cb_customizer_spacing_value([
                                'linked' => true,
                                'top'    => '0px',
                                'left'   => '0px',
                                'right'  => '0px',
                                'bottom' => '0px',
                            ]),
                            'mobile' =>    rishi__cb_customizer_spacing_value([
                                'linked' => true,
                                'top'    => '0px',
                                'left'   => '0px',
                                'right'  => '0px',
                                'bottom' => '0px',
                            ])
                        ],
                        'responsive' => true
                    ],
                ],
            ],
        ],
    ],
];
