<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       piwebsolution.com
 * @since      1.0.0
 *
 * @package    Pisol_Sales_Notification
 * @subpackage Pisol_Sales_Notification/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pisol_Sales_Notification
 * @subpackage Pisol_Sales_Notification/admin
 * @author     Rajesh Singh <rajeshsingh520@gmail.com>
 */
class Pisol_Sales_Notification_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		new Pi_Sales_Menu($this->plugin_name, $this->version);

		add_action('admin_init', array($this,'plugin_redirect'));
	}

	function plugin_redirect(){
		if (get_option('pi_sales_notification_do_activation_redirect', false)) {
			delete_option('pi_sales_notification_do_activation_redirect');
			if(!isset($_GET['activate-multi']))
			{
				wp_redirect("admin.php?page=pisol-sales-notification");
			}
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

	

		

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

	
		
		
	}

}
