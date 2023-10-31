<div class="item">
	<?php
	$o = new wpdreamsCustomSelect("js_source",  __('Javascript source', 'ajax-search-lite'), array(
			'selects'   => wd_asl()->o['asl_compatibility_def']['js_source_def'],
			'value'     => $com_options['js_source']
		)
	);
	$params[$o->getName()] = $o->getData();
	?>
</div>
<div class="item" wd-enable-on="js_source:jqueryless-nomin,jqueryless-min">
	<?php
	$o = new wpdreamsCustomSelect("script_loading_method", __('Script loading method', 'ajax-search-lite'), array(
			'selects'=>array(
				array('option'=>'Classic', 'value'=>'classic'),
				array('option'=>'Optimized (recommended)', 'value'=>'optimized'),
				array('option'=>'Optimized asynchronous', 'value'=>'optimized_async')
			),
			'value'=>$com_options['script_loading_method']
		)
	);
	$params[$o->getName()] = $o->getData();
	?>
	<p class="descMsg">
	<ul style="float:right;text-align:left;width:70%;">
		<li><?php echo __('<b>Classic</b> - All scripts are loaded as blocking at the same time', 'ajax-search-lite'); ?></li>
		<li><?php echo __('<b>Optimized</b> - Scripts are loaded separately, but only the required ones', 'ajax-search-lite'); ?></li>
		<li><?php echo __('<b>Optimized asnynchronous</b> - Same as the Optimized, but the scripts load in the background', 'ajax-search-lite'); ?></li>
	</ul>
	<div class="clear"></div>
	</p>
</div>
<div class="item">
	<?php $o = new wpdreamsYesNo("init_instances_inviewport_only", __('Initialize search instances only when they get visible on the viewport?', 'ajax-search-lite'),
		$com_options['init_instances_inviewport_only']
	); ?>
	<p class='descMsg'>
		<?php echo __('Lazy loader for the search initializer script. It can reduce the initial javascript thread work and increase the google lighthouse score.', 'ajax-search-lite'); ?>
	</p>
</div>
<div class="item">
	<?php $o = new wpdreamsYesNo("detect_ajax", __('Try to re-initialize if the page was loaded via ajax?', 'ajax-search-lite'),
		$com_options['detect_ajax']
	); ?>
	<p class='descMsg'>
		<?php echo __('Will try to re-initialize the plugin in case an AJAX page loader is used, like Polylang language switcher etc..', 'ajax-search-lite'); ?>
	</p>
</div>
<div class="item">
	<?php $o = new wpdreamsYesNo("load_google_fonts", __('Load the <strong>google fonts</strong> used in the search options?', 'ajax-search-lite'),
		$com_options['load_google_fonts']
	); ?>
	<p class='descMsg'>
		<?php echo __('When <strong>turned off</strong>, the google fonts <strong>will not be loaded</strong> via this plugin at all.<br>Useful if you already have them loaded, to avoid mutliple loading times.', 'ajax-search-lite'); ?>
	</p>
</div>