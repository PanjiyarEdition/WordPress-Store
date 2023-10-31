<?php

function rishi_companion_cookies_consent_cache() {
	if (! is_customize_preview()) return;

	rishi__cb_customizer_add_customizer_preview_cache(
		rishi__cb_customizer_html_tag(
			'div',
			[ 'data-id' => 'rc-cookies-consent-section' ],
			rishi_companion_cookies_consent_output(true)
		)
	);
}

if( ! function_exists( 'rishi_companion_get_cc_accept_button_info' ) ) :
	/**
	 * Accept Button Info
	 */
	function rishi_companion_get_cc_accept_button_info(){
		$button_text = get_theme_mod('cookie_consent_button_text', __('Accept', 'rishi-companion'));
		if ($button_text) echo '<button type="submit" class="rt-button rt-accept">' . esc_html($button_text) . '</button>';
	}
endif;

if( ! function_exists( 'rishi_companion_get_cc_decline_button_info' ) ) :
	/**
	 * Decline Button Info
	 */
	function rishi_companion_get_cc_decline_button_info(){
		$button_two_text = get_theme_mod('cookie_consent_button_two_text', __('Decline', 'rishi-companion'));
		if ($button_two_text) echo '<button type="submit" class="rt-button rt-close ct-decline-close">' . esc_html($button_two_text) . '</button>';
	}
endif;

function rishi_companion_cookies_consent_output($forced = false) {
	
	if ( isset( $_COOKIE['rc_cookies_consent_accepted'] ) && 'true' === $_COOKIE['rc_cookies_consent_accepted'] ) {
		return;
	}

	if (! $forced) {
		rishi_companion_cookies_consent_cache();
	}

	$content = get_theme_mod(
		'cookie_consent_content',
		__('We use cookies on our website to give you the most relevant experience. By continuing to use the site, you agree to the use of cookies.', 'rishi-companion')
	);

	$period = get_theme_mod('cookie_consent_period', 'forever');
	$type = get_theme_mod('cookie_consent_type', 'type-1');
	$type_inner = ( $type === 'type-1' ) ? get_theme_mod('cookie_consent_type_one', 'left') : get_theme_mod('cookie_consent_type_two', 'bottom');

	$class = 'container';

	if ( $type === 'type-2' || $type === 'type-3' ) {
		$class = 'rt-container';
	}

	ob_start();

	?>


	<div class="cookie-notification rt-fade-in-start" data-period="<?php echo esc_attr($period) ?>" data-type="<?php echo esc_attr($type) ?>" data-innertype="<?php echo esc_attr($type_inner) ?>">

		<div class="<?php echo esc_attr($class) ?>">
			<?php if (!empty($content)) { ?>
				<div class="rc-cookies-content"><?php echo wp_kses_post($content) ?></div>
			<?php } ?>
			<?php rishi_companion_get_cc_decline_button_info(); ?>
			<?php rishi_companion_get_cc_accept_button_info(); ?>
			<button class="rt-close close">×</button>
			
		</div>
	</div>
	<?php

	return ob_get_clean();
}

function rishi_companion_lazyload_get_atts_array($atts_string) {
	
	if(!empty($atts_string)) {
		$atts_array = array_map(
			function(array $attribute) {
				return $attribute['value'];
			},
			wp_kses_hair($atts_string, wp_allowed_protocols())
		);

		return $atts_array;
	}

	return false;
}