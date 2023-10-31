<?php
/**
 * Rishi Woocommerce hooks and functions.
 *
 * @link https://docs.woothemes.com/document/third-party-custom-theme-compatibility/
 *
 * @package Rishi
 */

/**
 * Woocommerce related hooks
*/
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content','woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content','woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop','woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_shop_loop','woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

function rishi_woo_header_actions(){
    add_action( 'woocommerce_before_main_content','rishi_header_section_wrapper_start', 40 );
    add_action( 'woocommerce_before_shop_loop','rishi_header_section_wrap_start', 9 );
    add_action( 'woocommerce_before_shop_loop','woocommerce_output_all_notices', 30 );
    
    add_action( 'woocommerce_before_shop_loop','rishi_header_section_wrap_end', 50 );
    add_action( 'woocommerce_checkout_before_order_review_heading','rishi_woocommerce_checkout_before_order_review_heading_start' );
    add_action( 'woocommerce_checkout_after_order_review','rishi_woocommerce_checkout_after_order_review_end' );
    add_action( 'woocommerce_after_shop_loop','rishi_woocommerce_pagination',11 );
}
add_action( 'init','rishi_woo_header_actions',11 );

add_action(
	'woocommerce_before_single_product_summary',
	function () {
		echo '<div class="product-entry-wrapper">';
	},
	1
);

add_action(
	'woocommerce_after_single_product_summary',
	function () {
		echo '</div>';
	},
	1
);

add_filter(
	'body_class',
	function ( $classes ) {

        if ( is_cart() ) {
            $classes[] = 'woocommerce';
        }

		return $classes;
	}
);


/**
 * Declare Woocommerce Support
*/
function rishi_woocommerce_support() {
    global $woocommerce;
    
    add_theme_support( 'woocommerce' );
    
    if( version_compare( $woocommerce->version, '3.0', ">=" ) ) {
        if ( get_theme_mod('gallery_ed_zoom_effect', 'no') === 'yes' ) add_theme_support( 'wc-product-gallery-zoom' );
        if ( get_theme_mod('gallery_ed_lightbox', 'no') === 'yes' ) add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }

}
add_action( 'after_setup_theme', 'rishi_woocommerce_support');

/**
 * Woocommerce Sidebar
*/
function rishi_wc_widgets_init(){
    register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'rishi' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Sidebar displaying only in woocommerce pages.', 'rishi' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );    
}
add_action( 'widgets_init', 'rishi_wc_widgets_init' );

/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
*/
function rishi_wc_wrapper(){ ?>
    <main id="primary" class="site-main">   
    <?php
}
add_action( 'woocommerce_before_main_content', 'rishi_wc_wrapper' );

/**
 * After Content
 * Closes the wrapping divs
*/
function rishi_wc_wrapper_end(){ ?>
    </main>
    <?php
    do_action( 'rishi_wo_sidebar' );
}
add_action( 'woocommerce_after_main_content', 'rishi_wc_wrapper_end' );

if (! function_exists('rishi_wc_sidebar_cb')) {
    /**
     * Callback function for Shop sidebar
    */
    function rishi_wc_sidebar_cb(){
        $sidebar = rishi_sidebar();

        if ( ! $sidebar ) {
            return;
        } ?>

        <aside id="secondary" class="widget-area" <?php echo rishi__cb_customizer_schema_org_definitions( 'sidebar' ); ?>>
            <?php dynamic_sidebar( $sidebar ); ?>
        </aside>
        <?php
    }
}
add_action( 'rishi_wo_sidebar', 'rishi_wc_sidebar_cb' );

if (! function_exists('rishi_header_section_wrap_start')) {
    function rishi_header_section_wrap_start(){ ?>
        <div class="woowrapper">
        <?php 
    }
}
if (! function_exists('rishi_header_section_wrap_end')) {
    function rishi_header_section_wrap_end(){ ?>
        </div><!-- .woowrapper -->
        <?php 
    }
}

function rishi_woocommerce_pagination_args( $args ){
    $args['prev_text'] = esc_html__( 'Prev', 'rishi' );
    $args['next_text'] = esc_html__( 'Next', 'rishi' );
    return $args;
}
add_filter( 'woocommerce_pagination_args','rishi_woocommerce_pagination_args' );

if (! function_exists('rishi_header_section_wrapper_start')) {
    function rishi_header_section_wrapper_start(){
        $shop_cards_type = get_theme_mod( 'shop_cards_type', 'normal' );
        $shop_cards_sales_badge_design = get_theme_mod( 'shop_cards_sales_badge_design', 'circle' );
        ?>
        <div class="wholewrapper" <?php if( is_product() ) { ?> data-single-product="<?php echo apply_filters( 'rishi_single_product_additional_class', '' ); ?>" <?php } ?> data-card-design="<?php echo $shop_cards_type ? esc_attr( $shop_cards_type ) : '' ?>" data-card-badge="<?php echo $shop_cards_sales_badge_design ? esc_attr( $shop_cards_sales_badge_design ) : '' ?>">
        <?php 
    }
}
if (! function_exists('rishi_header_section_wrapper_end')) {
    function rishi_header_section_wrapper_end(){ ?>
        </div><!-- .wholewrapper -->
        <?php 
    }
}
if (! function_exists('rishi_woocommerce_checkout_before_order_review_heading_start')) {
    function rishi_woocommerce_checkout_before_order_review_heading_start(){ ?>
        <div class="form-order-wrapper">
        <?php 
    }
}
if (! function_exists('rishi_woocommerce_checkout_after_order_review_end')) {
    function rishi_woocommerce_checkout_after_order_review_end(){ ?>
        </div><!-- .form-order-wrapper -->
        <?php 
    }
}

/**
 * Removes the "shop" title on the main shop page
*/
add_filter( 'woocommerce_show_page_title' , '__return_false' );

add_filter( 'woocommerce_demo_store',
	function ($notice) {
		$parser = new Rishi_Attributes_Parser();

		$notice = $parser->add_attribute_to_images_with_tag(
			$notice,
			'data-position',
			get_theme_mod('store_notice_position', 'bottom'),
			'p'
		);

		return $notice;
	}
);

// Image Ratio Filters.
add_filter( 'woocommerce_product_get_image', function($image) {

    global $product;

    if ( ! is_shop() || is_admin() || ! $product ) {
        return $image;
    }

    $new_image = rishi__cb_customizer_image([
        'no_image_type' => 'woo',
        'attachment_id' => $product->get_image_id(),
        'other_images'  => [],
        'size'          => 'woocommerce_thumbnail',
        'ratio'         => rishi__cb_customizer_get_woocommerce_ratio(),
        'tag_name'      => 'span'
    ]);

    return $new_image;
} );

if (! function_exists('rishi_archive_woocommerce_template_loop_restructure')) {
    function rishi_archive_woocommerce_template_loop_restructure(){
        if ( get_theme_mod('has_star_rating', 'yes') !== 'yes' || 
        ( class_exists('Rishi\Rishi_Pro') && is_single() && is_product() && get_theme_mod( 'rp_has_star_rating', 'yes' ) === 'no' ) ){
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        }else{
            add_action( 'woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5 );
        }
        if ( get_theme_mod('has_sale_badge', 'yes') !== 'yes' ||
        ( class_exists('Rishi\Rishi_Pro') && is_single() && is_product() && get_theme_mod( 'rp_has_sale_badge', 'no' ) === 'no' ) ) {
            remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
        }else{
            add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
        }

        if (get_theme_mod('has_shop_sort', 'yes') !== 'yes') {
			remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
		}else{
			add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
        }

		if (get_theme_mod('has_shop_results_count', 'yes') !== 'yes') {
			remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
		}else{
            add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        }

        if( get_theme_mod( 'woo_ed_upsell_tab', 'no' ) === 'yes' ){
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
            add_filter( 'woocommerce_product_tabs', 'rishi_woo_add_new_products_tab' );
        }
    }
}
add_action( 'wp','rishi_archive_woocommerce_template_loop_restructure',9999 );

if (! function_exists('rishi_woo_add_new_products_tab')) {
    function rishi_woo_add_new_products_tab( $tabs ){
        $upsell_label = get_theme_mod( 'woo_upsell_tab_label', __( 'Upsell', 'rishi' ) ); 
        $tabs['rishi_upsell_products'] = 
            array(
                'title'       => $upsell_label,
                'priority'    => 50,
                'callback'    => 'rishi_woo_new_product_tab_content'
            );
        return $tabs;
    }
}

if (! function_exists('rishi_woo_new_product_tab_content')) {
    function rishi_woo_new_product_tab_content(){
        woocommerce_upsell_display();
    }
}

if (! function_exists('rishi_single_woocommerce_product_restructure')) {
    function rishi_single_woocommerce_product_restructure(){

        if (get_theme_mod('has_product_single_rating', 'yes') === 'no') {
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        }else{
            add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
        }

        if (get_theme_mod('has_product_single_meta', 'yes') === 'no') {
            remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        }else{
            add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
        }

        if (! get_theme_mod('rishi__cb_customizer_has_checkout_coupon', false)) {
            remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
        }
    }
}
add_action( 'wp','rishi_single_woocommerce_product_restructure',99999 );

add_filter( 'woocommerce_output_related_products_args', function( $args ){
    $woo_single_no_of_posts = get_theme_mod( 'woo_single_no_of_posts', 3 );
    $woo_single_no_of_posts_row = get_theme_mod( 'woo_single_no_of_posts_row', 3 );
    
    if( $woo_single_no_of_posts ){
        $args['posts_per_page'] = absint( $woo_single_no_of_posts );
    }
    if( $woo_single_no_of_posts_row ){
        $args['columns'] = absint( $woo_single_no_of_posts_row );
    }
    return $args;
});

add_filter( 'woocommerce_upsell_display_args', function( $args ){
    $woo_single_no_of_upsell = get_theme_mod( 'woo_single_no_of_upsell', 3 );
    $woo_single_no_of_upsell_row = get_theme_mod( 'woo_single_no_of_upsell_row', 3 );
    
    if( $woo_single_no_of_upsell ){
        $args['posts_per_page'] = absint( $woo_single_no_of_upsell );
    }
    if( $woo_single_no_of_upsell_row ){
        $args['columns'] = absint( $woo_single_no_of_upsell_row );
    }
    return $args;
});

//overriding the woocommerce pagination
function rishi_woocommerce_pagination() {

    $woo_post_navigation = get_theme_mod( 'woo_post_navigation','numbered' );

    if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
        return;
    }

    if( $woo_post_navigation == 'numbered' ){
       
        $args = array(
            'total'   => wc_get_loop_prop( 'total_pages' ),
            'current' => wc_get_loop_prop( 'current_page' ),
            'base'    => esc_url_raw( add_query_arg( 'product-page', '%#%', false ) ),
            'format'  => '?product-page=%#%',
        );
    
        if ( ! wc_get_loop_prop( 'is_shortcode' ) ) {
            $args['format'] = '';
            $args['base']   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
        }
    
        wc_get_template( 'loop/pagination.php', $args );
    }elseif( $woo_post_navigation == 'infinite_scroll' ){
        echo rishi__cb_customizer_display_posts_pagination( [ 'pagination_type' => 'infinite_scroll' ] );
    }
   
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 * 
 * @link https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header
 */
function rishi_add_to_cart_fragment( $fragments ){
    ob_start();

    /**
     * Note to code reviewers: This line doesn't need to be escaped.
     * Function render_single_item() used here escapes the value properly.
     */
    $b = new \Rishi_Header_Builder_Render();
    echo $b->render_single_item('cart');

    $fragments['a.scb__cart-item'] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'rishi_add_to_cart_fragment' );

if( ! function_exists( 'get_category_woo_cat_list' ) ) :
	/**
	 * Related Products Title
	 */
    function get_category_woo_cat_list( $sep='', $before='',$after='' ){
        global $product;
        $terms = get_the_terms( $product->get_id(), 'product_cat' );
        if ( is_wp_error( $terms ) ) {
            return $terms;
        }
        if ( empty( $terms ) ) {
            return false;
        }
        $links = array();
        foreach( $terms as $term ) {
            $link = get_term_link( $term, 'product_cat' );
            if ( is_wp_error( $link ) ) {
                return $link;
            }
            $links[] = '<a href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
        }
        return $before . implode( $sep, $links ) . $after;
    }
endif;

add_action( 'woocommerce_shop_loop_item_title',function(){
    global $product;
    $get_categories = get_theme_mod( 'has_woo_category', 'no' );

    echo '<div class="caption-content-wrapper">';
    if( $get_categories === 'yes' || 
    ( class_exists('Rishi\Rishi_Pro') && is_single() && is_product() && ( get_theme_mod( 'rp_has_single_category', 'no' ) === 'yes' ) ) ) echo get_category_woo_cat_list( '','<div class="cat-wrap">','</div>' );
    echo '<a href="'. esc_url( $product->get_permalink() ) .'" >';
},9 );
add_action( 'woocommerce_shop_loop_item_title',function(){
},11 );

add_action( 'woocommerce_after_shop_loop_item',function(){
    echo '</div>';
},11 );

if ( ! function_exists( 'rishi_woocommerce_template_loop_product_thumbnail' ) ) :
    /**
     * Gallery Image position
     */
    function rishi_woo_single_post_class($classes, $product) {
        if (! is_product()) {
            return $classes;
        }

        if( class_exists('Rishi\Rishi_Pro') && is_single() && is_product() ){
            $shop_cards_type = get_theme_mod( 'rp_cards_type', 'normal' );
            $shop_cards_sales_badge_design = get_theme_mod( 'rp_shop_cards_sales_badge_design', 'circle' );

            $classes[] = $shop_cards_type . ' ' . $shop_cards_sales_badge_design;
        }

        if (count($product->get_gallery_image_ids()) > 0) {
            if (get_theme_mod('gallery_thumbnail_position', 'horizontal') === 'vertical') {
                $classes[] = 'thumbs-left';
            } else {
                $classes[] = 'thumbs-bottom';
            }
        }

        return $classes;

    }
endif;

add_filter(
	'woocommerce_post_class',
	'rishi_woo_single_post_class',
	999,
	2
);

if ( ! function_exists( 'rishi_woocommerce_template_loop_product_thumbnail' ) ) :
	/**
	 * Get the product thumbnail for the loop.
	 */
	function rishi_woocommerce_template_loop_product_thumbnail() {
        if( is_single() && is_product() && class_exists('Rishi\Rishi_Pro') ){
            $image_size = get_theme_mod( 'rp_thumbnail_image_width', '500' );
            $image_ratio = get_theme_mod( 'rp_thumbnail_cropping', '1/1' );
        }elseif( is_shop() ){
            $image_size = get_theme_mod( 'woocommerce_thumbnail_image_width', '500' );
            $image_ratio = rishi__cb_customizer_get_woocommerce_ratio();
        }else{
            $image_size = 'woocomerce_thumbnail';
            $image_ratio = 1/1;
        }

        global $product;

        echo rishi__cb_customizer_image([
			'attachment_id' =>  $product->get_image_id(),
			'ratio' => $image_ratio,
			'size' =>  $image_size,
		]);
        
	}
endif;
add_action( 'woocommerce_before_shop_loop_item_title', 'rishi_woocommerce_template_loop_product_thumbnail',11 );

if( ! function_exists( 'rishi_wc_get_gallery_image_html' ) ) :
    /*
    * Get HTML for a gallery image.
    *
    * Hooks: woocommerce_gallery_thumbnail_size, woocommerce_gallery_image_size and woocommerce_gallery_full_size accept name based image sizes, or an array of width/height values.
    *
    * @since 3.3.2
    * @param int  $attachment_id Attachment ID.
    * @param bool $main_image Is this the main image or a thumbnail?.
    * @return string
    */
    function rishi_wc_get_gallery_image_html( $attachment_id, $main_image = false ) {
        $gallery_ratio     = rishi_woocommerce_ratio_calc( get_theme_mod( 'gallery_image_options', '1/1' ) );
        $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
        $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
        $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
        $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
        $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
        $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
        $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
        $alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
        $image             = wp_get_attachment_image(
            $attachment_id,
            $image_size,
            false,
            apply_filters(
                'woocommerce_gallery_image_html_attachment_image_params',
                array(
                    'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
                    'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
                    'data-src'                => esc_url( $full_src[0] ),
                    'data-large_image'        => esc_url( $full_src[0] ),
                    'data-large_image_width'  => esc_attr( $full_src[1] ),
                    'data-large_image_height' => esc_attr( $full_src[2] ),
                    'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
                ),
                $attachment_id,
                $image_size,
                $main_image
            )
        );

        $style = 'padding-bottom: ' . $gallery_ratio . '%';

        return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a class="rt-image-container" href="' . esc_url( $full_src[0] ) . '">' . $image . '<span class="rt-ratio" style="' . $style . '"></span></a></div>';
    }
endif;

if( ! function_exists( 'rishi_woocommerce_ratio_calc' ) ) :
    function rishi_woocommerce_ratio_calc( $ratio ){
        if( $ratio === 'original' ){
            $percentage = 100;
        }elseif( $ratio ){
        $b = explode( strpos( $ratio, '/') !== false ? '/' : ':', $ratio );
        if( $b ){
            $percentage = ( ( $b[1] ? $b[1] : 1 )/ ( $b[0] ? $b[0] : 1 ) * 100 );
        } 
        }

        return $percentage;
    }
endif;

/**
 * Add class to the product link wrapper
 */
function woocommerce_template_loop_product_link_open() {
    global $product;

    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );

    echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
    
}

if ( ! function_exists( 'rishi_sale_badge_text' ) ) :
    /**
     * Adds Sales Badge Section.
     *
     */
    function rishi_sale_badge_text() { 
        $ed_salesbadge 		= get_theme_mod('has_sale_badge', 'yes');
        $sales_badge_title 	= get_theme_mod('sales_badge_title', __('Sale!', 'rishi') );
            
        if( $ed_salesbadge == 'yes' ) {
            $value = '<span class="onsale">' . esc_html( $sales_badge_title ) . '</span>';
        }
    
        return $value;
    }
endif;
add_filter( 'woocommerce_sale_flash', 'rishi_sale_badge_text', 10, 3 );

if( ! function_exists( 'rishi_get_related_products_info' ) ) :
	/** 
	 * Related Products Title
	 */
	function rishi_get_related_products_info(){
		$defaults       = rishi__cb__get_layout_defaults();
		$product_title   = get_theme_mod('single_related_products', $defaults['single_related_products']);
		return $product_title;
	}
endif;
add_filter( 'woocommerce_product_related_products_heading', 'rishi_get_related_products_info' );