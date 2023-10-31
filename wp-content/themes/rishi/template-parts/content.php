<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rishi
*/

$defaults         = rishi__cb__get_layout_defaults();
$blog_structure   = get_theme_mod( 'archive_blog_post_structure', rishi__cb__get_default_blogpost_structure() );
$blog_page_layout = get_theme_mod( 'blog_page_layout', $defaults['blog_page_layout'] );
$itemprop         = ( rishi_get_schema_type() === 'microdata' ) ? ' itemprop="text"' : '';
$position         = 'First';
$divider_position = 'First';
$ed_bookmark      = rishi_is_bookmark_enabled();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('rt-supports-deeplink'); echo rishi__cb_customizer_schema_org_definitions( 'article' ); ?><?php echo rishi_frontend_deeplink_customizer_preview( 'border-dashed','blogarchive' ); ?>>
	<div class="blog-post-lay">
        <div class="post-content">
			<div class="entry-content-main-wrap">
				<?php do_action('rishi:loop:card:start'); ?>
				<?php 
					if( $blog_page_layout == 'listing' ){
						foreach( $blog_structure as $structure ){
							$img_scale = array_key_exists('featured_image_scale', $structure) ? $structure['featured_image_scale'] : '';
							if( $structure['enabled'] == true && $structure['id'] == 'featured_image' ){
								echo rishi_single_featured_image( 'archive_blog', $structure['featured_image_ratio'], $img_scale, $structure['featured_image_size'], $structure['featured_image_visibility'] );
							}
						}?>
						<div class="list-cont-wrap">			
							<?php
								foreach( $blog_structure as $structure ){								
									if( $structure['enabled'] == true && $structure['id'] == 'custom_meta' ){ 
										rishi_post_meta( $structure['meta_elements'], $structure['meta_divider'], $position );
										$position = 'Second';
									}
									
									if( $structure['enabled'] == true && $structure['id'] == 'custom_title' ){ 
										if( $ed_bookmark ) echo '<div class="rishi-bookmark-wrapper">';
										echo '<' . $structure["heading_tag"] . ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
											the_title();
										echo '</a>';
										rishi_bookmark_settings();
										echo '</' . $structure["heading_tag"] . '>';
										if( $ed_bookmark ) echo '</div>';
									}

									if( $structure['enabled'] == true && $structure['id'] == 'excerpt'  ){ 
										if ( ( has_excerpt() && $structure['post_content'] === 'excerpt' ) || get_the_content() ){ ?>
											<div class="entry-content-wrap clear"<?php echo $itemprop; ?>>
												<?php
													if( $structure['post_content'] === 'excerpt' ){
														the_excerpt();
													}else{
														the_content(
															sprintf(
																wp_kses(
																	/* translators: %s: Name of current post. Only visible to screen readers */
																	__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rishi' ),
																	array(
																		'span' => array(
																			'class' => array(),
																		),
																	)
																),
																wp_kses_post( get_the_title() )
															)
														);
															
														wp_link_pages(
															array(
																'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rishi' ),
																'after'  => '</div>',
															)
														);
													}
												?>
											</div><!-- .entry-content -->
											<?php
										}
									}
		
									if( $structure['enabled'] == true && $structure['id'] == 'divider'  ){ 
										echo '<span class="blank-space" data-position="' . esc_attr( $divider_position ) . '"></span>';
                                        $divider_position = 'Second';
									}
		
									if( $structure['enabled'] == true && $structure['id'] == 'read_more' ){								
										rishi_entry_footer( $structure );
									}
								}
							?>
						</div><!-- .list-cont-wrap -->
						<?php
					}else{ 	
						foreach( $blog_structure as $structure ){
							$img_scale = array_key_exists('featured_image_scale', $structure) ? $structure['featured_image_scale'] : '';
							if( $structure['enabled'] == true && $structure['id'] == 'featured_image' ){
								echo rishi_single_featured_image( 'archive_blog', $structure['featured_image_ratio'],$img_scale, $structure['featured_image_size'], $structure['featured_image_visibility'] );
							}

							if( $structure['enabled'] == true && $structure['id'] == 'custom_meta' ){ 
								rishi_post_meta( $structure['meta_elements'], $structure['meta_divider'], $position );
								$position = 'Second';
							}
							
							if( $structure['enabled'] == true && $structure['id'] == 'custom_title' ){ 
								if( $ed_bookmark ) echo '<div class="rishi-bookmark-wrapper">';
									echo '<' . $structure["heading_tag"] . ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
										the_title();
									echo '</a>';
									rishi_bookmark_settings();
									echo '</' . $structure["heading_tag"] . '>';
								if( $ed_bookmark ) echo '</div>';
							}

							if( $structure['enabled'] == true && $structure['id'] == 'excerpt'  ){ 
								if ( ( has_excerpt() && $structure['post_content'] === 'excerpt' ) || get_the_content() ){ ?>
									<div class="entry-content-wrap clear"<?php echo $itemprop; ?>>
										<?php
											if( $structure['post_content'] === 'excerpt' ){
												the_excerpt();
											}else{
												the_content(
													sprintf(
														wp_kses(
															/* translators: %s: Name of current post. Only visible to screen readers */
															__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'rishi' ),
															array(
																'span' => array(
																	'class' => array(),
																),
															)
														),
														wp_kses_post( get_the_title() )
													)
												);
													
												wp_link_pages(
													array(
														'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rishi' ),
														'after'  => '</div>',
													)
												);
											}
										?>
									</div><!-- .entry-content -->
									<?php
								}
							}

							if( $structure['enabled'] == true && $structure['id'] == 'divider'  ){
								echo '<span class="blank-space" data-position="' . esc_attr( $divider_position ) . '"></span>';
                                $divider_position = 'Second';
							}

							if( $structure['enabled'] == true && $structure['id'] == 'read_more' ){								
								rishi_entry_footer( $structure );
							}
						}
					}
				?>
				<?php do_action('rishi:loop:card:end'); ?>
			</div><!-- .entry-content-main-wrap -->
		</div><!-- .post-content -->
	</div><!-- .blog-post-lay -->
</article><!-- #post-## -->