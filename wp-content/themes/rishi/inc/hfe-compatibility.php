<?php
/**
 * Header Footer Elementor Compatibility
 * 
 * @package Rishi
*/

if( ! function_exists( 'rishi_remove_header_and_footer' ) ) :
/**
 * Removing header and footer from theme.
 */
function rishi_remove_header_and_footer(){
    remove_action( 'rishi_header', 'rishi__cb_customizer_output_header', 20 );
    remove_action( 'rishi_footer', 'rishi__cb_customizer_output_footer', 20 );
}
endif;
add_action( 'init', 'rishi_remove_header_and_footer' ); 

if( ! function_exists( 'rishi_render_hfe_header' ) ) :
/**
 * Header
 */
function rishi_render_hfe_header() {	
	if ( function_exists( 'hfe_render_header' ) ) {
		hfe_render_header();
	}
}
endif;
add_action( 'rishi_header', 'rishi_render_hfe_header' );

if( ! function_exists( 'rishi_render_hfe_footer' ) ) :
/**
 * Header
 */
function rishi_render_hfe_footer() {	
    if ( function_exists( 'hfe_render_footer' ) ) {
        hfe_render_footer();
    }
}
endif;
add_action( 'rishi_footer', 'rishi_render_hfe_footer' );

if( ! function_exists( 'rishi_header_footer_elementor_support' ) ) :
/**
 * Theme Support for header footer elementor.
 */
function rishi_header_footer_elementor_support() {
	add_theme_support( 'header-footer-elementor' );
}
endif;
add_action( 'after_setup_theme', 'rishi_header_footer_elementor_support' );
