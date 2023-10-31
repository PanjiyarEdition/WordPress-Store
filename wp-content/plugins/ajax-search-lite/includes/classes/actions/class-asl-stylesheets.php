<?php
if (!defined('ABSPATH')) die('-1');

if (!class_exists("WD_ASL_StyleSheets_Action")) {
    /**
     * Class WD_ASL_StyleSheets_Action
     *
     * Handles the non-ajax searches if activated.
     *
     * @class         WD_ASL_StyleSheets_Action
     * @version       1.0
     * @package       AjaxSearchLite/Classes/Actions
     * @category      Class
     * @author        Ernest Marcinko
     */
    class WD_ASL_StyleSheets_Action extends WD_ASL_Action_Abstract {

        /**
         * Holds the inline CSS
         *
         * @var string
         */
        private static $inline_css = "";

        /**
         * This function is bound as the handler
         */
        public function handle() {
			global $pagenow;

            $exit1 = apply_filters('asl_load_css_js', false);
            $exit2 = apply_filters('asl_load_css', false);
            if ($exit1 || $exit2)
                return false;

            add_action('wp_head', array($this, 'inlineCSS'), 10, 0);


            // Don't print if on the back-end
            if ( !is_admin() || $pagenow === 'widgets.php' ) {
                $inst = wd_asl()->instances->get(0);
                $asl_options = $inst['data'];
                wp_register_style('wpdreams-asl-basic', ASL_URL.'css/style.basic.css', array(), ASL_CURR_VER_STRING);
                wp_enqueue_style('wpdreams-asl-basic');
                wp_enqueue_style('wpdreams-ajaxsearchlite', ASL_URL.'css/style-'.$asl_options['theme'].'.css', array(), ASL_CURR_VER_STRING);
				self::$inline_css = "
					div[id*='ajaxsearchlitesettings'].searchsettings .asl_option_inner label {
						font-size: 0px !important;
						color: rgba(0, 0, 0, 0);
					}
					div[id*='ajaxsearchlitesettings'].searchsettings .asl_option_inner label:after {
						font-size: 11px !important;
						position: absolute;
						top: 0;
						left: 0;
						z-index: 1;
					}
					.asl_w_container {
						width: " . $asl_options['box_width'] . ";
						margin: " . wpdreams_four_to_string($asl_options['box_margin']) . ";
						min-width: 200px;
					}
					div[id*='ajaxsearchlite'].asl_m {
						width: 100%;
					}
					div[id*='ajaxsearchliteres'].wpdreams_asl_results div.resdrg span.highlighted {
						font-weight: bold;
						color: " . $asl_options['highlight_color'] . ";
						background-color: " . $asl_options['highlight_bg_color'] . ";
					}
					div[id*='ajaxsearchliteres'].wpdreams_asl_results .results img.asl_image {
						width: " . $asl_options['image_width'] . "px;
						height: " . $asl_options['image_height'] . "px;
						object-fit: " . $asl_options['image_display_mode'] . ";
					}
					div.asl_r .results {
						max-height: " . $asl_options['v_res_max_height'] . ";
					}
				";
				if ( trim($asl_options['box_font']) != '' && $asl_options['box_font'] != 'Open Sans' ) {
					$ffamily = wpd_font('font-family:'.$asl_options['box_font'])." !important;";
						self::$inline_css .= "
							.asl_w, .asl_w * {".$ffamily."}
							.asl_m input[type=search]::placeholder{".$ffamily."}
							.asl_m input[type=search]::-webkit-input-placeholder{".$ffamily."}
							.asl_m input[type=search]::-moz-placeholder{".$ffamily."}
							.asl_m input[type=search]:-ms-input-placeholder{".$ffamily."}
						";
				}
				if ( $asl_options['override_bg'] == 1 ) {
					self::$inline_css .= "
						.asl_m, .asl_m .probox {
							background-color: ".$asl_options['override_bg_color']." !important;
							background-image: none !important;
							-webkit-background-image: none !important;
							-ms-background-image: none !important;
						}
					";
				}
				if ( $asl_options['override_icon'] == 1 ) {
					self::$inline_css .= "
						.asl_m .probox svg {
							fill: ".$asl_options['override_icon_color']." !important;
						}
						.asl_m .probox .innericon {
							background-color: ".$asl_options['override_icon_bg_color']." !important;
							background-image: none !important;
							-webkit-background-image: none !important;
							-ms-background-image: none !important;
						}
					";
				}
				if ( $asl_options['override_border'] == 1 ) {
					self::$inline_css .= "
						div.asl_m.asl_w {
							".str_replace(';', ' !important;', $asl_options['override_border_style'])."
							box-shadow: none !important;
						}
						div.asl_m.asl_w .probox {border: none !important;}
					";
				}

				if ( $asl_options['results_width'] != 'auto' ) {
					self::$inline_css .= "
						.asl_r.asl_w {
							width: ". esc_attr($asl_options['results_width']).";
						}
					";
				}

				if ( $asl_options['results_bg_override'] == 1 ) {
					self::$inline_css .= "
						.asl_r.asl_w {
							background-color: ".$asl_options['results_bg_override_color']." !important;
							background-image: none !important;
							-webkit-background-image: none !important;
							-ms-background-image: none !important;
						}
					";
				}
				if ( $asl_options['results_item_bg_override'] == 1 ) {
					self::$inline_css .= "
						.asl_r.asl_w .item {
							background-color: ".$asl_options['results_item_bg_override_color']." !important;
							background-image: none !important;
							-webkit-background-image: none !important;
							-ms-background-image: none !important;
						}
					";
				}
				if ( $asl_options['results_override_border'] == 1 ) {
					self::$inline_css .= "
						div.asl_r.asl_w {
							".str_replace(';', ' !important;', $asl_options['results_override_border_style'])."
							box-shadow: none !important;
						}
					";
				}

				if ( $asl_options['settings_bg_override'] == 1 ) {
					self::$inline_css .= "
						.asl_s.asl_w {
							background-color: ".$asl_options['settings_bg_override_color']." !important;
							background-image: none !important;
							-webkit-background-image: none !important;
							-ms-background-image: none !important;
						}
					";
				}
				if ( $asl_options['settings_override_border'] == 1 ) {
					self::$inline_css .= "
						div.asl_s.asl_w {
							".str_replace(';', ' !important;', $asl_options['settings_override_border_style'])."
							box-shadow: none !important;
						}
					";
				}

				if ( intval($asl_options['v_res_column_count']) > 1 ) {
					// Columns specific
					self::$inline_css .= "
						div.asl_r.asl_w.vertical .resdrg {
							display: flex;
							flex-wrap: wrap;
						}
						div.asl_r.asl_w.vertical .results .item {
							min-width: ". $asl_options['v_res_column_min_width'] . ";
							width: " . floor( 100 / intval($asl_options['v_res_column_count']) - 1 ) . "%;
							flex-grow: 1;
							box-sizing: border-box;
							border-radius: 0;
						}
						@media only screen and (min-width: 641px) and (max-width: 1024px) {
							div.asl_r.asl_w.vertical .results .item {
								min-width: ". $asl_options['v_res_column_min_width_tablet'] . ";
							}
						}
						@media only screen and (max-width: 640px) {
							div.asl_r.asl_w.vertical .results .item {
								min-width: ". $asl_options['v_res_column_min_width_phone'] . ";
							}
						}
						";
						} else {
							// Spacer, if there are no columns
							self::$inline_css .= "
						div.asl_r.asl_w.vertical .results .item::after {
							display: block;
							position: absolute;
							bottom: 0;
							content: '';
							height: 1px;
							width: 100%;
							background: #D8D8D8;
						}
						div.asl_r.asl_w.vertical .results .item.asl_last_item::after {
							display: none;
						}
					";
				}

				if ( !empty($asl_options['box_width_tablet']) && $asl_options['box_width'] != $asl_options['box_width_tablet'] ) {
					self::$inline_css .= "
						@media only screen and (min-width: 641px) and (max-width: 1024px) {
							.asl_w_container {
								width: ".$asl_options['box_width_tablet']." !important;
							}
						}
					";
				}


				if ( !empty($asl_options['results_width_tablet']) && $asl_options['results_width'] != $asl_options['results_width_tablet'] ) {
					self::$inline_css .= "
						@media only screen and (min-width: 641px) and (max-width: 1024px) {
							.asl_r.asl_w {
								width: ". esc_attr($asl_options['results_width_tablet']).";
							}
						}
					";
				}

				if ( !empty($asl_options['box_width_phone']) && $asl_options['box_width'] != $asl_options['box_width_phone'] ) {
					self::$inline_css .= "
						@media only screen and (max-width: 640px) {
							.asl_w_container {
								width: ".$asl_options['box_width_phone']." !important;
							}
						}
					";
				}

				if ( !empty($asl_options['results_width_phone']) && $asl_options['results_width'] != $asl_options['results_width_phone'] ) {
					self::$inline_css .= "
						@media only screen and (max-width: 640px) {
							.asl_r.asl_w {
								width: ". esc_attr($asl_options['results_width_phone']).";
							}
						}
					";
				}

				if ( $asl_options['single_highlight'] == 1 ) {
					self::$inline_css .= "body span.asl_single_highlighted {
						display: inline !important;
						color: ".$asl_options['single_highlightcolor']." !important;
						background-color: ".$asl_options['single_highlightbgcolor']." !important;
					}";
				}

				if ( $asl_options['custom_css'] != '' && base64_decode($asl_options['custom_css'], true) == true ) {
					self::$inline_css .= ' ' . stripcslashes( base64_decode($asl_options['custom_css']) );
				}
            }

            return true;
        }

        /**
         * Echos the inline CSS if available
         */
        public function inlineCSS() {
            if (self::$inline_css != "") {
                ?>
                <style>
                    <?php echo self::$inline_css; ?>
                </style>
                <?php
            }
        }

        // ------------------------------------------------------------
        //   ---------------- SINGLETON SPECIFIC --------------------
        // ------------------------------------------------------------
        /**
         * Static instance storage
         *
         * @var self
         */
        protected static $_instance;

        public static function getInstance() {
            if ( ! ( self::$_instance instanceof self ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }
    }
}