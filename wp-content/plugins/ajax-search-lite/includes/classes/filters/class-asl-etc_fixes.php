<?php
if (!defined('ABSPATH')) die('-1');

if (!class_exists("WD_ASL_EtcFixes_Filter")) {
    /**
     * Class WD_ASL_EtcFixes_Filter
     *
     * Other 3rd party plugin related filters
     *
     * @class         WD_ASL_EtcFixes_Filter
     * @version       1.0
     * @package       AjaxSearchLite/Classes/Filters
     * @category      Class
     * @author        Ernest Marcinko
     */
    class WD_ASL_EtcFixes_Filter extends WD_ASL_Filter_Abstract {
        /**
         * Executes search shortcodes when placed as menu titles
         *
         * @param $menu_items
         * @return mixed
         */
        function allowShortcodeInMenus($menu_items ) {
            foreach ( $menu_items as $menu_item ) {
                if (
                    strpos($menu_item->title, '[wd_asl') !== false ||
                    strpos($menu_item->title, '[wpdreams_') !== false
                ) {
                    $menu_item->title = do_shortcode($menu_item->title);
                    $menu_item->url = '';
                }
            }
            return $menu_items;
        }

		function switchToNewScriptsOnLiveLoader( $options ) {
			if ( $options['res_live_search'] ) {
				$com_options = wd_asl()->o['asl_compatibility'];
				if ( strpos($com_options['js_source'], 'jqueryless') === false ) {
					$com_options['js_source'] = 'jqueryless-min';
					update_option('asl_compatibility', $com_options);
				}
			}
			return $options;
		}

        /**
         * Fix for the Oxygen builder plugin editor error console
         */
        function fixOxygenEditorJS( $exit ) {
            if ( isset($_GET['ct_builder']) ) {
                return true;
            }

            return false;
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