<?php

$options = [
	[
		'breadcrumbs_single_post' => [
			'label'   => __('Disable Breadcrumb', 'rishi'),
			'type'    => 'rara-switch',
			'value'   => 'no',
		],

	 rishi__cb_customizer_rand_md5() => [
			'type' => 'rt-title',
			'label' => __( 'Post Structure', 'rishi' ),
		],

	 rishi__cb_customizer_rand_md5() => [
			'title' => __( 'General', 'rishi' ),
			'type' => 'tab',
			'options' => [
				'page_structure_type' => [
					'label' => false,
					'type' => 'rt-image-picker',
					'value' => 'default-sidebar',
					'design' => 'block',
					'attr' => [
						'data-type' => 'background',
						'data-state' => 'sync',
					],
					'setting' => [ 'transport' => 'postMessage' ],
					'choices' => [
						'default-sidebar' => [
							'src'   => rishi__cb_customizer_image_picker_url( 'default.svg' ),
							'title' => __( 'Inherit from customizer', 'rishi' ),
						],
						'right-sidebar' => [
							'src'   => '<svg width="110" height="145" viewBox="0 0 167 185" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M167 0H0V185H167V0Z"/><path opacity="0.25" d="M94.9432 158.796H13.7706V160.475H94.9432V158.796Z" fill="#566779"/><path opacity="0.25" d="M100.553 162.965H13.7706V164.644H100.553V162.965Z" fill="#566779"/><path opacity="0.25" d="M95.6012 155H13.7706V156.679H95.6012V155Z" fill="#566779"/><path opacity="0.25" d="M95.6012 167.135H13.7706V168.814H95.6012V167.135Z" fill="#566779"/><path opacity="0.25" d="M94.8306 171.807H13V173.486H94.8306V171.807Z" fill="#566779"/><path opacity="0.4" d="M26.4856 20H13.7706V22.319H26.4856V20Z" fill="#566779"/><path opacity="0.4" d="M41.1079 20H27.7571V22.319H41.1079V20Z" fill="#566779"/><path d="M25.1772 20.8665H15.1966V21.3002H25.1772V20.8665Z" fill="#fff"/><path d="M39.4352 20.8665H29.4546V21.3002H39.4352V20.8665Z" fill="#fff"/><path opacity="0.3" d="M99.4113 26.0272H13.7706V30.3615H99.4113V26.0272Z" fill="#566779"/><path opacity="0.3" d="M68.3224 32.9619H13.7706V37.2961H68.3224V32.9619Z" fill="#566779"/><path opacity="0.23" d="M15.6779 46.2824C16.7312 46.2824 17.5851 45.2442 17.5851 43.9634C17.5851 42.6826 16.7312 41.6444 15.6779 41.6444C14.6245 41.6444 13.7706 42.6826 13.7706 43.9634C13.7706 45.2442 14.6245 46.2824 15.6779 46.2824Z" fill="#566779"/><path opacity="0.4" d="M32.1851 43.4045H19.3531V46.0049H32.1851V43.4045Z" fill="#566779"/><path opacity="0.25" d="M57.137 43.4045H35.7497V46.0049H57.137V43.4045Z" fill="#566779"/><path opacity="0.25" d="M34.8324 42.9708L33.6076 45.5502" stroke="#707070"/><path opacity="0.1" d="M115 20H152V185H115V20Z" fill="#566779"/><path opacity="0.2" d="M13.7706 55.5392H100.551V115.479H13.7706V55.5392Z" fill="#566779"/><g opacity="0.4"><path opacity="1" d="M63.1799 77.543C63.1799 78.2947 63.3632 79.0295 63.7067 79.6544C64.0502 80.2794 64.5384 80.7665 65.1095 81.054C65.6807 81.3416 66.3091 81.4168 66.9154 81.27C67.5217 81.1233 68.0786 80.7612 68.5156 80.2296C68.9527 79.698 69.2502 79.0207 69.3707 78.2835C69.4911 77.5462 69.4291 76.7821 69.1923 76.0877C68.9556 75.3934 68.5548 74.8 68.0407 74.3826C67.5265 73.9652 66.9222 73.7426 66.304 73.7429C65.4753 73.7433 64.6807 74.1439 64.0948 74.8565C63.509 75.5691 63.1799 76.5354 63.1799 77.543V77.543ZM69.4293 96.5468H44.4252L50.6759 76.2784L59.0106 88.9457L63.178 85.1456L69.4293 96.5468Z" fill="#fff"/></g><path opacity="0.25" d="M95.4213 124.853H21.1707V126.532H95.4213V124.853Z" fill="#566779"/><path opacity="0.25" d="M100.553 129.022H21.1707V130.701H100.553V129.022Z" fill="#566779"/><path opacity="0.25" d="M94.9432 136.988H13.7706V138.667H94.9432V136.988Z" fill="#566779"/><path opacity="0.25" d="M100.553 141.158H13.7706V142.837H100.553V141.158Z" fill="#566779"/><path opacity="0.25" d="M95.6012 133.193H13.7706V134.872H95.6012V133.193Z" fill="#566779"/><path opacity="0.25" d="M95.6012 145.328H13.7706V147.007H95.6012V145.328Z" fill="#566779"/><path opacity="0.25" d="M94.8306 150H13V151.679H94.8306V150Z" fill="#566779"/><g opacity="0.25"><path opacity="0.25" d="M18.2209 124.357H13.7706V131.314H18.2209V124.357Z" fill="#fff"/><path opacity="0.25" d="M17.5851 125.13H14.4063V130.541H17.5851V125.13Z" stroke="#566779" stroke-width="2"/></g></svg>',
							'title' => __('Right Sidebar', 'rishi'),
						],

						'left-sidebar' => [
							'src'   => '<svg width="110" height="145" viewBox="0 0 169 177" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M169 0H0V177H169V0Z"/><path opacity="0.4" d="M78.1585 12.4378H65.3808V14.8384H78.1585V12.4378Z" fill="#566779"/><path opacity="0.4" d="M92.3562 12.4378H79.5785V14.8384H92.3562V12.4378Z" fill="#566779"/><path d="M76.7392 13.2378H66.8008V13.6381H76.7392V13.2378Z" fill="#fff"/><path d="M90.9369 13.2378H80.9985V13.6381H90.9369V13.2378Z" fill="#fff"/><path opacity="0.3" d="M150.659 18.0018H65.3808V22.0029H150.659V18.0018Z" fill="#566779"/><path opacity="0.3" d="M119.702 24.4035H65.3808V28.4047H119.702V24.4035Z" fill="#566779"/><path opacity="0.23" d="M67.5104 37.244C68.6866 37.244 69.64 36.1692 69.64 34.8435C69.64 33.5177 68.6866 32.4429 67.5104 32.4429C66.3343 32.4429 65.3808 33.5177 65.3808 34.8435C65.3808 36.1692 66.3343 37.244 67.5104 37.244Z" fill="#566779"/><path opacity="0.4" d="M83.7175 34.0435H70.9397V36.444H83.7175V34.0435Z" fill="#566779"/><path opacity="0.25" d="M108.564 34.0435H87.267V36.444H108.564V34.0435Z" fill="#566779"/><path opacity="0.25" d="M86.3535 33.6432L85.134 36.0243" stroke="#707070"/><path opacity="0.2" d="M65.3808 45.2456H151.794V100.579H65.3808V45.2456Z" fill="#566779"/><g opacity="0.4"><path opacity="1" d="M114.581 65.5582C114.581 66.2521 114.764 66.9304 115.106 67.5074C115.448 68.0843 115.934 68.5339 116.503 68.7994C117.071 69.0649 117.697 69.1343 118.301 68.9988C118.905 68.8633 119.459 68.529 119.894 68.0383C120.33 67.5475 120.626 66.9223 120.746 66.2417C120.866 65.5612 120.804 64.8558 120.568 64.2148C120.332 63.5738 119.933 63.026 119.421 62.6407C118.909 62.2554 118.308 62.0499 117.692 62.0502C116.867 62.0505 116.076 62.4203 115.492 63.0782C114.909 63.736 114.581 64.6281 114.581 65.5582V65.5582ZM120.804 83.1014H95.9058L102.13 64.3908L110.43 76.0845L114.579 72.5765L120.804 83.1014Z" fill="#fff"/></g><path opacity="0.25" d="M146.686 109.232H72.7496V110.782H146.686V109.232Z" fill="#566779"/><path opacity="0.25" d="M146.21 120.435H65.3808V121.985H146.21V120.435Z" fill="#566779"/><path opacity="0.25" d="M146.21 131.638H65.3808V133.188H146.21V131.638Z" fill="#566779"/><path opacity="0.25" d="M151.796 113.081H72.7496V114.631H151.796V113.081Z" fill="#566779"/><path opacity="0.25" d="M151.796 124.284H65.3808V125.834H151.796V124.284Z" fill="#566779"/><path opacity="0.25" d="M151.796 135.487H65.3808V137.037H151.796V135.487Z" fill="#566779"/><path opacity="0.25" d="M146.865 116.931H65.3808V118.481H146.865V116.931Z" fill="#566779"/><path opacity="0.25" d="M146.865 128.133H65.3808V129.683H146.865V128.133Z" fill="#566779"/><path opacity="0.25" d="M146.865 139.336H65.3808V140.886H146.865V139.336Z" fill="#566779"/><path opacity="0.25" d="M146.865 142.84H65.3808V144.39H146.865V142.84Z" fill="#566779"/><g opacity="0.25"><path opacity="0.25" d="M70.3497 109.262H65.3808V114.863H70.3497V109.262Z" fill="#fff"/><path opacity="0.25" d="M69.7166 109.976H66.0139V114.149H69.7166V109.976Z" stroke="#566779" stroke-width="2"/></g><path opacity="0.1" d="M13 12H51V177H13V12Z" fill="#566779"/><path opacity="0.25" d="M146.679 150.016H64.5343V151.622H146.679V150.016Z" fill="#566779"/><path opacity="0.25" d="M152.356 154.004H64.5343V155.611H152.356V154.004Z" fill="#566779"/><path opacity="0.25" d="M147.345 146.384H64.5343V147.99H147.345V146.384Z" fill="#566779"/><path opacity="0.25" d="M147.345 157.994H64.5343V159.6H147.345V157.994Z" fill="#566779"/><path opacity="0.25" d="M147.345 162.994H64.5343V164.6H147.345V162.994Z" fill="#566779"/><path opacity="0.25" d="M147.345 166.994H64.5343V168.6H147.345V166.994Z" fill="#566779"/></svg>',
							'title' => __('Left Sidebar', 'rishi'),
						],

						'no-sidebar' => [
							'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="177" viewBox="0 0 275 177"><defs><clipPath id="clip-_3"><rect width="275" height="177"/></clipPath></defs><g id="_3" data-name="3" clip-path="url(#clip-_3)"><rect width="150" height="190" transform="translate(63)"></rect><g id="Group_5696" data-name="Group 5696"><g id="Group_5728" data-name="Group 5728" transform="translate(39)"><g id="Group_5663" data-name="Group 5663" transform="translate(-7.831)"><rect id="Rectangle_875" data-name="Rectangle 875" width="18" height="3" transform="translate(86.831 12)" fill="#566779" opacity="0.4"/><rect id="Rectangle_878" data-name="Rectangle 878" width="18" height="3" transform="translate(106.831 12)" fill="#566779" opacity="0.4"/><rect id="Rectangle_876" data-name="Rectangle 876" width="14" height="0.5" transform="translate(88.831 13)" fill="#fff"/><rect id="Rectangle_877" data-name="Rectangle 877" width="14" height="0.5" transform="translate(108.831 13)" fill="#fff"/></g><rect id="Rectangle_1151" data-name="Rectangle 1151" width="120.13" height="5" transform="translate(38 18.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1152" data-name="Rectangle 1152" width="76.521" height="5" transform="translate(60 26.953)" fill="#566779" opacity="0.3"/><g id="Group_5669" data-name="Group 5669" transform="translate(0.604)"><g id="Group_5664" data-name="Group 5664" transform="translate(-11.604 -7)"><circle id="Ellipse_95" data-name="Ellipse 95" cx="3" cy="3" r="3" transform="translate(79 44)" fill="#566779" opacity="0.23"/><rect id="Rectangle_1153" data-name="Rectangle 1153" width="18" height="3" transform="translate(86.831 46)" fill="#566779" opacity="0.4"/><rect id="Rectangle_1154" data-name="Rectangle 1154" width="30" height="3" transform="translate(109.831 46)" fill="#566779" opacity="0.25"/><path id="Path_23061" data-name="Path 23061" d="M131.854,61v3.436" transform="translate(24.855 -73.254) rotate(30)" fill="none" stroke="#707070" stroke-width="1" opacity="0.25"/></g></g><path id="Path_304" data-name="Path 304" d="M0,0H121.732V69.149H0Z" transform="translate(38 53)" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(81 74)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M90.305,116.384A4.384,4.384,0,1,0,94.689,112,4.384,4.384,0,0,0,90.305,116.384Zm8.768,21.921H64l8.768-23.382L84.46,129.537l5.846-4.384Z" transform="translate(-64 -112)" fill="#fff"/></g><rect id="Rectangle_352" data-name="Rectangle 352" width="104.153" height="1.937" transform="translate(48.38 129.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1157" data-name="Rectangle 1157" width="113.862" height="1.937" transform="translate(38 143.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1188" data-name="Rectangle 1188" width="113.862" height="1.937" transform="translate(38 162.343)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1192" data-name="Rectangle 1192" width="113.862" height="1.937" transform="translate(38 194.469)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353" data-name="Rectangle 353" width="109.887" height="1.937" transform="translate(48.244 134.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1156" data-name="Rectangle 1156" width="116.13" height="1.937" transform="translate(38 148.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1195" data-name="Rectangle 1195" width="116.13" height="1.937" transform="translate(38 180.9)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1187" data-name="Rectangle 1187" width="120.13" height="1.937" transform="translate(38 167.153)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1191" data-name="Rectangle 1191" width="120.13" height="1.937" transform="translate(38 199.279)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370" data-name="Rectangle 370" width="114.786" height="1.937" transform="translate(38 139.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1189" data-name="Rectangle 1189" width="114.786" height="1.937" transform="translate(38 157.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1193" data-name="Rectangle 1193" width="114.786" height="1.937" transform="translate(38 190.09)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1155" data-name="Rectangle 1155" width="114.786" height="1.937" transform="translate(38 153.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1194" data-name="Rectangle 1194" width="114.786" height="1.937" transform="translate(38 185.71)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1186" data-name="Rectangle 1186" width="114.786" height="1.937" transform="translate(38 171.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1190" data-name="Rectangle 1190" width="114.786" height="1.937" transform="translate(38 204.09)" fill="#566779" opacity="0.25"/><g id="Rectangle_1158" data-name="Rectangle 1158" transform="translate(38 130)" fill="#fff" stroke="#566779" stroke-width="2" opacity="0.25"><rect width="7" height="7" stroke="none"/><rect x="1" y="1" width="5" height="5" fill="none"/></g></g></g></g></svg>',
							'title' => __('Fullwidth', 'rishi'),
						],
						'centered' => [
							'src'   => '<svg width="200" height="177" viewBox="0 0 275 177" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="150" height="180" transform="translate(63)"></rect><path opacity="0.4" d="M139.202 12H125.717V15H139.202V12Z" fill="#566779"/><path opacity="0.4" d="M154.186 12H140.701V15H154.186V12Z" fill="#566779"/><path d="M137.704 13H127.215V13.5H137.704V13Z" fill="#fff"/><path d="M152.688 13H142.199V13.5H152.688V13Z" fill="#fff"/><path opacity="0.3" d="M185 18.953H95V23.953H185V18.953Z" fill="#566779"/><path opacity="0.3" d="M168.811 26.953H111.482V31.953H168.811V26.953Z" fill="#566779"/><path opacity="0.23" d="M119.723 43C120.965 43 121.971 41.6569 121.971 40C121.971 38.3431 120.965 37 119.723 37C118.482 37 117.476 38.3431 117.476 40C117.476 41.6569 118.482 43 119.723 43Z" fill="#566779"/><path opacity="0.4" d="M136.828 39H123.343V42H136.828V39Z" fill="#566779"/><path opacity="0.25" d="M163.05 39H140.574V42H163.05V39Z" fill="#566779"/><path opacity="0.25" d="M139.61 38.5005L138.322 41.4762" stroke="#707070"/><path opacity="0.2" d="M77 53H198.732V122.149H77V53Z" fill="#566779"/><g opacity="0.4"><path opacity="1" d="M146.305 78.384C146.305 79.2511 146.562 80.0987 147.044 80.8196C147.526 81.5406 148.21 82.1025 149.011 82.4343C149.812 82.7661 150.694 82.8529 151.544 82.6838C152.395 82.5146 153.176 82.0971 153.789 81.484C154.402 80.8708 154.82 80.0897 154.989 79.2393C155.158 78.3889 155.071 77.5074 154.739 76.7063C154.407 75.9052 153.846 75.2206 153.125 74.7388C152.404 74.2571 151.556 74 150.689 74C149.526 74 148.411 74.4619 147.589 75.284C146.767 76.1062 146.305 77.2213 146.305 78.384V78.384ZM155.073 100.305H120L128.768 76.923L140.46 91.537L146.306 87.153L155.073 100.305Z" fill="#ffffff"/></g><path opacity="0.25" d="M180.806 130H102.776V131.146H180.806V130Z" fill="#566779"/><path opacity="0.25" d="M180.303 138.282H95V139.428H180.303V138.282Z" fill="#566779"/><path opacity="0.25" d="M180.303 149.156H95V150.302H180.303V149.156Z" fill="#566779"/><path opacity="0.25" d="M180.303 168.162H95V169.308H180.303V168.162Z" fill="#566779"/><path opacity="0.25" d="M185 132.846H102.675V133.992H185V132.846Z" fill="#566779"/><path opacity="0.25" d="M182.002 141.128H95V142.274H182.002V141.128Z" fill="#566779"/><path opacity="0.25" d="M182.002 160.135H95V161.281H182.002V160.135Z" fill="#566779"/><path opacity="0.25" d="M184.999 152.002H95V153.148H184.999V152.002Z" fill="#566779"/><path opacity="0.25" d="M184.999 171.008H95V172.154H184.999V171.008Z" fill="#566779"/><path opacity="0.25" d="M180.996 135.692H95V136.838H180.996V135.692Z" fill="#566779"/><path opacity="0.25" d="M180.996 146.565H95V147.711H180.996V146.565Z" fill="#566779"/><path opacity="0.25" d="M180.996 165.572H95V166.718H180.996V165.572Z" fill="#566779"/><path opacity="0.25" d="M180.996 143.974H95V145.12H180.996V143.974Z" fill="#566779"/><path opacity="0.25" d="M180.996 162.98H95V164.126H180.996V162.98Z" fill="#566779"/><path opacity="0.25" d="M180.996 154.847H95V155.993H180.996V154.847Z" fill="#566779"/><path opacity="0.25" d="M180.996 173.854H95V175H180.996V173.854Z" fill="#566779"/><g opacity="0.25"><path opacity="0.25" d="M100.244 130.022H95V134.163H100.244V130.022Z" fill="#fff"/><path opacity="0.25" d="M99.495 130.613H95.7491V133.572H99.495V130.613Z" stroke="#566779" stroke-width="2"/></g></svg>',
							'title' => __('Fullwidth Centered', 'rishi'),
						],
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-divider',
				],

				'content_style_source' => [
					'label' => __('Content Area Style Source', 'rishi'),
					'type' => 'rt-radio',
					'value' => 'inherit',
					'view' => 'text',
					'choices' => [
						'inherit' => __('Inherit', 'rishi'),
						'custom' => __('Custom', 'rishi'),
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => ['content_style_source' => 'custom'],
					'options' => [
						'content_style' => [
							'label' => __('Content Area Style', 'rishi'),
							'type' => 'rt-radio',
							'value' => 'box-layout',
							'view' => 'text',
							'design' => 'block',
							'responsive' => false,
							'choices' => [
								'boxed'                => __('Boxed', 'rishi'),
								'content_boxed'        => __('Content Boxed', 'rishi'),
								'full_width_contained' => __('Unboxed', 'rishi'),
							],
						],
					]
				],

				'blog_post_streched_ed' => [
					'label'   => __('Disable Stretch Layout', 'rishi'),
					'type'    => 'rara-switch',
					'sync'    => 'live',
					'setting' => [ 'transport' => 'postMessage' ],
					'value'   => 'no',
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-divider',
				],

				'vertical_spacing_source' => [
					'label' => __('Content Area Vertical Spacing', 'rishi'),
					'type' => 'rt-radio',
					'value' => 'inherit',
					'view' => 'text',
					'choices' => [
						'inherit' => __('Inherit', 'rishi'),
						'custom' => __('Custom', 'rishi'),
					],
				],

			 rishi__cb_customizer_rand_md5() => [
					'type' => 'rt-condition',
					'condition' => [ 'vertical_spacing_source' => 'custom' ],
					'options' => [

						'content_area_spacing' => [
							'label' => false,
							'desc' => __( 'You can customize the spacing value in general settings panel.', 'rishi' ),
							'type' => 'rt-radio',
							'value' => 'both',
							'view' => 'text',
							'design' => 'block',
							'disableRevertButton' => true,
							'attr' => [ 'data-type' => 'content-spacing' ],
							'setting' => [ 'transport' => 'postMessage' ],
							'choices' => [
								'both'   => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Top & Bottom', 'rishi' ) . '</i>',

								'top'    => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Only Top', 'rishi' ) . '</i>',

								'bottom' => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Only Bottom', 'rishi' ) . '</i>',

								'none'   => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Disabled', 'rishi' ) . '</i>',
							],
							'desc' => sprintf(
								// translators: placeholder here means the actual URL.
								__( 'You can customize the global spacing value in General ➝ Layout ➝ %1$sContent Area Spacing%2$s.', 'rishi' ),
								sprintf(
									'<a data-trigger-section="general" href="%s">',
                                    admin_url('/customize.php?autofocus[section]=general&rt_autofocus=general:layout_panel')
								),
								'</a>'
							),
						],
					],
				],
			],
		],

	 rishi__cb_customizer_rand_md5() => [
			'title'   => __('Design', 'rishi'),
			'type'    => 'tab',
			'options' => [

				 rishi__cb_customizer_rand_md5() => [
					'type'      => 'rt-condition',
					'condition' => [ 'content_style' => '!full_width_contained' ],
					'options'   => [
						'single_post_content_background' => [
							'label'      => __( 'Content Area Background', 'rishi' ),
							'type'       => 'rt-background',
							'design'     => 'block:right',
							'responsive' => true,
							'sync'       => 'live',
							'value'      => rishi__cb_customizer_background_default_value([
								'backgroundColor' => [
									'default' => [
										'color' => 'var(--paletteColor5)',
									],
								],
							])
						],

						'single_post_content_boxed_shadow' => [
							'label'      => __( 'Content Area Shadow', 'rishi' ),
							'type'       => 'rt-box-shadow',
							'responsive' => true,
							'divider'    => 'top',
							'sync'       => 'live',
							'value'      => rishi__cb_customizer_box_shadow_value([
								'enable'   => false,
								'h_offset' => 0,
								'v_offset' => 12,
								'blur'     => 18,
								'spread'   => -6,
								'inset'    => false,
								'color'    => [
									'color' => 'rgba(34, 56, 101, 0.04)',
								],
							])
						],

						'single_post_boxed_content_spacing' => [
							'label'   => __( 'Content Area Padding', 'rishi' ),
							'type'    => 'rt-spacing',
							'divider' => 'top',
							'value'   => [
								'desktop' =>    rishi__cb_customizer_spacing_value([
									'linked' => true,
									'top'    => '40px',
									'left'   => '40px',
									'right'  => '40px',
									'bottom' => '40px',
								]),
								'tablet' =>    rishi__cb_customizer_spacing_value([
									'linked' => true,
									'top'    => '15px',
									'left'   => '15px',
									'right'  => '15px',
									'bottom' => '15px',
								]),
								'mobile' =>    rishi__cb_customizer_spacing_value([
									'linked' => true,
									'top'    => '15px',
									'left'   => '15px',
									'right'  => '15px',
									'bottom' => '15px',
								])
							],
							'responsive' => true,
							'sync'       => 'live',
						],

						'single_post_content_boxed_radius' => [
							'label'   => __( 'Content Area Border Radius', 'rishi' ),
							'type'    => 'rt-spacing',
							'divider' => 'top',
							'value'   => rishi__cb_customizer_spacing_value([
								'linked' => true,
								'top'    => '3px',
								'left'   => '3px',
								'right'  => '3px',
								'bottom' => '3px',
							]),
							'responsive' => true,
							'sync'       => 'live',
						],

					],
				],
			],
		],

	 rishi__cb_customizer_rand_md5() => [
			'type' => 'rt-title',
			'label' => __('Post Elements', 'rishi'),
		],

		'disable_featured_image' => [
			'label' => __( 'Disable Featured Image', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],

		'disable_post_tags' => [
			'label' => __( 'Disable Post Tags', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],

		'disable_author_box' => [
			'label' => __( 'Disable Author Box', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],

		'disable_posts_navigation' => [
			'label' => __( 'Disable Posts Navigation', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],

		'disable_comments' => [
			'label' => __( 'Disable Comments', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],

		'disable_related_posts' => [
			'label' => __( 'Disable Related Posts', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],

		'disable_header' => [
			'label' => __( 'Disable Header', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],

		'disable_footer' => [
			'label' => __( 'Disable Footer', 'rishi' ),
			'type' => 'rara-switch',
			'value' => 'no',
		],
	],

	apply_filters(
		'rishi__cb_customizer_extensions_metabox_post_bottom',
		[]
	),
];
