<?php
/**
 * Customizer Header Builder.
 *
 * @package customizer-builder
 */
namespace RISHI__\Customizer\Header;
/**
 * RISHI__\Customizer\Header\Builder.
 */
class Builder {

	private $default_value = null;

	private $section_value   = null;
	private $current_section = null;

	public function __construct() {
		 $patcher = new \Rishi_Header_Builder_Patcher();
		$patcher->mount_theme_mod_value_patcher();
	}

	public function get_default_value() {
		if ( $this->default_value ) {
			return $this->default_value;
		}

		$this->default_value = apply_filters(
			'rishi:header:default_value',
			array(
				'current_section' => 'type-1',
				'sections'        => array(
					$this->get_structure_for(
						array(
							'id'    => 'type-1',
							'mode'  => 'placements',
							'items' => array(
								'desktop' => array(
									'middle-row' => array(
										'start' => array( 'logo' ),
										'end'   => array( 'menu', 'search' ),
									),
								),

								'mobile'  => array(
									'middle-row' => array(
										'start' => array( 'logo' ),
										'end'   => array( 'trigger' ),
									),

									'offcanvas'  => array(
										'start' => array(
											'mobile-menu',
										),
									),
								),
							),
						)
					),

					$this->get_structure_for(
						array(
							'id'    => 'type-2',
							'mode'  => 'placements',
							'items' => array(

								'desktop' => array(
									'middle-row' => array(
										'start'  => array( 'search' ),
										'middle' => array( 'logo' ),
										'end'    => array( 'socials' ),
									),

									'bottom-row' => array(
										'middle' => array( 'menu' ),
									),
								),

								'mobile'  => array(
									'middle-row' => array(
										'start'  => array( 'search' ),
										'middle' => array( 'logo' ),
										'end'    => array( 'trigger' ),
									),

									'offcanvas'  => array(
										'start' => array(
											'mobile-menu',
										),
									),
								),
							),
						)
					),
				),
			),
			$this
		);

		return $this->default_value;
	}

	public function get_current_section_id() {
		return $this->get_current_section()['id'];
	}

	public function get_current_section() {
		if ( ! $this->current_section ) {
			$this->current_section = $this->get_section_value()['sections'][0];

			foreach ( $this->get_section_value()['sections'] as $single_section ) {
				if ( $single_section['id'] === $this->get_filtered_section_id() ) {
					$this->current_section = $single_section;
					break;
				}
			}
		}

		return $this->current_section;
	}

	public function get_structure_for( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'       => null,
				'name'     => null,
				'mode'     => 'placements',
				'items'    => array(),
				'settings' => array(),
			)
		);

		$args['items'] = wp_parse_args(
			$args['items'],
			array(
				'desktop' => array(),
				'mobile'  => array(),
			)
		);

		$args['items']['desktop'] = wp_parse_args(
			$args['items']['desktop'],
			array(
				'top-row'    => array(),
				'middle-row' => array(),
				'bottom-row' => array(),
				'offcanvas'  => array(),
			)
		);

		$args['items']['mobile'] = wp_parse_args(
			$args['items']['mobile'],
			array(
				'top-row'    => array(),
				'middle-row' => array(),
				'bottom-row' => array(),
				'offcanvas'  => array(),
			)
		);

		$base = array(
			'id'       => $args['id'],
			'mode'     => $args['mode'],
			'items'    => array(),
			'settings' => $args['settings'],
		);

		if ( $args['name'] ) {
			$base['name'] = $args['name'];
		}

		if ( $args['mode'] === 'placements' ) {
			$base['desktop'] = array(
				$this->get_bar_structure_for(
					array(
						'id'    => 'top-row',
						'mode'  => $args['mode'],
						'items' => $args['items']['desktop']['top-row'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'    => 'middle-row',
						'mode'  => $args['mode'],
						'items' => $args['items']['desktop']['middle-row'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'    => 'bottom-row',
						'mode'  => $args['mode'],
						'items' => $args['items']['desktop']['bottom-row'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'            => 'offcanvas',
						'mode'          => $args['mode'],
						'has_secondary' => false,
						'items'         => $args['items']['desktop']['offcanvas'],
					)
				),
			);

			$base['mobile'] = array(
				$this->get_bar_structure_for(
					array(
						'id'    => 'top-row',
						'mode'  => $args['mode'],
						'items' => $args['items']['mobile']['top-row'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'    => 'middle-row',
						'mode'  => $args['mode'],
						'items' => $args['items']['mobile']['middle-row'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'    => 'bottom-row',
						'mode'  => $args['mode'],
						'items' => $args['items']['mobile']['bottom-row'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'            => 'offcanvas',
						'mode'          => $args['mode'],
						'has_secondary' => false,
						'items'         => $args['items']['mobile']['offcanvas'],
					)
				),
			);
		}

		if ( $args['mode'] === 'rows' ) {
			$base['desktop'] = array(
				$this->get_bar_structure_for(
					array(
						'id'   => 'top-row',
						'mode' => $args['mode'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'   => 'middle-row',
						'mode' => $args['mode'],
					)
				),
				$this->get_bar_structure_for(
					array(
						'id'   => 'bottom-row',
						'mode' => $args['mode'],
					)
				),
			);
		}

		return $base;
	}

	private function get_bar_structure_for( $args = array() ) {
		$args = wp_parse_args(
			$args,
			array(
				'id'            => null,
				'mode'          => 'placements',
				'has_secondary' => true,
				'items'         => array(),
			)
		);

		$args['items'] = wp_parse_args(
			$args['items'],
			array(
				'start'        => array(),
				'middle'       => array(),
				'end'          => array(),
				'start-middle' => array(),
				'end-middle'   => array(),
			)
		);

		$placements = array(
			array(
				'id'    => 'start',
				'items' => $args['items']['start'],
			),
		);

		if ( $args['has_secondary'] ) {
			$placements[] = array(
				'id'    => 'middle',
				'items' => $args['items']['middle'],
			);
			$placements[] = array(
				'id'    => 'end',
				'items' => $args['items']['end'],
			);

			$placements[] = array(
				'id'    => 'start-middle',
				'items' => $args['items']['start-middle'],
			);
			$placements[] = array(
				'id'    => 'end-middle',
				'items' => $args['items']['end-middle'],
			);
		}

		return array_merge(
			array(
				'id' => $args['id'],
			),
			( $args['mode'] === 'rows' ? array(
				'row' => array(),
			) : array( 'placements' => $placements ) )
		);
	}

	public function enabled_on_this_page() {
		return rishi__cb_customizer_default_akg(
			'disable_header',
		 rishi__cb_customizer_get_post_options(),
			'no'
		) === 'no';
	}

	public function render() {
		if ( ! $this->enabled_on_this_page() ) {
			return '';
		}

		$renderer = new \Rishi_Header_Builder_Render();
		return $renderer->render();
	}

	public function get_section_value() {
		if ( ! $this->section_value || is_customize_preview() ) {
			$this->section_value = get_theme_mod(
				'header_placements',
				$this->get_default_value()
			);
		}

		return $this->section_value;
	}

	public function translation_keys() {
		$render   = new \Rishi_Header_Builder_Render();
		$sections = $this->get_section_value();

		$result = array();

		foreach ( $sections['sections'] as $section ) {
			foreach ( $section['items'] as $item ) {
				$nested_item = $render->get_item_config_for( $item['id'] );

				if (
					! isset( $nested_item['config']['translation_keys'] )
					||
					empty( $nested_item['config']['translation_keys'] )
				) {
					continue;
				}

				foreach ( $nested_item['config']['translation_keys'] as $key ) {
					if ( ! isset( $item['values'][ $key['key'] ] ) ) {
						continue;
					}

					$result[] = array_merge(
						$key,
						array(
							'key'   => 'header:' . $section['id'] . ':' . $item['id'] . ':' . $key['key'],
							'value' => $item['values'][ $key['key'] ],
						)
					);
				}
			}
		}

		return $result;
	}

	public function typography_keys() {
		 $render = new \Rishi_Header_Builder_Render();
		$section = $render->get_current_section();

		$result = array();

		foreach ( $section['items'] as $item ) {
			$nested_item = $render->get_item_config_for( $item['id'] );

			if (
				! isset( $nested_item['config']['typography_keys'] )
				||
				empty( $nested_item['config']['typography_keys'] )
			) {
				continue;
			}

			$data = $render->get_item_data_for( $item['id'] );

			foreach ( $nested_item['config']['typography_keys'] as $key ) {
				$result[] = rishi__cb_get_akv( $key, $data, array() );
			}
		}

		return $result;
	}

	public function patch_value_for( $processed_terms ) {
		$current_value = get_theme_mod(
			'header_placements',
			$this->get_default_value()
		);

		foreach ( $current_value['sections'] as $index => $header ) {
			if ( ! isset( $header['items'] ) ) {
				continue;
			}

			foreach ( $header['items'] as $item_index => $item ) {
				if ( ! isset( $item['values'] ) ) {
					continue;
				}

				if ( ! isset( $item['values']['menu'] ) ) {
					continue;
				}

				if ( ! isset( $processed_terms[ $item['values']['menu'] ] ) ) {
					continue;
				}

				$current_value['sections'][ $index ]['items'][ $item_index ]['values']['menu'] = $processed_terms[ $item['values']['menu'] ];
			}
		}

		set_theme_mod( 'header_placements', $current_value );
	}

	private function get_filtered_section_id() {
		if ( isset( $this->get_section_value()['__forced_static_header__'] ) ) {
			return $this->get_section_value()['__forced_static_header__'];
		}

		return apply_filters(
			'rishi:header:current_section_id',
			// $this->get_section_value()['current_section'],
			'type-1',
			$this->get_section_value()
		);
	}
}

class_alias( 'RISHI__\Customizer\Header\Builder', 'Rishi_Header_Builder' );
