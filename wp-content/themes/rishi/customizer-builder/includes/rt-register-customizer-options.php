<?php

/**
 * Register Customizer Options.
 *
 * @param [type] $wp_customize
 * @param [type] $options
 * @param array $settings
 * @return void
 */
function rishi__cb_customizer_customizer_register_options(
    $wp_customize,
    $options,
    $settings = []
) {
    $settings = wp_parse_args(
        $settings,
        [
            'has_controls'            => true,
            'parent_data'             => [],
            'include_container_types' => true,
            'limit_level'             => 1
        ]
    );

    $collected = [];

  rishi__cb_customizer_collect_options(
        $collected,
        $options,
        [
            'limit_option_types'      => false,
            'limit_level'             => $settings['limit_level'],
            'include_container_types' => $settings['include_container_types'],
            'info_wrapper'            => true,
        ]
    );

    if (empty($collected)) {
        return;
    }

    foreach ($collected as &$opt) {
        if (
            isset($opt['option']['type'])
            &&
            'rt-group-title' === $opt['option']['type']
        ) {
            $wp_customize->add_section(
                new \Rishi_Group_Title($wp_customize, $opt['id'], $opt['option'])
            );

            continue;
        }

        if ('container' === $opt['group']) {
            // Check if has container options.
            $_collected = [];

          rishi__cb_customizer_collect_options(
                $_collected,
                $opt['option']['options'],
                [
                    'limit_option_types' => [],
                    'limit_level'        => 1,
                    'info_wrapper'       => false,
                ]
            );

            $has_containers = !empty($_collected);
            unset($_collected);

            $children_data = [
                'group' => 'container',
                'id'    => $opt['id'],
            ];

            $args = [
                'title' => empty($opt['option']['title'])
                    ? rishi__cb_customizer_id_to_title($opt['id'])
                    : $opt['option']['title'],
                'description' => empty($opt['option']['desc'])
                    ? ''
                    : $opt['option']['desc'],
            ];

            if (isset($opt['option']['container']) && is_array($opt['option']['container'])) {
                $args = array_merge($opt['option']['container'], $args);
            }

            if ($has_containers) {
                if ($settings['parent_data']) {
                    // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
                    trigger_error(
                        esc_html($opt['id']) . ' panel can\'t have a parent (' . esc_html($settings['parent_data']['id']) . ')',
                        E_USER_WARNING
                    );
                    break;
                }

                if (!isset($opt['option']['only_if_exists'])) {
                    $wp_customize->add_panel($opt['id'], $args);
                }

                $children_data['customizer_type'] = 'panel';
            } else {
                if ($settings['parent_data']) {
                    if ('panel' === $settings['parent_data']['customizer_type']) {
                        $args['panel'] = $settings['parent_data']['id'];
                    } else {
                        // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
                        trigger_error(
                            esc_html($opt['id']) . ' section can have only panel parent (' . esc_html($settings['parent_data']['id']) . ')',
                            E_USER_WARNING
                        );

                        break;
                    }
                }

                $wp_customize->add_section($opt['id'], $args);
                $children_data['customizer_type'] = 'section';
            }

          rishi__cb_customizer_customizer_register_options(
                $wp_customize,
                $opt['option']['options'],
                [
                    'parent_data' => $children_data
                ]
            );

            unset($children_data);
            continue;
        }

        if ('option' === $opt['group']) {
            if (
                /*
				(
					$opt['option']['type'] === 'rt-panel'
					||
					$opt['option']['type'] === 'rt-options'
				)
				&&
				 */
                isset($opt['option']['inner-options'])
            ) {
                $options_to_send = null;

              rishi__cb_customizer_collect_options(
                    $options_to_send,
                    $opt['option']['inner-options'],
                    ['include_container_types' => false]
                );

              rishi__cb_customizer_customizer_register_options(
                    $wp_customize,
                    $options_to_send,
                    ['has_controls' => false]
                );
            }

            $args_control = [
                'label' => empty($opt['option']['label'])
                    ? rishi__cb_customizer_id_to_title($opt['id'])
                    : $opt['option']['label'],
                'description' => empty($opt['option']['desc'])
                    ? ''
                    : $opt['option']['desc'],
                'settings' => $opt['id'],
                'type' => $opt['option']['type'],
            ];

            if (isset($opt['option']['control']) && is_array($opt['option']['control'])) {
                $args_control = array_merge($opt['option']['control'], $args_control);
            }

            $args_control = array_merge($opt['option'], $args_control);

            if ($settings['parent_data']) {
                if ('section' === $settings['parent_data']['customizer_type']) {
                    $args_control['section'] = $settings['parent_data']['id'];
                } else {
                    // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
                    trigger_error(
                        'Invalid control parent: ' . esc_html($settings['parent_data']['customizer_type']),
                        E_USER_WARNING
                    );

                    break;
                }
            }

            $args_setting = [
                'default' => isset($opt['option']['value']) ? $opt['option']['value'] : ' ',
            ];

            $opt['option'] = rishi__cb_customizer_include_sanitizer($opt['option']);

            /**
             * Sync for options
             *
             * refresh | partial | live
             */
            if (isset($opt['option']['sync'])) {
                if (
                    $opt['option']['sync'] === 'live'
                    ||
                    is_array($opt['option']['sync'])
                ) {
                    if (
                        !isset($opt['option']['setting'])
                        ||
                        !is_array($opt['option']['setting'])
                    ) {
                        $opt['option']['setting'] = [];
                    }

                    $opt['option']['setting']['transport'] = 'postMessage';
                }

                if (is_array($opt['option']['sync'])) {
                    $all_syncs = $opt['option']['sync'];

                    if (!isset($all_syncs[0])) {
                        $all_syncs = [$all_syncs];
                    }

                    $opt['option']['selective_refresh'] = [];

                    foreach ($all_syncs as $index => $single_sync) {
                        $local_sync = wp_parse_args(
                            $single_sync,
                            [
                                'prefix' => '',
                                'selector' => '',
                                'loader_selector' => '',
                                'render' => null,
                                'id' => $opt['id'],
                                'container_inclusive' => true
                            ]
                        );

                        if (
                            !isset($local_sync['render'])
                            &&
                            $index > 0
                            &&
                            isset($all_syncs[0]['render'])
                            &&
                            isset($all_syncs[0]['selector'])
                        ) {
                            $local_sync['render'] = $all_syncs[0]['render'];
                            $local_sync['selector'] = $all_syncs[0]['selector'];
                        }

                        if (!$local_sync['render']) {
                            continue;
                        }

                        $local_sync['prefix'] = trim($local_sync['prefix'], '_');

                        $selector = $local_sync['selector'];

                        if (!empty( rishi__cb_customizer_prefix_selector('', $local_sync['prefix']))) {
                            $prefix_selector = rishi__cb_customizer_prefix_selector(
                                '',
                                $local_sync['prefix']
                            );

                            if (is_array($prefix_selector)) {
                                foreach ($prefix_selector as $index => $single_prefix_selector) {
                                    $prefix_selector[$index] = $single_prefix_selector . ' ' . $local_sync['selector'];
                                }

                                $selector = implode(', ', $prefix_selector);
                            } else {
                                $selector = $prefix_selector . ' ' . $local_sync['selector'];
                            }
                        }

                        $future_selective_refresh = [
                            'id'                  => $local_sync['id'],
                            'container_inclusive' => $local_sync['container_inclusive'],
                            'selector'            => $selector,
                            'settings'            => [],
                            'fallbackRefresh'     => false,
                            'render_callback'     => function () use ($local_sync) {
                                if (!isset($local_sync['render'])) {
                                    return;
                                }

                                call_user_func($local_sync['render'], $local_sync);
                            }
                        ];

                        if ($local_sync['loader_selector']) {
                            $future_selective_refresh['loader_selector'] = $local_sync['loader_selector'];
                        }

                        $opt['option']['selective_refresh'][] = $future_selective_refresh;
                    }
                }
            }


            if (isset($opt['option']['setting']) && is_array($opt['option']['setting'])) {
                $args_setting = array_merge(
                    $opt['option']['setting'],
                    $args_setting
                );
            }

            $is_allowed = true;

            $options_that_are_not_allowed = apply_filters(
                'rishi-options-without-controls',
                [
                    'rt-divider',
                    'rt-title',
                    'rt-notification',
                    'rishi-customizer-options-manager'
                ]
            );

            if (in_array($opt['option']['type'], $options_that_are_not_allowed)) {
                $is_allowed = false;
            }

            if (
                $opt['option']['type'] === 'rt-panel'
                &&
                !isset($opt['option']['switch'])
            ) {
                $is_allowed = false;
            }

            if ($is_allowed) {
                $wp_customize->add_setting($opt['id'], array_merge([
                    // This is only a default function.
                    // Real check comes from rishi__cb_customizer_include_sanitizer()
                    // above.
                    'sanitize_callback' => function ($input, $setting) {
                        return $input;
                    }
                ], $args_setting));
            }

            unset($args_setting);

            if (isset($opt['option']['selective_refresh'])) {
                foreach ($opt['option']['selective_refresh'] as $single_partial) {
                    if (!isset($single_partial['selector'])) {
                        continue;
                    }

                    if (!isset($single_partial['settings'])) {
                        $single_partial['settings'] = [$opt['id']];
                    }

                    $single_partial['fallback_refresh'] = false;
                    $wp_customize->selective_refresh->add_partial(
                        $single_partial['id'],
                        $single_partial
                    );
                }
            }

            if ($settings['has_controls']) {
                $our_control = new WP_Customize_Control(
                    $wp_customize,
                    $opt['id'],
                    $args_control
                );

                if (isset($opt['option']['choices'])) {
                    $our_control->json['choices'] = $opt['option']['choices'];
                }

                if (isset($opt['option']['condition'])) {
                    $our_control->json['condition'] = $opt['option']['condition'];
                }

                $our_control->json['option'] = $opt['option'];

                $wp_customize->add_control($our_control);
            }

            continue;
        }

        // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
        trigger_error(
            'Unknown group: ' . esc_html($opt['group']),
            E_USER_WARNING
        );
    }
}
