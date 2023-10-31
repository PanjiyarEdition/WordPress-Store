<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Rishi
*/

if( ! function_exists( 'rishi_doctype' ) ) :
/**
 * Doctype Declaration
*/
function rishi_doctype(){ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php
}
endif;
add_action( 'rishi_doctype', 'rishi_doctype' );

if( ! function_exists( 'rishi_head' ) ) :
/**
 * Before wp_head 
*/
function rishi_head(){ ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
}
endif;
add_action( 'rishi_before_wp_head', 'rishi_head' );

if( ! function_exists( 'rishi_page_start' ) ) :
/**
 * Page Start
*/
function rishi_page_start(){ ?>
	<div id="main-container" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'rishi' ); ?></a>
	<?php
}
endif;
add_action( 'rishi_before_header', 'rishi_page_start', 20 );

if( ! function_exists( 'rishi_content_start' ) ) :
/**
 * Content Start
*/
function rishi_content_start(){ 
	$defaults = rishi__cb__get_layout_defaults();

	$container_layout = get_theme_mod( 'layout', $defaults['layout'] );
	
	$streched_ed = 'no';

	if( is_page() ){
		$page_layout      = get_theme_mod( 'page_layout', $defaults['page_layout'] );
		$container_layout = ( $page_layout === 'default' ) ? $container_layout : $page_layout;
		$streched_ed      = get_theme_mod( 'page_layout_streched_ed', 'no' );
		$streched_ed      = (rishi__cb_customizer_default_akg(
            'blog_page_streched_ed',
            rishi__cb_customizer_get_post_options(),
            'no'
        ) === 'yes') ? 'no' : $streched_ed;
	}

	if( is_single() ){
		$blog_post_layout = get_theme_mod( 'blog_post_layout', $defaults['blog_post_layout'] );
		$container_layout = ( $blog_post_layout === 'default' ) ? $container_layout : $blog_post_layout;
		$streched_ed      = get_theme_mod( 'blog_post_streched_ed', $defaults['blog_post_streched_ed'] );
		$streched_ed      = (rishi__cb_customizer_default_akg(
            'blog_post_streched_ed',
            rishi__cb_customizer_get_post_options(),
            'no'
        ) === 'yes') ? 'no' : $streched_ed;
	}

	if( is_home() ){
		$blog_container   = get_theme_mod( 'blog_container', $defaults['blog_container'] );
		$container_layout = ( $blog_container === 'default' ) ? $container_layout : $blog_container;
		$streched_ed      = get_theme_mod( 'blog_container_streched_ed', $defaults['blog_container_streched_ed'] );
	}

	if( is_archive() ){
		if( is_author() ){
			$archive_layout   = get_theme_mod( 'author_layout', $defaults['author_layout'] );
			$streched_ed      = get_theme_mod( 'author_layout_streched_ed', $defaults['author_layout_streched_ed'] );
		}else{
			$archive_layout   = get_theme_mod( 'archive_layout', $defaults['archive_layout'] );
			$streched_ed      = get_theme_mod( 'archive_layout_streched_ed', $defaults['archive_layout_streched_ed'] );
		}
		$container_layout = ( $archive_layout === 'default' ) ? $container_layout : $archive_layout;
	}

	if( is_search() ){
		$search_layout   = get_theme_mod( 'search_layout', $defaults['search_layout'] );
		$container_layout = ( $search_layout === 'default' ) ? $container_layout : $search_layout;
		$streched_ed      = get_theme_mod( 'search_layout_streched_ed', $defaults['search_layout_streched_ed'] );
	}

	if( rishi_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( 'product' ) ) ){
		$woocommerce_layout = get_theme_mod( 'woocommerce_layout', $defaults['woocommerce_layout'] );
		$streched_ed        = get_theme_mod( 'woo_layout_streched_ed', $defaults['woo_layout_streched_ed'] );
		$container_layout   = ( $woocommerce_layout === 'default' ) ? $container_layout : $woocommerce_layout;
	}

	$single_content_area_spacing = get_theme_mod( 'single_content_area_spacing', 'both' );
	if( $single_content_area_spacing === 'both'){
		$single_content_area_spacing = 'top:bottom';
	}

	$page_content_area_spacing = get_theme_mod( 'page_content_area_spacing', 'both' );
	if( $page_content_area_spacing === 'both'){
		$page_content_area_spacing = 'top:bottom';
	}
	
	$dataattr = ( $streched_ed == 'yes' ) ? 'data-strech=full' : 'data-strech=none';

	?>
	<?php do_action('rishi:content:before'); 
	$footer_render = new \Rishi_Footer_Builder_Render();
	$footer_atts   = $footer_render->get_current_section()['settings'];

	$has_reveal_effect = rishi__cb_customizer_default_akg(
		'has_reveal_effect',
		$footer_atts,
		array(
			'desktop' => false,
			'tablet'  => false,
			'mobile'  => false,
		)
	);

	$new_arr = array_map( function($_value){
		return 'reveal_none_' . $_value;
	},array_filter( array_keys( $has_reveal_effect ), function( $value ) use ($has_reveal_effect) {
		return empty( $has_reveal_effect[$value] );
	} ) );

	$reveal_class  = join( ' ', $new_arr );

	?>
	<div class="site-content <?php echo esc_attr( $reveal_class ); ?>">
		<?php do_action('rishi:content:top'); ?>
		<?php 
		$page_title = 'yes';
		if( is_archive() ){
			$page_title = get_theme_mod( 'archive_title_panel', 'yes' );
			
			if( is_author() ){
				$page_title = get_theme_mod( 'author_title_panel', 'yes' );
			}
		}
		if( is_search() ){
			$page_title = get_theme_mod( 'search_title_panel', 'yes' );
		}
		if( is_home() ){
			$page_title = get_theme_mod( 'blog_title_panel', 'no' );
		}

		/**
         * @hooked rishi_archive_title_wrapper_start  - 10
         * @hooked rishi_archive_heading 			  - 20
         * @hooked rishi_archive_search_header_count  - 30
         * @hooked rishi_archive_title_wrapper_end    - 40
        */
		if( $page_title === 'yes' ) do_action( 'rishi_site_content_start' ); 
		?>
        <div class="rishi-container" <?php echo esc_attr( $dataattr ); ?>>
			<div class="main-content-wrapper clear" <?php echo rishi__cb_customizer_get_v_spacing(); ?> <?php echo rishi__cb_customizer_get_page_spacing(); ?>>
	<?php
}
endif;
add_action( 'rishi_content', 'rishi_content_start',20 );

if( ! function_exists( 'rishi_navigation' ) ) :
/**
 * Navigation
*/
function rishi_navigation(){
	
	$defaults = rishi__cb__get_layout_defaults();
	$ed_show_post_navigation = get_theme_mod( 'ed_show_post_navigation','yes' );
	$ed_show_portfolio_navigation = get_theme_mod( 'ed_show_portfolio_post_navigation','yes' );
	if( ( is_singular( 'post' ) && $ed_show_post_navigation === 'yes' ) || ( is_singular( 'rishi-portfolio' ) && $ed_show_portfolio_navigation === 'yes' ) && (rishi__cb_customizer_default_akg(
			'disable_posts_navigation',
			rishi__cb_customizer_get_post_options(),
			'no'
		) === 'no') ){

		$next_post = get_next_post();
        $prev_post = get_previous_post();
		
		if( $prev_post || $next_post ){?>   
			<nav class="navigation post-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'rishi' ); ?></h2>
				<div class="post-nav-links nav-links">
					<?php if( $prev_post ){ ?>
						<div class="nav-holder nav-previous">
							<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></a></h2>
							<div class="meta-nav"><a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php esc_html_e( 'Previous', 'rishi' ); ?></a></div>
						</div>
					<?php } if( $next_post ){ ?>
						<div class="nav-holder nav-next">
							<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></a></h2>
							<div class="meta-nav"><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php esc_html_e( 'Next', 'rishi' ); ?></a></div>
						</div>
					<?php } ?>
				</div>
			</nav> 
			<?php
		}
	}else{		
		if( is_archive() ){
			if( is_author() ){
				$pagination = get_theme_mod( 'author_post_navigation', $defaults['author_post_navigation'] );
			}elseif( rishi_is_woocommerce_activated() && is_shop() ){
				$pagination       = get_theme_mod('woo_post_navigation', 'numbered');
			}else{
				$pagination = get_theme_mod( 'archive_post_navigation', $defaults['archive_post_navigation'] );
			}
		}elseif( is_search() ){
			$pagination = get_theme_mod( 'search_post_navigation', $defaults['search_post_navigation'] );
		}else{		
			$pagination = get_theme_mod( 'post_navigation', $defaults['post_navigation'] );
		}

		switch( $pagination ){	
			
			case 'numbered': // Numbered Pagination
			
				echo rishi__cb_customizer_display_posts_pagination( [ 'pagination_type' => 'simple' ] );
			
			break;
			
			case 'infinite_scroll': // Auto Infinite Scroll
			
				echo rishi__cb_customizer_display_posts_pagination( [ 'pagination_type' => 'infinite_scroll' ] );
			
			break;
			
			default:
			
			the_posts_navigation();
			
			break;
		}
	}
}
endif;
add_action( 'rishi_after_posts_content', 'rishi_navigation' );
add_action( 'rishi_after_post_loop', 'rishi_navigation', 10 );

if( ! function_exists( 'rishi_author' ) ) :
/**
 * Rishi Author
 */
function rishi_author(){
	$ed_show_post_author = get_theme_mod( 'ed_show_post_author','yes' );
	$author_box_layout = get_theme_mod( 'author_box_layout','layout-one' );
	$ed_show_portfolio_author = get_theme_mod( 'ed_show_portfolio_author', 'no');

	if (rishi__cb_customizer_default_akg(
		'disable_author_box',
		rishi__cb_customizer_get_post_options(),
		'no'
	) === 'yes') {
		return '';
	}

	if( get_the_author_meta( 'description' ) && ( ( $ed_show_post_author === 'yes' && is_singular( 'post') ) || ( $ed_show_portfolio_author === 'yes' && is_singular( 'rishi-portfolio')  ) ) ){ ?>
		<div class="autor-section <?php echo esc_attr( $author_box_layout ); ?>">
			<div class="author-top-wrap post-author-wrap">
				<div class="img-holder">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?>
				</div>
				<div class="author-content-wrapper">
					<div class="author-meta">
						<?php 
							echo '<h3 class="author-name"><span class="vcard">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</span></h3>';
							echo '<div class="author-description">' . wp_kses_post( get_the_author_meta( 'description' ) ) . '</div>';
						?>
					</div>
					<div class="author-footer">
						<?php
							if( function_exists( 'rishi_companion_multiple_authors_social_profile' ) ){
								rishi_companion_multiple_authors_social_profile( get_the_author_meta( 'ID' ) );
							} 
						?>
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="view-all-auth"><?php esc_html_e( 'View All Articles', 'rishi' ); ?></a>
				
					</div>
				</div>
			</div>
		</div>
		<?php 
	}
}
endif;
add_action( 'rishi_after_post_loop', 'rishi_author', 20 );

if( ! function_exists( 'rishi_related_posts' ) ) :
/**
 * Related Posts 
*/
function rishi_related_posts(){ 
	$defaults = rishi__cb__get_layout_defaults();
	$ed_related_post = get_theme_mod( 'ed_related', $defaults['ed_related'] ); 
	
	if (rishi__cb_customizer_default_akg(
		'disable_related_posts',
		rishi__cb_customizer_get_post_options(),
		'no'
	) === 'yes') {
		return '';
	}

	if( ( $ed_related_post == 'yes' ) && ( 'post' === get_post_type() ) ){
		rishi_get_posts_list();    
	}
}
endif;

if( ! function_exists( 'rishi_comment' ) ) :
/**
 * Comments Template 
*/
function rishi_comment(){
	$defaults             = rishi__cb__get_layout_defaults();
	$ed_single_comment    = get_theme_mod( 'ed_comment', $defaults['ed_comment'] );
	$ed_portfolio_comment = get_theme_mod( 'ed_portfolio_comment', 'no' );
	$ed_page_comment      = get_theme_mod( 'single_page_ed_comment', $defaults['ed_page_comment'] );
	/**
	 * If comments are open or we have at least one comment, load up the comment template.
	 */
	if( ( $ed_single_comment == 'yes' && is_singular('post') ) && ( comments_open() || get_comments_number() ) && (rishi__cb_customizer_default_akg(
		'disable_comments',
		rishi__cb_customizer_get_post_options(),
		'no'
	) === 'no') ) {
		comments_template();
	}

	if( ( $ed_portfolio_comment == 'yes' && is_singular( 'rishi-portfolio') ) && ( comments_open() || get_comments_number() ) && (rishi__cb_customizer_default_akg(
		'disable_comments',
		rishi__cb_customizer_get_post_options(),
		'no'
	) === 'no') ) {
		comments_template();
	}

	if( ( $ed_page_comment == 'yes' && is_page() ) && ( comments_open() || get_comments_number() ) && (rishi__cb_customizer_default_akg(
		'disable_comments',
		rishi__cb_customizer_get_post_options(),
		'no'
	) === 'no') ) {
		comments_template();
	}
}
endif;
add_action( 'rishi_after_page_loop', 'rishi_comment' );

if( ! function_exists( 'rishi_archive_title_wrapper_start' ) ) :
	/**
	 * Content End
	*/
	function rishi_archive_title_wrapper_start(){ 

	$defaults = rishi__cb__get_layout_defaults();

	$container_layout = get_theme_mod( 'layout', $defaults['layout'] );
	
	$streched_ed = 'no';

	if( is_page() ){
		$page_layout      = get_theme_mod( 'page_layout', $defaults['page_layout'] );
		$container_layout = ( $page_layout === 'default' ) ? $container_layout : $page_layout;
		$streched_ed      = get_theme_mod( 'page_layout_streched_ed', 'no' );
	}

	if( is_single() ){
		$blog_post_layout = get_theme_mod( 'blog_post_layout', $defaults['blog_post_layout'] );
		$container_layout = ( $blog_post_layout === 'default' ) ? $container_layout : $blog_post_layout;
		$streched_ed      = get_theme_mod( 'blog_post_streched_ed', $defaults['blog_post_streched_ed'] );
	}

	if( is_home() ){
		$blog_container   = get_theme_mod( 'blog_container', $defaults['blog_container'] );
		$container_layout = ( $blog_container === 'default' ) ? $container_layout : $blog_container;
		$streched_ed      = get_theme_mod( 'blog_container_streched_ed', $defaults['blog_container_streched_ed'] );
	}

	if( is_archive() ){
		if( is_author() ){
			$archive_layout   = get_theme_mod( 'author_layout', $defaults['author_layout'] );
			$streched_ed      = get_theme_mod( 'author_layout_streched_ed', $defaults['author_layout_streched_ed'] );
		}else{
			$archive_layout   = get_theme_mod( 'archive_layout', $defaults['archive_layout'] );
			$streched_ed      = get_theme_mod( 'archive_layout_streched_ed', $defaults['archive_layout_streched_ed'] );
		}
		$container_layout = ( $archive_layout === 'default' ) ? $container_layout : $archive_layout;
	}

	if( is_search() ){
		$search_layout         = get_theme_mod( 'search_layout', $defaults['search_layout'] );
		$container_layout      = ( $search_layout === 'default' ) ? $container_layout : $search_layout;
		$streched_ed           = get_theme_mod( 'search_layout_streched_ed', $defaults['search_layout_streched_ed'] );
	}

	if( rishi_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( 'product' ) ) ){
		$woocommerce_layout = get_theme_mod( 'woocommerce_layout', $defaults['woocommerce_layout'] );
		$streched_ed        = get_theme_mod( 'woo_layout_streched_ed', $defaults['woo_layout_streched_ed'] );
		$container_layout   = ( $woocommerce_layout === 'default' ) ? $container_layout : $woocommerce_layout;
	}

	$single_content_area_spacing = get_theme_mod( 'single_content_area_spacing', 'both' );
	if( $single_content_area_spacing === 'both'){
		$single_content_area_spacing = 'top:bottom';
	}

	$page_content_area_spacing = get_theme_mod( 'page_content_area_spacing', 'both' );
	if( $page_content_area_spacing === 'both'){
		$page_content_area_spacing = 'top:bottom';
	}
	$search_page_alignment = get_theme_mod( 'search_page_alignment', 'left' );
	$dataattr              = ( $streched_ed == 'yes' ) ? 'data-strech=full' : 'data-strech=none';
	$dataalignment         = ( is_search() ) ? 'data-alignment='.$search_page_alignment.'' : ''; 
	
	$breaddefaults            = rishi__cb__get_breadcrumbs_defaults();
	$breadcrumbs_ed_product   = get_theme_mod('breadcrumbs_ed_single_product', $breaddefaults['breadcrumbs_ed_single_product']);
	
	if( !is_singular() || ( rishi_is_woocommerce_activated() && is_singular( 'product' ) && $breadcrumbs_ed_product === 'yes' ) ){
		?>
			<div class="archive-title-wrapper clear" <?php echo esc_attr( $dataalignment ); ?>>
				<div class="rishi-container" <?php echo esc_attr( $dataattr ); ?>>
			<?php 
		}
	}
	endif;
add_action( 'rishi_site_content_start', 'rishi_archive_title_wrapper_start', 10 );

if ( ! function_exists('rishi_get_author_meta_info') ) {
	function rishi_get_author_meta_info() {
	$author_page_label  = get_theme_mod( 'author_page_label',__( 'By','rishi' ) );
	ob_start();
	?>
	<h3 class="author-name">
		<span class="vcard">
			<?php printf( esc_html__( '%1$s %2$s', 'rishi' ) ,esc_html( $author_page_label ), esc_html( get_the_author_meta( 'display_name' ) ) ); ?>    
		</span>
	</h3>
	<?php
	return ob_get_clean();
	}
}

if( ! function_exists( 'rishi_archive_heading' ) ) :
/**
 * Content End
*/
function rishi_archive_heading(){ 
	$ed_prefix        = get_theme_mod( 'archive_page_prefix_ed', 'no' );
	$ed_archive_title = get_theme_mod( 'archive_page_title_ed', 'yes' );
	$ed_archive_desc  = get_theme_mod( 'archive_page_desc_ed', 'yes' );
	$ed_blog_title    = get_theme_mod( 'ed_blog_title', 'yes' );
	$ed_blog_desc     = get_theme_mod( 'ed_blog_desc', 'no' );

	if( ! is_singular() ){
		/**
		 * Rishi After Container Wrap
		*/
		do_action( 'rishi_after_container_wrap' );
	}
	if( rishi_is_woocommerce_activated() && is_shop() ){
		$woo_title_panel = get_theme_mod( 'woo_title_panel','yes' );
		$_name           = wc_get_page_id('shop') ? get_the_title(wc_get_page_id('shop')) : '';
		if (!$_name) {
			$product_post_type = get_post_type_object('product');
			$_name             = $product_post_type->labels->singular_name;
		}
		if( $woo_title_panel == 'yes' ){
		?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
					<h1 class="category-title"><?php echo esc_html( $_name ); ?></h1>
				</div>
			</section>
		<?php 
		}
	}
	
	//works only for single-product 
	if( is_singular( 'product' ) ){
		/**
		 * Rishi After Container Wrap
		*/
		do_action( 'rishi_after_container_wrap' );
	}
	
	if( is_archive() ){
		if( is_category() ){ ?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
					<?php if( $ed_prefix === 'yes' ): ?>
						<span class="tagged-in"><?php echo esc_html__( 'Browsing Category:','rishi' ); ?></span>
					<?php endif; ?>
					<?php
						if( $ed_archive_title === 'yes' ) echo '<h1 class="category-title">'. esc_html( single_cat_title( '', false ) ) .'</h1>';
						if( $ed_archive_desc === 'yes' ) the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</div>
			</section>
			<?php
		}elseif( is_tag() ){
			?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
					<?php if( $ed_prefix === 'yes' ): ?>
						<span class="tagged-in"><?php echo esc_html__( 'Browsing Tag:','rishi' ); ?></span>
					<?php endif; ?>
					<?php
						if( $ed_archive_title === 'yes' ) echo '<h1 class="category-title">'. esc_html( single_tag_title( '', false ) ) .'</h1>';
						if( $ed_archive_desc === 'yes' ) the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</div>
			</section>
			<?php 
		}elseif( is_year() ){
			?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
					<?php if( $ed_prefix === 'yes' ): ?>
						<span class="tagged-in"><?php echo esc_html__( 'Browsing Year:','rishi' ); ?></span>
					<?php endif; ?>
					<?php
						if( $ed_archive_title === 'yes' ) echo '<h1 class="category-title">'. esc_html( get_the_date( _x( 'Y', 'yearly archives date format', 'rishi' ) ) ) .'</h1>';
					?>
				</div>
			</section>
			<?php 
		}elseif( is_month() ){
			?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
					<?php if( $ed_prefix === 'yes' ): ?>
						<span class="tagged-in"><?php echo esc_html__( 'Browsing Month:','rishi' ); ?></span>
					<?php endif; ?>
					<?php
						if( $ed_archive_title === 'yes' ) echo '<h1 class="category-title">'. esc_html( get_the_date( _x( 'F Y', 'monthly archives date format', 'rishi' ) ) ) .'</h1>';
					?>
				</div>
			</section>
			<?php 
		}elseif( is_day() ){
			?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
					<?php if( $ed_prefix === 'yes' ): ?>
						<span class="tagged-in"><?php echo esc_html__( 'Browsing Day:','rishi' ); ?></span>
					<?php endif; ?>
					<?php
						if( $ed_archive_title === 'yes' ) echo '<h1 class="category-title">'. esc_html( get_the_date( _x( 'F j, Y', 'daily archives date format', 'rishi' ) ) ) .'</h1>';
					?>
				</div>
			</section>
			<?php 
		}elseif( is_tax() ){
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
				<?php if( $ed_prefix === 'yes' ): ?>
						<span class="tagged-in"><?php echo esc_html__( 'Browsing ','rishi') . esc_html( $tax->labels->singular_name ); ?></span>
					<?php endif; ?>
					<?php
						if( $ed_archive_title === 'yes' ) echo '<h1 class="category-title">'. esc_html( single_term_title( '', false ) ) .'</h1>';
					?>
				</div>
			</section>
			<?php 
		}
		elseif( is_author() ){
			$author_page_avatar_ed    = get_theme_mod( 'author_page_avatar_ed', 'yes' );
			$author_page_avatar_types = get_theme_mod( 'author_page_avatar_types', 'circle' );
			?>
			<section class="rishi-author-box">
				<div class="autor-section">
					<div class="author-top-wrap">
						<?php
							if( $author_page_avatar_ed === 'yes' ){
								?>
								<div class="img-holder" data-avatar='<?php echo esc_attr( $author_page_avatar_types ); ?>' >
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?>
								</div>
								<?php
							}
							?>
							<div class="author-meta">
								<?php      
									echo rishi_get_author_meta_info(); 
									if( get_the_author_meta( 'description' ) ){
										echo '<div class="author-description">' . wp_kses_post( get_the_author_meta( 'description' ) ) . '</div>';
									}
								?>
								<?php 
									if( function_exists( 'rishi_companion_multiple_authors_social_profile' ) ){
										rishi_companion_multiple_authors_social_profile( get_the_author_meta( 'ID' ) );
									}  
								?>
							</div>
													
					</div>
				</div>
			</section>
			<?php 
		}
	}elseif( is_search() ){
		?>
		<section class="search-result-wrapper">
			<div class="rishi-searchres-inner">
				<?php rishi_search_page_label(); ?>
				<?php get_search_form(); ?>
			</div>
		</section>
		<?php
	}elseif( !is_front_page() && is_home() ){
		?>
		<section class="tagged-in-wrapper">
			<div class="rishi-tagged-inner">
				<?php
					if( $ed_blog_title === 'yes' ) echo '<h1 class="blog-page-title">'. esc_html( single_post_title( '', false ) ) .'</h1>';
					if( $ed_blog_desc === 'yes' ) echo '<div class="blog-page-description">' . wp_kses_post( get_the_content( '', '', get_option( 'page_for_posts' ) ) ) . '</div>';
				?>
			</div>
		</section>
		<?php
	}elseif( is_page_template( 'portfolio.php' ) && rishi_is_pro_activated() ){
		$portfolio_page_title_ed  = get_theme_mod('portfolio_page_title_ed', 'no');
		$portfolio_breadcrumbs_ed = get_theme_mod( 'breadcrumbs_portfolio_page_title', 'no' );
		if( $portfolio_page_title_ed === 'yes' ){
			/**
			 * Rishi After Container Wrap
			 */
			if( $portfolio_breadcrumbs_ed === 'yes' ) do_action('rishi_after_container_wrap'); 
			?>
			<section class="tagged-in-wrapper">
				<div class="rishi-tagged-inner">
					<?php echo '<h1 class="blog-page-title">'. esc_html( single_post_title( '', false ) ) .'</h1>'; ?>
				</div>
			</section>
		<?php }
	}
}
endif;
add_action( 'rishi_site_content_start', 'rishi_archive_heading', 20 );

if( ! function_exists( 'rishi_search_page_label' ) ) :
	/**
	 * Rishi Search label
	*/
	function rishi_search_page_label(){ 
		$search_page_label = get_theme_mod( 'search_page_label',__( 'Search Result for:','rishi' ) );
		?>
			<?php if( $search_page_label ) { ?>
				<h1 class="search-res">
					<?php echo sprintf(__(esc_html( $search_page_label ) . " %s", 'rishi'), esc_html(get_search_query())); ?>
				</h1>
			<?php 
		}
	}
endif;

if( ! function_exists( 'rishi_archive_search_header_count' ) ) :
/**
 * Content End
*/
function rishi_archive_search_header_count(){ 
	if( is_archive() || is_search() || is_author() ){
		rishi_search_post_count();
	}
}
endif;
add_action( 'rishi_site_content_start', 'rishi_archive_search_header_count', 30 );

if( ! function_exists( 'rishi_archive_title_wrapper_end' ) ) :
	/**
	 * Wrapper End
	*/
	function rishi_archive_title_wrapper_end(){
			$breaddefaults            = rishi__cb__get_breadcrumbs_defaults();
			$ed_breadcrumbs_product   = get_theme_mod('breadcrumbs_ed_single_product', $breaddefaults['breadcrumbs_ed_single_product']); 
			if( !is_singular() || ( rishi_is_woocommerce_activated() && is_singular( 'product' )  && $ed_breadcrumbs_product === 'yes' ) ){ ?>
			</div>
		</div>
		<?php 
		}
	}
	endif;
add_action( 'rishi_site_content_start', 'rishi_archive_title_wrapper_end', 40 );

if( ! function_exists( 'rishi_content_end' ) ) :
/**
 * Content End
*/
function rishi_content_end(){
	 ?>            
		</div><!-- .main-content-wrapper -->
	</div><!-- .rishi-container-->
	<?php do_action( 'rishi_site_content_end' ); ?>
	<?php do_action('rishi:content:bottom'); ?>
    </div><!-- .site-content -->
	<?php do_action('rishi:content:after'); ?>
	<?php
}
endif;
add_action( 'rishi_before_footer', 'rishi_content_end', 20 );

if( ! function_exists( 'rishi_footer_end' ) ) :
/**
 * Footer End 
*/
function rishi_footer_end(){ ?>
	</footer><!-- #colophon -->
	<?php
}
endif;
add_action( 'rishi_footer', 'rishi_footer_end', 50 );

if( ! function_exists( 'rishi_page_end' ) ) :
/**
 * Page End
*/
function rishi_page_end(){ ?>
	</div><!-- #page -->
	<?php
}
endif;
add_action( 'rishi_after_footer', 'rishi_page_end', 20 );

if( ! function_exists( 'rishi_scrolltotop' ) ) :
	/**
	 * Scroll To Top
	 */
	function rishi_scrolltotop(){
	$defaults         = rishi__cb__get_layout_defaults();
	$scrolltotop          = get_theme_mod( 'ed_scroll_to_top', $defaults['ed_scroll_to_top'] );
	$top_button_type      = get_theme_mod( 'top_button_type','type-1' );
	$top_button_shape     = get_theme_mod( 'top_button_shape','square' );
	$top_button_alignment = get_theme_mod( 'top_button_alignment','right' );

	$top_button_scroll_style  = get_theme_mod( 'top_button_scroll_style','filled' );
	switch ( $top_button_type ) {

		case 'type-1':
			$svg_image = rishi__cb_customizer_image_picker_file('top-1');
		break;

		case 'type-2':
			$svg_image = rishi__cb_customizer_image_picker_file('top-2');
		break;

		case 'type-3':
			$svg_image = rishi__cb_customizer_image_picker_file('top-3');
		break;

		case 'type-4':
			$svg_image = rishi__cb_customizer_image_picker_file('top-4');
		break;
		
		default:
			$svg_image = '';
		break;
	}

	$atts = [
		'strategy' => 'customizer'
	];

	$back_top_visibility_class = 'to_top ' . rishi__cb_customizer_visibility_classes(
		rishi__cb_get_akv_or_customizer(
			'back_top_visibility',
			$atts,
			[
				'desktop' => true,
				'tablet' => true,
				'mobile' => false,
			]
		)
	);

	if( $scrolltotop == 'yes' ){ ?>
		<div 
			class="<?php echo esc_attr( $back_top_visibility_class ); ?>"
			data-button-type="<?php echo esc_attr( $top_button_type ); ?>"
			data-icon-shape="<?php echo esc_attr( $top_button_shape ) ?>"
			data-button-alignment="<?php echo esc_attr( $top_button_alignment ) ?>" 
			data-scroll-style="<?php echo esc_attr( $top_button_scroll_style ) ?>"
		>
			<?php 
				if( $svg_image ){
					echo '<span class="icon-arrow-up-line">'.$svg_image.'</span>';
				}
			?>
		</div>
		<?php
	}
}
endif;
add_action( 'rishi_after_footer', 'rishi_scrolltotop', 30 );

if( ! function_exists( 'rishi_get_related_post_info' ) ) :
	/**
	 * Related Post Info
	 */
	function rishi_get_related_post_info(){
		$defaults       = rishi__cb__get_layout_defaults();
		$single_title   = get_theme_mod('single_related_title', $defaults['single_related_title']);
		if ($single_title) echo '<h2 class="blog-single-wid-title"><span>' . esc_html($single_title) . '</span></h2>';
	}
endif;

