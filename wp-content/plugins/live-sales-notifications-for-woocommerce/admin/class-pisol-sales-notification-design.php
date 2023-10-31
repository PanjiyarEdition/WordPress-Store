<?php

class Class_Pi_Sales_Notification_Design{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'design';

    private $tab_name = "Design";

    private $setting_key = 'pi_sn_design_setting';
    
    private $animation = array("bounceIn",
    "bounceInDown",
    "bounceInLeft",
    "bounceInRight",
    "bounceInUp",
    "fade-in",
    "fadeInDown",
    "fadeInDownBig",
    "fadeInLeft",
    "fadeInLeftBig",
    "fadeInRight",
    "fadeInRightBig",
    "fadeInUp",
    "fadeInUpBig",
    "flipInX",
    "flipInY",
    "lightSpeedIn",
    "rotateIn",
    "rotateInDownLeft",
    "rotateInDownRight",
    "rotateInUpLeft",
    "rotateInUpRight",
    "slideInUp",
    "slideInDown",
    "slideInLeft",
    "slideInRight",
    "zoomIn",
    "zoomInDown",
    "zoomInLeft",
    "zoomInRight",
    "zoomInUp",
    "rollIn");

    private $close_animation = array("bounceOut",
    "bounceOutDown",
    "bounceOutLeft",
    "bounceOutRight",
    "bounceOutUp",
    "fade-out",
    "fadeOutDown",
    "fadeOutDownBig",
    "fadeOutLeft",
    "fadeOutLeftBig",
    "fadeOutRight",
    "fadeOutRightBig",
    "fadeOutUp",
    "fadeOutUpBig",
    "flipOutX",
    "flipOutY",
    "lightSpeedOut",
    "rotateOut",
    "rotateOutDownLeft",
    "rotateOutDownRight",
    "rotateOutUpLeft",
    "rotateOutUpRight",
    "slideOutUp",
    "slideOutDown",
    "slideOutLeft",
    "slideOutRight",
    "zoomOut",
    "zoomOutDown",
    "zoomOutLeft",
    "zoomOutRight",
    "zoomOutUp",
    "rollOut");

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->animation = $this->creatingArray($this->animation);
        $this->close_animation = $this->creatingArray($this->close_animation);
        $this->settings = array(
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Positions",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_popup_position', 'label'=>__('Popup position','pisol-sales-notification'),'type'=>'select', 'default'=> 'pi-left-bottom', 'value'=>array('pi-left-bottom'=>__('Left Bottom','pisol-sales-notification'), 'pi-right-bottom'=>__('Right Bottom','pisol-sales-notification'),'pi-left-top'=>__('Left Top','pisol-sales-notification'), 'pi-right-top'=>__('Right Top','pisol-sales-notification')),  'desc'=>__('Set popup position on the page','pisol-sales-notification')),

            array('field'=>'pi_sn_image_position', 'label'=>__('Image position','pisol-sales-notification'),'type'=>'select', 'default'=> 'pi-image-left', 'value'=>array('pi-image-left'=>__('Left','pisol-sales-notification'), 'pi-image-right'=>__('Right','pisol-sales-notification')),  'desc'=>__('Set image position on left or right of description','pisol-sales-notification')),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Background color",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_background_color', 'label'=>__('Background color','pisol-sales-notification'),'type'=>'color', 'default'=>"#ffffff",   'desc'=>__('Background color of the popup','pisol-sales-notification')),

            array('field'=>'pi_sn_background_image', 'label'=>__('Background image','pisol-sales-notification'),'type'=>'image', 'default'=>'', 'desc'=>__('This image will be used inside the popup','pisol-sales-notification'),'pro'=>true),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Layout",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_popup_width', 'label'=>__('Popup width','pisol-sales-notification'),'type'=>'number', 'default'=>40, 'min'=>0, 'max'=>100, 'step'=>1,   'desc'=>__('Popup width in % of browser width','pisol-sales-notification')),

            array('field'=>'pi_sn_image_width', 'label'=>__('Popup image width','pisol-sales-notification'),'type'=>'number', 'default'=>25, 'min'=>0, 'max'=>50, 'step'=>1,   'desc'=>__('This sets the image with as % of popup width','pisol-sales-notification')),

            array('field'=>'pi_sn_image_width_mobile', 'label'=>__('Popup image width for mobile','pisol-sales-notification'),'type'=>'number', 'default'=>25, 'min'=>0, 'max'=>50, 'step'=>1,   'desc'=>__('This sets the image with as % of popup width for mobile devices','pisol-sales-notification')),

            array('field'=>'pi_sn_border_radius', 'label'=>__('Border radius','pisol-sales-notification'),'type'=>'number', 'default'=>5, 'min'=>0, 'step'=>1,   'desc'=>__('Border radius of popup','pisol-sales-notification')),

            array('field'=>'pi_sn_border_radius_image', 'label'=>__('Border radius of Image','pisol-sales-notification'),'type'=>'number', 'default'=>0, 'min'=>0, 'step'=>1,   'desc'=>__('Border radius of product image inside the popup','pisol-sales-notification')),

            array('field'=>'pi_sn_image_padding', 'label'=>__('Spacing around image','pisol-sales-notification'),'type'=>'number', 'default'=>10, 'min'=>0, 'step'=>1,   'desc'=>__('Space around the image','pisol-sales-notification')),

            array('field'=>'pi_sn_link_image', 'label'=>__('Link image to product page','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('if enabled, it adds a product link to image','pisol-sales-notification')),

            array('field'=>'pi_sn_link_in_tab', 'label'=>__('Open product link in new tab','pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__('Open the product link in new tab','pisol-sales-notification')),

            array('field'=>'title', 'class'=> 'hide-pro bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Animation",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_open_animation', 'label'=>__('Message opening animation','pisol-sales-notification'),'type'=>'select', 'default'=>'fadeIn', 'value'=>$this->animation,  'desc'=>__('This animation is used when sales notification message opens','pisol-sales-notification'),'pro'=>true),

            array('field'=>'pi_sn_close_animation', 'label'=>__('Message closing animation','pisol-sales-notification'),'type'=>'select', 'default'=>'fadeOut', 'value'=>$this->close_animation,  'desc'=>__('This animation is used when sales notification message closes','pisol-sales-notification'),'pro'=>true),

            array('field'=>'title', 'class'=> 'hide-pro bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Product image options",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_alternate_product_image', 'label'=>__('Product image','pisol-sales-notification'),'type'=>'image', 'default'=>'', 'desc'=>__('This image will be used in place of product image when there is no product image set, or force to use this image by using the below setting','pisol-sales-notification'),'pro'=>true),

            array('field'=>'pi_force_alternate_image', 'label'=>__('Always use this image in place of product image','pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__('When enable this image will be shown in place of the product image','pisol-sales-notification'),'pro'=>true),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Close option",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_close_button', 'label'=>__('Show close button','pisol-sales-notification'),'type'=>'switch', 'default'=>1,   'desc'=>__('Using this button visitor can close the popup','pisol-sales-notification')),

            array('field'=>'pi_sn_close_image', 'label'=>__('Image used as close button','pisol-sales-notification'),'type'=>'image', 'default'=>'', 'desc'=>__('This image is used as close button image, in the popup','pisol-sales-notification')),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Audio alert",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_enable_audio_alert', 'label'=>__('Enable audio alert','pisol-sales-notification'),'type'=>'switch', 'default'=>0,   'desc'=>__('This will create an audio alert when a sales popup comes up, Audio feature is not stable as it depend on browser and user permission','pisol-sales-notification')),
            
            array('field'=>'pi_sn_audio_url', 'label'=>__('Add audio file url (mp3)','pisol-sales-notification'),'type'=>'text', 'default'=>'',   'desc'=>__('Add your custom audio file url that will be played as alert, file should be MP3 and it should be hosted on your own server','pisol-sales-notification'), 'pro'=>true),

        );
        
        $this->tab = sanitize_text_field(filter_input( INPUT_GET, 'tab'));
        $this->active_tab = $this->tab != "" ? $this->tab : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),3);

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

    function creatingArray($arrays){
        $return = array();
        foreach($arrays as $array){
            $return[$array] = $array;
        }
        return $return;
    }


    function register_settings(){   

        foreach($this->settings as $setting){
            register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        ?>
        <a class=" pi-side-menu   <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.sanitize_text_field($_GET['page']).'&tab='.$this->this_tab ); ?>">
        <span class="dashicons dashicons-art"></span> <?php _e( $this->tab_name); ?> 
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

new Class_Pi_Sales_Notification_Design($this->plugin_name);