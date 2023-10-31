<?php
/**
 * Dynamic Blocks rendering.
 *
 * @package Rishi_Companion
 */
$expected_params = array(
	'categoriesLabel'   => __( 'Categories' ),
	'layoutStyle'       => 'layout-type-1',
	'showPostCount'     => true,
	'category_selected' => array(),
	'backgroundColor'   => 'palette-color-1',
	'textColor'         => 'palette-color-5',
);

$data = rishi_companion_list( array_keys( $expected_params ), array_merge( $expected_params, $attributes ) );

list( $label, $style, $show_post_count, $category_selected, $background_color, $color ) = $data;

$args = '';

if ( ! empty( $category_selected ) ) {
	$args            = array(
		'hide_empty' => false,
	);
	$args['include'] = array_map(
		function( $selected ) {
			return $selected['value'];
		},
		$category_selected
	);
}
$_categories = get_categories( $args );

$style = isset( $style['value'] ) ? $style['value'] : $style;

$category_classes = array(
	'category-post-count',
	"has-{$background_color}-background-color",
	"has-{$color}-color",
	'has-text-color',
	'has-background',
);
?>
<section id="rishi_categories" class="rishi_sidebar_widget_categories">
	<?php
	! empty( $label ) && printf( '<h2 class="widget-title" itemProp="name"><span>%s</span></h2>', esc_html( $label ) );
	if ( isset( $_categories[0] ) || count( $_categories ) > 0 ) {
		printf( '<ul class="%s">', esc_attr( $style ) );
		foreach ( $_categories as $_category ) {
			$image_id = get_term_meta($_category->term_id, 'category-image-id');
			$image_cat = $image_id[0] ? 'background-image: url('.esc_url( wp_get_attachment_url($image_id[0]) ).');' : '';

			printf(
				'<li><a href="%1$s" class="fallback-img" style="%2$s">',
				esc_url( get_category_link( $_category->term_id ) ), $image_cat 
			);

			// For Layout 1.
			'layout-type-1' === $style && printf(
				'<span class="category-name">%1$s</span>%2$s',
				esc_html( $_category->name ),
				$show_post_count && $_category->count ? sprintf(
					'<span class="category-post-count rishi_sidebar_widget_categories ul li %2$s" style="categoryStyle">%1$s</span>',
					sprintf( _n( '%d Post', '%d Posts', (int) $_category->count ), (int) $_category->count ),
					esc_attr( implode( ' ', $category_classes ) )
				) : ''
			);

			// For Layout 2.
			'layout-type-2' === $style && printf(
				'<div class="category-content"><span class="category-name">%1$s</span>%2$s</div>',
				esc_html( $_category->name ),
				$show_post_count && $_category->count ? sprintf(
					'<span class="category-post-count rishi_sidebar_widget_categories ul li %2$s" style="categoryStyle">%1$s</span>',
					sprintf( _n( '%d Post', '%d Posts', (int) $_category->count ), (int) $_category->count ),
					esc_attr( implode( ' ', $category_classes ) )
				) : ''
			);
			echo '</a></li>';
		}
		echo '</ul>';
	}
	?>
</section>
