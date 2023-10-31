<?php

$options = array(
	'footer_general_section_options' => array(
		'type'               => 'rt-options',
		'setting'            => array( 'transport' => 'postMessage' ),
		'customizer_section' => 'layout',
		'inner-options'      => array(
			'footer_placements' => array(
				'type'              => 'rt-footer-builder',
				'setting'           => array( 'transport' => 'postMessage' ),
				'value'             => rishi__cb_customizer_manager()->footer_builder->get_default_value(),
				'selective_refresh' => apply_filters(
					'rishi:footer:selective_refresh',
					array(
						array(
							'id'                  => 'footer_placements_1',
							'fallback_refresh'    => false,
							'container_inclusive' => true,
							'selector'            => '#main-container > footer.cb__footer',
							'settings'            => array( 'footer_placements' ),
							'render_callback'     => function () {
								/**
								 * Note to code reviewers: This line doesn't need to be escaped.
								 * Function render() used here escapes the value properly.
								 */
								echo rishi__cb_customizer_manager()->footer_builder->render();
							},
						),

						array(
							'id'                  => 'footer_placements_item:menu',
							'fallback_refresh'    => false,
							'container_inclusive' => true,
							'selector'            => '#main-container > footer.cb__footer',
							'loader_selector'     => '.footer-menu',
							'settings'            => array( 'footer_placements' ),
							'render_callback'     => function () {
								/**
								 * Note to code reviewers: This line doesn't need to be escaped.
								 * Function render() used here escapes the value properly.
								 */
								echo rishi__cb_customizer_manager()->footer_builder->render();
							},
						),

						array(
							'id'                  => 'footer_placements_item:logo',
							'fallback_refresh'    => false,
							'container_inclusive' => true,
							'selector'            => '.cb__footer [data-id="logo"]',
							'settings'            => array( 'footer_placements' ),
							'render_callback'     => function () {
								/**
								 * Note to code reviewers: This line doesn't need to be escaped.
								 * Function render_single_item() used here escapes the value properly.
								 */
								$b = new \Rishi_Footer_Builder_Render();
								echo $b->render_single_item( 'logo' );
							},
						),
						array(
							'id'                  => 'footer_placements_item:contacts',
							'fallback_refresh'    => false,
							'container_inclusive' => true,
							'selector'            => '.cb__footer [data-id="contacts"]',
							'settings'            => array( 'footer_placements' ),
							'render_callback'     => function () {
								/**
								 * Note to code reviewers: This line doesn't need to be escaped.
								 * Function render_single_item() used here escapes the value properly.
								 */
								$footer = new \Rishi_Footer_Builder_Render();
								echo $footer->render_single_item( 'contacts' );
							},
						),
					)
				),
			),
		),
	),
);
