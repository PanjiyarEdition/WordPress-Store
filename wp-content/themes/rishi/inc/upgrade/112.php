<?php
/**
 * Version 1.1.2 upgrade script.
 * 
 * @package Rishi 
 */
/**
  * Rishi Upgrader Class
  * @package Rishi
  * @subpackage Upgrader
  * @since 1.1.0
*/
class Rishi_Upgrade_112 {

    /**
     * Init Upgarde scriprs.
     */
    public static function init() {
        add_action( 'admin_init', array( __CLASS__, 'check_pro_status' ) );
    }

    /**
     * Check if Rishi Pro installed and activated.
     */
    public static function check_pro_status() {
        if ( defined( 'RISHI_PRO_VERSION' ) && version_compare( RISHI_PRO_VERSION, '1.1.2', '<' ) ) {
            add_action( 'admin_notices', array( __CLASS__, 'pro_notice' ) );
            deactivate_plugins( plugin_basename( RISHI_PRO_PLUGIN_FILE ) );
        }
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
                        esc_html__( 'You have Rishi Pro v %1$s installed which is not compatible with the latest update of Rishi Theme. %2$sPlease update Rishi Pro plugin to the latest version %3$s from %4$s here %5$s to enjoy all the latest features and enhancements.', 'rishi' ),
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
$rishi_upgrade_112 = new Rishi_Upgrade_112();
$rishi_upgrade_112::init();
