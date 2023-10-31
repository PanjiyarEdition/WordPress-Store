<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

$com_options = wd_asl()->o['asl_compatibility'];

if (ASL_DEMO) $_POST = null;

// Compatibility stuff
$action_msg = '';
if (
isset($_POST, $_POST['asl_compatibility'], $_POST['asl_compatibility_nonce'])
) {
	if ( wp_verify_nonce( $_POST['asl_compatibility_nonce'], 'asl_compatibility_nonce' ) ) {
		$values = array(
			// CSS and JS
			"js_source" => $_POST['js_source'],
			"script_loading_method" => $_POST['script_loading_method'],
			"init_instances_inviewport_only" => $_POST['init_instances_inviewport_only'],
			"detect_ajax" => $_POST['detect_ajax'],
			'load_google_fonts' => $_POST['load_google_fonts'],
			// Query options
			'query_soft_check' => $_POST['query_soft_check'],
			'use_acf_getfield' => $_POST['use_acf_getfield'],
			"db_force_case" => $_POST['db_force_case'],
			"db_force_unicode" => $_POST['db_force_unicode'],
			"db_force_utf8_like" => $_POST['db_force_utf8_like']
		);
		update_option('asl_compatibility', $values);
		$action_msg = "<div class='successMsg'>" . __('Search compatibility settings successfuly updated!', 'ajax-search-lite') . "</div>";
	} else {
		$action_msg = "<div class='errorMsg'>" . __('Something went wrong, pelase try again!', 'ajax-search-lite') . "</div>";
		$_POST = array();
	}
}
?>
<div id="wpdreams" class='wpdreams wrap<?php echo isset($_COOKIE['asl-accessibility']) ? ' wd-accessible' : ''; ?>'>
    <div class="wpdreams-box" style="float:left;">

        <div class='wpdreams-slider'>

			<?php echo $action_msg; ?>

            <?php if (ASL_DEMO): ?>
                <p class="infoMsg">DEMO MODE ENABLED - Please note, that these options are read-only</p>
            <?php endif; ?>

			<ul id="tabs" class='tabs'>
				<li><a tabid="1" class='current multisite'><?php echo __('CSS & JS compatibility', 'ajax-search-lite'); ?></a></li>
				<li><a tabid="2" class='general'><?php echo __('Query compatibility', 'ajax-search-lite'); ?></a></li>
			</ul>

            <div id="content" class='tabscontent'>

                <!-- Compatibility form -->
                <form name='compatibility' method='post'>
					<fieldset tabid="1">
						<legend><?php echo __('CSS and JS compatibility', 'ajax-search-lite'); ?></legend>
						<?php include(ASL_PATH . "backend/tabs/compatibility/cssjs_options.php"); ?>
					</fieldset>

					<fieldset tabid="2">
						<legend><?php echo __('Query compatibility options', 'ajax-search-lite'); ?></legend>
						<?php include(ASL_PATH . "backend/tabs/compatibility/query_options.php"); ?>
					</fieldset>

                    <div class="item">
                        <input type='submit' class='submit' value='Save options'/>
                    </div>
					<input type="hidden" name="asl_compatibility_nonce" id="asl_analytics_nonce" value="<?php echo wp_create_nonce( "asl_compatibility_nonce" ); ?>">
                    <input type='hidden' name='asl_compatibility' value='1'/>
                </form>

            </div>
        </div>
    </div>
    <?php include(ASL_PATH . "backend/sidebar.php"); ?>
    <div class="clear"></div>
</div>
<?php
wp_enqueue_script('wd_asl_helpers_jquery_conditionals', plugin_dir_url(__FILE__) . 'settings/assets/js/jquery.conditionals.js', array('jquery'), ASL_CURR_VER_STRING, true);
wp_enqueue_script('wpd-backend-compatibility', plugin_dir_url(__FILE__) . 'settings/assets/compatibility_settings.js', array(
	'jquery'
), ASL_CURR_VER_STRING, true);