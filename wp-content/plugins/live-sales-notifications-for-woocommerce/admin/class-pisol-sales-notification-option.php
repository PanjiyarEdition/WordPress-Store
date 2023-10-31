<?php

class Class_Pi_Sales_Notification_Option{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'basic_setting';

    private $tab_name = "Popup setting";

    private $setting_key = 'pi_sn_basic_setting';
    
    

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->settings = array(
            array('field'=>'pi_sn_enabled', 'label'=>__('Enable sales notification','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('Enable sales notification or disable it','pisol-sales-notification')),

            array('field'=>'pi_sn_enabled_mobile', 'label'=>__('Enable sales notification on mobile','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('Enable sales notification or disable it for mobile','pisol-sales-notification')),

            array('field'=>'pi_sn_mobile_breakpoint', 'label'=>__('Mobile breakpoint width','pisol-sales-notification'),'type'=>'number', 'default'=>968, 'min'=>1, 'step'=>1,   'desc'=>__('Define what width will be consider as mobile breakpoint','pisol-sales-notification'), 'pro'=>true),

            array('field'=>'pi_show_dismiss_option', 'label'=>__('Dismiss notification option','pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__('Once user dismiss the notification, he will not see any live sales notification on your site for next X number of  days set by you','pisol-sales-notification'), 'pro'=>true),

            array('field'=>'pi_dismiss_for', 'label'=>__('Dismiss the popup for','pisol-sales-notification'),'type'=>'number', 'default'=>30, 'min'=>1, 'step'=>1,   'desc'=>__('Set the number of days for which the popup will not show to the visitor who has dismissed it','pisol-sales-notification'), 'pro'=>true),

            array('field'=>'pi_show_elapsed_time', 'label'=>__('Show elapsed time on the popup','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('Once enable it will show like this order was placed: 1 min ago, 1 week ago, 2 minute ago','pisol-sales-notification'), 'pro'=>true),
            
            array('field'=>'pi_show_stock_left', 'label'=>__('Show stock left for the product to create urgency','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('Show stock left for the product to create urgency to purchase','pisol-sales-notification'), 'pro'=>true),

            array('field'=>'pi_fake_stock_quantity', 'label'=>__('Fake stock quantity','pisol-sales-notification'),'type'=>'number', 'default'=>2, 'min'=>1, 'step'=>1,   'desc'=>__('If you don\'t use stock management then it will show this quantity for those products','pisol-sales-notification'), 'pro'=>true),
            
            
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Timing of popup",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_popup_loop', 'label'=>__('Loop through ','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('Repeat popup once all loaded popups are shown once','pisol-sales-notification')),

            array('field'=>'pi_sn_first_popup', 'label'=>__('When to start showing popup (milliseconds)','pisol-sales-notification'),'type'=>'number', 'default'=>6000, 'min'=>1000, 'step'=>50,   'desc'=>__('Once a person comes to page, when to start showing popup','pisol-sales-notification')),

            array('field'=>'pi_sn_how_long_to_show', 'label'=>__('How long to keep the popup opened (milliseconds)','pisol-sales-notification'),'type'=>'number', 'default'=>6000, 'min'=>1000, 'step'=>50,   'desc'=>__('How long to keep the popup open','pisol-sales-notification')),

            array('field'=>'pi_sn_interval_between_popup', 'label'=>__('Time gap between showing of 2 popups (milliseconds)','pisol-sales-notification'),'type'=>'number', 'default'=>6000, 'min'=>1000, 'step'=>50,   'desc'=>__('Once a popup closes then after how much time new popup should open','pisol-sales-notification')),

            
            array('field'=>'title', 'class'=> 'hide-pro bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Other settings",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_remove_out_of_stock', 'label'=>__('Don\'t show out of stock product in popup','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('Using this you can remove out of stock product from coming in popup','pisol-sales-notification'), 'pro'=>true),

            array('field'=>'pi_sn_exclusion_option', 'label'=>__('Give Option to customer to exclude there info from live feed','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('This will enable an option in your checkout page, using that buyer can make sure there info is not shown in the live sales feed on your site','pisol-sales-notification'), 'pro'=>true),
            
            array('field'=>'pi_sn_exclusion_option_message', 'label'=>__('Message shown to customer on checkout page','pisol-sales-notification'),'type'=>'textarea', 'default'=>'Don\'t show my information in live sales feed',   'desc'=>__('This message will be shown next to exclude info checkbox','pisol-sales-notification'), 'pro'=>true),

        );
        
        $this->tab = sanitize_text_field(filter_input( INPUT_GET, 'tab'));
        $this->active_tab = $this->tab != "" ? $this->tab : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),2);

       
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
        <a class="  pi-side-menu   <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.sanitize_text_field($_GET['page']).'&tab='.$this->this_tab ); ?>">
        <span class="dashicons dashicons-admin-home"></span> <?php _e( $this->tab_name,'pisol-sales-notification'); ?> 
        </a>
        <?php
    }

    function tab_content(){
        
       ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <?php
            foreach($this->settings as $setting){
                new pisol_class_form_sn_v3_7($setting, $this->setting_key);
            }
        ?>
        <input type="submit" class="mt-3 btn btn-primary btn-sm" value="Save Option" />
        </form>
       <?php
    }

    
}

new Class_Pi_Sales_Notification_Option($this->plugin_name);