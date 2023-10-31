<?php

class Class_Pi_Sales_Notification_Text{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'text';

    private $tab_name = "Message text";

    private $setting_key = 'pi_sn_text_setting';

    private $time_format = array();
    
    private $date_format = array();
    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;
        $this->date_format = $this->date_format();
        $this->time_format = $this->time_format();
        
        $this->settings = array(
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__('Message in popup','pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_sales_message', 'label'=>__('Sales message format ','pisol-sales-notification'),'type'=>'textarea', 'default'=>'{product_link} was purchased by {first_name} from {country}',   'desc'=>__('Set the format of the description shown on the sales popup using the shortcodes<br> {product} = Product title <br> {product_link} = Product title linked to product page or affiliate page (for external WooCommerce product type)<br> {time} = Time of purchase<br>{date} => Date of purchase <br>{country} = Customers Country<br>{state} = Customers State<br> {city} = Customers City<br>{first_name} = Customers first name<br> {price} = show product price (available in PRO)<br>{time_passed} => how long back order was placed (PRO)<br>{stock_left} => stock left for the product (PRO)','pisol-sales-notification')),

            array('field'=>'pi_sn_date_format', 'label'=>__('Date format for {date} ','pisol-sales-notification'),'type'=>'select', 'default'=>"Y/m/d", 'value'=>$this->date_format,  'desc'=>__('Date format for {date} shortcode','pisol-sales-notification'),'pro'=>true),

            array('field'=>'pi_sn_time_format', 'label'=>__('Time format for {time} ','pisol-sales-notification'),'type'=>'select', 'default'=>"G:i", 'value'=>$this->time_format,  'desc'=>__('Time format for {time} shortcode','pisol-sales-notification'),'pro'=>true),

            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Text colors",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_text_color', 'label'=>__('Normal text color','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for other text in the popup','pisol-sales-notification')),

            array('field'=>'pi_sn_product_color', 'label'=>__('Product title color {product}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the product name that shows up using {product} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_product_link_color', 'label'=>__('Product link color {product_link}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the product link name that shows up using {product_link} short code','pisol-sales-notification')),
            array('field'=>'pi_sn_time_color', 'label'=>__('Time text color {time}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the Time that shows up using {time} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_date_color', 'label'=>__('Date text color {date}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the Date that shows up using {date} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_country_color', 'label'=>__('Country text color {country}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the Country that shows up using {country} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_state_color', 'label'=>__('State text color {state}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the State that shows up using {state} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_city_color', 'label'=>__('City text color {city}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the City that shows up using {city} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_first_name_color', 'label'=>__('First name text color {first_name}','pisol-sales-notification'),'type'=>'color', 'default'=>"#000000",   'desc'=>__('This is the text color used for the First name that shows up using {first_name} shortcode','pisol-sales-notification')),
            
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Font size in (PX)",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_text_font_size', 'label'=>__('Normal text font size','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for other text in the popup','pisol-sales-notification')),

            array('field'=>'pi_sn_product_font_size', 'label'=>__('Product title font size {product}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the product name that shows up using {product} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_product_link_font_size', 'label'=>__('Product link font size {product_link}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the product link name that shows up using {product_link} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_time_font_size', 'label'=>__('Time font size {time}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the Time that shows up using {time} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_date_font_size', 'label'=>__('Date font size {date}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the Date that shows up using {date} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_country_font_size', 'label'=>__('Country font size {country}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the Country that shows up using {country} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_state_font_size', 'label'=>__('State font size {state}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the State that shows up using {state} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_city_font_size', 'label'=>__('City font size {city}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the City that shows up using {city} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_first_name_font_size', 'label'=>__('First name font size {first_name}','pisol-sales-notification'),'type'=>'number','min'=>0, 'step'=>1, 'default'=>"16",   'desc'=>__('This is the font size used for the First name that shows up using {first_name} shortcode','pisol-sales-notification')),
            
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Font weight",'pisol-sales-notification'), 'type'=>"setting_category"),

            array('field'=>'pi_sn_text_font_weight', 'label'=>__('Normal text font weight','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>'Normal','bold'=>'Bold','lighter'=>'Lighter'),   'desc'=>__('This is the font weight used for other text in the popup','pisol-sales-notification')),

            array('field'=>'pi_sn_product_font_weight', 'label'=>__('Product title font weight {product}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the product name that shows up using {product} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_product_link_font_weight', 'label'=>__('Product link font weight {product_link}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the product link name that shows up using {product_link} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_time_font_weight', 'label'=>__('Time font weight {time}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the Time that shows up using {time} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_date_font_weight', 'label'=>__('Date font weight {date}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the Date that shows up using {date} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_country_font_weight', 'label'=>__('Country font weight {country}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the Country that shows up using {country} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_state_font_weight', 'label'=>__('State font weight {state}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the State that shows up using {state} shortcode','pisol-sales-notification')),

            array('field'=>'pi_sn_city_font_weight', 'label'=>__('City font weight {city}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the City that shows up using {city} shortcode','pisol-sales-notification')),
            
            array('field'=>'pi_sn_first_name_font_weight', 'label'=>__('First name font weight {first_name}','pisol-sales-notification'),'type'=>'select','value'=>array('normal'=>__('Normal','pisol-sales-notification'),'bold'=>__('Bold','pisol-sales-notification'),'lighter'=>__('Lighter','pisol-sales-notification')),   'desc'=>__('This is the font weight used for the First name that shows up using {first_name} shortcode','pisol-sales-notification')),
            
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

    function time_format(){
        $date = array();
        
        $date['g:i a'] = date('g:i a');
        $date['g:i A'] = date('g:i A');
        $date['H:i'] = date('H:i');
        $date['H:i a'] = date('H:i a');
        $date['H:i A'] = dAte('H:i A');
        return $date;
    }

    function date_format(){
        $date = array();

        $date['Y/m/d'] = date('Y/m/d'); 
        $date['d/m/Y'] = date('d/m/Y');
        $date['m/d/y'] = date('m/d/y');
        $date['Y-m-d'] = date('Y-m-d'); 
        $date['d-m-Y'] = date('d-m-Y');
        $date['m-d-y'] = date('m-d-y');
        $date['Y.m.d'] = date('Y.m.d'); 
        $date['d.m.Y'] = date('d.m.Y');
        $date['m.d.y'] = date('m.d.y');
        $date["M j, Y"] = date("M j, Y");
        $date["jS \of F"] = date("jS \of F");
        $date["jS F"] = date("jS F");
        $date["j. F"] = date("j. F");
        $date["j F"] = date("j F");
        $date["l j. F"] = date("l j. F");
        $date["l, F j"] = date("l, F j");
        $date["l j F"] = date("l j F");
        $date["F jS"] = date("F jS");
        $date["jS M"] = date("jS M");
        $date["M jS"] = date("M jS");
        return $date;
    }


    function register_settings(){   

        foreach($this->settings as $setting){
            register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        ?>
        <a class="  pi-side-menu   <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.sanitize_text_field($_GET['page']).'&tab='.$this->this_tab ); ?>">
        <span class="dashicons dashicons-buddicons-pm"></span> <?php _e( $this->tab_name); ?> 
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

new Class_Pi_Sales_Notification_Text($this->plugin_name);