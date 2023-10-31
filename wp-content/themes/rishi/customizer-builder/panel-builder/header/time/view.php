<?php
$hidden           = rishi__cb_customizer_default_akg( 'header_hide_time', $atts, false );
$time_format_type = rishi__cb_get_akv( 'header_time_format_type', $atts, 'format_1' );
$custom_format    = rishi__cb_get_akv( 'header_time_format_custom', $atts, 'H:i:s' );
$ed_icon          = rishi__cb_get_akv( 'header_time_ed_icon', $atts, 'no' );

if ( $hidden ) {
	return '';
}

if( $time_format_type == 'format_1' ){
	$format= 'g:i a';
}elseif( $time_format_type == 'format_2' ){
	$format= 'g:i A';
}elseif( $time_format_type == 'format_3' ){
	$format= 'H:i';
}elseif( $time_format_type == 'format_4' ){
	$format= $custom_format;
}
$data_attr = ( $ed_icon == 'no' ) ? 'none': 'block';
?>
<div <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?>>
	<div class="time-wrapper" data-time-format="<?php echo esc_attr($format); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" data-type="<?php echo esc_attr( $data_attr ); ?>"><path id="clock" d="M35,977.362a10,10,0,1,0,10,10A10,10,0,0,0,35,977.362Zm0,3.6a.8.8,0,0,1,.8.8V986.9l3.763,2.175a.8.8,0,0,1-.8,1.375l-4.075-2.35a.813.813,0,0,1-.087-.05.792.792,0,0,1-.4-.687v-5.6A.8.8,0,0,1,35,980.962Z" transform="translate(-25 -977.362)"/></svg>
		<?php
		echo '<span class="rt-time">HH:MM</span>'; ?>
	</div>
</div>