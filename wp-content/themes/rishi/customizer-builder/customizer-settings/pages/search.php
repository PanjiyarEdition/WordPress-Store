<?php
/**
 * Search options
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$defaults = rishi__cb__get_layout_defaults();

$breaddefaults = rishi__cb__get_breadcrumbs_defaults();

$options = [
	'layouts_search_options' => [
		'type'               => 'rt-options',
		'setting'            => ['transport' => 'postMessage'],
		'customizer_section' => 'container',
		'inner-options'      => apply_filters( 'rishi__cb_:search:inneroptions', [
			'search_title_panel' => [
				'label'         => __( 'Page Title', 'rishi'),
				'type'          => 'rt-panel',
				'switch'        => true,
				'value'         => 'yes',
				'inner-options' => [
				 rishi__cb_customizer_rand_md5(  'rishi__cb:search:general') => [
						'title'   => __('General', 'rishi'),
						'type'    => 'tab',
						'options' => [
							'breadcrumbs_ed_search' => [
								'label'   => __('Breadcrumb', 'rishi'),
								'type'    => 'rara-switch',
								'value'   => $breaddefaults['breadcrumbs_ed_search'],
							],
							'search_page_label' => [
								'label'  => __('Search Page Label', 'rishi'),
								'type'   => 'text',
								'design' => 'block',
								'sync' => [
									'selector' => '.search-result-wrapper .rishi-searchres-inner .search-res',
									'render' => function() { echo rishi_search_page_label_activecallback(); }
								],
								'value'  => __( 'Search Result for','rishi' ),
							],
							'search_page_alignment' => [
								'type'       => 'rt-radio',
								'label'      => __('Horizontal Alignment', 'rishi'),
								'value'      => 'left',
								'view'       => 'text',
								'attr'       => ['data-type' => 'alignment'],
								'responsive' => false,
								'design'     => 'block',
								'choices' => [
									'left' => '',
									'center' => '',
									'right' => '',
								],
							],
							'search_page_search_ed' => [
								'label'   => __('Show Post Counts', 'rishi'),
								'type'    => 'rara-switch',
								'value'   => 'yes',
							],
							rishi__cb_customizer_rand_md5() => [
								'type' => 'rt-condition',
								'condition' => [ 'search_page_search_ed' => 'yes' ],
								'options' => [
									'search_page_search_margin' => [
										'label' => __('Bottom Spacing', 'rishi'),
										'type' => 'rt-slider',
										'value' => 30,
										'min' => 0,
										'max' => 300,
										'responsive' => false,
										'divider' => 'top',
										'setting' => ['transport' => 'postMessage'],
									],
								],
							],
							'search_page_margin' => [
								'label' => __('Vertical Spacing', 'rishi'),
								'type' => 'rt-slider',
								'value' => [
									'desktop' => 78,
									'tablet' => 30,
									'mobile' => 30,
								],
								'min' => 0,
								'max' => 300,
								'responsive' => true,
								'divider' => 'top',
								'setting' => ['transport' => 'postMessage'],
							],
						 	
						],
					],
				 rishi__cb_customizer_rand_md5() => [
						'title'   => __('Design', 'rishi'),
						'type'    => 'tab',
						'options' => [
							'search_page_header_content_background' => [
								'label' => __( 'Content Area Background', 'rishi' ),
								'type' => 'rt-background',
								'design' => 'block:right',
								'responsive' => true,
								'sync' => 'live',
								'value' => rishi__cb_customizer_background_default_value([
									'backgroundColor' => [
										'default' => [
											'color' => 'var(--paletteColor7)',
										],
									],
								])
							],
							'search_font_color' => [
								'label'           => __('Search Font Color', 'rishi'),
								'type'            => 'rt-color-picker',
								'skipEditPalette' => true,
								'design'          => 'inline',
								'setting'         => ['transport' => 'postMessage'],
								'value'           => [

									'default' => [
										'color' => 'var(--paletteColor2)',
									],
								],
								'pickers' => [
									[
										'title' => __('Initial', 'rishi'),
										'id'    => 'default',
									],
								],
							],
						],
					],
				]
			],
			'search_page_layout' => [
				'label'   => __('Search Page Layout', 'rishi'),
				'desc'    => __('Choose the search page layout for your site.', 'rishi'),
				'type'    => 'rt-image-picker',
				'value'   => $defaults['search_page_layout'],
				'choices' => [
					'classic' => [
						'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="275" viewBox="0 0 275 275"><defs><clipPath id="clip-_3"><rect width="275" height="275"/></clipPath></defs><g id="_3" data-name="3" clip-path="url(#clip-_3)"><rect width="200" height="275" transform="translate(35)"></rect><g id="Group_5677" data-name="Group 5677"><g id="Group_5731" data-name="Group 5731" transform="translate(27)"><g id="Group_5712" data-name="Group 5712" transform="translate(40 10)"><g id="Group_5714" data-name="Group 5714" transform="translate(0 95.257)"><rect id="Rectangle_356" data-name="Rectangle 356" width="6.699" transform="translate(21.212 14.89)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352" data-name="Rectangle 352" width="101.095" height="2.233" transform="translate(0 10.388)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353" data-name="Rectangle 353" width="110.027" height="2.233" transform="translate(0 15.934)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370" data-name="Rectangle 370" width="49.125" height="2.233" transform="translate(0 21.48)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385" data-name="Rectangle 385" width="116.837" height="5.765" fill="#566779" opacity="0.3"/></g><g id="Group_5713" data-name="Group 5713" transform="translate(0 86.643)"><rect id="Rectangle_457" data-name="Rectangle 457" width="34.588" height="3.459" transform="translate(23.059)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456" data-name="Rectangle 456" width="20.753" height="3.459" fill="#566779" opacity="0.25"/></g><g id="Group_5717" data-name="Group 5717" transform="translate(0 0)"><path id="Path_304" data-name="Path 304" d="M0,0H140.35V79.726H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(49.577 24.212)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M94.328,117.055A5.055,5.055,0,1,0,99.383,112,5.055,5.055,0,0,0,94.328,117.055Zm10.109,25.274H64L74.109,115.37l13.479,16.849,6.74-5.055Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5718" data-name="Group 5718" transform="translate(40 146.029)"><g id="Group_5714-2" data-name="Group 5714" transform="translate(0 97.257)"><rect id="Rectangle_356-2" data-name="Rectangle 356" width="6.699" transform="translate(21.212 14.89)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-2" data-name="Rectangle 352" width="101.095" height="2.233" transform="translate(0 10.388)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-2" data-name="Rectangle 353" width="110.027" height="2.233" transform="translate(0 15.934)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-2" data-name="Rectangle 370" width="49.125" height="2.233" transform="translate(0 21.48)" fill="#566779" opacity="0.25"/><rect id="Rectangle_385-2" data-name="Rectangle 385" width="116.837" height="5.765" fill="#566779" opacity="0.3"/></g><g id="Group_5713-2" data-name="Group 5713" transform="translate(0 87.643)"><rect id="Rectangle_457-2" data-name="Rectangle 457" width="34.588" height="3.459" transform="translate(23.059)" fill="#566779" opacity="0.25"/><rect id="Rectangle_456-2" data-name="Rectangle 456" width="20.753" height="3.459" fill="#566779" opacity="0.25"/></g><g id="Group_5717-2" data-name="Group 5717" transform="translate(0 0)"><path id="Path_304-2" data-name="Path 304" d="M0,0H140.35V79.726H0Z" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(49.577 24.212)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M94.328,117.055A5.055,5.055,0,1,0,99.383,112,5.055,5.055,0,0,0,94.328,117.055Zm10.109,25.274H64L74.109,115.37l13.479,16.849,6.74-5.055Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g></g></g></g></svg>',
						'title' => __('Classic Layout', 'rishi'),
					],
					'listing' => [
						'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="275" viewBox="0 0 275 275"><defs><clipPath id="clip-_1"><rect width="275" height="275"/></clipPath></defs><g id="_1" data-name="1" clip-path="url(#clip-_1)"><rect width="200" height="275" transform="translate(35)"></rect><g id="Group_5688" data-name="Group 5688" transform="translate(17 3)"><g id="Group_5806" data-name="Group 5806"><g id="Group_5646" data-name="Group 5646" transform="translate(34 12)"><g id="Group_5732" data-name="Group 5732" transform="translate(83.195 6.248)"><rect id="Rectangle_385" data-name="Rectangle 385" width="88.855" height="4.998" transform="translate(0 11.761)" fill="#566779" opacity="0.3"/><rect id="Rectangle_972" data-name="Rectangle 972" width="58.85" height="4.998" transform="translate(0 21.422)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456" data-name="Rectangle 456" width="25" height="5" transform="translate(0.284 -0.248)" fill="#566779" opacity="0.2"/><rect id="Rectangle_457" data-name="Rectangle 457" width="37" height="5" transform="translate(28.284 -0.248)" fill="#566779" opacity="0.2"/></g><path id="Path_304" data-name="Path 304" d="M0,0H75.128V42.676H0Z" transform="translate(0 0)" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(21.822 9.547)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M87.393,115.9a3.9,3.9,0,1,0,3.9-3.9A3.9,3.9,0,0,0,87.393,115.9Zm7.8,19.494H64L71.8,114.6l10.4,13,5.2-3.9Z" transform="translate(-64 -112)" fill="#fff"/></g><rect id="Rectangle_879" data-name="Rectangle 879" width="172.637" height="0.682" transform="translate(0 54.329)" fill="#566779" opacity="0.1"/></g><g id="Group_5646-2" data-name="Group 5646" transform="translate(34 79.477)"><g id="Group_5732-2" data-name="Group 5732" transform="translate(83.195 6.248)"><rect id="Rectangle_385-2" data-name="Rectangle 385" width="88.855" height="4.998" transform="translate(0 11.761)" fill="#566779" opacity="0.3"/><rect id="Rectangle_972-2" data-name="Rectangle 972" width="58.85" height="4.998" transform="translate(0 21.422)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-2" data-name="Rectangle 456" width="25" height="5" transform="translate(0.284 0.276)" fill="#566779" opacity="0.2"/><rect id="Rectangle_457-2" data-name="Rectangle 457" width="37" height="5" transform="translate(28.284 0.276)" fill="#566779" opacity="0.2"/></g><path id="Path_304-2" data-name="Path 304" d="M0,0H75.128V42.676H0Z" transform="translate(0 0)" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(21.822 9.547)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M87.393,115.9a3.9,3.9,0,1,0,3.9-3.9A3.9,3.9,0,0,0,87.393,115.9Zm7.8,19.494H64L71.8,114.6l10.4,13,5.2-3.9Z" transform="translate(-64 -112)" fill="#fff"/></g><rect id="Rectangle_879-2" data-name="Rectangle 879" width="172.637" height="0.682" transform="translate(0 54.329)" fill="#566779" opacity="0.1"/></g><g id="Group_5646-3" data-name="Group 5646" transform="translate(34 146.953)"><g id="Group_5732-3" data-name="Group 5732" transform="translate(83.195 6.248)"><rect id="Rectangle_385-3" data-name="Rectangle 385" width="88.855" height="4.998" transform="translate(0 11.761)" fill="#566779" opacity="0.3"/><rect id="Rectangle_972-3" data-name="Rectangle 972" width="58.85" height="4.998" transform="translate(0 21.422)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-3" data-name="Rectangle 456" width="25" height="5" transform="translate(0.284 -0.201)" fill="#566779" opacity="0.2"/><rect id="Rectangle_457-3" data-name="Rectangle 457" width="37" height="5" transform="translate(28.284 -0.201)" fill="#566779" opacity="0.2"/></g><path id="Path_304-3" data-name="Path 304" d="M0,0H75.128V42.676H0Z" transform="translate(0 0)" fill="#566779" opacity="0.2"/><g id="picture_1_3" data-name="picture (1)" transform="translate(21.822 9.547)" opacity="0.4"><path id="Path_198-3" data-name="Path 198" d="M87.393,115.9a3.9,3.9,0,1,0,3.9-3.9A3.9,3.9,0,0,0,87.393,115.9Zm7.8,19.494H64L71.8,114.6l10.4,13,5.2-3.9Z" transform="translate(-64 -112)" fill="#fff"/></g><rect id="Rectangle_879-3" data-name="Rectangle 879" width="172.637" height="0.682" transform="translate(0 54.329)" fill="#566779" opacity="0.1"/></g><g id="Group_5646-4" data-name="Group 5646" transform="translate(34 214.429)"><g id="Group_5732-4" data-name="Group 5732" transform="translate(83.195 6.248)"><rect id="Rectangle_385-4" data-name="Rectangle 385" width="88.855" height="4.998" transform="translate(0 11.761)" fill="#566779" opacity="0.3"/><rect id="Rectangle_972-4" data-name="Rectangle 972" width="58.85" height="4.998" transform="translate(0 21.422)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-4" data-name="Rectangle 456" width="25" height="5" transform="translate(0.284 0.323)" fill="#566779" opacity="0.2"/><rect id="Rectangle_457-4" data-name="Rectangle 457" width="37" height="5" transform="translate(28.284 0.323)" fill="#566779" opacity="0.2"/></g><path id="Path_304-4" data-name="Path 304" d="M0,0H75.128V42.676H0Z" transform="translate(0 0)" fill="#566779" opacity="0.2"/><g id="picture_1_4" data-name="picture (1)" transform="translate(21.822 9.547)" opacity="0.4"><path id="Path_198-4" data-name="Path 198" d="M87.393,115.9a3.9,3.9,0,1,0,3.9-3.9A3.9,3.9,0,0,0,87.393,115.9Zm7.8,19.494H64L71.8,114.6l10.4,13,5.2-3.9Z" transform="translate(-64 -112)" fill="#fff"/></g><rect id="Rectangle_879-4" data-name="Rectangle 879" width="172.637" height="0.682" transform="translate(0 54.329)" fill="#566779" opacity="0.1"/></g><g id="Group_5646-5" data-name="Group 5646" transform="translate(34 281.905)"><g id="Group_5732-5" data-name="Group 5732" transform="translate(83.195 6.248)"><rect id="Rectangle_385-5" data-name="Rectangle 385" width="88.855" height="4.998" transform="translate(0 11.761)" fill="#566779" opacity="0.3"/><rect id="Rectangle_972-5" data-name="Rectangle 972" width="58.85" height="4.998" transform="translate(0 21.422)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-5" data-name="Rectangle 456" width="25" height="5" transform="translate(0.284 -0.153)" fill="#566779" opacity="0.2"/><rect id="Rectangle_457-5" data-name="Rectangle 457" width="37" height="5" transform="translate(28.284 -0.153)" fill="#566779" opacity="0.2"/></g><path id="Path_304-5" data-name="Path 304" d="M0,0H75.128V42.676H0Z" transform="translate(0 0)" fill="#566779" opacity="0.2"/><g id="picture_1_5" data-name="picture (1)" transform="translate(21.822 9.547)" opacity="0.4"><path id="Path_198-5" data-name="Path 198" d="M87.393,115.9a3.9,3.9,0,1,0,3.9-3.9A3.9,3.9,0,0,0,87.393,115.9Zm7.8,19.494H64L71.8,114.6l10.4,13,5.2-3.9Z" transform="translate(-64 -112)" fill="#fff"/></g><rect id="Rectangle_879-5" data-name="Rectangle 879" width="172.637" height="0.682" transform="translate(0 54.329)" fill="#566779" opacity="0.1"/></g></g></g></g></svg>',
						'title' => __('Listing Layout', 'rishi'),
					],
					'grid' => [
						'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="275" viewBox="0 0 275 275"><defs><clipPath id="clip-_1"><rect width="275" height="275"/></clipPath></defs><g id="_1" data-name="1" clip-path="url(#clip-_1)"><rect width="240" height="275" transform="translate(15)"></rect><g id="Group_5706" data-name="Group 5706"><g id="Group_5705" data-name="Group 5705"><g id="Group_5735" data-name="Group 5735" transform="translate(151)"><rect id="Rectangle_352" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 67.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 72.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 77.584)" fill="#566779" opacity="0.25"/><g id="Group_5739" data-name="Group 5739" transform="translate(0 -1)"><rect id="Rectangle_879" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738" data-name="Group 5738"><rect id="Rectangle_458" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5743" data-name="Group 5743" transform="translate(10)"><rect id="Rectangle_352-2" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 67.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-2" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 72.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-2" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 77.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-2" data-name="Group 5739" transform="translate(0 -1)"><rect id="Rectangle_879-2" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-2" data-name="Group 5738"><rect id="Rectangle_458-2" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-2" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-2" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221-2" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-2" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-2" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-2" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_2" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5744" data-name="Group 5744" transform="translate(81)"><rect id="Rectangle_352-3" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 67.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-3" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 72.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-3" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 77.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-3" data-name="Group 5739" transform="translate(0 -1)"><rect id="Rectangle_879-3" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-3" data-name="Group 5738"><rect id="Rectangle_458-3" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-3" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-3" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221-3" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-3" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-3" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-3" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_3" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-3" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5745" data-name="Group 5745" transform="translate(0 93)"><g id="Group_5735-2" data-name="Group 5735" transform="translate(151)"><rect id="Rectangle_352-4" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 60.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-4" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 65.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-4" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 70.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-4" data-name="Group 5739" transform="translate(0 -8)"><rect id="Rectangle_879-4" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-4" data-name="Group 5738"><rect id="Rectangle_458-4" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-4" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-4" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-4" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-4" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-4" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_4" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-4" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5743-2" data-name="Group 5743" transform="translate(10)"><rect id="Rectangle_352-5" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 60.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-5" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 65.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-5" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 70.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-5" data-name="Group 5739" transform="translate(0 -8)"><rect id="Rectangle_879-5" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-5" data-name="Group 5738"><rect id="Rectangle_458-5" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-5" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-5" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-5" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-5" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-5" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_5" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-5" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5744-2" data-name="Group 5744" transform="translate(81)"><rect id="Rectangle_352-6" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 60.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-6" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 65.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-6" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 70.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-6" data-name="Group 5739" transform="translate(0 -8)"><rect id="Rectangle_879-6" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-6" data-name="Group 5738"><rect id="Rectangle_458-6" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-6" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-6" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-6" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-6" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-6" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_6" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-6" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g><g id="Group_5746" data-name="Group 5746" transform="translate(0 179)"><g id="Group_5735-3" data-name="Group 5735" transform="translate(151)"><rect id="Rectangle_352-7" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 67.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-7" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 72.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-7" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 77.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-7" data-name="Group 5739" transform="translate(0 -1)"><rect id="Rectangle_879-7" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-7" data-name="Group 5738"><rect id="Rectangle_458-7" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-7" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-7" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221-4" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-7" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-7" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-7" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_7" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-7" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5743-3" data-name="Group 5743" transform="translate(10)"><rect id="Rectangle_352-8" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 67.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-8" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 72.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-8" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 77.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-8" data-name="Group 5739" transform="translate(0 -1)"><rect id="Rectangle_879-8" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-8" data-name="Group 5738"><rect id="Rectangle_458-8" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-8" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-8" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221-5" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-8" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-8" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-8" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_8" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-8" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5744-3" data-name="Group 5744" transform="translate(81)"><rect id="Rectangle_352-9" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 67.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-9" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 72.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-9" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 77.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-9" data-name="Group 5739" transform="translate(0 -1)"><rect id="Rectangle_879-9" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-9" data-name="Group 5738"><rect id="Rectangle_458-9" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-9" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-9" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221-6" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-9" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-9" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-9" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_9" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-9" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g></g></g></svg>',
						'title' => __('Grid Layout', 'rishi'),
					],
					'masonry_grid' => [
						'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="275" viewBox="0 0 275 275"><defs><clipPath id="clip-_2"><rect width="275" height="275"/></clipPath></defs><g id="_2" data-name="2" clip-path="url(#clip-_2)"><rect width="240" height="275" transform="translate(15)"></rect><g id="Group_5706" data-name="Group 5706"><g id="Group_5705" data-name="Group 5705"><rect id="Rectangle_356" data-name="Rectangle 356" width="5.81" transform="translate(56.398 76.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1226" data-name="Rectangle 1226" width="5.81" transform="translate(56.398 266.097)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(38 72.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1227" data-name="Rectangle 1227" width="51.988" height="1.937" transform="translate(38 262.192)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353" data-name="Rectangle 353" width="55.581" height="1.937" transform="translate(38 77.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1228" data-name="Rectangle 1228" width="55.581" height="1.937" transform="translate(38 267.002)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(38 82.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_879" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(38 90.584)" fill="#566779" opacity="0.1"/><rect id="Rectangle_458" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(38 95.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(81 95.584)" fill="#566779" opacity="0.15"/><rect id="Rectangle_385" data-name="Rectangle 385" width="55.15" height="3.5" transform="translate(38 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1222" data-name="Rectangle 1222" width="55.15" height="3.5" transform="translate(38 241.182)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1161" data-name="Rectangle 1161" width="49.15" height="3.5" transform="translate(38 58.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1223" data-name="Rectangle 1223" width="49.15" height="3.5" transform="translate(38 247.182)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1178" data-name="Rectangle 1178" width="25.15" height="3.5" transform="translate(38 64.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1225" data-name="Rectangle 1225" width="25.15" height="3.5" transform="translate(38 253.182)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456" data-name="Rectangle 456" width="18" height="3" transform="translate(38 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1224" data-name="Rectangle 1224" width="18" height="3" transform="translate(38 234.229)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457" data-name="Rectangle 457" width="27" height="3" transform="translate(58 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_1229" data-name="Rectangle 1229" width="27" height="3" transform="translate(58 234.229)" fill="#566779" opacity="0.25"/><path id="Path_304" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(38 10)" fill="#566779" opacity="0.2"/><path id="Path_23068" data-name="Path 23068" d="M0,0H55.085V31.291H0Z" transform="translate(38 198.229)" fill="#566779" opacity="0.2"/><g id="picture_1_" data-name="picture (1)" transform="translate(57.458 19.503)" opacity="0.4"><path id="Path_198" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g><g id="picture_1_2" data-name="picture (1)" transform="translate(57.458 207.732)" opacity="0.4"><path id="Path_198-2" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g><g id="Group_5623" data-name="Group 5623" transform="translate(81)"><rect id="Rectangle_356-2" data-name="Rectangle 356" width="5.81" transform="translate(46.398 70.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-2" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 60.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-2" data-name="Rectangle 353" width="55.581" height="1.937" transform="translate(28 65.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-2" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 70.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_879-2" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 78.584)" fill="#566779" opacity="0.1"/><rect id="Rectangle_458-2" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 83.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-2" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 83.584)" fill="#566779" opacity="0.15"/><rect id="Rectangle_385-2" data-name="Rectangle 385" width="55.15" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-2" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-2" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-2" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_3" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-3" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5741" data-name="Group 5741" transform="translate(81 180.479)"><rect id="Rectangle_356-3" data-name="Rectangle 356" width="5.81" transform="translate(46.398 70.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-3" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 60.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-3" data-name="Rectangle 353" width="55.581" height="1.937" transform="translate(28 65.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-3" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 70.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_879-3" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 78.584)" fill="#566779" opacity="0.1"/><rect id="Rectangle_458-3" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 83.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-3" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 83.584)" fill="#566779" opacity="0.15"/><rect id="Rectangle_385-3" data-name="Rectangle 385" width="55.15" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-3" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-3" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-3" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_4" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-4" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5735" data-name="Group 5735" transform="translate(150.892)"><rect id="Rectangle_352-4" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 66.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-4" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 71.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-4" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 76.584)" fill="#566779" opacity="0.25"/><g id="Group_5739" data-name="Group 5739" transform="translate(0 -2)"><rect id="Rectangle_879-4" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738" data-name="Group 5738"><rect id="Rectangle_458-4" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-4" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-4" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-4" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-4" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-4" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_5" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-5" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5742" data-name="Group 5742" transform="translate(150.892 180.168)"><rect id="Rectangle_352-5" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 66.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-5" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 71.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-5" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 76.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-2" data-name="Group 5739" transform="translate(0 -2)"><rect id="Rectangle_879-5" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-2" data-name="Group 5738"><rect id="Rectangle_458-5" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-5" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-5" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221-2" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 59.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-5" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-5" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-5" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_6" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-6" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5740" data-name="Group 5740" transform="translate(81 86.584)"><rect id="Rectangle_352-6" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 67.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-6" data-name="Rectangle 353" width="55.085" height="1.937" transform="translate(28 72.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-6" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 77.584)" fill="#566779" opacity="0.25"/><g id="Group_5739-3" data-name="Group 5739" transform="translate(0 -1)"><rect id="Rectangle_879-6" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 86.584)" fill="#566779" opacity="0.1"/><g id="Group_5738-3" data-name="Group 5738"><rect id="Rectangle_458-6" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 91.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-6" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 91.584)" fill="#566779" opacity="0.15"/></g></g><rect id="Rectangle_385-6" data-name="Rectangle 385" width="55.085" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_1221-3" data-name="Rectangle 1221" width="39.085" height="3.5" transform="translate(28 60.463)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-6" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-6" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-6" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_7" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-7" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5736" data-name="Group 5736" transform="translate(10 102.115)"><rect id="Rectangle_356-4" data-name="Rectangle 356" width="5.81" transform="translate(46.398 70.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-7" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 60.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-7" data-name="Rectangle 353" width="55.581" height="1.937" transform="translate(28 65.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-7" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 70.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_879-7" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 78.584)" fill="#566779" opacity="0.1"/><rect id="Rectangle_458-7" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 83.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-7" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 83.584)" fill="#566779" opacity="0.15"/><rect id="Rectangle_385-7" data-name="Rectangle 385" width="55.15" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-7" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-7" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-7" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_8" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-8" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g><g id="Group_5737" data-name="Group 5737" transform="translate(150.892 93.584)"><rect id="Rectangle_356-5" data-name="Rectangle 356" width="5.81" transform="translate(46.398 70.868)" fill="#566779" opacity="0.25"/><rect id="Rectangle_352-8" data-name="Rectangle 352" width="51.988" height="1.937" transform="translate(28 60.963)" fill="#566779" opacity="0.25"/><rect id="Rectangle_353-8" data-name="Rectangle 353" width="55.581" height="1.937" transform="translate(28 65.773)" fill="#566779" opacity="0.25"/><rect id="Rectangle_370-8" data-name="Rectangle 370" width="43.788" height="1.937" transform="translate(28 70.584)" fill="#566779" opacity="0.25"/><rect id="Rectangle_879-8" data-name="Rectangle 879" width="55.581" height="0.5" transform="translate(28 78.584)" fill="#566779" opacity="0.1"/><rect id="Rectangle_458-8" data-name="Rectangle 458" width="12.608" height="1.937" transform="translate(28 83.584)" fill="#566779" opacity="0.4"/><rect id="Rectangle_873-8" data-name="Rectangle 873" width="12.608" height="1.937" transform="translate(71 83.584)" fill="#566779" opacity="0.15"/><rect id="Rectangle_385-8" data-name="Rectangle 385" width="55.15" height="3.5" transform="translate(28 52.953)" fill="#566779" opacity="0.3"/><rect id="Rectangle_456-8" data-name="Rectangle 456" width="18" height="3" transform="translate(28 46)" fill="#566779" opacity="0.25"/><rect id="Rectangle_457-8" data-name="Rectangle 457" width="27" height="3" transform="translate(48 46)" fill="#566779" opacity="0.25"/><path id="Path_304-8" data-name="Path 304" d="M0,0H55.085V31.291H0Z" transform="translate(28 10)" fill="#566779" opacity="0.2"/><g id="picture_1_9" data-name="picture (1)" transform="translate(47.458 19.503)" opacity="0.4"><path id="Path_198-9" data-name="Path 198" d="M75.9,113.984A1.984,1.984,0,1,0,77.887,112,1.984,1.984,0,0,0,75.9,113.984Zm3.968,9.92H64l3.968-10.581,5.29,6.613,2.645-1.984Z" transform="translate(-64 -112)" fill="#fff"/></g></g></g></g></g></svg>',
						'title' => __('Masonry Grid Layout', 'rishi'),
					],
				],
			],
			'search_post_structure' => [
				'label'    => __('Post Elements', 'rishi'),
				'type'     => 'rt-layers',
				'attr'     => ['data-layers' => 'title-elements'],
				'design'   => 'block',
				'divider'  => 'top',
				'value'    => rishi__cb__get_default_blogpost_structure(),
				'settings' => [
					'excerpt' => [
						'label'   => __('Excerpt', 'rishi'),
						'options' => [
							'post_content' => [
								'label'   => __('Post Content', 'rishi'),
								'type'    => 'rt-select',
								'view'    => 'text',
								'design'  => 'inline',
								'choices' => rishi__cb_customizer_ordered_keys([
									'content' => __('Content', 'rishi'),
									'excerpt' => __('Excerpt', 'rishi'),
								]),
							],
						 rishi__cb_customizer_rand_md5() => [
								'type'      => 'rt-condition',
								'condition' => ['post_content' => 'excerpt'],
								'options'   => [
									'excerpt_length' => [
										'label'  => __('Length', 'rishi'),
										'desc'   => __('Choose the number of words to display in excerpt.', 'rishi'),
										'type'   => 'rt-number',
										'design' => 'inline',
										'min'    => 10,
										'max'    => 100,
									],
								]
							],
						],
					],
					'read_more' => [
						'label'   => __('Read More Button', 'rishi'),
						'options' => [
							'button_type' => [
								'label'   => false,
								'type'    => 'rt-radio',
								'view'    => 'text',
								'choices' => [
									'simple' => __('Simple', 'rishi'),
									'button' => __('Button', 'rishi'),
								],
								'sync' => [
									'id' => 'search_order_skip',
								]
							],
							'read_more_text' => [
								'label'  => __('Text', 'rishi'),
								'type'   => 'text',
								'design' => 'inline',
								'sync'   => [
									'id' => 'search_order_skip',
								]
							],
							'read_more_arrow' => [
								'label' => __('Show Arrow', 'rishi'),
								'type'  => 'rara-switch',
								'sync'  => [
									'id' => 'search_order_button',
								]
							],
						],
					],
					'divider' => [
						'label' => __('Divider', 'rishi'),
						'clone' => true,
                        'options' => [
                            'divider_margin' => [
                                'label'      => __('Margin', 'rishi'),
                                'type'       => 'rt-spacing',
                                'setting'    => ['transport' => 'postMessage'],
                                'responsive' => true
                            ],
                        ],
						'sync'  => [
							'id' => 'search_order_meta'
						],
					],
					'featured_image' => [
						'label'   => __('Featured Image', 'rishi'),
						'options' => rishi__cb_customizer_get_options( 'single-elements/featured-image' ),
					],
					'custom_title' => [
						'label'   => __('Title', 'rishi'),
						'options' => [
							'heading_tag' => [
								'label'  => __('Heading tag', 'rishi'),
								'type'   => 'rt-select',
								'view'   => 'text',
								'design' => 'inline',
								'sync'   => [
									'id' => 'search_order_heading_tag',
								],
								'choices' => rishi__cb_customizer_ordered_keys(
									[
										'h1' => 'H1',
										'h2' => 'H2',
										'h3' => 'H3',
										'h4' => 'H4',
										'h5' => 'H5',
										'h6' => 'H6',
									]
								),
							],
                            'font_size' => [
                                'label'   => __( 'Font Size', 'rishi' ),
                                'type'  => 'rt-slider',
                                'units' => rishi__cb_customizer_units_config([
                                    ['unit' => 'px', 'min' => 0, 'max' => 150],
                                ]),
                                'responsive' => true,
                                'setting'    => ['transport' => 'postMessage'],
                            ],
						],
					],
					'custom_meta' => [
						'label' => __('Post Meta', 'rishi'),
						'clone' => true,
						'sync'  => [
							'id' => 'hero_elements_meta'
						],
						'options' => [
						 rishi__cb_customizer_get_options('general/meta', [
								'skip_sync_id' => [
									'id' => 'hero_elements_spacing',
								],
							])
						],
					],
				]
			],
			'search_post_navigation' => [
				'label'   => __('Posts Navigation', 'rishi'),
				'type'    => 'rt-select',
				'value'   => $defaults['search_post_navigation'],
				'view'    => 'text',
				'design'  => 'inline',
				'divider' => 'top',
				'choices' => rishi__cb_customizer_ordered_keys([
					'numbered'        => __('Numbered', 'rishi'),
					'infinite_scroll' => __('Infinite Scroll', 'rishi'),
				]),
			],
		 rishi__cb_customizer_rand_md5() => [
				'type'      => 'rt-condition',
				'condition' => [ 'search_page_layout' => 'grid | masonry_grid' ],
				'options'   => [
                    'search_posts_per_row' => [
                        'label'      => __('Number of Posts per Row', 'rishi'),
                        'type'       => 'rt-number',
                        'design'     => 'inline',
                        'value'      => $defaults['search_posts_per_row'],
                        'min'        => 2,
                        'max'        => 4,
                        'divider'    => 'top',
                        'responsive' => false,
                    ],
                ]
            ],
			'search_sidebar_layout' => [
				'label'   => __('Sidebar Layout', 'rishi'),
				'type'    => 'rt-image-picker',
				'value'   => $defaults['search_sidebar_layout'],
				'attr'  => [
					'data-type'    => 'background',
					'data-usage'   => 'layout-style',
					'data-columns' => '2',
				],
				'desc' => __('Choose sidebar layout for search page.', 'rishi'),
				'divider' => 'top',
				'choices' => [
					'default-sidebar' => [
						'src'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="120" viewBox="0 0 219 119"><g id="Default" clip-path="url(#clip-Default)"><g id="Group_5761" data-name="Group 5761" transform="translate(8842 3234)"><g id="Group_5759" data-name="Group 5759" transform="translate(-8919.772 -3250)"><text id="Default-2" data-name="Default" transform="translate(187.772 93)" font-size="43" font-family="SegoeUI-Semibold, Segoe UI" font-weight="600" letter-spacing="-0.02em" fill="#8995A1"><tspan x="-68.828" y="0">Default</tspan></text></g></g></g></svg>',
						'title' => __('Default Sidebar', 'rishi'),
					],
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
			'search_layout' => [
                'label'   => __('Search Container', 'rishi'),
                'type'    => 'rt-select',
                'value'   => $defaults['search_layout'],
                'view'    => 'text',
                'design'  => 'inline',
                'divider' => 'top',
                'choices' => rishi__cb_customizer_ordered_keys([
                    'default'              => __('Default', 'rishi'),
                    'boxed'                => __('Boxed', 'rishi'),
                    'content_boxed'        => __('Content Boxed', 'rishi'),
                    'full_width_contained' => __('Unboxed', 'rishi'),
                ]),
                'desc' => __('Choose search page container layout.', 'rishi'),
            ],
            'search_layout_streched_ed' => [
                'label'   => __('Stretch Layout', 'rishi'),
                'desc'    => __('This setting stretches the container width.', 'rishi'),
                'type'    => 'rara-switch',
                'value'   => $defaults['search_layout_streched_ed'],
            ],
		]),
	],
];
