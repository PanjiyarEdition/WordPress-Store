<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rishi
 */

$sidebar = rishi_sidebar();

if ( ! $sidebar ) {
	return;
}
?>

<aside id="secondary" class="widget-area" <?php echo rishi__cb_customizer_schema_org_definitions( 'sidebar' ); ?>>
	<?php do_action('rishi:sidebar:before'); ?>
	<div class="sidebar-wrap-main">
		<?php dynamic_sidebar( $sidebar ); ?>
	</div>
	<?php do_action('rishi:sidebar:after'); ?>
</aside><!-- #secondary -->