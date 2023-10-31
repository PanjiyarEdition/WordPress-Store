<?php
/**
 * Search form
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */

$placeholder = esc_attr_x('Search', 'placeholder', 'rishi');

if (isset($args['search_placeholder'])) {
	$placeholder = $args['search_placeholder'];
}

if (isset($args['search_live_results'])) {
	$has_live_results = $args['search_live_results'];
} else {
	$has_live_results = get_theme_mod('search_enable_live_results', 'yes');
}

$search_live_results_output = '';

if ($has_live_results === 'yes') {
	if (! isset($args['live_results_attr'])) {
		$args['live_results_attr'] = 'thumbs';
	}

	$search_live_results_output = 'data-live-results="' . $args['live_results_attr'] . '"';
}

$class_output = '';

$any = [];

if (
	isset($args['rt_post_type'])
	&&
	$args['rt_post_type']
) {
	$any = $args['rt_post_type'];
}

$home_url = home_url('');

if (function_exists('pll_home_url')) {
	$home_url = pll_home_url();
}

?>
<form autocomplete="off" role="search" method="get"
	class="search-form"
	action="<?php echo esc_url($home_url); ?>"
	<?php echo wp_kses_post($search_live_results_output) ?>
	>
	<label>
		<span class="screen-reader-text"><?php echo esc_html__( "Search for:", "rishi" ) ?></span>
		<input type="search" class="search-field" placeholder="<?php echo $placeholder; ?>"  value="<?php echo get_search_query(); ?>" name="s" title="<?php echo __('Search Input', 'rishi') ?>" />
		<?php if (count($any) === 1) { ?>
			<input type="hidden" name="post_type" value="<?php echo $any[0] ?>">
		<?php } ?>

		<?php if (count($any) > 1) { ?>
			<input type="hidden" name="rt_post_type" value="<?php echo implode(':', $any) ?>">
		<?php } ?>
	</label>
	<input type="submit" class="search-submit" value="<?php esc_attr_e( "Search", "rishi" ) ?>">
</form>
