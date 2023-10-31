<?php

$options = [
	'header_general_section_options' => [
		'type' => 'rt-options',
		'setting' => ['transport' => 'postMessage'],
		'customizer_section' => 'layout',
		'inner-options' => [
			'header_placements' => [
				'type' => 'rt-header-builder',
				'setting' => ['transport' => 'postMessage'],
				'value' => rishi__cb_customizer_manager()->header_builder->get_default_value(),
				'selective_refresh' => apply_filters('rishi:header:selective_refresh', [
					[
						'id' => 'header_placements_1',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => '#main-container > header',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render() used here escapes the value properly.
							 */
							echo rishi__cb_customizer_manager()->header_builder->render();
						}
					],

					[
						'id' => 'header_placements_offcanvas',
						'fallback_refresh' => false,
						'container_inclusive' => false,
						'selector' => '#offcanvas',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							$elements = new \Rishi_Header_Builder_Elements();
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_offcanvas() used here escapes the value properly.
							 */
							echo $elements->render_offcanvas([
								'has_container' => false
							]);
						}
					],

					[
						'id' => 'header_placements_item:menu',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => '#main-container > header',
						'loader_selector' => '[data-id="menu"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render() used here escapes the value properly.
							 */
							echo rishi__cb_customizer_manager()->header_builder->render();
						}
					],

					[
						'id' => 'header_placements_item:cart',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => 'header [data-id="cart"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							$header = new \Rishi_Header_Builder_Render();
							echo $header->render_single_item('cart');
						}
					],

					[
						'id' => 'header_placements_item:menu-secondary',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => '#main-container > header',
						'loader_selector' => '[data-id="menu-secondary"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render() used here escapes the value properly.
							 */
							echo rishi__cb_customizer_manager()->header_builder->render();
						}
					],

					[
						'id' => 'header_placements_item:mobile-menu',
						'fallback_refresh' => false,
						'container_inclusive' => false,
						'selector' => '#offcanvas',
						'loader_selector' => '[data-id="mobile-menu"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							$elements = new \Rishi_Header_Builder_Elements();
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_offcanvas() used here escapes the value properly.
							 */
							echo $elements->render_offcanvas([
								'has_container' => false
							]);
						}
					],

					[
						'id' => 'header_placements_item:logo:desktop',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => '[data-device="desktop"] [data-id="logo"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							$b = new \Rishi_Header_Builder_Render();
							echo $b->render_single_item('logo');
						}
					],

					[
						'id' => 'header_placements_item:date',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => 'header [data-id="date"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							$header = new \Rishi_Header_Builder_Render();
							echo $header->render_single_item('date');
						}
					],

					[
						'id' => 'header_placements_item:time',
						'fallback_refresh' => true,
						'container_inclusive' => true,
						'selector' => 'header [data-id="time"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							$header = new \Rishi_Header_Builder_Render();
							echo $header->render_single_item('time');
						}
					],

					[
						'id' => 'header_placements_item:randomize',
						'fallback_refresh' => true,
						'container_inclusive' => true,
						'selector' => 'header [data-id="randomize"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							$header = new \Rishi_Header_Builder_Render();
							echo $header->render_single_item('randomize');
						}
					],

					[
						'id' => 'header_placements_item:image',
						'fallback_refresh' => true,
						'container_inclusive' => true,
						'selector' => 'header [data-id="image"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							$header = new \Rishi_Header_Builder_Render();
							echo $header->render_single_item('image');
						}
					],

					[
						'id' => 'header_placements_item_mobile:logo:mobile',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => '[data-device="mobile"] [data-id="logo"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							$b = new \Rishi_Header_Builder_Render();
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							echo $b->render_single_item('logo', [
								'device' => 'mobile'
							]);
						}
					],

					[
						'id' => 'header_placements_item:contacts',
						'fallback_refresh' => false,
						'container_inclusive' => true,
						'selector' => 'header [data-id="contacts"]',
						'settings' => ['header_placements'],
						'render_callback' => function () {
							/**
							 * Note to code reviewers: This line doesn't need to be escaped.
							 * Function render_single_item() used here escapes the value properly.
							 */
							$header = new \Rishi_Header_Builder_Render();
							echo $header->render_single_item('contacts');
						}
					]
				]),
			],
		]
	],
];
