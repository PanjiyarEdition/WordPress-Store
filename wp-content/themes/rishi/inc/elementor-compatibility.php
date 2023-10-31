<?php
/**
 * Rishi\Elementor\Component class
 *
 * @package rishi
 */

namespace Rishi\Elementor;

use Elementor;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Controls\Repeater as Global_Style_Repeater;
use Elementor\Repeater;
use Elementor\Plugin;
class Rishi_Elementor_Widget_Loader{

	private static $_instance = null;

	public static function instance(){
		if ( is_null(self::$_instance) ) {
		self::$_instance = new self();
		}
		return self::$_instance;
	}

    public function __construct(){
		
		add_action( 'customize_save_after', array( $this, 'elementor_add_theme_colors' ) );

		add_action( 'rest_request_after_callbacks', array( $this, 'elementor_api_add_theme_colors' ), 999, 3 );
		add_filter( 'rest_request_after_callbacks', array( $this, 'display_global_colors_front_end' ), 999, 3 );
		add_filter( 'rishi_dynamic_theme_css', array( $this, 'generate_global_elementor_style' ), 11 );

    }

	/**
	 * Add some css styles for Restrict Content Pro
	 */
	public function elementor_add_theme_colors($return_data = false) {
		if ( apply_filters( 'rishi_add_global_colors_to_elementor', true ) ) {

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#216BDB' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#e9f1fa' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);

			$theme_colors = array(
				array(
					'_id' => 'rishi1',
					'title'  => __( 'Theme Color 1', 'rishi' ),
					'color' => $paletteColors['color1'],
				),
				array(
					'_id' => 'rishi2',
					'title'  => __( 'Theme Color 2', 'rishi' ),
					'color' => $paletteColors['color2'],
				),
				array(
					'_id' => 'rishi3',
					'title'  => __( 'Theme Color 3', 'rishi' ),
					'color' => $paletteColors['color3'],
				),
				array(
					'_id' => 'rishi4',
					'title'  => __( 'Theme Color 4', 'rishi' ),
					'color' => $paletteColors['color4'],
				),
				array(
					'_id' => 'rishi5',
					'title'  => __( 'Theme Color 5', 'rishi' ),
					'color' => $paletteColors['color5'],
				),
				array(
					'_id' => 'rishi6',
					'title'  => __( 'Theme Color 6', 'rishi' ),
					'color' => $paletteColors['color6'],
				),
				array(
					'_id' => 'rishi7',
					'title'  => __( 'Theme Color 7', 'rishi' ),
					'color' => $paletteColors['color7'],
				),
				array(
					'_id' => 'rishi8',
					'title'  => __( 'Theme Color 8', 'rishi' ),
					'color' => $paletteColors['color8'],
				),
			);
			$theme_placeholder_colors = array(
				array(
					'_id' => 'palette1',
					'title'  => __( 'Theme Color 1', 'rishi' ),
					'color' => $paletteColors['color1'],
				),
				array(
					'_id' => 'palette2',
					'title'  => __( 'Theme Color 2', 'rishi' ),
					'color' => $paletteColors['color2'],
				),
				array(
					'_id' => 'palette3',
					'title'  => __( 'Theme Color 3', 'rishi' ),
					'color' => $paletteColors['color3'],
				),
				array(
					'_id' => 'palette4',
					'title'  => __( 'Theme Color 4', 'rishi' ),
					'color' => $paletteColors['color4'],
				),
				array(
					'_id' => 'palette5',
					'title'  => __( 'Theme Color 5', 'rishi' ),
					'color' => $paletteColors['color5'],
				),
				array(
					'_id' => 'palette6',
					'title'  => __( 'Theme Color 6', 'rishi' ),
					'color' => $paletteColors['color6'],
				),
				array(
					'_id' => 'palette7',
					'title'  => __( 'Theme Color 7', 'rishi' ),
					'color' => $paletteColors['color7'],
				),
				array(
					'_id' => 'palette8',
					'title'  => __( 'Theme Color 8', 'rishi' ),
					'color' => $paletteColors['color8'],
				),
			);
			// Prevent Errors.
			if ( ! method_exists( \Elementor\Plugin::$instance->kits_manager, 'get_current_settings' ) ) {
				return;
			}
			$current = \Elementor\Plugin::$instance->kits_manager->get_current_settings();
		
			if ( $current && isset( $current['custom_colors'] ) ) {
				$custom_colors = $current['custom_colors'];
				$rishi_add_array = array(
					'rishi1' => true,
					'rishi2' => true,
					'rishi3' => true,
					'rishi4' => true,
					'rishi5' => true,
					'rishi6' => true,
					'rishi7' => true,
					'rishi8' => true,
				);
				$rishi_add = true;
				$clear_cache = false;
				$rishi = array( 'rishi1', 'rishi2', 'rishi3', 'rishi4', 'rishi5', 'rishi6', 'rishi7', 'rishi8' );
				foreach ( $custom_colors as $key => $value ) {
					if ( is_array( $value ) && isset( $value['_id'] ) && in_array( $value['_id'], $rishi ) ) {
						$rishi_add = false;
						if ( $value['_id'] == 'rishi1' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[0]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi1'] = false;
							$custom_colors[ $key ] = $theme_colors[0];
						}
						if ( $value['_id'] == 'rishi2' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[1]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi2'] = false;
							$custom_colors[ $key ] = $theme_colors[1];
						}
						if ( $value['_id'] == 'rishi3' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[2]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi3'] = false;
							$custom_colors[ $key ] = $theme_colors[2];
						}
						if ( $value['_id'] == 'rishi4' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[3]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi4'] = false;
							$custom_colors[ $key ] = $theme_colors[3];
						}
						if ( $value['_id'] == 'rishi5' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[4]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi5'] = false;
							$custom_colors[ $key ] = $theme_colors[4];
						}
						if ( $value['_id'] == 'rishi6' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[5]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi6'] = false;
							$custom_colors[ $key ] = $theme_colors[5];
						}
						if ( $value['_id'] == 'rishi7' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[6]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi7'] = false;
							$custom_colors[ $key ] = $theme_colors[6];
						}
						if ( $value['_id'] == 'rishi8' ) {
							if ( $custom_colors[ $key ]['color'] !== $theme_colors[7]['color'] ) {
								$clear_cache = true;
							}
							$color_add_array['rishi8'] = false;
							$custom_colors[ $key ] = $theme_colors[7];
						}
					}
				}

				if ( $rishi_add ) {
					$custom_colors = array_merge( $theme_colors, $custom_colors );
				} else {
					$i       = 0;
					$new_add = array();
					foreach ( $rishi_add_array as $key => $value ) {
						if ( $value ) {
							$new_add[] = $theme_colors[ $i ];
						}
						$i++;
					}
					// Somehow colors were removed so we need to add them back in.
					if ( ! empty( $new_add ) ) {
						$custom_colors = array_merge( $new_add, $custom_colors );
					}
				}
				\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'custom_colors', $custom_colors );
				\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'rishi_colors', $theme_placeholder_colors );
				// Refresh cache.
				// If the palette was updated in the customizer then we need to clear all the css.
				\Elementor\Plugin::instance()->files_manager->clear_cache();
			}
			
		}
	}

	/**
	 * Display theme global colors to Elementor Global colors
	 *
	 * @since 3.7.0
	 * @param object          $response rest request response.
	 * @param array           $handler Route handler used for the request.
	 * @param WP_REST_Request $request Request used to generate the response.
	 * @return object
	 */
	public function elementor_api_add_theme_colors( $response, $handler, $request ) {

		$route = $request->get_route();

		if ( '/elementor/v1/globals' != $route ) {
			return $response;
		}

		$data = $response->get_data();

		$paletteColors = rishi__cb_customizer_get_colors(
			get_theme_mod('colorPalette'),
			[
				'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
				'color2' => [ 'color' => '#292929' ],
				'color3' => [ 'color' => '#216BDB' ],
				'color4' => [ 'color' => '#5081F5' ],
				'color5' => [ 'color' => '#ffffff' ],
				'color6' => [ 'color' => '#EDF2FE' ],
				'color7' => [ 'color' => '#e9f1fa' ],
				'color8' => [ 'color' => '#F9FBFE' ],
			]
		);
		$index = 1;
		foreach ( $paletteColors as $key => $color ) {

			$slug = 'rishi'. $index;
			// Remove hyphens from slug.
			$no_hyphens = str_replace( '-', '', $slug );

			$data['colors'][ $no_hyphens ] = array(
				'id'    => esc_attr( $no_hyphens ),
				'title' => 'Theme Color ' . $index,
				'value' => $color,
			);
			$index++;
		}

		$response->set_data( $data );
		return $response;
	}

		/**
		 * Display global paltte colors on Elementor front end Page.
		 *
		 * @since 3.7.0
		 * @param object          $response rest request response.
		 * @param array           $handler Route handler used for the request.
		 * @param WP_REST_Request $request Request used to generate the response.
		 * @return object
		 */
		public function display_global_colors_front_end( $response, $handler, $request ) {

			$route = $request->get_route();

			if ( 0 !== strpos( $route, '/elementor/v1/globals' ) ) {
				return $response;
			}

			$slug_map      = array();
			$palette_slugs = array( 'rishi1', 'rishi2', 'rishi3', 'rishi4', 'rishi5', 'rishi6', 'rishi7', 'rishi8' );

			foreach ( $palette_slugs as $key => $slug ) {
				// Remove hyphens as hyphens do not work with Elementor global styles.
				$no_hyphens              = str_replace( '-', '', $slug );
				$slug_map[ $no_hyphens ] = $key;
			}

			$rest_id = substr( $route, strrpos( $route, '/' ) + 1 );

			if ( ! in_array( $rest_id, array_keys( $slug_map ), true ) ) {
				return $response;
			}

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#216BDB' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#e9f1fa' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);
			$index = isset( $slug_map[ $rest_id ] ) && 0 == $slug_map[ $rest_id ] ? 1 : $slug_map[ $rest_id ];
			$palette_ck = 'color' . $index;
			$response = rest_ensure_response(
				array(
					'id'    => esc_attr( $rest_id ),
					'title' => 'rishi' . esc_html( $slug_map[ $rest_id ] ),
					'value' => $paletteColors[$palette_ck],
				)
			);
			
			return $response;
		}

		/**
		 * Generate CSS variable style for Elementor.
		 *
		 * @since 3.7.0
		 * @param string $dynamic_css Dynamic CSS.
		 * @return object
		 */
		public function generate_global_elementor_style( $dynamic_css ) {

			$palette_style  = array();
			$style          = array();

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#216BDB' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#e9f1fa' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);

			$index = 1;
			foreach ( $paletteColors as $key => $color ) {
	
				$slug = 'rishi'. $index;
				// Remove hyphens from slug.
				$no_hyphens = str_replace( '-', '', $slug );
	
				$variable_key           = '--e-global-color-' . str_replace( '-', '', $slug );
				$style[ $variable_key ] = $color;
				$index++;
			}

			$palette_style[':root'] = $style;
			$dynamic_css           .= rishi_parse_css( $palette_style );

			return $dynamic_css;
		}

    /**
	 * Add in new Custom Controls for Theme Colors.
	 */
	public function elementor_add_theme_color_controls( $tab, $args ) {
		if ( apply_filters( 'rishi_add_global_colors_to_elementor', true ) ) {

			$paletteColors = rishi__cb_customizer_get_colors(
				get_theme_mod('colorPalette'),
				[
					'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
					'color2' => [ 'color' => '#292929' ],
					'color3' => [ 'color' => '#216BDB' ],
					'color4' => [ 'color' => '#5081F5' ],
					'color5' => [ 'color' => '#ffffff' ],
					'color6' => [ 'color' => '#EDF2FE' ],
					'color7' => [ 'color' => '#e9f1fa' ],
					'color8' => [ 'color' => '#F9FBFE' ],
				]
			);


			$tab->start_controls_section(
				'section_theme_global_colors',
				array(
					'label' => __( 'Theme Global Colors', 'rishi' ),
					'tab' => 'global-colors',
				)
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'title',
				array(
					'type' => Controls_Manager::TEXT,
					'label_block' => true,
					'required' => true,
				)
			);

			// Color Value
			$repeater->add_control(
				'color',
				array(
					'type' => Controls_Manager::COLOR,
					'label_block' => true,
					'dynamic' => [],
					'selectors' => array(
						'{{WRAPPER}}.el-is-editing' => '--global-{{_id.VALUE}}: {{VALUE}}',
					),
					'global' => array(
						'active' => false,
					),
				)
			);

			

			$theme_colors = array(
				array(
					'_id' => 'color1',
					'title'  => __( 'Theme Accent', 'rishi' ),
					'color' => $paletteColors['color1'],
				),
				array(
					'_id' => 'color2',
					'title'  => __( 'Theme Accent - alt', 'rishi' ),
					'color' => $paletteColors['color2'],
				),
				array(
					'_id' => 'color3',
					'title'  => __( 'Strongest text', 'rishi' ),
					'color' => $paletteColors['color3'],
				),
				array(
					'_id' => 'color4',
					'title'  => __( 'Strong Text', 'rishi' ),
					'color' => $paletteColors['color4'],
				),
				array(
					'_id' => 'color5',
					'title'  => __( 'Medium text', 'rishi' ),
					'color' => $paletteColors['color5'],
				),
				array(
					'_id' => 'color6',
					'title'  => __( 'Subtle Text', 'rishi' ),
					'color' => $paletteColors['color6'],
				),
				array(
					'_id' => 'color7',
					'title'  => __( 'Subtle Background', 'rishi' ),
					'color' => $paletteColors['color7'],
				),
				array(
					'_id' => 'color8',
					'title'  => __( 'Additional Background', 'rishi' ),
					'color' => $paletteColors['color8'],
				),
			);

			$tab->add_control(
				'rishi_colors',
				array(
					'type' => Global_Style_Repeater::CONTROL_TYPE,
					'fields' => $repeater->get_controls(),
					'default' => $theme_colors,
					'item_actions' => array(
						'add' => false,
						'remove' => false,
					),
				)
			);
			$tab->end_controls_section();
		}
	}
}
// Instantiate Plugin Class
Rishi_Elementor_Widget_Loader::instance();
