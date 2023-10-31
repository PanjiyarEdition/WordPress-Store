<?php
/**
 * Customizer Settings Defaults
 *
 * @package customizer-builder
 */

/**
 * Typography Defaults
 */
function rishi__cb__get_typography_defaults() {
	$defaults = array(
		'body'          => array(
			'family'           => 'System Default',
			'variants'         => '',
			'category'         => '',
			'weight'           => '400',
			'transform'        => 'none',
			'font_size'        => '18px',
			'line_height'      => 36,
			'paragraph_margin' => 27,
		),
		'heading'       => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => '600',
			'transform' => 'none',
		),
		'sitetitle'     => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => 'bold',
			'transform' => 'none',
			'font_size' => 27,
		),
		'sitetagline'   => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => '300',
			'transform' => 'none',
			'font_size' => 13,
		),
		'primarynav'    => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => '400',
			'transform' => 'none',
			'font_size' => 16,
		),
		'header_button' => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => '400',
			'transform' => 'uppercase',
			'font_size' => 14,
		),
		'breadcrumb'    => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => '400',
			'transform' => 'none',
			'font_size' => 14,
		),
		'button'        => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => '400',
			'transform' => 'none',
			'font_size' => 16,
		),
		'heading_one'   => array(
			'family'      => 'System Default',
			'variants'    => '',
			'category'    => '',
			'weight'      => '700',
			'transform'   => 'none',
			'font_size'   => 40,
			'line_height' => 55,
		),
		'heading_two'   => array(
			'family'      => 'System Default',
			'variants'    => '',
			'category'    => '',
			'weight'      => '700',
			'transform'   => 'none',
			'font_size'   => 36,
			'line_height' => 48,
		),
		'heading_three' => array(
			'family'      => 'System Default',
			'variants'    => '',
			'category'    => '',
			'weight'      => '700',
			'transform'   => 'none',
			'font_size'   => 30,
			'line_height' => 44,
		),
		'heading_four'  => array(
			'font_size'   => 26,
			'line_height' => 40,
		),
		'heading_five'  => array(
			'font_size'   => 22,
			'line_height' => 34,
		),
		'heading_six'   => array(
			'font_size'   => 18,
			'line_height' => 32,
		),
		'widgets'       => array(
			'family'        => 'System Default',
			'variants'      => '',
			'category'      => '',
			'weight'        => '600',
			'transform'     => 'none',
			'font_size'     => 18,
			'bottom_margin' => 50,
		),
		'footer'        => array(
			'family'    => 'System Default',
			'variants'  => '',
			'category'  => '',
			'weight'    => '400',
			'transform' => 'none',
			'font_size' => 14,
		),
	);

	return apply_filters( 'rishi__cb__typography_options_defaults', $defaults );
}

/**
 * Color Defaults
 */
function rishi__cb__get_color_defaults() {
	$defaults = array(
		'primary_color'                         => 'var(--paletteColor1)',
		'base_color'                            => 'var(--paletteColor7)',
		'genLinkColor'                          => 'var(--paletteColor3)',
		'genLinkHoverColor'                     => 'var(--paletteColor4)',
		'linkHighlightColor'                    => 'var(--paletteColor3)',
		'linkHighlightHoverColor'               => 'var(--paletteColor1)',
		'linkHighlightBackgroundColor'          => 'var(--paletteColor6)',
		'linkHighlightBackgroundHoverColor'     => 'var(--paletteColor3)',
		'genheadingColor'                       => 'var(--paletteColor2)',
		'textSelectionColor'                    => 'var(--paletteColor3)',
		'genborderColor'                        => 'var(--paletteColor6)',
		'site_background'                       => 'var(--paletteColor8)',
		'top_header_bg_color'                   => 'var(--paletteColor2)',
		'top_header_text_color'                 => 'var(--paletteColor1)',
		'top_header_link_color'                 => 'var(--paletteColor3)',
		'top_header_link_hover_color'           => 'var(--paletteColor2)',
		'primary_header_bg_color'               => 'var(--paletteColor5)',
		'primary_header_bottom_border_color'    => 'rgba(41, 41, 41, 0.05)',
		'primary_header_menu_item_color'        => 'var(--paletteColor1)',
		'primary_header_menu_item_hover_color'  => 'var(--paletteColor3)',
		'primary_header_menu_item_active_color' => 'var(--paletteColor3)',
		'header_btn_text_color'                 => 'var(--paletteColor5)',
		'header_btn_text_hover_color'           => 'var(--paletteColor3)',
		'header_btn_bg_color'                   => 'var(--paletteColor3)',
		'header_btn_bg_hover_color'             => 'var(--paletteColor5)',
		'header_btn_border_color'               => 'var(--paletteColor3)',
		'header_btn_border_hover_color'         => 'var(--paletteColor3)',
		'footer_bg_color'                       => 'var(--paletteColor2)',
		'footer_widget_title_color'             => 'rgba(255, 255, 255, 1)',
		'footer_text_color'                     => 'rgba(255, 255, 255, 0.9)',
		'footer_link_color'                     => 'rgba(255, 255, 255, 0.9)',
		'footer_link_hover_color'               => 'var(--paletteColor3)',
		'footer_border_top_color'               => 'rgba(255, 255, 255, 0.1)',
		'footer_bar_border_top_color'           => 'rgba(255, 255, 255, 0.1)',
		'footer_list_item_border_bottom_color'  => 'rgba(255, 255, 255, 0.1)',
		'footer_bar_bg_color'                   => 'var(--paletteColor2)',
		'footer_bar_text_color'                 => 'rgba(255,255,255,0.6)',
		'footer_bar_link_color'                 => 'rgba(255,255,255,0.6)',
		'footer_bar_link_hover_color'           => 'rgba(255,255,255,1)',
		'topButtonIconColorDefault'             => 'var(--paletteColor3)',
		'topButtonIconColorHover'               => 'var(--paletteColor5)',
		'topButtonShapeBackgroundDefault'       => 'rgba(41,41,41,0)',
		'topButtonShapeBackgroundHover'         => 'var(--paletteColor3)',
		'topButtonBorderDefaultColor'           => 'var(--paletteColor3)',
		'topButtonBorderHoverColor'             => 'var(--paletteColor3)',
		'breadcrumbsColor'                      => 'rgba(41,41,41,0.30)',
		'breadcrumbsCurrentColor'               => 'var(--paletteColor1)',
		'breadcrumbsSeparatorColor'             => 'rgba(41,41,41,0.30)',
		'btn_text_color'                        => 'var(--paletteColor5)',
		'btn_text_hover_color'                  => 'var(--paletteColor3)',
		'btn_bg_color'                          => 'var(--paletteColor3)',
		'btn_bg_hover_color'                    => 'var(--paletteColor5)',
		'btn_border_color'                      => 'var(--paletteColor3)',
		'btn_border_hover_color'                => 'var(--paletteColor3)',
		'woo_btn_text_color'                    => 'var(--paletteColor5)',
		'woo_btn_text_hover_color'              => 'var(--paletteColor5)',
		'woo_btn_bg_color'                      => 'var(--paletteColor3)',
		'woo_btn_bg_hover_color'                => 'var(--paletteColor4)',
		'woo_btn_border_color'                  => 'var(--paletteColor3)',
		'woo_btn_border_hover_color'            => 'var(--paletteColor4)',
	);

	return apply_filters( 'rishi__cb__color_options_defaults', $defaults );
}

/**
 * Background Defaults
 */
function rishi__cb__get_background_defaults() {

	$defaults = array(
		'top_header_bg'     => array(
			'image'    => '',
			'repeat'   => '',
			'size'     => '',
			'position' => '',
		),
		'primary_header_bg' => array(
			'image'    => '',
			'repeat'   => '',
			'size'     => '',
			'position' => '',
		),
		'footer_widget_bg'  => array(
			'image'    => '',
			'repeat'   => '',
			'size'     => '',
			'position' => '',
		),
		'footer_bar_bg'     => array(
			'image'    => '',
			'repeat'   => '',
			'size'     => '',
			'position' => '',
		),
	);

	return apply_filters( 'rishi__cb__background_options_defaults', $defaults );
}

/**
 * Button Defaults
 */
function rishi__cb__get_breadcrumbs_defaults() {

	$defaults = array(
		'breadcrumbs_position'           => 'before',
		'breadcrumbs_separator'          => 'type-1',
		'breadcrumbs_ed_search'          => 'no',
		'breadcrumbs_ed_author'          => 'no',
		'breadcrumbs_ed_archive'         => 'no',
		'breadcrumbs_ed_single_post'     => 'yes',
		'breadcrumbs_ed_single_page'     => 'yes',
		'breadcrumbs_ed_single_product'  => 'yes',
		'breadcrumbs_ed_archive_product' => 'yes',
		'blog_ed_breadcrumbs'            => 'yes',
		'breadcrumbs_ed_404'             => 'no',
		'breadcrumbs_alignment'          => 'left',
	);

	return apply_filters( 'rishi__cb__breadcrumbs_options_defaults', $defaults );
}

/**
 * Button Defaults
 */
function rishi__cb__get_button_defaults() {

	$defaults = array(
		'botton_roundness' => array(
			'desktop' => '3px',
			'tablet'  => '3px',
			'mobile'  => '3px',
		),
		'button_padding'   => array(
			'top'    => '15px',
			'right'  => '34px',
			'bottom' => '15px',
			'left'   => '34px',
		),
	);

	return apply_filters( 'rishi__cb__button_options_defaults', $defaults );
}

/**
 * Layouts Overall All Defaults
 */
function rishi__cb__get_layout_defaults( $default = '', $index = null ) {

	$defaults = array(
		'blog_page_layout'              => 'classic',
		'post_navigation'               => 'numbered',
		'blog_posts_per_row'            => 2,
		'blog_sidebar_layout'           => 'default-sidebar',
		'blog_container'                => 'default',
		'blog_container_streched_ed'    => 'no',
		'post_sidebar_layout'           => 'right-sidebar',
		'blog_post_layout'              => 'default',
		'blog_post_streched_ed'         => 'no',
		'archive_page_layout'           => 'classic',
		'archive_post_navigation'       => 'numbered',
		'archive_posts_per_row'         => 2,
		'archive_sidebar_layout'        => 'default-sidebar',
		'archive_layout'                => 'default',
		'archive_layout_streched_ed'    => 'no',
		'woo_layout_streched_ed'        => 'no',
		'author_page_layout'            => 'classic',
		'author_post_navigation'        => 'numbered',
		'author_posts_per_row'          => 2,
		'author_sidebar_layout'         => 'default-sidebar',
		'author_layout'                 => 'default',
		'author_layout_streched_ed'     => 'no',
		'search_page_layout'            => 'classic',
		'search_post_navigation'        => 'numbered',
		'search_posts_per_row'          => 2,
		'search_sidebar_layout'         => 'default-sidebar',
		'search_layout'                 => 'default',
		'search_layout_streched_ed'     => 'no',
		'page_layout_streched_ed'       => 'no',
		'container_width'               => array(
			'desktop' => '1170px',
			'tablet'  => '992px',
			'mobile'  => '420px',
		),
		'container_content_max_width'   => array(
			'desktop' => '728px',
			'tablet'  => '500px',
			'mobile'  => '400px',
		),
		'containerVerticalMargin'       => array(
			'desktop' => '80px',
			'tablet'  => '40px',
			'mobile'  => '40px',
		),
		'sidebar_widget_spacing'        => array(
			'desktop' => '64px',
			'tablet'  => '50px',
			'mobile'  => '30px',
		),
		'widgets_font_size'             => array(
			'desktop' => '18px',
			'tablet'  => '16px',
			'mobile'  => '14px',
		),
		'layout'                        => 'boxed',
		'page_layout'                   => 'boxed',
		'woocommerce_layout'            => 'default',
		'layout_style'                  => 'right-sidebar',
		'page_sidebar_layout'           => 'right-sidebar',
		'woocommerce_sidebar_layout'    => 'no-sidebar',
		'single_product_sidebar_layout' => 'default-sidebar',
		'content_sidebar_width'         => 28,
		'ed_footer_widget_title'        => 'yes',
		'ed_show_post_navigation'       => 'yes',
		'ed_show_post_author'           => 'yes',
		'author_box_layout'             => 'layout-one',
		'ed_scroll_to_top'              => 'no',
		'ed_post_tags'                  => 'yes',
		'ed_link_highlight'             => 'yes',
		'ed_related'                    => 'yes',
		'underlinestyle'                => 'style1',
		'single_related_title'          => __( 'Related Posts', 'rishi' ),
		'related_taxonomy'              => 'cat',
		'ed_related_after_comment'      => 'no',
		'ed_comment'                    => 'yes',
		'ed_page_comment'               => 'no',
		'no_of_related_post'            => 3,
		'related_post_per_row'          => 3,
		'ed_comment_form_above_clist'   => 'no',
		'ed_comment_below_content'      => 'no',
		'single_related_products'		=> __('Related Products', 'rishi' )
	);

	if ( $index ) {
		if ( isset( $defaults[ $index ] ) ) {
			return $defaults[ $index ];
		} else {
			return $default;
		}
	}

	return apply_filters( 'rishi__cb__button_layouts_defaults', $defaults );
}
add_filter( 'rishi__cb_layout_defaults', 'rishi__cb__get_layout_defaults' );


function rishi__cb__get_default_blogpost_structure() {

	$default_post_structure = array();

	$default_post_structure[] = array(
		'id'                        => 'featured_image',
		'enabled'                   => true,
		'featured_image_ratio'      => 'original',
		'featured_image_scale'      => 'contain',
		'featured_image_size'       => 'full',
		'featured_image_visibility' => array(
			'desktop' => true,
			'tablet'  => true,
			'mobile'  => true,
		),
	);

	$default_post_structure[] = array(
		'id'            => 'custom_meta',
		'enabled'       => true,
		'meta_elements' => rishi__cb__customizer_post_meta_defaults(
			array(
				array(
					'id'      => 'categories',
					'enabled' => true,
				),
			)
		),
		'meta_divider'  => 'circle',
	);

	$default_post_structure[] = array(
		'id'          => 'custom_title',
		'enabled'     => true,
		'heading_tag' => 'h2',
		'font_size'   => array(
			'desktop' => '28px',
			'tablet'  => '28px',
			'mobile'  => '28px',
		),
	);

	$default_post_structure[] = array(
		'id'            => 'custom_meta',
		'enabled'       => true,
		'meta_elements' => rishi__cb__customizer_post_meta_defaults(
			array(
				array(
					'id'          => 'author',
					'enabled'     => true,
					'avatar_size' => 34,
				),
				array(
					'id'      => 'post_date',
					'enabled' => true,
				),
				array(
					'id'      => 'comments',
					'enabled' => true,
				),
			)
		),
		'meta_divider'  => 'circle',
	);

	$default_post_structure[] = array(
		'id'             => 'excerpt',
		'enabled'        => true,
		'post_content'   => 'excerpt',
		'excerpt_length' => 30,
	);

	$default_post_structure[] = array(
		'id'             => 'divider',
		'enabled'        => true,
		'divider_margin' => rishi__cb_customizer_spacing_value(
			array(
				'top'    => '0',
				'bottom' => '20px',
				'left'   => 'auto',
				'right'  => 'auto',
				'linked' => true,
			)
		),
	);

	$default_post_structure[] = array(
		'id'              => 'read_more',
		'enabled'         => true,
		'button_type'     => 'simple',
		'read_more_text'  => __( 'Read More', 'rishi' ),
		'read_more_arrow' => 'yes',
	);

	return $default_post_structure;
}

function rishi__cb__get_default_postmeta_structure() {
	return rishi__cb__customizer_post_meta_defaults(
		array(
			array(
				'id'      => 'post_date',
				'enabled' => true,
			),
			array(
				'id'      => 'categories',
				'enabled' => true,
			),
		)
	);
}

function rishi__cb__get_default_post_structure() {

	$default_post_structure = array();

	$default_post_structure[] = array(
		'id'                        => 'featured_image',
		'enabled'                   => true,
		'featured_image_ratio'      => 'original',
		'featured_image_scale'      => 'contain',
		'featured_image_size'       => 'full',
		'featured_image_visibility' => array(
			'desktop' => true,
			'tablet'  => true,
			'mobile'  => true,
		),
	);

	$default_post_structure[] = array(
		'id'            => 'custom_meta',
		'enabled'       => true,
		'meta_elements' => rishi__cb__customizer_post_meta_defaults(
			array(
				array(
					'id'      => 'categories',
					'enabled' => true,
				),
			)
		),
		'meta_divider'  => 'circle',
	);

	$default_post_structure[] = array(
		'id'          => 'custom_title',
		'enabled'     => true,
		'heading_tag' => 'h1',
	);

	$default_post_structure[] = array(
		'id'            => 'custom_meta',
		'enabled'       => true,
		'meta_elements' => rishi__cb__customizer_post_meta_defaults(
			array(
				array(
					'id'          => 'author',
					'enabled'     => true,
					'avatar_size' => 34,
				),
				array(
					'id'      => 'post_date',
					'enabled' => true,
				),
				array(
					'id'      => 'comments',
					'enabled' => true,
				),
			)
		),
		'meta_divider'  => 'circle',
	);

	return apply_filters( 'rishi__cb__add_post_structure_value', $default_post_structure );
}

function rishi__cb_customizer_defaults( $defaults = array(), $context = 'layouts' ) {
	$_defaults = array(
		'layouts'  => 'rishi__cb__get_layout_defaults',
		'blogpost' => 'rishi__cb__get_default_blogpost_structure',
		'single'   => 'rishi__cb__get_default_post_structure',
		'postmeta' => 'rishi__cb__get_default_postmeta_structure',
	);

	if ( isset( $_defaults[ $context ] ) ) {
		$defaults = is_callable( $_defaults[ $context ] ) ? call_user_func( $_defaults[ $context ] ) : $defaults;
	}
	return apply_filters( "rishi__cb_defaults_{$context}", $defaults, $context );
}
add_filter( 'rishi__cb_defaults', 'rishi__cb_customizer_defaults', 10, 2 );
