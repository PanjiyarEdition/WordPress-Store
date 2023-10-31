<?php


$hidden = rishi__cb_customizer_default_akg('header_hide_trigger', $atts, false);

if ($hidden) {
	return '';
}

$trigger_type = rishi__cb_customizer_default_akg('mobile_menu_trigger_type', $atts, 'type-1');
$trigger_design = rishi__cb_customizer_default_akg('trigger_design', $atts, 'simple');
$has_label = rishi__cb_customizer_default_akg('has_trigger_label', $atts, 'no') === 'yes';

$design = $trigger_design;

if ($has_label) {
	$trigger_label_alignment = rishi__cb_customizer_default_akg('trigger_label_alignment', $atts, 'right');
	$design .= ':' . $trigger_label_alignment;
}

$has_label_output = '';

if (!$has_label) {
	$has_label_output = 'hidden';
}

$trigger_label = rishi__cb_customizer_default_akg('trigger_label', $atts, __('Menu', 'rishi'))

?>

<a href="#offcanvas" class="cb__header-trigger toggle-btn" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".close-main-nav-toggle" data-design="<?php echo $design ?>" aria-label="<?php echo $trigger_label ?>" <?php echo rishi__cb_customizer_attr_to_html($attr) ?>>

	<span class="cb__menu-trigger" data-type="<?php echo esc_attr($trigger_type) ?>">
		<span></span>
	</span>

	<span class="cb__label" <?php echo $has_label_output ?>>
		<?php echo $trigger_label ?>
	</span>
</a>
