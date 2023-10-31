<?php

$defaults = rishi__cb__get_layout_defaults();

rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => ':root',
    'variableName' => 'containerWidth',
    'unit'         => '',
    'value' => get_theme_mod('container_width', [
        'desktop' => $defaults['container_width']['desktop'],
        'tablet'  => $defaults['container_width']['tablet'],
        'mobile'  => $defaults['container_width']['mobile'],
    ]),
]);

rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => ':root',
    'variableName' => 'containerContentMaxWidth',
    'unit'         => '',
    'value' => get_theme_mod('container_content_max_width', [
      'desktop' => $defaults['container_content_max_width']['desktop'],
      'tablet'  => $defaults['container_content_max_width']['tablet'],
      'mobile'  => $defaults['container_content_max_width']['mobile'],
    ]),
]);

rishi__cb_customizer_output_responsive([
    'css'          => $css,
    'tablet_css'   => $tablet_css,
    'mobile_css'   => $mobile_css,
    'selector'     => ':root',
    'variableName' => 'containerVerticalMargin',
    'unit'         => '',
    'value' => get_theme_mod('containerVerticalMargin', [
      'desktop' => $defaults['containerVerticalMargin']['desktop'],
      'tablet'  => $defaults['containerVerticalMargin']['tablet'],
      'mobile'  => $defaults['containerVerticalMargin']['mobile'],
    ]),
]);

rishi__cb_customizer_output_responsive([
  'css'          => $css,
  'tablet_css'   => $tablet_css,
  'mobile_css'   => $mobile_css,
  'selector'     => '.rishi-container[data-strech="full"]',
  'variableName' => 'streched-padding',
  'unit'         => '',
  'value' => get_theme_mod('containerStrechedPadding', [
    'desktop' => '40px',
    'tablet'  => '30px',
    'mobile'  => '15px',
  ]),
  'responsive' => true,
]);
