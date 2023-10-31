<?php
/**
 * Version 1.1.0 upgrade script.
 * 
 * @package Rishi_Companion
 */

/**
  * Rishi Upgrader Class
  * @package Rishi
  * @subpackage Upgrader
  * @since 1.1.0
*/
class Rishi_Companion_Upgrade_110 {

    /**
     * Init Upgarde scriprs.
     */
    public static function init() {
        add_action( 'admin_init', array( __CLASS__, 'check_theme_status' ) );
    }

    /**
     * Check if Rishi Companion installed and activated.
     */
    public static function check_theme_status() {
        if ( defined( 'RISHI_VERSION' ) && version_compare( RISHI_VERSION, '1.1.0', '<' ) ) {
            add_action( 'admin_notices', array( __CLASS__, 'theme_notice' ) );
            deactivate_plugins( plugin_basename( RISHI_COMPANION_PLUGIN_FILE ) );
        }
    }

    /**
     * Theme notice.
     **/
    public static function theme_notice() {
        ?>
        <div class="notice notice-error">
            <p>
                <?php 
                    echo sprintf( 
                        /* translators: %1$s: Rishi Pro plugin name */
                        esc_html__( 'Rishi Companion does not support Rishi Theme v %1$s. %2$sPlease update Rishi Theme to the latest version%3$s from %4$s here %5$s.', 'rishi' ),
                        RISHI_VERSION,
                        '<b>',
                        '</b>',
                        sprintf(
                            '<a href="%s">',
                            admin_url( '/themes.php' )
                        ),
                        '</a>'
                    );
                ?>
            </p>
        </div>
        <?php
    }
}
$rishi_companion_upgrade_110 = new Rishi_Companion_Upgrade_110();
$rishi_companion_upgrade_110::init();
