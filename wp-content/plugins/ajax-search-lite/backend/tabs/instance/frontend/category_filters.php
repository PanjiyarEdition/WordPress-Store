<fieldset>
	<legend><?php echo __('Category Filters', 'ajax-search-lite'); ?></legend>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("show_frontend_search_settings", __("Show search settings on the frontend?", "ajax-search-lite"), $sd['show_frontend_search_settings']);
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item" style="text-align:center;">
		<?php _e("The default values of the checkboxes on the frontend are the values set above.", "ajax-search-lite"); ?>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("showexactmatches", __("Show exact matches selector?", "ajax-search-lite"), $sd['showexactmatches']);
		$params[$o->getName()] = $o->getData();
		$o = new wpdreamsText("exactmatchestext", "Text", $sd['exactmatchestext']);
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("showsearchintitle", __("Show search in title selector?", "ajax-search-lite"), $sd['showsearchintitle']);
		$params[$o->getName()] = $o->getData();
		$o = new wpdreamsText("searchintitletext", "Text", $sd['searchintitletext']);
		$params[$o->getName()] = $o->getData();
		?></div>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("showsearchincontent", __("Show search in content selector?", "ajax-search-lite"), $sd['showsearchincontent']);
		$params[$o->getName()] = $o->getData();
		$o = new wpdreamsText("searchincontenttext", "Text", $sd['searchincontenttext']);
		$params[$o->getName()] = $o->getData();
		?></div>
	<div class="item"><?php
		$o = new wpdreamsCustomPostTypesEditable("showcustomtypes", __("Show search in custom post types selectors", "ajax-search-lite"), $sd['showcustomtypes']);
		$params[$o->getName()] = $o->getData();
		$params['selected-'.$o->getName()] = $o->getSelected();
		?></div>
	<div class="item">
		<p class='infoMsg'><?php _e("Nor recommended if you have more than 500 categories! (the HTML output will get too big)", "ajax-search-lite"); ?></p>
		<?php
		$o = new wpdreamsYesNo("showsearchincategories", __("Show the categories selectors?", "ajax-search-lite"), $sd['showsearchincategories']);
		$params[$o->getName()] = $o->getData();
		?></div>
	<div class="item">
		<?php
		$o = new wpdreamsYesNo("showuncategorised", __("Show the uncategorised category?", "ajax-search-lite"), $sd['showuncategorised']);
		$params[$o->getName()] = $o->getData();
		?></div>
	<div class="item"><?php
		$o = new wpdreamsCategories("exsearchincategories", __("Select which categories exclude", "ajax-search-lite"), $sd['exsearchincategories']);
		$params[$o->getName()] = $o->getData();
		$params['selected-'.$o->getName()] = $o->getSelected();
		?>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsText("exsearchincategoriestext", __("Categories filter box header text", "ajax-search-lite"), $sd['exsearchincategoriestext']);
		$params[$o->getName()] = $o->getData();
		?>
	</div>
</fieldset>