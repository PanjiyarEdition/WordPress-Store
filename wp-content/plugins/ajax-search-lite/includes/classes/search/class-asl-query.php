<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

if (!class_exists('ASL_Query')) {
	/**
	 * Class ASL_Query
	 *
	 * A similar class to WP_Query
	 *
	 * @uses ASL_Helpers
	 */
	class ASL_Query {
		/*
		 * Results array
		 */
		public $posts;

		/**
		 * The real results count
		 *
		 * @var int
		 */
		public $found_posts = 0;

		/**
		 * The options passed from the search form, when requested from the front-end
		 *
		 * @var array
		 */
		public $options = array();

		/**
		 * Default query parameter values
		 *
		 * @var array
		 */
		public static $defaults = array(
			// ----------------------------------------------------------------
			// 1. GENERIC arguments
			// ----------------------------------------------------------------
			's' => '',                  // search query
			/**
			 *  @param string|array search_type
			 *      cpt -> posts, pages, custom post types
			 *      taxonomies -> tags, categories and taxonomy terms based on taxonomy slug
			 *      users -> users
			 *      blogs -> multisite blog titles
			 *      buddypress -> buddypress groups or activities
			 *      comments -> comment results
			 *      attachments -> file attachments
			 */
			'search_type' => 'cpt',
			'engine' => 'regular',      // regular|index -> index only used on cpt
			'posts_per_page' =>  0,     // posts per page, for non ajax requests only. If 0, then get_option(posts_per_page) is used
			'page' => 1,                // which page of results, starts from 1
			'keyword_logic' => 'OR',    // OR|AND|OREX|ANDEX
			'secondary_logic' => '',    // OR|AND|OREX|none or empty string
			'min_word_length' => 0,     // Minimum word length of each word to be considered as a standalone word in the phrase (removed if shorter)
			// ----------------------------------------------------------------

			// ----------------------------------------------------------------
			// 2. POST and CUSTOM POST TYPE related arguments
			// ----------------------------------------------------------------
			'post_type' => array('post', 'page'),       // post types to look for
			'post_status' => array('publish'),          // post statuses
			'has_password' => false,                    // password protected
			'post_fields' => array(                     // post fields to search within
				// (title, content, excerpt, terms, permalink)
				'title', 'ids', 'excerpt', 'terms'
			),
			'post_custom_fields_all' => 0,              // search all custom fields
			'post_custom_fields' => array(),            // ..or search within custom fields
			'post_in' => array(),                       // string|array -> limit potential results pool to array of IDs
			'post_not_in' => array(),                   // string|array -> explicity exclude IDs from search results
			'post_not_in2' => array(),                  // array -> secondary exclusion for manual override
			'post_parent' => array(),                   // array -> post parent IDs
			'post_parent_exclude' => array(),           // array -> post parent IDs
			'post_tax_filter' => array(                 // taxonomy filter support
				/*
				array(
					'taxonomy'    => 'category',          // taxonomy name
					'include'     => array(1, 2, 3, 4),   // array of taxonomy term IDs to include
					'exclude'     => array(5, 6, 7, 8),   // array of taxonomy term IDs to exclude
					'allow_empty' => false                // allow (empty) items with no connection to any of the taxonomy terms filter
				)
				*/
			),
			'post_meta_filter' => array(      // meta_query support
				/*
				array(
					'key'     => 'age',         // meta key
					'value'   => array( 3, 4 ), // int|float|string|array|timestamp|datetime
					 // @param string|array compare
					 // Numeric Operators
					 //      '<' -> less than
					 //      '>' -> more than
					 //      '<>' -> not equals
					 //      '=' -> equals
					 //      'BETWEEN' -> between two values
					 // String Operators
					 //      'LIKE'
					 //      'NOT LIKE'
					 //      'IN'
					'operator' => 'BETWEEN',
					'allow_missing' => false   // allow match if this custom field is unset
				)
				*/
			),
			'post_date_filter' => array(        // date_query support
				/*
				array(
					'year'  => 2015,            // year, month, day ...
					'month' => 6,
					'day'   => 1,
					'date'  => "2015-06-01",     // .. or date parameter in y-m-d format
					'operator' => 'include',    // include|exclude
					'interval' => 'before'      // before|after
				)
				*/
			),
			'post_user_filter' => array(
				/*
				'include' => (1, 2, 3, 4),  // include by IDs
				'exclude' => (5, 6, 7, 8)   // exclude by IDs
				*/
			),
			'post_primary_order' => "relevance DESC", // CAN be a custom field name
			'post_secondary_order' => "post_date DESC",
			'post_primary_order_metatype'   => false, // false (if not meta), 'numeric', 'string'
			'post_secondary_order_metatype' => false, // false (if not meta), 'numeric', 'string'
			'_post_primary_order_metakey' => false,   // gets parsed later, do not touch
			'_post_secondary_order_metakey' => false, // gets parsed later  do not touch
			// ADVANCED
			'_post_get_content' => false,
			'_post_get_excerpt' => false,
			'_post_allow_empty_tax_term' => true,
			'_post_use_relevance' => true,
			// Special post tag filtering
			'_post_tags_active'  => false,
			'_post_tags_include' => array(),
			'_post_tags_exclude' => array(),
			'_post_tags_logic' => "OR",
			'_post_tags_empty' => 0,
			'_post_meta_logic' => "AND",
			'_post_meta_allow_null' => 0,
			// ----------------------------------------------------------------



			// ----------------------------------------------------------------
			// QUERY FIELDS
			// ----------------------------------------------------------------
			'cpt_query' => array(
				'fields' => '',
				'join' => '',
				'where' => '',
				'orderby' => '',
				'groupby' => ''
			),
			// ----------------------------------------------------------------

			/**
			 * OTHER ADVANCED ATTRIBUTES
			 *
			 * Don't use/override these, unless you know what you are doing.
			 */
			'_id' => -1,
			'_o'  => false,
			// LIMITS
			'limit' => 0, // overall results limit, if >=0, then evenly distributed between sources
			'_limit' => 0, // calculated limit based on the previous limit parameter
			/**
			 * _call_num ->
			 *  Number of the consecutive ajax requests with the same configuration triggered by
			 *  clicking on the 'More results..' link
			 *  This is required to calculate the correct start of the result slicing
			 */
			'_call_num' => 0,
			'posts_limit' => 10,
			'posts_limit_override' => 1000,	// Results count on the results page
			'posts_limit_distribute' => 0,

			'_charcount'        => 0,
			'_keyword_count_limit' => 6, // Number of words in the search phrase allowed
			'_exact_matches'   => false,
			'_exact_match_location' => 'anywhere',  // anywhere, start, end
			'_qtranslate_lang' => "en",         // qtranslatex language data
			'_wpml_lang'       => "",           // WPML language
			'_polylang_lang'       => "",       // Polylang language
			'_exclude_page_parent_child' => "", // parent page exclusion data (comma separated list)
			'_taxonomy_group_logic' => 'AND',
			'_db_force_case'        => 'none',
			'_db_force_utf8_like'   => 0,
			'_db_force_unicode'     => 0,
			'_ajax_search'          => false,     // Needs to be set explicitly to TRUE in search Ajax Handler class
			'_no_post_process'      => false,     // Forcefully turns off post-processing to return RAW results

			/**
			 * Other stuff
			 */
			'_page_id' => 0,                // Current Page ID
			/**
			 * Remaining Limit Modifier
			 *      This is used mostly for more results overall limit.
			 *      Overall Limit = LIMIT * _remaining_limit_mod
			 */
			'_remaining_limit_mod' => 10,
			'_show_more_results' => false,  // Show more results feature enabled (only used via ajax search instance)
			'filters_changed'   => false,   // Only via AJAX - if the filters have been touched by the user
			'filters_initial'   => true     // Only via AJAX - if the filters are on the initial state
		);

		/*
		 * Array of phrases of all synonym variations
		 */
		private $finalPhrases = array();

		/*
		 * Constructor args
		 */
		private $args = array();

		/**
		 * ASL_Query constructor.
		 *
		 * @param $args array of arguments
		 * @param int $search_id search ID
		 * @param array $options options from $_POST
		 */
		public function __construct($args, $search_id = -1, $options = false ) {
			// Expressions not allowed in static context
			self::$defaults['_selected_blogs'] = array(get_current_blog_id());

			if ( $search_id > -1 ) {
				// Translate search data and options to args
				// args priority $args > $search_args > $defaults
				$search_args = ASL_Helpers::toQueryArgs($search_id, $options, $args);
				$search_args = wp_parse_args( $search_args, self::$defaults );
				$args = wp_parse_args( $args, $search_args );
			} else {
				// No search instance, use default args
				$args = wp_parse_args( $args, self::$defaults );
			}

			// Store the options for later use
			$this->options = $options;

			$args = $this->preProcessOptions($args);

			$args = apply_filters("asl_query_args", $args, $search_id, $options);
			$this->args = $args;

			do_action('asl_before_search', $args['s']);

			$this->args['s'] = apply_filters('asl_search_phrase_before_cleaning', $this->args['s']);
			$this->args['s'] = ASL_Helpers::clear_phrase($this->args['s']);
			$this->args['s'] = apply_filters('asl_search_phrase_after_cleaning', $this->args['s']);

			$this->processOptions();
			$this->posts = $this->get_posts();
		}

		private function preProcessOptions($args) {
			if ( !$args['_ajax_search'] && $args['_page_id'] == 0) {
				$args['_page_id'] = get_the_ID();
			}

			return $args;
		}

		private function processOptions() {
			$args = &$this->args;
			// ---------------- Part 1. Query variables --------------------

			// These parameters can be arrays and strings/numeric as well -> convert them to array
			$array_param_keys = array(
				'post_type',
				'post_parent',
				'post_status',
				'post_fields',
				'post_custom_fields',
				//'post_not_in',
				'_post_tags_include',
				'_post_tags_exclude',
				'attachment_mime_types',
				'taxonomy_include'
				//'taxonomy_terms_exclude'
			);
			foreach ($array_param_keys as $k) {
				if ( isset($args[$k]) ) {
					$args[$k] = !is_array($args[$k]) ? array($args[$k]) : $args[$k];
				}
			}

			// Do not allow private posts for non-editors
			if ( !current_user_can('read_private_posts') )
				$args['post_status'] = array_diff($args['post_status'], array('private'));

			if ( !is_array($args['search_type']) )
				$args['search_type'] = array($args['search_type']);
			if ( $args['limit'] > 0 && count($args['search_type']) > 0 )
				$args['_limit'] = floor($args['limit']/count($args['search_type']));
			if ( $args['posts_per_page'] == 0 )
				$args['posts_per_page'] = get_option('posts_per_page');

			$args['keyword_logic'] = strtolower($args['keyword_logic']);


			// Parse custom query strings
			$args['cpt_query'] = wp_parse_args($args['cpt_query'], self::$defaults['cpt_query']);

			// ------------------ Part 2. Search data ----------------------

			// Break after this point, if no search data is provided
			if ( !isset($this->args['_sd']) )
				return false;

			$sd = &$this->args['_sd'];
			$args['_charcount'] = $sd['charcount'];
			$sd['image_options'] = array(
				'image_cropping' => wd_asl()->o['asl_performance']['image_cropping'],
				'apply_content_filter' => $sd['image_apply_content_filter'],
				'show_images' => $sd['show_images'],
				'image_width' => $sd['image_width'],
				'image_height' => $sd['image_height'],
				'image_source1' => $sd['image_source1'],
				'image_source2' => $sd['image_source2'],
				'image_source3' => $sd['image_source3'],
				'image_source4' => $sd['image_source4'],
				'image_source5' => $sd['image_source5'],
				'image_default' => $sd['image_default'],
				'image_source_featured' => $sd['image_source_featured'],
				'image_custom_field' => $sd['image_custom_field']
			);

			if (isset($_POST['asl_get_as_array']))
				$sd['image_options']['show_images'] = 0;

			// Disable image cropping in non-ajax mode
			if ( !$args['_ajax_search'] ) {
				$sd['image_options']['image_cropping'] = 0;
			}
		}

		public function getArgs() {
			return $this->args;
		}

		public function get_posts() {
			$args = $this->args;
			$_args = $args; // copy to store changes

			$ra = array(
				'allpageposts' => array(),
			);

			$s = $this->applyExceptions( $args['s'] );

			// Allow empty search phrases only if the char count is 0
			if ( $s != "" ||
				($s == "" && ( isset($args['force_order']) || isset($args['force_count']) )) ||
				($s == "" && $args['_charcount'] == 0)
			)
				$this->finalPhrases[] = $s;

			$this->finalPhrases = apply_filters("asl_final_phrases", $this->finalPhrases);

			$logics = array( $args['keyword_logic'] );
			if ( !empty($args['secondary_logic']) && $args['secondary_logic'] !== 'none' && $args['_call_num'] == 0 )
				$logics[] = strtolower($args['secondary_logic']);

			// ---- Search Porcess Starts Here ----
			foreach ($this->finalPhrases as $s) {
				foreach ($args['_selected_blogs'] as $blog) {
					if ( is_multisite() ) switch_to_blog($blog);

					if ( in_array('cpt', $args['search_type']) && count($args['post_type']) > 0 ) {
						if ( $args['posts_limit_distribute'] == 1 ) {
							if ( isset($args['_sd']) && $args['_sd']['use_post_type_order'] == 1 ) {
								$_temp_ptypes = array();
								foreach ($args['_sd']['post_type_order'] as $pk => $p_order) {
									if ( in_array($p_order, $args['post_type']) )
										$_temp_ptypes[] = $p_order;
								}
								$_temp_ptypes = array_unique(array_merge($_temp_ptypes, $args['post_type']));
							} else {
								$_temp_ptypes = $args['post_type'];
							}

							$_temp_ptype_limits = array();

							foreach ($_temp_ptypes as $_tptype) {
								$_temp_ptype_limits[$_tptype] = array(
									(int)($args['posts_limit'] / count($_temp_ptypes)),
									(int)($args['posts_limit_override'] / count($_temp_ptypes))
								);
							}

							foreach ($_temp_ptypes as $_tptype) {
								foreach ($logics as $lk => $logic) {
									if ( $lk == 0 && $args['_exact_matches'] == 1 ) {
										// If exact matches is on, disregard the firs logic
										$args['keyword_logic'] = 'or';
									} else {
										if ( $lk > 0 )
											$args['_exact_matches'] = 0;
										$args['keyword_logic'] = $logic;
									}
									$args['post_type'] = array($_tptype);
									// Change the limits temporarly for the search
									$args['posts_limit'] = $_temp_ptype_limits[$_tptype][0];
									$args['posts_limit_override'] = $_temp_ptype_limits[$_tptype][1];
									// For exact matches the regular engine is used
									$_posts = new ASL_Search_CPT($args);

									$_posts_res = $_posts->search($s);
									$ra['allpageposts'] = array_merge($ra['allpageposts'], $_posts_res);
									if ( $lk > 0 )
										$this->found_posts += $_posts->return_count;
									else
										$this->found_posts += $_posts->results_count;
									$_temp_ptype_limits[$_tptype][0] -= $_posts->return_count;
									$_temp_ptype_limits[$_tptype][1] -= $_posts->return_count;
									$args['post_not_in2'] = array_merge($args['post_not_in2'], $this->getResIdsArr($_posts_res));
									$args['_exact_matches'] = $_args['_exact_matches'];
								}
							}
							$args['post_type'] = $_temp_ptypes;
						} else {
							foreach ($logics as $lk => $logic) {
								if ( $lk == 0 && $args['_exact_matches'] == 1 ) {
									// If exact matches is on, disregard the first logic
									$args['keyword_logic'] = 'or';
								} else {
									if ( $lk > 0 )
										$args['_exact_matches'] = 0;
									$args['keyword_logic'] = $logic;
								}

								$_posts = new ASL_Search_CPT($args);
								$_posts_res = $_posts->search($s);
								$ra['allpageposts'] = array_merge($ra['allpageposts'], $_posts_res);
								if ( $lk > 0 )
									$this->found_posts += $_posts->return_count;
								else
									$this->found_posts += $_posts->results_count;
								$args['posts_limit'] -= $_posts->return_count;
								$args['posts_limit_override'] -= $_posts->return_count;
								$args['post_not_in2'] = array_merge($args['post_not_in2'], $this->getResIdsArr($_posts_res));
								$args['_exact_matches'] = $_args['_exact_matches'];
							}
						}
						do_action('asl_after_pagepost_results', $s, $ra['allpageposts']);
					}
				}
			}

			// ---- Search Porcess Stops Here ----
			$results_count_adjust = 0;  // Count the changes in results count when using filters

			$rca = count($ra['allpageposts']);
			$ra['allpageposts'] = apply_filters('asl_pagepost_results', $ra['allpageposts'], $args["_id"], $args);
			$ra['allpageposts'] = apply_filters('asl_cpt_results', $ra['allpageposts'], $args["_id"], $this);
			$rca -= count($ra['allpageposts']);
			$results_count_adjust += $rca;

			// Results as array, unordered
			$results_arr = array(
				'post_page_cpt' => $ra['allpageposts']
			);

			foreach ( $results_arr as $k => $v ) {
				$final = array();
				foreach ( $results_arr[$k] as $kk => $current ) {
					$found = false;
					foreach ($final as $item) {
						if ($item->id == $current->id && $item->blogid == $current->blogid) {
							$found = true;
							break;
						}
					}
					if ( !$found )
						$final[] = $current;
				}
				$results_arr[$k] = $final;
			}

			// Order if search data is set
			if ( isset($args['_sd']) ) {
				$results = $results_arr['post_page_cpt'];
				$rca = count($results);
				$results = apply_filters('asl_results', $results, $args['_id'], $args['_ajax_search'], $args);
				$rca -= count($results);
				$results_count_adjust += $rca;
			} else {
				$results = array();
				foreach ($results_arr as $rk => $rv) {
					$results = array_merge($results, $rv);
				}
				$rca = count($results);
				$results = apply_filters('asl_results', $results, -1, false, $args);
				$rca -= count($results);
				$results_count_adjust += $rca;
			}

			// $results_count_adjust > 0 -> posts have been removed, otherwise added
			$this->found_posts -= $results_count_adjust;
			$this->found_posts = $this->found_posts < 0 ? 0 : $this->found_posts; // Make sure this is not 0

			// For non-ajax searches, we need the WP_Post objects
			if ( !$args['_ajax_search'] ) {
				$results = asl_results_to_wp_obj($results, $args['posts_per_page'] * ($args['page'] - 1), $args['posts_per_page']);
				$results = apply_filters('asl_noajax_results', $results, $args['_id'], false, $args);
			}

			return $results;
		}

		public function kwSuggestions() {
			if ( !isset($this->args['_sd'], $this->args['_sid']) )
				return array();

			$sd = &$this->args['_sd'];
			$args = $this->args;
			$results = array();

			if ( function_exists( 'qtranxf_use' ) && $args['_qtranslate_lang'] != "" ) {
				$lang = $args['_qtranslate_lang'];
			} else if ( $args['_wpml_lang'] != "" ) {
				$lang = $args['_wpml_lang'];
			} else if ( $args['_polylang_lang'] != "" ) {
				$lang = $args['_polylang_lang'];
			} else {
				$lang = w_isset_def( $sd['kw_google_lang'], "en" );
			}

			$types = array();
			if ( isset($sd['customtypes']) )
				$types = array_merge($types, $sd['customtypes']);

			$t = new  wpd_keywordSuggest("google", array(
				'maxCount' => w_isset_def( $sd['kw_count'], 10 ),
				'maxCharsPerWord' => w_isset_def($sd['kw_length'], 60),
				'postTypes' => $types,
				'lang' => $lang,
				'overrideUrl' => ''
			));

			$keywords = $t->getKeywords( trim($this->args['s']) );

			if ($keywords != false) {
				$results['keywords'] = $keywords;
				$results['nores'] = 1;
				$results = apply_filters('asl_only_keyword_results', $results);
			}

			return $results;
		}

		private function applyExceptions( $s ) {
			if ( !isset($this->args['_sd']) )
				return $s;

			$sd = &$this->args['_sd'];

			if ($sd["kw_exceptions"] == "" && $sd["kw_exceptions_e"] == "") return $s;

			if ($sd["kw_exceptions"] != "") {
				$exceptions = stripslashes( str_replace(array(" ,", ", ", " , "), ",", $sd["kw_exceptions"]) );
				if ( $exceptions != '' ) {
					$s = trim(str_ireplace(explode(",", $exceptions), "", $s));
					$s = preg_replace('/\s+/', ' ', $s);
				}
			}

			if ($sd["kw_exceptions_e"] != "") {
				$exceptions = stripslashes( str_replace(array(" ,", ", ", " , "), ",", $sd["kw_exceptions_e"]) );
				$exceptions = explode(',', $exceptions);
				foreach ($exceptions as $k => &$v)
					$v = '/\b' . $v . '\b/ui';
				unset($v);
				if ( count($exceptions) > 0 ) {
					$s = trim(preg_replace($exceptions, '', $s));
					$s = preg_replace('/\s+/', ' ', $s);
				}
			}

			return $s;
		}

		private function getResIdsArr( $r ) {
			$ret = array();
			if ( is_array($r) )
				foreach ($r as $k => $v)
					if ( isset($v->id) )
						$ret[] = $v->id;
			return $ret;
		}
	}
}