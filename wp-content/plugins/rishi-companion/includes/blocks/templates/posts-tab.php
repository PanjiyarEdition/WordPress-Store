<?php
/**
 * Dynamic Blocks rendering.
 *
 * @package Rishi_Companion
 */
wp_enqueue_style( 'rishi-companion-blocks-public' );
$expected_params = array(
	'postsTabRecentLabel'   => __( 'Recent Posts' ),
	'postsTabPopularLabel'  => __( 'Popular Posts' ),
	'postsTabCount'         => 3,
	'postsTabShowThumbnail' => true,
	'tabImageSize'          => 'default',
	'postsTabShowDate'      => true,
);

list( $recent_tab_label, $popular_tab_label, $number_of_posts, $show_thumbnail, $tabImageSize, $show_date ) = rishi_companion_list( array_keys( $expected_params ), array_merge( $expected_params, $attributes ) );

$popular_posts = get_posts(
	array(
		'post_type'      => 'post',
		'meta_key'       => '_rishi_post_view_count',
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC',
		'post_status'    => 'publish',
		'posts_per_page' => $number_of_posts,
	)
);

$recent_posts = get_posts(
	array(
		'post_status'    => 'publish',
		'posts_per_page' => $number_of_posts,
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);

$image_size = ( $tabImageSize == "default" ) ? "thumbnail" : "full" ;
?>
<div class="rishi-posts-tabs">
	<ul class="nav-tabs">
		<li role="presentation" class="active" data-tab="tab-2"><h2 class="section-title"><?php echo esc_html( $recent_tab_label ); ?></h2></li>
		<li role="presentation" data-tab="tab-1" ><h2 class="section-title"><?php echo esc_html( $popular_tab_label ); ?></h2></li>
	</ul>
	<div class="posts-tab-content">
		<div class="grid" id="tab-1" >
		<?php
		if ( isset( $popular_posts[0] ) ) :
			foreach ( $popular_posts as $popular_post ) :
				$post_thumbnail = get_the_post_thumbnail_url( $popular_post, $image_size );
				$post_url       = get_permalink( $popular_post );
				?>
				<div class="tab-content">
					<?php if ( $show_thumbnail ) : ?>
					<a href="<?php echo esc_url( $post_url ); ?>" rel="noopener" class="post-thumbnail <?php echo ! $post_thumbnail ? esc_attr( 'fallback-img' ) : ''; ?>">
						<?php if ( $post_thumbnail ) : ?>
							<img
								class="image-preview"
								src="<?php echo esc_url( $post_thumbnail ); ?>"
							/>
						<?php endif; ?>
					</a>
					<?php endif; ?>
					<div class="widget-entry-header">
						<h3 class="entry-title"><a href="<?php echo esc_url( $post_url ); ?>"><?php echo esc_html( $popular_post->post_title ); ?></a></h3>
						<?php if ( $show_date ) : ?>
						<div class="entry-meta">
							<span class="posted-on">
								<a href="<?php echo esc_url( $post_url ); ?>">
									<time dateTime="<?php echo esc_attr( $popular_post->post_date_gmt ); ?>"><?php echo esc_html( get_the_date( 'F j, Y', $popular_post ) ); ?></time>
								</a>
							</span>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
			endforeach;
		endif;
		?>
		</div>
		<div class="grid active" id="tab-2" >
		<?php
		if ( isset( $recent_posts[0] ) ) :
			foreach ( $recent_posts as $recent_post ) :
				$post_thumbnail = get_the_post_thumbnail_url( $recent_post, $image_size );
				$post_url       = get_permalink( $recent_post );
				?>
				<div class="tab-content">
					<?php if ( $show_thumbnail ) : ?>
					<a href="<?php echo esc_url( $post_url ); ?>" rel="noopener" class="post-thumbnail <?php echo ! $post_thumbnail ? esc_attr( 'fallback-img' ) : ''; ?>">
						<?php if ( $post_thumbnail ) : ?>
							<img
								class="image-preview"
								src="<?php echo esc_url( $post_thumbnail ); ?>"
							/>
						<?php endif; ?>
					</a>
					<?php endif; ?>
					<div class="widget-entry-header">
						<h3 class="entry-title"><a href="<?php echo esc_url( $post_url ); ?>"><?php echo esc_html( $recent_post->post_title ); ?></a></h3>
						<?php if ( $show_date ) : ?>
						<div class="entry-meta">
							<span class="posted-on">
								<a href="<?php echo esc_url( $post_url ); ?>">
									<time dateTime="<?php echo esc_attr( $recent_post->post_date_gmt ); ?>"><?php echo esc_html( get_the_date( 'F j, Y', $recent_post ) ); ?></time>
								</a>
							</span>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php
			endforeach;
		endif;
		?>
		</div>
	</div>
</div>
