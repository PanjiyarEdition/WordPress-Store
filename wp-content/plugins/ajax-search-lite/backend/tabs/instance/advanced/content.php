<div class="item">
	<?php
	$o = new wpdreamsCustomSelect("shortcode_op", __("What to do with shortcodes in results content?", "ajax-search-lite"), array(
		'selects'=>array(
			array("option"=>"Remove them, keep the content", "value" => "remove"),
			array("option"=>"Execute them (can by really slow)", "value" => "execute")
		),
		'value'=>$sd['shortcode_op']
	));
	$params[$o->getName()] = $o->getData();
	?>
	<p class="descMsg">
		<?php echo __("Removing shortcode is usually much faster, especially if you have many of them within posts.", "ajax-search-lite"); ?>
	</p>
</div>
<fieldset>
	<legend><?php _e("Title and Content fields", "ajax-search-lite"); ?>
		<span class="asl_legend_docs">
			<a target="_blank" href="https://documentation.ajaxsearchlite.com/advanced-options/title-and-content-fields"><span class="fa fa-book"></span>
				<?php echo __('Documentation', 'ajax-search-lite'); ?>
			</a>
		</span>
	</legend>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsCustomSelect("primary_titlefield",  __("Title Field", "ajax-search-lite"), array(
			'selects'=>array(
				array('option' => 'Post Title', 'value' => 0),
				array('option' => 'Post Excerpt', 'value' => 1),
				array('option' => 'Custom Field', 'value' => 'c__f')
			),
			'value'=>$sd['primary_titlefield']
		));
		?>
		<div wd-show-on="primary_titlefield:c__f">
		<?php
		$params[$o->getName()] = $o->getData();
		$o = new wd_CFSearchCallBack('primary_titlefield_cf', '', array(
			'value'=>$sd['primary_titlefield_cf'],
			'args'=> array(
				'controls_position' => 'left',
				'class'=>'wpd-text-right'
			)
		));
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
	<div class="item item-flex-nogrow" style="flex-wrap: wrap;">
		<?php
		$o = new wpdreamsCustomSelect("primary_descriptionfield",  __("Description Field", "ajax-search-lite"), array(
			'selects'=>array(
				array('option' => 'Post Content', 'value' => 0),
				array('option' => 'Post Excerpt', 'value' => 1),
				array('option' => 'Post Title', 'value' => 2),
				array('option' => 'Custom Field', 'value' => 'c__f')
			),
			'value'=>$sd['primary_descriptionfield']
		));
		$params[$o->getName()] = $o->getData();
		?>
		<div wd-show-on="primary_descriptionfield:c__f">
		<?php
		$o = new wd_CFSearchCallBack('primary_descriptionfield_cf', '', array(
			'value'=>$sd['primary_descriptionfield_cf'],
			'args'=> array(
				'controls_position' => 'left',
				'class'=>'wpd-text-right'
			)
		));
		$params[$o->getName()] = $o->getData();
		?>
		</div>
	</div>
</fieldset>
<fieldset>
	<legend><?php _e("Advanced Title and Content fields", "ajax-search-lite"); ?>
		<span class="asl_legend_docs">
			<a target="_blank" href="https://documentation.ajaxsearchlite.com/advanced-options/advanced-title-and-content-fields"><span class="fa fa-book"></span>
				<?php echo __('Documentation', 'ajax-search-lite'); ?>
			</a>
		</span>
	</legend>
	<div class="item">
		<?php
		$o = new wd_TextareaExpandable("advtitlefield", __('Advanced Title Field (default: {titlefield})', 'ajax-search-lite'),  $sd['advtitlefield']);
		$params[$o->getName()] = $o->getData();
		?>
		<p class="descMsg">
			<?php echo __('HTML is supported! Use {custom_field_name} format to have custom field values.', 'ajax-search-lite'); ?>&nbsp;
			<a href="https://documentation.ajaxsearchlite.com/advanced-options/advanced-title-and-content-fields" target="_blank">
				<?php echo __('More possibilities explained here!', 'ajax-search-lite'); ?>
			</a>
		</p>
	</div>
	<div class="item">
		<?php
		$o = new wd_TextareaExpandable("advdescriptionfield", __('Advanced Description Field (default: {descriptionfield})', 'ajax-search-lite'),  $sd['advdescriptionfield']);
		$params[$o->getName()] = $o->getData();
		?>
		<p class="descMsg">
			<?php echo __('HTML is supported! Use {custom_field_name} format to have custom field values.', 'ajax-search-lite'); ?>&nbsp;
			<a href="https://documentation.ajaxsearchlite.com/advanced-options/advanced-title-and-content-fields" target="_blank">
				<?php echo __('More possibilities explained here!', 'ajax-search-lite'); ?>
			</a>
		</p>
	</div>
</fieldset>