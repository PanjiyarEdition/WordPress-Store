<?php
/**
 * Rishi_Companion_Plugin_Manager class
 *
 * @package Rishi_Companion
 */
namespace Rishi;

defined( 'ABSPATH' ) || exit;

/**
 * Main Rishi_Companion_Plugin_Manager Cass.
 *
 * @package Rishi_Companion
 */
class Rishi_Companion_Plugin_Manager {
	protected $config = [];

	public function __construct() {
		$this->load_config();
	}

	public function get_config() {
		return $this->config;
	}

	protected function load_config() {
		$this->config = [

			'affiliatex' => [
				'type' => 'web',
				'title' => 'AffiliateX – Gutenberg Blocks for Affiliate Marketing',
				'description' => __( 'AffiliateX is a Gutenberg blocks plugin for affiliate marketers. You can create highly effective affiliate marketing blogs with AffiliateX blocks, increasing the conversion rate and boost your affiliate income.', 'rishi-companion' ),
			],

			'mega-elements-addons-for-elementor' => [
				'type' => 'web',
				'title' => 'Mega Elements - Addons for Elementor',
				'description' => __( 'Mega Elements is a powerful and advanced all in one Elementor addons that help you to create a beautiful website with ease.', 'rishi-companion' ),
			],
			
			'elementor' => [
				'type' => 'web',
				'title' => 'Elementor Page Builder',
				'description' => __( 'Elementor is one of most advanced frontend drag & drop page builder to help you create pixel perfect websites in less time.', 'rishi-companion' ),
			],

			'woocommerce' => [
				'type' => 'web',
				'title' => 'WooCommerce',
				'description' => __( 'WooCommerce is the world’s most popular open source eCommerce plugin that help you to create online store easily.', 'rishi-companion' ),
			],

			'contact-form-7' => [
				'type' => 'web',
				'title' => 'Contact Form 7',
				'description' => __( 'Contact Form 7 is one of the most downloaded and popular contact form plugin to quickly add forms on your website.', 'rishi-companion' ),
			],
		];
	}

	public function get_plugins() {
		
		if (isset($this->config)) {
			return $this->config;
		}

		return [];
	}

	public function get_plugins_api($slug) {
		static $api = []; // Cache received responses.

		if (! isset($api[$slug])) {
			if ( ! function_exists( 'plugins_api' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
			}

			require_once plugin_dir_path( __FILE__ ) . '/classes/rishi-companion-wp-upgrader-skin.php';

			$response = plugins_api(
				'plugin_information',
				[
					'slug' => $slug,
					'fields' => [
						'sections' => false,
					],
				]
			);

			$api[$slug] = false;

			if (is_wp_error($response)) {
				wp_die(esc_html($this->strings['oops']));
			} else {
				$api[$slug] = $response;
			}
		}

		return $api[$slug];
	}

	/**
	 * Wrapper around the core WP get_plugins function,
	 * making sure it's actually available.
	 */
	public function get_installed_plugins($plugin_folder = '') {
		// https://github.com/WordPress/WordPress/blob/ba92ed7615dec870a363bc99d6668faedfa77415/wp-admin/includes/plugin.php#L2254
		wp_cache_delete('plugins', 'plugins');

		if (! function_exists('get_plugins')) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return get_plugins($plugin_folder);
	}

	public function is_plugin_installed($slug) {
		$installed_plugins = $this->get_installed_plugins();

		foreach ($installed_plugins as $plugin => $data) {
			$parts = explode('/', $plugin);
			$plugin_first_part = $parts[0];

			if (strtolower($slug) === strtolower($plugin_first_part)) {
				return $plugin;
			}
		}

		return false;
	}

	public function can($capability = 'install_plugins') {
		if (is_multisite()) {
			// Only network admin can change files that affects the entire network.
			$can = current_user_can_for_blog(get_current_blog_id(), $capability);
		} else {
			$can = current_user_can($capability);
		}

		if ($can) {
			// Also you can use this method to get the capability.
			$can = $capability;
		}

		return $can;
	}

	protected function require_wp_headers() {
		require_once ABSPATH . 'wp-admin/includes/file.php';

		if (! class_exists('Plugin_Upgrader', false)) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		if (! class_exists('Rishi_Companion_WP_Upgrader_Skin', false)) {
			require_once plugin_dir_path( __FILE__ ) . '/classes/rishi-companion-wp-upgrader-skin.php';
		}
	}

	public function prepare_install($plugin) {
		if (! $this->can()) {
			return false;
		}

		$avaible_plugins = $this->get_plugins();

		if (! array_key_exists($plugin, $avaible_plugins)) {
			return $this->download_and_install($plugin);
		}

		$plugin_info = $avaible_plugins[ $plugin ];

		if ( 'web' === $plugin_info['type'] ) {
			return $this->download_and_install( $plugin );
		}
	}

	public function has_direct_access( $context = null ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();

		/** @var WP_Filesystem_Base $wp_filesystem */
		global $wp_filesystem;

		if ( $wp_filesystem ) {
			if ( is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
				return false;
			} else {
				return $wp_filesystem->method === 'direct';
			}
		}

		if ( get_filesystem_method( [], $context ) === 'direct' ) {
			ob_start();

			{
				$creds = request_filesystem_credentials( admin_url(), '', false, $context, null );
			}

			ob_end_clean();

			if ( WP_Filesystem( $creds ) ) {
				return true;
			}
		}

		return false;
	}

	public function is_plugin_active( $plugin ) {
		if ( ! function_exists( 'activate_plugin' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return is_plugin_active( $plugin );
	}

	public function plugin_activation( $plugin ) {
		$full_name = $this->is_plugin_installed( $plugin );

		if ( $full_name ) {
			if ( ! $this->is_plugin_active( $full_name ) ) {
				return activate_plugin( $full_name, '', false, true );
			}
		}

		return new WP_Error();
	}

	public function plugin_deactivation( $plugin ) {
		$full_name = $this->is_plugin_installed( $plugin );

		if ( $full_name ) {
			if ( is_plugin_active( $full_name ) ) {
				return deactivate_plugins( $full_name );
			}
		}

		return new WP_Error();
	}

	public function uninstall_plugin( $plugin ) {
		$this->init_filesystem();
		$full_name = $this->is_plugin_installed( $plugin );

		if ( $full_name ) {
			if ( ! is_plugin_active( $full_name ) ) {
				return delete_plugins( [ $full_name ] );
			}
		}

		return new WP_Error();
	}

	public function download_and_install( $slug ) {
		$this->require_wp_headers();

		if ($this->is_plugin_installed($slug)) {
			return true;
		}

		$api = $this->get_plugins_api($slug);

		if (! isset($api->download_link)) {
			return true;
		}

		// Prep variables for Plugin_Installer_Skin class.
		$source = $api->download_link;

		if (! $source) {
			return false;
		}

		$skin = new \Rishi_Companion_WP_Upgrader_Skin();

		// Create a new instance of Plugin_Upgrader.
		$upgrader = new \Plugin_Upgrader($skin);

		$upgrader->install($source);
	}

	public function init_filesystem() {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		WP_Filesystem();
	}
}