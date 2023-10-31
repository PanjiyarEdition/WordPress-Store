<?php

if ( ! function_exists( 'rishi__cb_customizer_assemble_selector' ) ) {
	return;
}

// Box shadow
$has_reveal_effect = rishi__cb_customizer_default_akg(
	'has_reveal_effect',
	$atts,
	array(
		'desktop' => false,
		'tablet'  => false,
		'mobile'  => false,
	)
);

if ( function_exists( 'rishi__cb_customizer_output_responsive_switch' ) ) {
	rishi__cb_customizer_output_responsive_switch(
		array(
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector'   => rishi__cb_customizer_assemble_selector(
				rishi__cb_customizer_mutate_selector(
					array(
						'selector'  => rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => $root_selector,
								'operation' => 'suffix',
								'to_add'    => 'footer.cb__footer',
							)
						),
						'operation' => 'container-suffix',
						'to_add'    => '[data-footer*="reveal"]',
					)
				)
			),
			'variable'   => 'position',
			'on'         => 'sticky',
			'off'        => 'static',
			'value'      => $has_reveal_effect,
			'skip_when'  => 'all_disabled',
		)
	);
}

if ( function_exists( 'rishi__cb_customizer_some_device' ) && rishi__cb_customizer_some_device( $has_reveal_effect ) ) {
	rishi__cb_customizer_output_box_shadow(
		array(
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector'   => rishi__cb_customizer_assemble_selector(
				rishi__cb_customizer_mutate_selector(
					array(
						'selector'  => rishi__cb_customizer_mutate_selector(
							array(
								'selector'  => $root_selector,
								'operation' => 'suffix',
								'to_add'    => '.site-content',
							)
						),
						'operation' => 'container-suffix',
						'to_add'    => '[data-footer*="reveal"]',
					)
				)
			),
			'variableName' => 'footer-box-shadow',
			'value'      => rishi__cb_customizer_default_akg(
				'footerShadow',
				$atts,
				rishi__cb_customizer_box_shadow_value(
					array(
						'enable'   => true,
						'h_offset' => 0,
						'v_offset' => 30,
						'blur'     => 50,
						'spread'   => 0,
						'inset'    => false,
						'color'    => array(
							'color' => 'rgba(0, 0, 0, 0.1)',
						),
					)
				)
			),
			'responsive' => $has_reveal_effect,
		)
	);
}