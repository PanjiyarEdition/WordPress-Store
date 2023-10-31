<?php
/* Prevent direct access */
defined( 'ABSPATH' ) or die( "You can't access this file directly." );

$cache_options = wd_asl()->o['asl_performance'];
$action_msg = '';

if ( isset($_POST, $_POST['asl_performance'],  $_POST['submit'], $_POST['asl_performance_nonce']) ) {
	if ( wp_verify_nonce( $_POST['asl_performance_nonce'], 'asl_performance_nonce' ) ) {
		$values = array(
			"use_custom_ajax_handler" => $_POST['use_custom_ajax_handler'],
			"image_cropping"          => $_POST['image_cropping'],
			"load_in_footer"          => $_POST['load_in_footer']
		);
		update_option( 'asl_performance', $values );
		asl_parse_options();
		$action_msg = "<div class='infoMsg'><strong>" . __('Performance settings successfuly saved!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
	} else {
		$action_msg = "<div class='errorMsg'><strong>".  __('<strong>ERROR Saving:</strong> Invalid NONCE, please try again!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
		$_POST = array();
	}
}

?>
<div id="wpdreams" class='wpdreams wrap<?php echo isset($_COOKIE['asl-accessibility']) ? ' wd-accessible' : ''; ?>'>
    <?php if (wd_asl()->o['asl_performance']['use_custom_ajax_handler'] == 1): ?>
        <p class='noticeMsgBox'>AJAX SEARCH LITE NOTICE: The custom ajax handler is enabled. In case you experience issues, please
            <a href='<?php echo get_admin_url() . "admin.php?page=ajax-search-lite/backend/performance_options.php"; ?>'>turn it off.</a></p>
    <?php endif; ?>

    <div class="wpdreams-box" style="float:left;">
        <?php ob_start(); ?>
        <div class="item">
            <p class='infoMsg'>Turn it OFF if the search stops working correctly after enabling.</p>
            <?php $o = new wpdreamsYesNo( "use_custom_ajax_handler", "Use custom ajax handler", $cache_options['use_custom_ajax_handler'] ); ?>
            <p class="descMsg">The queries will be posted to a custom ajax handler file, which does not wait for whole WordPress loading process. Usually it has great performance impact.</p>
        </div>
        <div class="item">
            <?php $o = new wpdreamsYesNo( "image_cropping", "Crop images for caching?", $cache_options['image_cropping']); ?>
            <p class="descMsg">When turned OFF, it disables thumbnail generator, and the full sized images are used as cover. Not much difference visually, but saves a lot of CPU.</p>
        </div>
        <div class="item">
            <?php $o = new wpdreamsYesNo( "load_in_footer", "Load JavaScript in site footer?", $cache_options['load_in_footer']); ?>
            <p class="descMsg">Will load the JavaScript files in the site footer for better performance.</p>
        </div>

        <?php $_r = ob_get_clean(); ?>

        <div class='wpdreams-slider'>
            <form name='asl_performance_form' method='post'>
				<?php echo $action_msg; ?>
                <fieldset>
                    <legend><?php echo __('Performance Options', 'ajax-search-lite'); ?></legend>
                    <?php print $_r; ?>
                    <input type='hidden' name='asl_performance' value='1'/>
					<input type="hidden" name="asl_performance_nonce" id="asl_performance_nonce" value="<?php echo wp_create_nonce( "asl_performance_nonce" ); ?>">
					<div class="item">
						<input type='submit' class='submit' name="submit" value='Save options'/>
					</div>
				</fieldset>
            </form>
        </div>

    </div>
    <?php include(ASL_PATH . "backend/sidebar.php"); ?>
    <div class="clear"></div>
</div>