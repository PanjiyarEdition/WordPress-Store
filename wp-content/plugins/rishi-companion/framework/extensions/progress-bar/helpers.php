<?php 
function rishi_progress_bar() {
	$displayProgress   = get_theme_mod( 'displayProgress', 'post' );

	$display_top_bottom   = get_theme_mod( 'display_top_bottom','top' );

	if( $displayProgress === 'everywhere' ){ ?>
		<div data-location="<?php echo esc_attr( $display_top_bottom ); ?>" data-progress="everywhere" id="rt-progress-bar"><progress value="0"></progress></div>
	<?php }
	if( $displayProgress === 'post' && is_single() ){ ?>
		<div data-location="<?php echo esc_attr( $display_top_bottom ); ?>" data-progress="post" id="rt-progress-bar"><progress value="0"></progress></div>
	<?php }
	if( $displayProgress === 'page' && is_page() ){ ?>
		<div data-location="<?php echo esc_attr( $display_top_bottom ); ?>" data-progress="page" id="rt-progress-bar"><progress value="0"></progress></div>
	<?php }
}
add_action( 'wp_body_open', 'rishi_progress_bar',11 );