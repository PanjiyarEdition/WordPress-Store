<?php
if (!defined('ABSPATH')) die('-1');

if (!class_exists("WD_ASL_Search_Handler")) {
    /**
     * Class WD_ASL_Search_Handler
     *
     * This is the ajax search handler class
     *
     * @class         WD_ASL_Search_Handler
     * @version       1.0
     * @package       AjaxSearchLite/Classes/Ajax
     * @category      Class
     * @author        Ernest Marcinko
     */
    class WD_ASL_Search_Handler extends WD_ASL_Handler_Abstract {

		/**
		 * Oversees and handles the search request
		 *
		 * @param bool $dontGroup
		 * @return array|mixed|void
		 */
		public function handle($dontGroup = false) {

			$s = $_POST['aslp'];

			if (is_array($_POST['options']))
				$options = $_POST['options'];
			else
				parse_str($_POST['options'], $options);

			$id = 0;
			$instance = wd_asl()->instances->get($id);
			$sd = &$instance['data'];

			$asl_query = new ASL_Query(array(
				"s"    => $s,
				"_id"  => $id,
				"_ajax_search"  => true,
				"_call_num"     => isset($_POST['asl_call_num']) ? $_POST['asl_call_num'] : 0
			), $id, $options);
			$results = $asl_query->posts;

			if (count($results) <= 0 && isset($sd['kw_suggestions']) && $sd['kw_suggestions']) {
				$results = $asl_query->kwSuggestions();
			} else if (count($results) > 0) {
				$results = apply_filters('asl_only_non_keyword_results', $results, $id, $s, $asl_query->getArgs());
			}

			$results = apply_filters('asl_ajax_results', $results, $id, $s, $sd);

			do_action('asl_after_search', $s, $results, $id);

			$html_results = asl_generate_html_results( $results, $sd );

			// Override from hooks
			if (isset($_POST['asl_get_as_array'])) {
				return $results;
			}

			$html_results = apply_filters('asl_before_ajax_output', $html_results, $id, $results, $asl_query->getArgs());

			$final_output = "";
			/* Clear output buffer, possible warnings */
			$final_output .= "___ASLSTART___" . $html_results . "___ASLEND___";
			$final_output .= "___ASLSTART_DATA___";
			$final_output .= json_encode(array(
				'results_count' => isset($results["keywords"]) ? 0 : count($results),
				'full_results_count' => $asl_query->found_posts
			));
			$final_output .= "___ASLEND_DATA___";

			ASL_Helpers::prepareAjaxHeaders();
			print_r($final_output);
			die();
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