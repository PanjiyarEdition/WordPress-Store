<?php

/**
 * Customizer Builder initializations.
 *
 * @package Rishi_Themes_Customizer_Builder
 */
namespace RISHI__;

defined('ABSPATH') || exit;

/**
 * rishi__cb_customizer_Builder Main class.
 */
final class THEME_CUSTOMIZER
{

	/**
	 * Track instance of the rishi__cb_customizer_Builder class.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private static $instance = null;

	/**
	 * Current Builder version.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	var $version = '1.0.0';

	/**
	 * Fire up the engines.
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Defines constants.
	 */
	public function define_constants()
	{
		defined('RISHI_CUSTOMIZER_BUILDER_DIR__') || define('RISHI_CUSTOMIZER_BUILDER_DIR__', get_template_directory() . '/' . basename(__DIR__));
		defined('RISHI_CUSTOMIZER_BUILDER_DIR__URI') || define('RISHI_CUSTOMIZER_BUILDER_DIR__URI', get_template_directory_uri() . '/' . basename(__DIR__));

		defined('RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__') || define('RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__', RISHI_CUSTOMIZER_BUILDER_DIR__ . '/dist');
		defined('RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI') || define('RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI', RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/dist/');
	}

	/**
	 * Main rishi__cb_customizer_Builder Instance
	 *
	 * Ensures only one instance of rishi__cb_customizer_Builder is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @return rishi__cb_customizer_Builder - Main instance
	 */
	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Init Hooks.
	 *
	 * @return void
	 */
	public function init_hooks()
	{
		add_action('customize_controls_print_footer_scripts', array('_WP_Editors', 'force_uncompressed_tinymce'), 1);
		add_action('customize_controls_print_footer_scripts', array('_WP_Editors', 'print_default_editor_scripts'), 45);

		// Customizer Hoooks.
		add_action('customize_register', array($this, 'customizer_register'));
		add_action('customize_save', array($this, 'customizer_save'));
		add_action('customize_preview_init', array($this, 'customize_preview_init'));
		add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_customizer_scripts'));

		// Enqueue Scripts.
		add_action('wp_enqueue_scripts', array($this, 'wp_enqueue_scripts'), 999999);

		// Footer Hook
		add_action('wp_footer', array($this, 'customizer_footer_cache'), 3000, 0);
		add_action('wp_footer', array($this, 'add_customizer_footer_cache'));
		add_action('rishi_after_header', array($this, 'add_customizer_header_cache'));

		// Register Widgets.
		add_action('widgets_init', array($this, 'widgets_init'));

		// added options to add new components on Customizer
		add_action( 'wp_ajax_rc_flush_google_fonts', array( $this, 'ajax_rc_flush_google_fonts' ) ); 
	}

	/**
	 * Register sidebars.
	 */
	public function widgets_init()
	{
		$sidebars = array(
			'sidebar-1' => array(
				'name' => __('Sidebar', 'rishi'),
				'description' => __('Default Sidebar', 'rishi'),
			),
			'footer-one' => array(
				'name' => __('Footer One', 'rishi'),
				'description' => __('Add footer one widgets here.', 'rishi'),
			),
			'footer-two' => array(
				'name' => __('Footer Two', 'rishi'),
				'description' => __('Add footer two widgets here.', 'rishi'),
			),
			'footer-three' => array(
				'name' => __('Footer Three', 'rishi'),
				'description' => __('Add footer three widgets here.', 'rishi'),
			),
			'footer-four' => array(
				'name' => __('Footer Four', 'rishi'),
				'description' => __('Add footer four widgets here.', 'rishi'),
			),
			'footer-five' => array(
				'name' => __('Footer Five', 'rishi'),
				'description' => __('Add footer five widgets here.', 'rishi'),
			),
			'footer-six' => array(
				'name' => __('Footer Six', 'rishi'),
				'description' => __('Add footer six widgets here.', 'rishi'),
			),
		);

		$title_class = '';

		foreach ($sidebars as $id => $sidebar) {
			register_sidebar(
				array(
					'name' => $sidebar['name'],
					'id' => $id,
					'description' => $sidebar['description'],
					'before_widget' => '<section id="%1$s" class="widget ' . ($title_class) . ' %2$s">',
					'after_widget' => '</section>',
					'before_title' => apply_filters('rishi__cb_before_widget_title', '<h2 class="widget-title" itemprop="name">'),
					'after_title' => apply_filters('rishi__cb_after_widget_title', '</h2>'),
				)
			);
		}

	}

	/**
	 * Enqueue Scripts
	 */
	public function wp_enqueue_scripts()
	{
		$main_assets = require RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/main/main.asset.php';

		wp_enqueue_script('rishi__cb_main', RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . 'main/main.js', $main_assets['dependencies'], $main_assets['version'], true);

		wp_localize_script(
			'rishi__cb_main',
			'rishi__cb_localizations',
			apply_filters(
				'rt:builder:main:script:vars',
				array(
					'gradients' => get_theme_support('editor-gradient-presets')[0],
					'is_dev_mode' => !!(defined('RISHI_DEVELOPMENT_MODE') && RISHI_DEVELOPMENT_MODE),
					'is_companion_active' => rishi_is_companion_plugin_active(),
					'is_woocommerce_active' => rishi_is_woocommerce_activated(),
					'nonce' => wp_create_nonce('rt-ajax-nonce'),
					'public_url' => RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI,
					'static_public_url' => get_template_directory_uri() . '/js/',
					'ajax_url' => admin_url('admin-ajax.php'),
					'rest_url' => get_rest_url(),
					'customizer_url' => admin_url('/customize.php?autofocus'),
					'search_url' => get_search_link('QUERY_STRING'),
					'show_more_text' => __('Show more', 'rishi'),
				)
			)
		);
	}

	/**
	 * Include file dependencies.
	 *
	 * @since 1.0.0
	 */
	public function includes()
	{
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/defaults.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/helpers.php';

		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/menus.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/schema-org.php';

		// Classes.
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-dynamic-css.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-translations-manager.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-screen-manager.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-blocks-parser.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-css-injector.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-attributes-parser.php';

		global $wp_customize;

		if (isset($wp_customize)) {
			require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/validator.php';
			require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/sync.php';
			require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/rt-register-customizer-options.php';
		}

		require_once RISHI_CUSTOMIZER_BUILDER_DIR__ . '/admin/dashboard/rt-plugin-manager.php';

		if (is_admin() && defined('DOING_AJAX') && DOING_AJAX) {
			require_once RISHI_CUSTOMIZER_BUILDER_DIR__ . '/admin/dashboard/rt-plugin-manager.php';
		}

		/**
		 * CSS Helpers
		 */
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/fundamentals.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/colors.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/selectors.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/helpers.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/box-shadow-option.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/typography.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/backgrounds.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/css-helpers/visibility.php';

		/**
		 * Initialize customizer builder.
		 */
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/components/customizer-builder.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/components/post-meta.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/components/social-box.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/components/images.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/components/pagination.php';

		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/integrations/custom-post-types.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/integrations/theme-builders.php';

		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/admin/helpers/all.php';

		/**
		 * Manager
		 */
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/includes/manager.php';

		if (is_admin()) {
			require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/admin/init.php';
		}
	}

	/**
	 * Register customizer options main function.
	 *
	 * @return void
	 */
	public function customizer_register($wp_customize)
	{
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-group-title.php';
		require RISHI_CUSTOMIZER_BUILDER_DIR__ . '/classes/class-rt-note-control.php';

		$wp_customize->remove_section('colors');
		$wp_customize->remove_section('background_image');
		$wp_customize->remove_section('header_image');

		$wp_customize->get_setting('blogname')->transport = 'postMessage';
		$wp_customize->get_setting('blogdescription')->transport = 'postMessage';

		$wp_customize->selective_refresh->remove_partial('custom_logo');
		$wp_customize->get_setting('custom_logo')->transport = 'postMessage';

		$wp_customize->remove_control('custom_logo');
		$wp_customize->remove_control('blogname');
		$wp_customize->remove_control('blogdescription');

		if (function_exists('is_shop')) {
			$wp_customize->remove_section('header_image');

			$wp_customize->remove_section('woocommerce_product_catalog');
			$wp_customize->remove_control('woocommerce_single_image_width');
			$wp_customize->remove_control('woocommerce_thumbnail_image_width');
			$wp_customize->remove_control('woocommerce_thumbnail_cropping');
			$wp_customize->remove_control('woocommerce_demo_store_notice');
			$wp_customize->remove_control('woocommerce_demo_store');

			$wp_customize->add_setting(
				'rishi__cb_customizer_has_checkout_coupon',
				array(
					'default' => false,
					'capability' => 'edit_theme_options',

					// This is only a default function.
					// Real check comes from rishi__cb_customizer_include_sanitizer()
					// above.
					'sanitize_callback' => function ($input, $setting) {
						return $input;
					},
				)
			);

			$wp_customize->add_control(
				'rishi__cb_customizer_has_checkout_coupon',
				array(
					'label' => __('Display Coupon Form', 'rishi'),
					'section' => 'woocommerce_checkout',
					'settings' => 'rishi__cb_customizer_has_checkout_coupon',
					'type' => 'checkbox',
					'std' => '1',
				)
			);
		}

		$wp_customize->add_section(
			new \Rishi_Group_Title(
				$wp_customize,
				'core',
				array(
					'title' => esc_html__('WordPress Defaults', 'rishi'),
					'priority' => 15,
				)
			)
		);

		$wp_customize->add_setting(
			'rishi__cb_customizer_site_logo_navigator',
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new \Rishi_Note_Control(
				$wp_customize,
				'rishi__cb_customizer_site_logo_navigator',
				array(
					'section' => 'title_tagline',
					'priority' => 61,
					'description' => sprintf(
						__('Configure Site Logo from %1$shere%2$s.', 'rishi'),
						sprintf(
							'<a href="%s" data-trigger-section="header:builder_panel_logo">',
							admin_url('/customize.php?autofocus[section]=header&rt_autofocus=header:builder_panel_logo')
						),
						'</a>'
					),
				)
			)
		);

		$options = rishi__cb_customizer_get_options('init');

		rishi__cb_customizer_customizer_register_options($wp_customize, apply_filters('rishi__cb_registering_customizer_options', $options));
	}

	/**
	 * Customize Save function
	 *
	 * @param [type] $obj
	 * @return void
	 */
	public function customizer_save($obj)
	{
		$header_placements = $obj->get_setting('header_placements');

		if ($header_placements) {
			$current_value = $header_placements->post_value();
			unset($current_value['__forced_static_header__']);
			$header_placements->manager->set_post_value('header_placements', $current_value);
		}

		$footer_placements = $obj->get_setting('footer_placements');

		if ($footer_placements) {
			$current_value = $footer_placements->post_value();
			unset($current_value['__forced_static_footer__']);
			$footer_placements->manager->set_post_value('footer_placements', $current_value);
		}
	}
	/**
	 * Add custimizer footer cache
	 *
	 * @return void
	 */
	public function add_customizer_footer_cache()
	{

		$default_footer_elements = array();

		$elements = new \Rishi_Header_Builder_Elements();

		ob_start();
		$default_footer_elements[] = ob_get_clean();

		$default_footer_elements[] = $elements->render_cart_offcanvas();

		$footer_elements = apply_filters(
			'rt:footer:offcanvas-drawer',
			$default_footer_elements
		);

		if (!empty($footer_elements)) {
			echo '<div class="cb__drawer-canvas">';

			foreach ($footer_elements as $footer_el) {
				echo $footer_el;
			}

			echo '</div>';
		}

		if (is_customize_preview()) {
			rishi__cb_customizer_add_customizer_preview_cache(
				function () {
					return rishi__cb_html_tag(
						'div',
						array('data-id' => 'socials-general-cache'),
						'<section>' . rishi__cb_customizer_social_icons(
							null,
							array(
								'type' => 'simple-small',
							)
						) . '</section>'
					);
				}
			);
		}
	}

	/**
	 * Add custimizer footer cache
	 *
	 * @return void
	 */
	public function add_customizer_header_cache()
	{

		$default_footer_elements = array();

		$elements = new \Rishi_Header_Builder_Elements();

		ob_start();
		$default_footer_elements[] = ob_get_clean();

		$default_footer_elements[] = $elements->render_offcanvas();

		$footer_elements = apply_filters(
			'rt:header:offcanvas-drawer',
			$default_footer_elements
		);

		if (!empty($footer_elements)) {
			echo '<div class="cb__drawer-header-canvas">';

			foreach ($footer_elements as $footer_el) {
				echo $footer_el;
			}

			echo '</div>';
		}
	}

	/**
	 * Customizer footer cache.
	 *
	 * @return void
	 */
	public function customizer_footer_cache()
	{
		if (!is_customize_preview()) {
			return;
		}

		ob_start();

		echo '<div class="rara-customizer-preview-cache">';
		do_action('rishi__cb_customizer_customizer_preview_cache');
		echo '</div>';

		$html = ob_get_clean();

		/**
		 * Note to code reviewers: This line doesn't need to be escaped.
		 * The string used here escapes the value properly.
		 */
		echo '<input type="hidden" value="' . htmlspecialchars($html) . '" class="rara-customizer-preview-cache-container">';
	}

	/**
	 * Customizer preview init assets.
	 *
	 * @return void
	 */
	public function customize_preview_init()
	{
		$events_vars = require RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/events/events.asset.php';
		wp_register_script(
			'rt-custom-events',
			RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . 'events/events.js',
			$events_vars['dependencies'],
			$events_vars['version'],
			true
		);

		$sync_vars = require RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/sync/sync.asset.php';
		wp_enqueue_script(
			'rara-customizer-sync',
			RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . 'sync/sync.js',
			array('customize-preview', 'wp-date', 'rt-custom-events'),
			$sync_vars['version'],
			true
		);

		wp_enqueue_style(
			'__cb__customizer-controls',
			RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . 'customizerControls/customizerControls.css',
			array(),
			filemtime(RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/customizerControls/customizerControls.css')
		);

		wp_localize_script(
			'rara-customizer-sync',
			'rishi__cb_customizer_localizations',
			array(
				'static_public_url' => RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/src/',
				'header_builder_data' => \rishi__cb_customizer_manager()->builder->get_data_for_customizer(),
				'has_new_widgets' => !!get_theme_support('widgets-block-editor'),
				'customizer_sync' => $this->customizer_sync_data(),
				'customizer_flush_font' => wp_create_nonce('rt-flush-google-fonts'),
			)
		);

		wp_enqueue_media();
	}

	/**
	 * Customizer scripts.
	 *
	 * @return void
	 */
	public function enqueue_customizer_scripts()
	{
		$theme = rishi__cb_customizer_get_wp_parent_theme();

		wp_enqueue_editor();

		if (is_rtl()) {
			wp_enqueue_style(
				'rara-customizer-controls-rtl-styles',
				RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/css/customizer/customizer-controls-rtl.css',
				array('rara-customizer-controls-styles'),
				$theme->get('Version')
			);
		}

		$events_vars = require RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/events/events.asset.php';
		wp_register_script(
			'rt-custom-events',
			RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . 'events/events.js',
			$events_vars['dependencies'],
			$events_vars['version'],
			true
		);

		wp_enqueue_style(
			'rt-options-styles',
			RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/dist/main/main.css',
			array('wp-components'),
			$theme->get('Version')
		);

		$locale_data_ct = rishi__cb_customizer_get_jed_locale_data('rishi');

		wp_add_inline_script(
			'wp-i18n',
			'wp.i18n.setLocaleData( ' . wp_json_encode($locale_data_ct) . ', "rishi" );'
		);

		$customizerControls_vars = require RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__ . '/customizerControls/customizerControls.asset.php';
		wp_enqueue_script(
			'rara-customizer-controls',
			RISHI_CUSTOMIZER_BUILDER_ASSETS_DIR__URI . 'customizerControls/customizerControls.js',
			$customizerControls_vars['dependencies'],
			$customizerControls_vars['version'],
			true
		);

		// Add Translation support for customizer JS
		wp_set_script_translations('rara-customizer-controls', 'rishi');

		$has_child_theme = false;

		foreach (wp_get_themes() as $id => $theme) {
			if (!$theme->parent()) {
				continue;
			}

			if ($theme->parent()->get_stylesheet() === 'rishi') {
				$has_child_theme = true;
			}
		}

		wp_localize_script(
			'rara-customizer-controls',
			'rishi__cb_customizer_localizations',
			array(
				'customizer_reset_none' => wp_create_nonce('rara-customizer-reset'),
				'customizer_flush_font' => wp_create_nonce('rt-flush-fonts'),
				'static_public_url' => RISHI_CUSTOMIZER_BUILDER_DIR__URI . '/src/',
				'header_builder_data' => \rishi__cb_customizer_manager()->builder->get_data_for_customizer(),
				'all_mods' => get_theme_mods(),
				'gradients' => get_theme_support('editor-gradient-presets')[0],
				'has_new_widgets' => !!get_theme_support('widgets-block-editor'),
				'has_child_theme' => $has_child_theme,
				'is_parent_theme' => !wp_get_theme()->parent(),
				'customizer_flush_google_fonts' => wp_create_nonce('rt-flush-google-fonts'),
			)
		);
	}

	/**
	 * Flush Google Fonts
	 */
	public function ajax_rc_flush_google_fonts()
	{
		if ( ! check_ajax_referer( 'rt-flush-google-fonts', 'nonce', false ) ) {
			wp_send_json_error( 'invalid_nonce' );
		}

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_send_json_error( 'invalid_permissions' );
		}

		if( delete_option( 'rishi__cb_customizer_google_fonts' ) ){
			wp_send_json_success();
		}
		wp_send_json_error();
		die();
	}

	/**
	 * Customizer Sync Data.
	 *
	 * @return void
	 */
	function customizer_sync_data()
	{
		$location = null;

		if (is_front_page()) {
			$location = 'home';
		}

		if (is_page()) {
			$location = 'page';
		}

		if (get_post_type() === 'post' && is_single()) {
			$location = 'post';
		}

		if (function_exists('is_woocommerce')
			&&
			is_woocommerce()) {
			if (is_single()) {
				$location = 'product';
			}

			if (is_shop() || is_product_category()) {
				$location = 'product_archives';
			}
		}

		$theme = rishi__cb_customizer_get_wp_theme();

		return array(
			'future_location' => $location,
			'svg_patterns' => rishi__cb_customizer_get_patterns_svgs_list(),
			'site_title' => get_bloginfo('name'),
			'theme_author' => $theme->get('Author'),
		);
	}

}

class_alias('RISHI__\THEME_CUSTOMIZER', '\rishi__cb_customizer_Builder');
/**
 * Returns the main instance of rishi__cb_customizer_Builder.
 *
 * @since  1.0.0
 * @return THEME_CUSTOMIZER
 */
function init_customizer()
{
	return THEME_CUSTOMIZER::instance();
}
