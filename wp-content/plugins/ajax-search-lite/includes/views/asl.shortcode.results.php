<div id='ajaxsearchliteres<?php echo $id; ?>'
	 class='<?php echo $style['resultstype']; ?> wpdreams_asl_results asl_w asl_r asl_r_<?php echo $real_id; ?> asl_r_<?php echo $real_id; ?>_1'>

	<?php do_action('asl_layout_before_results', $id); ?>

	<div class="results">

		<?php do_action('asl_layout_before_first_result', $id); ?>

		<div class="resdrg">
		</div>

		<?php do_action('asl_layout_after_last_result', $id); ?>

	</div>

	<?php do_action('asl_layout_after_results', $id); ?>

	<?php if ($style['showmoreresults'] == 1): ?>
		<?php do_action('asl_layout_before_showmore', $id); ?>
		<p class='showmore'>
			<span><?php echo asl_icl_t('Show more results text', $style['showmoreresultstext']); ?></span>
		</p>
		<?php do_action('asl_layout_after_showmore', $id); ?>
	<?php endif; ?>

</div>
