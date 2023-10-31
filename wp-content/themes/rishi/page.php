<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rishi
 */

get_header(); ?>

	<main id="primary" class="site-main">
		<?php if( rishi_is_woocommerce_activated() && is_cart() ) echo '<div class="wholewrapper">'; ?>
			<div class="rishi-container-wrap">
				<?php 
					/**
					 * Rishi After Container Wrap
					*/
					do_action( 'rishi_after_container_wrap' );
				
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );					

					endwhile; // End of the loop.

					/**
					 * After post loop
					*/
					do_action( 'rishi_after_page_loop' );
				?>
			</div>
		<?php if( rishi_is_woocommerce_activated() && is_cart() ) echo '</div>'; ?>
	</main><!-- #main -->
<?php
get_sidebar();
get_footer();
