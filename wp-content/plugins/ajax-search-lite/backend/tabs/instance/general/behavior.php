<fieldset>
	<legend>
		<?php echo __('Logic and matching', 'ajax-search-lite'); ?>
		<span class="asl_legend_docs">
            <a target="_blank" href="https://documentation.ajaxsearchlite.com/general-options/search-logic"><span class="fa fa-book"></span>
                <?php echo __('Documentation', 'ajax-search-lite'); ?>
            </a>
        </span>
	</legend>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsYesNo("exactonly", __("Show exact matches only?", "ajax-search-lite"),
			$sd['exactonly']);
		$params[$o->getName()] = $o->getData();
		?>
		<div wd-enable-on="exactonly:1">
			<?php
			$o = new wpdreamsCustomSelect('exact_match_location', "..and match fields against the search phrase",
				array(
					'selects' => array(
						array('option' => __('Anywhere', 'ajax-search-lite'), 'value' => 'anywhere'),
						array('option' => __('Starting with phrase', 'ajax-search-lite'), 'value' => 'start'),
						array('option' => __('Ending with phrase', 'ajax-search-lite'), 'value' => 'end'),
						array('option' => __('Complete match', 'ajax-search-lite'), 'value' => 'full')
					),
					'value' => $sd['exact_match_location']
				));
			$params[$o->getName()] = $o->getData();
			?>
		</div>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsCustomSelect("keyword_logic", __("Keyword (phrase) logic?", "ajax-search-lite"), array(
			'selects'=>array(
				array('option' => __('OR', 'aajax-search-lite'), 'value' => 'or'),
				array('option' => __('OR with exact word matches', 'ajax-search-lite'), 'value' => 'orex'),
				array('option' => __('AND', 'ajax-search-lite'), 'value' => 'and'),
				array('option' => __('AND with exact word matches', 'ajax-search-lite'), 'value' => 'andex')
			),
			'value'=>strtolower( $sd['keyword_logic'] )
		));
		$params[$o->getName()] = $o->getData();
		?>
		<div class="descMsg">
			<?php echo __('This determines if the result should match either of the entered phrases (OR logic) or all of the entered phrases (AND logic).', 'ajax-search-lite'); ?>
		</div>
		<div class="kwLogicInfo infoMsg" wd-show-on="keyword_logic:orex,andex">
			<?php echo __('Please note: For <strong>performance rasons</strong> exact word matching in the Lite version is only able to check space-separated words. Commas, dots, question marks etc.. are not considered as word separators.', 'ajax-search-lite'); ?>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>
		<?php echo __('Mobile specific', 'ajax-search-lite'); ?>
	</legend>
	<div class="item">
		<?php
		$o = new wpdreamsText("mob_auto_focus_menu_selector", __('Auto focus when opening the navigation menu (jQuery selector)', 'ajax-search-lite'),
			$sd['mob_auto_focus_menu_selector']);
		$params[$o->getName()] = $o->getData();
		?>
		<p class="descMsg">
			<?php echo __('When the search is placed within a mobile navigation menu, you can define a jQuery selector of the opening menu item here - which when clicking auto focuses the search', 'ajax-search-lite'); ?>
		</p>
	</div>
</fieldset>
<fieldset>
	<legend>
		<?php echo __('Trigger and redirection behavior', 'ajax-search-lite'); ?>
		<span class="asl_legend_docs">
            <a target="_blank" href="https://documentation.ajaxsearchlite.com/general-options/triggers-and-redirection-to-results-page"><span class="fa fa-book"></span>
                <?php echo __('Documentation', 'ajax-search-lite'); ?>
            </a>
        </span>
	</legend>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("trigger_on_facet_change", __("Trigger search on facet change?", "ajax-search-lite"),
			$sd['trigger_on_facet_change']);
		$params[$o->getName()] = $o->getData();
		?>
		<p class="descMsg"><?php echo __("Will trigger a search when the user clicks on a checkbox on the front-end.", "ajax-search-lite"); ?></p>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("triggerontype", __("Trigger search when typing?", "ajax-search-lite"),
			$sd['triggerontype']);
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("trigger_update_href", __('Update the browser address bar with the last selected options?', 'ajax-search-lite'),
			$sd['trigger_update_href']);
		$params[$o->getName()] = $o->getData();
		?>
		<p class="descMsg">
			<?php echo __('The current state of the search and the filters is reflected in the address bar and remembered for the browser back/forward buttons.', 'ajax-search-lite'); ?>
		</p>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsTextSmall("charcount", __("Minimal character count to trigger search", "ajax-search-lite"),
			$sd['charcount'], array(array("func" => "ctype_digit", "op" => "eq", "val" => true)));
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsTextSmall("maxresults", __("Max. results", "ajax-search-lite"), $sd['maxresults'], array(array("func" => "ctype_digit", "op" => "eq", "val" => true)));
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsCustomSelect("click_action", __("Action when clicking <strong>the magnifier</strong> icon", "ajax-search-lite"),
			array(
				'selects' => array(
					array("option" => __("Trigger live search", "ajax-search-lite"), "value" => "ajax_search"),
					array("option" => __("Redirec to: Results page", "ajax-search-lite"), "value" => "results_page"),
					array("option" => __("Redirec to: Woocommerce results page", "ajax-search-lite"), "value" => "woo_results_page"),
					array("option" => __("Redirec to: First matching result", "ajax-search-lite"), "value" => "first_result"),
					array("option" => __("Redirec to: Custom URL", "ajax-search-lite"), "value" => "custom_url"),
					array("option" => __("Do nothing", "ajax-search-lite"), "value" => "nothing")
				),
				'value' => $sd['click_action']
			));
		$params[$o->getName()] = $o->getData();

		?>
		<div wd-hide-on="click_action:ajax_search,nothing,same">
		<?php
		$o = new wpdreamsCustomSelect("click_action_location", " location: ",
			array(
				'selects' => array(
					array('option' => 'Use same tab', 'value' => 'same'),
					array('option' => 'Open new tab', 'value' => 'new')
				),
				'value' => $sd['click_action_location']
			));
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsCustomSelect("return_action", __("Action when pressing <strong>the return</strong> key", "ajax-search-lite"),
			array(
				'selects' => array(
					array("option" => __("Trigger live search", "ajax-search-lite"), "value" => "ajax_search"),
					array("option" => __("Redirec to: Results page", "ajax-search-lite"), "value" => "results_page"),
					array("option" => __("Redirec to: Woocommerce results page", "ajax-search-lite"), "value" => "woo_results_page"),
					array("option" => __("Redirec to: First matching result", "ajax-search-lite"), "value" => "first_result"),
					array("option" => __("Redirec to: Custom URL", "ajax-search-lite"), "value" => "custom_url"),
					array("option" => __("Do nothing", "ajax-search-lite"), "value" => "nothing")
				),
				'value' => $sd['return_action']
			));
		$params[$o->getName()] = $o->getData();
		?>
		<div wd-hide-on="return_action:ajax_search,nothing,same">
		<?php
		$o = new wpdreamsCustomSelect("return_action_location", " location: ",
			array(
				'selects' => array(
					array('option' => 'Use same tab', 'value' => 'same'),
					array('option' => 'Open new tab', 'value' => 'new')
				),
				'value' => $sd['return_action_location']
			));
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item" wd-conditional-logic="or" wd-show-on="return_action:custom_url;click_action:custom_url">
		<?php
		$o = new wpdreamsText("custom_redirect_url", __("Custom redirect URL", "ajax-search-lite"), $sd['custom_redirect_url']);
		$params[$o->getName()] = $o->getData();
		?>
		<p class="descMsg">You can use the <string>asl_redirect_url</string> filter to add more variables.</p>
	</div>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsYesNo("override_default_results", __("Override the default WordPress search results?", "ajax-search-lite"),
			$sd['override_default_results']);
		$params[$o->getName()] = $o->getData();
		?>
		<?php
		$o = new wpdreamsCustomSelect("override_method", " method ", array(
			"selects" =>array(
				array("option" => "Post", "value" => "post"),
				array("option" => "Get", "value" => "get")
			),
			"value" => $sd['override_method']
		));
		$params[$o->getName()] = $o->getData();
		?>
		<div class="descMsg" style="min-width: 100%;flex-wrap: wrap;flex-basis: auto;flex-grow: 1;box-sizing: border-box;"><?php echo __("Might not work with some Themes.", "ajax-search-lite"); ?></p>
		</div>
		<div class="item" wd-disable-on="override_default_results:0">
			<?php
			$o = new wpdreamsTextSmall("results_per_page", __('Results count per page?', 'ajax-search-lite'),
				$sd['results_per_page']);
			$params[$o->getName()] = $o->getData();
			?>
			<p class="descMsg"><?php echo __('The number of results per page, on the results page.', 'ajax-search-lite'); ?></p>
			<p class="errorMsg">
				<?php echo __('<strong>WARNING:</strong> This should be set to the same as the number of results originally displayed on the results page!<br>
        Most themes use the system option found on the <strong>General Options -> Reading</strong> submenu, which is 10 by default. <br>
        If you set it differently, or your theme has a different option for that, then <strong>set this option to the same value</strong> as well.', 'ajax-search-lite'); ?>
			</p>
		</div>
</fieldset>