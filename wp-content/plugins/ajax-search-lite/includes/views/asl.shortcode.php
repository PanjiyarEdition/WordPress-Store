<?php
    $id = self::$instanceCount;
    $real_id = self::$instanceCount;

    if ( isset($style['_fo']) && !isset($style['_fo']['categoryset']) )
        $style['_fo']['categoryset'] = array();
?>
<div class="asl_w_container asl_w_container_<?php echo $real_id; ?>">
	<div id='ajaxsearchlite<?php echo self::$instanceCount; ?>'
		 data-id="<?php echo $real_id; ?>"
		 data-instance="1"
		 class="asl_w asl_m asl_m_<?php echo $real_id; ?> asl_m_<?php echo $real_id; ?>_1">
		<?php
		/******************** PROBOX INCLUDE ********************/
		include('asl.shortcode.probox.php');
		?>
	</div>
	<div class='asl_data_container' style="display:none !important;">
		<?php
		/******************** SCRIPT INCLUDE (hidden) ********************/
		include('asl.shortcode.script.php');

		/******************** DATA INCLUDE (hidden) ********************/
		include('asl.shortcode.data.php');
		?>
	</div>

	<?php

	/******************** RESULTS INCLUDE ********************/
	include('asl.shortcode.results.php');
	?>

	<div id='__original__ajaxsearchlitesettings<?php echo $id; ?>'
		 data-id="<?php echo $real_id; ?>"
		 class="searchsettings wpdreams_asl_settings asl_w asl_s asl_s_<?php echo $real_id; ?>">
		<?php
		/******************* SETTINGS INCLUDE *******************/
		include('asl.shortcode.settings.php');
		?>
	</div>
</div>