<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=470596109688127&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div id="wpdreams" class='asl_updates_help<?php echo isset($_COOKIE['asl-accessibility']) ? ' wd-accessible' : ''; ?>'>
	<style>
	.socials a {
		color: white;
		border-radius: 4px;
		padding: 8px 12px;
		margin-right: 12px;
    	text-decoration: none;
		display: inline-block;
		font: normal 13px/100% Verdana,Tahoma,sans-serif;
	}

	.socials svg {
		fill: white;
		vertical-align: middle;
		margin: -3px 4px 0 0;
	}

	.socials a.facebook {
		background: #3A589E;
	}

	.socials a.twitter {
		background: #55ACEE;
	}
	</style>
    <div class="wpdreams-box" style='vertical-align: middle;'>
        <a class='gopro' href='https://ajaxsearchpro.com/?utm_source=ajax-search-lite&utm_content=helpsupport' target='_blank'>Get the pro version!</a>
		<span class="socials">
			<a class="facebook" target="_blank" href="https://www.facebook.com/wpdreams">
				<svg width="18" height="18" aria-hidden="true" role="img" focusable="false">
					<svg id="ifacebook" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48A48 48 0 000 80v352a48 48 0 0048 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0048-48V80a48 48 0 00-48-48z"></path></svg>
				</svg>
				WPDreams
			</a>
			<a class="twitter" target="_blank" href="https://twitter.com/ernest_marcinko">
				<svg width="18" height="18" aria-hidden="true" role="img" focusable="false">
					<svg id="itwitter" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg>
				</svg>
				Ernest Marcinko
			</a>
		</span>
    </div>

    <div class="wpdreams-box" style="float:left;">

        <div class='wpdreams-slider'>

            <div class="wpd-half">
                <h3>Support</h3>
                <div class="item">
                    <p>For support please visit the <a target='_blank' href="https://wordpress.org/support/plugin/ajax-search-lite">Ajax Search Lite support forums</a> on wordpress.org</p>
                    <p>
                        Before opening a ticket please:
                        <ul>
                            <li>Search through the threads, the problem might have been solved before</li>
                            <li>Make sure your search configuration is indeed correct</li>
                            <li>Upload the debug data to <a href="https://paste.ee" target="_blank">paste.ee</a> (or to any text paste provider) and <strong>share the url to the paste</strong> in the support message.
                            <br>Please <strong>do not paste this directly to the support forums</strong>, it is lots of data!
                            </li>
                        </ul>
                    </p>
                </div>
            </div>

            <div class="wpd-half-last">
                <div class="item">
                    <h3>Debug Data</h3>
                    <textarea><?php echo wd_asl()->debug->getSerializedStorage(); ?></textarea>

                    <p class="descMsg" style="text-align: left;">
                        This is basic debugging information, mainly for support purposes. In case of contacting
                        the support forums, please copy and paste this data to <a href="https://paste.ee" target="_blank">paste.ee</a> (or to any text paste provider) and <strong>share the url to the paste</strong> in the support message.
                        <br>This data contains the configuration and the last 5 search queries executed, it can be extremely helpful for support.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?php include(ASL_PATH . "backend/sidebar.php"); ?>
    <div class="clear"></div>
</div>