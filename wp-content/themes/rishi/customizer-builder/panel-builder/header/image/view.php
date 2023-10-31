<?php

$hidden = rishi__cb_customizer_default_akg( 'header_hide_image', $atts, false );

if ( $hidden ) {
	return '';
}

$header_image = rishi__cb_get_akv( 'rt_header_image', $atts );
$image_url    = rishi__cb_customizer_default_akg( 'header_image_link', $atts );
$ed_target    = rishi__cb_customizer_default_akg( 'header_image_target', $atts, 'no' );
$ed_nofollow  = rishi__cb_customizer_default_akg( 'header_image_ed_nofollow', $atts, 'no' );
$ed_sponsored = rishi__cb_customizer_default_akg( 'header_image_ed_sponsored', $atts, 'no' );

$target_output = $ed_target == 'yes' ? 'target="_blank" rel="noopener noreferrer"' : '';
$rel_nofollow  = $ed_nofollow == 'yes' ? 'nofollow' : '';
$rel_sponsored = $ed_sponsored == 'yes' ? ' sponsored' : '';

echo '<div class="header-image-section" '. rishi__cb_customizer_attr_to_html($attr) .'>';
	if( $header_image ){
		?>
		<a href="<?php echo esc_url( $image_url ); ?>" class="image-wrapper" <?php echo wp_kses_post( $target_output ); ?> rel="<?php echo esc_attr( $rel_nofollow ) . esc_attr( $rel_sponsored ); ?>">
			<figure>
				<?php echo wp_get_attachment_image( $header_image,'full' ); ?>
			</figure>
		</a>
		<?php
	}
echo '</div>';
