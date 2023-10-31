<?php
/**
 * Container Options
 */

$defaults = rishi__cb__get_layout_defaults();

$options = [
    'layout_container_panel' => [
        'label'         => __('Container', 'rishi'),
        'type'          => 'rt-panel',
        'setting'       => ['transport' => 'postMessage'],
        'inner-options' => apply_filters( 'rishi__cb_:layouts:inneroptions', [
            'container_width' => [
                'label' => __('Container Width', 'rishi'),
                'desc'  => __('This setting sets the container width of the site.', 'rishi'),
                'type'  => 'rt-slider',
                'value' => [
                    'desktop' => $defaults['container_width']['desktop'],
                    'tablet'  => $defaults['container_width']['tablet'],
                    'mobile'  => $defaults['container_width']['mobile'],
                ],
                'units' => rishi__cb_customizer_units_config([
                    ['unit' => 'px', 'min' => 0, 'max' => 1900],
                ]),
                'responsive' => true,
                'setting'    => ['transport' => 'postMessage'],
            ],
            'layout' => [
                'label'   => __('Layout', 'rishi'),
                'type'    => 'rt-select',
                'value'   => $defaults['layout'],
                'view'    => 'text',
                'design'  => 'inline',
                'divider' => 'top',
                'choices' => rishi__cb_customizer_ordered_keys([
                    'boxed'                => __('Boxed', 'rishi'),
                    'content_boxed'        => __('Content Boxed', 'rishi'),
                    'full_width_contained' => __('Unboxed', 'rishi'),
                ]),
                'desc' => __('Choose the default site layout.', 'rishi'),
            ],
            'container_content_max_width' => [
                'label' => __('Fullwidth Centered Max-width', 'rishi'),
                'desc'  => __('This setting sets the container width for a Fullwidth Centered layout.', 'rishi'),
                'type'  => 'rt-slider',
                'value' => [
                    'desktop' => $defaults['container_content_max_width']['desktop'],
                    'tablet'  => $defaults['container_content_max_width']['tablet'],
                    'mobile'  => $defaults['container_content_max_width']['mobile'],
                ],
                'units' => rishi__cb_customizer_units_config([
                    ['unit' => 'px', 'min' => 0, 'max' => 1170],
                ]),
                'responsive' => true,
                'divider'    => 'top',
                'setting'    => ['transport' => 'postMessage'],
            ],
            'containerVerticalMargin' => [
                'label'   => __( 'Container Vertical Spacing', 'rishi' ),
                'type'  => 'rt-slider',
                'value' => [
                    'desktop' => $defaults['containerVerticalMargin']['desktop'],
                    'tablet'  => $defaults['containerVerticalMargin']['tablet'],
                    'mobile'  => $defaults['containerVerticalMargin']['mobile'],
                ],
                'units' => rishi__cb_customizer_units_config([
                    ['unit' => 'px', 'min' => 0, 'max' => 250],
                ]),
                'responsive' => true,
                'divider'    => 'top',
                'setting'    => ['transport' => 'postMessage'],
                'desc'       => __('This setting sets the spacing at the top and bottom of the container.', 'rishi'),

            ],
            'containerStrechedPadding' => [
                'label'   => __( 'Container Stretched Padding', 'rishi' ),
                'type'  => 'rt-slider',
                'value' => [
                    'desktop' => '40px',
                    'tablet'  => '30px',
                    'mobile'  => '15px',
                ],
                'units' => rishi__cb_customizer_units_config([
                    ['unit' => 'px', 'min' => 0, 'max' => 250],
                ]),
                'responsive' => true,
                'divider'    => 'top',
                'setting'    => ['transport' => 'postMessage'],
                'desc'       => __('This setting sets the spacing at the left and right of the container when the Stretch layout is enabled.', 'rishi'),
            ],
        ]),
    ],
];
