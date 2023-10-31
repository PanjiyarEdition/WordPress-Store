<?php

if (!function_exists("w_isset_def")) {
    function w_isset_def(&$v, $d)
    {
        if (isset($v)) return $v;
        return $d;
    }
}

if (!function_exists('wpd_is_wp_version')) {
	function wpd_is_wp_version($operator = '>', $version = '4.5') {
		global $wp_version;

		return version_compare($wp_version, $version, $operator);
	}
}

if (!function_exists('wpd_is_wp_older')) {
	function wpd_is_wp_older($version = '4.5') {
		return wpd_is_wp_version('<', $version);
	}
}

if (!function_exists('wpd_is_wp_newer')) {
	function wpd_is_wp_newer($version = '4.5') {
		return wpd_is_wp_version('>', $version);
	}
}

if ( !function_exists('wpd_get_terms') ) {
	function wpd_get_terms($args = array()) {
		if ( wpd_is_wp_older('4.5') ) {
			return get_terms($args['taxonomy'], $args);
		} else {
			return get_terms($args);
		}
	}
}

if (!function_exists("wpdreams_parse_params")) {
    function wpdreams_parse_params($params) {
        foreach ($params as $k=>$v) {
            $_tmp = explode('classname-', $k);
            if ($_tmp!=null && count($_tmp)>1) {
                ob_start();
                $c = new $v('0', '0', $params[$_tmp[1]]);
                $out = ob_get_clean();
                $params['selected-'.$_tmp[1]] = $c->getSelected();
            }
            $_tmp = null;
            $_tmp = explode('wpdfont-', $k);
            if ($_tmp!=null && count($_tmp)>1) {
                ob_start();
                $c = new $v('0', '0', $params[$_tmp[1]]);
                $out = ob_get_clean();
                $params['import-'.$_tmp[1]] = $c->getImport();
            }
        }
        return $params;
    }
}

if (!function_exists("wpdreams_admin_hex2rgb")) {
    function wpdreams_admin_hex2rgb($color)
    {
        if (strlen($color)>7) return $color;
        if (strlen($color)<3) return "rgba(0, 0, 0, 1)";
        if ($color[0] == '#')
            $color = substr($color, 1);
        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0].$color[1],
                $color[2].$color[3],
                $color[4].$color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        else
            return false;
        $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
        return "rgba(".$r.", ".$g.", ".$b.", 1)";
    }
}
if (!function_exists("wpdreams_four_to_string")) {
    function wpdreams_four_to_string($data) {
        // 1.Top 2.Bottom 3.Right 4.Left
        preg_match("/\|\|(.*?)\|\|(.*?)\|\|(.*?)\|\|(.*?)\|\|/", $data, $matches);
        // 1.Top 3.Right 2.Bottom 4.Left
        return $matches[1]." ".$matches[3]." ".$matches[2]." ".$matches[4];
    }
}

if (!function_exists("wpdreams_in_array_r")) {
    function wpdreams_in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && wpdreams_in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists("asl_gen_rnd_str")) {
	function asl_gen_rnd_str($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}

if ( !function_exists("asl_is_asset_required") ) {
	function asl_is_asset_required($asset) {
		if ( wd_asl()->manager->getContext() == 'backend' ) {
			return true;
		} else {
			$assets = asl_get_unused_assets();
			return !wd_in_array_r($asset, $assets);
		}
	}
}

if ( !function_exists("asl_get_unused_assets") ) {
	function asl_get_unused_assets() {
		$dependencies = array(
			'vertical', 'autocomplete',
			'settings', 'ga'
		);
		$external_dependencies = array();

		// --- Analytics
		if ( wd_asl()->o['asl_analytics']['analytics'] != 0 ) {
			$dependencies = array_diff($dependencies, array('ga'));
		}

		$search = wd_asl()->instances->get();
		if (is_array($search) && count($search)>0) {
			foreach ($search as $s) {
				// Calculate flags for the generated basic CSS
				// --- Results type - in lite only vertical is present
				$dependencies = array_diff($dependencies, array('vertical'));

				// --- Autocomplete
				if ( $s['data']['autocomplete'] ) {
					$dependencies = array_diff($dependencies, array('autocomplete'));
				}

				// --- Settings visibility - we can check the option only, as settings shortcode is not present
				// ..in the lite version
				if ( $s['data']['show_frontend_search_settings'] ) {
					$dependencies = array_diff($dependencies, array('settings'));
				}

				// --- Autocomplete (not used yet)
			}
		}

		return array(
			'internal' => $dependencies,
			'external' => $external_dependencies
		);
	}
}

if (!function_exists("asl_generate_html_results")) {
    /**
     * Converts the results array to HTML code
     *
     * Since ASL 4.5 the results are returned as plain HTML codes instead of JSON
     * to allow templating. This function includes the needed template files
     * to generate the correct HTML code. Supports grouping.
     *
     * @since 4.5
     * @param $results
     * @param $s_options
     * @return string
     */
    function asl_generate_html_results($results, $s_options ) {
        $html = "";
        $theme_path = get_stylesheet_directory() . "/asl/";

        if (empty($results) || !empty($results['nores'])) {
            if (!empty($results['keywords'])) {
                $s_keywords = $results['keywords'];
                // Get the keyword suggestions template
                ob_start();
                if ( file_exists( $theme_path . "keyword-suggestions.php" ) )
                    include( $theme_path . "keyword-suggestions.php" );
                else
                    include(ASL_INCLUDES_PATH . "views/keyword-suggestions.php");
                $html .= ob_get_clean();
            } else {
                // No results at all.
                ob_start();
                if ( file_exists( $theme_path . "no-results.php" ) )
                    include( $theme_path . "no-results.php" );
                else
                    include(ASL_INCLUDES_PATH . "views/no-results.php");
                $html .= ob_get_clean();
            }
        } else {
            // Get the item HTML
            foreach($results as $k=>$r) {
                $asl_res_css_class = ' asl_r_' . $r->content_type . ' asl_r_' . $r->content_type . '_' .$r->id;
                if ( isset($r->post_type) ) {
                    $asl_res_css_class .= ' asl_r_' . $r->post_type;
                }
                ob_start();
                if ( file_exists( $theme_path . "result.php" ) )
                    include( $theme_path . "result.php" );
                else
                    include(ASL_INCLUDES_PATH . "views/result.php");
                $html .= ob_get_clean();
            }

        }
        return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $html);
    }
}

if (!function_exists('asl_icl_t')) {
    /* Ajax Search Lite wrapper for WPML and Polylang print */
    function asl_icl_t($name, $value, $strip_special = false) {
        $regex = '/[^\pL\s]+/u';
        if (function_exists('icl_register_string') && function_exists('icl_t')) {
            icl_register_string('ajax-search-lite', $name, $value);
            if ( $strip_special )
                return preg_replace($regex, ' ', stripslashes( icl_t('ajax-search-lite', $name, $value) ));
            return stripslashes( icl_t('ajax-search-lite', $name, $value) );
        }
        if (function_exists('pll_register_string') && function_exists('pll__')) {
            pll_register_string($name, $value, 'ajax-search-lite');
            if ( $strip_special )
                return preg_replace( $regex, ' ', stripslashes( pll__($value)) );
            return stripslashes( pll__($value) );
        }
        if (function_exists('qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
            if ( $strip_special )
                return preg_replace( $regex, ' ', stripslashes( qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage( $value ) ) );
            return stripslashes( qtranxf_useCurrentLanguageIfNotFoundUseDefaultLanguage( $value ) );
        }
        if ( $strip_special )
            return preg_replace( $regex, ' ', stripslashes( $value ) );
        return stripslashes( $value );
    }
}

if ( !function_exists('wd_strip_tags_ws') ) {
	/**
	 * Strips tags, but replaces them with whitespace
	 *
	 * @param string $string
	 * @param string $allowable_tags
	 * @return string
	 * @link https://stackoverflow.com/a/38200395
	 */
	function wd_strip_tags_ws($string, $allowable_tags = '') {
		$string = str_replace('<', ' <', $string);
		$string = strip_tags($string, $allowable_tags);
		$string = str_replace('  ', ' ', $string);
		$string = trim($string);

		return $string;
	}
}

if (!function_exists("wd_closetags")) {
	/**
	 * Close unclosed HTML tags
	 *
	 * @param $html
	 * @return string
	 */
	function wd_closetags( $html ) {
		$unpaired = array('hr', 'br', 'img');

		// put all opened tags into an array
		preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
		$openedtags = $result[1];
		// remove unpaired tags
		if (is_array($openedtags) && count($openedtags)>0) {
			foreach ($openedtags as $k=>$tag) {
				if (in_array($tag, $unpaired))
					unset($openedtags[$k]);
			}
		} else {
			// Replace a possible un-closed tag from the end, 30 characters backwards check
			$html = preg_replace('/(.*)(\<[a-zA-Z].{0,30})$/', '$1', $html);
			return $html;
		}
		// put all closed tags into an array
		preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
		$closedtags = $result[1];
		$len_opened = count ( $openedtags );
		// all tags are closed
		if( count ( $closedtags ) == $len_opened ) {
			// Replace a possible un-closed tag from the end, 30 characters backwards check
			$html = preg_replace('/(.*)(\<[a-zA-Z].{0,30})$/', '$1', $html);
			return $html;
		}
		$openedtags = array_reverse ( $openedtags );
		// close tags
		for( $i = 0; $i < $len_opened; $i++ ) {
			if ( !in_array ( $openedtags[$i], $closedtags ) ) {
				$html .= "</" . $openedtags[$i] . ">";
			} else {
				unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
			}
		}
		// Replace a possible un-closed tag from the end, 30 characters backwards check
		$html = preg_replace('/(.*)(\<[a-zA-Z].{0,30})$/', '$1', $html);
		return $html;
	}
}

if ( !function_exists('wpd_font') ) {
    /**
     * Helper method to be used before printing the font styles. Converts font families to apostrophed versions.
     *
     * @param $font
     * @return mixed
     */
    function wpd_font($font) {
        preg_match("/family:(.*?)$/", $font, $fonts);
        if (isset($fonts[1])) {
            $f = explode(',', stripslashes(str_replace(array('"', "'"), '', $fonts[1])) );
            foreach ($f as &$_f) {
                if (trim($_f) != 'inherit')
                    $_f = '"' . trim($_f) . '"';
                else
                    $_f = trim($_f);
            }
            $f = implode(',', $f);
            return preg_replace("/family:(.*?)$/", 'family:' . $f, $font);
        } else {
            return $font;
        }
    }
}

if (!function_exists("mysql_escape_mimic")) {
  function mysql_escape_mimic($inp) { 
      if(is_array($inp)) 
          return array_map(__METHOD__, $inp); 
  
      if(!empty($inp) && is_string($inp)) { 
          return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
      } 
  
      return $inp; 
  }
} 

if (!function_exists("wd_in_array_r")) {
  function wd_in_array_r($needle, $haystack, $strict = true) {
      foreach ($haystack as $item) {
          if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && wd_in_array_r($needle, $item, $strict))) {
              return true;
          }
      }
  
      return false;
  }
}

if (!function_exists("wd_array_to_string")) {
	/**
	 * Converts a multi-depth array elements into one string, elements separated by space.
	 *
	 * @param $arr
	 * @param int $level
	 *
	 * @return string
	 */
	function wd_array_to_string($arr, $level = 0) {
		$str = "";
		if (is_array($arr)) {
			foreach ($arr as $sub_arr) {
				$str .= wd_array_to_string($sub_arr, $level + 1);
			}
		} else {
			$str = " " . $arr;
		}
		if ($level == 0) {
			$str = trim($str);
		}

		return $str;
	}
}

if (!function_exists("wd_substr_at_word")) {
  function wd_substr_at_word($text, $length) {
      if (strlen($text) <= $length) return $text;
      $blogCharset = get_bloginfo('charset');
      $charset = $blogCharset !== '' ? $blogCharset : 'UTF-8';
      $s = mb_substr($text, 0, $length, $charset);
      return mb_substr($s, 0, strrpos($s, ' '), $charset);
  }
}


if (!function_exists("wd_current_page_url")) {
    /**
     * Returns the current page url
     *
     * @return string
     */
    function wd_current_page_url() {
        $pageURL = 'http';

        $port = !empty($_SERVER["SERVER_PORT"]) ? $_SERVER["SERVER_PORT"] : 80;

        $server_name = !empty($_SERVER["SERVER_NAME"]) ? $_SERVER["SERVER_NAME"] : "";
        $server_name = empty($server_name) && !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $server_name;

        if( isset($_SERVER["HTTPS"]) ) {
            if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        }
        $pageURL .= "://";
        if ($port != "80") {
            $pageURL .= $server_name.":".$port.$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $server_name.$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}

if (!function_exists("asl_get_image_from_content")) {
    /**
     * Gets an image from the HTML content
     *
     * @param $content
     * @param int $number
     * @param array|string $exclude
     * @return bool|string
     */
    function asl_get_image_from_content($content, $number = 0, $exclude = array()) {
        if ($content == "" || !class_exists('domDocument'))
            return false;

        // The arguments expects 1 as the first image, while it is the 0th
        $number = intval($number) - 1;
        $number = $number < 0 ? 0 : $number;

        if ( !is_array($exclude) ) {
            $exclude = strval($exclude);
            $exclude = explode(',', $exclude);
        }
        foreach ( $exclude as $k => &$v ) {
            $v = trim($v);
            if ( $v == '' ) {
                unset($exclude[$k]);
            }
        }

		$attributes = array('src', 'data-src-fg');
		$im = false;

        $dom = new domDocument();
        if ( function_exists('mb_convert_encoding') )
            @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        else
            @$dom->loadHTML($content);
        $dom->preserveWhiteSpace = false;
        @$images = $dom->getElementsByTagName('img');
        if ($images->length > 0) {
			$get = $images->length > $number ? $number : 0;
			for ($i=$get;$i<$images->length;$i++) {
                foreach ( $attributes as $att ) {
                    $im = $images->item($i)->getAttribute($att);
                    if ( !empty($im) )
                        break;
                }
				foreach ( $exclude as $ex ) {
					if ( strpos($im, $ex) !== false ) {
					    $im = '';
						continue 2;
					}
				}
				break;
			}
            return $im;
        } else {
            return false;
        }
    }
}


if (!function_exists("wpdreams_on_backend_post_editor")) {
    /**
     * @return bool
     */
    function wpdreams_on_backend_post_editor() {
        $current_url = wd_current_page_url();
        return (strpos($current_url, 'post-new.php')!==false ||
            strpos($current_url, 'post.php')!==false);
    }
}

if (!function_exists('asl_woo_version_check')) {
    function asl_woo_version_check($version = '3.0') {
        if (class_exists('WooCommerce')) {
            global $woocommerce;
            if (isset($woocommerce, $woocommerce->version) &&
                version_compare($woocommerce->version, $version, ">=")
            ) {
                return true;
            }
        }

        return false;
    }
}

//----------------------------------------------------------------------------------------------------------------------
// 6. NON-AJAX RESULTS
//----------------------------------------------------------------------------------------------------------------------

if ( !class_exists("ASL_Post") )  {
    /**
     * Class ASL_Post
     *
     * A default class to instantiate to generate post like results.
     */
    class ASL_Post {

        public $ID = 0;                     // Don't use negative value, because WPML will break into pieces
        public $post_title = "";
        public $post_author = "";
        public $post_name = "";
        public $post_type = "post";         // Everything unknown is going to be a post
        public $post_date = '0000-00-00 00:00:00';             // Format: 0000-00-00 00:00:00
        public $post_date_gmt = '0000-00-00 00:00:00';         // Format: 0000-00-00 00:00:00
        public $post_content = '';          // The full content of the post
        public $post_content_filtered = '';
        public $post_excerpt = "";          // User-defined post excerpt
        public $post_status = "publish";    // See get_post_status for values
        public $comment_status = "closed";  // Returns: { open, closed }
        public $ping_status = "closed";     // Returns: { open, closed }
        public $post_password = "";         // Returns empty string if no password
        public $post_parent = 0;            // Parent Post ID (default 0)
        public $post_mime_type = '';
        public $to_ping = '';
        public $pinged = '';
        public $post_modified = "";         // Format: 0000-00-00 00:00:00
        public $post_modified_gmt = "";     // Format: 0000-00-00 00:00:00
        public $comment_count = 0;          // Number of comments on post (numeric string)
        public $menu_order = 0;             // Order value as set through page-attribute when enabled (numeric string. Defaults to 0)
        public $guid = "";
        public $asl_guid;
        public $asl_id;
        public $asl_data;                   // All the original results data
        public $blogid;

        public function __construct() {}
    }
}

if ( !function_exists("asl_results_to_wp_obj") ) {
    /**
     * Converts ajax results from Ajax Search Pro to post like objects to be displayable
     * on the regular search results page.
     *
     * @param $results
     * @param int $from
     * @param string $count
     * @return array
     */
    function asl_results_to_wp_obj($results, $from = 0, $count = "all") {
        if ( empty($results) )
            return array();

        if ($count == "all")
            $results_slice = array_slice($results, $from);
        else
            $results_slice = array_slice($results, $from, $count);

        if (empty($results_slice))
            return array();

        $wp_res_arr = array();

        $date_format = get_option('date_format');
        $time_format = get_option('time_format');

        $current_date = date($date_format . " " . $time_format, time());

        foreach ($results_slice as $r) {

            $switched_blog = false;

            if ( !isset($r->content_type) ) continue;

            switch ($r->content_type) {
                case "attachment":
                case "pagepost":
                    $res = get_post($r->id);
                    $res->asl_guid = get_permalink($r->id);
                    $r->link = $res->asl_guid;
                    $r->url = $res->asl_guid;
                    $res->asl_id = $r->id;  // Save the ID in case needed for some reason
                    /**
                     * On multisite the page and other post type links are filtered in such a way
                     * that the post type object is reset with get_post(), deleting the ->asl_guid
                     * attribute. Therefore the post type post must be enforced.
                     */
                    if ( is_multisite() && $res->post_type != 'post' ) {
                        // Is this a WooCommerce search?
                        if (
                        !(
                            in_array($res->post_type, array('product', 'product_variation')) &&
                            isset($_GET['post_type']) &&
                            $_GET['post_type'] == 'product'
                        )
                        ) {
                            $res->post_type = 'post'; // Enforce
                            if ( $switched_blog )
                                $res->ID = -10;
                        }
                    }
                    break;
                case "blog":
                    $res = new ASL_Post();
                    $res->post_title = $r->title;
                    $res->asl_guid = $r->link;
                    $res->post_content = $r->content;
                    $res->post_excerpt = $r->content;
                    $res->post_date = $current_date;
                    $res->asl_id = $r->id;
                    $res->ID = -10;
                    break;
                case "bp_group":
                case "bp_activity":
                    $res = new ASL_Post();
                    $res->post_title = $r->title;
                    $res->asl_guid = $r->link;
                    $res->post_content = $r->content;
                    $res->post_excerpt = $r->content;
                    $res->post_date = $r->date;
                    $res->asl_id = $r->id;
                    $res->ID = -10;
                    break;
                case "comment":
                    $res = get_post($r->post_id);
                    if (isset($res->post_title)) {
                        $res->post_title = $r->title;
                        $res->asl_guid = $r->link;
                        $res->asl_id = $r->id;
                        $res->post_content = $r->content;
                        $res->post_excerpt = $r->content;
                    }
                    break;
                case "term":
                case "user":
                    $res = new ASL_Post();
                    $res->post_title = $r->title;
                    $res->asl_guid = $r->link;
                    $res->guid = $r->link;
                    $res->post_date = $current_date;
                    $res->asl_id = $r->id;
                    $res->ID = -10;
                    break;
                case "peepso_group":
                    if ( class_exists('PeepSoGroup') ) {
                        $pg = new PeepSoGroup($r->id);
                        $res = get_post($r->id);
                        $res->asl_guid = $pg->get_url();
                        $res->asl_id = $r->id;  // Save the ID in case needed for some reason
                    }
                    break;
                case "peepso_activity":
                    $res = get_post($r->id);
                    $res->asl_guid = get_permalink($r->id);
                    $res->asl_id = $r->id;  // Save the ID in case needed for some reason
                    break;
            }

            if ( !empty($res) ) {
                $res->asl_data = $r;
                $res = apply_filters("asl_regular_search_result", $res, $r);
                $wp_res_arr[] = $res;
            }

            if (is_multisite())
                restore_current_blog();
        }

        return $wp_res_arr;
    }
}

if ( !function_exists("get_asl_result_field") ) {
    function get_asl_result_field($field = 'all') {
        global $post;

        if ( !is_string($field) )
            return false;

        if ($field === 'all') {
            if (isset($post, $post->asl_data)) {
                return $post->asl_data;
            } else {
                return false;
            }
        } else {
            if (isset($post, $post->asl_data) && property_exists($post->asl_data, $field)) {
                return $post->asl_data->{$field};
            } else {
                return false;
            }
        }
    }
}
if ( !function_exists("the_asl_result_field") ) {
    function the_asl_result_field( $field = 'title', $echo = true ) {
        if ( $echo ) {
            if ( !is_string($field) )
                return;
            $print = $field == 'all' ? '' : get_asl_result_field($field);
            if ( $print !== false )
                echo $print;
        } else {
            return get_asl_result_field($field);
        }
    }
}