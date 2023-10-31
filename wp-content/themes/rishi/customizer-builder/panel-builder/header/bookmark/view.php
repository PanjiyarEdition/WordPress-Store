<?php

$class = 'rt__bookmark';

$class = trim(
	$class . ' ' . rishi__cb_customizer_visibility_classes(
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

$rt_type = rishi__cb_customizer_default_akg( 'header_bookmark_type', $atts, 'bookmark-one' );
$hidden  = rishi__cb_customizer_default_akg( 'header_hide_bookmark', $atts, false );

$icon_class = 'read-it-later added ' . $rt_type;

if( $hidden ) return '';

$visibility = rishi__cb_customizer_default_akg(
	'visibility',
	$atts,
	array(
		'tablet' => true,
		'mobile' => true,
	)
);

$text = rishi__cb_customizer_translate_dynamic(
	rishi__cb_customizer_default_akg( 'header_bookmark_text', $atts, __( 'Bookmark', 'rishi' ) ),
	'header:' . $section_id . ':bookmark:header_bookmark_text'
);

$bookmark_visibility = ' ' . rishi__cb_customizer_visibility_classes(
	rishi__cb_customizer_default_akg(
		'bookmark_visibility',
		$atts,
		array(
			'desktop' => true,
			'tablet'  => true,
			'mobile'  => true,
		)
	)
);

$bookMarkCount = ( isset( $_COOKIE['BookmarkID'] ) ? $_COOKIE['BookmarkID'] : '' );

$bookMarkArr = explode( ',', $bookMarkCount );

$bookMarkValue = array_filter( $bookMarkArr );

$args = [
    'post_type' => 'page',
    'fields' => 'ids',
    'nopaging' => true,
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-bookmark.php'
];
$pages = get_posts( $args );
?>

<div class="<?php echo esc_attr( trim( $class ) ); ?>" <?php echo rishi__cb_customizer_attr_to_html( $attr ); ?>>
	<a href="<?php if( $pages ) echo esc_url( get_permalink( $pages[0] ) ); ?>" class="<?php echo esc_attr( $bookmark_visibility ); ?>">
		<span class="read-it-later-count"><?php echo absint( count( $bookMarkValue ) ); ?></span>
		<span class="read-it-later-hover-text"><?php echo esc_html( $text ); ?></span>
		<span class="<?php echo esc_attr( $icon_class ); ?>"></span>
	</a>
</div>
