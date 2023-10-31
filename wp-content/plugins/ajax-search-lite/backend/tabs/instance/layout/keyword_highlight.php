<fieldset>
	<legend>
		<?php echo __('Results text keyword highlighter - Live results list', 'ajax-search-lite'); ?>
		<span class="asl_legend_docs">
            <a target="_blank" href="https://documentation.ajaxsearchlite.com/layout-options/keyword-highlighter"><span class="fa fa-book"></span>
                <?php echo __('Documentation', 'ajax-search-lite'); ?>
            </a>
        </span>
	</legend>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("kw_highlight", __("Keyword highlighting", "ajax-search-lite"), $sd['kw_highlight']);
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div wd-disable-on="kw_highlight:0">
		<div class="item">
			<?php
			$o = new wpdreamsYesNo("kw_highlight_whole_words", __("Highlight whole words only?", "ajax-search-lite"), $sd['kw_highlight_whole_words']);
			$params[$o->getName()] = $o->getData();
			?>
		</div>
		<div class="item"><?php
			$o = new wpdreamsColorPicker("highlight_color", "Highlight text color", $sd['highlight_color']);
			$params[$o->getName()] = $o->getData();
			?></div>
		<div class="item"><?php
			$o = new wpdreamsColorPicker("highlight_bg_color", "Highlight-text background color", $sd['highlight_bg_color']);
			$params[$o->getName()] = $o->getData();
			?>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend>
		<?php echo __('Results text keyword highlighter - Single result page', 'ajax-search-lite'); ?>
		<span class="asl_legend_docs">
            <a target="_blank" href="https://documentation.ajaxsearchlite.com/layout-options/keyword-highlighter"><span class="fa fa-book"></span>
                <?php echo __('Documentation', 'ajax-search-lite'); ?>
            </a>
        </span>
	</legend>
	<div class="errorMsg">
		<?php echo __('<strong>Disclaimer: </strong> This feature is highly experimental, and may not work correctly in all cases.', 'ajax-search-lite'); ?>
	</div>
	<div class="item"><?php
		$o = new wpdreamsYesNo("single_highlight", __('Highlight search text on single result pages?', 'ajax-search-lite'), $sd['single_highlight']);
		$params[$o->getName()] = $o->getData();
		?></div>
	<div wd-disable-on="single_highlight:0">
		<div class="item"><?php
			$o = new wpdreamsYesNo("single_highlightwholewords", __('Highlight only whole words?', 'ajax-search-lite'), $sd['single_highlightwholewords']);
			$params[$o->getName()] = $o->getData();
			?></div>
		<div class="item"><?php
			$o = new wpdreamsColorPicker("single_highlightcolor", __('Highlight text color', 'ajax-search-lite'), $sd['single_highlightcolor']);
			$params[$o->getName()] = $o->getData();
			?></div>
		<div class="item"><?php
			$o = new wpdreamsColorPicker("single_highlightbgcolor", __('Highlight-text background color', 'ajax-search-lite'), $sd['single_highlightbgcolor']);
			$params[$o->getName()] = $o->getData();
			?>
		</div>
		<div class="item item-flex-nogrow item-flex-wrap">
			<?php
			$o = new wpdreamsYesNo("single_highlight_scroll", __('Scroll to the first keyword match if possible?', 'ajax-search-lite'), $sd['single_highlight_scroll']);

			$o = new wpdreamsTextSmall("single_highlight_offset", __('scroll offset (px)', 'ajax-search-lite'), $sd['single_highlight_offset']);
			?>
			<div class="descMsg item-flex-grow item-flex-100">
				<?php echo __('A negative offset will move the window upwards, a positive downwards. Default: 0', 'ajax-search-lite'); ?>
			</div>
		</div>
		<div class="item"><?php
			$o = new wpdreamsText("single_highlight_selector", __('Result page content jQuery element selector', 'ajax-search-lite'), $sd['single_highlight_selector']);
			$params[$o->getName()] = $o->getData();
			?>
			<div class="descMsg item-flex-grow item-flex-100">
				<?php echo __('Optional, but very useful - it tells which element contains exactly the result content, so words are highlighted only on the given section of the page.', 'ajax-search-lite'); ?>
			</div>
		</div>
	</div>
</fieldset>