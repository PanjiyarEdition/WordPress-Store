<?php
$themes = array(
    array('option'=>'Simple Red', 'value'=>'simple-red'),
    array('option'=>'Simple Blue', 'value'=>'simple-blue'),
    array('option'=>'Simple Grey', 'value'=>'simple-grey'),
    array('option'=>'Classic Blue', 'value'=>'classic-blue'),
    array('option'=>'Curvy Black', 'value'=>'curvy-black'),
    array('option'=>'Curvy Red', 'value'=>'curvy-red'),
    array('option'=>'Curvy Blue', 'value'=>'curvy-blue'),
    array('option'=>'Underline White', 'value'=>'underline')
);
?>
<fieldset>
	<legend>
		<?php _e("Theme & Input & Colors", "ajax-search-lite"); ?>
		<span class="asl_legend_docs">
			<a target="_blank" href="https://documentation.ajaxsearchlite.com/layout-options/theme-and-customization"><span class="fa fa-book"></span>
				<?php echo __('Documentation', 'ajax-search-lite'); ?>
			</a>
		</span>
	</legend>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<div class="asl_theme"></div>
		<?php
		$o = new wpdreamsCustomSelect("theme", __("Theme", "ajax-search-lite"), array(
			'selects'=>$themes,
			'value'=>$sd['theme']
		));
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsText("defaultsearchtext", __("Placeholder text", "ajax-search-lite"), $sd['defaultsearchtext']);
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item item-flex-nogrow item-flex-wrap wpd-isotopic-width">
		<?php
		$o = new wpdreamsTextSmall("box_width", __('Search box width', 'ajax-search-lite'), array(
			'icon' => 'desktop',
			'value' => $sd['box_width']
		));
		$params[$o->getName()] = $o->getData();
		$o = new wpdreamsTextSmall("box_width_tablet", '', array(
			'icon' => 'tablet',
			'value' => $sd['box_width_tablet']
		));
		$params[$o->getName()] = $o->getData();
		$o = new wpdreamsTextSmall("box_width_phone", '', array(
			'icon' => 'phone',
			'value' => $sd['box_width_phone']
		));
		$params[$o->getName()] = $o->getData();
		?>
		<div class="descMsg item-flex-grow item-flex-100">
			<?php echo sprintf(
				__('Use with <a href="%s" target="_blank">CSS units</a> (like %s or %s or %s ..) Default: <strong>%s</strong>', 'ajax-search-lite'),
				'https://www.w3schools.com/cssref/css_units.asp', '10px', '50%', 'auto', '100%'
			); ?>
		</div>
	</div>
	<div class="item">
		<?php
		$option_name = "box_margin";
		$option_desc = __("Search box margin", "ajax-search-lite");
		$option_expl = __("Include the unit as well, example: 10px or 1em or 90%", "ajax-search-lite");
		$o = new wpdreamsFour($option_name, $option_desc,
			array(
				"desc" => $option_expl,
				"value" => $sd[$option_name]
			)
		);
		$params[$o->getName()] = $o->getData();
		?>
	</div>
	<div class="item">
		<?php
		$o = new wpdreamsText("box_font", __("Search plugin Font Family", "ajax-search-lite"), $sd['box_font']);
		$params[$o->getName()] = $o->getData();
		?>
		<p class="descMsg"><?php echo __("The Font Family used within the plugin. Default: Open Sans", "ajax-search-lite"); ?><br>
		<?php echo __("Entering multiple font family names like <strong>Helvetica, Sans-serif</strong> or <strong>inherit</strong> are also supported.", "ajax-search-lite"); ?></p>
	</div>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsYesNo("override_bg", __("Override background color?", "ajax-search-lite"),
			$sd['override_bg']);
		$params[$o->getName()] = $o->getData();
		?>
		<div wd-enable-on="override_bg:1">
		<?php
		$o = new wpdreamsColorPicker("override_bg_color", __("color:", "ajax-search-lite"),
			$sd['override_bg_color']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsYesNo("override_icon", __("Override magnifier & icon colors?", "ajax-search-lite"),
			$sd['override_icon']);
		$params[$o->getName()] = $o->getData();
		?>
		<div class="item-flex-nogrow" wd-enable-on="override_icon:1">
		<?php
		$o = new wpdreamsColorPicker("override_icon_bg_color", __("icon background colors", "ajax-search-lite"),
			$sd['override_icon_bg_color']);
		$params[$o->getName()] = $o->getData();

		$o = new wpdreamsColorPicker("override_icon_color", __("icon colors", "ajax-search-lite"),
			$sd['override_icon_color']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item">
		<div style="margin: 8px 17px 16px 0;">
		<?php
		$o = new wpdreamsYesNo("override_border", __("Override search box border?", "ajax-search-lite"),
			$sd['override_border']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
		<div wd-enable-on="override_border:1">
		<?php
		$o = new wpdreamsBorder("override_border_style", __("Border style", "ajax-search-lite"),
			$sd['override_border_style']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend><?php _e("Results theme", "ajax-search-lite"); ?></legend>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsYesNo("results_bg_override", __("Override results container background color?", "ajax-search-lite"),
			$sd['results_bg_override']);
		$params[$o->getName()] = $o->getData();
		?>
		<div wd-enable-on="results_bg_override:1">
		<?php
		$o = new wpdreamsColorPicker("results_bg_override_color", __("color:", "ajax-search-lite"),
			$sd['results_bg_override_color']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsYesNo("results_item_bg_override", __("Override results background color?", "ajax-search-lite"),
			$sd['results_item_bg_override']);
		$params[$o->getName()] = $o->getData();
		?>
		<div wd-enable-on="results_item_bg_override:1">
		<?php
		$o = new wpdreamsColorPicker("results_item_bg_override_color", __("color:", "ajax-search-lite"),
			$sd['results_item_bg_override_color']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item">
		<div style="margin: 8px 17px 16px 0;">
		<?php
		$o = new wpdreamsYesNo("results_override_border", __("Override results box border?", "ajax-search-lite"),
			$sd['results_override_border']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
		<div wd-enable-on="results_override_border:1">
		<?php
		$o = new wpdreamsBorder("results_override_border_style", __("Border style", "ajax-search-lite"),
			$sd['results_override_border_style']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend><?php _e("Settings theme", "ajax-search-lite"); ?></legend>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsYesNo("settings_bg_override", __("Override settings container background color?", "ajax-search-lite"),
			$sd['settings_bg_override']);
		$params[$o->getName()] = $o->getData();
		?>
		<div wd-enable-on="settings_bg_override:1">
		<?php
		$o = new wpdreamsColorPicker("settings_bg_override_color", __("color:", "ajax-search-lite"),
			$sd['settings_bg_override_color']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item">
		<div style="margin: 8px 17px 16px 0;">
		<?php
		$o = new wpdreamsYesNo("settings_override_border", __("Override settings box border?", "ajax-search-lite"),
			$sd['settings_override_border']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
		<div wd-enable-on="settings_override_border:1">
		<?php
		$o = new wpdreamsBorder("settings_override_border_style", __("Border style", "ajax-search-lite"),
			$sd['settings_override_border_style']);
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
</fieldset>