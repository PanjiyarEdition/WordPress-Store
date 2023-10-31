<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

/**
 * Class WD_ASL_init
 *
 * AJAX SEARCH Lite initializator Class
 */
class WD_ASL_Init {

    /**
     * Core singleton class
     * @var WD_ASL_Init self
     */
    private static $_instance;

    private function __construct() {
        wd_asl()->db = WD_ASL_DBMan::getInstance();

        load_plugin_textdomain( 'ajax-search-lite', false, ASL_DIR . '/languages' );
    }

    /**
     * Runs on activation
     */
    public function activate() {

        WD_ASL_DBMan::getInstance()->create();

        $this->chmod();
        $this->backwards_compatibility_fixes();

        /**
         * Store the version number after everything is done. This is going to help distinguishing
         * stored asl_version from the ASL_CURR_VER variable. These two are different in cases:
         *  - Uninstalling, installing new versions
         *  - Uploading and overwriting old version with a new one
         */
        update_option('asl_version', ASL_CURRENT_VERSION);
    }

    /**
     *  Checks if the user correctly updated the plugin and fixes if not
     */
    public function safety_check() {
        $curr_stored_ver = get_option('asl_version', 0);

        // Run the re-activation actions if this is actually a newer version
        if ($curr_stored_ver != ASL_CURRENT_VERSION) {
            $this->activate();
        }
    }

    /**
     * Fix known backwards incompatibilities
     */
    public function backwards_compatibility_fixes() {
		$comp = wd_asl()->o['asl_compatibility'];

		// 4.10
		if ( isset( $comp['old_browser_compatibility']) ) {
			unset( wd_asl()->o['asl_compatibility']['old_browser_compatibility'] );
			asl_save_option('asl_compatibility');
		}

		// 4.10.1 - Turn off the jquery script versions
		if ( $comp['js_source'] == 'min' || $comp['js_source'] == 'min-scoped' ) {
			wd_asl()->o['asl_compatibility']['js_source'] = 'jqueryless-min';
			asl_save_option('asl_compatibility');
		} else if ( $comp['js_source'] == 'nomin' || $comp['js_source'] == 'nomin-scoped' ) {
			wd_asl()->o['asl_compatibility']['js_source'] = 'jqueryless-nomin';
			asl_save_option('asl_compatibility');
		}

        // 4.10.4
        if ( isset($comp['load_scroll_js']) ) {
            unset( wd_asl()->o['asl_compatibility']['load_scroll_js']);
            asl_save_option('asl_compatibility');
        }

        // 4.18.2
        $ana = wd_asl()->o['asl_analytics'];
        // Analytics Options fixes 4.8.2
        if ( isset($ana['analytics']) && $ana['analytics'] == 1 ) {
            wd_asl()->o['asl_analytics']['analytics'] = 'pageview';
            asl_save_option('asl_analytics');
        }

        /*
         * - Get instances
         * - Check options
         * - Transition to new options based on old ones
         * - Save instances
         */
        foreach (wd_asl()->instances->get() as $si) {
            $sd = $si['data'];

            // ------------------------- 4.7.3 -----------------------------
            // Primary and secondary fields
            $values = array('-1', '0', '1', '2', 'c__f');
            $adv_fields = array(
                'titlefield',
                'descriptionfield'
            );
            foreach($adv_fields as $field) {
                // Force string conversion for proper comparision
                if ( isset($sd[$field]) && !in_array($sd[$field].'', $values) ) {
                    // Custom field value is selected
                    $sd[$field.'_cf'] = $sd[$field];
                    $sd[$field] = 'c__f';
                }
            }

            // ------------------------- 4.7.13 -----------------------------
            if ( isset($sd['redirectonclick']) ) {
                if ( $sd['redirectonclick'] == 0 )
                    $sd['click_action'] = 'ajax_search';
                unset($sd['redirectonclick']);
            }
            if ( isset($sd['redirect_on_enter']) ) {
                if ( $sd['redirect_on_enter'] == 0 )
                    $sd['return_action'] = 'ajax_search';
                unset($sd['redirect_on_enter']);
            }
            // ------------------------- 4.7.14 -----------------------------
            if ( isset($sd['triggeronclick']) ) {
                unset($sd['triggeronclick']);
            }

            // ------------------------- 4.7.15 -----------------------------
            // Before, this was a string
            if ( isset($sd['customtypes']) && !is_array($sd['customtypes']) ) {
                $sd['customtypes'] = explode('|', $sd['customtypes']);
                foreach ($sd['customtypes'] as $ck => $ct) {
                    if ( $ct == '' )
                        unset($sd['customtypes'][$ck]);
                }
            }
            // No longer exists
            if ( isset($sd['selected-customtypes']) )
                unset($sd['selected-customtypes']);
            // No longer exists
            if ( isset($sd['searchinpages']) ) {
                if ( $sd['searchinpages'] == 1 && !in_array('page', $sd['customtypes']) ) {
                    array_unshift($sd['customtypes'] , 'page');
                }
                unset($sd['searchinpages']);
            }
            // No longer exists
            if ( isset($sd['searchinposts']) ) {
                if ( $sd['searchinposts'] == 1 && !in_array('post', $sd['customtypes']) ) {
                    array_unshift($sd['customtypes'] , 'post');
                }
                unset($sd['searchinposts']);
            }

            // ------------------------- 4.18.1 -----------------------------
            // For non-existence checks use the raw_data array
            if ( !isset($si['raw_data']['box_width_tablet']) ) {
                $sd['box_width_tablet'] = $sd['box_width'];
                $sd['box_width_phone'] = $sd['box_width'];
            }

			// ------------------------- 4.8.7 -----------------------------
			// No longer exists
			if ( isset($sd['showsearchinpages']) ) {
				if ( $sd['showsearchinpages'] == 1  ) {
					if ($sd['showcustomtypes'] == '') {
						$sd['showcustomtypes'] = 'page;' . $sd['searchinpagestext'];
					} else {
						$sd['showcustomtypes'] = 'page;' . $sd['searchinpagestext'] . '|' . $sd['showcustomtypes'];
					}
				}
				unset($sd['showsearchinpages']);
				unset($sd['searchinpagestext']);
			}
			// No longer exists
			if ( isset($sd['showsearchinposts']) ) {
				if ( $sd['showsearchinposts'] == 1  ) {
					if ($sd['showcustomtypes'] == '') {
						$sd['showcustomtypes'] = 'post;' . $sd['searchinpoststext'];
					} else {
						$sd['showcustomtypes'] = 'post;' . $sd['searchinpoststext'] . '|' . $sd['showcustomtypes'];
					}
				}
				unset($sd['showsearchinposts']);
				unset($sd['searchinpoststext']);
			}

			if ( isset($sd['titlefield']) ) {
				$sd['primary_titlefield'] = $sd['titlefield'];
				$sd['primary_titlefield_cf'] = $sd['titlefield_cf'];
				unset($sd['titlefield']);
				unset($sd['titlefield_cf']);
			}

			if ( isset($sd['descriptionfield']) ) {
				$sd['primary_descriptionfield'] = $sd['descriptionfield'];
				$sd['primary_descriptionfield_cf'] = $sd['descriptionfield_cf'];
				unset($sd['descriptionfield']);
				unset($sd['descriptionfield_cf']);
			}

			if ( isset($sd['redirect_enter_to']) ) {
				$sd['return_action'] = $sd['redirect_enter_to'];
				$sd['click_action'] = $sd['redirect_click_to'];
				unset($sd['redirect_enter_to']);
				unset($sd['redirect_click_to']);
			}

            // At the end, update
            wd_asl()->instances->update(0, $sd);
        }
    }


    /**
     * Extra styles if needed..
     */
    public function styles() {}

	/**
	 * Prints the scripts
	 * @noinspection PhpInconsistentReturnPointsInspection
	 */
	public function scripts() {
		wd_asl()->scripts = WD_ASL_Scripts::getInstance();

		$exit1 = apply_filters('asl_load_css_js', false);
		$exit2 = apply_filters('asl_load_js', false);
		if ( $exit1 || $exit2 )
			return false;

		$performance_options = wd_asl()->o['asl_performance'];
		$analytics = wd_asl()->o['asl_analytics'];
		$comp_settings = wd_asl()->o['asl_compatibility'];
		$load_in_footer = $performance_options['load_in_footer'] == 1;
		$media_query = ASL_DEBUG == 1 ? asl_gen_rnd_str() : ASL_CURRENT_VERSION;
		if ( wd_asl()->manager->getContext() == "backend" ) {
			$js_minified = false;
			$js_optimized = true;
			$js_async_load = false;
		} else {
			$js_minified = $comp_settings['js_source'] == 'jqueryless-min';
			$js_optimized = $comp_settings['script_loading_method'] != 'classic';
			$js_async_load = $comp_settings['script_loading_method'] == 'optimized_async';
		}

		$single_highlight = false;
		$single_highlight_arr = array();
		$search = wd_asl()->instances->get();
		if (is_array($search) && count($search)>0) {
			foreach ($search as $s) {
				// $style and $id needed in the include
				if ( $s['data']['single_highlight'] == 1 ) {
					$single_highlight = true;
					$single_highlight_arr[] = array(
						'selector' => $s['data']['single_highlight_selector'],
						'scroll' => $s['data']['single_highlight_scroll'] == 1,
						'scroll_offset' => intval($s['data']['single_highlight_offset']),
						'whole' => $s['data']['single_highlightwholewords'] == 1,
					);
				}
			}
		}


		$ajax_url = admin_url('admin-ajax.php');
		if ( $performance_options['use_custom_ajax_handler'] == 1) {
			$ajax_url = ASL_URL . 'ajax_search.php';
		}

		if (ASL_DEBUG < 1 && strpos($comp_settings['js_source'], "scoped") !== false) {
			$scope = "asljQuery";
		} else {
			$scope = "jQuery";
		}

		$handle = 'wd-asl-ajaxsearchlite';
		if ( !$js_async_load ) {
			wd_asl()->scripts->enqueue(
				wd_asl()->scripts->get(array(), $js_minified, $js_optimized, array(
					'wd-asl-async-loader', 'wd-asl-prereq-and-wrapper'
				)),
				array(
					'media_query' => $media_query,
					'in_footer' => $load_in_footer
				)
			);
			$additional_scripts = wd_asl()->scripts->get(array(), $js_minified, $js_optimized,
				array('wd-asl-async-loader', 'wd-asl-prereq-and-wrapper', 'wd-asl-ajaxsearchlite-wrapper')
			);
		} else {
			$handle = 'wd-asl-prereq-and-wrapper';
			wd_asl()->scripts->enqueue(
				wd_asl()->scripts->get($handle, $js_minified, $js_optimized),
				array(
					'media_query' => $media_query,
					'in_footer' => $load_in_footer
				)
			);
			$additional_scripts = wd_asl()->scripts->get(array(), $js_minified, $js_optimized,
				array('wd-asl-async-loader',
					'wd-asl-prereq-and-wrapper',
					'wd-asl-ajaxsearchlite-wrapper',
					'wd-asl-ajaxsearchlite-prereq'
				)
			);
		}


		ASL_Helpers::addInlineScript( $handle, 'ASL', array(
			'wp_rocket_exception' => 'DOMContentLoaded',	// WP Rocket hack to prevent the wrapping of the inline script: https://docs.wp-rocket.me/article/1265-load-javascript-deferred
			'ajaxurl' => $ajax_url,
			'backend_ajaxurl' => admin_url('admin-ajax.php'),
			'js_scope' => $scope,
			'asl_url' => ASL_URL,
			'detect_ajax' => w_isset_def($comp_settings['detect_ajax'], 0),
			'media_query' => ASL_CURRENT_VERSION,
			'version' => ASL_CURRENT_VERSION,
			'pageHTML' => '',
			'additional_scripts' => $additional_scripts,
			'script_async_load' => $js_async_load,
			'init_only_in_viewport' => $comp_settings['init_instances_inviewport_only'] == 1,
			'font_url' => str_replace('http:', "", plugins_url()). '/ajax-search-lite/css/fonts/icons2.woff2',
			'css_async' => false,
			'highlight' => array(
				'enabled' => $single_highlight,
				'data' => $single_highlight_arr
			),
			'analytics' => array(
				'method' => $analytics['analytics'],
				'tracking_id' => $analytics['analytics_tracking_id'],
				'string' => $analytics['analytics_string'],
				'event' => array(
					'focus' => array(
						'active' => $analytics['gtag_focus'],
						'action' => $analytics['gtag_focus_action'],
						"category" => $analytics['gtag_focus_ec'],
						"label" =>  $analytics['gtag_focus_el'],
						"value" => $analytics['gtag_focus_value']
					),
					'search_start' => array(
						'active' => $analytics['gtag_search_start'],
						'action' => $analytics['gtag_search_start_action'],
						"category" => $analytics['gtag_search_start_ec'],
						"label" =>  $analytics['gtag_search_start_el'],
						"value" => $analytics['gtag_search_start_value']
					),
					'search_end' => array(
						'active' => $analytics['gtag_search_end'],
						'action' => $analytics['gtag_search_end_action'],
						"category" => $analytics['gtag_search_end_ec'],
						"label" =>  $analytics['gtag_search_end_el'],
						"value" => $analytics['gtag_search_end_value']
					),
					'magnifier' => array(
						'active' => $analytics['gtag_magnifier'],
						'action' => $analytics['gtag_magnifier_action'],
						"category" => $analytics['gtag_magnifier_ec'],
						"label" =>  $analytics['gtag_magnifier_el'],
						"value" => $analytics['gtag_magnifier_value']
					),
					'return' => array(
						'active' => $analytics['gtag_return'],
						'action' => $analytics['gtag_return_action'],
						"category" => $analytics['gtag_return_ec'],
						"label" =>  $analytics['gtag_return_el'],
						"value" => $analytics['gtag_return_value']
					),
					'facet_change' => array(
						'active' => $analytics['gtag_facet_change'],
						'action' => $analytics['gtag_facet_change_action'],
						"category" => $analytics['gtag_facet_change_ec'],
						"label" =>  $analytics['gtag_facet_change_el'],
						"value" => $analytics['gtag_facet_change_value']
					),
					'result_click' => array(
						'active' => $analytics['gtag_result_click'],
						'action' => $analytics['gtag_result_click_action'],
						"category" => $analytics['gtag_result_click_ec'],
						"label" =>  $analytics['gtag_result_click_el'],
						"value" => $analytics['gtag_result_click_value']
					)
				)
			)
		), 'before', true);

		add_action('wp_print_footer_scripts', function() use($handle){
			$script_data = wd_asl()->instances->get_script_data();
			if ( count($script_data) > 0 ) {
				$script = "window.ASL_INSTANCES = [];";
				foreach ( $script_data as $id => $data ) {
					$script .= "window.ASL_INSTANCES[$id] = $data;";
				}
				wp_add_inline_script($handle, $script, 'before');
			}
		}, 0);
	}

    public function pluginReset( $triggerActivate = true ) {
        $options = array(
            'asl_version',
            'asl_glob_d',
            'asl_performance_def',
            'asl_performance',
            'asl_analytics_def',
            'asl_analytics',
            'asl_caching_def',
            'asl_caching',
            'asl_compatibility_def',
            'asl_compatibility',
            'asl_defaults',
            'asl_st_override',
            'asl_woo_override',
            'asl_stat',
            'asl_updates',
            'asl_updates_lc',
            'asl_performance_stats',
            'asl_recently_updated',
            'asl_debug_data'
        );
        foreach ($options as $o)
            delete_option($o);

        if ( $triggerActivate )
            $this->activate();
    }

    public function pluginWipe() {
        // Options
        $this->pluginReset( false );

        // Additional options
        $options = array(
            'asl_options',
            'asl_version',
            'asl_debug_data'
        );
        foreach ($options as $o)
            delete_option($o);

        // Database
        wd_asl()->db->delete();

        // Deactivate
        deactivate_plugins(ASL_FILE);
    }


    /**
     *  Tries to chmod the CSS and CACHE directories
     */
    public function chmod() {
        // Nothing to do here yet :)
    }


    /**
     *  If anything we need in the footer
     */
    public function footer() {

    }

    /**
     * Get the instane
     *
     * @return self
     */
    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
}