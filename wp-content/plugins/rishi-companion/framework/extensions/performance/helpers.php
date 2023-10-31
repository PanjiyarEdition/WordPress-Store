<?php

/**
 * Global Settings.
 */
class RishiCompanionPerformance {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialization.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init() {

        // Frontend Performance Hooks.
        add_action( 'init', [ $this, 'rishi_companion_inithook' ],9999 );
        add_action( 'init', [ $this, 'rishi_companion_disable_elementor_google_fonts' ], 99 );
        add_filter( 'script_loader_src', [ $this, 'rishi_companion_remove_script_version' ], 15, 1 );
        add_filter( 'style_loader_src', [ $this, 'rishi_companion_remove_script_version' ], 15, 1 );
        add_action( 'pre_ping',  [ $this, 'rishi_companion_disable_self_pingbacks' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'rishi_companion_disable_woocommerce_scripts' ], 99 );
        add_action( 'wp_enqueue_scripts', [ $this, 'rishi_companion_disable_elementor_icons' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'rishi_companion_disable_frontend_scripts' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'rishi_companion_remove_gutenberg_style' ], 99999999 );
        add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'rishi_companion_disable_elementor_pro_script' ] );
        add_action( 'elementor/frontend/after_register_styles', [ $this, 'rishi_companion_disable_fontawesome' ], 20 );
        add_action( 'wp_head', [ $this, 'rishi_companion_remove_rss_feed_links' ], 1 );

        //Lightbox      
        add_action(	'wp_enqueue_scripts', [ $this, 'rishi_companion_enqueue_custom_js' ] );
        
        //CSS Preload
        if ( get_theme_mod( 'ed_preload_css', 'no' ) === 'yes' ){
            add_filter( 'style_loader_tag', [ $this, 'rishi_companion_preload_css' ], 10, 4 );
        }

        add_action( 'rt:load_dynamic_google_fonts', array( $this, 'rishi_companion_load_local_google_fonts' ), 10, 1 );

        // add_filter( 'rishi:typography:google:use-remote', '__return_false' );
        
        if( get_theme_mod( 'ed_display_swap', 'yes' ) == 'no' ) {
            add_filter( 'rt_google_font_add_display_swap', '__return_false' );
        }
        
        if( get_theme_mod( 'featured_image_360_240', 'yes' ) == 'no' ) {
            add_filter( 'rishi_image_dimension_360_240', '__return_false' );
        }
        
        if( get_theme_mod( 'featured_image_750_520', 'yes' ) == 'no' ) {
            add_filter( 'rishi_image_dimension_750_520', '__return_false' );
        }
       
        if( get_theme_mod( 'featured_image_1170_650', 'yes' ) == 'no' ) {
            add_filter( 'rishi_image_dimension_1170_650', '__return_false' );
        }
        
        if( get_theme_mod( 'responsive_images', 'no' ) == 'yes' ) {
            add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
        }
        
        if( get_theme_mod( 'lazy_load_featured_img', 'no' ) == 'yes' || get_theme_mod( 'ed_autoload', 'no' ) == 'yes' ) {
            add_filter( 'rishi_lazy_load_on_single_post', '__return_false' );
        }

        add_action( 'wp', [$this, 'rishi_companion_assets_js_init'] );
    }

    /**
     * Init Assets JS
     *
     * @return void
     */
    public function rishi_companion_assets_js_init() {

            $defer_check = get_theme_mod( 'ed_defer_js', 'no' );
            
            $delay_check = get_theme_mod( 'ed_delay_js', 'no' );

            $image_dimensions = get_theme_mod( 'missing_img_dimensions', 'no' );

            $lazy_load  = get_theme_mod( 'has_lazy_load', 'yes' );

            if($defer_check === 'yes' || $delay_check === 'yes' || $image_dimensions === 'yes' || $lazy_load === 'yes') {
                //actions + filters
                if( $defer_check === 'yes' || $delay_check === 'yes' ){
                    add_filter('rishi_companion_output_buffer_template_redirect', [ $this, 'rishi_companion_optimize_js' ], 2);
                }
        
                if($delay_check === 'yes' && !is_admin() && !rishi_companion_is_dynamic_request() && !isset($_GET['rishi_companion']) && !rishi_companion_is_page_builder() && !is_embed() && !is_feed() && !is_customize_preview()) {
                    add_action('wp_footer', [ $this,'rishi_companion_print_delay_js'], PHP_INT_MAX );
                }

                if( $image_dimensions === 'yes' ){
                    add_action( 'rishi_companion_output_buffer_template_redirect', [ $this, 'rishi_companion_image_dimensions' ] );
                }

                if( $lazy_load === 'yes' ){
                    if( class_exists( 'Rishi\Rishi_Pro' ) && get_theme_mod( 'ed_autoload', 'no') == 'yes' && is_singular( 'post' ) ){
                        return;
                    }
                    add_action( 'rishi_companion_output_buffer_template_redirect', [ $this, 'rishi_companion_lazy_load' ] );
                }
            }

    }

    /**
     * Optimize JS
     *
     * @return void
     */
    public function rishi_companion_optimize_js( $html ) {

        //strip comments before search
        $html_no_comments = preg_replace('/<!--(.*)-->/Uis', '', $html);

        //match all script tags
        preg_match_all('#(<script\s?([^>]+)?\/?>)(.*?)<\/script>#is', $html_no_comments, $matches);

        //no script tags found
        if(!isset($matches[0])) {
            return $html;
        }

        $defer_check = get_theme_mod( 'ed_defer_js', 'no' );

        //build js exlusions array
	    $js_exclusions = array();

        $excluded_list = strtolower( get_theme_mod( 'excluded_js_list', 'jQuery.min.js' ) );

        $excluded_arr = explode( "\n", $excluded_list );

        if($defer_check === 'yes') {

            //add jquery if needed
            array_push($js_exclusions, 'jquery(?:\.min)?.js', 'i18n(?:\.min)?.js', 'hooks(?:\.min)?.js', 'moment(?:\.min)?.js', 'date(?:\.min)?.js');
    
            //add extra user exclusions
            if($excluded_arr[0] != '' && is_array($excluded_arr)) {
                foreach($excluded_arr as $line) {
                    array_push($js_exclusions, preg_quote($line));
                }
            }
    
            //convert exlusions to string for regex 
            $js_exclusions = implode('|', $js_exclusions);
        }

        foreach($matches[0] as $i => $tag) {

            $atts_array = !empty($matches[2][$i]) ? rishi_lazyload_get_atts_array($matches[2][$i]) : array();
            
            //skip if type is not javascript
            if(isset($atts_array['type']) && stripos($atts_array['type'], 'javascript') == false) {
                continue;
            }

            //delay javascript
            if( get_theme_mod( 'ed_delay_js', 'no' ) === 'yes' ) {
    
                $delay_flag = false;
    
                if( get_theme_mod( 'delay_behaviour', 'all_scripts' ) === 'specific_scripts' ) {
                    $delay_list      = get_theme_mod( 'included_delay_list' );
                    $delayed_scripts = explode( "\n", $delay_list );
    
                    if(!empty($delayed_scripts)) {
                        foreach($delayed_scripts as $delayed_script) {
                            if(strpos($tag, $delayed_script) !== false) {
    
                                $delay_flag = true;
                
                                if(!empty($atts_array['src'])) {
                                    $atts_array['data-rishidelayedscript'] = $atts_array['src'];
                                    unset($atts_array['src']);
                                }
                                else {
                                    $atts_array['data-rishidelayedscript'] = "data:text/javascript;base64," . base64_encode($matches[3][$i]);
                                }
                            }
                        }
                    }
                }
                elseif( get_theme_mod( 'delay_behaviour', 'all_scripts' ) === 'all_scripts' ) {
    
                    $delay_list      = get_theme_mod( 'excluded_delay_list' );
                    $delayed_scripts = explode( "\n", $delay_list );

                    $excluded_scripts = array(
                        'rishi-delayed-scripts-js',
                        'public',
                        'events',
                        'rishi-pro-frontend-js-extra',
                        'rishi-companion-frontend-js-extra'
                    );
    
                    if( !empty($delayed_scripts) && is_array( $delayed_scripts ) ) {
                        $excluded_scripts = array_merge($excluded_scripts, $delayed_scripts );
                    }
        
                    if(!empty($excluded_scripts)) {
                        foreach($excluded_scripts as $excluded_script) {
                            // check is $excluded_script is empty.
                            if( !empty( $excluded_script ) ) {
                                if(strpos($tag, $excluded_script) !== false) {
                                    continue 2;
                                }
                            }
                        }
                    }
    
                    $delay_flag = true;
    
                    if(!empty($atts_array['type'])) {
                        $atts_array['data-rishi-type'] = $atts_array['type'];
                    }
    
                    $atts_array['type'] = 'rishidelayedscript';
                }
    
                if($delay_flag) {
    
                    $atts_array['data-cfasync'] = "false";
                    $atts_array['data-no-optimize'] = "1";
                    $atts_array['data-no-defer'] = "1";
                    $atts_array['data-no-minify'] = "1";
    
                    //wp rocket compatability
                    if(defined('WP_ROCKET_VERSION')) {
                        $atts_array['data-rocketlazyloadscript'] = "1";
                    }
    
                    $delayed_atts_string = rishi_lazyload_get_atts_string($atts_array);
                    $delayed_tag = sprintf('<script %1$s>', $delayed_atts_string) . (( get_theme_mod( 'ed_delay_js', 'no' ) === 'yes' ) ? $matches[3][$i] : '') . '</script>';
    
                    //replace new full tag in html
                    $html = str_replace($tag, $delayed_tag, $html);
    
                    continue;
                }
            }

            //defer javascript
            if($defer_check === 'yes') {
    
                //src is not set
                if(empty($atts_array['src'])) {
                    continue;
                }
    
                //check if src is excluded
                if(!empty($js_exclusions) && preg_match('#(' . $js_exclusions . ')#i', $atts_array['src'])) {
                    continue;
                }
    
                //skip if there is already an async
                if(stripos($matches[2][$i], 'async') !== false) {
                    continue;
                }
    
                //skip if there is already a defer
                if(stripos($matches[2][$i], 'defer' ) !== false ) {
                    continue;
                }
    
                //add defer to opening tag
                $deferred_tag_open = str_replace('>', ' defer>', $matches[1][$i]);
    
                //replace new open tag in original full tag
                $deferred_tag = str_replace($matches[1][$i], $deferred_tag_open, $tag);
    
                //replace new full tag in html
                $html = str_replace($tag, $deferred_tag, $html);
            }
        }
        return $html;
    }

    public function rishi_companion_lazy_load($html){
        //match all img tags without width or height attributes
        preg_match_all('/(<img[^>]+>)/i', $html, $images, PREG_SET_ORDER);

        if(!empty($images)) {

            $lazy_images_count = 0;

            $exclude_lazy_load_images = get_theme_mod( 'exclude_lazy_load_images', 'no' );

            $exclude_leading_images = get_theme_mod( 'exclude_leading_images', absint( 3 ) );

            $exclude_image_list     = get_theme_mod( 'excluded_images_list' );

            $exclude_images         = explode( "\n", $exclude_image_list );

            //remove any duplicate images
            $images = array_unique($images, SORT_REGULAR);

            //loop through images
            foreach($images as $image) {

                if( preg_match('#(default-logo)#i', $image[0]) ){
                    continue;
                }

                if( $exclude_lazy_load_images == 'yes' ){

                    $continue = false;
                    $match = implode( '|', $exclude_images );

                    if( ! empty( $match ) ){
                        $continue = !! preg_match('#(' . $match . ')#i', $image[0]);
                    } 

                    if ( $continue ) continue;

                }

                //get image attributes array
                $image_atts = rishi_lazyload_get_atts_array($image[1]);

                $sourse_set = (isset($image_atts ['srcset']) && $image_atts ['srcset'] ? $image_atts['srcset'] : '' );

                $data_set   = (!empty($sourse_set) ? 'data-rt-lazy-set="' . $sourse_set . '"' : '');

                if( 0 < $exclude_leading_images && $exclude_lazy_load_images == 'yes' ){
                    if($lazy_images_count <= $exclude_leading_images) {  
                        //remove any existing source attributes
                        $new_image = preg_replace('/(src)=[\'"](?:\S+)*[\'"]/i', '', $image[0]);

                        $new_image  = preg_replace('/(srcset)=".*"/i', '', $image[0]);

                        $new_image  = preg_replace('/(loading)=".*"/i', '', $image[0]);

                        //add attributes to img tag
                        if(!empty($image_atts['src'])) {
                           $new_image = preg_replace('/<\s*img/i', '<img src="' . $image_atts['src'] . '"', $new_image);
                        }
                        //replace original img tag in html
                        if(!empty($new_image)) {
                            $html = str_replace($image[0], $new_image, $html);
                        }
                    }else{
                        //remove any existing source attributes
                        $new_image = preg_replace('/(src)=[\'"](?:\S+)*[\'"]/i', '', $image[0]);

                        //add attributes to img tag
                        if(!empty($image_atts['src'])) {
                           $new_image = preg_replace('/<\s*img/i', '<img data-rt-lazy="' . $image_atts['src'] . '" loading="lazy"' . $data_set . 'data-object-fit="~" ', $new_image);
                        }
                        //replace original img tag in html
                        if(!empty($new_image)) {
                            $html = str_replace($image[0], $new_image, $html);
                        }
                    }
                }else{
                    if(!empty($image_atts['src'])) {

                        //remove any existing source attributes
                        $new_image = preg_replace('/(src)=[\'"](?:\S+)*[\'"]/i', '', $image[0]);

                        //add attributes to img tag
                        $new_image = preg_replace('/<\s*img/i', '<img data-rt-lazy="' . $image_atts['src'] . '" loading="lazy"' . $data_set . 'data-object-fit="~" ', $new_image);

                        //replace original img tag in html
                        if(!empty($new_image)) {
                            $html = str_replace($image[0], $new_image, $html);
                        }
                    }
                }
            
                $lazy_images_count++;
            
            }

        }

        return $html;
    }

    //fix images missing dimensions
    public static function rishi_companion_image_dimensions($html) {
        //match all img tags without width or height attributes
        preg_match_all('#<img((?:[^>](?!(height|width)=[\'\"](?:\S+)[\'\"]))*+)>#is', $html, $images, PREG_SET_ORDER);

        if(!empty($images)) {

            //remove any duplicate images
            $images = array_unique($images, SORT_REGULAR);

            //loop through images
            foreach($images as $image) {

                //get image attributes array
                $image_atts = rishi_lazyload_get_atts_array($image[1]);

                if(!empty($image_atts['src'])) {

                    //get image dimensions
                    $dimensions = self::rishi_companion_get_dimensions_from_url($image_atts['src']);

                    if(!empty($dimensions)) {

                        //remove any existing dimension attributes
                        $new_image = preg_replace('/(height|width)=[\'"](?:\S+)*[\'"]/i', '', $image[0]);

                        //add dimension attributes to img tag
                        $new_image = preg_replace('/<\s*img/i', '<img width="' . $dimensions['width'] . '" height="' . $dimensions['height'] . '"', $new_image);

                        //replace original img tag in html
                        if(!empty($new_image)) {
                            $html = str_replace($image[0], $new_image, $html);
                        }
                    }
                }
            }
        }

        return $html;
    }

    //return array of dimensions based on image url
    private static function rishi_companion_get_dimensions_from_url($url){
        //grab dimensions from file name if available
        if(preg_match('/(?:.+)-([0-9]+)x([0-9]+)\.(jpg|jpeg|png|gif|svg)$/', $url, $matches)) {
            return array('width' => $matches[1], 'height' => $matches[2]);
        }

        //get image path
        $image_path = ABSPATH . parse_url($url)['path'];

        if(file_exists($image_path)) {

            //get dimensions from file
            $sizes = getimagesize($image_path);

            if(!empty($sizes)) {
                return array('width' => $sizes[0], 'height' => $sizes[1]);
            }
        }

        return false;
    }

    /**
     * Remove Script/Style version parameter
    */
    public function rishi_companion_remove_script_version( $src ){
        if ( is_admin() )
        return $src;
        if( get_theme_mod( 'ed_ver', 'no' ) === 'yes' ){
            $parts = explode( '?ver', $src );
            return $parts[0];
        }else{
            return $src;
        }   
    }

    /**
     * Print inline Delay JS
    */
    public function rishi_companion_print_delay_js(){
        $delay_behaviour = get_theme_mod( 'delay_behaviour', 'all_scripts' );
        $delay_timeout   = get_theme_mod( 'delay_timeout', 'none' );
        $timeout         = ( $delay_timeout !== 'none' ? $delay_timeout : '' );

        if( get_theme_mod( 'ed_delay_js', 'no' ) === 'yes' ) {
            if($delay_behaviour === 'specific_scripts') {
                echo '<script type="text/javascript" id="rishi-delayed-scripts-js">' . (!empty($timeout) ? 'const rishiDelayTimer = setTimeout(rishiLoadDelayedScripts,' . $timeout . '*1000);' : '') . 'const rishiUserInteractions=["keydown","mousemove","wheel","touchmove","touchstart","touchend"];rishiUserInteractions.forEach(function(event){window.addEventListener(event,rishiTriggerDelayedScripts,{passive:!0})});function rishiTriggerDelayedScripts(){rishiLoadDelayedScripts();' . (!empty($timeout) ? 'clearTimeout(rishiDelayTimer);' : '') . 'rishiUserInteractions.forEach(function(event){window.removeEventListener(event, rishiTriggerDelayedScripts,{passive:!0});});}function rishiLoadDelayedScripts(){document.querySelectorAll("script[data-rishidelayedscript]").forEach(function(elem){elem.setAttribute("src",elem.getAttribute("data-rishidelayedscript"));});}</script>';
            }
            else {
  			    echo '<script type="text/javascript" id="rishi-delayed-scripts-js">' . (!empty($timeout) ? 'const rishiDelayTimer=setTimeout(rishiTriggerDOMListener,' . $timeout . '*1000),' : '') . 'rishiUserInteractions=["keydown","mousemove","wheel","touchmove","touchstart","touchend","touchcancel","touchforcechange"],rishiDelayedScripts={normal:[],defer:[],async:[]},jQueriesArray=[];var rishiDOMLoaded=!1;function rishiTriggerDOMListener(){' . (!empty($timeout) ? 'clearTimeout(rishiDelayTimer),' : '') . 'rishiUserInteractions.forEach(function(e){window.removeEventListener(e,rishiTriggerDOMListener,{passive:!0})}),"loading"===document.readyState?document.addEventListener("DOMContentLoaded",rishiTriggerDelayedScripts):rishiTriggerDelayedScripts()}async function rishiTriggerDelayedScripts(){rishiDelayEventListeners(),rishiDelayJQueryReady(),rishiProcessDocumentWrite(),rishiSortDelayedScripts(),rishiPreloadDelayedScripts(),await rishiLoadDelayedScripts(rishiDelayedScripts.normal),await rishiLoadDelayedScripts(rishiDelayedScripts.defer),await rishiLoadDelayedScripts(rishiDelayedScripts.async),await rishiTriggerEventListeners()}function rishiDelayEventListeners(){let e={};function t(t,n){function r(n){return e[t].delayedEvents.indexOf(n)>=0?"rishi-"+n:n}e[t]||(e[t]={originalFunctions:{add:t.addEventListener,remove:t.removeEventListener},delayedEvents:[]},t.addEventListener=function(){arguments[0]=r(arguments[0]),e[t].originalFunctions.add.apply(t,arguments)},t.removeEventListener=function(){arguments[0]=r(arguments[0]),e[t].originalFunctions.remove.apply(t,arguments)}),e[t].delayedEvents.push(n)}function n(e,t){const n=e[t];Object.defineProperty(e,t,{get:n||function(){},set:function(n){e["rishi"+t]=n}})}t(document,"DOMContentLoaded"),t(window,"DOMContentLoaded"),t(window,"load"),t(window,"pageshow"),t(document,"readystatechange"),n(document,"onreadystatechange"),n(window,"onload"),n(window,"onpageshow")}function rishiDelayJQueryReady(){let e=window.jQuery;Object.defineProperty(window,"jQuery",{get:()=>e,set(t){if(t&&t.fn&&!jQueriesArray.includes(t)){t.fn.ready=t.fn.init.prototype.ready=function(e){rishiDOMLoaded?e.bind(document)(t):document.addEventListener("rishi-DOMContentLoaded",function(){e.bind(document)(t)})};const e=t.fn.on;t.fn.on=t.fn.init.prototype.on=function(){if(this[0]===window){function t(e){return e.split(" ").map(e=>"load"===e||0===e.indexOf("load.")?"rishi-jquery-load":e).join(" ")}"string"==typeof arguments[0]||arguments[0]instanceof String?arguments[0]=t(arguments[0]):"object"==typeof arguments[0]&&Object.keys(arguments[0]).forEach(function(e){delete Object.assign(arguments[0],{[t(e)]:arguments[0][e]})[e]})}return e.apply(this,arguments),this},jQueriesArray.push(t)}e=t}})}function rishiProcessDocumentWrite(){const e=new Map;document.write=document.writeln=function(t){var n=document.currentScript,r=document.createRange();let a=e.get(n);void 0===a&&(a=n.nextSibling,e.set(n,a));var o=document.createDocumentFragment();r.setStart(o,0),o.appendChild(r.createContextualFragment(t)),n.parentElement.insertBefore(o,a)}}function rishiSortDelayedScripts(){document.querySelectorAll("script[type=rishidelayedscript]").forEach(function(e){e.hasAttribute("src")?e.hasAttribute("defer")&&!1!==e.defer?rishiDelayedScripts.defer.push(e):e.hasAttribute("async")&&!1!==e.async?rishiDelayedScripts.async.push(e):rishiDelayedScripts.normal.push(e):rishiDelayedScripts.normal.push(e)})}function rishiPreloadDelayedScripts(){var e=document.createDocumentFragment();[...rishiDelayedScripts.normal,...rishiDelayedScripts.defer,...rishiDelayedScripts.async].forEach(function(t){var n=t.getAttribute("src");if(n){var r=document.createElement("link");r.href=n,r.rel="preload",r.as="script",e.appendChild(r)}}),document.head.appendChild(e)}async function rishiLoadDelayedScripts(e){var t=e.shift();return t?(await rishiReplaceScript(t),rishiLoadDelayedScripts(e)):Promise.resolve()}async function rishiReplaceScript(e){return await rishiNextFrame(),new Promise(function(t){const n=document.createElement("script");[...e.attributes].forEach(function(e){let t=e.nodeName;"type"!==t&&("data-type"===t&&(t="type"),n.setAttribute(t,e.nodeValue))}),e.hasAttribute("src")?(n.addEventListener("load",t),n.addEventListener("error",t)):(n.text=e.text,t()),e.parentNode.replaceChild(n,e)})}async function rishiTriggerEventListeners(){rishiDOMLoaded=!0,await rishiNextFrame(),document.dispatchEvent(new Event("rishi-DOMContentLoaded")),await rishiNextFrame(),window.dispatchEvent(new Event("rishi-DOMContentLoaded")),await rishiNextFrame(),document.dispatchEvent(new Event("rishi-readystatechange")),await rishiNextFrame(),document.rishionreadystatechange&&document.rishionreadystatechange(),await rishiNextFrame(),window.dispatchEvent(new Event("rishi-load")),await rishiNextFrame(),window.rishionload&&window.rishionload(),await rishiNextFrame(),jQueriesArray.forEach(function(e){e(window).trigger("rishi-jquery-load")}),window.dispatchEvent(new Event("rishi-pageshow")),await rishiNextFrame(),window.rishionpageshow&&window.rishionpageshow()}async function rishiNextFrame(){return new Promise(function(e){requestAnimationFrame(e)})}rishiUserInteractions.forEach(function(e){window.addEventListener(e,rishiTriggerDOMListener,{passive:!0})});</script>';
            }
        }
    }
    
    /**
     * Add Preload to the CSS files
    */
    public function rishi_companion_preload_css ( $html, $handle, $href, $media ) {

        if ( is_admin () ) {
            return $html;
        }
    
        echo '<link rel="preload" href="' . $href . '" as="style" id="' . $handle . '" media="' . $media . '" onload="this.onload=null;this.rel=\'stylesheet\'">'
        . '<noscript>' . $html . '</noscript>';
    }

    public function rishi_companion_load_local_google_fonts($url) {

		if ( get_theme_mod( 'ed_google_fonts_local', 'no' ) == 'yes' ) {
			if ( ! empty( $url ) && get_theme_mod( 'ed_preload_local_fonts', 'no' ) == 'yes' ) {
				rishi_companion_load_preload_local_fonts( rishi_companion_get_webfont_url( $url ) );
			}
			wp_register_style(
				'rishi-fonts-font-source-google',
				rishi_companion_get_webfont_url( $url ),
				array()
			);
			wp_print_styles( 'rishi-fonts-font-source-google' );
		} else {
			wp_register_style( 'rishi-fonts-font-source-google', $url, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			wp_enqueue_style( 'rishi-fonts-font-source-google' );
		}
	}

    /**
     * Remove RSS Feed links
    */
    public function rishi_companion_remove_rss_feed_links(){
        if( get_theme_mod( 'ed_rssfeed_links', 'no' ) === 'yes' ){
            remove_action( 'wp_head', 'feed_links', 2 );
            remove_action( 'wp_head', 'feed_links_extra', 3 );
        }
    }

    /**
     * Remove Emojis from wordpress frontened
    */
    public function rishi_companion_inithook(){

        if( get_theme_mod( 'ed_emoji', 'no' ) === 'yes' ){
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );	
            remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
            remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
            remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        }

        if( get_theme_mod( 'ed_rssfeed', 'no' ) === 'yes' ){
            add_action('template_redirect',[ $this, 'rishi_companion_disable_rss_feeds' ],1 );
        }
        if( get_theme_mod( 'ed_embeds', 'no' ) === 'yes' ){
            global $wp;
            $wp->public_query_vars = array_diff($wp->public_query_vars, array('embed',));
            remove_action( 'rest_api_init', 'wp_oembed_register_route' );
            add_filter( 'embed_oembed_discover', '__return_false' );
            remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
            remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
            remove_action( 'wp_head', 'wp_oembed_add_host_js' );
            add_filter( 'tiny_mce_plugins', [ $this,'rishi_companion_disable_embeds_tiny_mce_plugin' ] );
            add_filter( 'rewrite_rules_array', [ $this,'rishi_companion_disable_embeds_rewrites' ] );
            remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
        }
        
        //Local Gravatar
        if( get_theme_mod( 'ed_local_gravatar', 'no' ) === 'yes' ){
            add_action('template_redirect', [ $this, 'rishi_companion_local_gravatar' ], 1 );
        }  
        
    }

    /**
     * Disable Emoji rewrites in TinyMCE Plugin
    */
    public function rishi_companion_disable_embeds_tiny_mce_plugin($plugins) {
        return array_diff($plugins, array('wpembed'));
    }

    /**
     * Disable Emoji rewrites
    */
    public function rishi_companion_disable_embeds_rewrites($rules) {
        foreach($rules as $rule => $rewrite) {
            if(false !== strpos($rewrite, 'embed=true')) {
                unset($rules[$rule]);
            }
        }
        return $rules;
    }

    /**
     * Disable Emoji in TinyMCE
    */
    public function rishi_companion_disable_emojis_tinymce( $plugins ) {
        if( is_array( $plugins ) ) {
            return array_diff( $plugins, array('wpemoji') );
        } else {
            return array();
        }
    }

    /**
     * Disable Emoji DNS Prefetching
    */
    public function rishi_companion_disable_emojis_dns_prefetch( $urls, $relation_type ) {
        if('dns-prefetch' == $relation_type) {
            $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/');
            $urls = array_diff($urls, array($emoji_svg_url));
        }
        return $urls;
    }

    /**
     * Disable Rss Feeds
    */
    public function rishi_companion_disable_rss_feeds() {

        if(!is_feed() || is_404()) {
            return;
        }
    
        //check for GET feed query variable firet and redirect
        if(isset($_GET['feed'])) {
            wp_redirect(esc_url_raw(remove_query_arg('feed')), 301);
            exit;
        }
    
        //unset wp_query feed variable
        if(get_query_var('feed') !== 'old') {
            set_query_var('feed', '');
        }
            
        //let Wordpress redirect to the proper URL
        redirect_canonical();
    
        //redirect failed, display error message
        wp_die(sprintf(__("No feed available, please visit the <a href='%s'>homepage</a>!"), esc_url(home_url('/'))));
    }

    /**
     * Disable WooCommerce Scripts
    */
    public function rishi_companion_disable_woocommerce_scripts() {
        if( function_exists( 'is_woocommerce' ) ) {
            if( !is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page() && !is_product() && !is_product_category() && !is_shop() ) {
                if( get_theme_mod( 'ed_woo_scripts', 'no' ) === 'yes' ){
                    //Dequeue WooCommerce Styles
                    $styles = array(
                        'woocommerce-general',
                        'woocommerce-layout',
                        'woocommerce-smallscreen',
                        'woocommerce_frontend_styles',
                        'woocommerce_fancybox_styles',
                        'woocommerce_chosen_styles',
                        'woocommerce_prettyPhoto_css',
                        'woocommerce-inline',
                        'wc-block-style',
                        'wc-block-vendors-style'
                    );
                    foreach( $styles as $style ) {
                        wp_dequeue_style( $style );
                        wp_deregister_style( $style );
                    }
        
                    //Dequeue WooCommerce Scripts
                    $scripts = array(
                        'wc_price_slider',
                        'wc-single-product',
                        'wc-add-to-cart',
                        'wc-checkout',
                        'wc-add-to-cart-variation',
                        'wc-single-product',
                        'wc-cart',
                        'wc-chosen',
                        'woocommerce',
                        'prettyPhoto',
                        'prettyPhoto-init',
                        'jquery-blockui',
                        'jquery-placeholder',
                        'fancybox',
                        'jqueryui'
                    );
                    foreach($scripts as $script) {
                        wp_dequeue_script($script);
                        wp_deregister_script($script);
                    }
        
                    //Remove no-js Script + Body Class
                    add_filter( 'body_class', function( $classes ) {
                        remove_action('wp_footer', 'wc_no_js');
                        $classes = array_diff( $classes, array( 'woocommerce-no-js' ) );
                        return array_values( $classes );
                    },10, 1);    
                }

                if( get_theme_mod( 'ed_woo_cart_fragramentation', 'no' ) === 'yes' ){
                    wp_dequeue_script('wc-cart-fragments');
                    wp_deregister_script('wc-cart-fragments');
                }
            }
        }
    }

    /**
	 * Checks if elementor is active or not
	*/
	public function rishi_companion_is_elementor_activated(){
		return class_exists( 'Elementor\\Plugin' ) ? true : false; 
	}

    /**
	 * Checks if elementor has override that particular page/post or not
	*/
	public function rishi_companion_is_elementor_activated_post(){

        if( $this->rishi_companion_is_elementor_activated() && is_singular()){
            global $post;
            $post_id = $post->ID;
            return \Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor( $post_id ) ? true : false;     
        }else{
            return false;
        }
	}

    public function rishi_companion_remove_gutenberg_style(){
		if( get_theme_mod( 'ed_gutenberg_style', 'no' ) === 'yes' && $this->rishi_companion_is_elementor_activated_post() ){
            wp_dequeue_style( 'rishi-gutenberg' );
            wp_dequeue_style( 'wp-block-library' );
            wp_dequeue_style( 'wp-block-library-theme' );
        }
    }

    /**
     * Disable Elementor Google Fonts
    */
    public function rishi_companion_disable_elementor_google_fonts(){
        if( get_theme_mod( 'ed_elementor_google_fonts', 'no' ) === 'yes' ){
            add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );
        }
    }

    /**
     * Disable Elementor Icons
    */
    public function rishi_companion_disable_elementor_icons(){
        if( get_theme_mod( 'ed_elementor_icons', 'no' ) === 'yes' ){
            wp_dequeue_style( 'elementor-icons' );
            wp_deregister_style( 'elementor-icons' );
        }
    }

    /**
     * Disable Elementor Fontawesome
    */
    public function rishi_companion_disable_fontawesome(){
        if( get_theme_mod( 'ed_elementor_font_awesome', 'no' ) === 'yes' ){
            foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
                wp_deregister_style( 'elementor-icons-fa-' . $style );
            }
        }
    }

    /**
     * Disable Elementor Pro Script
    */
    public function rishi_companion_disable_elementor_pro_script(){
        if( get_theme_mod( 'ed_elementor_elementor_pro_script', 'no' ) === 'yes' ){
            wp_dequeue_script( 'elementor-pro-frontend' );
            wp_deregister_script( 'elementor-pro-frontend' );
        }
    }
    
    /**
     * Disable Elementor Frontend Scripts
    */
    public function rishi_companion_disable_frontend_scripts(){
        if( get_theme_mod( 'ed_elementor_frontend_script', 'no' ) === 'yes' ){
            $scripts = array(
                'elementor-frontend',
                'elementor-frontend-modules',
            );
            foreach($scripts as $script) {
                wp_dequeue_script($script);
                wp_deregister_script($script);
            }
        }
    }

    /**
     * Disable self-pingbacks
    */
    public function rishi_companion_disable_self_pingbacks( $links ) {
        if( get_theme_mod( 'ed_self_pingbacks', 'no' ) === 'yes' ){
        foreach ( $links as $l => $link )
            if ( 0 === strpos( $link, get_option( 'home' ) ) )
                    unset($links[$l]);
        }
    }

    /**
     * Load Gravatars from local server 
    */
    public function rishi_companion_local_gravatar() {
        require_once plugin_dir_path(RISHI_COMPANION_PLUGIN_FILE) . 'includes/classes/class-local-gravatar.php';  
    }

    /**
     * Enqueue Fancybox if Lightbox setting for gallery blocks is enabled
    */
    public function rishi_companion_enqueue_custom_js(){
        if( get_theme_mod( 'lightbox_for_img', 'no' ) === 'no' ) return false;

		if (! function_exists('get_plugin_data')) {
			require_once(ABSPATH . 'wp-admin/includes/plugin.php');
		}

		$data = get_plugin_data(__FILE__);
		
        wp_enqueue_style( 'jquery-fancybox', 
			plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/public/css/jquery.fancybox.css' 
		);

		wp_enqueue_script(
			'jquery-fancybox',
			plugin_dir_url(RISHI_COMPANION_PLUGIN_FILE) . 'assets/public/js/jquery.fancybox.js',
			'',
			$data['Version'],
			true
		);
		
        wp_enqueue_script(
			'rc-custom-scripts',
			plugin_dir_url(RISHI_COMPANION_PLUGIN_FILE) . 'assets/public/js/custom.js',
			'',
			$data['Version'],
			true
		);

		wp_localize_script(
			'rc-custom-scripts',
			'RishiCompanionCustom',
			array( 
				'lightbox'      => get_theme_mod( 'lightbox_for_img', 'no' ),			
			)
		);
	}

    /**
     * Query WooCommerce activation
     */
    public function rishi_companion_is_woocommerce_activated() {
        return class_exists( 'woocommerce' ) ? true : false;
    }

    /**
     * Check if Contact Form 7 Plugin is installed
    */
    public function rishi_companion_is_cf7_activated(){
        return class_exists( 'WPCF7' ) ? true : false;
    }

}