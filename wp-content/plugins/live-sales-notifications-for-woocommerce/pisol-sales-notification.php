<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              piwebsolution.com
 * @since             2.2.41
 * @package           Pisol_Sales_Notification
 *
 * @wordpress-plugin
 * Plugin Name:       Live Sales Notifications for WooCommerce
 * Plugin URI:        https://www.piwebsolution.com/documentation-for-live-sales-notifications-for-woocommerce-plugin/
 * Description:       Showing live sales notification, encourages your visitors to buy from you as they can see how others are also buying from you
 * Version:           2.2.41
 * Author:            PI Websolution
 * Author URI:        piwebsolution.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pisol-sales-notification
 * Domain Path:       /languages
 * WC tested up to: 8.2.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/* 
    Making sure woocommerce is there 
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if(!is_plugin_active( 'woocommerce/woocommerce.php')){
    function pi_sales_notification_my_error_notice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'Please Install and Activate WooCommerce plugin, without that this plugin cant work.', 'pisol-sales-notification' ); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'pi_sales_notification_my_error_notice' );
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}

if(is_plugin_active( 'live-sales-notifications-for-woocommerce-pro/pisol-sales-notification.php')){
    function pi_sales_notification_my_pro_notice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'You have the PRO version of this plugin in your site.','pisol-sales-notification'); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'pi_sales_notification_my_pro_notice' );
    deactivate_plugins(plugin_basename(__FILE__));
    return;
}else{

define('PI_SALES_NOTIFICATION_BUY_URL', 'https://www.piwebsolution.com/product/live-sales-notifications-for-woocommerce/');
define('PI_SALES_NOTIFICATION_PRICE', '$19');
define('PI_SALES_NOTIFICATION_DELETE_SETTING', false);
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PISOL_SALES_NOTIFICATION_VERSION', '2.2.41' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pisol-sales-notification-activator.php
 */
function activate_pisol_sales_notification() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pisol-sales-notification-activator.php';
	Pisol_Sales_Notification_Activator::activate();
}

/**
 * Declare compatible with HPOS new order table 
 */
add_action( 'before_woocommerce_init', function() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
} );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pisol-sales-notification-deactivator.php
 */
function deactivate_pisol_sales_notification() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pisol-sales-notification-deactivator.php';
	Pisol_Sales_Notification_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pisol_sales_notification' );
register_deactivation_hook( __FILE__, 'deactivate_pisol_sales_notification' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pisol-sales-notification.php';

function pisol_lsnw_plugin_link( $links ) {
	$links = array_merge( array(
        '<a href="' . admin_url( '/admin.php?page=pisol-sales-notification' )  . '">' . __( 'Settings','pisol-sales-notification' ) . '</a>',
        '<a style="color:#0a9a3e; font-weight:bold;" target="_blank" href="' . esc_url(PI_SALES_NOTIFICATION_BUY_URL) . '">' . __( 'Buy PRO Version','pisol-sales-notification' ) . '</a>'
	), $links );
	return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'pisol_lsnw_plugin_link' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pisol_sales_notification() {

	$plugin = new Pisol_Sales_Notification();
	$plugin->run();

}
run_pisol_sales_notification();

}