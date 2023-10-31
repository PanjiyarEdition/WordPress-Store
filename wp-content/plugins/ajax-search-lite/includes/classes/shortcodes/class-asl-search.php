<?php
if (!defined('ABSPATH')) die('-1');

if (!class_exists("WD_ASL_Search_Shortcode")) {
    /**
     * Class WD_ASL_Search_Shortcode
     *
     * Search bar shortcode
     *
     * @class         WD_ASL_Search_Shortcode
     * @version       1.0
     * @package       AjaxSearchLite/Classes/Shortcodes
     * @category      Class
     * @author        Ernest Marcinko
     */
    class WD_ASL_Search_Shortcode extends WD_ASL_Shortcode_Abstract {

        /**
         * Overall instance count
         *
         * @var int
         */
        private static $instanceCount = 0;

        /**
         * Used in views, true if the data view is printed
         *
         * @var bool
         */
        private static $dataPrinted = false;

        /**
         * Instance count per search ID
         *
         * @var array
         */
        private static $perInstanceCount = array();

        /**
         * Does the search shortcode stuff
         *
         * @param array|null $atts
         * @return string|void
         */
        public function handle($atts) {
            $style = null;
            self::$instanceCount++;

            extract(shortcode_atts(array(
                'id' => 'something',
                'post_parent' => ''
            ), $atts));

            $inst = wd_asl()->instances->get(0);
            $style = $inst['data'];

            // Set the "_fo" item to indicate that the non-ajax search was made via this form, and save the options there
            if (isset($_POST['p_asl_data']) || isset($_POST['np_asl_data'])) {
                $_p_data = isset($_POST['p_asl_data']) ? $_POST['p_asl_data'] : $_POST['np_asl_data'];
                parse_str($_p_data, $style['_fo']);
            }

            $settingsHidden = ((
                w_isset_def($style['show_frontend_search_settings'], 1) == 1
            ) ? false : true);

			// Triggered by URL
			if ( isset($_GET['asl_s']) ) {
				$style['auto_populate'] = "phrase";
				$style['auto_populate_phrase'] = $_GET['asl_s'];
				$style['auto_populate_count'] = intval($style['maxresults']);
			}

            if ( $post_parent != '' ) {
                $post_parent = array_unique( 
                    array_map( 'intval', array_filter( explode(',', $post_parent), 'is_numeric' ) )
                );
                if ( !empty($post_parent) ) {
                    add_action( 'asl_layout_in_form', function() use ($post_parent) {
                        foreach( $post_parent as $pid ) {
                            echo "<input type='hidden' name='post_parent[]' value='$pid'>";
                        }
                    });
                }
            }

            do_action('asl_layout_before_shortcode', $id);

            $out = "";
            ob_start();
            include(ASL_PATH."includes/views/asl.shortcode.php");
            $out = ob_get_clean();

            do_action('asl_layout_after_shortcode', $id);

            return $out;
        }

        /**
         * Importing fonts does not work correctly it appears.
         * Instead adding the links directly to the header is the best way to go.
         */
        public function fonts() {
            // If custom font loading is disabled, exit
            $comp_options = wd_asl()->o['asl_compatibility'];
            if ( $comp_options['load_google_fonts'] != 1 )
                return false;

            $imports = array(
                '//fonts.googleapis.com/css?family=Open+Sans'
            );

            $imports = apply_filters('asl_custom_fonts', $imports);

			$fonts = array();
			foreach ($imports as $import) {
				$import = trim(str_replace(array("@import url(", ");", "https:", "http:"), "", $import));
				$import = trim(str_replace("//fonts.googleapis.com/css?family=", "", $import));
				if ( $import != '' ) {
					$fonts[] = $import;
				}
			}

			if ( count($fonts) > 0 ) {
				?>
				<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
				<link rel="preload" as="style" href="//fonts.googleapis.com/css?family=<?php echo implode('|', $fonts); ?>&display=swap" />
				<link rel="stylesheet" href="//fonts.googleapis.com/css?family=<?php echo implode('|', $fonts); ?>&display=swap" media="all" />
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