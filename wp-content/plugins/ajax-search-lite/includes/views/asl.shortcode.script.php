<?php
$ana_options = get_option('asl_analytics');
$scope = "asljQuery";
?>
<?php ob_start(); ?>
{
<?php if ( is_admin() ): ?>
	"homeurl": "<?php echo home_url("/"); ?>",
<?php else: ?>
	"homeurl": "<?php echo function_exists("pll_home_url") ? PLL()->links->get_home_url( '', true ) : home_url("/"); ?>",
<?php endif; ?>
	"resultstype": "vertical",
	"resultsposition": "hover",
	"itemscount": <?php echo ((isset($style['itemscount']) && $style['itemscount']!="")?$style['itemscount']:"10"); ?>,
	"charcount":  <?php echo ((isset($style['charcount']) && $style['charcount']!="")?$style['charcount']:"0"); ?>,
	"highlight": <?php echo $style['kw_highlight']; ?>,
	"highlightwholewords": <?php echo $style['kw_highlight_whole_words']; ?>,
	"singleHighlight": <?php echo $style['single_highlight']; ?>,
	"scrollToResults": {
		"enabled": <?php echo $style['scroll_to_results']; ?>,
		"offset": 0
	},
	"resultareaclickable": <?php echo ((isset($style['resultareaclickable']) && $style['resultareaclickable']!="")?$style['resultareaclickable']:0); ?>,
	"autocomplete": {
		"enabled" : <?php echo w_isset_def($style['autocomplete'], 1); ?>,
		"lang" : "<?php echo w_isset_def($style['kw_google_lang'], 'en'); ?>",
		"trigger_charcount" : 0
	},
	"mobile": {
		"menu_selector": "<?php echo $style['mob_auto_focus_menu_selector']; ?>"
	},
	"trigger": {
		"click": "<?php echo $style['click_action']; ?>",
		"click_location": "<?php echo $style['click_action_location']; ?>",
		"update_href": <?php echo $style['trigger_update_href']; ?>,
		"return": "<?php echo $style['return_action']; ?>",
		"return_location": "<?php echo $style['return_action_location']; ?>",
		"facet": <?php echo $style['trigger_on_facet_change']; ?>,
		"type": <?php echo $style['triggerontype'] == 1 ? 1 : 0; ?>,
		"redirect_url": "<?php echo apply_filters( "asl_redirect_url", $style['custom_redirect_url'], $real_id ); ?>",
		"delay": 300
	},
    "animations": {
        "pc": {
            "settings": {
                "anim" : "fadedrop",
                "dur"  : 300
            },
            "results" : {
				"anim" : "fadedrop",
				"dur"  : 300
            },
            "items" : "voidanim"
        },
        "mob": {
            "settings": {
                "anim" : "fadedrop",
                "dur"  : 300
            },
            "results" : {
				"anim" : "fadedrop",
				"dur"  : 300
            },
            "items" : "voidanim"
        }
    },
	"autop": {
		"state": "<?php echo $style['auto_populate']; ?>",
		"phrase": "<?php echo $style['auto_populate_phrase']; ?>",
		"count": <?php echo $style['auto_populate_count']; ?>
	},
    "resPage": {
        "useAjax": <?php echo is_search() && $style['res_live_search'] ? 1 : 0; ?>,
        "selector": "<?php echo $style['res_live_selector']; ?>",
        "trigger_type": <?php echo $style['res_live_trigger_type'] ?>,
        "trigger_facet": <?php echo $style['res_live_trigger_facet'] ?>,
        "trigger_magnifier": <?php echo $style['res_live_trigger_click'] ?>,
        "trigger_return": <?php echo $style['res_live_trigger_return'] ?>
    },
	"resultsSnapTo": "<?php echo $style['results_snap_to']; ?>",
    "results": {
        "width": "<?php echo $style['results_width']; ?>",
        "width_tablet": "<?php echo $style['results_width_tablet']; ?>",
        "width_phone": "<?php echo $style['results_width_phone']; ?>"
    },
	"settingsimagepos": "<?php echo w_isset_def($style['theme'], 'classic-blue')=='classic-blue'?'left':'right'; ?>",
	"closeOnDocClick": <?php echo w_isset_def($style['close_on_document_click'], 1); ?>,
	"overridewpdefault": <?php echo $style['override_default_results']; ?>,
	"override_method": "<?php echo $style['override_method']; ?>"
}
<?php
$_asl_script_out = ob_get_clean();
wd_asl()->instances->add_script_data($real_id, json_encode(json_decode($_asl_script_out)));
?>
<div class="asl_init_data wpdreams_asl_data_ct"
	 style="display:none !important;"
	 id="asl_init_id_<?php echo $id; ?>"
	 data-asl-id="<?php echo $id;; ?>"
	 data-asl-instance="1"
	 data-asldata="<?php echo base64_encode($_asl_script_out); ?>"></div>