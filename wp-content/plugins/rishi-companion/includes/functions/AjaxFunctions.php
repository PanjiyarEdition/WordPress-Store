<?php
/**
 * AJAX Functions.
 *
 * @package Rishi_Companion
 */
namespace Rishi;

defined( 'ABSPATH' ) || exit;

/**
 * Global Settings.
 */
class AjaxFunctions {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->init();

		if ( wp_doing_ajax() ) {
			$manager = new RishiCompanionExtensionsManager();
			$manager->do_extensions_preboot();
		}
	}

	/**
	 * Initialization.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init() {
		// Initialize hooks.
		$this->init_hooks();

		// Allow 3rd party to remove hooks.
		do_action( 'rishi_companion_ajaxfunctions_unhook', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function init_hooks() {
		
		// AJAX for theme changelog query
		add_action( 'wp_ajax_rc_get_latest_changelog', array( $this, 'get_latest_changelog' ) );

		// AJAX for Plugin Status
		add_action( 'wp_ajax_rc_get_plugins_status', array( $this, 'get_plugins_status' ) );

		// AJAX for Plugin Download
		add_action( 'wp_ajax_rc_get_plugin_download', array( $this, 'get_plugin_download' ) );

		// AJAX for Plugin Activate
		add_action( 'wp_ajax_rc_get_plugin_activate', array( $this, 'get_plugin_activate' ) );

		// AJAX for Plugin Deactivate
		add_action( 'wp_ajax_rc_get_plugin_deactivate', array( $this, 'get_plugin_deactivate' ) );

		// AJAX for Plugin Delete
		add_action( 'wp_ajax_rc_get_plugin_delete', array( $this, 'get_plugin_delete' ) );

		// AJAX for Addons Status
		add_action( 'wp_ajax_rc_get_extensions_status', array( $this, 'get_extensions_status' ) );

		// AJAX for Addons Activate
		add_action( 'wp_ajax_rc_get_extension_activate', array( $this, 'get_extension_activate' ) );

		// AJAX for Addons Deactivate
		add_action( 'wp_ajax_rc_get_extension_deactivate', array( $this, 'get_extension_deactivate' ) );

		// AJAX for Transparent header taxonomy
		add_action( 'wp_ajax_rc_get_conditions_all_taxonomies', array( $this, 'get_conditions_all_taxonomies' ) );

		// AJAX for Transparent header posts
		add_action( 'wp_ajax_rc_get_conditions_all_posts', array( $this, 'get_conditions_all_posts' ) );

		// Reset AJAX
		add_action( 'wp_ajax_rc_customizer_reset', array( $this, 'get_customizer_reset' ) );
	}

	/**
	 * Get Latest Changelog
	 *
	 * @return void
	 */
	public function get_latest_changelog() {
		$theme_changelog = null;
		$plugin_changelog = null;
		$access_type = get_filesystem_method();

		if ($access_type === 'direct') {
			$creds = request_filesystem_credentials(
				site_url() . '/wp-admin/',
				'', false, false,
				[]
			);

			if (WP_Filesystem($creds)) {
				global $wp_filesystem;

				$plugin_changelog = $wp_filesystem->get_contents(
					plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) . '/changelog.txt'
				);

				$theme_changelog = $wp_filesystem->get_contents(
					get_template_directory() . '/changelog.txt'
				);
			}
		}

		wp_send_json_success([
			'changelog' => apply_filters(
				'rishi_companion_changelogs_list',
				[
					[
						'title'     => __('Theme', 'rishi-companion'),
						'changelog' => $theme_changelog,
					],
					[
						'title'     => __('Plugin', 'rishi-companion'),
						'changelog' => $plugin_changelog,
					]
				]
			)
		]);
	}

	/**
	 * Get Plugin Status
	 *
	 * @return void
	 */
	public function get_plugins_status() {

		$this->check_capability( 'edit_plugins' );
		$result = [];
		// Is not installed.
		$status = 'uninstalled';

		$manager = new Rishi_Companion_Plugin_Manager();
		$plugin_manager_config = $manager->get_config();
		$plugins = $plugin_manager_config;
		$installed_plugins = $manager->get_installed_plugins();

		foreach ( array_keys( $plugins ) as $plugin ) {
			$installed_path = $manager->is_plugin_installed( $plugin );

			if (! $installed_path) {
				$status = 'uninstalled'; // Plugin is not installed.
			} else {
				if ( is_plugin_active( $installed_path ) ) {
					$status = 'activated'; // Plugin is active.
				} else {
					$status = 'deactivated'; // Plugin is installed but inactive.
				}
			}

			$result[] = array(
				'name' => $plugin,
				'status' => $status,
			);
		}

		wp_send_json_success( $result );
	}

	/**
	 * Get Plugin Download
	 *
	 * @return void
	 */
	public function get_plugin_download() {

		$this->check_capability( 'install_plugins' );
		$plugin = $this->get_plugin_from_request();

		$manager = new Rishi_Companion_Plugin_Manager();
		$install = $manager->prepare_install( $plugin );

		if ( $install ) {
			wp_send_json_success();
		}

		wp_send_json_error();
	}

	/**
	 * Get Plugin Activate
	 *
	 * @return void
	 */
	public function get_plugin_activate() {

		$this->check_capability( 'edit_plugins' );
		$plugin = $this->get_plugin_from_request();

		$manager = new Rishi_Companion_Plugin_Manager();
		$result = $manager->plugin_activation( $plugin );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( $result );
		}

		wp_send_json_success();
	}

	/**
	 * Get Plugin Deactivate
	 *
	 * @return void
	 */
	public function get_plugin_deactivate() {

		$this->check_capability( 'edit_plugins' );
		$plugin = $this->get_plugin_from_request();

		$manager = new Rishi_Companion_Plugin_Manager();
		$result = $manager->plugin_deactivation( $plugin );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( $result );
		}

		wp_send_json_success();
	}

	/**
	 * Get Plugin Delete
	 *
	 * @return void
	 */
	public function get_plugin_delete() {
		$this->check_capability( 'delete_plugins' );
		$plugin = $this->get_plugin_from_request();

		$manager = new Rishi_Companion_Plugin_Manager();
		$result = $manager->uninstall_plugin( $plugin );

		if ( is_wp_error( $result ) ) {
			wp_send_json_error( $result );
		}

		wp_send_json_success();
	}

	/**
	 * Get Plugin Capability
	 *
	 * @return void
	 */
	public function check_capability( $cap = 'install_plugins' ) {
		$manager = new Rishi_Companion_Plugin_Manager();
		if ( ! $manager->can( $cap ) ) {
			wp_send_json_error();
		}

		return true;
	}

	/**
	 * Get Plugin Request
	 *
	 * @return void
	 */
	public function get_plugin_from_request() {
		if ( ! isset( $_POST['plugin'] ) ) {
			wp_send_json_error();
		}

		return sanitize_text_field(wp_unslash($_POST['plugin']));
	}

	/**
	 * Get Addon Status
	 *
	 * @return void
	 */
	public function get_extensions_status() {
		$this->checks_capability('edit_theme_options');
		$manager = new RishiCompanionExtensionsManager();

		$maybe_input = json_decode(file_get_contents('php://input'), true);

		$data = $manager->get_extensions([
			'forced_reread' => true
		]);

		if (
			$maybe_input
			&&
			isset($maybe_input['extension'])
			&&
			isset($maybe_input['extAction'])
		) {
			$ext_preboot = $manager->get($maybe_input['extension'], [
				'type' => 'preboot'
			]);

			if (method_exists(
				$ext_preboot, 'ext_action'
			)) {
				$result = $ext_preboot->ext_action($maybe_input['extAction']);

				if ($result) {
					$data[$maybe_input['extension']]['data'] = $result;
				}
			}
		}

		wp_send_json_success($data);
	}

	/**
	 * Get Addon Activate
	 *
	 * @return void
	 */
	public function get_extension_activate() {
		$this->checks_capability('edit_theme_options');
		$manager = new RishiCompanionExtensionsManager();
		$manager->activate_extension($this->get_extension_from_request());
		wp_send_json_success();
	}

	/**
	 * Get Addon Deactivate
	 *
	 * @return void
	 */
	public function get_extension_deactivate() {
		$this->checks_capability('edit_theme_options');
		$manager = new RishiCompanionExtensionsManager();

		$manager->deactivate_extension($this->get_extension_from_request());

		wp_send_json_success();
	}

	/**
	 * Get Addon Check
	 *
	 * @return void
	 */
	public function checks_capability( $cap = 'install_plugins' ) {
		$manager = new RishiCompanionExtensionsManager();

		if ( ! $manager->can( $cap ) ) {
			wp_send_json_error();
		}

		return true;
	}

	/**
	 * Get Addon Request
	 *
	 * @return void
	 */
	public function get_extension_from_request() {
		if ( ! isset( $_POST['ext'] ) ) {
			wp_send_json_error();
		}	

		return addslashes(sanitize_text_field( $_POST['ext'] ));
	}

	/**
	 * Get Addon Conditions
	 *
	 * @return void
	 */
	public function get_conditions_all_taxonomies() {
		if (! current_user_can('manage_options')) {
			wp_send_json_error();
		}

		$cpts = rishi__cb_customizer_manager()->post_types->get_supported_post_types();

		$cpts[] = 'post';
		$cpts[] = 'page';
		$cpts[] = 'product';

		$taxonomies = [];

		foreach ($cpts as $cpt) {
			$taxonomies = array_merge($taxonomies, array_values(array_diff(
				get_object_taxonomies($cpt),
				['post_format']
			)));
		}

		$terms = [];

		foreach ($taxonomies as $taxonomy) {
			$taxonomy_object = get_taxonomy($taxonomy);

			if (! $taxonomy_object->public) {
				continue;
			}

			$local_terms = array_map(function ($tax) {
				return [
					'id' => $tax->term_id,
					'name' => $tax->name
				];
			}, get_terms(['taxonomy' => $taxonomy, 'lang' => '']));

			if (empty($local_terms)) {
				continue;
			}

			$terms[] = [
				'id' => $taxonomy,
				'name' => $taxonomy,
				'group' => get_taxonomy($taxonomy)->label
			];

			$terms = array_merge($terms, $local_terms);
		}

		$languages = [];

		wp_send_json_success([
			'taxonomies' => $terms,
			'languages' => $languages
		]);
	}

	/**
	 * Get Addon Conditions
	 *
	 * @return void
	 */
	public function get_conditions_all_posts() {
		if (! current_user_can('manage_options')) {
			wp_send_json_error();
		}

		$maybe_input = json_decode(file_get_contents('php://input'), true);

		if (! $maybe_input) {
			wp_send_json_error();
		}

		if (! isset($maybe_input['post_type'])) {
			wp_send_json_error();
		}

		$query_args = [
			'posts_per_page' => -1,
			'post_type' => $maybe_input['post_type'],
			'suppress_filters' => true
		];

		if (
			isset($maybe_input['search_query'])
			&&
			! empty($maybe_input['search_query'])
		) {
			if (intval($maybe_input['search_query'])) {
				$query_args['p'] = intval($maybe_input['search_query']);
			} else {
				$query_args['s'] = $maybe_input['search_query'];
			}
		}

		if (strpos($query_args['post_type'], 'ct_cpt') !== false) {
			$query_args['post_type'] = array_diff(
				get_post_types(['public' => true]),
				['post', 'page', 'attachment', 'ct_content_block']
			);
		}

		$query = new \WP_Query($query_args);

		$posts_result = $query->posts;

		if (isset($maybe_input['alsoInclude'])) {
			$maybe_post = get_post($maybe_input['alsoInclude']);

			if ($maybe_post) {
				$posts_result[] = $maybe_post;
			}
		}

		wp_send_json_success([
			'posts' => $posts_result
		]);
	}

	/**
	 * Reset customizer AJAX.
	 *
	 * @return void
	 */
	public function get_customizer_reset()
	{
		global $wp_customize;

		if (!$wp_customize) {
			return;
		}

		if (!$wp_customize->is_preview()) {
			wp_send_json_error();
		}

		if (!check_ajax_referer('rara-customizer-reset', 'nonce', false)) {
			wp_send_json_error('nonce');
		}

		$settings = $wp_customize->settings();

		foreach ($settings as $single_setting) {
			if ('theme_mod' !== $single_setting->type) {
				if (
					$single_setting->id === 'woocommerce_thumbnail_cropping_custom_height'
					||
					$single_setting->id === 'woocommerce_thumbnail_cropping_custom_width'
					||
					$single_setting->id === 'woocommerce_thumbnail_cropping'
				) {
					delete_option($single_setting->id);
				}

				continue;
			}

			remove_theme_mod($single_setting->id);
		}

		do_action('rishi:dynamic-css:regenere_css_files');

		wp_send_json_success();
	}
}

new AjaxFunctions();
