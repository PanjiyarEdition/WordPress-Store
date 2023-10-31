<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rishi
 */

if (!function_exists('rishi_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function rishi_posted_on( $meta ){
		$date_format = ( $meta['date_format_source'] == 'custom' ) ? $meta['date_format'] : '';
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';
		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date( $date_format )),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date( $date_format ))
		);
		echo '<span class="posted-on meta-common">' . $time_string . '</span>';
	}
endif;

if (!function_exists('rishi_updated_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function rishi_updated_on( $meta ){
		$date_format = ( $meta['date_format_source'] == 'custom' ) ? $meta['date_format'] : '';		
		$updated_on = $meta['label'] ? '<span class="poson">' . esc_html( $meta['label'] ) . '</span>' : '';

		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time><time class="updated" datetime="%3$s" itemprop="dateModified">%4$s</time>';		

		if( get_the_time('U') !== get_the_modified_time('U') ){
			$time_string = '<time class="entry-date published updated" datetime="%3$s" itemprop="dateModified">%4$s</time><time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		}
		
		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date( $date_format )),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date( $date_format ))
		);

		$posted_on = sprintf( '%1$s %2$s', $updated_on, $time_string );

		echo '<span class="posted-on meta-common">' . $posted_on . '</span>';
	}
endif;

if (!function_exists('rishi_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function rishi_posted_by( $meta ){
		$enable_schema_org_markup = get_theme_mod( 'enable_schema_org_markup','yes' );
		if( $enable_schema_org_markup === 'yes' ){
			$class = " url fn n";
		}else{
			$class= "url-fn-n";
		}
		$avatar = ( $meta['has_author_avatar'] == 'yes' ) ? get_avatar( get_the_author_meta('ID'), $meta['avatar_size'] ) : '';		
		$byline = esc_html( $meta['label'] ) . '<span class="author vcard"><a class='. esc_attr( $class ) .' href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url"><span itemprop="name">' . esc_html( get_the_author() ) . '</span></a></span>'; ?>
		<span class="posted-by author vcard meta-common" <?php echo rishi__cb_customizer_schema_org_definitions('person'); ?>>
			<?php echo $avatar . $byline; ?>
		</span>
		<?php
	}
endif;

if (!function_exists('rishi_categories')) :
	/**
	 * Post Category
	 */
	function rishi_categories()
	{
		if ('post' === get_post_type()) {
			$categories_list = get_the_category_list(' ');
			if ($categories_list) {
				echo '<div class="entry-meta-pri"><span class="cat-links meta-common">' . $categories_list . '</span></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if (!function_exists('rishi_category')) :
	/**
	 * Rishi Category
	 *
	 * @param string $post_type
	 * @param [type] $meta
	 * @return HTML
	 */
	function rishi_category( $meta ){
		$enable_schema_org_markup = get_theme_mod( 'enable_schema_org_markup','yes' );
		if ('post' === get_post_type()) {
			$categories_lists = get_the_category();
			if( $categories_lists ){
				?>
				<span class="cat-links meta-common" data-cat-single="<?php echo esc_attr( $meta['divider'] ); ?>" data-cat-style="<?php echo esc_attr( $meta['divider_style'] ); ?>">
					<?php foreach( $categories_lists as $term ){ 
						$color_hex = ( get_term_meta ( $term->term_id, 'rc-uploader', true ) ) ? get_term_meta ( $term->term_id, 'rc-uploader', true ) : '#307ac9';
						$textcolor = ( get_term_meta ( $term->term_id, 'rc-text-uploader', true ) ) ? get_term_meta ( $term->term_id, 'rc-text-uploader', true ) : '#ffffff';
						if( $meta['divider_style'] == 'custom' && $color_hex && $textcolor ){
							$style = 'style="background:' . esc_attr( $color_hex ) . ';color:'.esc_attr( $textcolor ).'"';
						}else{
							$style = '';
						}
						?>
						<a 
						<?php echo $style; ?> 
						href="<?php if( isset( $term->term_taxonomy_id ) ) echo esc_url( get_term_link( $term->term_taxonomy_id ) ); ?>" 
						rel="category<?php if( $enable_schema_org_markup == 'yes' ) echo esc_attr( ' tag' ); ?>">
							<?php if( isset( $term->name ) ) echo esc_html( $term->name ); ?>
						</a>
					<?php } ?>
				</span>
				<?php 
			}
		}elseif( 'rishi-portfolio' === get_post_type() ){
			$categories_lists = get_the_terms( get_the_ID(), 'rishi-portfolio-categories' );
			if( $categories_lists && ! is_wp_error( $categories_lists ) ){ ?>
				<span class="cat-links meta-common" data-cat-single="<?php echo esc_attr( $meta['divider'] ); ?>">
					<?php foreach( $categories_lists as $term ){  ?>
						<a 
							href="<?php if( isset( $term->term_taxonomy_id ) ) echo esc_url( get_term_link( $term->term_taxonomy_id ) ); ?>" 
							rel="category<?php if( $enable_schema_org_markup == 'yes' ) echo esc_attr( ' tag' ); ?>">
							<?php if( isset( $term->name ) ) echo esc_html( $term->name ); ?>
						</a>
					<?php } ?>
				</span>
				<?php
			}
		}
	}
endif;


if (!function_exists('rishi_tags')) :
	/**
	 * Post Category
	 */
	function rishi_tags()
	{
		if ('post' === get_post_type()) {
			$tags_list = get_the_tag_list('', ' ');
			if ($tags_list) {
				echo '<span class="tags-links">' . '<span class="tagtext">' . esc_html__('Tagged In', 'rishi') . '</span>' . $tags_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if( ! function_exists( 'rishi_estimated_reading_time' ) ) :
	/** 
	 * Reading Time Calculate Function 
	*/
	function rishi_estimated_reading_time( $meta,$content ) {
			$wpm           = isset( $meta['post_reading_time'] ) ? $meta['post_reading_time'] : 200;
			$clean_content = strip_shortcodes( $content );
			$clean_content = strip_tags( $clean_content );
			$word_count    = str_word_count( $clean_content );
			$time          = ceil( $word_count / $wpm );
			echo '<span class="post-read-time meta-common">' . absint( $time ) . esc_html__( ' min read', 'rishi' ) . '</span>';
	}
	endif;

if (!function_exists('rishi_comment_link')) :
	/**
	 * Comments
	 */
	function rishi_comment_link()
	{
		if (!post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comment-link-wrap meta-common">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Write a Comment<span class="screen-reader-text"> on %s</span>', 'rishi'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
			echo '</span>';
		}
	}
endif;

if( ! function_exists( 'rishi_post_meta' ) ) :
	function rishi_post_meta( $metas, $divider, $position = false ){
        $data_position = $position ? ' data-position="' . esc_attr( $position ) . '"' : '';
		if( $metas ){ ?>
			<div class="post-meta-wrapper">
				<div class="post-meta-inner" data-meta-divider="<?php echo esc_attr( $divider ); ?>"<?php echo $data_position; ?>>
					<?php
						foreach( $metas as $meta ){
							if( $meta['enabled'] == true && $meta['id'] == 'author' ) rishi_posted_by( $meta );
							if( $meta['enabled'] == true && $meta['id'] == 'post_date' ) rishi_posted_on( $meta );
							if( $meta['enabled'] == true && $meta['id'] == 'updated_date' ) rishi_updated_on( $meta );
							if( $meta['enabled'] == true && $meta['id'] == 'comments' ) rishi_comment_link();
							if( $meta['enabled'] == true && $meta['id'] == 'categories' ) rishi_category( $meta );
							if( $meta['enabled'] == true && $meta['id'] == 'reading_time' ) rishi_estimated_reading_time( $meta,get_post( get_the_ID() )->post_content );
							if( class_exists('Rishi\Rishi_Pro') && function_exists('rishi_multiple_authors') && $meta['enabled'] == true && $meta['id'] == 'multiple_authors' ) rishi_multiple_authors( $meta, get_the_ID() );
						}					
					?>
				</div>
			</div>
			<?php			
		}
	}
endif;

if (!function_exists('rishi_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function rishi_entry_footer( $meta ) { ?>
		<footer class="entry-footer rishi-flex">
			<?php 
				$arrow = ( $meta['read_more_arrow'] == 'yes' ) ? 'yes' : 'no';
				$class = ( $meta['button_type'] == 'button' ) ? ' button-style' : '';
				if( $meta['read_more_text'] ) echo '<div class="readmore-btn-wrap"><a href="' . esc_url(get_the_permalink()) . '" class="btn-readmore' . esc_attr( $class ) . '" data-arrow="' . esc_attr( $arrow ) . '">' . esc_html( $meta['read_more_text'] ) . '</a></div>';
			?>
		</footer><!-- .entry-footer -->
		<?php
	}
endif;

if (!function_exists('rishi_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function rishi_post_thumbnail($wrapper = true, $layout = false){

		if (post_password_required() || is_attachment()) {
			return;
		}

		$sidebar    = rishi_sidebar();
		$image_size = $sidebar ? 'rishi-withsidebar' : 'rishi-fullwidth';

		if (is_singular()) {
			if (has_post_thumbnail()) {
				if ($wrapper) echo '<div class="post-thumb"><div class="post-thumb-inner-wrap">'; ?>
				<div class="post-thumbnail"><?php the_post_thumbnail($image_size, 'itemprop=image'); ?></div><!-- .post-thumbnail -->
			<?php
				if ($wrapper) echo '</div><!-- .post-thumb-inner-wrap --></div><!-- .post-thumb -->';
			}
		} elseif (is_404()) {
			if (has_post_thumbnail()) {
				if ($wrapper) echo '<div class="post-thumb"><div class="post-thumb-inner-wrap">'; ?>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('rishi-withsidebar'); ?></a>
				<?php
				if ($wrapper) echo '</div><!-- .post-thumb-inner-wrap --></div><!-- .post-thumb -->';
			}
		} else {
			if (is_search() || ((is_archive() || is_home()) && $layout == 'classic')) {
				if (has_post_thumbnail()) {
					if ($wrapper) echo '<div class="post-thumb"><div class="post-thumb-inner-wrap">'; ?>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>">
						<?php
						the_post_thumbnail(
							$image_size,
							array(
								'alt' => the_title_attribute(
									array(
										'echo' => false,
									)
								),
							)
						);
						?>
					</a>
				<?php
					if ($wrapper) echo '</div><!-- .post-thumb-inner-wrap --></div><!-- .post-thumb -->';
				}
			} else {
				if ($layout == 'listing') $image_size = 'rishi-blog-grid';
				if ($layout == 'grid' || $layout == 'masonry_grid') $image_size = 'rishi-blog-grid';
				if ($wrapper) echo '<div class="post-thumb"><div class="post-thumb-inner-wrap">'; ?>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
					<?php
					if (has_post_thumbnail()) {
						the_post_thumbnail(
							$image_size,
							array(
								'alt' => the_title_attribute(
									array(
										'echo' => false,
									)
								),
								'itemprop' => 'image'
							)
						);
					} else {
						rishi_get_fallback_svg($image_size);
					}
					?>
				</a>
			<?php
				if ($wrapper) echo '</div><!-- .post-thumb-inner-wrap --></div><!-- .post-thumb -->';
			}
		}
	}
endif;

if ( ! function_exists( 'rishi_single_featured_image' ) ) :

	/**
	 * Featured image helper render.
	 *
	 * @return void
	 */
	function rishi_single_featured_image( $prefix, $featured_image_ratio = NULL,$featured_image_scale = NULL, $featured_image_size = NULL, $featured_image_visibility = NULL ) {
	
		$featured_image_source = [
			'prefix' => $prefix,
			'strategy' => 'customizer'
		];


		if ( ! $featured_image_visibility ) {
			$featured_image_visibility = [
				'desktop' => true,
				'tablet'  => true,
				'mobile'  => true
			];
		}

		if ( ! $featured_image_ratio ) {
			$featured_image_ratio = rishi__cb_get_akv_or_customizer(
				'featured_image_ratio',
				$featured_image_source,
				'original'
			);
		}

		if ( ! $featured_image_scale ) {
			$featured_image_scale = rishi__cb_get_akv_or_customizer(
				'featured_image_scale',
				$featured_image_source,
				'contain'
			);
		}

		if ( ! $featured_image_size ) {
			$featured_image_size = rishi__cb_get_akv_or_customizer(
				'featured_image_size',
				$featured_image_source,
				'original'
			);
		}

		if (rishi__cb_get_akv_or_customizer(
			'has_featured_image',
			$featured_image_source,
			'yes'
		) === 'no') {
			return '';
		}

		if (! has_post_thumbnail()) {
			return '';
		}

		if (rishi__cb_customizer_default_akg(
			'disable_featured_image',
			rishi__cb_customizer_get_post_options(),
			'no'
		) === 'yes') {
			return '';
		}

		$class = 'rt-featured-image';

		$class .= ' ' . rishi__cb_customizer_visibility_classes(
			$featured_image_visibility
		);

		if( $featured_image_ratio == 'original' && is_singular( [ 'post', 'page'] ) ){
			$class .= $featured_image_ratio . '-ratio';
		}

		if( $featured_image_ratio == 'original' && $featured_image_scale ){
			$class .= ' image-' . $featured_image_scale;
		}

		$maybe_figcaption = wp_get_attachment_caption(get_post_thumbnail_id());
		/**
		 * Featured Image Caption theme mods
		 */
		$ed_single_post_caption = get_theme_mod(
			'ed_single_post_caption',
			'no'
		);

		$featured_image_caption_layout = get_theme_mod(
			'featured_image_caption_layout',
			'layout-1'
		);

		$featured_image_caption_alignment = get_theme_mod(
			'featured_image_caption_alignment',
			'left'
		);

		if( !empty( $maybe_figcaption ) ){
			if ( $ed_single_post_caption === 'no'  ) {
				$maybe_figcaption = '<figcaption class="screen-reader-text">' . trim($maybe_figcaption) . '</figcaption>';
			} else {
				$maybe_figcaption = '<figcaption class="rt-caption-wrap" data-layout="' . esc_attr( $featured_image_caption_layout ) . '" data-alignment="' . esc_attr( $featured_image_caption_alignment ) . '">' . trim($maybe_figcaption) . '</figcaption>';
			}
		}else{
			$maybe_figcaption = '';
		}   

		return rishi__cb_html_tag('figure', ['class' => $class], rishi__cb_customizer_image([
			'attachment_id' => get_post_thumbnail_id(),
			'ratio' => $featured_image_ratio,
			'size' => $featured_image_size
		]) . $maybe_figcaption);
	}

endif;

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;

if (!function_exists('rishi_get_schema_type')) :
	/**
	 * Schema Type
	 */
	function rishi_get_schema_type()
	{
		return apply_filters('rishi_schema_type', 'microdata');
	}
endif;

if (!function_exists('rishi_comment_callback')) :
	/**
	 * Callback function for Comment List *
	 * 
	 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
	 */
	function rishi_comment_callback($comment, $args, $depth)
	{
		if ('div' == $args['style']) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		} ?>
		<<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

		<?php if ('div' != $args['style']) : ?>
			<article id="div-comment-<?php comment_ID() ?>" class="comment-body" <?php echo rishi__cb_customizer_schema_org_definitions('comment-body'); ?>>
			<?php endif; ?>

			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size'] ); ?>
				</div><!-- .comment-author vcard -->
			</footer>

			<div class="text-holder">
				<div class="top">
					<div class="left">
						<?php if ($comment->comment_approved == '0') : ?>
							<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'rishi'); ?></em>
							<br />
						<?php endif; ?>
						<b class="fn" <?php echo rishi__cb_customizer_schema_org_definitions('comment-author'); ?>><?php echo get_comment_author_link(); ?></b><span class="says"><?php esc_html_e('says:', 'rishi'); ?></span>
						<div class="comment-metadata commentmetadata">
							<a href="<?php echo esc_url(htmlspecialchars(get_comment_link($comment->comment_ID))); ?>">
								<time itemprop="commentTime" datetime="<?php echo esc_attr(get_gmt_from_date(get_comment_date() . get_comment_time(), 'Y-m-d H:i:s')); ?>"><?php printf(esc_html__('%1$s at %2$s', 'rishi'), get_comment_date(),  get_comment_time()); ?></time>
							</a>
						</div>
					</div>
				</div>
				<div class="comment-content" itemprop="commentText"><?php comment_text(); ?></div>
				<div class="reply">
					<?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
			</div><!-- .text-holder -->

			<?php if ('div' != $args['style']) : ?>
			</article><!-- .comment-body -->
		<?php endif;
	}
endif;

if (!function_exists('rishi_breadcrumb')) :
	/**
	 * Breadcrumbs
	 */
	function rishi_breadcrumb(){
		global $post;
		$defaults   = rishi__cb__get_breadcrumbs_defaults();
		$post_page  = get_option('page_for_posts'); //The ID of the page that displays posts.
		$show_front = get_option('show_on_front'); //What to show on the front page    
		$breadcrumbs_separator  = get_theme_mod('breadcrumbs_separator', $defaults['breadcrumbs_separator']);
		$position   = get_theme_mod('breadcrumbs_position', $defaults['breadcrumbs_position']); // text for the 'Home' link
		$separators = [
			'type-1' => function_exists('rishi__cb_customizer_image_picker_file') ? rishi__cb_customizer_image_picker_file('breadcrumb-sep-1') : '',
			'type-2' => function_exists('rishi__cb_customizer_image_picker_file') ? rishi__cb_customizer_image_picker_file('breadcrumb-sep-2') : '',
			'type-3' => function_exists('rishi__cb_customizer_image_picker_file') ? rishi__cb_customizer_image_picker_file('breadcrumb-sep-3') : '',
		];
		if ($breadcrumbs_separator == 'type-1') {
			$seperator_svg = $separators['type-1'];
		} elseif ($breadcrumbs_separator == 'type-2') {
			$seperator_svg = $separators['type-2'];
		} elseif ($breadcrumbs_separator == 'type-3') {
			$seperator_svg = $separators['type-3'];
		} else {
			$seperator_svg = '';
		}
		$delimiter  = '<span class="separator">' . $seperator_svg . '</span>';
		$before     = '<span class="current" ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '>'; // tag before the current crumb
		$after      = '</span>'; // tag after the current crumb

		if( is_page_template( 'page-bookmark.php' ) ){
			return;
		}
		//settings from the theme
		if (get_theme_mod('breadcrumbs_position', $defaults['breadcrumbs_position']) !== 'none') {
			$depth = 1;
		?>
		<div id="crumbs" class="rishi-breadcrumb-main-wrap" <?php echo  rishi__cb_customizer_schema_org_definitions( 'breadcrumb_list' ); ?>>
			<?php if ($position !== 'before') echo '<div class="rishi-container">'; ?>
			<div class="rishi-breadcrumbs rt-supports-deeplink"<?php echo rishi_frontend_deeplink_customizer_preview( 'border-dashed','seo' ); ?>>

			<?php echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '>
			<a href="' . esc_url(home_url()) . '" itemprop="item"><span itemprop="name">' . esc_html__('Home', 'rishi') . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';

				if (is_home()) {
					$depth = 2;
					echo $before . '<a itemprop="item" href="' . esc_url(get_the_permalink()) . '"><span itemprop="name">' . esc_html(single_post_title('', false)) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_category()) {
					$depth = 2;
					$thisCat = get_category(get_query_var('cat'), false);
					if ($show_front === 'page' && $post_page) { //If static blog post page is set
						$p = get_post($post_page);
						echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_permalink($post_page)) . '" itemprop="item"><span itemprop="name">' . esc_html($p->post_title) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
						$depth++;
					}
					if ($thisCat->parent != 0) {
						$parent_categories = get_category_parents($thisCat->parent, false, ',');
						$parent_categories = explode(',', $parent_categories);
						foreach ($parent_categories as $parent_term) {
							$parent_obj = get_term_by('name', $parent_term, 'category');
							if (is_object($parent_obj)) {
								$term_url  = get_term_link($parent_obj->term_id);
								$term_name = $parent_obj->name;
								echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a itemprop="item" href="' . esc_url($term_url) . '"><span itemprop="name">' . esc_html($term_name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
								$depth++;
							}
						}
					}
					echo $before . '<a itemprop="item" href="' . esc_url(get_term_link($thisCat->term_id)) . '"><span itemprop="name">' .  esc_html(single_cat_title('', false)) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (rishi_is_woocommerce_activated() && (is_product_category() || is_product_tag())) { //For Woocommerce archive page
					$depth = 2;
					$current_term = $GLOBALS['wp_query']->get_queried_object();
					if (wc_get_page_id('shop')) { //Displaying Shop link in woocommerce archive page
						$_name = wc_get_page_id('shop') ? get_the_title(wc_get_page_id('shop')) : '';
						if (!$_name) {
							$product_post_type = get_post_type_object('product');
							$_name = $product_post_type->labels->singular_name;
						}
						echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '" itemprop="item"><span itemprop="name">' . esc_html($_name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
						$depth++;
					}
					if (is_product_category()) {
						$ancestors = get_ancestors($current_term->term_id, 'product_cat');
						$ancestors = array_reverse($ancestors);
						foreach ($ancestors as $ancestor) {
							$ancestor = get_term($ancestor, 'product_cat');
							if (!is_wp_error($ancestor) && $ancestor) {
								echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_term_link($ancestor)) . '" itemprop="item"><span itemprop="name">' . esc_html($ancestor->name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
								$depth++;
							}
						}
					}
					echo $before . '<a itemprop="item" href="' . esc_url(get_term_link($current_term->term_id)) . '"><span itemprop="name">' . esc_html($current_term->name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (rishi_is_woocommerce_activated() && is_shop()) { //Shop Archive page
					$depth = 2;
					if (get_option('page_on_front') == wc_get_page_id('shop')) {
						return;
					}
					$_name    = wc_get_page_id('shop') ? get_the_title(wc_get_page_id('shop')) : '';
					$shop_url = (wc_get_page_id('shop') && wc_get_page_id('shop') > 0)  ? get_the_permalink(wc_get_page_id('shop')) : home_url('/shop');
					if (!$_name) {
						$product_post_type = get_post_type_object('product');
						$_name             = $product_post_type->labels->singular_name;
					}
					echo $before . '<a itemprop="item" href="' . esc_url($shop_url) . '"><span itemprop="name">' . esc_html($_name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_tag()) {
					$depth          = 2;
					$queried_object = get_queried_object();
					echo $before . '<a itemprop="item" href="' . esc_url(get_term_link($queried_object->term_id)) . '"><span itemprop="name">' . esc_html(single_tag_title('', false)) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_author()) {
					global $author;
					$depth    = 2;
					$userdata = get_userdata($author);
					echo $before . '<a itemprop="item" href="' . esc_url(get_author_posts_url($author)) . '"><span itemprop="name">' . esc_html($userdata->display_name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_search()) {
					$depth       = 2;
					$request_uri = $_SERVER['REQUEST_URI'];
					echo $before . '<a itemprop="item" href="' . esc_url($request_uri) . '"><span itemprop="name">' . sprintf(__('Search Results for "%s"', 'rishi'), esc_html(get_search_query())) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_day()) {
					$depth = 2;
					echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_year_link(get_the_time(__('Y', 'rishi')))) . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_time(__('Y', 'rishi'))) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
					$depth++;
					echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_month_link(get_the_time(__('Y', 'rishi')), get_the_time(__('m', 'rishi')))) . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_time(__('F', 'rishi'))) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
					$depth++;
					echo $before . '<a itemprop="item" href="' . esc_url(get_day_link(get_the_time(__('Y', 'rishi')), get_the_time(__('m', 'rishi')), get_the_time(__('d', 'rishi')))) . '"><span itemprop="name">' . esc_html(get_the_time(__('d', 'rishi'))) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_month()) {
					$depth = 2;
					echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_year_link(get_the_time(__('Y', 'rishi')))) . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_time(__('Y', 'rishi'))) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
					$depth++;
					echo $before . '<a itemprop="item" href="' . esc_url(get_month_link(get_the_time(__('Y', 'rishi')), get_the_time(__('m', 'rishi')))) . '"><span itemprop="name">' . esc_html(get_the_time(__('F', 'rishi'))) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_year()) {
					$depth = 2;
					echo $before . '<a itemprop="item" href="' . esc_url(get_year_link(get_the_time(__('Y', 'rishi')))) . '"><span itemprop="name">' . esc_html(get_the_time(__('Y', 'rishi'))) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_single() && !is_attachment()) {
					$depth = 2;
					if (rishi_is_woocommerce_activated() && 'product' === get_post_type()) { //For Woocommerce single product
						if (wc_get_page_id('shop')) { //Displaying Shop link in woocommerce archive page
							$_name = wc_get_page_id('shop') ? get_the_title(wc_get_page_id('shop')) : '';
							if (!$_name) {
								$product_post_type = get_post_type_object('product');
								$_name = $product_post_type->labels->singular_name;
							}
							echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '" itemprop="item"><span itemprop="name">' . esc_html($_name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
							$depth++;
						}
						if ($terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'))) {
							$main_term = apply_filters('woocommerce_breadcrumb_main_term', $terms[0], $terms);
							$ancestors = get_ancestors($main_term->term_id, 'product_cat');
							$ancestors = array_reverse($ancestors);
							foreach ($ancestors as $ancestor) {
								$ancestor = get_term($ancestor, 'product_cat');
								if (!is_wp_error($ancestor) && $ancestor) {
									echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_term_link($ancestor)) . '" itemprop="item"><span itemprop="name">' . esc_html($ancestor->name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
									$depth++;
								}
							}
							echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_term_link($main_term)) . '" itemprop="item"><span itemprop="name">' . esc_html($main_term->name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
							$depth++;
						}
						echo $before . '<a href="' . esc_url(get_the_permalink()) . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_title()) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
					} elseif (get_post_type() != 'post') {
						$post_type = get_post_type_object(get_post_type());
						if ($post_type->has_archive == true) { // For CPT Archive Link                   
							// Add support for a non-standard label of 'archive_title' (special use case).
							$label = !empty($post_type->labels->archive_title) ? $post_type->labels->archive_title : $post_type->labels->name;
							echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_post_type_archive_link(get_post_type())) . '" itemprop="item"><span itemprop="name">' . esc_html($label) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
							$depth++;
						}
						echo $before . '<a href="' . esc_url(get_the_permalink()) . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_title()) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
					} else { //For Post                
						$cat_object       = get_the_category();
						$potential_parent = 0;

						if ($show_front === 'page' && $post_page) { //If static blog post page is set
							$p = get_post($post_page);
							echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_permalink($post_page)) . '" itemprop="item"><span itemprop="name">' . esc_html($p->post_title) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
							$depth++;
						}

						if ($cat_object) { //Getting category hierarchy if any        
							//Now try to find the deepest term of those that we know of
							$use_term = key($cat_object);
							foreach ($cat_object as $key => $object) {
								//Can't use the next($cat_object) trick since order is unknown
								if ($object->parent > 0  && ($potential_parent === 0 || $object->parent === $potential_parent)) {
									$use_term         = $key;
									$potential_parent = $object->term_id;
								}
							}
							$cat  = $cat_object[$use_term];
							$cats = get_category_parents($cat, false, ',');
							$cats = explode(',', $cats);
							foreach ($cats as $cat) {
								$cat_obj = get_term_by('name', $cat, 'category');
								if (is_object($cat_obj)) {
									$term_url  = get_term_link($cat_obj->term_id);
									$term_name = $cat_obj->name;
									echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a itemprop="item" href="' . esc_url($term_url) . '"><span itemprop="name">' . esc_html($term_name) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
									$depth++;
								}
							}
						}
						echo $before . '<a itemprop="item" href="' . esc_url(get_the_permalink()) . '"><span itemprop="name">' . esc_html(get_the_title()) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
					}
				} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) { //For Custom Post Archive
					$depth     = 2;
					$post_type = get_post_type_object(get_post_type());
					if (get_query_var('paged')) {
						echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_post_type_archive_link($post_type->name)) . '" itemprop="item"><span itemprop="name">' . esc_html($post_type->label) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '/</span>';
						echo $before . sprintf(__('Page %s', 'rishi'), get_query_var('paged')) . $after;
					} else {
						echo $before . '<a itemprop="item" href="' . esc_url(get_post_type_archive_link($post_type->name)) . '"><span itemprop="name">' . esc_html($post_type->label) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
					}
				} elseif (is_attachment()) {
					$depth = 2;
					echo $before . '<a itemprop="item" href="' . esc_url(get_the_permalink()) . '"><span itemprop="name">' . esc_html(get_the_title()) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_page() && !$post->post_parent) {
					$depth = 2;
					echo $before . '<a itemprop="item" href="' . esc_url(get_the_permalink()) . '"><span itemprop="name">' . esc_html(get_the_title()) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				} elseif (is_page() && $post->post_parent) {
					$depth       = 2;
					$parent_id   = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$current_page  = get_post($parent_id);
						$breadcrumbs[] = $current_page->ID;
						$parent_id     = $current_page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo '<span ' . rishi__cb_customizer_schema_org_definitions( 'breadcrumb_item' ) . '><a href="' . esc_url(get_permalink($breadcrumbs[$i])) . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_title($breadcrumbs[$i])) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $delimiter . '</span>';
						$depth++;
					}
					echo $before . '<a href="' . get_permalink() . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_title()) . '</span></a><meta itemprop="position" content="' . absint($depth) . '" /></span>' . $after;
				} elseif (is_404()) {
					$depth = 2;
					echo $before . '<a itemprop="item" href="' . esc_url(home_url()) . '"><span itemprop="name">' . esc_html__('404 Error - Page Not Found', 'rishi') . '</span></a><meta itemprop="position" content="' . absint($depth) . '" />' . $after;
				}

				if (get_query_var('paged')) printf(__(' (Page %s)', 'rishi'), get_query_var('paged')); ?>
			</div>
			<?php if ($position !== 'before') echo '</div>'; ?>
		</div><!-- .crumbs -->
	<?php
		}
	}
endif;

if (!function_exists('rishi_breadcrumb_start')) :
	/**
	 * Content Start
	 */
	function rishi_breadcrumb_start()
	{
		$defaults                         = rishi__cb__get_breadcrumbs_defaults();
		$breadcrumbs_position             = get_theme_mod('breadcrumbs_position', $defaults['breadcrumbs_position']);
		$disable_search                   = get_theme_mod('breadcrumbs_ed_search', $defaults['breadcrumbs_ed_search']);
		$disable_author                   = get_theme_mod('breadcrumbs_ed_author', $defaults['breadcrumbs_ed_author']);
		$disable_archive                  = get_theme_mod('breadcrumbs_ed_archive', $defaults['breadcrumbs_ed_archive']);
		$disable_blog                     = get_theme_mod('blog_ed_breadcrumbs', $defaults['blog_ed_breadcrumbs']);
		$breadcrumbs_ed_single_page       = get_theme_mod('breadcrumbs_ed_single_page', $defaults['breadcrumbs_ed_single_page']);
		$breadcrumbs_ed_single_post       = get_theme_mod('breadcrumbs_ed_single_post', $defaults['breadcrumbs_ed_single_post']);
		$disable_single_product           = get_theme_mod('breadcrumbs_ed_single_product', $defaults['breadcrumbs_ed_single_product']);
		$breadcrumbs_ed_archive_product   = get_theme_mod('breadcrumbs_ed_archive_product', $defaults['breadcrumbs_ed_archive_product']);
		$disable_404                      = get_theme_mod('breadcrumbs_ed_404', $defaults['breadcrumbs_ed_404']);
		if ($breadcrumbs_position == 'none') {
			return;
		} elseif ( is_404() && $disable_404 !== 'yes') {
			return;
		} elseif (is_singular()) {
			if ( ( get_post_type() == 'product' ) && $disable_single_product !== 'yes' ) {
				return;
			} elseif ( is_single() && ( $breadcrumbs_ed_single_post !== 'yes' ) || (rishi__cb_customizer_default_akg(
					'breadcrumbs_single_post',
					rishi__cb_customizer_get_post_options(),
					'no'
				) === 'yes') ){
				return;
			} elseif (  is_page() && ( $breadcrumbs_ed_single_page !== 'yes' )  || ( ( rishi__cb_customizer_default_akg(
					'page_title_hero_section',
					rishi__cb_customizer_get_post_options(),
					'default'
				) === 'enabled' ) && ( rishi__cb_customizer_default_akg(
					'breadcrumbs_single_page',
					rishi__cb_customizer_get_post_options(),
					'no'
				) === 'yes') ) || ( rishi__cb_customizer_default_akg(
					'page_title_hero_section',
					rishi__cb_customizer_get_post_options(),
					'default'
				) === 'disabled' ) ) {
				return;
			}else {
				rishi_breadcrumb();
			}
		}elseif (is_archive() ) {	
			if( is_author() && $disable_author !== 'yes' ){
				return;
			}elseif( !is_author() && $disable_archive !== 'yes' ){
				return;
			}elseif (is_post_type_archive( 'product' ) && rishi_is_woocommerce_activated() && $breadcrumbs_ed_archive_product !== 'yes'){
				return;
			}else{
				rishi_breadcrumb();
			}
		} elseif (is_search() && $disable_search !== 'yes') {
			return;
		} elseif( !is_front_page() && is_home() && $disable_blog !== 'yes' ) {
			return;
		}else {
			if (!is_front_page()) {
				rishi_breadcrumb();
			}
		}
	}
endif;

if (!function_exists('rishi_get_posts_list')) :
	/**
	 * Returns Latest, Related Posts
	 */
	function rishi_get_posts_list()
	{
		global $post;

		$defaults       = rishi__cb__get_layout_defaults();
		$posts_per_page = get_theme_mod('no_of_related_post', $defaults['no_of_related_post']);
		$posts_per_row  = get_theme_mod('related_post_per_row', $defaults['related_post_per_row']);
		$related_tax    = get_theme_mod('related_taxonomy', $defaults['related_taxonomy']);

		$args = array(
			'posts_status'        => 'publish',
			'posts_per_page'      => $posts_per_page,
			'post__not_in'        => array($post->ID),
			'orderby'             => 'rand',
			'ignore_sticky_posts' => true,
			'post_type'           => 'post',
		);

		if ($related_tax == 'cat') {
			$cats = get_the_category($post->ID);
			if ($cats) {
				$c = array();
				foreach ($cats as $cat) {
					$c[] = $cat->term_id;
				}
				$args['category__in'] = $c;
			}
		} elseif ($related_tax == 'tag') {
			$tags = get_the_tags($post->ID);
			if ($tags) {
				$t = array();
				foreach ($tags as $tag) {
					$t[] = $tag->term_id;
				}
				$args['tag__in'] = $t;
			}
		}

		$qry = new WP_Query($args);

        $meta_elements = get_theme_mod( 'related_post_meta_elements', rishi__cb__get_default_postmeta_structure() );
        $meta_divider = get_theme_mod( 'related_post_meta_divider', 'slash' );

		if ($qry->have_posts()) { ?>
			<div class="recommended-articles related-posts rt-supports-deeplink related-posts-per-row-<?php echo esc_attr( $posts_per_row ); ?>"<?php echo rishi_frontend_deeplink_customizer_preview( 'border-dashed','singlepost:single_related_title' ); ?>>
				<?php
				rishi_get_related_post_info(); ?>
				<div class="recomm-artcles-wrap">
					<?php while ($qry->have_posts()) {
						$qry->the_post(); ?>
						<div class="recomm-article-singl">
							<article class="post rishi-article-post">
								<div class="blog-post-lay">
									<div class="post-content">
										<div class="entry-content-main-wrap">
											<div class="post-thumb">
												<div class="post-thumb-inner-wrap">
													<a href="<?php the_permalink(); ?>" rel="prev">
														<?php
														if (has_post_thumbnail()) {
															the_post_thumbnail('rishi-blog-grid', array('itemprop' => 'image'));
														} else {
															rishi_get_fallback_svg('rishi-blog-grid');
														}
														?>
													</a>
												</div>
											</div>
											<header class="entry-header">
												<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											</header>
                                            <?php
                                                if( $meta_elements && $meta_divider ){
                                                    rishi_post_meta( $meta_elements, $meta_divider );
                                                }
                                            ?>
										</div>
									</div>
								</div>
							</article>
						</div><!-- .recomm-article-singl -->
					<?php } ?>
				</div><!-- .recomm-artcles-wrap -->
			</div><!-- .related-articles/latest-articles -->
			<?php
			wp_reset_postdata();
		}
	}
endif;

if (!function_exists('rishi_search_post_count')) :
	/**
	 * Search Result Page Count 
	 */
	function rishi_search_post_count(){
		if( rishi_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( 'product' ) ) ) return;
		$ed = 'yes';
		if( is_archive() ){
			$ed = get_theme_mod( 'archive_page_search_ed', 'no' );
			
			if( is_author() ){
				$ed = get_theme_mod( 'author_page_search_ed', 'yes' );
			}
		}
		
		if( is_search() ){
			$ed = get_theme_mod( 'search_page_search_ed', 'yes' );
		}
		
		global $wp_query;
		$found_posts  = $wp_query->found_posts;
		$visible_post = get_option('posts_per_page');

		if ( $found_posts > 0) { ?>
			<section class="rishi-search-count" data-count="<?php echo esc_attr( $ed ); ?>"><span class="srch-results-cnt">
			<?php 
			if ($found_posts > $visible_post) {
				printf(esc_html__('Showing %1$s of %2$s Results', 'rishi'), number_format_i18n($visible_post), number_format_i18n($found_posts));
			} else {
				/* translators: 1: found posts. */
				printf(_nx('%s Result', '%s Results', $found_posts, 'found posts', 'rishi'), number_format_i18n($found_posts));
			}
			echo '</span></section>';
		}
	}
endif;

if (!function_exists('rishi_get_image_sizes')) :
	/**
	 * Get information about available image sizes
	 */
	function rishi_get_image_sizes($size = '')
	{

		global $_wp_additional_image_sizes;

		$sizes = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach ($get_intermediate_image_sizes as $_size) {
			if (in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
				$sizes[$_size]['width'] = get_option($_size . '_size_w');
				$sizes[$_size]['height'] = get_option($_size . '_size_h');
				$sizes[$_size]['crop'] = (bool) get_option($_size . '_crop');
			} elseif (isset($_wp_additional_image_sizes[$_size])) {
				$sizes[$_size] = array(
					'width' => $_wp_additional_image_sizes[$_size]['width'],
					'height' => $_wp_additional_image_sizes[$_size]['height'],
					'crop' =>  $_wp_additional_image_sizes[$_size]['crop']
				);
			}
		}
		// Get only 1 size if found
		if ($size) {
			if (isset($sizes[$size])) {
				return $sizes[$size];
			} else {
				return false;
			}
		}
		return $sizes;
	}
endif;

if (!function_exists('rishi_get_fallback_svg')) :
	/**
	 * Get Fallback SVG
	 */
	function rishi_get_fallback_svg($post_thumbnail)
	{
		if (!$post_thumbnail) {
			return;
		}

		$image_size = rishi_get_image_sizes($post_thumbnail);

		if ($image_size) { ?>
			<div class="svg-holder">
				<svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr($image_size['width']); ?> <?php echo esc_attr($image_size['height']); ?>" preserveAspectRatio="none">
					<rect width="<?php echo esc_attr($image_size['width']); ?>" height="<?php echo esc_attr($image_size['height']); ?>" style="fill:#f6f9ff;"></rect>
				</svg>
			</div>
			<?php
		}
	}
endif;

if (!function_exists('rishi_sidebar')) :
	/**
	 * Return sidebar layouts for pages/posts
	 */
	function rishi_sidebar($class = false)
	{
		global $post;
		$defaults = rishi__cb__get_layout_defaults();
		$return   = $class ? 'full-width' : false; //Fullwidth
		$layout   = get_theme_mod('layout_style', $defaults['layout_style']);

		if( is_page_template( 'page-bookmark.php' ) || is_page_template( 'portfolio.php')  || is_singular('rishi-portfolio') ) return;

		if( is_home() ){

			$home_multiple_sidebar = 'sidebar-1';

			if (class_exists('RishiSidebarsManager')) {
				$manager = new RishiSidebarsManager();
	
				$maybe_sidebar = $manager->maybe_get_sidebar_that_matches();
	
				if ($maybe_sidebar) {
					$home_multiple_sidebar = $maybe_sidebar;
				}
			}

			$blog_sidebar = get_theme_mod('blog_sidebar_layout', $defaults['blog_sidebar_layout']);
			if ($blog_sidebar == 'no-sidebar' || ($blog_sidebar == 'default-sidebar' && $layout == 'no-sidebar')) {
				$return = $class ? 'full-width' : false; //Fullwidth
			} elseif (is_active_sidebar($home_multiple_sidebar)) {
				if ($blog_sidebar == 'right-sidebar' || ($blog_sidebar == 'default-sidebar' && $layout == 'right-sidebar')) $return = $class ? 'rightsidebar' : $home_multiple_sidebar;
				if ($blog_sidebar == 'left-sidebar' || ($blog_sidebar == 'default-sidebar' && $layout == 'left-sidebar')) $return = $class ? 'leftsidebar' : $home_multiple_sidebar;
			} else {
				$return = $class ? 'full-width' : false; //Fullwidth
			}
		}

		if( is_archive() ) {

			$archive_multiple_sidebar = 'sidebar-1';

			if (class_exists('RishiSidebarsManager')) {
				$manager = new RishiSidebarsManager();
	
				$maybe_sidebar = $manager->maybe_get_sidebar_that_matches();
	
				if ($maybe_sidebar) {
					$archive_multiple_sidebar = $maybe_sidebar;
				}
			}

			if( is_author() ){
				$archive_sidebar = get_theme_mod('author_sidebar_layout', $defaults['author_sidebar_layout']);
			}else{
				$archive_sidebar = get_theme_mod('archive_sidebar_layout', $defaults['archive_sidebar_layout']);
			}
			
			if ($archive_sidebar == 'no-sidebar' || ($archive_sidebar == 'default-sidebar' && $layout == 'no-sidebar')) {
				$return = $class ? 'full-width' : false; //Fullwidth
			} elseif (is_active_sidebar($archive_multiple_sidebar)) {
				if ($archive_sidebar == 'right-sidebar' || ($archive_sidebar == 'default-sidebar' && $layout == 'right-sidebar')) $return = $class ? 'rightsidebar' : $archive_multiple_sidebar;
				if ($archive_sidebar == 'left-sidebar' || ($archive_sidebar == 'default-sidebar' && $layout == 'left-sidebar')) $return = $class ? 'leftsidebar' : $archive_multiple_sidebar;
			} else {
				$return = $class ? 'full-width' : false; //Fullwidth
			}

		}

		if( is_search()) {

			$search_multiple_sidebar = 'sidebar-1';

			if (class_exists('RishiSidebarsManager')) {
				$manager = new RishiSidebarsManager();
	
				$maybe_sidebar = $manager->maybe_get_sidebar_that_matches();
	
				if ($maybe_sidebar) {
					$search_multiple_sidebar = $maybe_sidebar;
				}
			}

			$search_sidebar = get_theme_mod('search_sidebar_layout', $defaults['search_sidebar_layout']);
			if ($search_sidebar == 'no-sidebar' || ($search_sidebar == 'default-sidebar' && $layout == 'no-sidebar')) {
				$return = $class ? 'full-width' : false; //Fullwidth
			} elseif (is_active_sidebar($search_multiple_sidebar)) {
				if ($search_sidebar == 'right-sidebar' || ($search_sidebar == 'default-sidebar' && $layout == 'right-sidebar')) $return = $class ? 'rightsidebar' : $search_multiple_sidebar;
				if ($search_sidebar == 'left-sidebar' || ($search_sidebar == 'default-sidebar' && $layout == 'left-sidebar')) $return = $class ? 'leftsidebar' : $search_multiple_sidebar;
			} else {
				$return = $class ? 'full-width' : false; //Fullwidth
			}
		}

		if( rishi_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( 'product' ) ) ) {

			$woo_multiple_sidebar = 'shop-sidebar';

			if (class_exists('RishiSidebarsManager')) {
				$manager = new RishiSidebarsManager();
	
				$maybe_sidebar = $manager->maybe_get_sidebar_that_matches();
	
				if ($maybe_sidebar) {
					$woo_multiple_sidebar = $maybe_sidebar;
				}
			}

			$woo_sidebar = get_theme_mod('woocommerce_sidebar_layout', $defaults['woocommerce_sidebar_layout']);
			if ($woo_sidebar == 'no-sidebar' || ($woo_sidebar == 'default-sidebar' && $layout == 'no-sidebar')) {
				$return = $class ? 'full-width' : false; //Fullwidth
			}elseif (is_active_sidebar($woo_multiple_sidebar)) {
				if ($woo_sidebar == 'right-sidebar' || ($woo_sidebar == 'default-sidebar' && $layout == 'right-sidebar')) $return = $class ? 'rightsidebar' : $woo_multiple_sidebar;
				if ($woo_sidebar == 'left-sidebar' || ($woo_sidebar == 'default-sidebar' && $layout == 'left-sidebar')) $return = $class ? 'leftsidebar' : $woo_multiple_sidebar;
			} else {
				$return = $class ? 'full-width' : false; //Fullwidth
			}
		}

		if(is_singular()) {
			$page_layout    = get_theme_mod('page_sidebar_layout', $defaults['page_sidebar_layout']); //Global Layout/Position for Pages
			$post_layout    = get_theme_mod('post_sidebar_layout', $defaults['post_sidebar_layout']); //Global Layout/Position for Posts
			/**
			 * Individual post/page layout
			 */
			if (get_post_meta($post->ID, '_rishi_sidebar_layout', true)) {
				$sidebar_layout = get_post_meta($post->ID, '_rishi_sidebar_layout', true);
			} else {
				$sidebar_layout = 'default-sidebar';
			}
			
			$sidebar_layout = rishi__cb_customizer_default_akg(
				'page_structure_type',
				rishi__cb_customizer_get_post_options($post->ID),
				'default-sidebar'
			);

			/**
			 * Individual post/page sidebar
			*/
			
			$single_sidebar = 'sidebar-1';

			if (class_exists('RishiSidebarsManager')) {
				$manager = new RishiSidebarsManager();
	
				$maybe_sidebar = $manager->maybe_get_sidebar_that_matches();
	
				if ($maybe_sidebar) {
					$single_sidebar = $maybe_sidebar;
				}else{
					$single_sidebar = rishi__cb_customizer_default_akg(
						'single_multiple_sidebar',
						rishi__cb_customizer_get_post_options($post->ID),
						'sidebar-1'
					);
				}
			}
			
			if (is_page()) {
				if ($sidebar_layout == 'no-sidebar' || ($sidebar_layout == 'default-sidebar' && $page_layout == 'no-sidebar')) {
					$return = $class ? 'full-width' : false; //Fullwidth
				}elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $page_layout == 'centered' ) ){
					$return = $class ? 'full-width centered' : false;
				} elseif (is_active_sidebar($single_sidebar)) {
					if (($sidebar_layout == 'default-sidebar' && $page_layout == 'right-sidebar') || ($sidebar_layout == 'right-sidebar')) $return = $class ? 'rightsidebar' : $single_sidebar;
					if (($sidebar_layout == 'default-sidebar' && $page_layout == 'left-sidebar') || ($sidebar_layout == 'left-sidebar')) $return = $class ? 'leftsidebar' : $single_sidebar;
				} else {
					$return = $class ? 'full-width' : false; //Fullwidth
				}
			}

			if (is_single()) {
				if ('product' === get_post_type()) { //For Product Post Type
					$woo_single_sidebar = 'shop-sidebar';

					if (class_exists('RishiSidebarsManager')) {
						$manager = new RishiSidebarsManager();
			
						$maybe_sidebar = $manager->maybe_get_sidebar_that_matches();
			
						if ($maybe_sidebar) {
							$woo_single_sidebar = $maybe_sidebar;
						}
					}
					$woo_sidebar = get_theme_mod('woocommerce_sidebar_layout', $defaults['woocommerce_sidebar_layout']);
					if ($woo_sidebar == 'no-sidebar' || ($woo_sidebar == 'default-sidebar' && $layout == 'no-sidebar')) {
						$return = $class ? 'full-width' : false; //Fullwidth
					}elseif (is_active_sidebar($woo_single_sidebar)) {
						if ($woo_sidebar == 'right-sidebar' || ($woo_sidebar == 'default-sidebar' && $layout == 'right-sidebar')) $return = $class ? 'rightsidebar' : $woo_single_sidebar;
						if ($woo_sidebar == 'left-sidebar' || ($woo_sidebar == 'default-sidebar' && $layout == 'left-sidebar')) $return = $class ? 'leftsidebar' : $woo_single_sidebar;
					} else {
						$return = $class ? 'full-width' : false; //Fullwidth
					}
				} elseif ('post' === get_post_type()) { //For default post type
					if ($sidebar_layout == 'no-sidebar' || ($sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar')) {
						$return = $class ? 'full-width' : false; //Fullwidth
					}elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){
						$return = $class ? 'full-width centered' : false;
					}elseif (is_active_sidebar( $single_sidebar )) {
						if (($sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar') || ($sidebar_layout == 'right-sidebar')) $return = $class ? 'rightsidebar' : $single_sidebar;
						if (($sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar') || ($sidebar_layout == 'left-sidebar')) $return = $class ? 'leftsidebar' : $single_sidebar;
					} else {
						$return = $class ? 'full-width' : false; //Fullwidth
					}
				} else { //Custom Post Type
					if ($post_layout == 'no-sidebar') {
						$return = $class ? 'full-width' : false; //Fullwidth
					} elseif( $post_layout == 'centered' ){
						$return = $class ? 'full-width centered' : false;
					} elseif (is_active_sidebar('sidebar-1')) {
						if ($post_layout == 'right-sidebar') $return = $class ? 'rightsidebar' : 'sidebar-1';
						if ($post_layout == 'left-sidebar') $return = $class ? 'leftsidebar' : 'sidebar-1';
					} else {
						$return = $class ? 'full-width' : false; //Fullwidth
					}
				}
				
			}

		}
		return $return;
	}
endif;

/**
 * Query WooCommerce activation
 */
function rishi_is_woocommerce_activated()
{
	return class_exists('woocommerce') ? true : false;
}

/**
 * Checks if classic editor is active or not
 */
function rishi_is_classic_editor_activated()
{
	return class_exists('Classic_Editor') ? true : false;
}

/**
 * Checks if classic editor is active or not
 */
function rishi_is_primary_menu_activated()
{
	return has_nav_menu('menu-1') ? true : false;
}

if (! function_exists('rishi_frontend_deeplink_customizer_preview')) {
	function rishi_frontend_deeplink_customizer_preview( $border_type, $location ) {
		if( !is_customize_preview() ) return;
		$data_deep_link = esc_attr( " data-shortcut=$border_type data-location=$location");
		return $data_deep_link;
	}
}

if (! function_exists('rishi__cb_customizer_get_woocommerce_ratio')) {
	function rishi__cb_customizer_get_woocommerce_ratio() {
		$cropping = get_theme_mod(
			'rishi__cb_customizer_woocommerce_thumbnail_cropping',
			'original'
		);

		if ($cropping === 'uncropped') {
			return 'original';
		}

		if ($cropping === '1:1') {
			return '1/1';
		}

		if ($cropping === 'custom' || $cropping === 'predefined') {
			$width = get_option('woocommerce_thumbnail_cropping_custom_width', 4);
			$height = get_option('woocommerce_thumbnail_cropping_custom_height', 3);

			return $width . '/' . $height;
		}

		return '1/1';
	}
}


if( ! function_exists( 'rishi_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function rishi_fonts_url() {
	$fonts_url = '';

	/*
	* translators: If there are characters in your language that are not supported
	* by Sora, translate this to 'off'. Do not translate into your own language.
	*/
	$sora = _x( 'on', 'Sora font: on or off', 'rishi' );

	if ( 'off' !== $sora ) {
		$font_families = array();

		$font_families[] = 'Sora:100,200,300,400,500,600,700,800';

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'display' => urlencode( 'swap' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url( $fonts_url );
}
endif; 

if( ! function_exists( 'rishi_bookmark_settings' ) ) :
	function rishi_bookmark_settings(){
		if( function_exists( 'rishi_pro_bookmark' ) ) : rishi_pro_bookmark(); endif;
	}
endif;

if( ! function_exists( 'rishi_is_bookmark_enabled' ) ) :
	function rishi_is_bookmark_enabled(){
		if( function_exists( 'rishi_pro_bookmark' ) ) :
			$ed_bookmark   = get_theme_mod( 'ed_read_it_later', 'no' ); 

			if( $ed_bookmark === 'yes' ){
				return true;
			}else{
				return false;
			}
		endif;
	}
endif;