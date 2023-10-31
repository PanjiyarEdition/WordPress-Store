<?php
require_once dirname(__FILE__) . '/helpers.php';

class RishiCompanionExtensionCookiesConsent {
	public static function should_display_notification() {
		return !isset($_COOKIE['rc_cookies_consent_accepted']);
	}

	public function __construct() {
		add_filter('rt:footer:offcanvas-drawer', function ($els) {
			$els[] = rishi_companion_cookies_consent_output();
			return $els;
		});

		add_filter('rt-async-scripts-handles', function ($d) {
			$d[] = 'rc-ext-cookies-consent-scripts';
			return $d;
		});

		add_filter(
			'rishi__cb_customizer_extensions_customizer_options',
			[$this, 'add_options_panel']
		);

		add_action(
			'customize_preview_init',
			function () {

				wp_enqueue_script(
					'rc-cookies-consent-customizer-sync',
					plugin_dir_url(RISHI_COMPANION_PLUGIN_FILE) . 'assets/build/sync.js',
					[ 'rishi__cb_main', 'customize-preview', 'rara-customizer-sync', 'rt-custom-events' ],
					'',
					true
				);
			}
		);

		add_action('wp_enqueue_scripts', function () {
			
			if (is_admin()) {
				return;
			}
			
			wp_enqueue_script(
				'rc-ext-cookies-consent-scripts',
				plugin_dir_url(RISHI_COMPANION_PLUGIN_FILE) . 'assets/build/cookieConsent.js',
				['rishi__cb_main'],
				'',
				true
			);

			wp_localize_script(
				'rc-ext-cookies-consent-scripts',
				'rishi_companion_cookie_consent',
				[
					'delay'    => get_theme_mod( 'cookie_consent_delay', '0' ),
				]
			);
		});

		add_action('rishi:global-dynamic-css:enqueue', function ($args) {
			rishi__cb_customizer_theme_get_dynamic_styles(array_merge([
				'path' => dirname( __FILE__ ) . '/global.php',
				'chunk' => 'global'
			], $args));
		}, 10, 3);
	}

	public function add_options_panel($options) {

		$options['cookie_consent_ext'] = $this->get_call_fn(
			[
				'fn' => 'rishi__cb_customizer_get_options',
				'default' => 'array'
			],
			dirname(__FILE__) . '/customizer.php',
			[], false
		);

		return $options;
	}

	public function get_call_fn($args = [], ...$params) {
		$args = wp_parse_args(
			$args,
			[
				'fn' => null,

				// string | null | array
				'default' => ''
			]
		);

		if (! $args['fn']) {
			throw new Error('$fn must be specified!');
		}

		if (! function_exists($args['fn'])) {
			return $args['default'];
		}

		return call_user_func($args['fn'], ...$params);
	}
}

