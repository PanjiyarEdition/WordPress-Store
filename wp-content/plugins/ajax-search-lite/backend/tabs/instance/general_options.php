<ul id="subtabs"  class='tabs'>
    <li><a tabid="101" class='subtheme current'><?php _e("Post Type Search", "ajax-search-lite"); ?></a></li>
    <li><a tabid="102" class='subtheme'><?php _e("Behavior", "ajax-search-lite"); ?></a></li>
    <li><a tabid="104" class='subtheme'><?php _e("Ordering", "ajax-search-lite"); ?></a></li>
    <li><a tabid="103" class='subtheme'><?php _e("Autocomplete & Suggestions", "ajax-search-lite"); ?></a></li>
    <li><a tabid="105" class='subtheme'><?php _e("Results Page Live Loader", "ajax-search-lite"); ?></a></li>
	<li><a tabid="106" class='subtheme'><?php _e("More Sources", "ajax-search-lite"); ?><span>PREMIUM</span></a></li>
</ul>
<div class='tabscontent'>
    <div tabid="101">
        <fieldset>
            <legend><?php _e("Sources & Basics", "ajax-search-lite"); ?>
				<span class="asl_legend_docs">
					<a target="_blank" href="https://documentation.ajaxsearchlite.com/general-options/sources-and-basics"><span class="fa fa-book"></span>
						<?php echo __('Documentation', 'ajax-search-lite'); ?>
					</a>
				</span>
			</legend>
            <?php include(ASL_PATH."backend/tabs/instance/general/sources.php"); ?>
        </fieldset>
    </div>
    <div tabid="102">
		<?php include(ASL_PATH."backend/tabs/instance/general/behavior.php"); ?>
    </div>
    <div tabid="104">
        <fieldset>
            <legend><?php _e("Ordering", "ajax-search-lite"); ?>
				<span class="asl_legend_docs">
					<a target="_blank" href="https://documentation.ajaxsearchlite.com/general-options/ordering"><span class="fa fa-book"></span>
						<?php echo __('Documentation', 'ajax-search-lite'); ?>
					</a>
				</span>
			</legend>
            <?php include(ASL_PATH."backend/tabs/instance/general/ordering.php"); ?>
        </fieldset>
    </div>
    <div tabid="103">
        <fieldset>
            <legend><?php _e("Autocomplete & Suggestions", "ajax-search-lite"); ?>
				<span class="asl_legend_docs">
					<a target="_blank" href="https://documentation.ajaxsearchlite.com/general-options/autocomplete-and-keyword-suggestions"><span class="fa fa-book"></span>
						<?php echo __('Documentation', 'ajax-search-lite'); ?>
					</a>
				</span>
			</legend>
            <?php include(ASL_PATH."backend/tabs/instance/general/autocomplete.php"); ?>
        </fieldset>
    </div>
	<div tabid="105">
		<?php include(ASL_PATH."backend/tabs/instance/general/results_page_live_loader.php"); ?>
	</div>
	<div tabid="106">
		<?php include(ASL_PATH."backend/tabs/instance/general/general_premium_sources.php"); ?>
	</div>
</div>
<div class="item">
    <input type="hidden" name='asl_submit' value=1 />
    <input name="submit_asl" type="submit" value="<?php _e("Save options!", "ajax-search-lite"); ?>" />
</div>