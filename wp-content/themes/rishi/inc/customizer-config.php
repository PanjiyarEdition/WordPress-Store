<?php
/**
 * Customizer Builder setup.
 *
 * @package rishi
 */

defined( 'ABSPATH' ) || exit;

/**
 * Customizer Builder
 */
require_once RISHI_CUSTOMIZER_BUILDER_DIR__ . '/init.php';

/**
 * Initialize Customizer.
 */
RISHI__\init_customizer();

add_filter( 'rishi__cb_use_cb_body_classes', '__return_false' );

// Use this to exclude customizer settings from the builder.
$rishi_exclude_customizer_settings = array();

foreach ( $rishi_exclude_customizer_settings as $hook_name => $keys ) {
	add_filter(
		$hook_name,
		function( $options ) use ( $keys ) {

			// return travel_monster_unset_deep( $options, $keys );
			foreach ( $keys as $mod_name => $key ) {
				if ( is_array( $key ) ) {
					foreach( $key as $index => $inner_key ) {
						if ( is_array( $inner_key ) ) {
							foreach( $inner_key as $_index ) {
								if ( isset( $options[ $mod_name ][ $index ][ $_index ] ) ) {
									unset( $options[ $mod_name ][ $index ][ $_index ] );
								}
							}
						} else {
							unset( $options[ $mod_name ][ $index ][ $inner_key ] );
						}
					}
				} else {
					unset( $options[ $key ] );
				}

			}
			return $options;
		}
	);
}
