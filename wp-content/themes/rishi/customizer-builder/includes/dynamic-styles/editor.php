<?php

$rt_post_type = get_current_screen()->post_type;

$rt_post_id = null;

if ( isset( $_GET['post'] ) && $_GET['post'] ) {
	$rt_post_id = $_GET['post'];
}

$prefix = rishi__cb_customizer_manager()->screen->get_admin_prefix( $rt_post_type );

$post_atts = rishi__cb_customizer_get_post_options( $rt_post_id );

$background_source = rishi__cb_customizer_default_akg(
	'background',
	$post_atts,
	rishi__cb_customizer_background_default_value(
		array(
			'backgroundColor' => array(
				'default' => array(
					'color' => \Rishi_CSS_Injector::get_skip_rule_keyword(),
				),
			),
		)
	)
);

if (
	isset( $background_source['background_type'] )
	&&
	$background_source['background_type'] === 'color'
	&&
	isset( $background_source['backgroundColor']['default']['color'] )
	&&
	$background_source['backgroundColor']['default']['color'] === \Rishi_CSS_Injector::get_skip_rule_keyword()
) {
	$background_source = get_theme_mod(
		$prefix . '_background',
		rishi__cb_customizer_background_default_value(
			array(
				'backgroundColor' => array(
					'default' => array(
						'color' => \Rishi_CSS_Injector::get_skip_rule_keyword(),
					),
				),
			)
		)
	);

	if (
		isset( $background_source['background_type'] )
		&&
		$background_source['background_type'] === 'color'
		&&
		isset( $background_source['backgroundColor']['default']['color'] )
		&&
		$background_source['backgroundColor']['default']['color'] === \Rishi_CSS_Injector::get_skip_rule_keyword()
	) {
		$background_source = get_theme_mod(
			'site_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => 'var(--paletteColor8)',
						),
					),
				)
			)
		);
	}
}

rishi__cb_customizer_output_background_css(
	array(
		'selector'   => '.edit-post-visual-editor__content-area',
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => $background_source,
		'responsive' => true,
	)
);

$source = array(
	'strategy' => $post_atts,
);

if ( rishi__cb_customizer_default_akg(
	'content_style_source',
	$post_atts,
	'inherit'
) === 'inherit' && $rt_post_type !== 'rt_hooked_element' ) {
	$source = array(
		'prefix'   => $prefix,
		'strategy' => 'customizer',
	);
}

$has_boxed = rishi__cb_customizer_akg_or_customizer(
	'content_style',
	$source,
	'boxed'
);

if ( rishi__cb_customizer_some_device( $has_boxed, 'boxed' ) ) {

	rishi__cb_customizer_output_background_css(
		array(
			'selector'   => '.block-editor-writing-flow',
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'value'      => rishi__cb_customizer_akg_or_customizer(
				'content_background',
				$source,
				rishi__cb_customizer_background_default_value(
					array(
						'backgroundColor' => array(
							'default' => array(
								'color' => '#ffffff',
							),
						),
					)
				)
			),
			'responsive' => true,
		)
	);

	rishi__cb_customizer_output_spacing(
		array(
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector'   => '.block-editor-writing-flow',
			'property'   => 'boxed-content-spacing',
			'value'      => rishi__cb_customizer_akg_or_customizer(
				'boxed_content_spacing',
				$source,
				array(
					'desktop' => rishi__cb_customizer_spacing_value(
						array(
							'linked' => true,
							'top'    => '40px',
							'left'   => '40px',
							'right'  => '40px',
							'bottom' => '40px',
						)
					),
					'tablet'  => rishi__cb_customizer_spacing_value(
						array(
							'linked' => true,
							'top'    => '15px',
							'left'   => '15px',
							'right'  => '15px',
							'bottom' => '15px',
						)
					),
					'mobile'  => rishi__cb_customizer_spacing_value(
						array(
							'linked' => true,
							'top'    => '15px',
							'left'   => '15px',
							'right'  => '15px',
							'bottom' => '15px',
						)
					),
				)
			),
		)
	);

	rishi__cb_customizer_output_spacing(
		array(
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector'   => '.block-editor-writing-flow',
			'property'   => 'border-radius',
			'value'      => rishi__cb_customizer_akg_or_customizer(
				'content_boxed_radius',
				$source,
				rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '3px',
						'left'   => '3px',
						'right'  => '3px',
						'bottom' => '3px',
					)
				)
			),
		)
	);

	rishi__cb_customizer_output_box_shadow(
		array(
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector'   => '.block-editor-writing-flow',
			'value'      => rishi__cb_customizer_akg_or_customizer(
				'content_boxed_shadow',
				$source,
				rishi__cb_customizer_box_shadow_value(
					array(
						'enable'   => true,
						'h_offset' => 0,
						'v_offset' => 12,
						'blur'     => 18,
						'spread'   => -6,
						'inset'    => false,
						'color'    => array(
							'color' => 'rgba(34, 56, 101, 0.04)',
						),
					)
				)
			),
			'responsive' => true,
		)
	);
}
