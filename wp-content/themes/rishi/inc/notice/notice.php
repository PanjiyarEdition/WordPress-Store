<?php 
/**
 * Rishi Admin Notices
 *
 * @package Rishi
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if( ! class_exists( 'Rishi_Admin_Notices' ) ) :

    /**
    * Rishi Admin Notices
    */
    class Rishi_Admin_Notices {
        /**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
        public function __construct() {
			add_action( 'admin_notices', array( $this, 'output_companion_notice' ), 99 );

			add_action( 'admin_notices', array( $this, 'output_theme_activation_notice'), 99  );

			add_action( 'wp_ajax_rishi__cb_customizer_dismissed_notice_handler', array( $this, 'ignore_admin_notice' ) );
			
			add_action( 'wp_ajax_rishi__cb_customizer_notice_button_click', array( $this, 'notice_button_click_handler' ) );
        }
		
		/**
		 * Undocumented function
		 *
		 * @return void
		 */
		function notice_button_click_handler() {
			if (! current_user_can('activate_plugins') ) return;

			$manager = new Rishi_Plugin_Manager();
			$status_descriptor = $manager->get_companion_status();

			if ($status_descriptor['status'] === 'active') {
				wp_send_json_success([
					'status' => 'active',
					'pluginUrl' => admin_url('admin.php?page=rt-dashboard')
				]);
			}

			if ($status_descriptor['status'] === 'uninstalled') {
				$manager->download_and_install($status_descriptor['slug']);
				$manager->plugin_activation($status_descriptor['slug']);

				wp_send_json_success([
					'status' => 'active',
					'pluginUrl' => admin_url('admin.php?page=rishi-dashboard')
				]);
			}

			if ($status_descriptor['status'] === 'installed') {
				$manager->plugin_activation($status_descriptor['slug']);

				wp_send_json_success([
					'status' => 'active',
					'pluginUrl' => admin_url('admin.php?page=rt-dashboard')
				]);
			}

		}

		function output_companion_notice() {
			if (! apply_filters(
				'rishi:admin:display-companion-plugin-notice',
				true
			)) {
				return;
			}
		
			if (! current_user_can('activate_plugins') ) return;

			if (get_option('dismissed-rishi_plugin_notice', false)) return;
		
			$manager = new Rishi_Plugin_Manager();
			$status = $manager->get_companion_status()['status'];

			// $status = 'inactive';
		
			if ($status === 'active') return;
		
			$plugin_url  = admin_url('admin.php?page=rishi-dashboard');
			$plugin_link = admin_url('themes.php?page=tgmpa-install-plugins&plugin_status=install');
		
			echo '<div class="notice notice-rishi-plugin">';
			echo '<div class="notice-rishi-plugin-root" data-url="' . esc_attr($plugin_link) . '" data-plugin-url="' . esc_attr($plugin_url) . '" data-plugin-status="' . esc_attr($status) . '" data-link="' . esc_attr($plugin_link) . '">';
		
			echo '</div>';
			echo '</div>';
		}

		/**
		 * Outputs the admin notice for the theme activator.
		 *
		 * @return void
		 */
		function output_theme_activation_notice() {
		
			if (! current_user_can('manage_options') ) return;

			$license_status = get_option( 'rishi_license_key_status', 'site_inactive' );

			$admin_redirect_url = admin_url('themes.php?page=rishi-dashboard');

			if ( $license_status === 'valid' ) return;
		
			echo '<div class="notice notice-rishi-theme-activation">';
			echo '<div class="notice-rishi-theme-activation-root" style="padding:10px;" data-nonce="' . wp_create_nonce( 'rishi-theme-activate-license' ) .'" data-link="'. esc_url( $admin_redirect_url ) .'">';
		
			echo '</div>';
			echo '</div>';
		}

		/**
		 * ignore notice
		 */
		function ignore_admin_notice() {
			update_option( 'dismissed-rishi_plugin_notice', 'true' );
		}

    }
    

endif;

return new Rishi_Admin_Notices();
