<?php

$share_box_icon_size = get_theme_mod( 'single_blog_post_share_box_icon_size', '15px' );
	rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.cb__share-box',
		'variableName' => 'icon-size',
		'value'        => $share_box_icon_size,
		'unit'		   => '',
	]);
	rishi__cb_customizer_output_spacing([
		'css' => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.cb__share-box',
		'property' => 'iconSpacing',
		'value' => get_theme_mod(
			'single_blog_post_icons_spacing',
			rishi__cb_customizer_spacing_value([
				'linked' => true,
				'top'    => '0px',
				'left'   => '0px',
				'right'  => '10px',
				'bottom' => '10px',
			])
		),
	]);

	$top_share_box_spacing = get_theme_mod( 'single_blog_post_top_share_box_spacing', '10px' );
	rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.cb__share-box[data-location="top"]',
		'variableName' => 'margin',
		'value'        => $top_share_box_spacing,
		'unit'         => ''
	]);

	$bottom_share_box_spacing = get_theme_mod( 'single_blog_post_bottom_share_box_spacing', '10px' );
	rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.cb__share-box[data-location="bottom"]',
		'variableName' => 'margin',
		'value'        => $bottom_share_box_spacing,
		'unit'         => ''
	]);

	$sticky_top_offset = get_theme_mod( 'single_blog_post_sticky_top_offset', '150px' );
	rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.cb__share-box[data-sticky="yes"]',
		'variableName' => 'topOffset',
		'value'        => $sticky_top_offset,
		'unit'         => ''
	]);

	$sticky_side_offset = get_theme_mod( 'single_blog_post_sticky_side_offset', '15px' );
	rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.cb__share-box[data-sticky="yes"]',
		'variableName' => 'sideOffset',
		'value'        => $sticky_side_offset,
		'unit'         => ''
	]);

	rishi__cb_customizer_output_responsive([
		'css'          => $css,
		'tablet_css'   => $tablet_css,
		'mobile_css'   => $mobile_css,
		'selector'     => '.cb__share-box',
		'variableName' => 'alignment',
		'value'        => get_theme_mod( 'single_blog_post_share_alignment', 'left'),
		'unit'		   => '',	
		'responsive'   => false,
	]);

	rishi__cb_customizer_output_colors([
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value' => get_theme_mod('single_blog_post_title_color'),
		'default' => [
			'default' => ['color' => 'var(--paletteColor1)'],
			'selector' => '.cb__share-box',
		],
		'variables' => [
			'default' => ['variable' => 'titleColor'],
		],
	]);

	rishi__cb_customizer_output_font_css([
		'font_value' => get_theme_mod(
			'single_blog_post_title_typo',
			rishi__cb_customizer_typography_default_values([
				'variation'   => 'n5',
				'size'        => '14px',
				'line-height' => '1.2',
			])
		),
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector'   => '.cb__share-box',
		'variable'   => 'titleTypo'
	]);

	rishi__cb_customizer_output_colors([
		'value' => get_theme_mod( 'single_blog_post_share_items_icon_color'),
		'default' => [
			'default' => [ 'color' => Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT') ],
			'hover' => [ 'color' => Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT') ],
		],
		'css' => $css,
		'variables' => [
			'default' => [
				'selector' => '.cb__share-box[data-color="custom"]',
				'variable' => 'icon-color'
			],

			'hover' => [
				'selector' => '.cb__share-box[data-color="custom"]',
				'variable' => 'icon-hover-color'
			]
		],
	]);

	rishi__cb_customizer_output_colors([
		'value' => get_theme_mod( 'single_blog_post_share_items_background' ),
		'default' => [
			'default' => [ 'color' => Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT') ],
			'hover' => [ 'color' => Rishi_CSS_Injector::get_skip_rule_keyword('DEFAULT') ],
		],
		'css' => $css,
		'variables' => [
			'default' => [
				'selector' => '.cb__share-box[data-color="custom"]',
				'variable' => 'background-color'
			],

			'hover' => [
				'selector' => '.cb__share-box[data-color="custom"]',
				'variable' => 'background-hover-color'
			]
		],
	]);

// Author Box
if (
	get_theme_mod( $prefix . '_has_author_box', 'no' ) === 'yes'
	&&
	$prefix !== 'single_page'
) {

	$author_box_spacing = get_theme_mod( $prefix . '_single_author_box_spacing', '40px' );

	if ( $author_box_spacing !== '40px' ) {
		rishi__cb_customizer_output_responsive(
			array(
				'css'          => $css,
				'tablet_css'   => $tablet_css,
				'mobile_css'   => $mobile_css,
				'selector'     => rishi__cb_customizer_prefix_selector( '.author-box', $prefix ),
				'variableName' => 'spacing',
				'value'        => $author_box_spacing,
				'unit'         => '',
			)
		);
	}


	$author_box_type = get_theme_mod( $prefix . '_single_author_box_type', 'type-2' );

	if ( $author_box_type === 'type-1' ) {
		rishi__cb_customizer_output_colors(
			array(
				'value'     => get_theme_mod( $prefix . '_single_author_box_background', array() ),
				'default'   => array(
					'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				),
				'css'       => $css,
				'variables' => array(
					'default' => array(
						'selector' => rishi__cb_customizer_prefix_selector( '.author-box[data-type="type-1"]', $prefix ),
						'variable' => 'background-color',
					),
				),
			)
		);

		rishi__cb_customizer_output_box_shadow(
			array(
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
				'selector'   => rishi__cb_customizer_prefix_selector( '.author-box[data-type="type-1"]', $prefix ),
				'value'      => get_theme_mod(
					$prefix . '_single_author_box_shadow',
					rishi__cb_customizer_box_shadow_value(
						array(
							'enable'   => true,
							'h_offset' => 0,
							'v_offset' => 50,
							'blur'     => 90,
							'spread'   => 0,
							'inset'    => false,
							'color'    => array(
								'color' => 'rgba(210, 213, 218, 0.4)',
							),
						)
					)
				),
				'responsive' => true,
			)
		);
	}

	if ( $author_box_type === 'type-2' ) {
		rishi__cb_customizer_output_colors(
			array(
				'value'     => get_theme_mod( $prefix . '_single_author_box_border', array() ),
				'default'   => array(
					'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				),
				'css'       => $css,
				'variables' => array(
					'default' => array(
						'selector' => rishi__cb_customizer_prefix_selector( '.author-box[data-type="type-2"]', $prefix ),
						'variable' => 'border-color',
					),
				),
			)
		);
	}
}

// Posts Navigation
if (
	get_theme_mod( $prefix . '_has_post_nav', 'yes' ) === 'yes'
	&&
	$prefix !== 'single_page'
) {
	rishi__cb_customizer_output_responsive(
		array(
			'css'          => $css,
			'tablet_css'   => $tablet_css,
			'mobile_css'   => $mobile_css,
			'selector'     => rishi__cb_customizer_prefix_selector( '.post-navigation', $prefix ),
			'variableName' => 'margin',
			'value'        => get_theme_mod(
				$prefix . '_post_nav_spacing',
				array(
					'mobile'  => '40px',
					'tablet'  => '60px',
					'desktop' => '80px',
				)
			),
			'unit'         => '',
		)
	);

	rishi__cb_customizer_output_colors(
		array(
			'value'     => get_theme_mod( $prefix . '_posts_nav_font_color', array() ),
			'default'   => array(
				'default' => array( 'color' => 'var(--color)' ),
				'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			),
			'css'       => $css,
			'variables' => array(
				'default' => array(
					'selector' => rishi__cb_customizer_prefix_selector( '.post-navigation', $prefix ),
					'variable' => 'linkInitialColor',
				),

				'hover'   => array(
					'selector' => rishi__cb_customizer_prefix_selector( '.post-navigation', $prefix ),
					'variable' => 'linkHoverColor',
				),
			),
		)
	);
}


// Related Posts
if (
	get_theme_mod( $prefix . '_has_related_posts', 'yes' ) === 'yes'
	&&
	$prefix !== 'single_page'
) {
	rishi__cb_customizer_output_responsive(
		array(
			'css'          => $css,
			'tablet_css'   => $tablet_css,
			'mobile_css'   => $mobile_css,
			'selector'     => rishi__cb_customizer_prefix_selector( '.rt-related-posts-container', $prefix ),
			'variableName' => 'padding',
			'value'        => get_theme_mod(
				$prefix . '_related_posts_container_spacing',
				array(
					'mobile'  => '30px',
					'tablet'  => '50px',
					'desktop' => '70px',
				)
			),
			'unit'         => '',
		)
	);

	rishi__cb_customizer_output_background_css(
		array(
			'selector' => rishi__cb_customizer_prefix_selector( '.rt-related-posts-container', $prefix ),
			'css'      => $css,
			'value'    => get_theme_mod(
				$prefix . '_related_posts_background',
				rishi__cb_customizer_background_default_value(
					array(
						'backgroundColor' => array(
							'default' => array(
								'color' => '#eff1f5',
							),
						),
					)
				)
			),
		)
	);

	rishi__cb_customizer_output_colors(
		array(
			'value'     => get_theme_mod( $prefix . '_related_posts_label_color' ),
			'default'   => array(
				'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			),
			'css'       => $css,
			'variables' => array(
				'default' => array(
					'selector' => rishi__cb_customizer_prefix_selector( '.rt-related-posts-container .rt-block-title', $prefix ),
					'variable' => 'headingColor',
				),
			),
		)
	);

	if ( function_exists( 'rishi__cb_customizer_output_responsive_switch' ) ) {
		rishi__cb_customizer_output_responsive_switch(
			array(
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
				'selector'   => rishi__cb_customizer_prefix_selector( '.rt-related-posts-container', $prefix ),
				'value'      => get_theme_mod(
					$prefix . '_related_visibility',
					array(
						'desktop' => true,
						'tablet'  => false,
						'mobile'  => false,
					)
				),
				'on'         => 'block',
			)
		);
	}

	if ( function_exists( 'rishi__cb_customizer_output_responsive_switch' ) ) {
		rishi__cb_customizer_output_responsive_switch(
			array(
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
				'selector'   => rishi__cb_customizer_prefix_selector( '.rt-related-posts', $prefix ),
				'value'      => get_theme_mod(
					$prefix . '_related_visibility',
					array(
						'desktop' => true,
						'tablet'  => false,
						'mobile'  => false,
					)
				),
				'on'         => 'grid',
			)
		);
	}

	rishi__cb_customizer_output_colors(
		array(
			'value'     => get_theme_mod( $prefix . '_related_posts_link_color' ),
			'default'   => array(
				'default' => array( 'color' => 'var(--color)' ),
				'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			),
			'css'       => $css,
			'variables' => array(
				'default' => array(
					'selector' => rishi__cb_customizer_prefix_selector( '.related-entry-title', $prefix ),
					'variable' => 'linkInitialColor',
				),

				'hover'   => array(
					'selector' => rishi__cb_customizer_prefix_selector( '.related-entry-title', $prefix ),
					'variable' => 'linkHoverColor',
				),
			),
		)
	);

	rishi__cb_customizer_output_colors(
		array(
			'value'     => get_theme_mod( $prefix . '_related_posts_meta_color' ),
			'default'   => array(
				'default' => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
				'hover'   => array( 'color' => \Rishi_CSS_Injector::get_skip_rule_keyword( 'DEFAULT' ) ),
			),
			'css'       => $css,
			'variables' => array(
				'default' => array(
					'selector' => rishi__cb_customizer_prefix_selector( '.rt-related-posts .entry-meta', $prefix ),
					'variable' => 'color',
				),

				'hover'   => array(
					'selector' => rishi__cb_customizer_prefix_selector( '.rt-related-posts .entry-meta', $prefix ),
					'variable' => 'linkHoverColor',
				),
			),
		)
	);

	rishi__cb_customizer_output_spacing(
		array(
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
			'selector'   => rishi__cb_customizer_prefix_selector( '.rt-related-posts .rt-image-container', $prefix ),
			'property'   => 'borderRadius',
			'value'      => get_theme_mod(
				$prefix . '_related_thumb_radius',
				rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
					)
				)
			),
		)
	);


	$relatedNarrowWidth = get_theme_mod( $prefix . '_related_narrow_width', 750 );

	if ( $relatedNarrowWidth !== 750 ) {
		$css->put(
			rishi__cb_customizer_prefix_selector( '.rt-related-posts-container', $prefix ),
			'--narrow-container-max-width: ' . $relatedNarrowWidth . 'px'
		);
	}
}

// divider style
$post_strucuture = get_theme_mod( 'single_blog_post_post_structure', rishi__cb__get_default_post_structure() );
$position        = 'First';

foreach ( $post_strucuture as $structure ) {
	if ( $structure['enabled'] == true && $structure['id'] == 'custom_meta' ) {
		foreach ( $structure['meta_elements'] as $meta ) {
			if ( $meta['enabled'] == true && $meta['id'] == 'categories' ) {
				rishi__cb_customizer_output_colors(
					array(
						'value'     => $meta['divider_color'],
						'default'   => array(
							'default' => array( 'color' => 'var(--paletteColor1)' ),
							'hover'   => array( 'color' => 'var(--paletteColor3)' ),
						),
						'css'       => $css,
						'variables' => array(
							'default' => array( 'variable' => "singleCategoryDividerInitialColor$position" ),
							'hover'   => array( 'variable' => "singleCategoryDividerHoverColor$position" ),
						),
					)
				);
			}
		}
		$position = 'Second';
	}
}

$meta_elements = get_theme_mod( 'related_post_meta_elements', rishi__cb__get_default_postmeta_structure() );
foreach ( $meta_elements as $meta ) {
	if ( $meta['enabled'] == true && $meta['id'] == 'categories' ) {
		rishi__cb_customizer_output_colors(
			array(
				'value'     => $meta['divider_color'],
				'default'   => array(
					'default' => array( 'color' => 'var(--paletteColor1)' ),
					'hover'   => array( 'color' => 'var(--paletteColor3)' ),
				),
				'css'       => $css,
				'variables' => array(
					'default' => array( 'variable' => 'relatedPostCategoryDividerInitialColor' ),
					'hover'   => array( 'variable' => 'relatedPostCategoryDividerHoverColor' ),
				),
			)
		);
	}
}


rishi__cb_customizer_output_colors(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'value'      => get_theme_mod( 'featured_image_caption_overlay_color' ),
		'default'    => array(
			'default'  => array( 'color' => 'var(--paletteColor1)' ),
			'selector' => '.rt-featured-image .rt-caption-wrap',
		),
		'variables'  => array(
			'default' => array( 'variable' => 'captionOverlayColor' ),
		),
	)
);

rishi__cb_customizer_output_colors(
	array(
		'value'     => get_theme_mod( 'featured_image_caption_color' ),
		'default'   => array(
			'default'  => array( 'color' => 'var(--paletteColor8)' ),
			'selector' => '.rt-featured-image .rt-caption-wrap',
		),
		'css'       => $css,
		'variables' => array(
			'default' => array( 'variable' => 'captionColor' ),
		),
	)
);

rishi__cb_customizer_output_spacing(
	array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
		'selector' => '.rt-featured-image .rt-caption-wrap',
		'property'   => 'captionPadding',
		'value'      => get_theme_mod(
			'featured_image_caption_padding',
			rishi__cb_customizer_spacing_value(
				array(
					'linked' => true,
					'top'    => '10px',
					'left'   => '10px',
					'right'  => '10px',
					'bottom' => '10px',
				)
			)
		),
	)
);