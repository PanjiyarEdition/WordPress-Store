<?php
/**
* RishiCompanionExtensionSidebarBlocks class
*
* @package Rishi_Companion
*/
class RishiCompanionExtensionSidebarBlocks {

	/**
     * Get Option name - db
     *
     * @return void
     */
    private function get_option_name() {
        return 'rc_active_extensions';
    }

	public function __construct() {
		// load_extensions_maneger
		add_filter(
			'rishi__cb_customizer_sidebar_blocks_customizer_options',
			[$this, 'add_options_panel']
		);

		$freshfirst     = get_option( 'rc_active_extensions_flag' );
		
        if( ! $freshfirst ){
            $activated_array = ["sidebar-blocks","transparent-header"];
			$sanitized_array = array_map( 'sanitize_text_field', $activated_array );
			update_option( $this->get_option_name(), $sanitized_array );
            update_option( 'rc_active_extensions_flag', true ); 
        }
		$activated_extensions = get_option( $this->get_option_name() );

		if ( $activated_extensions && in_array( "sidebar-blocks", $activated_extensions) ){
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ), 999 );
		}

	}

	public function enqueue_editor_assets() {

		$blocks_deps = include_once plugin_dir_path( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/blocks.asset.php';
	
		wp_register_script( 'rishi-companion-blocks', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/blocks.js', $blocks_deps['dependencies'], $blocks_deps['version'], true );
	
		wp_localize_script(
			'rishi-companion-blocks',
			'rishiCompanionBlocksData',
			array(
				'pluginUrl'         => esc_url( plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) ),
			)
		);
	
		// Styles.
		wp_enqueue_style(
			'rishi-companion-blocks',
			plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/blocks.css'
		);
		wp_enqueue_script( 'rishi-companion-blocks' );
		wp_enqueue_script( 'rishi-companion-custom', plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'assets/build/postsTab.js', $blocks_deps['dependencies'], $blocks_deps['version'], true );
	
	}
}

