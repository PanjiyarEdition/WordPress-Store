<?php

if (!function_exists('rishi__cb_customizer_has_schema_org_markup')) {
	function rishi__cb_customizer_has_schema_org_markup(  )
	{
		return get_theme_mod('enable_schema_org_markup', 'yes') === 'yes';
	}
}

if (!function_exists('rishi__cb_customizer_schema_org_definitions')) {
	function rishi__cb_customizer_schema_org_definitions( $place, $args = [] )
	{
		$args = wp_parse_args(
			$args,
			[
				'array' => false
			]
		);

		$value = [];

		if ( ! rishi__cb_customizer_has_schema_org_markup() == 'yes' ) {
			if ($args['array']) {
				return $value;
			}

			return rishi__cb_customizer_attr_to_html($value);
		}

		if ($place === 'head') {
			$value = [
				'itemscope' => '',
				'itemtype' => 'http://schema.org/WebSite'
			];
		}
		
		if ($place === 'body') {
			$type = 'WebPage';

			if (is_home() || is_archive() || is_attachment() || is_tax() || is_single()) {
				$type = 'Blog';
			}

			if (is_search()) {
				$type = 'SearchResultsPage';
			}

			$type = apply_filters('rishi__cb_body_itemtype', $type);

			$value = [
				'itemscope' => '',
				'itemtype' => sprintf( 'http://schema.org/%s', esc_html($type) )
			];
		}

		if ($place === 'single') {
			if (is_page()) {
				$value = [
					'itemscope' => 'itemscope',
					'itemtype' => 'http://schema.org/WebPage'
				];
			} else if (is_single()) {
				$value = [
					'itemscope' => 'itemscope',
					'itemtype' => 'https://schema.org/Blog'
				];
			}
		}

		if ($place === 'creative_work') {
			$value = [
				'itemscope' => '',
				'itemtype' => 'https://schema.org/CreativeWork'
			];
		}

		if ($place === 'header') {
			$value = [
				'itemscope' => '',
				'itemtype' => 'https://schema.org/WPHeader'
			];
		}

		if ($place === 'logo') {
			$value = [
				'itemscope' => 'itemscope',
				'itemtype' => 'https://schema.org/Organization'
			];
		}

		// Navigation
		if ($place === 'navigation') {
			$value = [
				'itemscope' => '',
				'itemtype' => 'http://schema.org/SiteNavigationElement'
			];
		}

		if ($place === 'breadcrumb') {
			$value = [
				'itemscope' => '',
				'itemtype' => 'http://schema.org/BreadcrumbList'
			];
		}

		// if ($place === 'breadcrumb_list') {
		// 	$value = [
		// 		'itemprop' => 'itemListElement',
		// 		'itemscope' => '',
		// 		'itemtype' => 'http://schema.org/ListItem'
		// 	];
		// }

		if ($place === 'breadcrumb_itemprop') {
			$value = [
				'itemprop' => 'breadcrumb',
			];
		}

		if ($place === 'sidebar') {
			$value = [
				'itemtype' => 'https://schema.org/WPSideBar',
				'itemscope' => '',
				'role' => 'complementary'
			];
		}

		if ($place === 'footer') {
			$value = [
				'itemscope' => '',
				'itemtype' => 'https://schema.org/WPFooter'
			];
		}

		if ($place === 'headline') {
			$value = [
				'itemprop' => 'headline'
			];
		}

		if ($place === 'entry_content') {
			$value = [
				'itemprop' => 'text'
			];
		}

		if ($place === 'publish_date') {
			$value = [
				'itemprop' => 'datePublished'
			];
		}

		if ($place === 'modified_date') {
			$value = [
				'itemprop' => 'dateModified'
			];
		}

		if ($place === 'author_name') {
			$value = [
				'itemprop' => 'name'
			];
		}

		if ($place === 'author_link') {
			$value = [
				'itemprop' => 'author',
			];
		}

		if ($place === 'publisher') {
			$value = [
				'itemprop' => 'publisher'
			];
		}

		if ($place === 'item') {
			$value = [
				'itemprop' => 'item'
			];
		}

		if ($place === 'url') {
			$value = [
				'itemprop' => 'url'
			];
		}

		if ($place === 'name') {
			$value = [
				'itemprop' => 'name'
			];
		}

		if ($place === 'description') {
			$value = [
				'itemprop' => 'description'
			];
		}

		if ($place === 'position') {
			$value = [
				'itemprop' => 'position'
			];
		}

		if ($place === 'image') {
			$value = [
				'itemprop' => 'image'
			];
		}

		if ($place === 'breadcrumb_list') {
			$value = [
				'itemscope' => '',
				'itemtype' => "http://schema.org/BreadcrumbList"
			];
		}

		if ($place === 'breadcrumb_item') {
			$value = [
				'itemscope' => '',
				'itemprop' => "itemListElement",
				'itemtype' => "http://schema.org/ListItem"
			];
		}

		if ($place === 'person') {
			$value = [
				'itemscope' => '',
				'itemtype' => "http://schema.org/Person"
			];
		}

		if ($place === 'comment-body') {
			$value = [
				'itemscope' => '',
				'itemtype' => "https://schema.org/UserComments"
			];
		}

		if ($place === 'comment-author') {
			$value = [
				'itemprop' => 'creator',
				'itemscope' => '',
				'itemtype' => "https://schema.org/Person"
			];
		}

		if ($args['array']) {
			return $value;
		}

		return rishi__cb_customizer_attr_to_html($value);
	}
}
