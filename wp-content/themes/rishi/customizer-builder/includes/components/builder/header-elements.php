<?php

class Rishi_Header_Builder_Elements
{

	public function render_offcanvas($args = array())
	{
		$args = wp_parse_args(
			$args,
			array(
				'has_container' => true,
				'device' => 'mobile',
			)
		);

		$render = new \Rishi_Header_Builder_Render();

		if (!$render->contains_item('trigger')) {
			return '';
		}

		$mobile_content = '';
		$desktop_content = '';

		$current_layout = $render->get_current_section()['mobile'];

		foreach ($current_layout as $row) {
			if ($row['id'] !== 'offcanvas') {
				continue;
			}

			if ($render->is_row_empty($row)) {
				// return '';
			}

			$mobile_content .= $render->render_items_collection(
				$row['placements'][0]['items']
			);
		}

		$current_layout = $render->get_current_section()['desktop'];

		foreach ($current_layout as $row) {
			if ($row['id'] !== 'offcanvas') {
				continue;
			}

			$desktop_content .= $render->render_items_collection(
				$row['placements'][0]['items']
			);
		}

		$atts = $render->get_item_data_for('offcanvas');
		$row_config = $render->get_item_config_for('offcanvas');

		$class = 'cb__panel site-header';
		$behavior = 'modal';

		$position_output = array();

		if (rishi__cb_customizer_default_akg('offcanvas_behavior', $atts, 'panel') !== 'modal') {
			$behavior = rishi__cb_customizer_default_akg(
				'side_panel_position',
				$atts,
				'right'
			) . '-side';
		}

		ob_start();
		do_action('rishi:header:offcanvas:desktop:top');
		$desktop_content = ob_get_clean() . $desktop_content;

		ob_start();
		do_action('rishi:header:offcanvas:desktop:bottom');
		$desktop_content = $desktop_content . ob_get_clean();

		ob_start();
		do_action('rishi:header:offcanvas:mobile:top');
		$mobile_content = ob_get_clean() . $mobile_content;

		ob_start();
		do_action('rishi:header:offcanvas:mobile:bottom');
		$mobile_content = $mobile_content . ob_get_clean();

		$without_container = rishi__cb_html_tag(
			'div',
			array_merge(
				array(
					'class' => 'cb__panel_content',
					'data-device' => 'desktop',
				),
				is_customize_preview() ? array(
					'data-item-label' => $row_config['config']['name'],
					'data-location' => $render->get_customizer_location_for('offcanvas'),
				) : array()
			),
			$desktop_content
		) . rishi__cb_html_tag(
			'div',
			array_merge(
				array(
					'class' => 'cb__panel_content',
					'data-device' => 'mobile',
				),
				is_customize_preview() ? array(
					'data-item-label' => $row_config['config']['name'],
					'data-location' => $render->get_customizer_location_for('offcanvas'),
				) : array()
			),
			$mobile_content
		);

		$without_container = '
		<div class="cb__panel-actions">
			<button class="close-button close close-main-nav-toggle" data-toggle-target=".main-menu-modal" data-toggle-body-class="showing-main-menu-modal" aria-expanded="false" data-set-focus=".main-menu-modal">
				<span class="cb__menu-trigger closed">
					<span></span>
				</span>
			</button>
		</div>
		' . $without_container;

		$without_container = '<section class="mobile-menu-list main-menu-modal cover-modal"> <div class="mobile-menus" aria-label=' . esc_attr('Mobile', 'rishi-theme') . '>' . $without_container . '</div></section>';
		
		if (!$args['has_container']) {
			return $without_container;
		}

		return rishi__cb_html_tag(
			'div',
			array_merge(
				array(
					'id' => 'offcanvas',
					'class' => $class,
					'data-behaviour' => $behavior,
					'data-device' => $args['device'],
				),
				$position_output
			),
			$without_container
		);
	}

	public function render_search_modal()
	{
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

		$post_type = array();

		foreach ($search_through as $single_post_type => $enabled) {
			if (!$enabled) {
				continue;
			}

			$post_type[] = $single_post_type;
		}

		?>

		<div id="search-modal" class="cb__panel" data-behaviour="modal">
			<div class="cb__panel-actions">
				<div class="close-button">
					<span class="cb__menu-trigger closed">
						<span></span>
					</span>
				</div>
			</div>

			<div class="cb__panel_content">
				<?php
			get_search_form(
				array(
					'enable_search_field_class' => true,
					'rt_post_type' => $post_type,
				)
			);
			?>
			</div>
		</div>

		<?php

}

public function render_cart_offcanvas($args = array())
{
	$args = wp_parse_args(
		$args,
		array(
			'has_container' => true,
			'device' => 'mobile',
		)
	);

	$render = new \Rishi_Header_Builder_Render();

	if (!$render->contains_item('cart')) {
		return '';
	}

	if (!function_exists('woocommerce_mini_cart')) {
		return '';
	}

	$atts = $render->get_item_data_for('cart');

	$has_cart_dropdown = rishi__cb_customizer_default_akg(
		'has_cart_dropdown',
		$atts,
		'yes'
	) === 'yes';

	$cart_drawer_type = rishi__cb_customizer_default_akg('cart_drawer_type', $atts, 'dropdown');

	if (!$has_cart_dropdown) {
		return;
	}

	if ($cart_drawer_type !== 'offcanvas') {
		return;
	}

	ob_start();
	woocommerce_mini_cart();
	$content = ob_get_clean();

	$class = 'cb__panel';
	$behavior = 'modal';

	$position_output = array();

	if (rishi__cb_customizer_default_akg('offcanvas_behavior', $atts, 'panel') !== 'modal') {
		$behavior = rishi__cb_customizer_default_akg(
			'side_panel_position',
			$atts,
			'right'
		) . '-side';
	}

	$without_container = rishi__cb_html_tag(
		'div',
		array_merge(
			array(
				'class' => 'cb__panel_content',
			)
		),
		$content
	);

	if (!$args['has_container']) {
		return $without_container;
	}

	return rishi__cb_html_tag(
		'div',
		array_merge(
			array(
				'id' => 'woo-cacb__panel',
				'class' => $class,
				'data-behaviour' => $behavior,
			),
			$position_output
		),
		'<section class="mobile-menu-list main-menu-modal cover-modal">
				<div class="mobile-menu" aria-label=' . esc_attr('Mobile', 'rishi-theme') . '>
					<div class="cb__panel-actions">
						<h6>' . __('Shopping Cart', 'rishi') . '</h6>

						<div class="close-button">
							<span class="cb__menu-trigger closed">
								<span></span>
							</span>
						</div>
					</div>
				'
			. $without_container .
			'</div>

				</section>'
	);
}
}
