<?php

/**
 * Customizer options
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package rishi__cb_customizer_Builder
 */


$extensions_options = apply_filters(
	'rishi__cb_customizer_extensions_customizer_options',
	array()
);

// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$options = array();

$view_pro_title = [
	rishi__cb_customizer_rand_md5() => [
		'type' => 'rt-group-title',
		'title' => '<div class="rt-view-pro">
			<a href="' . esc_url( 'https://rishitheme.com/pricing/' ) . '" class="button button-secondary alignright" target="_blank">
			' . __('UPGRADE TO PRO VERSION', 'rishi') . '
			</a>
		</div>',
		'priority' => 1,
	]
];

if ( class_exists('Rishi\Rishi_Pro') ) {
	$view_pro_title = [];
}

$options[] = apply_filters(
	'rishi__cb_core__options',
	array(
		$view_pro_title,
		rishi__cb_customizer_rand_md5() => array(
			'id'       => 'general',
			'type'     => 'rt-group-title',
			'title'    => __( 'General Options', 'rishi' ),
			'priority' => 1,
		),
		'layout'                                  => array(
			'title'     => __( 'Layouts', 'rishi' ),
			'container' => array( 'priority' => 1 ),
			'options'   => rishi__cb_customizer_get_options( 'general/general' ),
		),
		'colors_panel'                            => array(
			'title'     => __( 'Colors', 'rishi' ),
			'container' => array( 'priority' => 1 ),
			'options'   => rishi__cb_customizer_get_options( 'general/colors/color-options' ),
		),
		'header'                                  => array(
			'title'     => __( 'Header', 'rishi' ),
			'container' => array( 'priority' => 1 ),
			'options'   => rishi__cb_customizer_get_options( 'general/header' ),
		),
		'footer'                                  => array(
			'title'     => __( 'Footer', 'rishi' ),
			'container' => array( 'priority' => 1 ),
			'options'   => rishi__cb_customizer_get_options( 'general/footer' ),
		),
		'typography'                              => array(
			'title'     => __( 'Typography', 'rishi' ),
			'container' => array( 'priority' => 1 ),
			'options'   => rishi__cb_customizer_get_options( 'general/typography/typography' ),
		),
		'seo'                                     => array(
			'title'     => __( 'SEO', 'rishi' ),
			'container' => array( 'priority' => 1 ),
			'options'   => rishi__cb_customizer_get_options( 'general/seo/seo-options' ),
		),
		'social_accounts'                                     => array(
			'title'     => __( 'Social Networks', 'rishi' ),
			'container' => array( 'priority' => 1 ),
			'options'   => rishi__cb_customizer_get_options( 'engagement/social-accounts' ),
		),
		rishi__cb_customizer_rand_md5() => array(
			'id'       => 'posts-pages',
			'type'     => 'rt-group-title',
			'title'    => __( 'Posts / Pages', 'rishi' ),
			'priority' => 3,
		),
		'blogarchive'                             => array(
			'title'     => __( 'Blog Page', 'rishi' ),
			'container' => array( 'priority' => 3.1 ),
			'options'   => rishi__cb_customizer_get_options( 'posts/postoptions' ),
		),
		'archive'                                 => array(
			'title'     => __( 'Archive Page', 'rishi' ),
			'container' => array( 'priority' => 3.2 ),
			'options'   => rishi__cb_customizer_get_options( 'pages/archive' ),
		),
		'authorarchive'                           => array(
			'title'     => __( 'Author Page', 'rishi' ),
			'container' => array( 'priority' => 3.3 ),
			'options'   => rishi__cb_customizer_get_options( 'pages/author' ),
		),
		'search'                                  => array(
			'title'     => __( 'Search Page', 'rishi' ),
			'container' => array( 'priority' => 3.4 ),
			'options'   => rishi__cb_customizer_get_options( 'pages/search' ),
		),
		'singlepost'                              => array(
			'title'     => __( 'Single Post', 'rishi' ),
			'container' => array( 'priority' => 3.5 ),
			'options'   => rishi__cb_customizer_get_options( 'posts/singlepost' ),
		),
		'pages'                                   => array(
			'title'     => __( 'Pages', 'rishi' ),
			'container' => array( 'priority' => 3.6 ),
			'options'   => rishi__cb_customizer_get_options( 'pages/pages' ),
		),
	)
);

if ( function_exists( 'is_shop' ) ) {
	$options[] = apply_filters(
		'rishi__cb_woocommerce__options',
		array(
			rishi__cb_customizer_rand_md5() => array(
				'id'       => 'woocommerce',
				'type'     => 'rt-group-title',
				'title'    => __( 'WooCommerce', 'rishi' ),
				'priority' => 10,
			),

			'woocommerce_storenotice'                 => array(
				'title'     => __( 'Store Notice', 'rishi' ),
				'container' => array(
					'priority' => 10.5,
				),
				'options'   => rishi__cb_customizer_get_options( 'woo/woo-storenotice' ),
			),

			'woocommerce_general'                     => array(
				'title'     => __( 'General', 'rishi' ),
				'container' => array(
					'priority' => 10.6,
				),
				'options'   => rishi__cb_customizer_get_options( 'woo/woo-general' ),
			),

			'woocommerce_product_archives'            => array(
				'title'     => __( 'Shop Page', 'rishi' ),
				'container' => array(
					'priority' => 10.7,
				),
				'options'   => rishi__cb_customizer_get_options( 'woo/woo-archives' ),
			),

			'woocommerce_single'                      => array(
				'title'     => __( 'Single Product', 'rishi' ),
				'container' => array(
					'priority' => 10.8,
				),
				'options'   => rishi__cb_customizer_get_options( 'woo/woo-single' ),
			),


			'woocommerce_checkout'                    => array(
				'title'          => __( 'Checkout Page', 'rishi' ),
				'container'      => array(
					'priority' => 10.9,
				),
				'only_if_exists' => true,
				'options'        => array(),
			),

			apply_filters(
				'rishi_customizer_options:woocommerce:end',
				array()
			),
		)
	);
}

if ( ! empty( $extensions_options ) ) {
	$options[] = apply_filters(
		'rishi__cb_extensions__options',
		array(
			rishi__cb_customizer_rand_md5() => array(
				'id'       => 'extensions',
				'type'     => 'rt-group-title',
				'title'    => __( 'Extensions', 'rishi' ),
				'priority' => 7,
			),
			$extensions_options,
		)
	);

}