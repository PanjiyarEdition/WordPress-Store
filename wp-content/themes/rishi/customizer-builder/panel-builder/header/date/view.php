<?php

$hidden = rishi__cb_customizer_default_akg( 'header_hide_date', $atts, false );

if ( $hidden ) {
	return '';
}

$date_format_type = rishi__cb_get_akv( 'header_date_format_type', $atts, 'format_1' );
$ed_icon          = rishi__cb_get_akv( 'header_date_ed_icon', $atts, 'no' );
$custom_format    = rishi__cb_get_akv( 'header_date_format_custom', $atts, 'Y-m-d' );

?>
<div <?php echo rishi__cb_customizer_attr_to_html($attr);?>>
    <div class="header-date-section">
        <?php if( $ed_icon == 'yes' ){ ?>
        <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 1C8.55229 1 9 1.44772 9 2V3H15V2C15 1.44772 15.4477 1 16 1C16.5523 1 17 1.44772 17 2V3H19C20.6569 3 22 4.34315 22 6V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20V6C2 4.34315 3.34315 3 5 3H7V2C7 1.44772 7.44772 1 8 1ZM20 11V20C20 20.5523 19.5523 21 19 21H5C4.44772 21 4 20.5523 4 20V11H20Z" /></svg>
        <span class="rt-date"><?php  }
                if( $date_format_type == 'format_1' ){
                    echo esc_html( date_i18n( 'l, F j, Y' ) );
                }elseif( $date_format_type == 'format_2' ){
                    echo esc_html( date_i18n('F j, Y') );
                }elseif( $date_format_type == 'format_3' ){
                    echo esc_html( date_i18n('m-d-Y' ) );
                }elseif( $date_format_type == 'format_4' ){
                    echo esc_html( date_i18n('m/d/Y' ) );
                }elseif( $date_format_type == 'format_5' ){
                    echo esc_html( date_i18n( $custom_format ) );    
                }
            ?>
        </span>
    </div>
</div>