<?php

$maybe_taxonomy = rishi__cb_get_matching_taxonomy( $post_type->name, false );

$options = array(
	array(
		'post_title_panel'       => array(
			'label'         => __( 'Post Title', 'rishi' ),
			'type'          => 'rt-panel',
			'wrapperAttr'   => array( 'data-label' => 'heading-label' ),
			'setting'       => array( 'transport' => 'postMessage' ),
			'inner-options' => array(

			 rishi__cb_customizer_get_options(
					'general/page-title',
					array(
						'has_default' => true,
						'is_single'   => true,
					)
				),

			),
		),

	 rishi__cb_customizer_rand_md5() => array(
			'type'  => 'rt-title',
			'label' => __( 'Post Structure', 'rishi' ),
		),

	 rishi__cb_customizer_rand_md5() => array(
			'title'   => __( 'General', 'rishi' ),
			'type'    => 'tab',
			'options' => array(
				'page_structure_type'     => array(
					'label'   => false,
					'type'    => 'rt-image-picker',
					'value'   => 'default',
					'design'  => 'block',
					'attr'    => array(
						'data-type'  => 'background',
						'data-state' => 'sync',
					),
					'setting' => array( 'transport' => 'postMessage' ),
					'choices' => array(
						'default' => array(
							'src'   => rishi__cb_customizer_image_picker_url( 'default.svg' ),
							'title' => __( 'Inherit from customizer', 'rishi' ),
						),

						'type-3'  => array(
							'src'   => rishi__cb_customizer_image_picker_url( 'narrow.svg' ),
							'title' => __( 'Narrow Width', 'rishi' ),
						),

						'type-4'  => array(
							'src'   => rishi__cb_customizer_image_picker_url( 'normal.svg' ),
							'title' => __( 'Normal Width', 'rishi' ),
						),

						'type-2'  => array(
							'src'   => rishi__cb_customizer_image_picker_url( 'left-single-sidebar.svg' ),
							'title' => __( 'Left Sidebar', 'rishi' ),
						),

						'type-1'  => array(
							'src'   => rishi__cb_customizer_image_picker_url( 'right-single-sidebar.svg' ),
							'title' => __( 'Right Sidebar', 'rishi' ),
						),
					),
				),

			 rishi__cb_customizer_rand_md5()  => array(
					'type' => 'rt-divider',
				),

				'content_style_source'    => array(
					'label'   => __( 'Content Area Style Source', 'rishi' ),
					'type'    => 'rt-radio',
					'value'   => 'inherit',
					'view'    => 'text',
					'choices' => array(
						'inherit' => __( 'Inherit', 'rishi' ),
						'custom'  => __( 'Custom', 'rishi' ),
					),
				),

			 rishi__cb_customizer_rand_md5()  => array(
					'type'      => 'rt-condition',
					'condition' => array( 'content_style_source' => 'custom' ),
					'options'   => array(
						'content_style' => array(
							'label'      => __( 'Content Area Style', 'rishi' ),
							'type'       => 'rt-radio',
							'value'      => 'wide',
							'view'       => 'text',
							'design'     => 'block',
							'responsive' => true,
							'choices'    => array(
								'wide'  => __( 'Wide', 'rishi' ),
								'boxed' => __( 'Boxed', 'rishi' ),
							),
						),
					),
				),

				'vertical_spacing_source' => array(
					'label'   => __( 'Content Area Vertical Spacing', 'rishi' ),
					'type'    => 'rt-radio',
					'value'   => 'inherit',
					'view'    => 'text',
					'divider' => 'top',
					'choices' => array(
						'inherit' => __( 'Inherit', 'rishi' ),
						'custom'  => __( 'Custom', 'rishi' ),
					),
				),

			 rishi__cb_customizer_rand_md5()  => array(
					'type'      => 'rt-condition',
					'condition' => array( 'vertical_spacing_source' => 'custom' ),
					'options'   => array(

						'content_area_spacing' => array(
							'label'               => false,
							'desc'                => __( 'You can customize the spacing value in general settings panel.', 'rishi' ),
							'type'                => 'rt-radio',
							'value'               => 'both',
							'view'                => 'text',
							'design'              => 'block',
							'disableRevertButton' => true,
							'attr'                => array( 'data-type' => 'content-spacing' ),
							'setting'             => array( 'transport' => 'postMessage' ),
							'choices'             => array(
								'both'   => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Top & Bottom', 'rishi' ) . '</i>',

								'top'    => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Only Top', 'rishi' ) . '</i>',

								'bottom' => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Only Bottom', 'rishi' ) . '</i>',

								'none'   => '<span></span>
								<i class="rt-tooltip-top">' . __( 'Disabled', 'rishi' ) . '</i>',
							),
							'desc'                => sprintf(
								// translators: placeholder here means the actual URL.
								__( 'You can customize the global spacing value in General ➝ Layout ➝ %1$sContent Area Spacing%2$s.', 'rishi' ),
								sprintf(
									'<a data-trigger-section="general" href="%s">',
									admin_url( '/customize.php?autofocus[section]=general&rt_autofocus=general:layout_panel' )
								),
								'</a>'
							),
						),

					),
				),
			),
		),

	 rishi__cb_customizer_rand_md5() => array(
			'title'   => __( 'Design', 'rishi' ),
			'type'    => 'tab',
			'options' => array(
			 rishi__cb_customizer_get_options( 'single-elements/structure-design' ),
			),
		),

	 rishi__cb_customizer_rand_md5() => array(
			'type'  => 'rt-title',
			'label' => __( 'Post Elements', 'rishi' ),
		),

		'disable_featured_image' => array(
			'label' => __( 'Disable Featured Image', 'rishi' ),
			'type'  => 'rara-switch',
			'value' => 'no',
		),
	),

	$maybe_taxonomy ? array(
		'disable_post_tags' => array(
			'label' => sprintf(
				__( 'Disable %1$s %2$s', 'rishi' ),
				$post_type->labels->singular_name,
				get_taxonomy( $maybe_taxonomy )->label
			),
			'type'  => 'rara-switch',
			'value' => 'no',
		),
	) : array(),

	array(
		'disable_share_box'        => array(
			'label' => __( 'Disable Share Box', 'rishi' ),
			'type'  => 'rara-switch',
			'value' => 'no',
		),

		'disable_author_box'       => array(
			'label' => __( 'Disable Author Box', 'rishi' ),
			'type'  => 'rara-switch',
			'value' => 'no',
		),

		'disable_posts_navigation' => array(
			'label' => __( 'Disable Posts Navigation', 'rishi' ),
			'type'  => 'rara-switch',
			'value' => 'no',
		),

	 rishi__cb_customizer_rand_md5()   => array(
			'type'  => 'rt-title',
			'label' => __( 'Page Elements', 'rishi' ),
		),

		'disable_related_posts'    => array(
			'label' => __( 'Disable Related Posts', 'rishi' ),
			'type'  => 'rara-switch',
			'value' => 'no',
		),

		'disable_header'           => array(
			'label' => __( 'Disable Header', 'rishi' ),
			'type'  => 'rara-switch',
			'value' => 'no',
		),

		'disable_footer'           => array(
			'label' => __( 'Disable Footer', 'rishi' ),
			'type'  => 'rara-switch',
			'value' => 'no',
		),
	),

	apply_filters(
		'rishi__cb_customizer_extensions_metabox_post_bottom',
		array()
	),
);
