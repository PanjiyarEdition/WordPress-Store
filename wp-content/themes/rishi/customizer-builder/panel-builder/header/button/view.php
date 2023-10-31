<?php

$class = 'cb__header-cta';

$class = trim(
	$class . ' ' . rishi__cb_customizer_visibility_classes(
		rishi__cb_get_akv(
			'visibility',
			$atts,
			array(
				'desktop' => true,
				'tablet'  => true,
				'mobile'  => true,
			)
		)
	)
);

$rt_type = rishi__cb_customizer_default_akg( 'header_button_type', $atts, 'type-1' );
$hidden  = rishi__cb_customizer_default_akg( 'header_hide_button', $atts, false );
$size    = rishi__cb_customizer_default_akg( 'header_button_size', $atts, 'small' );
$rt_link = rishi__cb_customizer_translate_dynamic(
	rishi__cb_customizer_default_akg( 'header_button_link', $atts, '' ),
	'header:' . $section_id . ':button:header_button_link'
);


if( $hidden ) return '';

$visibility = rishi__cb_customizer_default_akg(
	'visibility',
	$atts,
	array(
		'tablet' => true,
		'mobile' => true,
	)
);

$target_output = '';

if ( rishi__cb_customizer_default_akg( 'header_button_target', $atts, 'no' ) === 'yes' ) {
	$target_output = 'target="_blank" rel="noopener noreferrer"';
}

$class       .= ' ' . rishi__cb_customizer_visibility_classes( $visibility );
$button_class = 'cb__button';

if ( $rt_type === 'type-2' ) {
	$button_class = 'cb__button-ghost';
}

$text = rishi__cb_customizer_translate_dynamic(
	rishi__cb_customizer_default_akg( 'header_button_text', $atts, __( 'Download', 'rishi' ) ),
	'header:' . $section_id . ':button:header_button_text'
);


// additional added
$header_button_ed_nofollow  = rishi__cb_customizer_default_akg( 'header_button_ed_nofollow', $atts, 'no' );
$header_button_ed_sponsored = rishi__cb_customizer_default_akg( 'header_button_ed_sponsored', $atts, 'no' );
$header_button_ed_download  = rishi__cb_customizer_default_akg( 'header_button_ed_download', $atts, 'no' );

$headerButtonFontColor = rishi__cb_customizer_default_akg(
	'headerButtonFontColor',
	$atts,
	array(
		'default'   => array(
			'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ),
		),

		'hover'     => array(
			'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ),
		),

		'default_2' => array(
			'color' => 'var(--buttonInitialColor)',
		),

		'hover_2'   => array(
			'color' => '#ffffff',
		),
	)
);

if ( $header_button_ed_nofollow == 'yes' ) {
	$rel_nofollow = 'nofollow';
} else {
	$rel_nofollow = '';
}
if ( $header_button_ed_sponsored == 'yes' ) {
	$rel_sponsored = ' sponsored';
} else {
	$rel_sponsored = '';
}
if ( $header_button_ed_download == 'yes' ) {
	$rel_download = ' download ';
} else {
	$rel_download = '';
}


$button_visibility = ' ' . rishi__cb_customizer_visibility_classes(
	rishi__cb_customizer_default_akg(
		'button_visibility',
		$atts,
		array(
			'desktop' => true,
			'tablet'  => true,
			'mobile'  => true,
		)
	)
);

?>
<div class="<?php echo esc_attr( trim( $class ) ); ?>" <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?>>
	<a href="<?php echo esc_url( $rt_link ); ?>" class="<?php echo esc_attr( $button_class ) . esc_attr( $button_visibility ); ?>" data-size="<?php echo esc_attr( $size ); ?>" <?php echo wp_kses_post( $target_output ); ?> <?php echo esc_attr( $rel_download ); ?> rel="<?php echo esc_attr( $rel_nofollow ) . esc_attr( $rel_sponsored ); ?>">
		<?php echo esc_html( $text ); ?>
	</a>
</div>
