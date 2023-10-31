<?php

class rishi__cb_customizer_Fonts_Manager {

	public function get_all_fonts() {
		return apply_filters(
			'rishi__cb_customizer_typography_font_sources',
			array(
				'system' => array(
					'type'     => 'system',
					'families' => $this->get_system_fonts(),
				),

				'google' => array(
					'type'     => 'google',
					'families' => $this->get_googgle_fonts(),
				),
			)
		);
	}

	public function get_static_fonts_ids() {
		$additional_font_sources = apply_filters( 'rishi__cb_customizer_static_font_ids', [] );
		return array_merge(
			array(
				'rootTypography',
				get_theme_mod(
					'h1Typography',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'        => '40px',
							'variation'   => 'n7',
							'line-height' => '1.5',
						)
					)
				),
				get_theme_mod(
					'h2Typography',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'        => '35px',
							'variation'   => 'n7',
							'line-height' => '1.5',
						)
					)
				),
				get_theme_mod(
					'h3Typography',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'        => '30px',
							'variation'   => 'n7',
							'line-height' => '1.5',
						)
					)
				),
				get_theme_mod(
					'h4Typography',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'        => '25px',
							'variation'   => 'n7',
							'line-height' => '1.5',
						)
					)
				),
				get_theme_mod(
					'h5Typography',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'        => '20px',
							'variation'   => 'n7',
							'line-height' => '1.5',
						)
					)
				),
				get_theme_mod(
					'h6Typography',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'        => '16px',
							'variation'   => 'n7',
							'line-height' => '1.5',
						)
					)
				),
				get_theme_mod(
					'blockquote',
					rishi__cb_customizer_typography_default_values(
						array(
							'family'    => 'Georgia',
							'size'      => '25px',
							'variation' => 'n6',
						)
					)
				),
				get_theme_mod(
					'pre',
					rishi__cb_customizer_typography_default_values(
						array(
							'family'    => 'monospace',
							'size'      => '16px',
							'variation' => 'n4',
						)
					)
				),
				get_theme_mod(
					'sidebarWidgetsTitleFont',
					rishi__cb_customizer_typography_default_values(
						array(
							'size' => '18px',
						)
					)
				),
				get_theme_mod(
					'singleProductTitleFont',
					rishi__cb_customizer_typography_default_values(
						array(
							'size' => array(
								'desktop' => '30px',
								'tablet'  => '30px',
								'mobile'  => '23px',
							),
						)
					)
				),
				get_theme_mod(
					'cardProductTitleFont',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'      => '17px',
							'variation' => 'n6',
						)
					)
				),
				get_theme_mod(
					'breadcrumbsTypo',
					rishi__cb_customizer_typography_default_values(
						array(
							'family'    => 'System Default',
							'size'      => '14px',
							'variation' => 'n5',
						)
					)
				),
				get_theme_mod(
					'button_Typo',
					rishi__cb_customizer_typography_default_values(
						array(
							'family'    => 'Default',
							'size'      => '18px',
							'variation' => 'n4',
							'line-height' => '1.2',
						)
					)
				),
				get_theme_mod(
					'single_blog_post_title_typo',
					rishi__cb_customizer_typography_default_values([
						'size'      => '14px',
						'variation' => 'n5',
					])
				),
				get_theme_mod(
					'wooNoticeTypo',
					rishi__cb_customizer_typography_default_values(
						array(
							'family'    => 'System Default',
							'size'      => '18px',
							'variation' => 'n4',
						)
					)
				),
				get_theme_mod(
					'woo_shop_title_typo',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'      => [
								'desktop' => '40px',
								'tablet'  => '40px',
								'mobile'  => '40px'
							],
							'line-height' => '1.75',
							'variation'   => 'n7',
						)
					)
				),
				get_theme_mod(
					'woo_shop_button_typo',
					rishi__cb_customizer_typography_default_values(
						array(
							'size' => [
								'desktop' => '11px',
								'tablet'  => '11px',
								'mobile'  => '11px'
							],
							'variation'   => 'n4',
							'line-height' => '1',
							'letter-spacing' => '1px'
						)
					)
				),
				get_theme_mod(
					'cardProductTitleTypo',
					rishi__cb_customizer_typography_default_values(
						array(
							'size' => [
								'desktop' => '20px',
								'tablet'  => '16px',
								'mobile'  => '16px'
							],
							'variation'   => 'n4',
							'line-height' => '1.5',
							'letter-spacing' => '1px'
						)
					)
				),
				get_theme_mod(
					'cardProductTitlePriceTypo',
					rishi__cb_customizer_typography_default_values(
						array(
							'size' => [
								'desktop' => '20px',
								'tablet'  => '16px',
								'mobile'  => '16px'
							],
							'variation'   => 'n4',
							'line-height' => '1.33',
							'letter-spacing' => '1px'
						)
					)
				),
				get_theme_mod(
					'trigger_typo',
					rishi__cb_customizer_typography_default_values(
						array(
							'family'    => 'Default',
							'size'      => '18px',
							'variation' => 'n4',
						)
					)
				),
				get_theme_mod(
					'featured_image_caption_typo',
					rishi__cb_customizer_typography_default_values(
						array(
							'size'        => '14px',
							'variation'   => 'n4',
							'line-height' => '1.5'
						)
					)
				),
			), 
			$additional_font_sources
		);
	}

	public function get_dynamic_fonts_ids() {
		$prefix = rishi__cb_customizer_manager()->screen->get_prefix();

		$fonts_ids = array_merge(
			array(
				$prefix . '_cardTitleFont',
				$prefix . '_cardExcerptFont',
				$prefix . '_cardMetaFont',
				$prefix . '_pageMetaFont',
			),
			rishi__cb_customizer_manager()->builder->typography_keys()
		);

		$page_title_source = rishi__cb_customizer_get_page_title_source();

		if ( $page_title_source ) {
			$fonts_ids[] = rishi__cb_get_akv_or_customizer(
				'pageTitleFont',
				$page_title_source,
				rishi__cb_customizer_typography_default_values(
					array(
						'size'        => array(
							'desktop' => '32px',
							'tablet'  => '30px',
							'mobile'  => '25px',
						),
						'variation'   => 'n7',
						'line-height' => '1.3',
					)
				)
			);

			$fonts_ids[] = rishi__cb_get_akv_or_customizer(
				'pageMetaFont',
				$page_title_source,
				rishi__cb_customizer_typography_default_values(
					array(
						'size'           => array(
							'desktop' => '12px',
							'tablet'  => '12px',
							'mobile'  => '12px',
						),
						'variation'      => 'n6',
						'line-height'    => '1.3',
						'text-transform' => 'uppercase',
					)
				)
			);

			$fonts_ids[] = rishi__cb_get_akv_or_customizer(
				'pageExcerptFont',
				$page_title_source,
				rishi__cb_customizer_typography_default_values(
					array(
						'variation' => 'n5',
					)
				)
			);
		}

		return $fonts_ids;
	}

	public function load_dynamic_google_fonts() {
		
		$url = $this->get_google_fonts_url(
			array_merge(
				$this->get_static_fonts_ids(),
				$this->get_dynamic_fonts_ids()
			)
		);

		$has_dynamic_google_fonts = apply_filters(
			'rishi:typography:google:use-remote',
			true
		);

		do_action( 'rt:load_dynamic_google_fonts', $url );

		if ( ! $has_dynamic_google_fonts ) {
			return;
		}		

		if ( ! empty( $url ) ) {
			wp_register_style( 'rishi-fonts-font-source-google', $url, array(), null );
			wp_enqueue_style( 'rishi-fonts-font-source-google' );
		}
	}

	public function load_editor_fonts() {
		$has_dynamic_google_fonts = apply_filters(
			'rishi:typography:google:use-remote',
			true
		);

		if ( ! $has_dynamic_google_fonts ) {
			return;
		}

		$url = $this->get_google_fonts_url( $this->get_static_fonts_ids() );

		if ( ! empty( $url ) ) {
			wp_register_style( 'rishi-fonts-font-source-google', $url, array(), null );
			wp_enqueue_style( 'rishi-fonts-font-source-google' );
		}
	}

	private function get_google_fonts_url( $fonts_ids = array() ) {
		 $all_fonts = $this->get_system_fonts();

		$system_fonts_families = array();

		foreach ( $all_fonts as $single_google_font ) {
			$system_fonts_families[] = $single_google_font['family'];
		}

		$to_enqueue = array();

		$default_family = get_theme_mod(
			'rootTypography',
			rishi__cb_customizer_typography_default_values(
				array(
					'family'          => 'System Default',
					'variation'       => 'n4',
					'size'            => '17px',
					'line-height'     => '1.75',
					'letter-spacing'  => '0em',
					'text-transform'  => 'none',
					'text-decoration' => 'none',
				)
			)
		);

		$default_variation = $default_family['variation'];
		$default_family    = $default_family['family'];

		$all_google_fonts = $this->get_googgle_fonts( true );

		foreach ( $fonts_ids as $font_id ) {
			if ( is_array( $font_id ) ) {
				$value = $font_id;
			} else {
				$value = get_theme_mod( $font_id, null );
			}

			if ( $value && $value['family'] === 'Default' ) {
				$value['family'] = $default_family;
			}

			if ( $value && $value['variation'] === 'Default' ) {
				$value['variation'] = $default_variation;
			}

			if (
				! $value
				||
				! isset( $value['family'] )
				||
				in_array( $value['family'], $system_fonts_families )
				||
				$value['family'] === 'Default'
				||
				! isset( $all_google_fonts[ $value['family'] ] )
			) {
				continue;
			}

			if ( ! isset( $to_enqueue[ $value['family'] ] ) ) {
				$to_enqueue[ $value['family'] ] = array( $value['variation'] );
			} else {
				$to_enqueue[ $value['family'] ][] = $value['variation'];
			}

			$to_enqueue[ $value['family'] ] = array_unique(
				$to_enqueue[ $value['family'] ]
			);
		}

		$url = 'https://fonts.googleapis.com/css2?';

		$families = array();

		foreach ( $to_enqueue as $family => $variations ) {
			$to_push = 'family=' . $family . ':';

			$ital_vars = array();
			$wght_vars = array();

			foreach ( $variations as $variation ) {
				$var_to_push  = intval( $variation[1] ) * 100;
				$var_to_push .= $variation[0] === 'i' ? 'i' : '';

				if ( $variation[0] === 'i' ) {
					$ital_vars[] = intval( $variation[1] ) * 100;
				} else {
					$wght_vars[] = intval( $variation[1] ) * 100;
				}
			}

			sort( $ital_vars );
			sort( $wght_vars );

			$axis_tag_list = array();

			if ( count( $ital_vars ) > 0 ) {
				$axis_tag_list[] = 'ital';
			}

			if ( count( $wght_vars ) > 0 ) {
				$axis_tag_list[] = 'wght';
			}

			$to_push .= implode( ',', $axis_tag_list );
			$to_push .= '@';

			$all_vars = array();

			foreach ( $ital_vars as $ital_var ) {
				$all_vars[] = '0,' . $ital_var;
			}

			foreach ( $wght_vars as $wght_var ) {
				if ( count( $axis_tag_list ) > 1 ) {
					$all_vars[] = '1,' . $wght_var;
				} else {
					$all_vars[] = $wght_var;
				}
			}

			$to_push .= implode( ';', $all_vars );

			$families[] = $to_push;
		}

		$families = implode( '&', $families );

		if ( ! empty( $families ) ) {
			$url .= $families;

			if( apply_filters('rt_google_font_add_display_swap', true ) ){
				$url .= '&display=swap';
			}

			return $url;
		}	

		return false;
	}

	public function get_system_fonts() {
		$system = array(
			'System Default',
			'Arial',
			'Verdana',
			'Trebuchet',
			'Georgia',
			'Times New Roman',
			'Palatino',
			'Helvetica',
			'Myriad Pro',
			'Lucida',
			'Gill Sans',
			'Impact',
			'Serif',
			'monospace',
		);

		$result = array();

		foreach ( $system as $font ) {
			$result[] = array(
				'source'         => 'system',
				'family'         => $font,
				'variations'     => array(),
				'all_variations' => $this->get_standard_variations_descriptors(),
			);
		}

		return $result;
	}

	public function get_standard_variations_descriptors() {
		 return array(
			 'n1',
			 'i1',
			 'n2',
			 'i2',
			 'n3',
			 'i3',
			 'n4',
			 'i4',
			 'n5',
			 'i5',
			 'n6',
			 'i6',
			 'n7',
			 'i7',
			 'n8',
			 'i8',
			 'n9',
			 'i9',
		 );
	}

	public function all_google_fonts() {
		$saved_data = get_option( 'rishi__cb_customizer_google_fonts', false );
		$ttl        = 7 * DAY_IN_SECONDS;

		if (
			false === $saved_data
			||
			( ( $saved_data['last_update'] + $ttl ) < time() )
			||
			! is_array( $saved_data )
			||
			! isset( $saved_data['fonts'] )
			||
			empty( $saved_data['fonts'] )
		) {
			$response = wp_remote_get(
				RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/customizer-settings/google-fonts/google-fonts.json'
			);

			$body = wp_remote_retrieve_body( $response );

			if (
				200 === wp_remote_retrieve_response_code( $response )
				&&
				! is_wp_error( $body ) && ! empty( $body )
			) {
				update_option(
					'rishi__cb_customizer_google_fonts',
					array(
						'last_update' => time(),
						'fonts'       => $body,
					),
					false
				);

				return $body;
			} else {
				if ( empty( $saved_data['fonts'] ) ) {
					$saved_data['fonts'] = json_encode( array( 'items' => array() ) );
				}

				update_option(
					'rishi__cb_customizer_google_fonts',
					array(
						'last_update' => time() - $ttl + MINUTE_IN_SECONDS,
						'fonts'       => $saved_data['fonts'],
					),
					false
				);
			}
		}

		return $saved_data['fonts'];
	}

	public function get_googgle_fonts( $as_keys = false ) {
		$maybe_custom_source = apply_filters(
			'rishi-typography-google-fonts-source',
			null
		);

		if ( $maybe_custom_source ) {
			return $maybe_custom_source;
		}

		$response = $this->all_google_fonts();
		$response = json_decode( $response, true );

		if ( ! isset( $response['items'] ) ) {
			return false;
		}

		if ( ! is_array( $response['items'] ) || ! count( $response['items'] ) ) {
			return false;
		}

		foreach ( $response['items'] as $key => $row ) {
			$response['items'][ $key ] = $this->prepare_font_data( $row );
		}

		if ( ! $as_keys ) {
			return $response['items'];
		}

		$result = array();

		foreach ( $response['items'] as $single_item ) {
			$result[ $single_item['family'] ] = true;
		}

		return $result;
	}

	private function prepare_font_data( $font ) {
		$font['source'] = 'google';

		$font['variations'] = array();

		if ( isset( $font['variants'] ) ) {
			$font['all_variations'] = $this->change_variations_structure( $font['variants'] );
		}

		unset( $font['variants'] );
		return $font;
	}

	private function change_variations_structure( $structure ) {
		$result = array();

		foreach ( $structure as $weight ) {
			$result[] = $this->get_weight_and_style_key( $weight );
		}

		return $result;
	}

	private function get_weight_and_style_key( $code ) {
		$prefix = 'n'; // Font style: italic = `i`, regular = n.
		$sufix  = '4';  // Font weight: 1 -> 9.

		$value = strtolower( trim( $code ) );
		$value = str_replace( ' ', '', $value );

		// Only number.
		if ( is_numeric( $value ) && isset( $value[0] ) ) {
			$sufix  = $value[0];
			$prefix = 'n';
		}

		// Italic.
		if ( preg_match( '#italic#', $value ) ) {
			if ( 'italic' === $value ) {
				$sufix  = 4;
				$prefix = 'i';
			} else {
				$value = trim( str_replace( 'italic', '', $value ) );
				if ( is_numeric( $value ) && isset( $value[0] ) ) {
					$sufix  = $value[0];
					$prefix = 'i';
				}
			}
		}

		// Regular.
		if ( preg_match( '#regular|normal#', $value ) ) {
			if ( 'regular' === $value ) {
				$sufix  = 4;
				$prefix = 'n';
			} else {
				$value = trim( str_replace( array( 'regular', 'normal' ), '', $value ) );
				if ( is_numeric( $value ) && isset( $value[0] ) ) {
					$sufix  = $value[0];
					$prefix = 'n';
				}
			}
		}

		return "{$prefix}{$sufix}";
	}
}

if ( ! function_exists( 'rishi__cb_customizer_output_font_css' ) ) {
	function rishi__cb_customizer_output_font_css( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'css'        => null,
				'tablet_css' => null,
				'mobile_css' => null,
				'font_value' => null,
				'selector'   => ':root',
				'prefix'     => '',
			)
		);

		if ( ! $args['css'] ) {
			throw new Error( 'css missing in args!' );
		}

		if ( ! $args['tablet_css'] ) {
			throw new Error( 'tablet_css missing in args!' );
		}

		if ( ! $args['mobile_css'] ) {
			throw new Error( 'mobile_css missing in args!' );
		}

		if ( $args['font_value']['family'] === 'System Default' ) {
			$args['font_value']['family'] = "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'";
		} else {
			$fonts_manager = new \rishi__cb_customizer_Fonts_Manager();

			if ( ! in_array(
				$args['font_value']['family'],
				$fonts_manager->get_system_fonts()
			) && $args['font_value']['family'] !== 'Default' ) {
		
				$args['font_value']['family'] = '\'' . $args['font_value']['family'] . '\'';
				
				$args['font_value']['family'] .= ', ' . get_theme_mod(
					'font_family_fallback',
					'Sans-Serif'
				);
			}
		}

		if ( $args['font_value']['family'] === 'Default' ) {
			$args['font_value']['family'] = 'CT_CSS_SKIP_RULE';
		}

		$correct_font_family = str_replace(
			'ct_typekit_',
			'',
			$args['font_value']['family']
		);

		$args['css']->put(
			$args['selector'],
			'--' . rishi__cb_customizer_camel_case_prefix( 'fontFamily', $args['prefix'] ) . ": {$correct_font_family}"
		);

		$weight_and_style = rishi__cb_customizer_get_css_for_variation(
			$args['font_value']['variation']
		);

		$args['css']->put(
			$args['selector'],
			'--' . rishi__cb_customizer_camel_case_prefix( 'fontWeight', $args['prefix'] ) . ": {$weight_and_style['weight']}"
		);

		if ( $weight_and_style['style'] !== 'normal' ) {
			$args['css']->put(
				$args['selector'],
				'--' . rishi__cb_customizer_camel_case_prefix( 'fontStyle', $args['prefix'] ) . ": {$weight_and_style['style']}"
			);
		}

		$args['css']->put(
			$args['selector'],
			'--' . rishi__cb_customizer_camel_case_prefix( 'textTransform', $args['prefix'] ) . ": {$args['font_value']['text-transform']}"
		);

		$args['css']->put(
			$args['selector'],
			'--' . rishi__cb_customizer_camel_case_prefix( 'textDecoration', $args['prefix'] ) . ": {$args['font_value']['text-decoration']}"
		);

		rishi__cb_customizer_output_responsive(
			array(
				'css'          => $args['css'],
				'tablet_css'   => $args['tablet_css'],
				'mobile_css'   => $args['mobile_css'],
				'selector'     => $args['selector'],
				'variableName' => rishi__cb_customizer_camel_case_prefix( 'fontSize', $args['prefix'] ),
				'unit'         => '',
				'value'        => $args['font_value']['size'],
			)
		);

		rishi__cb_customizer_output_responsive(
			array(
				'css'          => $args['css'],
				'tablet_css'   => $args['tablet_css'],
				'mobile_css'   => $args['mobile_css'],
				'selector'     => $args['selector'],
				'variableName' => rishi__cb_customizer_camel_case_prefix(
					'lineHeight',
					$args['prefix']
				),
				'unit'         => '',
				'value'        => $args['font_value']['line-height'],
			)
		);

		rishi__cb_customizer_output_responsive(
			array(
				'css'          => $args['css'],
				'tablet_css'   => $args['tablet_css'],
				'mobile_css'   => $args['mobile_css'],
				'selector'     => $args['selector'],
				'variableName' => rishi__cb_customizer_camel_case_prefix(
					'letterSpacing',
					$args['prefix']
				),
				'unit'         => '',
				'value'        => $args['font_value']['letter-spacing'],
			)
		);
	}
}

if ( ! function_exists( 'rishi__cb_customizer_get_css_for_variation' ) ) {
	function rishi__cb_customizer_get_css_for_variation( $variation, $should_output_normals = true ) {
		$weight_and_style = array(
			'style'  => '',
			'weight' => '',
		);

		if ( $variation === 'Default' ) {
			return array(
				'style'  => 'CT_CSS_SKIP_RULE',
				'weight' => 'CT_CSS_SKIP_RULE',
			);
		}

		if ( preg_match(
			'#(n|i)(\d+?)$#',
			$variation,
			$matches
		) ) {
			if ( 'i' === $matches[1] ) {
				$weight_and_style['style'] = 'italic';
			} else {
				$weight_and_style['style'] = 'normal';
			}

			$weight_and_style['weight'] = (int) $matches[2] . '00';
		}

		return $weight_and_style;
	}
}

if ( ! function_exists( 'rishi__cb_customizer_typography_default_values' ) ) {
	function rishi__cb_customizer_typography_default_values( $values = array(), $context = null ) {
		$defaults = array_merge(
			array(
				'family'          => 'Default',
				'variation'       => 'Default',

				'size'            => '17px',
				'line-height'     => '1.75',
				'letter-spacing'  => '0em',
				'text-transform'  => 'none',
				'text-decoration' => 'none',

				'size'            => 'CT_CSS_SKIP_RULE',
				'line-height'     => 'CT_CSS_SKIP_RULE',
				'letter-spacing'  => 'CT_CSS_SKIP_RULE',
				'text-transform'  => 'CT_CSS_SKIP_RULE',
				'text-decoration' => 'CT_CSS_SKIP_RULE',
			),
			$values
		);

		$defaults = apply_filters( 'rishi__cb_:defaults:typography', $defaults, $context );

		if ( $context ) {
			$defaults = apply_filters( "rishi__cb_:defaults:typography:{$context}", $defaults );
		}

		return $defaults;

	}
}

add_action(
	'wp_ajax_rishi__cb_customizer_get_fonts_list',
	function () {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_send_json_error();
		}

		$m = new \rishi__cb_customizer_Fonts_Manager();

		wp_send_json_success(
			array(
				'fonts' => $m->get_all_fonts(),
			)
		);
	}
);
