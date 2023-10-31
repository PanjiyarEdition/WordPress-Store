<?php

require_once dirname(__FILE__) . '/helpers.php';
class RishiCompanionExtensionProgressBar {

	public function __construct() {

		add_filter(
			'rishi__cb_customizer_extensions_customizer_options',
			[$this, 'add_options_panel']
		);

		add_action('wp_enqueue_scripts', function () {
			
			if (is_admin()) {
				return;
			}
			
			wp_enqueue_script(
				'rc-ext-progress-bar-scripts',
				plugin_dir_url(RISHI_COMPANION_PLUGIN_FILE) . 'assets/build/progressBar.js',
				['rishi__cb_main'],
				'',
				true
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

		$options['progres_bar_ext'] = $this->get_call_fn(
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

