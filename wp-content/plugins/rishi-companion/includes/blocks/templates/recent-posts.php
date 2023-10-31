<?php
/**
 * Dynamic Blocks rendering.
 *
 * @package Rishi_Companion
 */
wp_enqueue_style( 'rishi-companion-blocks-public' );
$expected_params = array(
	'recentPostLabel'         => __( 'Recent Posts' ),
	'recentPostCount'         => 3,
	'layoutStyle'             => 'layout-type-1',
	'openInNewTab'            => false,
	'recentPostShowThumbnail' => true,
	'recentImageSize'         => 'default',
	'recentPostShowDate'      => true,
);

$data = rishi_companion_list( array_keys( $expected_params ), array_merge( $expected_params, $attributes ) );

list( $label, $post_count, $style, $new_tab, $show_thumbnail, $recentImageSize, $show_post_date ) = $data;

$query_args = array(
	'orderby' => 'date',
	'order'   => 'DESC',
);

$query_args['post_type']      = 'post';
$query_args['post_status']    = 'publish';
$query_args['posts_per_page'] = $post_count;

$posts_query = get_posts( $query_args );

if( $recentImageSize == "full_size" ){
	$image_size = 'full';
}else{
	$image_size = ( $style == 'layout-type-1' ) ? "thumbnail" : "large" ;
}
?>
<section class="rishi_sidebar_widget_recent_post">
	<?php if ( $label ) { ?>
		<h2 class="widget-title" itemProp="name"><span><?php echo esc_html( $label ); ?></span></h2>
	<?php } ?>
	<?php if ( isset( $posts_query[0] ) ) { ?>
		<ul class="<?php echo esc_attr( $style ); ?>">
		<?php
		foreach ( $posts_query as $_post ) :
			$thumbnail_url = get_the_post_thumbnail_url( $_post, $image_size );
			$post_title    = get_the_title( $_post );
			$post_content  = get_the_content( null, false, $_post );
			$author        = get_the_author_meta( 'display_name', $_post->post_author );
			$post_link     = get_permalink( $_post );
			$post_date     = get_the_date( '', $_post );
			$post_views    = (int) get_post_meta( $_post->ID, '_rishi_post_view_count', true );
			$comment_count = (int) $_post->comment_count;
			$categories    = get_the_category( $_post->ID );
			?>
			<li>
				<?php
				$show_thumbnail && printf(
					'<a target="%1$s" rel="noopener" href="%2$s" class="post-thumbnail %3$s">%4$s</a>',
					$new_tab ? '_blank' : '_self',
					esc_url( $post_link ),
					$thumbnail_url ? '' : 'fallback-img',
					$thumbnail_url ? sprintf( '<img class="image-preview" src="%s" />', esc_url( $thumbnail_url ) ) : ''
				);
				?>
				<div class="widget-entry-header">
					<?php
					isset( $categories[0] ) && printf(
						'<span class="cat-links">%s</span>',
						array_reduce(
							$categories,
							function( $carry, $_category ) use ( $new_tab ) {
								return $carry .= sprintf(
									'<a target="%1$s" rel="noopener" href="%2$s">%3$s</a>',
									$new_tab ? '_blank' : '_self',
									esc_url( get_category_link( $_category->term_id ) ),
									esc_html( $_category->name )
								);
							},
							''
						)
					);

					printf(
						'<h3 class="entry-title"><a target="%1$s" rel="noopener" href="%2$s">%3$s</a></h3>',
						$new_tab ? '_blank' : '_self',
						esc_url( $post_link ),
						esc_html( $post_title )
					);
					?>
					<div class="entry-meta">
						<?php
						// Datetime.
						$show_post_date && printf(
							'<span class="posted-on">
								<a target="%1$s" href="%2$s" rel="noopener">
									<time dateTime="%3$s">%4$s</time>
								</a>
							</span>',
							$new_tab ? '_blank' : '_self',
							esc_url( esc_url( $post_link ) ),
							esc_html( get_the_date( $_post->post_date ) ),
							esc_html( get_the_date( 'F j, Y', $_post ) ),
						);
						?>
					</div>
				</div>
			</li>
		<?php endforeach; ?>
		</ul>
	<?php } ?>
</section>
