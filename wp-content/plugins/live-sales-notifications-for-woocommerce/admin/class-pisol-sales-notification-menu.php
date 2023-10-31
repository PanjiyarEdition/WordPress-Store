<?php

class Pi_Sales_Menu{

    public $plugin_name;
    public $menu;
    
    function __construct($plugin_name , $version){
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action( 'admin_menu', array($this,'plugin_menu') );
        add_action($this->plugin_name.'_promotion', array($this,'promotion'));

        add_action( 'admin_enqueue_scripts', array($this,'removeConflictCausingScripts'), 1000 );
    }

    function plugin_menu(){
        
        $this->menu = add_menu_page(
            __( 'Sales Notification'),
            __( 'Sales Notification'),
            'manage_options',
            'pisol-sales-notification',
            array($this, 'menu_option_page'),
            plugins_url( 'live-sales-notifications-for-woocommerce/admin/img/pi.svg' ),
            6
        );

        add_action("load-".$this->menu, array($this,"bootstrap_style"));
 
    }

    public function bootstrap_style() {
        
		wp_enqueue_style( $this->plugin_name."_bootstrap", plugin_dir_url( __FILE__ ) . 'css/bootstrap.css', array(), $this->version, 'all' );

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pisol-sales-notification-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'select2', WC()->plugin_url() . '/assets/css/select2.css');

        wp_enqueue_script( 'selectWoo', WC()->plugin_url() . '/assets/js/selectWoo/selectWoo.full.min.js', array( 'jquery' ), '1.0.4' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pisol-sales-notification-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'_jsrender', plugin_dir_url( __FILE__ ) . 'js/jsrender.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'_translate', plugin_dir_url( __FILE__ ) . 'js/pisol-translate.js', array( 'jquery', $this->plugin_name.'_jsrender' ), $this->version, false );
		
		wp_localize_script( $this->plugin_name, 'pi_ajax_object',array( 'ajax_url' => admin_url( 'admin-ajax.php' )));

        wp_enqueue_script( $this->plugin_name."_quick_save", plugin_dir_url( __FILE__ ) . 'js/pisol-quick-save.js', array('jquery'), $this->version, 'all' );
		
	}

    function menu_option_page(){
        if(function_exists('settings_errors')){
            settings_errors();
        }
        ?>
        <div id="bootstrap-wrapper" class="pisol-setting-wrapper pisol-container-wrapper">
        <div class="container mt-2">
            <div class="row">
                    <div class="col-12">
                        <div class='bg-dark'>
                        <div class="row">
                            <div class="col-12 col-sm-2 py-2">
                                    <a href="https://www.piwebsolution.com/" target="_blank"><img class="img-fluid ml-2" src="<?php echo plugin_dir_url( __FILE__ ); ?>img/pi-web-solution.png"></a>
                            </div>
                            <div class="col-12 col-sm-10 text-right small d-flex align-items-center justify-content-end">
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm mr-2" id="hid-pro-feature">Hide Pro Feature</a>
                                <a class="btn btn-danger btn-sm text-uppercase mr-2" href="<?php echo  PI_SALES_NOTIFICATION_BUY_URL; ?>" target="_blank">GET PRO !!</a>
                            </div>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-12">
                <div class="bg-light border pl-3 pr-3 pb-3 pt-0">
                    <div class="row">
                        <div class="col-12 col-md-2 px-0 border-right">
                                <?php do_action($this->plugin_name.'_tab'); ?>
                                <a class=" pi-side-menu bg-secondary " href="https://www.piwebsolution.com/documentation-for-live-sales-notifications-for-woocommerce-plugin/" target="_blank">
                                <span class="dashicons dashicons-media-document"></span> Documentation
                                </a>
                        </div>
                        <div class="col ">
                        <?php do_action($this->plugin_name.'_tab_content'); ?>
                        </div>
                        <?php do_action($this->plugin_name.'_promotion'); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    }

    function promotion(){
        ?>
        <div class="col-12 col-sm-12 col-md-4 pt-3" id="promotion-sidebar">
            <div class="bg-primary text-light text-center mb-3">
                <a class="" href="<?php echo PI_SALES_NOTIFICATION_BUY_URL; ?>" target="_blank">
                <?php new pisol_promotion('live_sales_notification_installation_date'); ?>
                </a>
            </div>

           <div class="bg-dark p-3 text-light text-center mb-3 promotion-bg">
                <h2 class="text-light font-weight-light h4"><span>Get Pro For<br><h1 class="h2 font-weight-bold text-light my-1"><?php echo PI_SALES_NOTIFICATION_PRICE; ?></h1><strong class="text-primary">LIMITED</strong> PERIOD OFFER</span></h2>
                <a class="btn btn-danger btn-sm text-uppercase" href="<?php echo PI_SALES_NOTIFICATION_BUY_URL; ?>" target="_blank">Click to Get Pro !!</a>
                <div class="inside mt-2">
                    PRO version offers more features like<br><br>
                    <ul class="text-left pisol-pro-feature-list">
                        <li class="border-top py-2 font-weight-light h6"><strong class="text-primary">Privacy protection</strong> Give Option to the customer to exclude their info from the live feed</li>
                        <li class="border-top py-2 font-weight-light h6">
                        Show visitor's country in fake sales popups for trust and <strong class="text-primary">higher purchase probability.</strong>
                        </li>
                        <li class="border-top py-2 font-weight-light h6">Don't show <strong class="text-primary">Out of stock product</strong></li>
                        <li class="border-top py-2 font-weight-light h6">Have a different <strong class="text-primary">animation</strong> for opening and closing of the popup</li>
                        <li class="border-top py-2 font-weight-light h6">Option to set the <strong class="text-primary">mobile breakpoint</strong> width</li>
                        <li class="border-top py-2 font-weight-light h6">Change sales <strong class="text-primary">Date & Time Format</strong></li>
                        <li class="border-top py-2 font-weight-light h6"><strong class="text-primary">Multi-language</strong> support, translate popup message for different languages</li>
                        <li class="border-top py-2 font-weight-light h6">Works with <strong class="text-primary">WPML, Polylang</strong> and many more.</li>
                        <li class="border-top py-2 font-weight-light h6">Add audio file to alert when the popup opens</li>
                        <li class="border-top py-2 font-weight-light h6"><strong class="text-primary">Control</strong> on which page you want to show the popup</li>
                        <li class="border-top py-2 font-weight-light h6">Free version shows 1-day old orders in the popup, <strong class="text-primary">PRO you can configure how old order to show</strong></li>
                        <li class="border-top py-2 font-weight-light h6">Set <strong class="text-primary">background image</strong> for the popup from setting</li>
                        <li class="border-top py-2 font-weight-light h6">Admin can also <strong class="text-primary">exclude</strong> any order from appearing in the live sales feed</li>
                        <li class="border-top py-2 font-weight-light h6"><strong class="text-primary">Dismiss popup</strong> option to the user</li>
                        <li class="border-top py-2 font-weight-light h6"><strong class="text-primary">Stock remaining</strong> detail to urge the buyer to buy now, E.g: Only 2 Left</li>
                        <li class="border-top py-2 font-weight-light h6">Show how long back the <strong class="text-primary">order was placed, E.g: 1 day ago</strong></li>
                        <li class="border-top py-2 font-weight-light h6">Add a <strong class="text-primary">place holder image</strong> for the product image</li>
                    </ul>
                    <a class="btn btn-light" href="<?php echo PI_SALES_NOTIFICATION_BUY_URL; ?>" target="_blank">Click to Get Pro</a>
                </div>
            </div>
            
        </div>
        <?php
    }

    function isWeekend() {
        return (date('N', strtotime(date('Y/m/d'))) >= 6);
    }

    function removeConflictCausingScripts(){
        if(isset($_GET['page']) && $_GET['page'] == 'pisol-sales-notification'){
            /* fixes css conflict with Nasa Core */
            wp_dequeue_style( 'nasa_back_end-css' );
        }
    }
}