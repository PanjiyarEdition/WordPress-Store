<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

$action_msg = '';
if (
    isset($_POST, $_POST['asl_analytics'], $_POST['reset'], $_POST['asl_analytics_nonce']) &&
    isset($_POST['asl_analytics_nonce'])
) {
    if ( wp_verify_nonce( $_POST['asl_analytics_nonce'], 'asl_analytics_nonce' ) ) {
        asl_reset_option('asl_analytics', false);
        $action_msg = "<div class='infoMsg'><strong>" . __('Analytics settings were reset to defaults!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
    } else {
        $action_msg = "<div class='errorMsg'><strong>".  __('<strong>ERROR Resetting:</strong> Invalid NONCE, please try again!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
    }
    $_POST = array();
}

if (isset($_POST, $_POST['asl_analytics'], $_POST['submit'], $_POST['asl_analytics_nonce']) && (wpdreamsType::getErrorNum()==0)) {
    if ( wp_verify_nonce( $_POST['asl_analytics_nonce'], 'asl_analytics_nonce' ) ) {
        $values = array(
            "analytics" => $_POST['analytics'],
            "analytics_tracking_id" => $_POST['analytics_tracking_id'],
            "analytics_string" => $_POST['analytics_string'],
            // Gtag on input focus
            'gtag_focus' => $_POST['gtag_focus'],
            'gtag_focus_action' => $_POST['gtag_focus_action'],
            'gtag_focus_ec' => $_POST['gtag_focus_ec'],
            'gtag_focus_el' => $_POST['gtag_focus_el'],
            'gtag_focus_value' => $_POST['gtag_focus_value'],
            // Gtag on search start
            'gtag_search_start' => $_POST['gtag_search_start'],
            'gtag_search_start_action' => $_POST['gtag_search_start_action'],
            'gtag_search_start_ec' => $_POST['gtag_search_start_ec'],
            'gtag_search_start_el' => $_POST['gtag_search_start_el'],
            'gtag_search_start_value' => $_POST['gtag_search_start_value'],
            // Gtag on search end
            'gtag_search_end' => $_POST['gtag_search_end'],
            'gtag_search_end_action' => $_POST['gtag_search_end_action'],
            'gtag_search_end_ec' => $_POST['gtag_search_end_ec'],
            'gtag_search_end_el' => $_POST['gtag_search_end_el'],
            'gtag_search_end_value' => $_POST['gtag_search_end_value'],
            // Gtag on magnifier
            'gtag_magnifier' => $_POST['gtag_magnifier'],
            'gtag_magnifier_action' => $_POST['gtag_magnifier_action'],
            'gtag_magnifier_ec' => $_POST['gtag_magnifier_ec'],
            'gtag_magnifier_el' => $_POST['gtag_magnifier_el'],
            'gtag_magnifier_value' => $_POST['gtag_magnifier_value'],
            // Gtag on return
            'gtag_return' => $_POST['gtag_return'],
            'gtag_return_action' => $_POST['gtag_return_action'],
            'gtag_return_ec' => $_POST['gtag_return_ec'],
            'gtag_return_el' => $_POST['gtag_return_el'],
            'gtag_return_value' => $_POST['gtag_return_value'],
            // Gtag on facet change
            'gtag_facet_change' => $_POST['gtag_facet_change'],
            'gtag_facet_change_action' => $_POST['gtag_facet_change_action'],
            'gtag_facet_change_ec' => $_POST['gtag_facet_change_ec'],
            'gtag_facet_change_el' => $_POST['gtag_facet_change_el'],
            'gtag_facet_change_value' => $_POST['gtag_facet_change_value'],
            // Gtag on result click
            'gtag_result_click' => $_POST['gtag_result_click'],
            'gtag_result_click_action' => $_POST['gtag_result_click_action'],
            'gtag_result_click_ec' => $_POST['gtag_result_click_ec'],
            'gtag_result_click_el' => $_POST['gtag_result_click_el'],
            'gtag_result_click_value' => $_POST['gtag_result_click_value']
        );
        update_option('asl_analytics', $values);
        asl_parse_options();
        $action_msg = "<div class='infoMsg'><strong>" . __('Analytics settings saved!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
    } else {
        $action_msg = "<div class='errorMsg'><strong>".  __('<strong>ERROR Saving:</strong> Invalid NONCE, please try again!', 'ajax-search-lite') . '</strong> (' . date("Y-m-d H:i:s") . ")</div>";
        $_POST = array();
    }
}

$ana_options = wd_asl()->o['asl_analytics'];
?>

<div id="wpdreams" class='wpdreams wrap<?php echo isset($_COOKIE['asl-accessibility']) ? ' wd-accessible' : ''; ?> asl-be-analytics'>
    <div class="wpdreams-box" style="float:left;">
        <?php ob_start(); ?>
        <div class="item">
          <?php $o = new wpdreamsCustomSelect("analytics", "Google analytics integration method",
                array(
                    'selects' => array(
                        array("option" => esc_attr__('Disabled', 'ajax-search-lite'), "value" => "0"),
                        array("option" => esc_attr__('Event Tracking', 'ajax-search-lite'), "value" => "event"),
                        array("option" => esc_attr__('Tracking as pageview (legacy)', 'ajax-search-lite'), "value" => "pageview")
                    ),
                    'value' => $ana_options["analytics"]
                )
            ); ?>
            <p class="descMsg">
                <?php echo sprintf( __('To understand how this works, please read the <a href="%s">Analytics Integration Documentation</a>', 'ajax-search-lite'),
                    'https://documentation.ajaxsearchpro.com/analytics-integration'
                ); ?>
            </p>
        </div>
        <div class="asl_al_both hiddend">
            <div class="item">
                <?php $o = new wpdreamsText("analytics_tracking_id", __('Google analytics Tracking ID (ex.: UA-XXXXXX-X)', 'ajax-search-lite'), $ana_options["analytics_tracking_id"]); ?>
                <p class='infoMsg'>
                    <?php echo __(sprintf(
                            'Please read this <a href="%s">google analytics documentation</a> to get your <a href="%s">tracking ID</a>.',
                    'https://support.google.com/analytics/answer/7372977',
                        'https://i.imgur.com/KiyBIPy.png'
                    ), 'ajax-search-lite'); ?>
                </p>
            </div>
        </div>
        <div class="asl_al_pageview hiddend">
            <div class="item">
                <?php $o = new wpdreamsText("analytics_string", __('Google analytics pageview string', 'ajax-search-lite'), $ana_options["analytics_string"]); ?>
                <p class='infoMsg'>
                    <?php echo __('This is how the pageview will look like on the google analytics website. Use the {asl_term} variable to add the search term to the pageview.', 'ajax-search-lite'); ?>
                </p>
            </div>
            <p class='infoMsg'>
                <?php echo __('After some time you should be able to see the hits on your analytics board.', 'ajax-search-lite'); ?>
            </p>
            <img src="http://i.imgur.com/s7BXiPV.png">
        </div>
        <div class="asl_al_event hiddend">
            <fieldset>
                <legend><?php echo __('Search input focus event tracking', 'ajax-search-lite'); ?></legend>
                <div class="item asl_gtag_switch">
                    <?php
                    $o = new wpdreamsYesNo("gtag_focus", __('Enabled', 'ajax-search-lite'), $ana_options["gtag_focus"]);
                    ?>
                    <p class='descMsg'>
                        <?php echo __('Triggers, whenever the user clicks on the search input field.', 'ajax-search-lite'); ?>
                    </p>
                </div>
                <div class="item item-flex item-flex-nogrow item-flex-wrap item-flex-two-column asl_gtag_inputs">
                    <div class='descMsg item-flex-grow item-flex-100'>
                        <?php echo sprintf(
                                __('Usable variables: %s', 'ajax-search-lite'),
                            '{phrase}'
                        ); ?>
                    </div>
                    <?php
                    $o = new wpdreamsText("gtag_focus_action", __('Event action', 'ajax-search-lite'), $ana_options["gtag_focus_action"]);
                    $o = new wpdreamsText("gtag_focus_ec", __('Event category', 'ajax-search-lite'), $ana_options["gtag_focus_ec"]);
                    $o = new wpdreamsText("gtag_focus_el", __('Event label', 'ajax-search-lite'), $ana_options["gtag_focus_el"]);
                    $o = new wpdreamsText("gtag_focus_value", __('Event value', 'ajax-search-lite'), $ana_options["gtag_focus_value"]);
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo __('Live search start event tracking', 'ajax-search-lite'); ?></legend>
                <div class="item asl_gtag_switch">
                    <?php
                    $o = new wpdreamsYesNo("gtag_search_start", __('Enabled', 'ajax-search-lite'), $ana_options["gtag_search_start"]);
                    ?>
                    <p class='descMsg'>
                        <?php echo __('Triggers, whenever the live search starts.', 'ajax-search-lite'); ?>
                    </p>
                </div>
                <div class="item item-flex item-flex-nogrow item-flex-wrap item-flex-two-column asl_gtag_inputs">
                    <div class='descMsg item-flex-grow item-flex-100'>
                        <?php echo sprintf(
                                __('Usable variables: %s', 'ajax-search-lite'),
                            '{phrase}'
                        ); ?>
                    </div>
                    <?php
                    $o = new wpdreamsText("gtag_search_start_action", __('Event action', 'ajax-search-lite'), $ana_options["gtag_search_start_action"]);
                    $o = new wpdreamsText("gtag_search_start_ec", __('Event category', 'ajax-search-lite'), $ana_options["gtag_search_start_ec"]);
                    $o = new wpdreamsText("gtag_search_start_el", __('Event label', 'ajax-search-lite'), $ana_options["gtag_search_start_el"]);
                    $o = new wpdreamsText("gtag_search_start_value", __('Event value', 'ajax-search-lite'), $ana_options["gtag_search_start_value"]);
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo __('Live search end event tracking', 'ajax-search-lite'); ?></legend>
                <div class="item asl_gtag_switch">
                    <?php
                    $o = new wpdreamsYesNo("gtag_search_end", __('Enabled', 'ajax-search-lite'), $ana_options["gtag_search_end"]);
                    ?>
                    <p class='descMsg'>
                        <?php echo __('Triggers, whenever the live search ends.', 'ajax-search-lite'); ?>
                    </p>
                </div>
                <div class="item item-flex item-flex-nogrow item-flex-wrap item-flex-two-column asl_gtag_inputs">
                    <div class='descMsg item-flex-grow item-flex-100'>
                        <?php echo sprintf(
                                __('Usable variables: %s', 'ajax-search-lite'),
                            '{phrase}'
                        ); ?>
                    </div>
                    <?php
                    $o = new wpdreamsText("gtag_search_end_action", __('Event action', 'ajax-search-lite'), $ana_options["gtag_search_end_action"]);
                    $o = new wpdreamsText("gtag_search_end_ec", __('Event category', 'ajax-search-lite'), $ana_options["gtag_search_end_ec"]);
                    $o = new wpdreamsText("gtag_search_end_el", __('Event label', 'ajax-search-lite'), $ana_options["gtag_search_end_el"]);
                    $o = new wpdreamsText("gtag_search_end_value", __('Event value', 'ajax-search-lite'), $ana_options["gtag_search_end_value"]);
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo __('Magnifier click event tracking', 'ajax-search-lite'); ?></legend>
                <div class="item asl_gtag_switch">
                    <?php
                    $o = new wpdreamsYesNo("gtag_magnifier", __('Enabled', 'ajax-search-lite'), $ana_options["gtag_magnifier"]);
                    ?>
                    <p class='descMsg'>
                        <?php echo __('Triggers, whenever the user clicks the magnifier icon', 'ajax-search-lite'); ?>
                    </p>
                </div>
                <div class="item item-flex item-flex-nogrow item-flex-wrap item-flex-two-column asl_gtag_inputs">
                    <div class='descMsg item-flex-grow item-flex-100'>
                        <?php echo sprintf(
                                __('Usable variables: %s', 'ajax-search-lite'),
                            '{phrase}'
                        ); ?>
                    </div>
                    <?php
                    $o = new wpdreamsText("gtag_magnifier_action", __('Event action', 'ajax-search-lite'), $ana_options["gtag_magnifier_action"]);
                    $o = new wpdreamsText("gtag_magnifier_ec", __('Event category', 'ajax-search-lite'), $ana_options["gtag_magnifier_ec"]);
                    $o = new wpdreamsText("gtag_magnifier_el", __('Event label', 'ajax-search-lite'), $ana_options["gtag_magnifier_el"]);
                    $o = new wpdreamsText("gtag_magnifier_value", __('Event value', 'ajax-search-lite'), $ana_options["gtag_magnifier_value"]);
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo __('Return key event tracking', 'ajax-search-lite'); ?></legend>
                <div class="item asl_gtag_switch">
                    <?php
                    $o = new wpdreamsYesNo("gtag_return", __('Enabled', 'ajax-search-lite'), $ana_options["gtag_return"]);
                    ?>
                    <p class='descMsg'>
                        <?php echo __('Triggers, whenever the user hits the enter button in the search input field', 'ajax-search-lite'); ?>
                    </p>
                </div>
                <div class="item item-flex item-flex-nogrow item-flex-wrap item-flex-two-column asl_gtag_inputs">
                    <div class='descMsg item-flex-grow item-flex-100'>
                        <?php echo sprintf(
                                __('Usable variables: %s', 'ajax-search-lite'),
                            '{phrase}'
                        ); ?>
                    </div>
                    <?php
                    $o = new wpdreamsText("gtag_return_action", __('Event action', 'ajax-search-lite'), $ana_options["gtag_return_action"]);
                    $o = new wpdreamsText("gtag_return_ec", __('Event category', 'ajax-search-lite'), $ana_options["gtag_return_ec"]);
                    $o = new wpdreamsText("gtag_return_el", __('Event label', 'ajax-search-lite'), $ana_options["gtag_return_el"]);
                    $o = new wpdreamsText("gtag_return_value", __('Event value', 'ajax-search-lite'), $ana_options["gtag_return_value"]);
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo __('Facet change event tracking', 'ajax-search-lite'); ?></legend>
                <div class="item asl_gtag_switch">
                    <?php
                    $o = new wpdreamsYesNo("gtag_facet_change", __('Enabled', 'ajax-search-lite'), $ana_options["gtag_facet_change"]);
                    ?>
                    <p class='descMsg'>
                        <?php echo __('Triggers, whenever the user changes any option on the front-end settings', 'ajax-search-lite'); ?>
                    </p>
                </div>
                <div class="item item-flex item-flex-nogrow item-flex-wrap item-flex-two-column asl_gtag_inputs">
                    <div class='descMsg item-flex-grow item-flex-100'>
                        <?php echo sprintf(
                                __('Usable variables: %s', 'ajax-search-lite'),
                            '{option_label}, {option_value}, {phrase}'
                        ); ?>
                    </div>
                    <?php
                    $o = new wpdreamsText("gtag_facet_change_action", __('Event action', 'ajax-search-lite'), $ana_options["gtag_facet_change_action"]);
                    $o = new wpdreamsText("gtag_facet_change_ec", __('Event category', 'ajax-search-lite'), $ana_options["gtag_facet_change_ec"]);
                    $o = new wpdreamsText("gtag_facet_change_el", __('Event label', 'ajax-search-lite'), $ana_options["gtag_facet_change_el"]);
                    $o = new wpdreamsText("gtag_facet_change_value", __('Event value', 'ajax-search-lite'), $ana_options["gtag_facet_change_value"]);
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo __('Results click event tracking', 'ajax-search-lite'); ?></legend>
                <div class="item asl_gtag_switch">
                    <?php
                    $o = new wpdreamsYesNo("gtag_result_click", __('Enabled', 'ajax-search-lite'), $ana_options["gtag_result_click"]);
                    ?>
                    <p class='descMsg'>
                        <?php echo __('Triggers, whenever the user changes any option on the front-end settings', 'ajax-search-lite'); ?>
                    </p>
                </div>
                <div class="item item-flex item-flex-nogrow item-flex-wrap item-flex-two-column asl_gtag_inputs">
                    <div class='descMsg item-flex-grow item-flex-100'>
                        <?php echo sprintf(
                                __('Usable variables: %s', 'ajax-search-lite'),
                            '{result_title}, {result_url}, {phrase}'
                        ); ?>
                    </div>
                    <?php
                    $o = new wpdreamsText("gtag_result_click_action", __('Event action', 'ajax-search-lite'), $ana_options["gtag_result_click_action"]);
                    $o = new wpdreamsText("gtag_result_click_ec", __('Event category', 'ajax-search-lite'), $ana_options["gtag_result_click_ec"]);
                    $o = new wpdreamsText("gtag_result_click_el", __('Event label', 'ajax-search-lite'), $ana_options["gtag_result_click_el"]);
                    $o = new wpdreamsText("gtag_result_click_value", __('Event value', 'ajax-search-lite'), $ana_options["gtag_result_click_value"]);
                    ?>
                </div>
            </fieldset>
        </div>
        <div class="item">
            <input name="reset"
                   class="asl_submit asl_submit_transparent asl_submit_reset"
                   type="submit" value="<?php echo esc_attr__('Restore defaults', 'ajax-search-lite'); ?>">
            <input type='submit' name="submit" class='submit' value='<?php echo esc_attr__('Save options', 'ajax-search-lite'); ?>'/>
        </div>
        <?php $_r = ob_get_clean(); ?>

        <div class='wpdreams-slider'>
            <form name='asl_analytics1' method='post'>
                <?php echo $action_msg; ?>
                <fieldset>
                    <legend><?php echo __('Analytics options', 'ajax-search-lite'); ?></legend>
                    <?php print $_r; ?>
                    <input type='hidden' name='asl_analytics' value='1' />
                    <input type="hidden" name="asl_analytics_nonce" id="asl_analytics_nonce" value="<?php echo wp_create_nonce( "asl_analytics_nonce" ); ?>">
                </fieldset>
            </form>
        </div>
    </div>
    <?php include(ASL_PATH . "backend/sidebar.php"); ?>
    <div class="clear"></div>
</div>
<?php
wp_enqueue_script('asl-backend-analytics', plugin_dir_url(__FILE__) . 'settings/assets/analytics.js', array(
    'jquery', 'wpdreams-tabs'
), ASL_CURR_VER_STRING, true);