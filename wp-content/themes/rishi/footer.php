<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rishi
 */

/**
 * After Content
 * 
 * @hooked rishi_content_end - 20
 */
do_action('rishi_before_footer');

do_action('rishi:footer:before');

/**
 * Footer
 * 
 * @hooked rishi__cb_customizer_output_footer - 20
 */
do_action( 'rishi__cb_footer_output' );

do_action('rishi:footer:after');

/**
 * After Footer
 * 
 * @hooked rishi_page_end    - 20
 * @hooked rishi_scrolltotop - 30
 */
do_action('rishi_after_footer');

echo '</div>';

wp_footer(); ?>

</body>

</html>
