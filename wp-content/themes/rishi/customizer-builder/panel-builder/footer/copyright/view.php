<?php

$hidden = rishi__cb_customizer_default_akg( 'footer_hide_copyright', $atts, false );

if ( $hidden ) return '';

$class = 'cb__footer-copyright';

$class = trim(
	$class . ' ' . rishi__cb_customizer_visibility_classes(
		rishi__cb_customizer_default_akg(
			'footer_copyright_visibility',
			$atts,
			array(
				'desktop' => true,
				'tablet'  => true,
				'mobile'  => true,
			)
		)
	)
);

$theme = rishi__cb_customizer_get_wp_theme();

$text = apply_filters(
	'rishi__cb_copyright_text',
	rishi__cb_customizer_translate_dynamic(
		rishi__cb_customizer_default_akg(
			'copyright_text',
			$atts,
			__(
				'Copyright &copy; {current_year} {site_title} - Powered by {theme_author}',
				'rishi'
			)
		)
	)
);

$replace_by = apply_filters(
	'rishi__cb_copyright_string_replacements',
	array(
		'{current_year}' => date( 'Y' ),
		'{site_title}'   => get_bloginfo( 'name' ),
		'{theme_author}' => '<a href="https://rishitheme.com/" target="_blank" rel="nofollow noopener">' . __( 'Rishi Theme', 'rishi' ) . '</a>',
	)
);

?>
<div class="<?php echo esc_attr( $class ); ?>" <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?>>
	<?php
	echo wp_kses(
		str_replace( array_keys( $replace_by ), array_values( $replace_by ), $text ),
		apply_filters(
			'rishi__cb_copyright_wp_kses',
			array(
				'a'    => array(
					'href'   => array(),
					'target' => array(),
					'rel'    => array(),
				),
				'span' => array( 'class' => array() ),
				'b'    => array(),
			)
		)
	);
	?>
</div>
