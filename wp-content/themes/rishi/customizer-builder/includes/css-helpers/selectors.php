<?php

function rishi__cb_customizer_assemble_selector( $selector ) {
	if ( is_string( $selector ) ) {
		return $selector;
	}

	if ( ! is_array( $selector ) ) {
		throw new Error( '$selector should be either string or array.' );
	}

	return implode( ' ', $selector );
}

function rishi__cb_customizer_mutate_selector( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'selector'  => null,
			// prefix | suffix | between | replace-last | el-prefix
			'operation' => 'between',
			'to_add'    => '',
		)
	);

	if ( ! is_array( $args['selector'] ) ) {
		throw new Error( 'Only $selector as array can be mutated.' );
	}

	if ( $args['operation'] === 'between' ) {
		return array_merge(
			array_slice( $args['selector'], 0, 1 ),
			array(
				$args['to_add'],
			),
			array_slice( $args['selector'], 1 )
		);
	}

	if ( $args['operation'] === 'el-prefix' && count( $args['selector'] ) > 1 ) {
		$args['selector'][1] = $args['to_add'] . $args['selector'][1];
		return $args['selector'];
	}

	if ( $args['operation'] === 'container-suffix' ) {
		$args['selector'][0] .= $args['to_add'];
		return $args['selector'];
	}

	if ( $args['operation'] === 'suffix' ) {
		$args['selector'][] = $args['to_add'];
		return $args['selector'];
	}

	if (
		$args['operation'] === 'replace-last'
		&&
		count( $args['selector'] ) === 2
	) {
		$args['selector'][1] = $args['to_add'];

		return $args['selector'];
	}

	if ( $args['operation'] === 'prefix' ) {
		array_unshift( $args['selector'], $args['to_add'] );
		return $args['selector'];
	}

	return $args['selector'];
}

function rishi__cb_customizer_get_source_for( $prefix ) {
	 return array(
		 'strategy' => 'customizer',
		 'prefix'   => $prefix,
	 );
}

function rishi__cb_customizer_prefix_selector( $selector, $prefix = '' ) {
	if ( empty( $prefix ) ) {
		return $selector;
	}

	if ( empty( $selector ) ) {
		return '[data-prefix="' . $prefix . '"]';
	}

	return '[data-prefix="' . $prefix . '"] ' . $selector;
}

function rishi__cb_customizer_camel_case_prefix( $value, $prefix = '' ) {
	if ( empty( $prefix ) ) {
		return $value;
	}

	return $prefix . ucfirst( $value );
}
