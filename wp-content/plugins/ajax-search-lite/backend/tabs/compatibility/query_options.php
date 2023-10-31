<div class="item">
	<?php $o = new wpdreamsYesNo("query_soft_check",
		__('Do a soft-check only on search override, when trying to check if the current query is the search?', 'ajax-search-lite'),
		$com_options['query_soft_check']
	); ?>
	<p class='descMsg'>
		<?php echo __('Use this option, when the search override does not work on the search results page.', 'ajax-search-lite'); ?>
	</p>
</div>
<div class="item">
	<?php $o = new wpdreamsYesNo("use_acf_getfield",
		__('<strong>Advanced Custom Fields</strong>: use the ACF get_field() function to get the metadata?', 'ajax-search-lite'),
		$com_options['use_acf_getfield']
	); ?>
	<p class='descMsg'>Will use the get_field() Advanced Custom Fields function instead of the core get_post_meta()</p>
</div>

<p class='infoMsg'>
	<?php echo __('If you are experiencing issues with accent(diacritic) or case sensitiveness, you can force the search to try these tweaks.', 'ajax-search-lite'); ?><br>
	<?php echo __('<i>The search works according to your database collation settings</i>, so please be aware that <b>this is not an effective way</b> of fixing database collation issues.', 'ajax-search-lite'); ?><br>
	<?php echo sprintf( __('If you have case/diacritic issues then please read the <a href="%s" target="_blank">MySql manual on collations</a> or consult a <b>database expert</b> - those issues should be treated on database level!', 'ajax-search-lite'),
		'http://dev.mysql.com/doc/refman/5.0/en/charset-syntax.html'
	); ?>
</p>
<div class="item">
	<?php
	$o = new wpdreamsCustomSelect("db_force_case", __('Force case', 'ajax-search-lite'), array(
			'selects'=> array(
				array('option' => __('None', 'ajax-search-lite'), 'value' => 'none'),
				array('option' => __('Sensitivity', 'ajax-search-lite'), 'value' => 'sensitivity'),
				array('option' => __('InSensitivity', 'ajax-search-lite'), 'value' => 'insensitivity')
			),
			'value'=>$com_options['db_force_case']
		)
	);
	$params[$o->getName()] = $o->getData();
	?>
</div>
<div class="item">
	<?php $o = new wpdreamsYesNo("db_force_unicode", __('Force unicode search', 'ajax-search-lite'),
		$com_options['db_force_unicode']
	); ?>
	<p class='descMsg'>
		<?php echo __('Will try to force unicode character conversion on the search phrase.', 'ajax-search-lite'); ?>
	</p>
</div>
<div class="item">
	<?php $o = new wpdreamsYesNo("db_force_utf8_like", __('Force utf8 on LIKE operations', 'ajax-search-lite'),
		$com_options['db_force_utf8_like']
	); ?>
	<p class='descMsg'>
		<?php echo __('Will try to force utf8 conversion on all LIKE operations in the WHERE and HAVING clauses.', 'ajax-search-lite'); ?>
	</p>
</div>