<?php
/**
 * Main Rishi_Companion class
 *
 * @package Rishi_Companion
 */
namespace Rishi;

defined( 'ABSPATH' ) || exit;

/**
 * Main Rishi_Companion Cass.
 *
 * @class Rishi_Companion
 */
final class Rishi_Companion {
    /**
     * Rishi_Companion verison.
     *
     * @var string
     */
    public $version = '1.2.2';

    /**
     * The single instance of the class.
     *
     * @var Rishi_Companion
     * @since 1.0.0
     */
    protected static $_instance = null;

    /**
     * Rishi extensions manager.
     *
     * @var ExtensionsManager
     */
    /**
     * Main Rishi_Companion Instance.
     *
     * Ensures only one instance of Rishi_Companion is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see RISHI_CMPN()
     * @return Rishi_Companion - Main instance.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Rishi_Companion Constructor.
     */
    public function __construct() {

        // $screen = $this->get_current_screen();

        $this->_defineConstants();
        $this->includes();
        $this->activate();

        $this->admin_settings       = new Rishi_Companion_Admin();
        $this->public_settings      = new Rishi_Companion_Public();
        $this->header_manager       = new RishiCompanionHeaderAdditions();

        if( $this->meets_requirements() ) {
            $this->font_sources         = new \RishiCompanionFontSources();
        }
        if( $this->meets_requirements() ) Hooks_Buffer::init();

        if ( is_admin() && $this->meets_requirements() ) {
            $this->updater = new Rishi_Companion_Activator();
        }

        add_action( 'admin_notices', [ $this, 'maybe_disable_plugin' ] );
        /**
         * Note to dev: Addded this to load extension manager after filter hook is called.
         *
         * @support for Rishi Pro.
         */
        add_action( 'plugins_loaded', [$this, 'load_extensions_maneger']);
    }

    /**
     * Load Extension Manager
     *
     * @return void
     */
    public function load_extensions_maneger() {
		$this->extensions_manager   = new RishiCompanionExtensionsManager();

        //Adding compatibility for Web Stories Plugin
        require plugin_dir_path( __FILE__ ) . 'compatibility/web-stories/WebStories.php';
	}

    /**
     * Activation hook for WP Appointment plugin.
     *
     * @return void
     */
    public function activate()
    {
        register_activation_hook( RISHI_COMPANION_PLUGIN_FILE, function() {
            $license_file = plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) . "purchased_license.php";
            if ( file_exists ( $license_file ) ) {
                $license_key = file_get_contents ( $license_file );
                if ( class_exists('Rishi\Rishi_Companion_Activator') ) {
                    ( new Rishi_Companion_Activator )->activate_license( $license_key );
                }
                unlink ( $license_file );
            }
        } );
    }

    /**
     * When WP has loaded all plugins, trigger the 'Rishi_Companions_loaded; hook.
     *
     * This ensures 'Rishi_Companions_loaded' is called only after all the other plugins
     * are loaded, to avoid issues caused by plugin directory naming changing
     * the load order.
     *
     * @since 1.0.0
     * @access public
     */
    public function onPluginLoaded()
    {
        do_action('Rishi_Companions_loaded');
    }

    /**
     * Define WTE_FORM_EDITOR Constants.
     *
     * @since 1.0.0
     * @access private
     */
    private function _defineConstants() {
        $this->define('RISHI_COMPANION_PLUGIN_NAME', 'rishi-companion');
        $this->define('RISHI_COMPANION_ABSPATH', dirname(RISHI_COMPANION_PLUGIN_FILE) . '/');
        $this->define('RISHI_COMPANION_VERSION', $this->version);
        $this->define('RISHI_COMPANION_PLUGIN_URL', $this->plugin_url());
    }

    /**
     * Define constant if not already set.
     *
     * @param string      $name       Constant name.
     * @param string|bool $value      Constant value.
     * @return void
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     * Include required files.
     *
     * @return void
     */
    public function includes() {
        // TODO: Add theme activation checks when theme is live.
        if ($this->meets_requirements()) {
            if ( ! class_exists( 'EDD_SL_Plugin_Updater' ) ) {
                require plugin_dir_path( __FILE__ ) . 'updater/EDD_SL_Plugin_Updater.php';
            }
            require plugin_dir_path( __FILE__ ) . 'updater/class-rishi-companion-activator.php';
            require plugin_dir_path( __FILE__ ) . 'classes/class-local-font-loader.php';
            require plugin_dir_path( __FILE__ ) . 'classes/class-hooks-buffer.php';
            require plugin_dir_path( __FILE__ ) . 'classes/class-companion-font-sources.php';
            /**
             * Dynamic Blocks renders.
             *
             * @since 1.1.6
             */
            require plugin_dir_path( __FILE__ ) . 'blocks/blocks.php';
        }
    }

    /**
     * Init Rishi_Companion when WordPress initializes.
     *
     * @since 1.0.0
     * @access public
     */
    public function init()
    {
        // Set up localization.
        $this->loadPluginTextdomain();
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since 1.0.0
     *
     * Note: the first-loaded translation file overrides any following ones -
     * - if the same translation is present.
     *
     * Locales found in:
     *      - WP_LANG_DIR/rishi-companion/rishi-companion-LOCALE.mo
     *      - WP_LANG_DIR/plugins/rishi-companion-LOCALE.mo
     */
    public function loadPluginTextdomain()
    {
        if (function_exists('determine_locale')) {
            $locale = determine_locale();
        } else {
            $locale = is_admin() ? get_user_locale() : get_locale();
        }

        $locale = apply_filters( 'plugin_locale', $locale, 'rishi-companion' );

        unload_textdomain( 'rishi-companion' );
        load_textdomain( 'rishi-companion', WP_LANG_DIR . '/rishi-companion/rishi-companion-' . $locale . '.mo' );
        load_plugin_textdomain(
            'rishi-companion',
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );
    }

    /**
     * Get the plugin URL.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string
     */
    public function plugin_url() {
        return untrailingslashit( plugins_url( '/', RISHI_COMPANION_PLUGIN_FILE ) );
    }

    /**
     * Get the plugin path.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string
     */
    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) );
    }

    /**
     * Output error message and disable plugin if requirements are not met.
     *
     * This fires on admin_notices.
     *
     * @since 1.0.0
     */
    public function maybe_disable_plugin() {

        if ( ! $this->meets_requirements() ) {
            // Note to reviewer: Currently added public wetransfer link as theme is not live yet.
            echo '<div class="error"><p>';
            echo wp_kses_post( sprintf( __( '%1$sRishi Companion plugin%2$s requires %3$sRishi Theme%4$s to be installed and activated to work properly. Please %5$sinstall and activate%6$s the theme to use the plugin.', 'rishi-companion' ), '<b>', '</b>', '<a target="_blank" href="https://rishitheme.com/">', '</a>', '<a target="_blank" href="https://rishitheme.com/">', '</a>' ) );
			echo '</p></div>';
        }
    }

    /**
     * Check if all plugin requirements are met.
     *
     * @since 1.0.0
     *
     * @return bool True if requirements are met, otherwise false.
     */
    private function meets_requirements() {
        $theme = apply_filters('rishi__cb_customizer_get_wp_theme', wp_get_theme(get_template()));
        return $theme->exists() && 'Rishi' === $theme->get('Name');
    }

}
