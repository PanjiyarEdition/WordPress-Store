<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Rishi
 */

get_header();

$image404                    = get_theme_mod( '404_image' );
$show_latest_post            = get_theme_mod( '404_show_latest_post','yes' );
$no_of_posts                 = get_theme_mod( '404_no_of_posts',3 );
$no_of_posts_row             = get_theme_mod( '404_no_of_posts_row',3 );
$show_blog_page_button       = get_theme_mod( '404_show_blog_page_button','yes' );
$show_blog_page_button_label = get_theme_mod( '404_show_blog_page_button_label',__('Go To Blog', 'rishi') );
$blog                        = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : get_home_url();
?>

	<section class="fourofour-main-wrap">
		<div class="four-o-four-inner">
			<div class="four-error-wrap">
			<?php 
				if( $image404 && is_numeric( $image404 ) ){ ?>
					<figure>
						<?php echo wp_get_attachment_image( $image404,'full' ); ?>
					</figure>
				<?php }else{ ?>
					<figure>
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/404-error.png' ); ?>" alt="<?php esc_attr_e( '404 Not Found', 'rishi' ); ?>">
					</figure>
				<?php } ?>
				
				<div class="four-error-content">
					<h2 class="error-title"><?php esc_html_e( '404 Error!', 'rishi' ); ?></h2>
					<h4 class="error-sub-title"><?php esc_html_e( 'OOPS! That page can&#39;t be found.', 'rishi' ); ?></h4>
					<p class="error-desc"><?php esc_html_e( 'The page you are looking for may have been moved, deleted, or possibly never existed.', 'rishi' ); ?></p>
				</div>
			</div>
		</div>
	</section>
	<section class="error-search-again-wrapper">
		<div class="error-search-inner">
			<?php get_search_form(); ?>
		</div>
	</section>
	<main id="primary" class="site-main">
		<?php 
			$args = array(
				'post_type'           => 'post',
				'posts_status'        => 'publish',
				'ignore_sticky_posts' => true,
				'posts_per_page'	  => $no_of_posts,
			);
			$qry = new WP_Query( $args );

			if( $qry->have_posts() && $show_latest_post === 'yes' ){ ?>
				<div class="rishi-container-wrap col-per-<?php echo absint( $no_of_posts_row ); ?>">
					<?php 
						/**
						 * Rishi After Container Wrap
						*/
						do_action( 'rishi_before_container_wrap' );
					?>
					<h2 class="recommended-title"><?php esc_html_e( 'Recommended Articles','rishi' ); ?></h2>
					<div class="posts-wrap">
					<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="blog-post-lay">
								<div class="post-content">
									<div class="entry-content-main-wrap">
										<?php rishi_post_thumbnail(); ?>
										<div class="entry-meta-pri-wrap">
											<div class="entry-meta-sec">
												<?php rishi_categories(); ?>
											</div>
										</div>
										<header class="entry-header">
											<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										</header>
										
									</div>
								</div>
							</div>
						</article>
					<?php } ?>   
					</div>
				     <?php 
					if( $blog && $show_blog_page_button === 'yes' && $show_blog_page_button_label ){ ?>
						<div class="go-to-blog-wrap">
							<a href="<?php echo esc_url( $blog ); ?>" class="go-to-blog"><?php echo esc_html( $show_blog_page_button_label ); ?></a>
						</div>
						<?php 
					}
				 ?>
				</div>
				<?php 
				wp_reset_postdata();
			}
		?>
	</main>
<?php get_footer();