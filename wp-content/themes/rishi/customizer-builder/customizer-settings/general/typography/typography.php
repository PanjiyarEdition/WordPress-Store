<?php

/**
 * Typography options
 *
 *
 * @license   http: //www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */
$defaults = rishi__cb__get_typography_defaults();
$options  = [
	'typography_section_options' => [
		'type'          => 'rt-options',
		'setting'       => ['transport' => 'postMessage'],
		'inner-options' => [
			'rootTypography' => [
				'type'      => 'rt-typography',
				'label'     => __('Base Font', 'rishi'),
				'isDefault' => true,
				'value'     => rishi__cb_customizer_typography_default_values([
					'family'         => $defaults['body']['family'],
					'variation'      => $defaults['body']['variants'],
					'size'           => $defaults['body']['font_size'],
					'line-height'    => '1.75',
					'letter-spacing' => '0',

				]),
				'setting' => ['transport' => 'postMessage'],
				'design'  => 'block',
				'sync'    => 'live'
			],
			'h1Typography' => [
				'type'  => 'rt-typography',
				'label' => __('Heading 1 (H1)', 'rishi'),
				'divider' => 'top',
				'value' => rishi__cb_customizer_typography_default_values([
					'size'        => '40px',
					'variation'   => 'n7',
					'line-height' => '1.5'
				]),
				'setting' => ['transport' => 'postMessage'],
			],

			'h2Typography' => [
				'type'  => 'rt-typography',
				'label' => __('Heading 2 (H2)', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size'        => '36px',
					'variation'   => 'n7',
					'line-height' => '1.5'
				]),
				'setting' => ['transport' => 'postMessage'],
			],

			'h3Typography' => [
				'type'  => 'rt-typography',
				'label' => __('Heading 3 (H3)', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size'        => '30px',
					'variation'   => 'n7',
					'line-height' => '1.5'
				]),
				'setting' => ['transport' => 'postMessage'],
			],

			'h4Typography' => [
				'type'  => 'rt-typography',
				'label' => __('Heading 4 (H4)', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size'        => '26px',
					'variation'   => 'n7',
					'line-height' => '1.5'
				]),
				'setting' => ['transport' => 'postMessage'],
			],

			'h5Typography' => [
				'type'  => 'rt-typography',
				'label' => __('Heading 5 (H5)', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size'        => '22px',
					'variation'   => 'n7',
					'line-height' => '1.5'
				]),
				'setting' => ['transport' => 'postMessage'],
			],

			'h6Typography' => [
				'type'  => 'rt-typography',
				'label' => __('Heading 6 (H6)', 'rishi'),
				'value' => rishi__cb_customizer_typography_default_values([
					'size'        => '18px',
					'variation'   => 'n7',
					'line-height' => '1.5'
				]),
				'setting' => ['transport' => 'postMessage'],
			],

		 rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],

			'font_family_fallback' => [
				'type'  => 'text',
				'value' => 'Sans-Serif',
				'label' => __('Fallback Font Family', 'rishi'),
				'desc'  => __('This font is used if the chosen font isn\'t available.', 'rishi'),
			],
			rishi__cb_customizer_rand_md5() => [
				'type' => 'rt-divider',
			],
			'ed_flush_google_fonts' => [
				'label' => __( 'Regenerate Fonts Library', 'rishi' ),
				'desc'  => __( 'This feature will update the fonts library added to the theme.', 'rishi' ),
				'type' 		=> 'rtFlushGoogleFont',
				'value' 	=> ''
			],	
		],
	],
];
