<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rishi
*/
$prefix = 'single_page_';

$itemprop = ( rishi_get_schema_type() === 'microdata' ) ? ' itemprop="text"' : ''; 
$page_title_panel = get_theme_mod( 'page_title_panel', 'yes' );
$featured_image_visibility = get_theme_mod( 'single_page_featured_image_visibility',[
	'desktop' => true,
	'tablet'  => true,
	'mobile'  => true,
] );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); echo rishi__cb_customizer_schema_org_definitions( 'article' ); ?>>
	<?php do_action('rishi:title:section:before'); ?>
	<?php if( $page_title_panel === 'yes' && ( rishi__cb_customizer_default_akg(
			'page_title_hero_section',
			rishi__cb_customizer_get_post_options(),
			'default'
		) !== 'disabled' ) ) : ?>
		<header class="entry-header">
			<?php 
				do_action('rishi:title:before');
					echo '<h1 class="entry-title">';
						the_title();
					echo '</h1>';
				do_action('rishi:title:after'); 
			?>
		</header><!-- .entry-header -->
	<?php endif; ?>
	<?php do_action('rishi:title:section:after'); ?>

	<?php 
		echo rishi_single_featured_image( 'single_page',NULL,NULL,NULL,$featured_image_visibility );
	?>

	<div class="entry-content"<?php echo $itemprop; ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rishi' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'rishi' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
