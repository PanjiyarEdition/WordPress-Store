<?php
/**
 * Return the url to be used in image picker.
 *
 * @param string $path image name.
 */
if ( ! function_exists( 'rishi__cb_customizer_image_picker_url' ) ) {
	/**
	 * Image picker url
	 *
	 * @param [type] $path
	 * @return void
	 */
	function rishi__cb_customizer_image_picker_url( $path ) {
		 return RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/src/images/' . $path;
	}
}

/**
 * Parse options.
 *
 * @param array $result The place to store result into.
 * @param array $options Proper options.
 * @param array $settings settings.
 * @param array $_recursion_data (private) for internal use.
 */
function rishi__cb_customizer_collect_options(
	&$result,
	&$options,
	$settings = array(),
	$_recursion_data = array()
) {
	static $default_settings = array(
		'info_wrapper'            => false,

		/**
		 * For e.g. use 1 to collect only first level. 0 is for unlimited.
		 *
		 * @type int Nested options level limit.
		 */
		'limit_level'             => 0,

		/**
		 * Empty array will skip all types
		 *
		 * @type false|array('option-type', ...)
		 */
		'limit_option_types'      => false,
		'include_container_types' => true,
	);

	if ( empty( $options ) ) {
		return;
	}

	if ( empty( $_recursion_data ) ) {
		$settings = array_merge( $default_settings, $settings );

		$_recursion_data = array(
			'level' => 1,
		);
	}

	if (
		$settings['limit_level']
		&&
		$_recursion_data['level'] > $settings['limit_level']
	) {
		return;
	}

	foreach ( array_filter( $options ) as $option_id => &$option ) {
		if ( isset( $option['options'] ) ) { // this is a container.
			do {
				if ( $settings['info_wrapper'] ) {
					if ( $settings['include_container_types'] ) {
						$result[ 'container:' . $option_id ] = array(
							'group'  => 'container',
							'id'     => $option_id,
							'option' => &$option,
							'level'  => $_recursion_data['level'],
						);
					}
				} else {
					if ( $settings['include_container_types'] ) {
						$result[ $option_id ] = &$option;
					}
				}
			} while ( false );

			rishi__cb_customizer_collect_options(
				$result,
				$option['options'],
				$settings,
				array_merge(
					$_recursion_data,
					array( 'level' => $_recursion_data['level'] + 1 )
				)
			);
		} elseif (
			is_int( $option_id )
			&&
			is_array( $option )
			&&
			isset( $options[0] )
		) {
			rishi__cb_customizer_collect_options( $result, $option, $settings, $_recursion_data );
		} elseif ( isset( $option['type'] ) ) { // option.
			if (
				is_array( $settings['limit_option_types'] )
				&&
				! in_array( $option['type'], $settings['limit_option_types'], true )
			) {
				continue;
			}

			if ( $settings['info_wrapper'] ) {
				$result[ 'option:' . $option_id ] = array(
					'group'  => 'option',
					'id'     => $option_id,
					'option' => &$option,
					'level'  => $_recursion_data['level'],
				);
			} else {
				$result[ $option_id ] = &$option;
			}
		} else {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			trigger_error(
				'Invalid option: ' . esc_html( $option_id ),
				E_USER_WARNING
			);
		}
	}
}

/**
 * Get Customizer Options.
 *
 * @param [type]  $path
 * @param array   $pass_inside
 * @param boolean $relative
 * @return void
 */
function rishi__cb_customizer_get_options( $path, $pass_inside = array(), $relative = true ) {

	if ( is_array( $path ) ) {
		$_options = $path;
	} else {
		if ( $relative ) {
			$path = \RISHI_CUSTOMIZER_BUILDER_DIR__ . '/customizer-settings/' . $path . '.php';
		}

		if ( ! file_exists( $path ) ) {
			return null;
		}

		$_options = rishi__cb_get_akv(
			'options',
			rishi__cb_customizer_get_variables_from_file(
				$path,
				array( 'options' => array() ),
				$pass_inside
			)
		);
	}

	return apply_filters( 'rishi__cb_:options:retrieve', $_options, $path, $pass_inside );
}
