<?php

add_filter(
	'page_css_class',
	function ( $css_class, $page, $depth, $args, $current_page ) {
		if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
			$css_class[] = 'menu-item-has-children';
		}

		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );

			if (
				$_current_page
				&&
				in_array( $page->ID, $_current_page->ancestors )
			) {
				$css_class[] = 'current-menu-ancestor';
			}

			if ( $page->ID === $current_page ) {
				$css_class[] = 'current-menu-item';
			} elseif (
				$_current_page
				&&
				$page->ID === $_current_page->post_parent
			) {
				$css_class[] = 'current-menu-parent';
			}
		} elseif ( get_option( 'page_for_posts' ) === $page->ID ) {
			$css_class[] = 'current-menu-parent';
		}

		if (
			! isset( $args['rishi__cb_customizer_mega_menu'] )
			||
			! $args['rishi__cb_customizer_mega_menu']
		) {
			return $css_class;
		}

		$classes_str = implode( ' ', $css_class );

		if (
			strpos( $classes_str, 'has-children' ) === false
			&&
			strpos( $classes_str, 'has_children' ) === false
		) {
			return $css_class;
		}

		$css_class[] = 'animated-submenu';

		return $css_class;
	},
	10,
	5
);

add_filter(
	'nav_menu_css_class',
	function ( $classes, $item, $args, $depth ) {
		if (
			! isset( $args->rishi__cb_customizer_mega_menu )
			||
			! $args->rishi__cb_customizer_mega_menu
		) {
			return $classes;
		}

		$classes_str = implode( ' ', $classes );

		if (
			strpos( $classes_str, 'has-children' ) === false
			&&
			strpos( $classes_str, 'has_children' ) === false
		) {
			return $classes;
		}

		if (
			apply_filters( 'rishi:menu:has_animated_submenu', true, $item, $args )
			||
			$depth === 0
		) {
			$classes[] = 'animated-submenu';
		}

		return $classes;
	},
	50,
	4
);

if ( ! function_exists( 'rishi__cb_customizer_handle_nav_menu_item_title' ) ) {
	function rishi__cb_customizer_handle_nav_menu_item_title( $item_output, $item, $depth, $args ) {
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', array_filter( $classes ) );

		$tag_name = ( wp_is_mobile() ) ? 'button' : 'span';

		if (
			strpos( $class_names, 'has-children' ) !== false
			||
			strpos( $class_names, 'has_children' ) !== false
		) {
			return $item_output . '<'. $tag_name . ' class="child-indicator submenu-toggle"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="5" viewBox="0 0 10 5"><path id="Polygon_5" data-name="Polygon 5" d="M5,0l5,5H0Z" transform="translate(10 5) rotate(180)"/></svg></'. $tag_name . '>';
		}

		return $item_output;
	}
}

if ( ! function_exists( 'rishi__cb_customizer_get_menus_items' ) ) {
	function rishi__cb_customizer_get_menus_items( $location = '' ) {
		$menus = array(
			'rishi__cb_customizer_location' => __( 'Default', 'rishi' ),
		);

		$all_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );

		if ( is_array( $all_menus ) && count( $all_menus ) ) {
			foreach ( $all_menus as $row ) {
				$menus[ $row->slug ] = $row->name;
			}
		}

		$result = array();

		foreach ( $menus as $id => $menu ) {
			$result[ $id ] = $menu;
		}

		return $result;
	}
}
