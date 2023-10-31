<?php
/**
 * Pagination helpers
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

/**
 * Dispaly post pagination.
 *
 * @param array $args Pagination config.
 */
if ( ! function_exists( 'rishi__cb_customizer_display_posts_pagination' ) ) {
	function rishi__cb_customizer_display_posts_pagination( $args = array() ) {
		global $wp_query;

		$allowed_prefixes_args = array(
			'allowed_prefixes' => array(
				'blog',
				'woo_categories',
			),
			'default_prefix'   => 'blog',
		);

		$args = wp_parse_args(
			$args,
			array(
				'query'           => $wp_query,
				'prefix'          => rishi__cb_customizer_manager()->screen->get_prefix(
					$allowed_prefixes_args
				),

				'has_pagination'  => '__DEFAULT__',
				'pagination_type' => '__DEFAULT__',

				'last_page_text'  => __( 'No more posts to load.', 'rishi' ),
				'total_pages'     => null,
				'current_page'    => null,
				'format'          => null,
				'base'            => null,
			)
		);

		$args['prefix'] = rishi__cb_customizer_manager()->screen->process_allowed_prefixes(
			$args['prefix'],
			$allowed_prefixes_args
		);

		if ( $args['has_pagination'] === '__DEFAULT__' ) {
			$args['has_pagination'] = get_theme_mod(
				$args['prefix'] . '_has_pagination',
				'yes'
			) === 'yes';
		}

		if ( $args['pagination_type'] === '__DEFAULT__' ) {
			$args['pagination_type'] = get_theme_mod(
				$args['prefix'] . '_pagination_global_type',
				'simple'
			);
		}

		if ( $args['prefix'] === 'woo_categories' ) {
			$args['last_page_text'] = __( 'No more products to load.', 'rishi' );
		}

		if ( ! $args['has_pagination'] ) {
			return '';
		}

		if ( ! $args['total_pages'] || ! $args['current_page'] ) {
			$args['current_page'] = $args['query']->get( 'paged' );
			$args['total_pages']  = $args['query']->max_num_pages;

			if ( ! $args['current_page'] ) {
				$args['current_page'] = 1;
			}
		}

		if ( $args['total_pages'] <= 1 ) {
			return '';
		}

		$button_output = '';

		if (
			$args['pagination_type'] === 'load_more'
			&&
			intval( $args['current_page'] ) !== intval( $args['total_pages'] )
		) {
			$label_button = get_theme_mod(
				$args['prefix'] . '_load_more_label',
				__( 'Load More', 'rishi' )
			);

			$button_output = '<a class="cb__button rt-load-more">' . esc_html( $label_button ) . '</a>';
		}

		if (
			$args['pagination_type'] !== 'simple'
			&&
			$args['pagination_type'] !== 'next_prev'
		) {
			if ( intval( $args['current_page'] ) == intval( $args['total_pages'] ) ) {
				$lasttext = esc_html( $args['last_page_text'] );
			} else {
				$lasttext = esc_html__( 'Loading...', 'rishi' );
			}

			if ( intval( $args['current_page'] ) === intval( $args['total_pages'] ) ) {
				return '';
			}

			$button_output  = '<div class="cb__load-more-helper">' . $button_output;
			$button_output .= '<span data-loader="circles"><span></span><span></span><span></span></span>';
			$button_output .= '<div class="cb__last-page-text">' . $lasttext . '</div>';
			$button_output .= '</div>';
		}

		$pagination_class = 'cb__pagination';
		$divider_output   = '';

		$divider = get_theme_mod(
			$args['prefix'] . '_paginationDivider',
			array(
				'width' => 1,
				'style' => 'none',
				'color' => array(
					'color' => 'rgba(224, 229, 235, 0.5)',
				),
			)
		);

		$numbers_visibility = get_theme_mod(
			$args['prefix'] . '_numbers_visibility',
			array(
				'desktop' => true,
				'tablet'  => true,
				'mobile'  => false,
			)
		);

		$arrows_visibility = get_theme_mod(
			$args['prefix'] . '_arrows_visibility',
			array(
				'desktop' => true,
				'tablet'  => true,
				'mobile'  => true,
			)
		);

		if (
			$divider['style'] !== 'none'
			&&
			$args['pagination_type'] !== 'infinite_scroll'
		) {
			$divider_output = 'data-divider';
		}

		$template = '
		<nav class="' . esc_attr( $pagination_class ) . '" data-pagination="' . $args['pagination_type'] . '" ' . esc_attr( $divider_output ) . '>
			%1$s
			%2$s
		</nav>';

		$paginate_links_args = array(
			'mid_size'  => 3,
			'end_size'  => 0,
			'type'      => 'array',
			'total'     => $args['total_pages'],
			'current'   => $args['current_page'],
			'prev_text' => '<svg width="9px" height="9px" viewBox="0 0 15 15"><path class="st0" d="M10.9,15c-0.2,0-0.4-0.1-0.6-0.2L3.6,8c-0.3-0.3-0.3-0.8,0-1.1l6.6-6.6c0.3-0.3,0.8-0.3,1.1,0c0.3,0.3,0.3,0.8,0,1.1L5.2,7.4l6.2,6.2c0.3,0.3,0.3,0.8,0,1.1C11.3,14.9,11.1,15,10.9,15z"/></svg>' . __( 'Prev', 'rishi' ),

			'next_text' => __( 'Next', 'rishi' ) . ' <svg width="9px" height="9px" viewBox="0 0 15 15"><path class="st0" d="M4.1,15c0.2,0,0.4-0.1,0.6-0.2L11.4,8c0.3-0.3,0.3-0.8,0-1.1L4.8,0.2C4.5-0.1,4-0.1,3.7,0.2C3.4,0.5,3.4,1,3.7,1.3l6.1,6.1l-6.2,6.2c-0.3,0.3-0.3,0.8,0,1.1C3.7,14.9,3.9,15,4.1,15z"/></svg>',
		);

		if ( $args['format'] ) {
			$paginate_links_args['format'] = $args['format'];
		}

		if ( $args['base'] ) {
			$paginate_links_args['base'] = $args['base'];
		}

		$links = paginate_links( $paginate_links_args );

		$arrow_links  = array( '', '' );
		$proper_links = array();

		foreach ( $links as $link ) {
			preg_match( '/class="[^"]+"/', $link, $matches );

			if ( count( $matches ) === 0 ) {
				continue;
			}

			if (
				$args['pagination_type'] === 'next_prev'
				&&
				strpos( $matches[0], 'next' ) === false
				&&
				strpos( $matches[0], 'prev' ) === false
			) {
				continue;
			}

			if (
				$args['pagination_type'] === 'simple'
				&&
				(
					strpos( $matches[0], 'next' ) !== false
					||
					strpos( $matches[0], 'prev' ) !== false
				)
			) {
				$link = str_replace(
					'page-numbers',
					trim(
						'page-numbers ' . rishi__cb_customizer_visibility_classes(
							$arrows_visibility
						)
					),
					$link
				);
			}

			if (
				strpos( $matches[0], 'next' ) !== false
				||
				strpos( $matches[0], 'prev' ) !== false
			) {
				$arrow_links[ strpos( $matches[0], 'next' ) !== false ? 1 : 0 ] = $link;
			} else {
				$proper_links[] = $link;
			}
		}

		$proper_links = join( "\n", $proper_links );

		if ( $args['pagination_type'] === 'simple' ) {
			$proper_links = '<div class="' . rishi__cb_customizer_visibility_classes(
				$numbers_visibility
			) . '">' . $proper_links . '</div>';
		}

		return sprintf(
			$template,
			$arrow_links[0] . $proper_links . $arrow_links[1],
			$button_output
		);
	}
}
