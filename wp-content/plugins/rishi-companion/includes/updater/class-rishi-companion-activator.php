<?php
/**
 * Rishi Companion Activator Class
 * 
 * @package Rishi_Companion
 */
namespace Rishi;

/**
 * Activator Class
 */
class Rishi_Companion_Activator {

    /**
     * Download ID
     *
     * @var integer
     */
    private $download_id = 121222;

    /**
	 * EDD API URL
	 *
	 * @var string
	 */
	//TODO: Update this with live API URL
	private $edd_api_url = 'https://rishitheme.com/';

    /**
	 * Plugin Slug
	 *
	 * @var string
	 */
	private $plugin_slug = 'rishi-companion/rishi-companion.php';

    public function __construct() {
		add_action( 'admin_init', [ $this, 'initialize_updater' ] );
		add_action('after_plugin_row_' . plugin_basename(RISHI_COMPANION_PLUGIN_FILE), [$this, 'show_activation_form'], 10, 3);

		add_filter( 'plugin_action_links_' . plugin_basename( RISHI_COMPANION_PLUGIN_FILE ), array( $this, 'add_action_links' ) );

		add_filter( 'network_admin_plugin_action_links_' . plugin_basename( RISHI_COMPANION_PLUGIN_FILE ), array( $this, 'add_action_links' ) );

		add_action( 'admin_enqueue_scripts', [$this, 'add_updater_scripts'] );

		add_action( 'wp_ajax_rishi_cmp_activate_license_fromplgns', function() {
			$verify_nonce = \wp_verify_nonce( $_POST['nonce'], 'rishi_companion_licact' );
			if ( ! $verify_nonce ) {
				wp_send_json_error( [ 'message' => __( 'Nonce Verification failed', 'rishi-companion' ) ] );
			}
			$license_key = isset( $_POST['license_key'] ) ? $_POST['license_key'] : '';

			if ( empty( $license_key ) ) {
				wp_send_json_error( [ 'message' => __( 'Empty License', 'rishi-companion' ) ] );
			}

			( new Rishi_Companion_Activator )->activate_license( $license_key );
		} );

		add_action( 'wp_ajax_rishi_cmp_deactivate_license_fromplgns', function() {
			$verify_nonce = \wp_verify_nonce( $_POST['nonce'], 'rishi_companion_licdeact' );
			if ( ! $verify_nonce ) {
				wp_send_json_error( [ 'message' => __( 'Nonce Verification failed', 'rishi-companion' ) ] );
			}
			$license_key = isset( $_POST['license_key'] ) ? $_POST['license_key'] : '';

			if ( empty( $license_key ) ) {
				wp_send_json_error( [ 'message' => __( 'Empty License', 'rishi-companion' ) ] );
			}

			( new Rishi_Companion_Activator )->deactivate_license( $license_key );
		} );
    }

	/**
	 * Add a link to the settings page to the plugins list
	 *
	 * @param array $links array of links for the plugins, adapted when the current plugin is found.
	 *
	 * @return array $links
	 */
	public function add_action_links( $links ) {
		$license_status = $this->check_license();

		// License activation status.
		if ( $license_status['status'] === 'valid' ) {
			$new_links = [
				'licmessage' => '<p style="font-weight:700; color: #1da867;">' . esc_html__( 'License Activated', 'rishi-companion' ) . '</p>',
				'deactivateMessage' => '<a class="shSpinr" data-nonce="'. wp_create_nonce( 'rishi_companion_licdeact' ) .'" href="' . esc_url( $this->edd_api_url . '?edd_action=deactivate_license&item_id='. $this->download_id .'&license='. $license_status['license_key'] .'&url=' . home_url() ) . '" style="color: #b32d2e;" target="_blank"> '. esc_html__( 'Deactivate License', 'rishi-companion' ) .' </a>'
			];

			$links = array_merge( $new_links, $links );
		}

		return $links;
	}

	public function add_updater_scripts($hook) {
		if ( 'plugins.php' !== $hook ) {
			return;
		}
		$updater_deps = include_once plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/updaterLic.asset.php';

		wp_enqueue_script( 'rishi-companion-updaterLic', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/updaterLic.js', $updater_deps['dependencies'], $updater_deps['version'], true );

		wp_enqueue_style( 'rishi-companion-updaterLic', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/updaterLic.css' );
	}

	/**
	 * Activation form for license.
	 */
	public function show_activation_form() {
		$license_status = $this->check_license();
		$lic_clazz = 'update-message notice inline notice-warning notice-alt';
		$lic_message = __( 'Enter License key to recieve updates for Rishi Companion', 'rishi-companion' );
		if ( $license_status['status'] === 'valid' ) {
			return;
		} 
		echo '<td colspan="4">
					<div id="rsh-msgned" style="padding: 15px;" class="'. esc_attr( $lic_clazz ) .'">
						<p><form action="get" className="licform">
							<label for="rishi-cmp-license-key">'. esc_html($lic_message) .'</label>
							<input id="rishi-cmp-license-key" class="widefat" type="text" placeholder="License Key" />
							<button data-nonce="'. wp_create_nonce( 'rishi_companion_licact' ) .'" id="rishi-cmp-activatelic" class="button button-primary">Activate License</button>
						</form></p>
					</div>
				</td>';
	}

	/**
	 * Check License Status.
	 *
	 * @return void
	 */
	public function check_license() {
		$verify_ssl      = $this->verify_ssl();
		$license_options = get_option( 'rishi_companion_license', array() );

		if ( empty( $license_options ) ) {
			$license_details = array(
				'message' => '',
				'status'  => '',
				'license_key' => ''
			);
			return $license_details;
		}

		// Strings
		$strings = array(
			'theme-license'             => __( 'Getting Started', 'rishi-pro' ),
			'enter-key'                 => __( 'Enter your theme license key.', 'rishi-pro' ),
			'license-key'               => __( 'License Key', 'rishi-pro' ),
			'license-action'            => __( 'License Action', 'rishi-pro' ),
			'deactivate-license'        => __( 'Deactivate License', 'rishi-pro' ),
			'activate-license'          => __( 'Activate License', 'rishi-pro' ),
			'status-unknown'            => __( 'License status is unknown.', 'rishi-pro' ),
			'renew'                     => __( 'Renew?', 'rishi-pro' ),
			'unlimited'                 => __( 'unlimited', 'rishi-pro' ),
			'license-key-is-active'     => __( 'License key is active.', 'rishi-pro' ),
			'expires%s'                 => __( 'Expires %s.', 'rishi-pro' ),
			'expires-never'             => __( 'Lifetime License.', 'rishi-pro' ),
			'%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'rishi-pro' ),
			'license-key-expired-%s'    => __( 'License key expired %s.', 'rishi-pro' ),
			'license-key-expired'       => __( 'License key has expired.', 'rishi-pro' ),
			'license-keys-do-not-match' => __( 'License keys do not match.', 'rishi-pro' ),
			'license-is-inactive'       => __( 'License is inactive.', 'rishi-pro' ),
			'license-key-is-disabled'   => __( 'License key is disabled.', 'rishi-pro' ),
			'site-is-inactive'          => __( 'Site is inactive.', 'rishi-pro' ),
			'license-status-unknown'    => __( 'License status is unknown.', 'rishi-pro' ),
			'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'rishi-pro' ),
			'update-available'          => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4$s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'rishi-pro' ),
		);

		$license_status = [
			'status' => '',
			'message' => ''
		];

		$response = wp_remote_post(
			$this->edd_api_url,
			array(
				'timeout'   => 15,
				'sslverify' => $verify_ssl,
				'body'      => array(
					'edd_action' => 'check_license',
					'license'    => isset( $license_options['license_key'] ) ? $license_options['license_key'] : '',
					'item_id'    => $this->download_id,
					'version'    => RISHI_COMPANION_VERSION,
					'slug'       => 'rishi-companion',
					'author'  => __( 'Rishi Theme', 'rishi-pro' ), // author of this plugin
					'url'        => home_url(),
					'beta'       => false,
				),
			)
		);
		// make sure the response came back okay
		if ( ! is_wp_error( $response ) && 200 == wp_remote_retrieve_response_code( $response ) ) {

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// If response doesn't include license data, return
			if ( !isset( $license_data->license ) ) {
				$message = $strings['license-status-unknown'];
				return $message;
			}

			// Get expire date
			$expires = false;
			if ( isset( $license_data->expires ) && 'lifetime' != $license_data->expires ) {
				$expires = date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) );
				$renew_link = '<a href="' . esc_url( $this->get_renewal_link() ) . '" target="_blank">' . $strings['renew'] . '</a>';
			} elseif ( isset( $license_data->expires ) && 'lifetime' == $license_data->expires ) {
				$expires = 'lifetime';
			}

			// Get site counts
			$site_count = isset( $license_data->site_count ) ? $license_data->site_count : '';
			$license_limit = isset( $license_data->license_limit ) ? $license_data->license_limit : '';

			// If unlimited
			if ( 0 == $license_limit ) {
				$license_limit = $strings['unlimited'];
			}

			if ( $license_data->license == 'valid' ) {
				$message = $strings['license-key-is-active'] . ' ';
				if ( isset( $expires ) && 'lifetime' != $expires ) {
					$message .= sprintf( $strings['expires%s'], $expires ) . ' ';
				}
				if ( isset( $expires ) && 'lifetime' == $expires ) {
					$message .= $strings['expires-never'];
				}
				if ( $site_count && $license_limit ) {
					$message .= sprintf( $strings['%1$s/%2$-sites'], $site_count, $license_limit );
				}
			} else if ( $license_data->license == 'expired' ) {
				if ( $expires ) {
					$message = sprintf( $strings['license-key-expired-%s'], $expires );
				} else {
					$message = $strings['license-key-expired'];
				}
				if ( $renew_link ) {
					$message .= ' ' . $renew_link;
				}
			} else if ( $license_data->license == 'invalid' ) {
				$message = $strings['license-keys-do-not-match'];
			} else if ( $license_data->license == 'inactive' ) {
				$message = $strings['license-is-inactive'];
			} else if ( $license_data->license == 'disabled' ) {
				$message = $strings['license-key-is-disabled'];
			} else if ( $license_data->license == 'site_inactive' ) {
				// Site is inactive
				$message = $strings['site-is-inactive'];
			} else {
				$message = $strings['license-status-unknown'];
			}

			$license_status['status']  = $license_data->license;
			$license_status['message'] = $message;
			$license_status['license_key'] = $license_options['license_key'];
		}
	
		return $license_status;
	}

	/**
	 * Constructs a renewal link
	 *
	 * @since 1.0.0
	 */
	public function get_renewal_link() {
		// Otherwise return the remote_api_url
		return $this->edd_api_url;

	}

	/**
     * Initialize EDD.
     *
     * @return void
     */
    public function initialize_updater() {

        if ( ! current_user_can( 'manage_options' ) ) return;

		$rishi_companion_license = get_option( 'rishi_companion_license', [] );

		if ( ! isset( $rishi_companion_license['license_key'] ) || empty( $rishi_companion_license['license_key'] ) ) return;

        // setup the updater
        $edd_updater = new \EDD_SL_Plugin_Updater(
            $this->edd_api_url, 
            RISHI_COMPANION_PLUGIN_FILE,
            array(
                'version' => RISHI_COMPANION_VERSION, // current version number
                'license' => $rishi_companion_license['license_key'], // license key (used get_option above to retrieve from DB)
                'item_id' => $this->download_id, // ID of the product
                'author'  => __( 'Rishi Theme', 'rishi-pro' ), // author of this plugin
                'beta'    => false,
            )
        );
    }

    /**
     * Activates license by key
     * @param string $license The license Key
     */
    public function activate_license( string $license_key ) {

        // $license_data = get_option( 'rishi_companion_license', [] );
        // $license_key  = isset( $license_data['license_key'] ) ? $license_data['license_key'] : $license_key;
		$message = '';
		// data to send in our API request
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license_key,
			'item_id'    => $this->download_id, // The ID of the item in EDD
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post(
			$this->edd_api_url,
			array(
				'timeout'   => 15,
				'sslverify' => $this->verify_ssl(),
				'body'      => $api_params,
			)
		);

		
		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			
			$message = ( is_wp_error( $response ) && ( $response->get_error_message() ) != '' ) ? $response->get_error_message() : __( 'An error occurred, please try again.', 'rishi-pro' );
		
		} else {

			$license_response_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( ! $license_response_data->success ) {
				$message = $this->response_messages( $license_response_data->error, $license_response_data );
			}
		}

		if ( isset( $license_response_data->license ) ) {
			$license_data['license_status'] = $license_response_data->license;
			$license_data['license_key'] = $license_key;
			update_option( 'rishi_companion_license', $license_data );
		}
		// Check if anything passed on a message constituting a failure
		if ( ! empty( $message ) && defined('DOING_AJAX') && DOING_AJAX ) {
			wp_send_json_error([ 'license_activation_error' => $message ]);
		}elseif(defined('DOING_AJAX') && DOING_AJAX) {
			wp_send_json_success([ 'activated_license' => true ]);
		} elseif( ! empty( $message ) ) {
			error_log( print_r([ 'license_activation_error' => $message ]) );
		}
    }

	 /**
     * Deactivates license by key
     * @param string $license The license Key
     */
	public function deactivate_license(string $license_key) {

		// if ( isset( $_POST['edd_license_deactivate'] ) ) {
			// run a quick security check
			// if ( ! check_ajax_referer( 'rishi_pro_license_nonce' ) ) {
			// 	return;
			// }
	
			// $license_data = get_option( 'rishi_pro_license', [] );
			// $license_key  = isset( $license_data['license_key'] ) ? $license_data['license_key'] : '';
	
			// data to send in our API request
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license'    => $license_key,
				'item_id'    => $this->download_id, // The ID of the item in EDD
				'url'        => home_url(),
			);
	
			// Call the custom API.
			$response = wp_remote_post(
				$this->edd_api_url,
				array(
					'timeout'   => 15,
					'sslverify' => $this->verify_ssl(),
					'body'      => $api_params,
				)
			);
	
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
				$message = ( is_wp_error( $response ) && ( $response->get_error_message() ) != '' ) ? $response->get_error_message() : __( 'An error occurred, please try again.', 'rishi-pro' );
				wp_send_json_error( [ 'message' => $message ] );
			} else {
				$response = json_decode( wp_remote_retrieve_body( $response ) );
			}
	
			wp_send_json_success( [ 'license' => $license_key, 'status' => $this->check_license() ] );
			exit();
		// }

	}

	/**
	 * Get Response messages
	 *
	 * @return void
	 */
	function response_messages( $code, $response= null ) {
		switch ( $code ) {
			case 'expired':
				$message = sprintf(
					__( 'Your license for %1$s extension expired on %2$s. To ensure you get features and security updates, having an active license is strongly recommended, and in some cases required.', 'rishi-pro' ),
					$response->item_name,
					wp_date( get_option( 'date_format' ), strtotime( $response->expires, current_time( 'timestamp' ) ) )
				);
				break;
	
			case 'disabled':
			case 'revoked':
				$message = __( 'Your license key has been disabled.', 'rishi-pro' );
				break;
	
			case 'missing':
				$message = __( 'Invalid license key supplied. Please check if you have entered correct license key.', 'rishi-pro' );
				break;
	
			case 'invalid':
			case 'site_inactive':
				$message = __( 'Your license is not active for this URL.', 'rishi-pro' );
				break;
	
			case 'item_name_mismatch':
				$message = sprintf( __( 'This appears to be an invalid license key for %s.', 'rishi-pro' ), EDD_SAMPLE_ITEM_NAME );
				break;
	
			case 'no_activations_left':
				$message = __( 'Your license key has reached its activation limit.', 'rishi-pro' );
				break;
	
			default:
				$message = __( 'An error occurred, please try again.', 'rishi-pro' );
				break;
		}
	
		return $message;
	}

	/**
	 * Should verify ssl or not.
	 *
	 * @return bool
	 * @since 5.0.0
	 */
	public function verify_ssl() {
		return (bool) apply_filters( 'edd_sl_api_request_verify_ssl', true );
	}
}