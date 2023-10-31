<?php
/**
 * Version 1.1.0 upgrade script.
 * 
 * @package Rishi 
 */

/**
  * Rishi Upgrader Class
  * @package Rishi
  * @subpackage Upgrader
  * @since 1.1.0
*/
class Rishi_Upgrade_110 {

    /**
     * Init Upgarde scriprs.
     */
    public static function init() {
        add_action( 'admin_init', array( __CLASS__, 'check_companion_status' ) );
        add_action( 'admin_init', array( __CLASS__, 'check_pro_status' ) );
    }

    /**
     * Check if Rishi Companion installed and activated.
     */
    public static function check_companion_status() {
        if ( defined( 'RISHI_COMPANION_VERSION' ) && version_compare( RISHI_COMPANION_VERSION, '1.1.0', '<' ) ) {
            add_action( 'admin_notices', array( __CLASS__, 'companion_notice' ) );
            deactivate_plugins( plugin_basename( RISHI_COMPANION_PLUGIN_FILE ) );
        }
    }

    /**
     * Check if Rishi Pro installed and activated.
     */
    public static function check_pro_status() {
        if ( defined( 'RISI_PRO_VERSION' ) && version_compare( RISI_PRO_VERSION, '1.1.0', '<' ) ) {
            add_action( 'admin_notices', array( __CLASS__, 'pro_notice' ) );
            deactivate_plugins( plugin_basename( RISHI_PRO_PLUGIN_FILE ) );
        }
    }

    /**
     * Companion notice.
     **/
    public static function companion_notice() {
        ?>
        <div class="notice notice-error">
            <p>
                <?php 
                    echo sprintf( 
                        /* translators: %1$s: Rishi Companion plugin name */
                        esc_html__( 'Rishi Theme does not support Rishi Companion v %1$s. %2$sPlease update Rishi Companion plugin to the latest version%3$s from %4$s here %5$s.', 'rishi' ),
                        RISHI_COMPANION_VERSION,
                        '<b>',
                        '</b>',
                        sprintf(
                            '<a href="%s">',
                            admin_url( '/plugins.php' )
                        ),
                        '</a>'
                    );
                ?>
            </p>
        </div>
        <?php
    }

    /**
     * Pro notice.
     **/
    public static function pro_notice() {
        ?>
        <div class="notice notice-error">
            <p>
                <?php 
                    echo sprintf( 
                        /* translators: %1$s: Rishi Pro plugin name */
                        esc_html__( 'Rishi Theme does not support Rishi Pro v %1$s. %2$sPlease update Rishi Pro plugin to the latest version%3$s from %4$s here %5$s.', 'rishi' ),
                        RISHI_PRO_VERSION,
                        '<b>',
                        '</b>',
                        sprintf(
                            '<a href="%s">',
                            admin_url( '/plugins.php' )
                        ),
                        '</a>'
                    );
                ?>
            </p>
        </div>
        <?php
    }
}
$rishi_upgrade_110 = new Rishi_Upgrade_110();
$rishi_upgrade_110::init();
