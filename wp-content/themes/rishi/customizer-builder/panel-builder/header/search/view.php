<?php


$hidden = rishi__cb_customizer_default_akg('header_hide_search', $atts, false);

if ($hidden) {
	return '';
}

$class = 'cb__header-search';

$item_visibility = rishi__cb_customizer_default_akg(
	'header_search_visibility',
	$atts,
	array(
		'tablet' => true,
		'mobile' => true,
	)
);

$class .= ' ' . rishi__cb_customizer_visibility_classes($item_visibility);


$label_class = 'cb__label';

$label_class .= ' ' . rishi__cb_customizer_visibility_classes(
	rishi__cb_get_akv(
		'search_label_visibility',
		$atts,
		array(
			'desktop' => false,
			'tablet' => false,
			'mobile' => false,
		)
	)
);

$search_label = rishi__cb_get_akv('search_label', $atts, __('Search', 'rishi'));
$search_label_position = rishi__cb_customizer_expand_responsive_value(
	rishi__cb_get_akv('search_label_position', $atts, 'left')
);

$render = new \Rishi_Header_Builder_Render();

if (!$render->contains_item('search')) {
	return;
}

$atts = $render->get_item_data_for('search');

$search_through = rishi__cb_get_akv(
	'search_through',
	$atts,
	array(
		'post' => true,
		'page' => true,
		'product' => true,
	)
);

foreach (rishi__cb_customizer_manager()->post_types->get_supported_post_types() as $single_cpt) {
	if (!isset($search_through[$single_cpt])) {
		$search_through[$single_cpt] = true;
	}
}

$rt_post_type = array();

foreach ($search_through as $single_post_type => $enabled) {
	if (!$enabled) {
		continue;
	}

	$rt_post_type[] = $single_post_type;
}

$key = rand(0, 99999);

?>
<div class="search-form-section">
	<button class="<?php echo esc_attr($class); ?> header-search-btn" data-modal-key="<?php echo esc_attr($key); ?>" data-id="search" aria-label="Search icon link" data-label="<?php echo $search_label_position[$device]; ?>" <?php echo rishi__cb_customizer_attr_to_html($attr); ?>>

		<span class="<?php echo $label_class; ?>"><?php echo $search_label; ?></span>

		<svg class="cb__icon" width="15" height="15" viewBox="0 0 15 15">
			<path d="M14.6 13L12 10.5c.7-.8 1.3-2.5 1.3-3.8 0-3.6-3-6.6-6.6-6.6C3 0 0 3.1 0 6.7c0 3.6 3 6.6 6.6 6.6 1.4 0 2.7-.6 3.8-1.2l2.5 2.3c.7.7 1.2.7 1.7.2.5-.5.5-1 0-1.6zm-8-1.4c-2.7 0-4.9-2.2-4.9-4.9s2.2-4.9 4.9-4.9 4.9 2.2 4.9 4.9c0 2.6-2.2 4.9-4.9 4.9z" />
		</svg>
	</button>
	
	<div class="search-toggle-form  cover-modal" data-modal-key="<?php echo esc_attr($key); ?>" data-modal-target-string=".search-modal">
		<div class="header-search-inner" >
			<?php
				get_search_form(array('rt_post_type' => $rt_post_type));
			?>
			<button id="btn-form-close" class="btn-form-close close"  ></button>
		</div>
	</div>
</div>