<?php
/**
 * Single Product Image
 *
 * This template is overridden from woocommerce plugin /woocommerce/single-product/product-image.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.0.0
 */
defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

if (! isset($gallery_images)) {
	$thumb_id = apply_filters(
		'woocommerce_product_get_image_id',
		get_post_thumbnail_id($product->get_id()),
		$product
	);

	$thumb_id = get_post_thumbnail_id($product->get_id());

	$gallery_images = $product->get_gallery_image_ids();

	if ($thumb_id) {
		array_unshift($gallery_images, intval($thumb_id));
	} else {
		$gallery_images = [null];
	}
}

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();

$image_href = wp_get_attachment_image_src(
	$post_thumbnail_id,
	'full'
);

if ( class_exists('Rishi\Rishi_Pro') ){
	$single_ratio = get_theme_mod( 'gallery_image_options', '1/1' );
}else{
	$single_ratio = 'original';
}

$width = null;
$height = null;

if ($image_href) {
	$width 		= $image_href[1];
	$height 	= $image_href[2];
	$image_href = $image_href[0];
}

$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<?php
		if ( $post_thumbnail_id ) {
			$html  = '<div data-thumb="' . $image_href . '" data-thumb-alt="" class="woocommerce-product-gallery__image">';
			$html .= rishi__cb_customizer_image([
						'no_image_type' => 'woo',
						'attachment_id' => $post_thumbnail_id,
						'post_id' => $product->get_id(),
						'size' => 'woocommerce_single',
						'ratio' => ( is_single() && is_product() ) ? $single_ratio : rishi__cb_customizer_get_woocommerce_ratio(),
						'tag_name' => 'a',
						'size' => 'woocommerce_single',
						'display_video' => true,
						'img_atts' => [
							'data-large_image_width' => $width,
							'data-large_image_height' => $height,
							'title' => get_the_title( $post_thumbnail_id ),
							'data-caption' => wp_get_attachment_caption( $post_thumbnail_id ),
							'data-large_image' => $image_href 
						],
						'html_atts' => [
							'href' => $image_href,
						],
					]);
			$html  .= '</div>';
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'rishi' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
</div>