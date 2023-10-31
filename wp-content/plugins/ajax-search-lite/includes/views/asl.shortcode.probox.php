<div class="probox">

	<?php do_action('asl_layout_before_settings', $id); ?>

	<div class='prosettings' <?php echo($settingsHidden ? "style='display:none;'" : ""); ?> data-opened=0>
		<?php do_action('asl_layout_in_settings', $id); ?>
		<div class='innericon'>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22" height="22" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
					<polygon transform = "rotate(90 256 256)" points="142.332,104.886 197.48,50 402.5,256 197.48,462 142.332,407.113 292.727,256 "/>
				</svg>
		</div>
	</div>

	<?php do_action('asl_layout_after_settings', $id); ?>

	<?php do_action('asl_layout_before_input', $id); ?>

	<div class='proinput'>
        <form role="search" action='#' autocomplete="off"
			  aria-label="<?php echo esc_attr(asl_icl_t('Search form aria-Label', $style['aria_search_form_label'])); ?>">
			<input aria-label="<?php echo esc_attr(asl_icl_t('Search input aria-Label', $style['aria_search_input_label'])); ?>"
				   type='search' class='orig'
				   tabindex="0"
				   name='phrase'
				   placeholder='<?php echo asl_icl_t( "Search bar placeholder text", w_isset_def($style['defaultsearchtext'], '') ); ?>'
				   value='<?php echo apply_filters('asl_print_search_query', get_search_query()); ?>'
				   autocomplete="off"/>
			<input aria-label="<?php echo esc_attr(asl_icl_t('Search autocomplete input aria-Label', $style['aria_search_autocomplete_label'])); ?>"
				   type='text'
				   class='autocomplete'
				   tabindex="-1"
				   name='phrase'
				   value=''
				   autocomplete="off" disabled/>
			<input type='submit' value="Start search" style='width:0; height: 0; visibility: hidden;'>
		</form>
	</div>

	<?php do_action('asl_layout_after_input', $id); ?>

	<?php do_action('asl_layout_before_magnifier', $id); ?>

	<button class='promagnifier' tabindex="0" aria-label="<?php echo esc_attr(asl_icl_t('Search magnifier button aria-Label', $style['aria_magnifier_label'])); ?>">
		<?php do_action('asl_layout_in_magnifier', $id); ?>
		<span class='innericon' style="display:block;">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22" height="22" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
					<path d="M460.355,421.59L353.844,315.078c20.041-27.553,31.885-61.437,31.885-98.037
						C385.729,124.934,310.793,50,218.686,50C126.58,50,51.645,124.934,51.645,217.041c0,92.106,74.936,167.041,167.041,167.041
						c34.912,0,67.352-10.773,94.184-29.158L419.945,462L460.355,421.59z M100.631,217.041c0-65.096,52.959-118.056,118.055-118.056
						c65.098,0,118.057,52.959,118.057,118.056c0,65.096-52.959,118.056-118.057,118.056C153.59,335.097,100.631,282.137,100.631,217.041
						z"/>
				</svg>
		</span>
	</button>

	<?php do_action('asl_layout_after_magnifier', $id); ?>

	<?php do_action('asl_layout_before_loading', $id); ?>

	<div class='proloading'>

		<div class="asl_loader"><div class="asl_loader-inner asl_simple-circle"></div></div>

		<?php do_action('asl_layout_in_loading', $id); ?>
	</div>

	<?php if ($style['show_close_icon']): ?>
		<div class='proclose'>
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
				 y="0px"
				 width="12" height="12" viewBox="0 0 512 512" enable-background="new 0 0 512 512"
				 xml:space="preserve">
				<polygon points="438.393,374.595 319.757,255.977 438.378,137.348 374.595,73.607 255.995,192.225 137.375,73.622 73.607,137.352 192.246,255.983 73.622,374.625 137.352,438.393 256.002,319.734 374.652,438.378 "/>
			</svg>
		</div>
	<?php endif; ?>

	<?php do_action('asl_layout_after_loading', $id); ?>

</div>