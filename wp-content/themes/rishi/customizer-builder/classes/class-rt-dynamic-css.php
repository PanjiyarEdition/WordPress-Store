<?php

/**
 * Rishi Dynamic CSS helpers
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @package   Rishi
 */

class Rishi_Dynamic_CSS {

	public function __construct() {
		add_action(
			'wp_print_styles',
			array( $this, 'load_frontend_css' ),
			9999
		);

		add_filter(
			'customize_render_partials_response',
			function ( $response, $obj, $partials ) {
				$joined_keys = implode( '', array_keys( $partials ) );

				$css_output = rishi__cb_customizer_get_all_dynamic_styles_for(
					array(
						'context' => 'inline',
					)
				);

				$css        = $css_output['css'];
				$tablet_css = $css_output['tablet_css'];
				$mobile_css = $css_output['mobile_css'];

				rishi__cb_customizer_theme_get_dynamic_styles(
					array(
						'name'        => 'global-inline',
						'css'         => $css,
						'mobile_css'  => $mobile_css,
						'tablet_css'  => $tablet_css,
						'context'     => 'inline',
						'chunk'       => 'inline',
						'forced_call' => true,
					)
				);

				$response['rt_dynamic_css'] = array(
					'desktop' => $css->build_css_structure(),
					'tablet'  => $tablet_css->build_css_structure(),
					'mobile'  => $mobile_css->build_css_structure(),
				);

				return $response;
			},
			10,
			3
		);

		add_filter(
			'rishi_block_editor_dynamic_css',
			array( $this, 'load_backend_dynamic_css_gb' )
		);

		add_action(
			'wp_print_scripts',
			function () {
				if ( ! is_admin() ) {
					return;
				}

				$this->load_backend_dynamic_css();
			}
		);
	}

	public function load_frontend_css() {
		$css_output = rishi__cb_customizer_get_all_dynamic_styles_for(
			array(
				'context' => 'inline',
			)
		);

		$css        = $css_output['css'];
		$tablet_css = $css_output['tablet_css'];
		$mobile_css = $css_output['mobile_css'];
		$all_global_css = trim( $css->build_css_structure() );

		if ( ! empty( $all_global_css ) ) {
			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * The variable used here has the value escaped properly.
			 */
			echo '<style id="ct-main-styles-inline-css">';
			echo $all_global_css;
			echo "</style>\n";
		}

		$tablet_css = trim( $tablet_css->build_css_structure() );
		$mobile_css = trim( $mobile_css->build_css_structure() );

		if ( ! empty( trim( $tablet_css ) ) ) {
			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * The variable used here has the value escaped properly.
			 */
			echo '<style id="ct-main-styles-tablet-inline-css" media="(max-width: 999.98px)">';
			echo $tablet_css;
			echo "</style>\n";
		}

		if ( ! empty( trim( $mobile_css ) ) ) {
			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * The variable used here has the value escaped properly.
			 */
			echo '<style id="ct-main-styles-mobile-inline-css" media="(max-width: 689.98px)">';
			echo $mobile_css;
			echo "</style>\n";
		}
	}

	public function load_backend_dynamic_css() {
		$css        = new \Rishi_CSS_Injector();
		$tablet_css = new \Rishi_CSS_Injector();
		$mobile_css = new \Rishi_CSS_Injector();

		do_action(
			'rishi:admin-dynamic-css:enqueue',
			array(
				'context'    => 'inline',
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
			)
		);

		rishi__cb_customizer_theme_get_dynamic_styles(
			array(
				'name'       => 'admin-global',
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
				'context'    => 'inline',
				'chunk'      => 'admin',
			)
		);

		$all_global_css = trim( $css->build_css_structure() );

		if ( ! empty( $all_global_css ) ) {
			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * The variable used here has the value escaped properly.
			 */
			echo '<style id="ct-main-styles-inline-css">';
			echo $all_global_css;
			echo "</style>\n";
		}
	}

	/**
	 * Gutenberg Dynamic styles.
	 *
	 * @return void
	 */
	public function load_backend_dynamic_css_gb() {
		$css        = new \Rishi_CSS_Injector();
		$tablet_css = new \Rishi_CSS_Injector();
		$mobile_css = new \Rishi_CSS_Injector();

		do_action(
			'rishi:admin-dynamic-css:enqueue',
			array(
				'context'    => 'inline',
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
			)
		);

		rishi__cb_customizer_theme_get_dynamic_styles(
			array(
				'name'       => 'admin-global',
				'css'        => $css,
				'tablet_css' => $tablet_css,
				'mobile_css' => $mobile_css,
				'context'    => 'inline',
				'chunk'      => 'admin',
			)
		);

		$all_global_css = trim( $css->build_css_structure() );

		if ( ! empty( $all_global_css ) ) {
			/**
			 * Note to code reviewers: This line doesn't need to be escaped.
			 * The variable used here has the value escaped properly.
			 */
			return $all_global_css;
		}
	}
}

function rishi__cb_customizer_has_css_in_files() {
	return apply_filters( 'rishi:dynamic-css:has_files_cache', false );
}

function rishi__cb_customizer_get_all_dynamic_styles_for( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'context' => null,
		)
	);

	$css        = new \Rishi_CSS_Injector();
	$mobile_css = new \Rishi_CSS_Injector();
	$tablet_css = new \Rishi_CSS_Injector();

	rishi__cb_customizer_theme_get_dynamic_styles(
		array(
			'name'        => 'global',
			'css'         => $css,
			'mobile_css'  => $mobile_css,
			'tablet_css'  => $tablet_css,
			'context'     => $args['context'],
			'chunk'       => 'global',
			'forced_call' => true,
		)
	);

	rishi__cb_customizer_theme_get_dynamic_styles(
		array(
			'name'        => 'global-inline',
			'css'         => $css,
			'mobile_css'  => $mobile_css,
			'tablet_css'  => $tablet_css,
			'context'     => 'inline',
			'chunk'       => 'inline',
			'forced_call' => true,
		)
	);

	do_action(
		'rishi:global-dynamic-css:enqueue',
		array(
			'context'    => $args['context'],
			'css'        => $css,
			'tablet_css' => $tablet_css,
			'mobile_css' => $mobile_css,
		)
	);

	return array(
		'css'        => $css,
		'tablet_css' => $tablet_css,
		'mobile_css' => $mobile_css,
	);
}

function rishi__cb_customizer_dynamic_styles_should_call( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'context'     => null,
			'chunk'       => null,
			'forced_call' => false,
		)
	);

	if ( ! $args['context'] ) {
		throw new Error( '$context not provided. This is required!' );
	}

	if ( ! $args['chunk'] ) {
		throw new Error( '$chunk not provided. This is required!' );
	}

	if ( ! $args['forced_call'] && rishi__cb_customizer_has_css_in_files() ) {
		if ( $args['context'] === 'inline' ) {
			if ( $args['chunk'] === 'global' || $args['chunk'] === 'woocommerce' ) {
				return false;
			}
		}

		if ( $args['context'] === 'files:global' ) {
			if ( $args['chunk'] === 'woocommerce' ) {
				if ( ! class_exists( 'WooCommerce' ) ) {
					return false;
				}
			} else {
				if ( $args['chunk'] !== 'global' ) {
					return false;
				}
			}
		}
	}

	return true;
}

/**
 * Evaluate a file with dynamic styles.
 *
 * @param string $name Name of dynamic CSS file.
 * @param array $variables list of data to pass in file.
 * @throws Error When $css not provided.
 */
function rishi__cb_customizer_theme_get_dynamic_styles( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'path'        => null,
			'name'        => '',
			'css'         => null,

			'context'     => null,
			'chunk'       => null,
			'forced_call' => false,
			'prefixes'    => null,
		)
	);

	if ( ! isset( $args['css'] ) ) {
		throw new Error( '$css instance not provided. This is required!' );
	}

	if ( ! rishi__cb_customizer_dynamic_styles_should_call( $args ) ) {
		return;
	}

	if ( ! $args['path'] ) {
		$args['path'] = \RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/dynamic-styles/' . $args['name'] . '.php';
	}

	if ( ! $args['prefixes'] ) {
		rishi__cb_customizer_get_variables_from_file( $args['path'], array(), $args );
	} else {
		foreach ( $args['prefixes'] as $prefix ) {
			rishi__cb_customizer_get_variables_from_file(
				$args['path'],
				array(),
				array_merge(
					$args,
					array(
						'prefix' => $prefix,
					)
				)
			);
		}
	}
}
