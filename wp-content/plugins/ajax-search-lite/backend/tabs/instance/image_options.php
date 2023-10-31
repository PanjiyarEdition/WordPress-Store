<div class="item">
    <?php
    $o = new wpdreamsYesNo('show_images', __("Show images in results?", "ajax-search-lite"),
        $sd['show_images']);
    $params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item item-flex-nogrow item-flex-wrap">
    <?php
    $o = new wpdreamsTextSmall('image_width', __("Image width (px)", "ajax-search-lite"),
        $sd['image_width']);
    $params[$o->getName()] = $o->getData();

    $o = new wpdreamsTextSmall('image_height', __("height (px)", "ajax-search-lite"),
        $sd['image_height']);
    $params[$o->getName()] = $o->getData();

	$o = new wpdreamsCustomSelect('image_display_mode', __('display mode', 'ajax-search-lite'), array(
		'selects'=>array(
			array("option" => "Cover the space", "value" => "cover"),
			array("option" => "Contain the image", "value" => "contain")
		),
		'value'=>$sd['image_display_mode']
	));
	$params[$o->getName()] = $o->getData();
    ?>
</div>
<div class="item">
	<?php
	$o = new wpdreamsYesNo('image_apply_content_filter', __('Execute shortcodes when looking for images in content?', 'ajax-search-lite'),
		$sd['image_apply_content_filter']);
	$params[$o->getName()] = $o->getData();
	?>
	<p class="descMsg">
		<?php echo __('Will execute shortcodes and apply the content filter before looking for images in the post content.', 'ajax-search-lite'); ?><br>
		<?php echo __('If you have <strong>missing images in results</strong>, try turning ON this option. <strong>Can cause lower performance!</strong>', 'ajax-search-lite'); ?>
	</p>
</div>
<fieldset>
    <legend>Image source settings</legend>
    <div class="item">
        <?php
        $o = new wpdreamsCustomSelect('image_source1', __("Primary image source", "ajax-search-lite"), array(
            'selects'=>$sd['image_sources'],
            'value'=>$sd['image_source1']
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsCustomSelect('image_source2', __("Alternative image source 1", "ajax-search-lite"), array(
            'selects'=>$sd['image_sources'],
            'value'=>$sd['image_source2']
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsCustomSelect('image_source3', __("Alternative image source 2", "ajax-search-lite"), array(
            'selects'=>$sd['image_sources'],
            'value'=>$sd['image_source3']
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsCustomSelect('image_source4', __("Alternative image source 3", "ajax-search-lite"), array(
            'selects'=>$sd['image_sources'],
            'value'=>$sd['image_source4']
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsCustomSelect('image_source5', __("Alternative image source 4", "ajax-search-lite"), array(
            'selects'=>$sd['image_sources'],
            'value'=>$sd['image_source5']
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsUpload('image_default', __("Default image url", "ajax-search-lite"),
            $sd['image_default']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $_feat_image_sizes = get_intermediate_image_sizes();
        $feat_image_sizes = array(
            array(
                "option" => "Original size",
                'value' => "original"
            )
        );
        foreach ($_feat_image_sizes as $k => $v)
            $feat_image_sizes[] = array(
                "option" => $v,
                "value"  => $v
            );
        $o = new wpdreamsCustomSelect('image_source_featured', __("Featured image size source", "ajax-search-lite"), array(
            'selects'=>$feat_image_sizes,
            'value'=>$sd['image_source_featured']
        ));
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsText('image_custom_field', __("Custom field containing the image", "ajax-search-lite"),
            $sd['image_custom_field']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
    <div class="item">
        <?php
        $o = new wpdreamsTextSmall('image_parser_image_number', 'Image number the parser should get from the fields',
            $sd['image_parser_image_number']);
        $params[$o->getName()] = $o->getData();
        ?>
    </div>
	<div class="item">
		<?php
		$o = new wd_TextareaExpandable('image_parser_exclude_filenames', 'Exclude images by file names (comma separated)',
			$sd['image_parser_exclude_filenames']);
		$params[$o->getName()] = $o->getData();
		?>
		<div class="descMsg"><?php echo __('If any part of the image filename or path contains any of the above strings, it is excluded.', 'ajax-search-lite') ?></div>
	</div>
</fieldset>
<div class="item">
    <input type="hidden" name='asl_submit' value=1 />
    <input name="submit_asl" type="submit" value="<?php _e("Save options!", "ajax-search-lite"); ?>" />
</div>