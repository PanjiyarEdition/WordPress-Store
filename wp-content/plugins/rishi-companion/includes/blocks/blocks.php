<?php
/**
 * Dynamic Blocks rendering.
 */
namespace Rishi_Companion\Blocks;

defined( 'ABSPATH' ) || exit;

/**
 * Renders Block.
 */
function render_block( $attributes, $block ) {
	ob_start();

	// echo json_encode( $attributes );
	include plugin_dir_path( __FILE__ ) . 'templates/' . $block . '.php';
	return ob_get_clean();
}

/**
 * Register the blocks.
 */
function register_blocks() {
	foreach ( array(
		'recent-posts',
		'posts-tab',
		'popular-posts',
		'categories',
	) as $block_name ) {
		// Register the block.
		\register_block_type(
			"rishi-blocks/{$block_name}",
			array(
				'render_callback' => function( $attributes ) use ( $block_name ) {
					return call_user_func( __NAMESPACE__ . "\\render_block", $attributes, $block_name );
				},
			)
		);
	}
}

add_action( 'init', __NAMESPACE__ . '\register_blocks' );


function filter_rest_api_query( $args, $request ) {

	if ( 'yes' === $request->get_param( 'rishi_blocks' ) ) {
		$order_by = $request->get_param( 'rishi_orderby' );
		if ( in_array( $order_by, array( 'views', 'comments' ), true ) ) {
			switch ( $order_by ) {
				case 'views':
					$args['meta_key'] = '_rishi_post_view_count';
					$args['orderby']  = 'meta_value_num';
					$args['order']    = 'DESC';
					break;

				case 'comments':
					$args['orderby'] = 'comment_count';
					$args['order']   = 'DESC';
					break;
			}
		}
	}

	return $args;
}
add_filter( 'rest_post_query', __NAMESPACE__ . '\filter_rest_api_query', 10, 2 );
