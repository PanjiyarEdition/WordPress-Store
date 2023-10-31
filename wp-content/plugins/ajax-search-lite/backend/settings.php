<?php
$params = array();
$action_msg = "";

$inst = wd_asl()->instances->get(0);
$sd = &$inst['data'];

if (isset($_POST['submit_asl'])) {

	if ( wp_verify_nonce( $_POST['asl_sett_nonce'], 'asl_sett_nonce' ) ) {
		$params = wpdreams_parse_params($_POST);
		$_asl_options = array_merge($sd, $params);

		wd_asl()->instances->update(0, $_asl_options);
		// Force instance data to the debug storage
		wd_asl()->debug->pushData(
			$_asl_options,
			'asl_options', true
		);

		$action_msg = "<div class='infoMsg'><strong>" . __('Search settings saved!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
	} else {
		$action_msg = "<div class='errorMsg'><strong>".  __('<strong>ERROR Saving:</strong> Invalid NONCE, please try again!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
		$_POST = array();
	}
}
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>

<div id="wpdreams" class='wpdreams wrap<?php echo isset($_COOKIE['asl-accessibility']) ? ' wd-accessible' : ''; ?>'>
	<h2 display="none"></h2>
    <?php if (ASL_DEBUG == 1): ?>
        <p class='infoMsg'>Debug mode is on!</p>
    <?php endif; ?>

    <?php if (wd_asl()->o['asl_performance']['use_custom_ajax_handler'] == 1): ?>
        <p class='noticeMsgBox'>AJAX SEARCH LITE NOTICE: The custom ajax handler is enabled. In case you experience issues, please
            <a href='<?php echo get_admin_url() . "admin.php?page=ajax-search-lite/backend/performance_options.php"; ?>'>turn it off.</a></p>
    <?php endif; ?>

	<style>
	.socials a {
		color: white;
		border-radius: 4px;
		padding: 8px 12px;
		margin-left: 12px;
		font-size: 14px;
    	text-decoration: none;
		font: normal 13px/100% 'PT Sans', Verdana,Tahoma,sans-serif;
	}

	.socials svg {
		fill: white;
		vertical-align: middle;
		margin: -3px 4px 0 0;
	}

	.socials a.facebook {
		background: #3A589E;
	}

	.socials a.twitter {
		background: #55ACEE;
	}
	</style>
    <div class="wpdreams-box" style='vertical-align: middle;'>
        <a class='gopro' href='https://ajaxsearchpro.com/?utm_source=ajax-search-lite&utm_content=instancetop' target='_blank'>Get the pro version!</a>
        <a class="whypro" href="#">Why Pro?</a>
		<span class="socials">
			<a class="facebook" target="_blank" href="https://www.facebook.com/wpdreams">
				<svg width="18" height="18" aria-hidden="true" role="img" focusable="false">
					<svg id="ifacebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48A48 48 0 000 80v352a48 48 0 0048 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0048-48V80a48 48 0 00-48-48z"></path></svg>
				</svg>
				WPDreams
			</a>
			<a class="twitter" target="_blank" href="https://twitter.com/ernest_marcinko">
				<svg width="18" height="18" aria-hidden="true" role="img" focusable="false">
					<svg id="itwitter" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
				</svg>
				Ernest Marcinko
			</a>
		</span>
        <div class="hiddend">
            <div id="whypro_content">
                <?php include(ASL_PATH . "backend/whypro.php"); ?>
            </div>
        </div>
    </div>

    <div class="wpdreams-box">

            <label class="shortcode"><?php _e("Search shortcode:", "ajax-search-lite"); ?></label>
            <input type="text" class="shortcode" value="[wpdreams_ajaxsearchlite]"
                   readonly="readonly"/>
            <label class="shortcode"><?php _e("Search shortcode for templates:", "ajax-search-lite"); ?></label>
            <input type="text" class="shortcode"
                   value="&lt;?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?&gt;"
                   readonly="readonly"/>
    </div>
    <div class="wpdreams-box" style="float:left;">
		<?php echo $action_msg; ?>

		<form action='' method='POST' name='asl_data'>
            <ul id="tabs" class='tabs'>
                <li><a tabid="1" class='current general'><?php _e("General Options", "ajax-search-lite"); ?></a></li>
                <li><a tabid="2" class='multisite'><?php _e("Image Options", "ajax-search-lite"); ?></a></li>
                <li><a tabid="3" class='frontend'><?php _e("Frontend Filters", "ajax-search-lite"); ?></a></li>
                <li><a tabid="4" class='layout'><?php _e("Layout options", "ajax-search-lite"); ?></a></li>
                <li><a tabid="7" class='advanced'><?php _e("Advanced", "ajax-search-lite"); ?></a></li>
            </ul>
            <div id="content" class='tabscontent'>
                <div tabid="1">
                    <fieldset>
                        <legend><?php _e("Genearal Options", "ajax-search-lite"); ?></legend>

                        <?php include(ASL_PATH . "backend/tabs/instance/general_options.php"); ?>

                    </fieldset>
                </div>
                <div tabid="2">
                    <fieldset>
                        <legend><?php _e("Image Options", "ajax-search-lite"); ?>
							<span class="asl_legend_docs">
								<a target="_blank" href="https://documentation.ajaxsearchlite.com/image-settings"><span class="fa fa-book"></span>
									<?php echo __('Documentation', 'ajax-search-lite'); ?>
								</a>
							</span>
						</legend>

                        <?php include(ASL_PATH . "backend/tabs/instance/image_options.php"); ?>

                    </fieldset>
                </div>
                <div tabid="3">
                    <fieldset>
                        <legend><?php _e("Frontend Search Filters", "ajax-search-lite"); ?>
							<span class="asl_legend_docs">
								<a target="_blank" href="https://documentation.ajaxsearchlite.com/frontend-search-filters"><span class="fa fa-book"></span>
									<?php echo __('Documentation', 'ajax-search-lite'); ?>
								</a>
							</span>
						</legend>

                        <?php include(ASL_PATH . "backend/tabs/instance/frontend_options.php"); ?>

                    </fieldset>
                </div>
                <div tabid="4">
                    <fieldset>
                        <legend><?php _e("Layout Options", "ajax-search-lite"); ?></legend>

                        <?php include(ASL_PATH . "backend/tabs/instance/layout_options.php"); ?>

                    </fieldset>
                </div>
                <div tabid="7">
                    <fieldset>
                        <legend><?php _e("Advanced Options", "ajax-search-lite"); ?></legend>

                        <?php include(ASL_PATH . "backend/tabs/instance/advanced_options.php"); ?>

                    </fieldset>
                </div>
            </div>
            <input type="hidden" name="sett_tabid" id="sett_tabid" value="1" />
			<input type="hidden" name="asl_sett_nonce" id="asl_sett_nonce" value="<?php echo wp_create_nonce( "asl_sett_nonce" ); ?>">
        </form>
    </div>
	<?php include(ASL_PATH . "backend/sidebar.php"); ?>
    <div class="clear"></div>
</div>
<?php wp_enqueue_script('wd_asl_helpers_jquery_conditionals', plugin_dir_url(__FILE__) . 'settings/assets/js/jquery.conditionals.js', array('jquery'), ASL_CURR_VER_STRING, true); ?>
<?php wp_enqueue_script('wd_asl_search_instance', plugin_dir_url(__FILE__) . 'settings/assets/search_instance.js', array('jquery'), ASL_CURR_VER_STRING, true); ?>