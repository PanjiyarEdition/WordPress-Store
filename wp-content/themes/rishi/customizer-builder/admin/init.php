<?php

// require \RISHI_CUSTOMIZER_BUILDER_DIR__ . '/admin/helpers/all.php';

/**
 * Admin Section initialization
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU General Public License
 */

add_action(
	'enqueue_block_editor_assets',
	function () {
		$theme = rishi__cb_customizer_get_wp_parent_theme();
		global $post;

		$m = new \rishi__cb_customizer_Fonts_Manager();
		$m->load_editor_fonts();

		$options = rishi__cb_customizer_get_options( 'meta/' . get_post_type( $post ) );

		if ( rishi__cb_customizer_manager()->post_types->is_supported_post_type() ) {
			$options = rishi__cb_customizer_get_options(
				'meta/default',
				array(
					'post_type' => get_post_type_object( get_post_type( $post ) ),
				)
			);
		}

		$options = apply_filters(
			'rishi:editor:post_meta_options',
			$options,
			get_post_type( $post )
		);

		if ( is_rtl() ) {
			wp_enqueue_style(
				'rt-main-editor-rtl-styles',
				RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . '/editor-rtl.min.css',
				array( 'rt-main-editor-styles' ),
				$theme->get( 'Version' )
			);
		}

		if( !( 'rishi-portfolio' === get_post_type() ) ){
			wp_enqueue_script(
				'rt-main-editor-scripts',
				RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . '/editor/editor.js',
				array( 'wp-plugins', 'wp-element', 'rt-options-scripts' ),
				$theme->get( 'Version' ),
				true
			);
	    }  

		// Add Translation support for editor JS
		wp_set_script_translations( 'rt-main-editor-scripts', 'rishi' );

		$post_type = get_current_screen()->post_type;
		$maybe_cpt = rishi__cb_customizer_manager()
			->post_types
			->is_supported_post_type();

		if ( $maybe_cpt ) {
			$post_type = $maybe_cpt;
		}

		$prefix = rishi__cb_customizer_manager()->screen->get_admin_prefix( $post_type );

		$page_structure = get_theme_mod(
			$post_type . '_sidebar_layout',
			'right-sidebar'
		);

		$background_source = get_theme_mod(
			$prefix . '_background',
			rishi__cb_customizer_background_default_value(
				array(
					'backgroundColor' => array(
						'default' => array(
							'color' => \Rishi_CSS_Injector::get_skip_rule_keyword(),
						),
					),
				)
			)
		);

		if (
			isset( $background_source['background_type'] )
			&&
			$background_source['background_type'] === 'color'
			&&
			isset( $background_source['backgroundColor']['default']['color'] )
			&&
			$background_source['backgroundColor']['default']['color'] === \Rishi_CSS_Injector::get_skip_rule_keyword()
		) {
			$background_source = get_theme_mod(
				'site_background',
				rishi__cb_customizer_background_default_value(
					array(
						'backgroundColor' => array(
							'default' => array(
								'color' => '#f8f9fb',
							),
						),
					)
				)
			);
		}

		$localize = array(
			'post_options'                  => $options,
			'default_page_structure'        => $page_structure,

			'default_background'            => $background_source,
			'default_content_style'         => get_theme_mod(
				$prefix . '_content_style'
			),

			'default_content_background'    => get_theme_mod(
				$prefix . '_content_background',
				rishi__cb_customizer_background_default_value(
					array(
						'backgroundColor' => array(
							'default' => array(
								'color' => '#ffffff',
							),
						),
					)
				)
			),

			'default_boxed_content_spacing' => get_theme_mod(
				$prefix . '_boxed_content_spacing',
				array(
					'desktop' => rishi__cb_customizer_spacing_value(
						array(
							'linked' => true,
							'top'    => '40px',
							'left'   => '40px',
							'right'  => '40px',
							'bottom' => '40px',
						)
					),
					'tablet'  => rishi__cb_customizer_spacing_value(
						array(
							'linked' => true,
							'top'    => '35px',
							'left'   => '35px',
							'right'  => '35px',
							'bottom' => '35px',
						)
					),
					'mobile'  => rishi__cb_customizer_spacing_value(
						array(
							'linked' => true,
							'top'    => '20px',
							'left'   => '20px',
							'right'  => '20px',
							'bottom' => '20px',
						)
					),
				)
			),

			'default_content_boxed_radius'  => get_theme_mod(
				$prefix . '_content_boxed_radius',
				rishi__cb_customizer_spacing_value(
					array(
						'linked' => true,
						'top'    => '3px',
						'left'   => '3px',
						'right'  => '3px',
						'bottom' => '3px',
					)
				)
			),

			'default_content_boxed_shadow'  => get_theme_mod(
				$prefix . '_content_boxed_shadow',
				rishi__cb_customizer_box_shadow_value(
					array(
						'enable'   => true,
						'h_offset' => 0,
						'v_offset' => 12,
						'blur'     => 18,
						'spread'   => -6,
						'inset'    => false,
						'color'    => array(
							'color' => 'rgba(34, 56, 101, 0.04)',
						),
					)
				)
			),
		);

		wp_localize_script(
			'rt-main-editor-scripts',
			'ct_editor_localizations',
			$localize
		);
	}
);

add_filter(
	'admin_body_class',
	function ( $classes ) {
		global $post;

		if ( ! isset( $post->ID ) ) {
			return $classes;
		}

		$current_screen = get_current_screen();

		if ( ! $current_screen->is_block_editor() ) {
			return $classes;
		}

		$default_page_structure = rishi__cb_customizer_default_akg(
			'page_structure_type',
			rishi__cb_customizer_get_post_options( $post->ID ),
			'default'
		);

		
		if ($current_screen->base === "post") { //For default post type
			$defaults = rishi__cb__get_layout_defaults();
			$post_layout    = get_theme_mod('post_sidebar_layout', $defaults['post_sidebar_layout']); //Global Layout/Position for Posts

			$sidebar_layout = rishi__cb_customizer_default_akg(
				'page_structure_type',
				rishi__cb_customizer_get_post_options($post->ID),
				'default-sidebar'
			);

			if ( $sidebar_layout == 'no-sidebar' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'no-sidebar' ) ) {
				$classes .= ' full-width'; //Fullwidth
			}elseif( $sidebar_layout == 'centered' || ( $sidebar_layout == 'default-sidebar' && $post_layout == 'centered' ) ){				
				$classes .= ' full-width centered';
			}elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ){
				$classes .= ' rightsidebar';
			}elseif( ( $sidebar_layout == 'default-sidebar' && $post_layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ){
				$classes .= ' leftsidebar';
			}else{
				$classes .= ' default-sidebar';
			}
		}

		$page_content_style_source = rishi__cb_customizer_default_akg(
            'content_style_source',
            rishi__cb_customizer_get_post_options( $post->ID ),
            'inherit'
        );

        if ($page_content_style_source === 'custom') {
            $page_content_area = rishi__cb_customizer_default_akg(
                'content_style',
                rishi__cb_customizer_get_post_options( $post->ID ),
                'boxed'
            );
			if( $page_content_area == 'boxed' ){
				$classes .=' box-layout';
			}elseif( $page_content_area == 'content_boxed' ){
				$classes .=' content-box-layout';
			}else{
				$classes .=' default-layout';
			}
        }

		if ( $default_page_structure === 'default' ) {
			$post_type = get_current_screen()->post_type;
			$maybe_cpt = rishi__cb_customizer_manager()
				->post_types
				->is_supported_post_type();

			if ( $maybe_cpt ) {
				$post_type = $maybe_cpt;
			}

			$default_page_structure = get_theme_mod(
				$post_type . '_sidebar_layout',
				'right-sidebar'
			);
		}

		$class = 'narrow';

		if ( $default_page_structure === 'type-4' ) {
			$class = 'normal';
		}

		$class = 'rt-structure-' . $class;

		if ( get_post_type( $post ) === 'rt_hooked_element' ) {
			$atts          = rishi__cb_customizer_get_post_options( $post->ID );
			$template_type = get_post_meta( $post->ID, 'template_type', true );

			if ( rishi__cb_customizer_default_akg(
				'has_content_block_structure',
				$atts,
				$template_type === 'hook' ? 'no' : 'yes'
			) ) {
				$page_structure = rishi__cb_customizer_default_akg(
					'content_block_structure',
					$atts,
					'type-4'
				);

				$class = 'narrow';

				if ( $page_structure === 'type-4' ) {
					$class = 'normal';
				}

				$class = 'rt-structure-' . $class;
			} else {
				$class = '';
			}
		}

		if ( get_post_type( $post ) === 'post' || get_post_type( $post ) === 'page' ) {

			$content_style_source = rishi__cb_customizer_default_akg(
				'content_style_source',
				rishi__cb_customizer_get_post_options( $post->ID ),
				'inherit'
			);

			$post_content_area = rishi__cb_customizer_default_akg(
				'content_style',
				rishi__cb_customizer_get_post_options( $post->ID ),
				'boxed'
			);

			$classes .= ' ' . $post_content_area;
		}

		$classes .= ' ' . $class;

		return $classes;
	}
);

if ( ! function_exists( 'rishi__cb_customizer_get_jed_locale_data' ) ) {
	function rishi__cb_customizer_get_jed_locale_data( $domain  ) {
		 $translations = get_translations_for_domain( $domain );

		$locale = array(
			'' => array(
				'domain' => $domain,
				'lang'   => is_admin() ? get_user_locale() : get_locale(),
			),
		);

		if ( ! empty( $translations->headers['Plural-Forms'] ) ) {
			$locale['']['plural_forms'] = $translations->headers['Plural-Forms'];
		}

		foreach ( $translations->entries as $msgid => $entry ) {
			$locale[ $msgid ] = $entry->translations;
		}

		return $locale;
	}
}

add_action(
	'admin_enqueue_scripts',
	function () {
		$theme = rishi__cb_customizer_get_wp_parent_theme();

		$current_screen = get_current_screen();

		if (
			$current_screen->id
			&&
			strpos( $current_screen->id, 'forminator' ) !== false
		) {
			return;
		}

		wp_enqueue_media();

		$events_vars = require \RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/events/events.asset.php';
		wp_register_script(
			'rt-custom-events',
			\RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . 'events/events.js',
			$events_vars['dependencies'],
			$events_vars['version'],
			true
		);

		global $wp_customize;

		if ( ! isset( $wp_customize ) ) {
			wp_enqueue_editor();
			$options_vars = require RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/options/options.asset.php';
			wp_enqueue_script(
				'rt-options-scripts',
				RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . '/options/options.js',
				$options_vars['dependencies'],
				$options_vars['version']
			);

			// Add Translation support for options JS
			wp_set_script_translations( 'rt-options-scripts', 'rishi' );
		}

		$locale_data_ct = rishi__cb_customizer_get_jed_locale_data( 'rishi' );

		wp_add_inline_script(
			'wp-i18n',
			'wp.i18n.setLocaleData( ' . wp_json_encode( $locale_data_ct ) . ', "rishi" );'
		);

		wp_enqueue_style(
			'rt-options-styles',
			RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/dist/main/main.css',
			array( 'wp-components' ),
			$theme->get( 'Version' )
		);

		if ( is_rtl() ) {
			wp_enqueue_style(
				'rt-options-rtl-styles',
				RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/css/customizer/options-rtl.css',
				array( 'rt-options-styles' ),
				$theme->get( 'Version' )
			);
		}

		wp_localize_script(
			'rt-options-scripts',
			'rishi__cb_localizations',
			array(
				'gradients'         => get_theme_support( 'editor-gradient-presets' )[0],
				'is_dev_mode'       => ! ! ( defined( 'RISHI_DEVELOPMENT_MODE' ) && RISHI_DEVELOPMENT_MODE ),
				'nonce'             => wp_create_nonce( 'rt-ajax-nonce' ),
				'public_url'        => RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI,
				'static_public_url' => RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/src/',
				'ajax_url'          => admin_url( 'admin-ajax.php' ),
				'rest_url'          => get_rest_url(),
				'customizer_url'    => admin_url( '/customize.php?autofocus' ),
				'search_url'        => get_search_link( 'QUERY_STRING' ),
			)
		);
	},
	50
);
