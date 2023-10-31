<?php
/**
 * Color options
 *
 * @license   http: //www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

$defaults = rishi__cb__get_color_defaults();


$_palettes = apply_filters(
	'rishi__cb_color_palettes',
	array(
		array( 'rgba(41, 41, 41, 0.9)', '#292929', '#216BDB', '#5081F5', '#ffffff', '#EDF2FE', '#e9f1fa', '#F9FBFE' ),
		array( 'rgba(0, 26, 26, 0.8)', 'rgba(0, 26, 26, 0.9)', '#03a6a6', '#001a1a', '#ffffff', '#E5E8E8', '#F4FCFC', '#FEFEFE' ),
		array( '#1e2436', '#242b40', '#ff8b3c', '#8E919A', '#ffffff', '#E9E9EC', '#FFF7F1', '#FFFBF9' ),
		array( '#8D8D8D', '#31332e', '#8cb369', '#A3C287', '#ffffff', '#E8F0E1', '#F3F7F0', '#ffffff' ),
		array( '#21201d', '#21201d', '#dea200', '#343330', '#ffffff', '#F8ECCC', '#FDF8ED', '#fdfcf7' ),
	)
);

$current_palette     = 'palette-1';
$color_palette_value = array( 'current_palette' => $current_palette );
foreach ( $_palettes[0] as $index => $color_code ) {
	$color_palette_value[ 'color' . ++$index ] = array( 'color' => $color_code );
}

unset( $color_code, $index );

$palettes = array();

foreach ( $_palettes as $index => $palette ) {
	$_palette['id'] = 'palette-' . ++$index;
	foreach ( $palette as $_index => $color_code ) {
		$_palette[ 'color' . ++$_index ] = array( 'color' => $color_code );
	}
	$palettes[] = $_palette;
}

$color_palette_value['palettes'] = $palettes;

$options = array(
	'layouts_color_options' => array(
		'type'               => 'rt-options',
		'customizer_section' => 'container',
		'inner-options'      => array(

			array(
				'colorPalette' => array(
					'label'       => __( 'Global Color Palette', 'rishi' ),
					'type'        => 'rt-color-palettes-picker',
					'design'      => 'block',
					// translators: The interpolations addes a html link around the word.
					'setting'     => array( 'transport' => 'postMessage' ),
					'predefined'  => true,
					'wrapperAttr' => array(
						'data-type'  => 'color-palette',
						'data-label' => 'heading-label',
					),

					'value'       => $color_palette_value,
				),

			),

			'primary_color'      => array(
				'label'           => __( 'Base Font Color', 'rishi' ),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => array( 'transport' => 'postMessage' ),
				'value'           => array(
					'default' => array(
						'color' => 'var(--paletteColor1)',
					),
				),
				'pickers'         => array(
					array(
						'title' => __( 'Initial', 'rishi' ),
						'id'    => 'default',
					),
				),
			),

			'genheadingColor'    => array(
				'label'           => __( 'Heading Color', 'rishi' ),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => array( 'transport' => 'postMessage' ),
				'value'           => array(
					'default' => array(
						'color' => 'var(--paletteColor2)',
					),
				),
				'pickers'         => array(
					array(
						'title' => __( 'Initial', 'rishi' ),
						'id'    => 'default',
					),
				),
			),

			'genLinkColor'       => array(
				'label'           => __( 'Link Color', 'rishi' ),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => array( 'transport' => 'postMessage' ),

				'value'           => array(
					'default' => array(
						'color' => 'var(--paletteColor3)',
					),

					'hover'   => array(
						'color' => 'var(--paletteColor2)',
					),
				),

				'pickers'         => array(
					array(
						'title' => __( 'Initial', 'rishi' ),
						'id'    => 'default',
					),

					array(
						'title' => __( 'Hover', 'rishi' ),
						'id'    => 'hover',
					),
				),
			),

			'textSelectionColor' => array(
				'label'           => __( 'Text Selection Color', 'rishi' ),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => array( 'transport' => 'postMessage' ),

				'value'           => array(
					'default' => array(
						'color' => 'var(--paletteColor5)',
					),

					'hover'   => array(
						'color' => 'var(--paletteColor4)',
					),
				),

				'pickers'         => array(
					array(
						'title' => __( 'Initial', 'rishi' ),
						'id'    => 'default',
					),

					array(
						'title' => __( 'Highlighted', 'rishi' ),
						'id'    => 'hover',
					),
				),
			),
			'genborderColor'     => array(
				'label'           => __( 'Border Color', 'rishi' ),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => array( 'transport' => 'postMessage' ),
				'value'           => array(
					'default' => array(
						'color' => 'var(--paletteColor6)',
					),
				),
				'pickers'         => array(
					array(
						'title' => __( 'Initial', 'rishi' ),
						'id'    => 'default',
					),
				),
			),
			'base_color'         => array(
				'label'           => __( 'Section Background Color', 'rishi' ),
				'desc'            => __( 'This color is used in some sections of the site as a background.', 'rishi' ),
				'type'            => 'rt-color-picker',
				'skipEditPalette' => true,
				'design'          => 'inline',
				'setting'         => array( 'transport' => 'postMessage' ),
				'value'           => array(
					'default' => array(
						'color' => 'var(--paletteColor7)',
					),
				),
				'pickers'         => array(
					array(
						'title' => __( 'Initial', 'rishi' ),
						'id'    => 'default',
					),
				),
			),
			'site_background'    => array(
				'label'      => __( 'Site Background', 'rishi' ),
				'type'       => 'rt-background',
				'design'     => 'block:right',
				'responsive' => true,
				'divider'    => 'top',
				'setting'    => array( 'transport' => 'postMessage' ),
				'value'      => rishi__cb_customizer_background_default_value(
					array(
						'backgroundColor' => array(
							'default' => array(
								'color' => 'var(--paletteColor8)',
							),
						),
					)
				),
			),
		),
	),
);
