<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rishi
 */

$defaults           = rishi__cb__get_layout_defaults();
$blog_page_layout   = get_theme_mod( 'blog_page_layout', $defaults['blog_page_layout'] );
$blog_posts_per_row = get_theme_mod( 'blog_posts_per_row', $defaults['blog_posts_per_row'] );
$data_attr          = ( $blog_page_layout == 'grid' || $blog_page_layout == 'masonry_grid' ) ? ' data-row-per-col="' .$blog_posts_per_row . '"' : '';
$page_title 		= get_theme_mod( 'blog_title_panel', 'no' );

get_header(); ?>

	<main id="primary" class="site-main">
		<?php 
			/**
			 * Before Posts hook
			*/
			do_action( 'rishi_before_posts_content' );
        ?>

		<div class="rishi-container-wrap <?php echo ( $blog_page_layout == 'masonry_grid' ) ? esc_attr( $blog_page_layout ) : ''; ?>"<?php echo $data_attr; ?>>
			<?php 
				/**
				 * Rishi After Container Wrap
				*/
				do_action( 'rishi_before_container_wrap' );
			
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() && $page_title === 'no' ) :
						?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;

					/**
					 * Before Loop Hook
					*/
					do_action( 'rishi_before_loop' );

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					/**
					 * After Loop Hook
					*/
					do_action( 'rishi_after_loop' );

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
			?>
		</div>

		<?php
			/**
			 * After Posts hook
			 * 
			 * @hooked rishi_navigation - 10
			*/
			do_action( 'rishi_after_posts_content' );
        ?>	

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
