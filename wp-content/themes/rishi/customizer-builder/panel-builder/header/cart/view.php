<?php

if ( ! function_exists( 'woocommerce_mini_cart' ) ) {
	return '';
}

if ( ! isset( $device ) ) {
	$device = 'desktop';
}

$hidden = rishi__cb_customizer_default_akg( 'header_hide_cart', $atts, false );

if ( $hidden ) return '';

$has_only_item = false;
$has_only_cart = false;

if ( isset( $render_args['only_item'] ) ) {
	$has_only_item = $render_args['only_item'];
}

if ( isset( $render_args['only_cart'] ) ) {
	$has_only_cart = $render_args['only_cart'];
}

$svgs = rishi__cb_get_header_cart_icons();

// $class = 'cb__header-cart';
$class = 'cb__header-cart';

$item_visibility = rishi__cb_customizer_default_akg(
	'header_search_visibility',
	$atts,
	array(
		'tablet' => true,
		'mobile' => true,
	)
);

$class .= ' ' . rishi__cb_customizer_visibility_classes( $item_visibility );


$badge_output = '';

if ( rishi__cb_customizer_default_akg( 'has_cart_badge', $atts, 'yes' ) !== 'yes' ) {
	$badge_output = 'data-skip-badge';
}

$has_cart_dropdown = rishi__cb_customizer_default_akg(
	'has_cart_dropdown',
	$atts,
	'yes'
) === 'yes';

$cart_drawer_type = rishi__cb_customizer_default_akg( 'cart_drawer_type', $atts, 'dropdown' );

$cart_total_class = 'cb__label';

$cart_subtotal_visibility = rishi__cb_customizer_default_akg(
	'cart_subtotal_visibility',
	$atts,
	array(
		'desktop' => true,
		'tablet'  => true,
		'mobile'  => true,
	)
);

$cart_total_class .= ' ' . rishi__cb_customizer_visibility_classes( $cart_subtotal_visibility );
$has_subtotal      = ( rishi__cb_customizer_some_device( $cart_subtotal_visibility )
	||
	is_customize_preview() );

$cart_total_position = rishi__cb_customizer_expand_responsive_value(
	rishi__cb_get_akv( 'cart_total_position', $atts, 'left' )
);


$rt_type = rishi__cb_customizer_default_akg( 'mini_cart_type', $atts, 'type-1' );

if ( empty( $rt_type ) ) {
	$rt_type = 'type-1';
}

$item_class = 'scb__cart-item';

$url = wc_get_cart_url();

$auto_open_output = '';

if ( $has_cart_dropdown && $cart_drawer_type === 'offcanvas' ) {
	$item_class .= ' cb__offcanvas-trigger';
	$url         = '#woo-cart-panel';

	$auto_open_cart = rishi__cb_customizer_default_akg(
		'auto_open_cart',
		$atts,
		array(
			'archive' => false,
			'product' => false,
		)
	);

	$components = array();


	if ( $auto_open_cart['archive'] ) {
		$components[] = 'archive';
	}

	if ( $auto_open_cart['product'] ) {
		$components[] = 'product';
	}

	if ( ! empty( $components ) ) {
		$auto_open_output = 'data-auto-open="' . implode( ':', $components ) . '"';
	}
}

$url = apply_filters( 'rt:header:cart:url', $url );

ob_start();

$data_count_output = '';
$current_count     = WC()->cart->get_cart_contents_count();

if ( intval( $current_count ) > 0 ) {
	$data_count_output = 'style="--counter: \'' . esc_attr( $current_count ) . '\'"';
}

?>

<a class="<?php echo $item_class; ?>" href="<?php echo esc_attr( $url ); ?>" <?php echo wp_kses_post( $badge_output ); ?> <?php echo $data_count_output; ?> data-label="<?php echo $cart_total_position[ $device ]; ?>" aria-label="<?php echo __( 'Cart', 'rishi' ); ?>" <?php echo $auto_open_output; ?>>

	<?php if ( $has_subtotal ) { ?>
		<span class="<?php echo $cart_total_class; ?>">
			<?php echo WC()->cart->get_cart_subtotal(); ?>
		</span>
	<?php } ?>

	<span class="cb__icon-container">
		<?php
		/**
		 * Note to code reviewers: This line doesn't need to be escaped.
		 * The value used here escapes the value properly.
		 * It contains an inline SVG, which is safe.
		 */
		echo $svgs[ $rt_type ]
		?>
	</span>
</a>

<?php

$item = ob_get_clean();

if ( $has_only_item ) {
	echo $item;
	return;
}

if ( $has_only_cart ) {
	if ( $has_cart_dropdown && $cart_drawer_type === 'dropdown' ) {
		ob_start();
		woocommerce_mini_cart();
		$content = ob_get_clean();

		echo rishi__cb_html_tag(
			'div',
			array( 'class' => 'cb__cart-content' ),
			$content
		);
	}
	return;
}

?>

<div class="<?php echo esc_attr( $class ); ?>" <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?>>

	<?php
	echo $item;

	if ( $has_cart_dropdown && $cart_drawer_type === 'dropdown' ) {
		ob_start();
		woocommerce_mini_cart();
		$content = ob_get_clean();

		echo rishi__cb_html_tag(
			'div',
			array( 'class' => 'cb__cart-content' ),
			$content
		);
	}
	?>
</div>