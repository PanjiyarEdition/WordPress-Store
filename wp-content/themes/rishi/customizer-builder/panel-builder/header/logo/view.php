<?php

if ( ! isset( $device ) ) {
	$device = 'desktop';
}

$hidden = rishi__cb_customizer_default_akg( 'header_hide_logo', $atts, false );

if ( $hidden ) {
	return '';
}

$default_logo = rishi__cb_customizer_expand_responsive_value(
	rishi__cb_customizer_default_akg( 'custom_logo', $atts, '' )
);

$transparent_logo = rishi__cb_customizer_expand_responsive_value(
	rishi__cb_customizer_default_akg( 'transparent_logo', $atts, '' )
);

$sticky_logo = rishi__cb_customizer_expand_responsive_value(
	rishi__cb_customizer_default_akg( 'sticky_logo', $atts, '' )
);

$custom_logo_id     = '';
$additional_logo_id = '';

if (
	isset( $has_transparent_header )
	&&
	$has_transparent_header
	&&
	is_array( $has_transparent_header )
	&&
	in_array( $device, $has_transparent_header )
	&&
	! empty( $transparent_logo[ $device ] )
) {
	$custom_logo_id = $transparent_logo[ $device ];
} else {
	if ( ! empty( $default_logo[ $device ] ) ) {
		$custom_logo_id = $default_logo[ $device ];
	}
}

if (
	isset( $has_sticky_header )
	&&
	is_array( $has_sticky_header )
	&&
	is_array( $has_sticky_header['devices'] )
	&&
	in_array( $device, $has_sticky_header['devices'] )
	&&
	! empty( $sticky_logo[ $device ] )
) {
	if ( ! $custom_logo_id ) {
		$custom_logo_id = $sticky_logo[ $device ];
	} else {
		$additional_logo_id = $sticky_logo[ $device ];
	}
}

if ( $custom_logo_id ) {
	$custom_logo_attr = array(
		'class'    => 'default-logo',
		'itemprop' => 'logo',
	);

	/**
	 * If the logo alt attribute is empty, get the site title and explicitly
	 * pass it to the attributes used by wp_get_attachment_image().
	 */
	$image_alt = get_post_meta(
		$custom_logo_id,
		'_wp_attachment_image_alt',
		true
	);

	if ( empty( $image_alt ) ) {
		$custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
	}

	$image_logo_html = wp_get_attachment_image(
		$custom_logo_id,
		'full',
		false,
		$custom_logo_attr
	);

	if ( ! empty( $additional_logo_id ) ) {
		$custom_logo_attr['class'] = 'sticky-logo';

		$image_logo_html = wp_get_attachment_image(
			$additional_logo_id,
			'full',
			false,
			$custom_logo_attr
		) . $image_logo_html;
	}

	/**
	 * If the alt attribute is not empty, there's no need to explicitly pass
	 * it because wp_get_attachment_image() already adds the alt attribute.
	 */
	$logo_html = sprintf(
		'<a href="%1$s" class="site-logo-container" rel="home" itemprop="url">%2$s</a>',
		esc_url(
			apply_filters( 'rishi:header:logo:url', home_url( '/' ) )
		),
		$image_logo_html
	);
}

$tagline_class = 'site-description ' . rishi__cb_customizer_visibility_classes(
	rishi__cb_customizer_default_akg(
		'blogdescription_visibility',
		$atts,
		array(
			'desktop' => true,
			'tablet'  => true,
			'mobile'  => true,
		)
	)
);

$site_title_class = 'site-title ' . rishi__cb_customizer_visibility_classes(
	rishi__cb_customizer_default_akg(
		'blogname_visibility',
		$atts,
		array(
			'desktop' => true,
			'tablet'  => true,
			'mobile'  => true,
		)
	)
);

$rt_tag = 'span';

if ( is_home() || is_front_page() ) {
	if ( $device !== 'mobile' ) {
		$rt_tag = 'h1';
	}
}

$has_site_title = rishi__cb_get_akv( 'has_site_title', $atts, 'yes' ) === 'yes';
$has_tagline    = rishi__cb_get_akv( 'has_tagline', $atts, 'no' ) === 'yes';

$logo_type                 = rishi__cb_customizer_default_akg( 'logo_type', $atts, 'logo-title' );
$logo_title_layout         = rishi__cb_customizer_default_akg( 'logo_title_layout', $atts, 'logotitle' );
$logo_title_tagline_layout = rishi__cb_customizer_default_akg( 'logo_title_tagline_layout', $atts, 'logotitletagline' );

switch ( $logo_type ) {
	case 'logo-title':
		$logo_title_layout_class = 'data-logo-layout="' . rishi__cb_get_akv( 'logo_title_layout', $atts, 'logotitle' ) . '"';
		break;
	case 'logo-title-tagline':
		$logo_title_layout_class = 'data-logo-layout="' . rishi__cb_get_akv( 'logo_title_tagline_layout', $atts, 'logotitletagline' ) . '"';
		break;

	default:
		$logo_title_layout_class = '';
		break;
}

$logo_position = '';

if (
	$custom_logo_id
	&&
	( $has_site_title
		||
		$has_tagline )
) {
	$logo_position = 'data-logo="' . rishi__cb_get_akv( 'logo_position', $atts, 'top' ) . '"';
}

$class = trim(
	'site-branding' . ' ' . rishi__cb_customizer_visibility_classes(
		rishi__cb_get_akv(
			'visibility',
			$atts,
			array(
				'desktop' => true,
				'tablet'  => true,
				'mobile'  => true,
			)
		)
	)
);

?>

<div class="<?php echo $class; ?>" <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?> <?php echo $logo_position; ?> <?php echo $logo_title_layout_class; ?> <?php echo rishi__cb_customizer_schema_org_definitions( 'logo' ); ?>>

	<?php
	switch ( $logo_type ) {
		case 'logo':
			?>
			<?php if ( $custom_logo_id ) { ?>
				<?php echo wp_kses_post( $logo_html ); ?>
			<?php } ?>
			<?php if ( $has_site_title && $site_title_class ) { ?>
				<<?php echo $rt_tag; ?> class="screen-reader-text <?php echo $site_title_class; ?>" <?php echo rishi__cb_customizer_schema_org_definitions( 'name' ); ?>>
					<a href="<?php echo esc_url( apply_filters( 'rishi:header:logo:url', home_url( '/' ) ) ); ?>" rel="home" <?php echo rishi__cb_customizer_schema_org_definitions( 'url' ); ?>>
						<?php
						echo rishi__cb_customizer_translate_dynamic(
							rishi__cb_customizer_default_akg(
								'blogname',
								$atts,
								get_bloginfo( 'name' )
							),
							'header:' . $section_id . ':logo:blogname'
						);
						?>
					</a>
				</<?php echo $rt_tag; ?>>
			<?php } ?>
			<?php
			break;
		case 'logo-title':
			?>
			<?php if ( $custom_logo_id || $site_title_class ) { ?>
				<div class="site-title-container">
					<?php if ( $custom_logo_id ) { ?>
						<?php echo wp_kses_post( $logo_html ); ?>
					<?php } ?>
					<?php if ( $site_title_class ) { ?>
						<<?php echo $rt_tag; ?> class="<?php echo $site_title_class; ?>" <?php echo rishi__cb_customizer_schema_org_definitions( 'name' ); ?>>
							<a href="<?php echo esc_url( apply_filters( 'rishi:header:logo:url', home_url( '/' ) ) ); ?>" rel="home" <?php echo rishi__cb_customizer_schema_org_definitions( 'url' ); ?>>
								<?php
								echo rishi__cb_customizer_translate_dynamic(
									rishi__cb_customizer_default_akg(
										'blogname',
										$atts,
										get_bloginfo( 'name' )
									),
									'header:' . $section_id . ':logo:blogname'
								);
								?>
							</a>
						</<?php echo $rt_tag; ?>>
					<?php } ?>
				</div>
				<?php
			}
			break;
		case 'logo-title-tagline':
			?>
			<?php if ( $custom_logo_id || $site_title_class || $has_tagline ) { ?>
				<div class="site-title-container">
					<?php if ( $custom_logo_id ) { ?>
						<?php echo wp_kses_post( $logo_html ); ?>
					<?php } ?>
					<?php if ( $has_tagline ) { ?>
						<p class="<?php echo $tagline_class; ?>" <?php echo rishi__cb_customizer_schema_org_definitions( 'description' ); ?>>
							<?php
							echo rishi__cb_customizer_translate_dynamic(
								rishi__cb_customizer_default_akg(
									'blogdescription',
									$atts,
									get_bloginfo( 'description' )
								),
								'header:' . $section_id . ':logo:blogdescription'
							);
							?>
						</p>
					<?php } ?>
					<?php if ( $site_title_class ) { ?>
						<<?php echo $rt_tag; ?> class="<?php echo $site_title_class; ?>" <?php echo rishi__cb_customizer_schema_org_definitions( 'name' ); ?>>
							<a href="<?php echo esc_url( apply_filters( 'rishi:header:logo:url', home_url( '/' ) ) ); ?>" rel="home" <?php echo rishi__cb_customizer_schema_org_definitions( 'url' ); ?>>
								<?php
								echo rishi__cb_customizer_translate_dynamic(
									rishi__cb_customizer_default_akg(
										'blogname',
										$atts,
										get_bloginfo( 'name' )
									),
									'header:' . $section_id . ':logo:blogname'
								);
								?>
							</a>
						</<?php echo $rt_tag; ?>>
					<?php } ?>
				</div>
				<?php
			}
			break;

		default:
			break;
	}
	?>
</div>
