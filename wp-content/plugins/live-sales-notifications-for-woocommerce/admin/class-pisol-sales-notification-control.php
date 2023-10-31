<?php

class Class_Pi_Sales_Notification_Control{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'control';

    private $tab_name = 'Control (PRO)';

    private $setting_key = 'pi_sn_control_setting';
    
    

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->settings = array(

            array('field'=>'pi_sn_show_all', 'label'=>__('Show popup on all pages of website', 'pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Show popup on selected page", 'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_show_front_page', 'label'=>__('Show on front page of the site (is_front_page)', 'pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'pi_sn_show_is_product', 'label'=>__('Show on single product page (is_product)', 'pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'pi_sn_show_is_cart', 'label'=>__('Show on cart page (is_cart)', 'pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'pi_sn_show_is_checkout', 'label'=>__('Show on checkout page (is_checkout)', 'pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'pi_sn_show_is_shop', 'label'=>__('Show on shop page (is_shop)', 'pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'pi_sn_show_is_product_category', 'label'=>__('Show on product category page (is_product_category)', 'pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'pi_sn_show_is_product_tag', 'label'=>__('Show on product tag page (is_product_tag)', 'pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__(''), 'pro'=>true),

            array('field'=>'title2', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__('Disable notification on this page', 'pisol-sales-notification'), 'type'=>'setting_category'),

            array('field'=>'pi_sn_disable_for_page_pro', 'label'=>__('Disable the notification on page', 'pisol-sales-notification'),'type'=>'text', 'default'=>'',   'desc'=>__('Add ID of the pages separated by comma E.g: 23, 33,44', 'pisol-sales-notification'), 'pro'=>true),
            
        );
        
        $this->tab = sanitize_text_field(filter_input( INPUT_GET, 'tab'));
        $this->active_tab = $this->tab != "" ? $this->tab : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),5);

       
        $this->register_settings();

        if(PI_SALES_NOTIFICATION_DELETE_SETTING){
            $this->delete_settings();
        }
    }

    
    function delete_settings(){
        foreach($this->settings as $setting){
            delete_option( $setting['field'] );
        }
    }

    


    function register_settings(){   

        foreach($this->settings as $setting){
            register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        ?>
        <a class="  pi-side-menu hide-pro  <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.sanitize_text_field($_GET['page']).'&tab='.$this->this_tab ); ?>">
        <span class="dashicons dashicons-dashboard"></span> <?php _e( $this->tab_name); ?> 
        </a>
        <?php
    }

    function tab_content(){
        
       ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <div id="pi_control">
        <?php
            foreach($this->settings as $setting){
                new pisol_class_form_sn_v3_7($setting, $this->setting_key);
            }
        ?>
        </div>
        <input type="submit" class="mt-3 btn btn-primary btn-sm" value="Save Option" />
        </form>
       <?php
    }

    
}

new Class_Pi_Sales_Notification_Control($this->plugin_name);