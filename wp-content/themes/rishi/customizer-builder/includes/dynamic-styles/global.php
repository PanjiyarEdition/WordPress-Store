<?php

rishi__cb_customizer_manager()->builder->dynamic_css('header', [
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_manager()->builder->dynamic_css('footer', [
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'typography',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'background',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'page-title/all',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'comments',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global',
	'prefixes' => rishi__cb_customizer_manager()->screen->get_single_prefixes()
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'pagination',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global',
	'prefixes' => rishi__cb_customizer_manager()->screen->get_archive_prefixes([
		'has_woocommerce' => true
	])
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'posts-listing',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global',
	'prefixes' => rishi__cb_customizer_manager()->screen->get_archive_prefixes([
		'has_categories' => true,
		'has_author' => true,
		'has_search' => true
	])
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'woocommerce',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'forms',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'all',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'single-elements',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global',
	'prefixes' => rishi__cb_customizer_manager()->screen->get_single_prefixes()
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'back-to-top',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

rishi__cb_customizer_theme_get_dynamic_styles([
	'name' => 'layouts',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'global'
]);

$supported_post_types = rishi__cb_customizer_manager()->post_types->get_supported_post_types();
$supported_post_types[] = 'single_blog_post';
$supported_post_types[] = 'single_page';

if (function_exists('is_product')) {
	$supported_post_types[] = 'product';
}

if (class_exists('bbPress')) {
	$supported_post_types[] = 'bbpress';
}


foreach ($supported_post_types as $rt_post_type) {
	if (
		$rt_post_type !== 'single_blog_post'
		&&
		$rt_post_type !== 'single_page'
		&&
		$rt_post_type !== 'product'
	) {
		$rt_post_type .= '_single';
	}

 rishi__cb_customizer_theme_get_dynamic_styles([
		'name' => 'single-content',
		'css' => $css,
		'mobile_css' => $mobile_css,
		'tablet_css' => $tablet_css,
		'context' => $context,
		'chunk' => 'single-content',
		'prefix' => $rt_post_type,
	]);
}
