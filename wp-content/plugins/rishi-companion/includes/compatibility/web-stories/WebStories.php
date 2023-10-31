<?php
/**
 * Web Stories Compatibility File.
 *
 * @link https://wp.stories.google/
 *
 * @package Rishi_Companion
 */

// If plugin - 'Google\Web_Stories' not exist then return.
if ( ! defined( 'WEBSTORIES_VERSION' ) ) {
	return;
}

/**
 * Rishi Companion Web Stories Compatibility
 *
 * @since 3.2.0
 */
class RishiCompanionWebStories {

    /**
	 * Constructor
	 *
	 * @since 3.2.0
	 * @return void
	 */
	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'web_stories_setup' ) );

        if( "Rishi" === wp_get_theme()->get('Name') ){
            add_action( 'customize_register', array( $this, 'rishi_companion_register_web_stories'), 20 );
            add_action( 'customize_controls_enqueue_scripts', array( $this, 'rishi_companion_customize_script') );
            add_action( 'wp_enqueue_scripts', [ $this, 'web_stories_enqueue_assets' ] );

            //Location of Web Stories
            add_action('wp', array( $this, 'rishi_companion_web_stories_functions') );
        }
	}

    function rishi_companion_customize_script(){
        
        // Styles.
		wp_enqueue_style(
			'rishi-companion-customize',
			plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'includes/compatibility/web-stories/web-stories-customizer.css'
		);

    }

    function web_stories_enqueue_assets(){
        
        // Styles.
		wp_enqueue_style(
			'rishi-companion-web-stories',
			plugin_dir_url( RISHI_COMPANION_PLUGIN_FILE ) . 'includes/compatibility/web-stories/web-stories-frontend.css'
		);

    }

    /**
    * Change location of Web Stories.
    *
    * @since 3.2.0
    * @return void
    */
    function rishi_companion_web_stories_functions() {

        $web_stories_location = get_theme_mod('web_stories_location', 'header:before' );
		add_action( 'rishi:' . $web_stories_location, array( $this, 'web_stories_embed' ), 20 );

        //Shortcode to display Web Stories
        add_shortcode( 'WEB_STORIES', array( $this, 'rishi_companion_web_stories_shortcode') );
        add_shortcode( 'ALL_WEB_STORIES', array( $this, 'rishi_companion_get_all_web_stories') );

    }

    /**
    * Add theme support for Web Stories.
    *
    * @since 3.2.0
    * @return void
    */
    function web_stories_setup() {

        add_theme_support( 'web-stories' );

    }

    /**
    * Custom render function for Web Stories Embedding.
    *
    * @since 3.2.0
    * @return void
    */
    function web_stories_embed() {

        if ( ! function_exists( '\Google\Web_Stories\render_theme_stories' ) ) {
            return;
        }

        $location = $this->rishi_companion_web_stories_location();

        // Embed web stories above header with pre-configured customizer settings.
        echo '<div class="rishi-web-stories-wrap ' . esc_attr( $location ) . '">';
        \Google\Web_Stories\render_theme_stories();
        echo '</div>';
    }

    /**
    * Return class on the basis of web stories location
    *
    * @return string
    */
    function rishi_companion_web_stories_location() {
        
        $add_class = '';
        $web_stories_location = get_theme_mod( 'web_stories_location', 'header:before' );

        if( $web_stories_location === "header:before" ){
            $add_class = "header-before";
        }else if( $web_stories_location === "header:after" ){
            $add_class = "header-after";
        }else if( $web_stories_location === "footer:before" ){
            $add_class = "footer-before";
        }else if( $web_stories_location === "footer:after" ){
            $add_class = "footer-after";
        }

        return $add_class;   
    }

    /**
     * Creating shortcode for limited number of web stories as per the customizer setting 
     */
    function rishi_companion_web_stories_shortcode() {
        
        if ( ! function_exists( '\Google\Web_Stories\render_theme_stories' ) ) {
            return;
        }

        ob_start();
        echo '<div class="rishi-web-stories-wrap">';
        \Google\Web_Stories\render_theme_stories();
        echo '</div>';
        return ob_get_clean();    
    }

    /**
     * Creating shortcode to display all published web stories 
     */
    function rishi_companion_get_all_web_stories(){

        $options    = get_option( 'web_stories_customizer_settings' );

        if ( ! function_exists( '\Google\Web_Stories\render_stories' ) ) {
            return;
        }

        if ( false === $options['show_stories'] ) {
            return;
        }

        $order        = get_theme_mod( 'web_stories_order', 'ASC' );
        $orderby      = get_theme_mod( 'web_stories_orderby', 'post_title' );
        $display_type = get_theme_mod( 'web_stories_show_all', 20 );
        $no_of_posts  = 'all' === $display_type ? -1 : get_theme_mod( 'web_stories_no_of_posts', 20 );
        
        $args = array(
			'posts_status'   => 'publish',
			'posts_per_page' => $no_of_posts,
			'order'          => $order,
			'orderby'        => $orderby
		);

        $story_attributes = [
			'view_type'          => 'grid',
			'show_title'         => get_theme_mod('all_web_stories_title', true ),
			'show_excerpt'       => get_theme_mod('all_web_stories_excerpt', false ),
			'show_author'        => get_theme_mod('all_web_stories_author', false ),
			'show_date'          => get_theme_mod('all_web_stories_date', true ),
			'number_of_columns'  => get_theme_mod( 'web_stories_col_no', 5),
			'class'              => 'rishi-all-web-stories-list',
		];

        ob_start();
        echo '<div class="rishi-all-web-stories-wrap">';
        \Google\Web_Stories\render_stories( $story_attributes, $args );
        echo '</div>';
        return ob_get_clean();   
    }

    function rishi_companion_sanitize_select( $value ){    
        if ( is_array( $value ) ) {
            foreach ( $value as $key => $subvalue ) {
                $value[ $key ] = sanitize_text_field( $subvalue );
            }
            return $value;
        }
        return sanitize_text_field( $value );    
    }

    function rishi_companion_sanitize_number_absint( $number, $setting ) {
        // Ensure $number is an absolute integer (whole number, zero or greater).
        $number = absint( $number );
        
        // If the input is an absolute integer, return it; otherwise, return the default
        return ( $number ? $number : $setting->default );
    }

    function rishi_companion_sanitize_checkbox( $checked ){
        // Boolean check.
        return ( ( isset( $checked ) && true == $checked ) ? true : false );
    }

    function rishi_companion_web_stories_ac( $control ){
        $options       = get_option( 'web_stories_customizer_settings' );
        $posts_to_show = $control->manager->get_setting( 'web_stories_show_all' )->value();
        $control_id    = $control->id;

        if ( $control_id == 'web_stories_location' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_shortcode' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_shortcode_all' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_col_no' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'all_web_stories_title' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'all_web_stories_author' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'all_web_stories_excerpt' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'all_web_stories_date' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_note' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_order' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_orderby' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_show_all' && true === $options['show_stories'] ) return true;
        if ( $control_id == 'web_stories_no_of_posts' && $posts_to_show === 'custom' && true === $options['show_stories'] ) return true;
        
		return false;
    }

    /**
     * Display Archive Label
    */
    function rishi_companion_get_archive_label(){
        return esc_html( get_theme_mod( 'web_stories_archive_lbl', __( 'View all stories', 'rishi-companion' ) ) );
    }

    /**
     * Additional Web Stories Settings
     */

    function rishi_companion_register_web_stories( $wp_customize ) {

        $wp_customize->add_setting(
            'web_stories_location',
            array(
                'default'           => 'header:before',
                'sanitize_callback' => array($this, 'rishi_companion_sanitize_select'),
            )
        );
        
        $wp_customize->add_control(
            'web_stories_location',
            array(
                'section'		=> 'web_story_options',
                'type'          => 'select',
                'label'			=> __( 'Location', 'rishi-companion' ),
                'description'	=> __( 'You can choose where to display web stories', 'rishi-companion' ),
                'choices'	  => array(
					'header:before' => __( 'Above Header', 'rishi-companion' ),
					'header:after'  => __( 'Below Header', 'rishi-companion' ),
					'footer:before' => __( 'Above Footer', 'rishi-companion' ),
					'footer:after'  => __( 'Below Footer', 'rishi-companion' ),
				),
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
            )
        );
        
        if ( class_exists( '\Rishi_Note_Control' ) ) {
        
            $wp_customize->add_setting(
                'web_stories_shortcode',
                array(
                    'sanitize_callback' => 'wp_kses_post',
                )
            );
            
            $wp_customize->add_control(
                new \Rishi_Note_Control(
                    $wp_customize,
                    'web_stories_shortcode',
                    array(
                        'label'           => __('Shortcode', 'rishi-companion'),
                        'section'         => 'web_story_options',
                        'description'     => sprintf(__( 'You can also use this shortcode to add web stories in your posts and pages. %s', 'rishi-companion' ), '<div class="rc-web-stories-shortcode">[WEB_STORIES]</div>'),
                        'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
                    )
                )
            );

            $wp_customize->add_setting(
                'web_stories_note',
                array(
                    'sanitize_callback' => 'wp_kses_post',
                )
            );

            $wp_customize->add_control(
                new \Rishi_Note_Control(
                    $wp_customize,
                    'web_stories_note',
                    array(
                        'section'         => 'web_story_options',
                        'description'     => sprintf( __( '%1$s These options are for pages where you display all your web stories. %2$s', 'rishi-companion' ), '<strong>', '<strong/>' ),
                        'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
                    )
                )
            );

            $wp_customize->add_setting(
                'web_stories_shortcode_all',
                array(
                    'sanitize_callback' => 'wp_kses_post',
                )
            );
            
            $wp_customize->add_control(
                new \Rishi_Note_Control(
                    $wp_customize,
                    'web_stories_shortcode_all',
                    array(
                        'label'           => __('Shortcode', 'rishi-companion'),
                        'section'         => 'web_story_options',
                        'description'     => sprintf(__( 'You can use this shortcode to display all your web stories. %s', 'rishi-companion' ), '<div class="rc-web-stories-shortcode">[ALL_WEB_STORIES]</div>' ),
                        'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
                    )
                )
            );

        }

        $wp_customize->add_setting(
			'web_stories_show_all',
			[
				'default' => 'all',
                'sanitize_callback' => array($this, 'rishi_companion_sanitize_select'),
			]
		);

		$wp_customize->add_control(
			'web_stories_show_all',
			[
				'section'         => 'web_story_options',
				'label'           => __( 'Display Type', 'rishi-companion' ),
				'type'            => 'select',
				'choices'         => [
					'all'    => __( 'Display All Stories', 'rishi-companion' ),
					'custom' => __( 'Custom', 'rishi-companion' ),
				],
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
			]
		);

        $wp_customize->add_setting(
            'web_stories_no_of_posts',
            array(
                'default'           => 20,
                'sanitize_callback' =>  array( $this, 'rishi_companion_sanitize_number_absint' ),
            )
        );
        
        $wp_customize->add_control(
            'web_stories_no_of_posts',
            array(
                'section'         => 'web_story_options',
                'type'            => 'number',
                'label'           => __( 'Number of Stories', 'rishi-companion' ),
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
            )
        );

        $wp_customize->add_setting(
            'web_stories_col_no',
            array(
                'default'           => 5,
                'sanitize_callback' =>  array( $this, 'rishi_companion_sanitize_number_absint' ),
            )
        );
        
        $wp_customize->add_control(
            'web_stories_col_no',
            array(
                'section'         => 'web_story_options',
                'type'            => 'number',
                'input_attrs'     => [
					'min' => 1,
					'max' => 5,
				],
                'label'           => __( 'Number of Columns', 'rishi-companion' ),
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
            )
        );

        $wp_customize->add_setting(
			'web_stories_orderby',
			[
				'default' => 'post_title',
                'sanitize_callback' => array($this, 'rishi_companion_sanitize_select'),
			]
		);

		$wp_customize->add_control(
			'web_stories_orderby',
			[
				'section'         => 'web_story_options',
				'label'           => __( 'Order By', 'rishi-companion' ),
				'type'            => 'select',
				'choices'         => [
					'post_title' => __( 'Title', 'rishi-companion' ),
					'post_date'  => __( 'Date', 'rishi-companion' ),
				],
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
			]
		);

		$wp_customize->add_setting(
			'web_stories_order',
			[
				'default' => 'ASC',
                'sanitize_callback' => array($this, 'rishi_companion_sanitize_select'),
			]
		);

		$wp_customize->add_control(
			'web_stories_order',
			[
				'section'         => 'web_story_options',
				'label'           => __( 'Order', 'rishi-companion' ),
				'type'            => 'select',
				'choices'         => [
					'ASC'  => __( 'Ascending', 'rishi-companion' ),
					'DESC' => __( 'Descending', 'rishi-companion' ),
				],
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
			]
		);

        $wp_customize->add_setting(
            'all_web_stories_title',
            array(
                'default'           => true,
                'sanitize_callback' =>  array( $this, 'rishi_companion_sanitize_checkbox' ),
            )
        );
        
        $wp_customize->add_control(
            'all_web_stories_title',
            array(
                'section'         => 'web_story_options',
                'type'            => 'checkbox',
                'label'           => __( 'Show Title', 'rishi-companion' ),
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
            )
        );

        $wp_customize->add_setting(
            'all_web_stories_author',
            array(
                'default'           => false,
                'sanitize_callback' =>  array( $this, 'rishi_companion_sanitize_checkbox' ),
            )
        );
        
        $wp_customize->add_control(
            'all_web_stories_author',
            array(
                'section'         => 'web_story_options',
                'type'            => 'checkbox',
                'label'           => __( 'Show Author', 'rishi-companion' ),
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
            )
        );

        $wp_customize->add_setting(
            'all_web_stories_date',
            array(
                'default'           => true,
                'sanitize_callback' =>  array( $this, 'rishi_companion_sanitize_checkbox' ),
            )
        );
        
        $wp_customize->add_control(
            'all_web_stories_date',
            array(
                'section'         => 'web_story_options',
                'type'            => 'checkbox',
                'label'           => __( 'Show Date', 'rishi-companion' ),
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
            )
        );

        $wp_customize->add_setting(
            'all_web_stories_excerpt',
            array(
                'default'           => false,
                'sanitize_callback' =>  array( $this, 'rishi_companion_sanitize_checkbox' ),
            )
        );
        
        $wp_customize->add_control(
            'all_web_stories_excerpt',
            array(
                'section'         => 'web_story_options',
                'type'            => 'checkbox',
                'label'           => __( 'Show Description', 'rishi-companion' ),
                'active_callback' => array( $this, 'rishi_companion_web_stories_ac' )
            )
        );

    }

}
new RishiCompanionWebStories();