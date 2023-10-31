<?php

/**
 * Rishi Custom functions and definitions
 *
 * @package Rishi
 */

if (!function_exists('rishi_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rishi_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Rishi, use a find and replace
		 * to change 'rishi' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('rishi', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		//This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'rishi'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'rishi_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_image_size('rishi-fullwidth', 1170, 650, ( apply_filters( 'rishi_image_dimension_1170_650', true ) ) ? true : false);
		add_image_size('rishi-withsidebar', 750, 520, ( apply_filters( 'rishi_image_dimension_750_520', true ) ) ? true : false);
		add_image_size('rishi-blog-grid', 360, 240, ( apply_filters( 'rishi_image_dimension_360_240', true ) ) ? true : false);

		// Add support for full and wide align images.
	    add_theme_support( 'align-wide' );

	    // Add support for editor styles.
	    add_theme_support( 'editor-styles' );
	        
	    /*
	     * This theme styles the visual editor to resemble the theme style,
	     * specifically font, colors, and column width.
	     *
	     */
	    add_editor_style( array(
	            'inc/css/editor-style.css'
	        )
	    );

		// Add support for responsive embeds.
		add_theme_support('responsive-embeds');

		add_theme_support(
			'editor-gradient-presets',
			[
				[
					'name' => esc_attr__( 'Vivid cyan blue to vivid purple', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%)',
					'slug' => 'vivid-cyan-blue-to-vivid-purple',
				],

				[
					'name' => esc_attr__( 'Light green cyan to vivid green cyan', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(122,220,180) 0%,rgb(0,208,130) 100%)',
					'slug' => 'light-green-cyan-to-vivid-green-cyan',
				],

				[
					'name' => esc_attr__( 'Luminous vivid amber to luminous vivid orange', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)',
					'slug' => 'luminous-vivid-amber-to-luminous-vivid-orange',
				],

				[
					'name' => esc_attr__( 'Luminous vivid orange to vivid red', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgba(255,105,0,1) 0%,rgb(207,46,46) 100%)',
					'slug' => 'luminous-vivid-orange-to-vivid-red',
				],

				[
					'name' => esc_attr__( 'Cool to warm spectrum', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(74,234,220) 0%,rgb(151,120,209) 20%,rgb(207,42,186) 40%,rgb(238,44,130) 60%,rgb(251,105,98) 80%,rgb(254,248,76) 100%)',
					'slug' => 'cool-to-warm-spectrum',
				],

				[
					'name' => esc_attr__( 'Blush light purple', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(255,206,236) 0%,rgb(152,150,240) 100%)',
					'slug' => 'blush-light-purple',
				],

				[
					'name' => esc_attr__( 'Blush bordeaux', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(254,205,165) 0%,rgb(254,45,45) 50%,rgb(107,0,62) 100%)',
					'slug' => 'blush-bordeaux',
				],

				[
					'name' => esc_attr__( 'Luminous dusk', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(255,203,112) 0%,rgb(199,81,192) 50%,rgb(65,88,208) 100%)',
					'slug' => 'luminous-dusk',
				],

				[
					'name' => esc_attr__( 'Pale ocean', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(255,245,203) 0%,rgb(182,227,212) 50%,rgb(51,167,181) 100%)',
					'slug' => 'pale-ocean',
				],

				[
					'name' => esc_attr__( 'Electric grass', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(202,248,128) 0%,rgb(113,206,126) 100%)',
					'slug' => 'electric-grass',
				],

				[
					'name' => esc_attr__( 'Midnight', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(2,3,129) 0%,rgb(40,116,252) 100%)',
					'slug' => 'midnight',
				],

				[
					'name' => esc_attr__( 'Juicy Peach', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #ffecd2 0%, #fcb69f 100%)',
					'slug' => 'juicy-peach',
				],

				[
					'name' => esc_attr__( 'Young Passion', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #ff8177 0%, #ff867a 0%, #ff8c7f 21%, #f99185 52%, #cf556c 78%, #b12a5b 100%)',
					'slug' => 'young-passion',
				],

				[
					'name' => esc_attr__( 'True Sunset', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #fa709a 0%, #fee140 100%)',
					'slug' => 'true-sunset',
				],

				[
					'name' => esc_attr__( 'Morpheus Den', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #30cfd0 0%, #330867 100%)',
					'slug' => 'morpheus-den',
				],

				[
					'name' => esc_attr__( 'Plum Plate', 'rishi' ),
					'gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
					'slug' => 'plum-plate',
				],

				[
					'name' => esc_attr__( 'Aqua Splash', 'rishi' ),
					'gradient' => 'linear-gradient(15deg, #13547a 0%, #80d0c7 100%)',
					'slug' => 'aqua-splash',
				],

				[
					'name' => esc_attr__( 'Love Kiss', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #ff0844 0%, #ffb199 100%)',
					'slug' => 'love-kiss',
				],

				[
					'name' => esc_attr__( 'New Retrowave', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #3b41c5 0%, #a981bb 49%, #ffc8a9 100%)',
					'slug' => 'new-retrowave',
				],

				[
					'name' => esc_attr__( 'Plum Bath', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #cc208e 0%, #6713d2 100%)',
					'slug' => 'plum-bath',
				],

				[
					'name' => esc_attr__( 'High Flight', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #0acffe 0%, #495aff 100%)',
					'slug' => 'high-flight',
				],

				[
					'name' => esc_attr__( 'Teen Party', 'rishi' ),
					'gradient' => 'linear-gradient(-225deg, #FF057C 0%, #8D0B93 50%, #321575 100%)',
					'slug' => 'teen-party',
				],

				[
					'name' => esc_attr__( 'Fabled Sunset', 'rishi' ),
					'gradient' => 'linear-gradient(-225deg, #231557 0%, #44107A 29%, #FF1361 67%, #FFF800 100%)',
					'slug' => 'fabled-sunset',
				],

				[
					'name' => esc_attr__( 'Arielle Smile', 'rishi' ),
					'gradient' => 'radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%)',
					'slug' => 'arielle-smile',
				],

				[
					'name' => esc_attr__( 'Itmeo Branding', 'rishi' ),
					'gradient' => 'linear-gradient(180deg, #2af598 0%, #009efd 100%)',
					'slug' => 'itmeo-branding',
				],

				[
					'name' => esc_attr__( 'Deep Blue', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #6a11cb 0%, #2575fc 100%)',
					'slug' => 'deep-blue',
				],

				[
					'name' => esc_attr__( 'Strong Bliss', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #f78ca0 0%, #f9748f 19%, #fd868c 60%, #fe9a8b 100%)',
					'slug' => 'strong-bliss',
				],

				[
					'name' => esc_attr__( 'Sweet Period', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #3f51b1 0%, #5a55ae 13%, #7b5fac 25%, #8f6aae 38%, #a86aa4 50%, #cc6b8e 62%, #f18271 75%, #f3a469 87%, #f7c978 100%)',
					'slug' => 'sweet-period',
				],

				[
					'name' => esc_attr__( 'Purple Division', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #7028e4 0%, #e5b2ca 100%)',
					'slug' => 'purple-division',
				],

				[
					'name' => esc_attr__( 'Cold Evening', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #0c3483 0%, #a2b6df 100%, #6b8cce 100%, #a2b6df 100%)',
					'slug' => 'cold-evening',
				],

				[
					'name' => esc_attr__( 'Mountain Rock', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #868f96 0%, #596164 100%)',
					'slug' => 'mountain-rock',
				],

				[
					'name' => esc_attr__( 'Desert Hump', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #c79081 0%, #dfa579 100%)',
					'slug' => 'desert-hump',
				],

				[
					'name' => esc_attr__( 'Eternal Constance', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #09203f 0%, #537895 100%)',
					'slug' => 'ethernal-constance',
				],

				[
					'name' => esc_attr__( 'Happy Memories', 'rishi' ),
					'gradient' => 'linear-gradient(-60deg, #ff5858 0%, #f09819 100%)',
					'slug' => 'happy-memories',
				],

				[
					'name' => esc_attr__( 'Grown Early', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #0ba360 0%, #3cba92 100%)',
					'slug' => 'grown-early',
				],

				[
					'name' => esc_attr__( 'Morning Salad', 'rishi' ),
					'gradient' => 'linear-gradient(-225deg, #B7F8DB 0%, #50A7C2 100%)',
					'slug' => 'morning-salad',
				],

				[
					'name' => esc_attr__( 'Night Call', 'rishi' ),
					'gradient' => 'linear-gradient(-225deg, #AC32E4 0%, #7918F2 48%, #4801FF 100%)',
					'slug' => 'night-call',
				],

				[
					'name' => esc_attr__( 'Mind Crawl', 'rishi' ),
					'gradient' => 'linear-gradient(-225deg, #473B7B 0%, #3584A7 51%, #30D2BE 100%)',
					'slug' => 'mind-crawl',
				],

				[
					'name' => esc_attr__( 'Angel Care', 'rishi' ),
					'gradient' => 'linear-gradient(-225deg, #FFE29F 0%, #FFA99F 48%, #FF719A 100%)',
					'slug' => 'angel-care',
				],

				[
					'name' => esc_attr__( 'Juicy Cake', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #e14fad 0%, #f9d423 100%)',
					'slug' => 'juicy-cake',
				],

				[
					'name' => esc_attr__( 'Rich Metal', 'rishi' ),
					'gradient' => 'linear-gradient(to right, #d7d2cc 0%, #304352 100%)',
					'slug' => 'rich-metal',
				],

				[
					'name' => esc_attr__( 'Mole Hall', 'rishi' ),
					'gradient' => 'linear-gradient(-20deg, #616161 0%, #9bc5c3 100%)',
					'slug' => 'mole-hall',
				],

				[
					'name' => esc_attr__( 'Cloudy Knoxville', 'rishi' ),
					'gradient' => 'linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%)',
					'slug' => 'cloudy-knoxville',
				],

				[
					'name' => esc_attr__( 'Very light gray to cyan bluish gray', 'rishi' ),
					'gradient' => 'linear-gradient(135deg,rgb(238,238,238) 0%,rgb(169,184,195) 100%)',
					'slug' => 'very-light-gray-to-cyan-bluish-gray',
				],

				[
					'name' => esc_attr__( 'Soft Grass', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #c1dfc4 0%, #deecdd 100%)',
					'slug' => 'soft-grass',
				],

				[
					'name' => esc_attr__( 'Saint Petersburg', 'rishi' ),
					'gradient' => 'linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%)',
					'slug' => 'saint-petersburg',
				],

				[
					'name' => esc_attr__( 'Everlasting Sky', 'rishi' ),
					'gradient' => 'linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%)',
					'slug' => 'everlasting-sky',
				],

				[
					'name' => esc_attr__( 'Kind Steel', 'rishi' ),
					'gradient' => 'linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%)',
					'slug' => 'kind-steel',
				],

				[
					'name' => esc_attr__( 'Over Sun', 'rishi' ),
					'gradient' => 'linear-gradient(60deg, #abecd6 0%, #fbed96 100%)',
					'slug' => 'over-sun',
				],

				[
					'name' => esc_attr__( 'Premium White', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #d5d4d0 0%, #d5d4d0 1%, #eeeeec 31%, #efeeec 75%, #e9e9e7 100%)',
					'slug' => 'premium-white',
				],

				[
					'name' => esc_attr__( 'Clean Mirror', 'rishi' ),
					'gradient' => 'linear-gradient(45deg, #93a5cf 0%, #e4efe9 100%)',
					'slug' => 'clean-mirror',
				],

				[
					'name' => esc_attr__( 'Wild Apple', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #d299c2 0%, #fef9d7 100%)',
					'slug' => 'wild-apple',
				],

				[
					'name' => esc_attr__( 'Snow Again', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%)',
					'slug' => 'snow-again',
				],

				[
					'name' => esc_attr__( 'Confident Cloud', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #dad4ec 0%, #dad4ec 1%, #f3e7e9 100%)',
					'slug' => 'confident-cloud',
				],

				[
					'name' => esc_attr__( 'Glass Water', 'rishi' ),
					'gradient' => 'linear-gradient(to top, #dfe9f3 0%, white 100%)',
					'slug' => 'glass-water',
				],

				[
					'name' => esc_attr__( 'Perfect White', 'rishi' ),
					'gradient' => 'linear-gradient(-225deg, #E3FDF5 0%, #FFE6FA 100%)',
					'slug' => 'perfect-white',
				],
			]
		);

		$paletteColors = rishi__cb_customizer_get_colors(
			get_theme_mod('colorPalette'),
			[
				'color1' => [ 'color' => 'rgba(41, 41, 41, 0.9)' ],
				'color2' => [ 'color' => '#292929' ],
				'color3' => [ 'color' => '#216BDB' ],
				'color4' => [ 'color' => '#5081F5' ],
				'color5' => [ 'color' => '#ffffff' ],
				'color6' => [ 'color' => '#EDF2FE' ],
				'color7' => [ 'color' => '#e9f1fa' ],
				'color8' => [ 'color' => '#F9FBFE' ],
			]
		);
	
		add_theme_support('editor-color-palette', apply_filters('rishi:editor-color-palette', [
			[
				'name' => esc_attr__( 'Palette Color 1', 'rishi' ),
				'slug' => 'palette-color-1',
				'color' => 'var(--paletteColor1, ' . $paletteColors['color1'] . ')',
			],
	
			[
				'name' => esc_attr__( 'Palette Color 2', 'rishi' ),
				'slug' => 'palette-color-2',
				'color' => 'var(--paletteColor2, ' . $paletteColors['color2'] . ')',
			],
	
			[
				'name' => esc_attr__( 'Palette Color 3', 'rishi' ),
				'slug' => 'palette-color-3',
				'color' => 'var(--paletteColor3, '. $paletteColors['color3'] . ')',
			],
	
			[
				'name' => esc_attr__( 'Palette Color 4', 'rishi' ),
				'slug' => 'palette-color-4',
				'color' => 'var(--paletteColor4, ' . $paletteColors['color4'] . ')',
			],
	
			[
				'name' => esc_attr__( 'Palette Color 5', 'rishi' ),
				'slug' => 'palette-color-5',
				'color' => 'var(--paletteColor5, ' . $paletteColors['color5'] . ')',
			],
	
			[
				'name' => esc_attr__( 'Palette Color 6', 'rishi' ),
				'slug' => 'palette-color-6',
				'color' => 'var(--paletteColor6, ' . $paletteColors['color6'] . ')',
			],
	
			[
				'name' => esc_attr__( 'Palette Color 7', 'rishi' ),
				'slug' => 'palette-color-7',
				'color' => 'var(--paletteColor7, ' . $paletteColors['color7'] . ')',
			],
	
			[
				'name' => esc_attr__( 'Palette Color 8', 'rishi' ),
				'slug' => 'palette-color-8',
				'color' => 'var(--paletteColor8, ' . $paletteColors['color8'] . ')',
			]
		]));
	}
endif;
add_action('after_setup_theme', 'rishi_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rishi_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('rishi_content_width', 750);
}
add_action('after_setup_theme', 'rishi_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function rishi_scripts()
{

	$m = rishi__cb_customizer_fonts_manager();
	$m->load_dynamic_google_fonts();

	$defaults = rishi__cb__get_layout_defaults();
	$suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

	// Add parameters for the JS
	global $wp_query;
	$max = $wp_query->max_num_pages;
	$paged = (get_query_var('paged') > 1) ? get_query_var('paged') : 1;

	/** Ajax Pagination */
	if( is_archive() ){
		if( is_author() ){
			$pagination       = get_theme_mod('author_post_navigation', $defaults['author_post_navigation']);
			$blog_page_layout = get_theme_mod('author_page_layout', $defaults['author_page_layout']);
		}elseif( rishi_is_woocommerce_activated() && is_shop() ){
			$pagination       = get_theme_mod('woo_post_navigation', 'numbered');
			$blog_page_layout = false;
		}else{		
			$pagination       = get_theme_mod('archive_post_navigation', $defaults['archive_post_navigation']);
			$blog_page_layout = get_theme_mod('archive_page_layout', $defaults['archive_page_layout']);
		}
	}elseif( is_search() ){
		$pagination       = get_theme_mod('search_post_navigation', $defaults['search_post_navigation']);
		$blog_page_layout = get_theme_mod('search_page_layout', $defaults['search_page_layout']);
	}else{	
		$pagination       = get_theme_mod('post_navigation', $defaults['post_navigation']);
		$blog_page_layout = get_theme_mod('blog_page_layout', $defaults['blog_page_layout']);
	}
	if( rishi_is_woocommerce_activated() ){
		wp_enqueue_style('rishi-woocommerce', get_template_directory_uri() . '/css/build/woocommerce' . $suffix . '.css', array(), RISHI_VERSION);
	}
	// wp_enqueue_style( 'rishi-gutenberg', get_template_directory_uri(). '/css/build/gutenberg' . $suffix . '.css', array(), RISHI_VERSION );

	wp_enqueue_style('rishi-style', get_template_directory_uri() . '/style' . $suffix . '.css', array(), RISHI_VERSION);
	
	$theme_css_data = apply_filters( 'rishi_dynamic_theme_css', '' );

	wp_add_inline_style( 'rishi-style', $theme_css_data );

	wp_style_add_data('rishi-style', 'rtl', 'replace');
	if ($suffix) {
		wp_style_add_data('rishi-style', 'suffix', $suffix);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	
	wp_localize_script(
		'rishi__cb_main',
		'rishi_custom',
		array(
			'url'                => admin_url('admin-ajax.php'),
			'startPage'          => $paged,
			'maxPages'           => $max,
			'nextLink'           => next_posts($max, false),
			'autoLoad'           => $pagination,
			'bp_layout'          => $blog_page_layout,
			'rtl'                => is_rtl()
		)
	);
}
add_action( 'wp_enqueue_scripts', 'rishi_scripts', 9999999 );

if (!function_exists('rishi_admin_scripts')) :
	/**
	 * Enqueue admin scripts and styles.
	 */
	function rishi_admin_scripts($hook)
	{
		if ($hook == 'post-new.php' || $hook == 'post.php') {
			wp_enqueue_style('rishi-admin', get_template_directory_uri() . '/inc/css/admin.css', array(), RISHI_VERSION);
		}

		if ( $hook === 'appearance_page_rishi-dashboard' ) {
			
			$installed_plugins 	= get_plugins();
			$button_label 		= esc_html__( 'Browse Rishi Starter Templates', 'rishi' );
			$data_action  		= '';

			if ( ! defined( 'DEMO_IMPORTER_PLUS_VER' ) ) {
				if ( ! isset( $installed_plugins['demo-importer-plus/demo-importer-plus.php'] ) ) {
					$button_label = esc_html__( 'Install Rishi Starter Templates', 'rishi' );
					$data_action  = 'install';
				} elseif ( ! rishi_active_plugin_check( 'demo-importer-plus/demo-importer-plus.php' ) ) {
					$button_label = esc_html__( 'Activate Rishi Starter Templates', 'rishi' );
					$data_action  = 'activate';
				}
			}

			$dashboard_assets = require get_template_directory() . '/dist/dashboard/dashboard.asset.php';
			wp_enqueue_script(
				'rishi-dashboard',
				get_template_directory_uri() . '/dist/dashboard/dashboard.js',
				$dashboard_assets['dependencies'],
				$dashboard_assets['version'],
				true
			);

			// Add Translation support for editor JS 
			wp_set_script_translations( 'rishi-dashboard', 'rishi' );

			wp_localize_script(
				'rishi-dashboard',
				'RishiDashboard',
				array(
					'customizer_url' 	=> admin_url('/customize.php?autofocus'),
					'starterTemplates' 	=> ( defined( 'DEMO_IMPORTER_PLUS_VER' ) ? true : false ),
					'starterURL' 	   	=> esc_url( admin_url( 'themes.php?page=demo-importer-plus' ) ),
					'status'           	=> $data_action,
					'starterLabel' 	   	=> $button_label,
					'starterImage'     	=> esc_url( get_template_directory_uri() . '/images/starter-templates-banner.png' ),
					'upgradeImage'     	=> esc_url( get_template_directory_uri() . '/images/upgrate-pro-image.png' ),
					'ajax_nonce' 	   	=> wp_create_nonce( 'rc-ajax-verification' ),
					'ajaxURL'   	    => esc_url( admin_url('admin-ajax.php') ),					
					'product_name' 		=> rishi__cb_customizer_get_wp_theme()->get('Name'),
					'plugin_data' 		=> apply_filters( 'rishi_dashboard_localizations', [] ),
					'support_url' 		=> apply_filters( 'rishi_dashboard_support_url', 'https://rishitheme.com/support/' ),
					'roadmap_url' 		=> apply_filters( 'rishi_dashboard_roadmap_url', 'https://rishitheme.com/roadmap/' ),
					'video_url' 		=> apply_filters( 'rishi_dashboard_video_url', 'https://www.youtube.com/channel/UCmrylkZogxYi1s8Yq8ZQNsg' ),
					'has_heading' 		=> apply_filters( 'rishi_dashboard_has_heading', [] ),
					'proActive'         => class_exists( 'Rishi\Rishi_Pro' ) ? true : false,
				)
			);
	

			wp_enqueue_style( 'rishi-dashboard', get_template_directory_uri() . '/js/dashboard/dashboard.css' );

			wp_enqueue_style( 'rishi-dashboard-google-fonts', rishi_fonts_url(), array(), null );
		}

	}
endif;
add_action('admin_enqueue_scripts', 'rishi_admin_scripts');

if( ! function_exists( 'rishi_block_editor_styles' ) ) :
/**
 * Enqueue editor styles for Gutenberg
 */
function rishi_block_editor_styles() {

    // Block styles.
    wp_enqueue_style( 'rishi-block-editor-style', get_template_directory_uri() . '/inc/css/editor-block.css' );
	wp_add_inline_style( 'rishi-block-editor-style', trim( apply_filters( 'rishi_block_editor_dynamic_css', '' ) ) );
	
	// Enqueue Google Fonts.
	$m = rishi__cb_customizer_fonts_manager();
	$m->load_editor_fonts();
}
endif;
add_action( 'enqueue_block_editor_assets', 'rishi_block_editor_styles' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rishi_body_classes($classes)
{

	$defaults              = rishi__cb__get_layout_defaults();
	$container_layout      = get_theme_mod('layout', $defaults['layout']);
	$blog_page_layout      = get_theme_mod('blog_page_layout', $defaults['blog_page_layout']);
	$editor_options        = get_option('classic-editor-replace');
	$allow_users_options   = get_option('classic-editor-allow-users');
	$ed_bookmark  		   = rishi_is_bookmark_enabled();

	$underlinestyle = get_theme_mod( 'underlinestyle', $defaults['underlinestyle'] );

	if( is_archive() ){
		if( is_author() ){
			$blog_page_layout = get_theme_mod('author_page_layout', $defaults['author_page_layout']);
		}else{
			$blog_page_layout = get_theme_mod('archive_page_layout', $defaults['archive_page_layout']);
		}
	}

	if( is_search() ){
		$blog_page_layout = get_theme_mod('search_page_layout', $defaults['search_page_layout']);
	}

	//Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	if (is_page()) {

		$page_content_area = 'boxed';
		$page_content_style_source = rishi__cb_customizer_default_akg(
            'content_style_source',
            rishi__cb_customizer_get_post_options(),
            'inherit'
        );

        if ($page_content_style_source === 'custom') {
            $page_content_area = rishi__cb_customizer_default_akg(
                'content_style',
                rishi__cb_customizer_get_post_options(),
                'boxed'
            );
        }

		$page_layout      = get_theme_mod('page_layout', $defaults['page_layout']);
		$container_layout = ($page_layout === 'default') ? $container_layout : $page_layout;
		$container_layout = ($page_content_style_source === 'custom') ? $page_content_area : $container_layout;
	}

	if (is_single()) {
		$post_content_area = 'boxed';
		$post_content_style_source = rishi__cb_customizer_default_akg(
            'content_style_source',
            rishi__cb_customizer_get_post_options(),
            'inherit'
        );

        if ($post_content_style_source === 'custom') {
            $post_content_area = rishi__cb_customizer_default_akg(
                'content_style',
                rishi__cb_customizer_get_post_options(),
                'boxed'
            );
        }

		$blog_post_layout = get_theme_mod('blog_post_layout', $defaults['blog_post_layout']);
		$container_layout = ($blog_post_layout === 'default') ? $container_layout : $blog_post_layout;
		$container_layout = ($post_content_style_source === 'custom') ? $post_content_area : $container_layout;

		
		if( ( get_theme_mod( 'ed_link_highlight','yes' ) === 'yes' ) && $underlinestyle ){
			$classes[] = 'link-highlight-'. esc_attr( $underlinestyle ).'';
		}
		
	}

	if ( is_home() ) {
		$blog_container   = get_theme_mod('blog_container', $defaults['blog_container']);
		$container_layout = ($blog_container === 'default') ? $container_layout : $blog_container;
	}

	if ( is_archive() ) {
		if( is_author() ){
			$archive_layout   = get_theme_mod('author_layout', $defaults['author_layout']);
		}else{
			$archive_layout   = get_theme_mod('archive_layout', $defaults['archive_layout']);
		}
		$container_layout = ($archive_layout === 'default') ? $container_layout : $archive_layout;
	}

	if ( is_search()) {
		$search_layout    = get_theme_mod('search_layout', $defaults['search_layout']);
		$container_layout = ($search_layout === 'default') ? $container_layout : $search_layout;
	}

	if( rishi_is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( 'product' ) || is_cart() ) ) {
		$woocommerce_layout   = get_theme_mod('woocommerce_layout', $defaults['woocommerce_layout']);
		$container_layout = ($woocommerce_layout === 'default') ? $container_layout : $woocommerce_layout;
	}

	switch ($container_layout) {
		case 'boxed':
			$classes[] = 'box-layout';
			break;
		case 'content_boxed':
			$classes[] = 'content-box-layout';
			break;
		case 'full_width_contained':
			$classes[] = 'default-layout';
			break;
		case 'full_width_stretched':
			$classes[] = 'fluid-layout';
			break;
	}

	if( is_home() || is_archive() || is_search() ) {
		switch ($blog_page_layout) {
			case 'classic':
				$classes[] = 'blog-classic';
				break;
			case 'listing':
				$classes[] = 'blog-list';
				break;
			case 'grid':
				$classes[] = 'blog-grid';
				break;
			case 'masonry_grid':
				$classes[] = 'blog-grid-masonry';
				break;
		}
	}

	if (!rishi_is_classic_editor_activated() || (rishi_is_classic_editor_activated() && $editor_options == 'block') || (rishi_is_classic_editor_activated() && $allow_users_options == 'allow' && has_blocks())) {
		$classes[] = 'rishi-has-blocks';
	}

	
	if( $ed_bookmark && is_page_template( 'page-bookmark.php' ) ){
		$classes[] = 'blog-list box-layout';
	}

	$classes[] = rishi_sidebar(true);

	return $classes;
}
add_filter('body_class', 'rishi_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rishi_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'rishi_pingback_header');

if (!function_exists('rishi_post_classes')) :
	/**
	 * Add custom classes to the array of post classes.
	 */
	function rishi_post_classes($classes, $class, $post_id)
	{

		$classes[]    = 'rishi-post';
		$ed_bookmark  = rishi_is_bookmark_enabled();

		if (!has_post_thumbnail($post_id)) {
			$classes[] = 'no-post-thumbnail';
		}

		if (is_single()) {
			$classes[] = 'rishi-single post-autoload';
		}

		if( get_theme_mod( 'enable_schema_org_markup','yes' ) != 'yes' ){
			$classes = array_diff( $classes, array( 'hentry' ) );
		}

		if( $ed_bookmark ){
			$classes[] = 'bookmark';
		}

		return $classes;
	}
endif;
add_filter('post_class', 'rishi_post_classes', 10, 3);

function rishi_get_avatar_markup_modification(){
	if( get_theme_mod( 'enable_schema_org_markup','yes' ) !== 'yes' ){
		add_filter('get_avatar', function( $class ){
			$class = str_replace(" photo", " avatar-photo", $class) ;
			return $class;
		});
	} 
}
add_action( 'wp','rishi_get_avatar_markup_modification' );


/**
 * Demo Importer Plus compatibility settings
 */

add_filter( 'demo_importer_plus_api_url', function( $api_url ) {
    return 'https://rishidemos.com/';
} );

if (!function_exists('rishi_breadcrumb_init')) :
	/**
	 * Hooked breadcrumb for different positions
	 *
	 * @return void
	 */
	function rishi_breadcrumb_init()
	{
		$defaults = rishi__cb__get_breadcrumbs_defaults();
		$breadcrumbs_position = get_theme_mod('breadcrumbs_position', $defaults['breadcrumbs_position']);
		if ( $breadcrumbs_position == 'before' ) {
			add_action('rishi_after_container_wrap', 'rishi_breadcrumb_start', 10);
		}
	}
endif;
add_action('wp', 'rishi_breadcrumb_init');

if (!function_exists('rishi_excerpt_length')) :
	/**
	 * Changes the default 55 character in excerpt 
	 */
	function rishi_excerpt_length( $length ){
		$excerpt_length = $length;		
		
		if( is_archive() ){
			if( is_author() ){
				$key = 'author_post_structure';
			}else{
				$key = 'archive_post_structure';
			}
		}elseif( is_search() ){
			$key = 'search_post_structure';
		}else{
			$key = 'archive_blog_post_structure';
		}
		
		$blog_structure = get_theme_mod( $key, rishi__cb__get_default_blogpost_structure() );
		
		foreach( $blog_structure as $structure ){
			if(  $structure['enabled'] == true && $structure['id'] == 'excerpt'  ){
				$excerpt_length = $structure['excerpt_length'];
			}
		}		
		return is_admin() ? $length : absint( $excerpt_length );
	}
endif;
add_filter('excerpt_length', 'rishi_excerpt_length', 999);

if( ! function_exists( 'rishi_comment_position' ) ) :
	/**
	 * Reorder Comment Section
	 */
	function rishi_comment_position(){
		$defaults                 = rishi__cb__get_layout_defaults();
		$ed_comment_below_content = get_theme_mod( 'ed_comment_below_content', $defaults['ed_comment_below_content'] );
		if ( $ed_comment_below_content == 'yes' ) {
			add_action( 'rishi_after_post_loop', 'rishi_comment', 8 );
		}else{
			add_action( 'rishi_after_post_loop', 'rishi_comment', 40 );
		}
	}
endif;
add_action( 'wp', 'rishi_comment_position' );

if( ! function_exists( 'rishi_related_posts_position' ) ) :
	/**
	 * Reorder Comment Section
	 */
	function rishi_related_posts_position(){
		$defaults                 = rishi__cb__get_layout_defaults();
		$ed_related_after_comment = get_theme_mod( 'ed_related_after_comment', $defaults['ed_related_after_comment'] );
		$ed_comment_below_content = get_theme_mod( 'ed_comment_below_content', $defaults['ed_comment_below_content'] );
		if ( $ed_related_after_comment == 'yes' ) {
			if( $ed_comment_below_content == 'yes' ){
				add_action( 'rishi_after_post_loop', 'rishi_related_posts', 9 );
			}else{
				add_action( 'rishi_after_post_loop', 'rishi_related_posts', 45 );
			}			
		}else{
			if( $ed_comment_below_content == 'yes' ){
				add_action( 'rishi_after_post_loop', 'rishi_related_posts', 7 );
			}else{
				add_action( 'rishi_after_post_loop', 'rishi_related_posts', 30 );
			}			
		}
	}
endif;
add_action( 'wp', 'rishi_related_posts_position' );

add_action( 'admin_menu', 'rishi_theme_add_menu_page' );

function rishi_theme_add_menu_page() {

	if (! current_user_can('activate_plugins')) {
		return;
	}

	$welcome_page_options = [
		'title'            => __( 'Rishi Theme', 'rishi' ),
		'menu-title'       => __( 'Rishi Theme', 'rishi' ),
		'permision'        => 'activate_plugins',
		'top-level-handle' => 'rishi-dashboard',
		'callback'         => 'rishi_getting_started_page_template',
		'position'         => 5,
	];


	$welcome_page_options = apply_filters(
		'rishi_add_menu_page',
		$welcome_page_options
	);

	
	add_theme_page(
		$welcome_page_options['title'],
		$welcome_page_options['menu-title'],
		$welcome_page_options['permision'],
		$welcome_page_options['top-level-handle'],
		$welcome_page_options['callback'],
		$welcome_page_options['position']
	);
}

function rishi_getting_started_page_template() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html( __( 'You do not have sufficient permissions to access this page.', 'rishi' ) ) );
	}

	echo '<div id="rishi-dashboard"></div>';
}

/**
 * AJAX callback to install a plugin.
 */
function rishi_get_install_starter() {
	if ( ! check_ajax_referer( 'rc-ajax-verification', 'security', false ) ) {
		wp_send_json_error( __( 'Security Error, Please reload the page.', 'rishi' ) );
	}
	if ( ! current_user_can( 'install_plugins' ) ) {
		wp_send_json_error( __( 'Security Error, Need higher Permissions to install plugin.', 'rishi' ) );
	}
	// Get selected file index or set it to 0.
	$status = empty( $_POST['status'] ) ? 'install' : sanitize_text_field( $_POST['status'] );
	if ( ! function_exists( 'plugins_api' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
	}
	if ( ! class_exists( 'WP_Upgrader' ) ) {
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
	}
	$install = true;
	if ( 'install' === $status ) {
		$api = plugins_api(
			'plugin_information',
			array(
				'slug' => 'demo-importer-plus',
				'fields' => array(
					'short_description' => false,
					'sections' => false,
					'requires' => false,
					'rating' => false,
					'ratings' => false,
					'downloaded' => false,
					'last_updated' => false,
					'added' => false,
					'tags' => false,
					'compatibility' => false,
					'homepage' => false,
					'donate_link' => false,
				),
			)
		);
		if ( ! is_wp_error( $api ) ) {

			// Use AJAX upgrader skin instead of plugin installer skin.
			// ref: function wp_ajax_install_plugin().
			$upgrader = new \Plugin_Upgrader( new \WP_Ajax_Upgrader_Skin() );

			$installed = $upgrader->install( $api->download_link );
			if ( $installed ) {
				$activate = activate_plugin( 'demo-importer-plus/demo-importer-plus.php', '', false, true );
				if ( is_wp_error( $activate ) ) {
					$install = false;
				}
			} else {
				$install = false;
			}
		} else {
			$install = false;
		}
	} elseif ( 'activate' === $status ) {
		$activate = activate_plugin( 'demo-importer-plus/demo-importer-plus.php', '', false, true );
		if ( is_wp_error( $activate ) ) {
			$install = false;
		}
	}

	if ( false === $install ) {
		wp_send_json_error( __( 'Error, plugin could not be installed, please install manually.', 'rishi' ) );
	} else {
		wp_send_json_success();
	}
}
// AJAX for Starter PLugin install
add_action( 'wp_ajax_rishi_get_install_starter', 'rishi_get_install_starter' );

/**
 * Active Plugin Check
 *
 * @param string $plugin_base_name is plugin folder/filename.php.
 */
function rishi_active_plugin_check( $plugin_base_name ) {

	$active_plugins = (array) get_option( 'active_plugins', array() );

	if ( is_multisite() ) {
		$active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
	}

	return in_array( $plugin_base_name, $active_plugins, true ) || array_key_exists( $plugin_base_name, $active_plugins );
}

/**
 * Theme Customizer Additions.
 */
if ( defined( 'RISHI_CUSTOMIZER_BUILDER_DIR__' ) && ! ! RISHI_CUSTOMIZER_BUILDER_DIR__ ) {
	require RISHI_DIR__ . '/inc/customizer-config.php';
}

add_filter(
	'rest_post_query',
	function ($args, $request) {
		if (
			isset($request['post_type'])
			&&
			(strpos($request['post_type'], 'rt_forced') !== false)
		) {
			$post_type = explode(
				':',
				str_replace('rt_forced_', '', $request['post_type'])
			);

			if ($post_type[0] === 'any') {
				$post_type = array_diff(
					get_post_types(['public' => true]),
					['rt_content_block']
				);
			}

			$args = [
				'posts_per_page' => $args['posts_per_page'],
				'post_type' => $post_type,
				'paged' => 1,
				's' => $args['s'],
			];
		}

		if (
			isset($request['post_type'])
			&&
			(strpos($request['post_type'], 'ct_cpt') !== false)
		) {
			$next_args = [
				'posts_per_page' => $args['posts_per_page'],
				'post_type' => array_diff(
					get_post_types(['public' => true]),
					['post', 'page', 'attachment', 'rt_content_block']
				),
				'paged' => 1
			];

			if (isset($args['s'])) {
				$next_args['s'] = $args['s'];
			}

			$args = $next_args;
		}

		return $args;
	},
	10,
	2
);

/**
 * Parse CSS
 */
if ( ! function_exists( 'rishi_parse_css' ) ) {

	/**
	 * Parse CSS
	 *
	 * @param  array  $css_output Array of CSS.
	 * @param  string $min_media  Min Media breakpoint.
	 * @param  string $max_media  Max Media breakpoint.
	 * @return string             Generated CSS.
	 */
	function rishi_parse_css( $css_output = array(), $min_media = '', $max_media = '' ) {

		$parse_css = '';
		if ( is_array( $css_output ) && count( $css_output ) > 0 ) {

			foreach ( $css_output as $selector => $properties ) {

				if ( null === $properties ) {
					break;
				}

				if ( ! count( $properties ) ) {
					continue;
				}

				$temp_parse_css   = $selector . '{';
				$properties_added = 0;

				foreach ( $properties as $property => $value ) {

					if ( '' == $value && 0 !== $value ) {
						continue;
					}

					$properties_added++;
					$temp_parse_css .= $property . ':' . $value . ';';
				}

				$temp_parse_css .= '}';

				if ( $properties_added > 0 ) {
					$parse_css .= $temp_parse_css;
				}
			}

			if ( '' != $parse_css && ( '' !== $min_media || '' !== $max_media ) ) {

				$media_css       = '@media ';
				$min_media_css   = '';
				$max_media_css   = '';
				$media_separator = '';

				if ( '' !== $min_media ) {
					$min_media_css = '(min-width:' . $min_media . 'px)';
				}
				if ( '' !== $max_media ) {
					$max_media_css = '(max-width:' . $max_media . 'px)';
				}
				if ( '' !== $min_media && '' !== $max_media ) {
					$media_separator = ' and ';
				}

				$media_css .= $min_media_css . $media_separator . $max_media_css . '{' . $parse_css . '}';

				return $media_css;
			}
		}

		return $parse_css;
	}
}

if( ! function_exists( 'rishi_change_comment_form_default_fields' ) ) :
	/**
	 * Change Comment form default fields i.e. author, email & url.
	 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
	*/
	function rishi_change_comment_form_default_fields( $fields ){    

		ob_start();
		do_action('rishi:comments:title:before');
		$title_before = ob_get_clean();
	
		ob_start();
		do_action('rishi:comments:title:after');
		$title_after = ob_get_clean();
	 
		// Change just the author field
		$fields['title_reply_before'] = $title_before . '<h3 id="reply-title" class="comment-reply-title">';
		
		$fields['title_reply_after'] = $title_after . '</h3>';
	
		return $fields;    
	}
endif;
add_filter( 'comment_form_defaults', 'rishi_change_comment_form_default_fields' );	