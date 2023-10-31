<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rishi
 */

$defaults              = rishi__cb__get_layout_defaults();
$archive_page_layout   = get_theme_mod( 'archive_page_layout', $defaults['archive_page_layout'] );
$archive_posts_per_row = get_theme_mod( 'archive_posts_per_row', $defaults['archive_posts_per_row'] );

if( is_author() ){
	$archive_page_layout   = get_theme_mod( 'author_page_layout', $defaults['author_page_layout'] );
	$archive_posts_per_row = get_theme_mod( 'author_posts_per_row', $defaults['author_posts_per_row'] );		
}

$data_attr = ( $archive_page_layout == 'grid' || $archive_page_layout == 'masonry_grid' ) ? ' data-row-per-col="' . $archive_posts_per_row . '"' : '';

get_header();

	/**
	 * Before Posts hook
	*/
	do_action( 'rishi_before_primary_content' ); ?>

	<main id="primary" class="site-main">
		<?php 
			/**
			 * Before Posts hook
			*/
			do_action( 'rishi_before_posts_content' );
        ?>

		<div class="rishi-container-wrap <?php echo ( $archive_page_layout == 'masonry_grid' ) ? esc_attr( $archive_page_layout ) : ''; ?>"<?php echo $data_attr; ?>>
			<?php 
				/**
				 * Rishi After Container Wrap
				*/
				do_action( 'rishi_before_container_wrap' );
			
				if ( have_posts() ) : 
				
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
						get_template_part( 'template-parts/content', 'archive' );

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