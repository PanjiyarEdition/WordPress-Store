<div class="item wd-primary-order item-flex-nogrow item-flex-wrap"><?php
	$o = new wpdreamsCustomSelect("orderby_primary", __('Primary ordering', 'ajax-search-lite'),
		array(
			'selects' => array(
				array('option' => __('Relevance', 'ajax-search-lite'), 'value' => 'relevance DESC'),
				array('option' => __('Title descending', 'ajax-search-lite'), 'value' => 'post_title DESC'),
				array('option' => __('Title ascending', 'ajax-search-lite'), 'value' => 'post_title ASC'),
				array('option' => __('Date descending', 'ajax-search-lite'), 'value' => 'post_date DESC'),
				array('option' => __('Date ascending', 'ajax-search-lite'), 'value' => 'post_date ASC'),
				array('option' => __('Menu order descending', 'ajax-search-lite'), 'value' => 'menu_order DESC'),
				array('option' => __('Menu order ascending', 'ajax-search-lite'), 'value' => 'menu_order ASC'),
				array('option' => __('Random', 'ajax-search-lite'), 'value' => 'RAND()'),
				array('option' => __('Custom Field descending', 'ajax-search-lite'), 'value' => 'customfp DESC'),
				array('option' => __('Custom Field  ascending', 'ajax-search-lite'), 'value' => 'customfp ASC')
			),
			'value' => $sd['orderby_primary']
		));
	$params[$o->getName()] = $o->getData();
	?>
	<div class='item-flex-nogrow item-flex-wrap'  wd-show-on="orderby_primary:customfp DESC,customfp ASC">
	<?php
	$o = new wpdreamsText("orderby_primary_cf", __('custom field', 'ajax-search-lite'), $sd['orderby_primary_cf']);
	$params[$o->getName()] = $o->getData();

	$o = new wpdreamsCustomSelect("orderby_primary_cf_type", __('type', 'ajax-search-lite'),
		array(
			'selects' => array(
				array('option' => __('numeric', 'ajax-search-lite'), 'value' => 'numeric'),
				array('option' => __('string or date', 'ajax-search-lite'), 'value' => 'string')
			),
			'value' => $sd['orderby_primary_cf_type']
		));
	$params[$o->getName()] = $o->getData();
	?>
	</div>
</div>
<div class="item wd-secondary-order item-flex-nogrow item-flex-wrap"><?php
	$o = new wpdreamsCustomSelect("orderby_secondary", __('Secondary ordering', 'ajax-search-lite'),
		array(
			'selects' => array(
				array('option' => __('Relevance', 'ajax-search-lite'), 'value' => 'relevance DESC'),
				array('option' => __('Title descending', 'ajax-search-lite'), 'value' => 'post_title DESC'),
				array('option' => __('Title ascending', 'ajax-search-lite'), 'value' => 'post_title ASC'),
				array('option' => __('Date descending', 'ajax-search-lite'), 'value' => 'post_date DESC'),
				array('option' => __('Date ascending', 'ajax-search-lite'), 'value' => 'post_date ASC'),
				array('option' => __('Random', 'ajax-search-lite'), 'value' => 'RAND()'),
				array('option' => __('Custom Field descending', 'ajax-search-lite'), 'value' => 'customfs DESC'),
				array('option' => __('Custom Field ascending', 'ajax-search-lite'), 'value' => 'customfs ASC')
			),
			'value' => $sd['orderby_secondary']
		));
	$params[$o->getName()] = $o->getData();
	?>
	<div class='item-flex-nogrow item-flex-wrap' wd-show-on="orderby_secondary:customfs DESC,customfs ASC">
	<?php
	$o = new wpdreamsText("orderby_secondary_cf", __('custom field', 'ajax-search-lite'), $sd['orderby_secondary_cf']);
	$params[$o->getName()] = $o->getData();

	$o = new wpdreamsCustomSelect("orderby_secondary_cf_type", __('type', 'ajax-search-lite'),
		array(
			'selects' => array(
				array('option' => __('numeric', 'ajax-search-lite'), 'value' => 'numeric'),
				array('option' => __('string or date', 'ajax-search-lite'), 'value' => 'string')
			),
			'value' => $sd['orderby_secondary_cf_type']
		));
	$params[$o->getName()] = $o->getData();
	?>
	</div>
	<div class="descMsg item-flex-grow item-flex-100">
		<?php echo __('If two elements match the primary ordering criteria, the <b>Secondary ordering</b> is used.', 'ajax-search-lite'); ?>
	</div>
</div>