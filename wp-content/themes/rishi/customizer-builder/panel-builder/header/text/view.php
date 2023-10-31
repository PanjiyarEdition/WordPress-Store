<?php


$hidden = rishi__cb_customizer_default_akg( 'header_hide_text', $atts, false );

if ( $hidden ) {
	return '';
}

$class = 'cb__header-text';

if ($panel_type === 'header') {
	$search_visibility = rishi__cb_customizer_default_akg('visibility', $atts, [
		'tablet' => true,
		'mobile' => true,
	]);
} else {
	$search_visibility = rishi__cb_customizer_default_akg('footer_visibility', $atts, [
		'desktop' => true,
		'tablet' => true,
		'mobile' => true,
	]);
}

$headerLinkUnderLine = rishi__cb_customizer_default_akg('headerLinkUnderLine', $atts ,'no' );

$class .= ' ' . rishi__cb_customizer_visibility_classes($search_visibility);

$text = do_shortcode(
 rishi__cb_customizer_translate_dynamic(
	 rishi__cb_customizer_default_akg(
			'header_text',
			$atts,
			__('Sample text', 'rishi')
		)
	),
	'header:' . $section_id . ':text:header_text'
);

?>

<div class="<?php echo esc_attr($class) ?>" <?php echo rishi__cb_customizer_attr_to_html($attr) ?> data-header-style="<?php echo esc_attr( $headerLinkUnderLine ); ?>">
	<div class="html-content">
		<?php echo $text ?>
	</div>
</div>
