<?php
$options = apply_filters('rishi:header:settings', [
  rishi__cb_customizer_rand_md5() => [
        'label' => __('Global Header Options', 'rishi'),
        'type'  => 'rt-title',
        'desc'  => sprintf( __('To get additional header options like %1$sTransparent and Sticky header settings%2$s, please install and activate %3$sRishi Companion%4$s plugin.', 'rishi'), '<b>', '</b>', '<a target="_blank" href="'.admin_url('plugin-install.php?s=rishi%20companion&tab=search&type=term').'">', '</a>' ),
    ],
]);
