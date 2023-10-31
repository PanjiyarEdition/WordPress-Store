<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Pisol_Sales_Notification
 * @subpackage Pisol_Sales_Notification/includes
 */
class Pisol_Sales_Notification {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pisol_Sales_Notification_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;


	public function __construct() {
		if ( defined( 'PISOL_SALES_NOTIFICATION_VERSION' ) ) {
			$this->version = PISOL_SALES_NOTIFICATION_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'pisol-sales-notification';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}


	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pisol-sales-notification-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pisol-sales-notification-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/includes.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-pisol-sales-notification-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-pisol-sales-notification-public.php';

		$this->loader = new Pisol_Sales_Notification_Loader();

	}


	private function set_locale() {

		$plugin_i18n = new Pisol_Sales_Notification_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}


	private function define_admin_hooks() {

		$plugin_admin = new Pisol_Sales_Notification_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}


	private function define_public_hooks() {

		$plugin_public = new Pisol_Sales_Notification_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}


	public function run() {
		$this->loader->run();
	}


	public function get_plugin_name() {
		return $this->plugin_name;
	}


	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
