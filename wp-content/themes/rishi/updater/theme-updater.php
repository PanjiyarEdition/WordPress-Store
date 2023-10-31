<?php
/**
 * Easy Digital Downloads Theme Updater
 *
 * @package Rishi
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://rishitheme.com', // Site where EDD is hosted
		'item_name'      => 'Rishi', // Name of theme
		'theme_slug'     => 'rishi', // Theme slug
		'version'        => '1.2.2', // The current version of this theme
		'author'         => 'Rishi Theme', // The author of this theme
		'download_id'    => '1195', // Optional, used for generating a license renewal link
		'renew_url'      => '', // Optional, allows for a custom license renewal link
		'beta'           => false, // Optional, set to true to opt into beta versions
		'item_id'        => '',
	),

	// Strings
	$strings = array(
		'theme-license'             => __( 'Getting Started', 'rishi' ),
		'enter-key'                 => __( 'Enter your theme license key.', 'rishi' ),
		'license-key'               => __( 'License Key', 'rishi' ),
		'license-action'            => __( 'License Action', 'rishi' ),
		'deactivate-license'        => __( 'Deactivate License', 'rishi' ),
		'activate-license'          => __( 'Activate License', 'rishi' ),
		'status-unknown'            => __( 'License status is unknown.', 'rishi' ),
		'renew'                     => __( 'Renew?', 'rishi' ),
		'unlimited'                 => __( 'unlimited', 'rishi' ),
		'license-key-is-active'     => __( 'License key is active.', 'rishi' ),
		'expires%s'                 => __( 'Expires %s.', 'rishi' ),
		'expires-never'             => __( 'Lifetime License.', 'rishi' ),
		'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'rishi' ),
		'license-key-expired-%s'    => __( 'License key expired %s.', 'rishi' ),
		'license-key-expired'       => __( 'License key has expired.', 'rishi' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'rishi' ),
		'license-is-inactive'       => __( 'License is inactive.', 'rishi' ),
		'license-key-is-disabled'   => __( 'License key is disabled.', 'rishi' ),
		'site-is-inactive'          => __( 'Site is inactive.', 'rishi' ),
		'license-status-unknown'    => __( 'License status is unknown.', 'rishi' ),
		'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'rishi' ),
		'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'rishi' ),
	)

);

add_action( 'wp_ajax_rishi_activate_license_updates', function () use ( $updater ) {
	if ( ! isset ( $_POST['nonceToken'] ) || ! wp_verify_nonce( $_POST['nonceToken'], 'rishi-theme-activate-license' ) ) {
		wp_send_json_error( __( 'Nonce verification failed', 'rishi' ) );
	}

	$license_data = $updater->activate_license();

	if ( isset( $license_data['status'] ) && $license_data['status'] ) {
		wp_send_json_success( $license_data );
	} else {
		wp_send_json_error( $license_data );
	}
} );
