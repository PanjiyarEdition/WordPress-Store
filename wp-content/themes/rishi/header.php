<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rishi
 */
/**
 * Doctype Hook
 * 
 * @hooked rishi_doctype
 */
do_action('rishi_doctype');
?>

<head <?php echo rishi__cb_customizer_schema_org_definitions( 'head' ); ?>>
    <?php do_action('rishi:head:start'); ?>
    <?php
    /**
     * Before wp_head
     * 
     * @hooked rishi_head
     */
    do_action('rishi_before_wp_head');

    wp_head(); ?>
    <?php do_action('rishi:head:end'); ?>
</head>

<body <?php body_class();
        echo rishi__cb_customizer_schema_org_definitions( 'body' );
        if (function_exists('rishi__cb_customizer_body_attr')) {
            echo rishi__cb_customizer_body_attr();
        }
        ?>>
    <?php

    wp_body_open();

    /**
     * Before Header
     * 
     * @hooked rishi_page_start - 20 
     */
    do_action('rishi_before_header');

    do_action('rishi:header:before');

    if ( defined( 'RISHI_CUSTOMIZER_BUILDER_DIR__' ) && ! ! RISHI_CUSTOMIZER_BUILDER_DIR__ ) {
		do_action( 'rishi__cb_header_output' );
	}

    do_action('rishi:header:after');

    /**
     * After Header
    */
    do_action( 'rishi_after_header' );

    /**
     * Content
     * 
     * @hooked rishi_content_start
     */
    do_action('rishi_content');
