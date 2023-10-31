<?php
/**
 * Visibility helpers
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

/**
 * Generate visibility classes
 *
 * @param string $data Devices state.
 */
function rishi__cb_customizer_visibility_classes( $data ) {
	$classes = array();

	if ( isset( $data['mobile'] ) && ! $data['mobile'] ) {
		$classes[] = 'cb__hidden-sm';
	}

	if ( isset( $data['tablet'] ) && ! $data['tablet'] ) {
		$classes[] = 'cb__hidden-md';
	}

	if ( isset( $data['desktop'] ) && ! $data['desktop'] ) {
		$classes[] = 'cb__hidden-lg';
	}

	return implode( ' ', $classes );
}

function rishi__cb_customizer_some_device( $data ) {
	return ( isset( $data['mobile'] ) && $data['mobile']
		||
		isset( $data['tablet'] ) && $data['tablet']
		||
		isset( $data['desktop'] ) && $data['desktop'] );
}

function rishi__cb_customizer_output_responsive_switch( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'css'        => null,
			'tablet_css' => null,
			'mobile_css' => null,
			'value'      => null,
			'selector'   => '',

			'on'         => 'block',
			'off'        => 'none',

			'variable'   => 'visibility',

			// all_enabled | all_disabled
			'skip_when'  => 'all_enabled',
		)
	);

	rishi__cb_customizer_assert_args(
		$args,
		array( 'css', 'tablet_css', 'mobile_css', 'selector', 'value' )
	);

	$all_enabled = ( isset( $args['value']['mobile'] ) && $args['value']['mobile']
		&&
		isset( $args['value']['tablet'] ) && $args['value']['tablet']
		&&
		isset( $args['value']['desktop'] ) && $args['value']['desktop'] );

	$all_disabled = ( isset( $args['value']['mobile'] ) && ! $args['value']['mobile']
		&&
		isset( $args['value']['tablet'] ) && ! $args['value']['tablet']
		&&
		isset( $args['value']['desktop'] ) && ! $args['value']['desktop'] );

	if ( $all_enabled && $args['skip_when'] === 'all_enabled' ) {
		return;
	}

	if ( $all_disabled && $args['skip_when'] === 'all_disabled' ) {
		return;
	}

	rishi__cb_customizer_output_css_vars(
		array(
			'css'          => $args['css'],
			'tablet_css'   => $args['tablet_css'],
			'mobile_css'   => $args['mobile_css'],

			'selector'     => $args['selector'],
			'responsive'   => true,
			'variableName' => $args['variable'],

			'value'        => array(
				'desktop' => ( isset( $args['value']['desktop'] )
					&&
					! $args['value']['desktop'] ) ? $args['off'] : $args['on'],

				'tablet'  => ( isset( $args['value']['tablet'] )
					&&
					! $args['value']['tablet'] ) ? $args['off'] : $args['on'],

				'mobile'  => ( isset( $args['value']['mobile'] )
					&&
					! $args['value']['mobile'] ) ? $args['off'] : $args['on'],
			),
		)
	);
}
