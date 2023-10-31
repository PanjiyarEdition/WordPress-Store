<?php
/**
 * Helpers for generating CSS output.
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

function rishi__cb_customizer_output_responsive( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'css'                     => null,
			'tablet_css'              => null,
			'mobile_css'              => null,
			'selector'                => null,

			'desktop_selector_prefix' => '',
			'tablet_selector_prefix'  => '',
			'mobile_selector_prefix'  => '',

			'variableName'            => null,
			'unit'                    => 'px',
			'value'                   => null,
		)
	);

	$args['value_suffix'] = $args['unit'];
	$args['responsive']   = true;

	rishi__cb_customizer_output_css_vars( $args );
}

function rishi__cb_customizer_units_config( $overrides = array() ) {
	$units = array(
		array(
			'unit' => 'px',
			'min'  => 0,
			'max'  => 40,
		),
		array(
			'unit' => 'em',
			'min'  => 0,
			'max'  => 30,
		),
		array(
			'unit' => '%',
			'min'  => 0,
			'max'  => 100,
		),
		array(
			'unit' => 'vw',
			'min'  => 0,
			'max'  => 100,
		),
		array(
			'unit' => 'vh',
			'min'  => 0,
			'max'  => 100,
		),
		array(
			'unit' => 'pt',
			'min'  => 0,
			'max'  => 100,
		),
		array(
			'unit' => 'rem',
			'min'  => 0,
			'max'  => 30,
		),
	);

	foreach ( $overrides as $single_override ) {
		foreach ( $units as $key => $single_unit ) {
			if ( $single_override['unit'] === $single_unit['unit'] ) {
				$units[ $key ] = $single_override;
			}
		}
	}

	return $units;
}

function rishi__cb_customizer_output_border( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'css'                     => null,
			'tablet_css'              => null,
			'mobile_css'              => null,

			'selector'                => null,

			'desktop_selector_prefix' => '',
			'tablet_selector_prefix'  => '',
			'mobile_selector_prefix'  => '',

			'variableName'            => null,
			'value'                   => null,

			'important'               => false,
			'responsive'              => false,
		)
	);

	$value = rishi__cb_customizer_expand_responsive_value( $args['value'] );

	$border_values = array(
		'desktop' => '',
		'tablet'  => '',
		'mobile'  => '',
	);

	if ( $value['desktop']['style'] === 'none' ) {
		$border_values['desktop'] = 'none';
	} else {
		$color = rishi__cb_customizer_get_colors(
			array(
				'default' => $value['desktop']['color'],
			),
			array(
				'default' => $value['desktop']['color'],
			)
		);

		$border_values['desktop'] = $value['desktop']['width'] . 'px ' .
			$value['desktop']['style'] . ' ' . $color['default'];
	}

	if (
		isset( $value['desktop']['inherit'] )
		&&
		$value['desktop']['inherit']
	) {
		$border_values['desktop'] = 'CT_CSS_SKIP_RULE';
	}

	if ( $value['tablet']['style'] === 'none' ) {
		$border_values['tablet'] = 'none';
	} else {
		$color = rishi__cb_customizer_get_colors(
			array(
				'default' => $value['tablet']['color'],
			),
			array(
				'default' => $value['tablet']['color'],
			)
		);

		$border_values['tablet'] = $value['tablet']['width'] . 'px ' .
			$value['tablet']['style'] . ' ' . $color['default'];
	}

	if (
		isset( $value['tablet']['inherit'] )
		&&
		$value['tablet']['inherit']
	) {
		$border_values['tablet'] = 'CT_CSS_SKIP_RULE';
	}

	if ( $value['mobile']['style'] === 'none' ) {
		$border_values['mobile'] = 'none';
	} else {
		$color = rishi__cb_customizer_get_colors(
			array(
				'default' => $value['mobile']['color'],
			),
			array(
				'default' => $value['mobile']['color'],
			)
		);

		$border_values['mobile'] = $value['mobile']['width'] . 'px ' .
			$value['mobile']['style'] . ' ' . $color['default'];
	}

	if (
		isset( $value['mobile']['inherit'] )
		&&
		$value['mobile']['inherit']
	) {
		$border_values['mobile'] = 'CT_CSS_SKIP_RULE';
	}

	$args['value'] = $border_values;

	if ( $args['important'] ) {
		$args['value_suffix'] = ' !important';
	}

	rishi__cb_customizer_output_css_vars( $args );
}

function rishi__cb_customizer_output_spacing( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'css'        => null,
			'tablet_css' => null,
			'mobile_css' => null,

			'selector'   => null,
			'property'   => 'margin',

			'important'  => false,
			'responsive' => true,

			'value'      => null,
		)
	);

	$value = rishi__cb_customizer_expand_responsive_value( $args['value'] );

	$spacing_value = array(
		'desktop' => rishi__cb_customizer_spacing_prepare_for_device( $value['desktop'] ),
		'tablet'  => rishi__cb_customizer_spacing_prepare_for_device( $value['tablet'] ),
		'mobile'  => rishi__cb_customizer_spacing_prepare_for_device( $value['mobile'] ),
	);

	$args['value']        = $spacing_value;
	$args['variableName'] = $args['property'];

	if ( $args['important'] ) {
		$args['value_suffix'] = ' !important';
	}

	rishi__cb_customizer_output_css_vars( $args );
}

function rishi__cb_customizer_spacing_prepare_for_device( $value ) {
	$result = array();

	$is_value_compact = true;

	foreach ( array(
		$value['top'],
		$value['right'],
		$value['bottom'],
		$value['left'],
	) as $val ) {
		if ( $val !== 'auto' && preg_match( '/\\d/', $val ) > 0 ) {
			$is_value_compact = false;
			break;
		}
	}

	if ( $is_value_compact ) {
		return 'CT_CSS_SKIP_RULE';
	}

	if (
		$value['top'] === 'auto'
		||
		preg_match( '/\\d/', $value['top'] ) === 0
	) {
		$result[] = 0;
	} else {
		$result[] = $value['top'];
	}

	if (
		$value['right'] === 'auto'
		||
		preg_match( '/\\d/', $value['right'] ) === 0
	) {
		$result[] = 0;
	} else {
		$result[] = $value['right'];
	}

	if (
		$value['bottom'] === 'auto'
		||
		preg_match( '/\\d/', $value['bottom'] ) === 0
	) {
		$result[] = 0;
	} else {
		$result[] = $value['bottom'];
	}

	if (
		$value['left'] === 'auto'
		||
		preg_match( '/\\d/', $value['left'] ) === 0
	) {
		$result[] = 0;
	} else {
		$result[] = $value['left'];
	}

	if (
		$result[0] === $result[1]
		&&
		$result[0] === $result[2]
		&&
		$result[0] === $result[3]
	) {
		return $result[0];
	}

	if (
		$result[0] === $result[2]
		&&
		$result[1] === $result[3]
	) {
		return $result[0] . ' ' . $result[3];
	}

	return implode( ' ', $result );
}

function rishi__cb_customizer_spacing_value( $args = array() ) {
	return wp_parse_args(
		$args,
		array(
			'top'    => '',
			'bottom' => '',
			'left'   => '',
			'right'  => '',
			'linked' => true,
		)
	);
}

function rishi__cb_customizer_maybe_append_important( $value, $has_important = false ) {
	if ( ! $has_important ) {
		return $value;
	}

	if ( strpos( $value, 'CT_CSS_SKIP_RULE' ) !== false ) {
		return $value;
	}

	return $value . ' !important';
}

function rishi__cb_customizer_get_page_title_source() {
	static $result = null;

	if ( ! is_null( $result ) ) {
		if ( ! is_customize_preview() ) {
			return $result;
		}
	}

	$prefix = rishi__cb_customizer_manager()->screen->get_prefix();

	if ( $prefix === 'rt_hooked_element_single' ) {
		$result = false;
		return $result;
	}

	if ( strpos( $prefix, 'single' ) !== false || (
		function_exists( 'is_shop' ) && is_shop()
	) && ! is_search() ) {
		$post_options = rishi__cb_customizer_get_post_options();

		$mode = rishi__cb_get_akv( 'has_hero_section', $post_options, 'default' );

		if ( $mode === 'disabled' ) {
			$result = false;
			return $result;
		}

		if ( $mode === 'enabled' ) {
			$result = array(
				'strategy' => $post_options,
			);
			return $result;
		}
	}

	$result = array(
		'strategy' => 'customizer',
		'prefix'   => $prefix,
	);

	return $result;
}
