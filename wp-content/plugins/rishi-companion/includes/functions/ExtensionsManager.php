<?php
/**
* RishiCompanionExtensionsManager class
*
* @package Rishi_Companion
*/
namespace Rishi;

defined( 'ABSPATH' ) || exit;
/**
 * Extensions Manager Class
 * 
 * @package Rishi_Companion
 */
class RishiCompanionExtensionsManager {
    /**
     * Collection of all the activated extensions.
     *
     * @var array The array of all the extension objects.
     */
    private  $extensions = array() ;

    /**
     * Get Option name - db
     *
     * @return void
     */
    private function get_option_name() {
        return 'rc_active_extensions';
    }

    /**
     * Settings Getter
     *
     * @param [type] $id
     * @param array $args
     * @return void
     */
    public function get( $id, $args = array() ) {
        $args = wp_parse_args( $args, [
            'type' => 'regular',
        ] );
        if ( !isset( $this->extensions[$id] ) ) {
            return null;
        }
        
        if ( $args['type'] === 'preboot' ) {
            if ( !isset( $this->extensions[$id]['__object_preboot'] ) ) {
                return null;
            }
            return $this->extensions[$id]['__object_preboot'];
        }
        
        if ( !isset( $this->extensions[$id]['__object'] ) ) {
            return null;
        }
        return $this->extensions[$id]['__object'];
    }
    
    /**
     * Collect all available extensions and activate the ones that have to be so.
     */
    public function __construct() {
        $this->read_installed_extensions();
        
        if ( $this->is_dashboard_page() ) {
            $this->do_extensions_preboot();
        }
        foreach ( $this->get_activated_extensions() as $single_id ) {
            $this->boot_activated_extension_for( $single_id );
        }
        
        add_action( 'activate_rishi-companion/rishi-companion.php', [ $this, 'handle_activation' ], 11 );
        add_action( 'deactivate_rishi-companion/rishi-companion.php', [ $this, 'handle_deactivation' ], 11 );
    }
    
    /**
     * Handle Extension activation
     *
     * @return void
     */
    public function handle_activation() {
        ob_start();
            foreach ( $this->get_activated_extensions() as $id ) {
                if ( method_exists( $this->get_class_name_for( $id ), "onActivation" ) ) {
                    call_user_func( [ $this->get_class_name_for( $id ), 'onActivation' ] );
                }
            }
        ob_get_clean();
    }
    
    /**
     * Handle Extension deactivation
     *
     * @return void
     */
    public function handle_deactivation() {
        foreach ( $this->get_activated_extensions() as $id ) {
            if ( method_exists( $this->get_class_name_for( $id ), "onDeactivation" ) ) {
                call_user_func( [ $this->get_class_name_for( $id ), 'onDeactivation' ] );
            }
        }
    }
    
    /**
     * Handle Extension preboot
     *
     * @return void
     */
    public function do_extensions_preboot() {   
        foreach ( array_keys( $this->get_extensions() ) as $single_id ) {
            $this->maybe_do_extension_preboot( $single_id );
        }
    }
    
    /**
     * Check if it is dashboard page
     *
     * @return boolean
     */
    private function is_dashboard_page() {
        global  $pagenow ;
        $is_dashboard_page = isset( $_GET['page'] ) && 'rishi-dashboard' === sanitize_text_field( $_GET['page'] );
        return $is_dashboard_page;
    }
    
    /**
     * Get Extensions array
     *
     * @param array $args
     * @return void
     */
    public function get_extensions( $args = array() ) {
        $args = wp_parse_args( $args, [
            'forced_reread' => false,
        ] );
        
        if ( $args['forced_reread'] ) {
            foreach ( $this->extensions as $id => $extension ) {
                $this->extensions[$id]['config'] = $this->read_config_for( $extension['path'] );
                $this->extensions[$id]['readme'] = $this->read_readme_for( $extension['path'] );
            }
            $this->register_fake_extensions();
        }
        
        return $this->extensions;
    }
    
    /**
     * Check capebility
     *
     * @param string $capability
     * @return boolean
     */
    public function can( $capability = 'install_plugins' ) {
        $user = wp_get_current_user();
        
        if ( is_multisite() ) {
            // Only network admin can change files that affects the entire network.
            $can = current_user_can_for_blog( get_current_blog_id(), $capability );
        } else {
            $can = current_user_can( $capability );
        }
        
        if ( $can ) {
            // Also you can use this method to get the capability.
            $can = $capability;
        }
        return $can;
    }
    
    /**
     * Activate extension handler
     *
     * @param [type] $id
     * @return void
     */
    public function activate_extension( $id ) {
        if ( !isset( $this->extensions[$id] ) ) {
            return;
        }
        if ( !$this->extensions[$id]['path'] ) {
            return;
        }
        $activated = $this->get_activated_extensions();
        
        if ( !in_array( strtolower( $id ), $activated ) ) {
            $path = $this->extensions[$id]['path'];
            require_once $path . '/extension.php';
            if ( method_exists( $this->get_class_name_for( $id ), "onActivation" ) ) {
                call_user_func( [ $this->get_class_name_for( $id ), 'onActivation' ] );
            }
            $class = $this->get_class_name_for( $id );
            // Init extension right away.
            new $class();
        }
        
        $activated[] = strtolower( $id );
        $activated_array = array_unique( $activated );
        $sanitized_array = array_map( 'sanitize_text_field', $activated_array );
        update_option( $this->get_option_name(), $sanitized_array );
        do_action( 'rt:dynamic-css:refresh-caches' );
    }
    
    /**
     * dectivate extension handler
     *
     * @param [type] $id
     * @return void
     */
    public function deactivate_extension( $id ) {
        if ( !isset( $this->extensions[$id] ) ) {
            return;
        }
        if ( !$this->extensions[$id]['path'] ) {
            return;
        }
        $activated = $this->get_activated_extensions();
        if ( in_array( strtolower( $id ), $activated ) ) {
            if ( method_exists( $this->get_class_name_for( $id ), "onDeactivation" ) ) {
                call_user_func( [ $this->get_class_name_for( $id ), 'onDeactivation' ] );
            }
        }
        $activated_array = array_diff( $activated, [ $id ] );
        $sanitized_array = array_map( 'sanitize_text_field', $activated_array );
        update_option( $this->get_option_name(), $sanitized_array );
        do_action( 'rt:dynamic-css:refresh-caches' );
    }
    
    /**
     * Get installed extensions.
     *
     * @return void
     */
    private function read_installed_extensions() {
        $paths_to_look_for_extensions = apply_filters( 'rc_extensions_paths', [ dirname( RISHI_COMPANION_PLUGIN_FILE ) . '/framework/extensions' ] );
      
        foreach ( $paths_to_look_for_extensions as $single_path ) {
            $all_extensions = glob( $single_path . '/*', GLOB_ONLYDIR );
            foreach ( $all_extensions as $single_extension ) {
                $this->register_extension_for( $single_extension );
            }
        }
        $this->register_fake_extensions();
    }
    
    /**
     * Functionality registration.
     *
     * @return void
     */
    private function register_fake_extensions() {
        return;
        $this->extensions['custom-fonts'] = [
            'path'     => null,
            '__object' => null,
            'config'   => [
            'name'        => __( 'Custom Fonts', 'rishi-companion' ),
            'description' => __( 'Upload unlimited number of custom fonts.', 'rishi-companion' ),
            'pro'         => true,
        ],
            'readme'   => '',
            'data'     => null,
        ];
        $this->extensions['sidebars'] = [
            'path'     => null,
            '__object' => null,
            'config'   => [
            'name'        => __( 'Sidebars', 'rishi-companion' ),
            'description' => __( 'Create unlimited number of custom sidebars.', 'rishi-companion' ),
            'pro'         => true,
        ],
            'readme'   => '',
            'data'     => null,
        ];
        $this->extensions['white-label'] = [
            'path'     => null,
            '__object' => null,
            'config'   => [
            'name'        => __( 'White Label', 'rishi-companion' ),
            'description' => __( 'Change theme/companion branding', 'rishi-companion' ),
            'pro'         => true,
        ],
            'readme'   => '',
            'data'     => null,
        ];
    }
    
    /**
     * Register Extension for
     *
     * @param [type] $path
     * @return void
     */
    private function register_extension_for( $path )
    {
        $id = str_replace( '_', '-', basename( $path ) );
        if ( isset( $this->extensions[$id] ) ) {
            return;
        }
        $this->extensions[$id] = [
            'path'     => $path,
            '__object' => null,
            'config'   => $this->read_config_for( $path ),
            'readme'   => $this->read_readme_for( $path ),
            'data'     => null,
        ];
    }
    
    /**
     * Handle extension preboot whwn required
     *
     * @param [type] $id
     * @return void
     */
    private function maybe_do_extension_preboot( $id ) {
        if ( !isset( $this->extensions[$id] ) ) {
            return false;
        }
        if ( isset( $this->extensions[$id]['__object_preboot'] ) ) {
            return;
        }
        
        $class_name = explode( '-', $id );
        $class_name = array_map( 'ucfirst', $class_name );
        $class_name = '\RishiCompanionExtension' . implode( '', $class_name ) . 'PreBoot';
        
        $path = $this->extensions[$id]['path'];
        if ( !file_exists( $path . '/pre-boot.php' ) ) {
            return;
        }
        require_once $path . '/pre-boot.php';
        
        $this->extensions[$id]['__object_preboot'] = new $class_name();
        if ( method_exists( $this->extensions[$id]['__object_preboot'], 'ext_data' ) ) {
            $this->extensions[$id]['data'] = $this->extensions[$id]['__object_preboot']->ext_data();
        }
    }
    
    /**
     * Load activated extensions.
     *
     * @param [type] $id
     * @return void
     */
    private function boot_activated_extension_for( $id ) {
        if ( !isset( $this->extensions[$id] ) ) {
            return false;
        }
        if ( !isset( $this->extensions[$id]['path'] ) ) {
            return false;
        }
        if ( !$this->extensions[$id]['path'] ) {
            return false;
        }
        if ( isset( $this->extensions[$id]['config']['hidden'] ) && $this->extensions[$id]['config']['hidden'] ) {
            return;
        }
        if ( isset( $this->extensions[$id]['__object'] ) ) {
            return;
        }
        $class_name = explode( '-', $id );
        $class_name = array_map( 'ucfirst', $class_name );
        $class_name = '\RishiCompanionExtension' . implode( '', $class_name );
        $path = $this->extensions[$id]['path'];
        if ( !file_exists( $path . '/extension.php' ) ) {
            return;
        }
        
        require_once $path . '/extension.php';
        $this->extensions[$id]['__object'] = new $class_name();
    }
    
    /**
     * Get Class name
     *
     * @param [type] $id
     * @return void
     */
    private function get_class_name_for( $id ) {
        $class_name = explode( '-', $id );
        $class_name = array_map( 'ucfirst', $class_name );
        return '\RishiCompanionExtension' . implode( '', $class_name );
    }
    
    /**
     * Read Readme for extension
     *
     * @param [type] $path
     * @return void
     */
    private function read_readme_for( $path ) {
        $readme = '';
        ob_start();
        if ( is_readable( $path . '/readme.php' ) ) {
            require $path . '/readme.php';
        }
        $readme = ob_get_clean();
        if ( empty(trim( $readme )) ) {
            return null;
        }
        return trim( $readme );
    }
    
    /**
     * Read config
     *
     * @param [type] $file_path
     * @return void
     */
    private function read_config_for( $file_path ) {
        $_extract_variables = [
            'config' => [],
        ];
        
        if ( is_readable( $file_path . '/config.php' ) ) {
            require $file_path . '/config.php';
            foreach ( $_extract_variables as $variable_name => $default_value ) {
                if ( isset( ${$variable_name} ) ) {
                    $_extract_variables[$variable_name] = ${$variable_name};
                }
            }
        }
        
        $name = explode( '-', basename( $file_path ) );
        $name = array_map( 'ucfirst', $name );
        $name = implode( ' ', $name );
        $_extract_variables['config'] = array_merge( [
            'name'        => $name,
            'description' => '',
            'pro'         => false,
            'hidden'      => false,
        ], $_extract_variables['config'] );
        return $_extract_variables['config'];
    }
    
    /**
     * Get Activated extensions from DB
     *
     * @return void
     */
    private function get_activated_extensions() {
        return get_option( $this->get_option_name(), ['transparent-header','sidebar-blocks'] );
    }

}