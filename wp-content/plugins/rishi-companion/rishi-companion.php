<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://rishi.com/
 * @since             1.0.0
 * @package           Rishi
 *
 * @wordpress-plugin
 * Plugin Name:       Rishi Companion
 * Plugin URI:        https://rishitheme.com/rishi-companion/
 * Description:       Rishi companion is a plugin that offers powerful features for Rishi theme. It includes features to speed your website and tune fine your website.
 * Version:           1.2.2
 * Author:            Rishi Theme
 * Author URI:        https://rishitheme.com/
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       rishi-companion
 * Domain Path:       /languages
 */

use Rishi\Rishi_Companion;

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'RISHI_COMPANION_PLUGIN_FILE' ) ) {
	define( 'RISHI_COMPANION_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'RISHI_COMPANION_PLUGIN_DIR' ) ) {
	define( 'RISHI_COMPANION_PLUGIN_DIR', __DIR__ );
}

// Include the autoloader.
require_once __DIR__ . '/vendor/autoload.php';

// Include the upgrades.
require_once __DIR__ . '/includes/upgrade/110.php';
/**
 * Return the main instance of Rishi_Companion.
 *
 * @since 1.0.0
 * @return Rishi_Companion
 */
function RISHI_CMPN() {
	return Rishi_Companion::instance();
}

$GLOBALS['RSH_COMPANION'] = RISHI_CMPN();