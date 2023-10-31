<?php

class Class_Pi_Sales_Notification_Translate{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'translate';

    private $tab_name = "Translate (PRO)";

    private $setting_key = 'pi_sn_translate_setting';

    
    private $date_format = array();
    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;
        
        
        $this->settings = array(
            array('field'=>'pi_sn_translate_message')
        );
        
        $this->tab = sanitize_text_field(filter_input( INPUT_GET, 'tab'));
        $this->active_tab = $this->tab != "" ? $this->tab : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),4);

       
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
        <span class="dashicons dashicons-translation"></span> <?php _e( $this->tab_name); ?> 
        </a>
        <?php
    }

    function tab_content(){
       $saved_translations = get_option('pi_sn_translate_message',array());
       ?>
        <script>
            var pi_saved_translations = <?php echo json_encode(array_values((is_array($saved_translations) ? $saved_translations : array()))); ?>
        </script>
        <script id="pi_translate" type="text/x-jsrender">
            <div class="row py-4 border-bottom align-items-center ">    
			<div class="col-12 col-md-4">
            <?php
                $languages = $this->getLanguages();
                echo '<select name="pi_sn_translate_message[{{:count}}][language]" class="form-control">';
                    foreach($languages as $language){
                        echo '<option value="'.$language['value'].'" lang="'.$language['lang'].'" {{if language == "'.$language['value'].'"}}selected="selected"{{/if}}>'.$language['name'].' - '.$language['value'].'</option>';
                    }
                echo '</select>';
            ?>
            </div>
			<div class="col-12 col-md-5">
            <textarea name="pi_sn_translate_message[{{:count}}][message]" class="form-control" style="min-height:200px;">{{:message}}</textarea>
            </div>
            <div class="col-12 col-md-3">
            <button class="btn btn-warning btn-remove">Remove</button>
            </div>
            </div>
        </script>
        <form method="post" action="options.php"  class="pisol-setting-form exclude-quick-save">
        <?php settings_fields( $this->setting_key ); ?>
        <div class="row py-4 border-bottom align-items-center bg-primary text-light">
            <div class="col-12">
            <h2 class="mt-0 mb-0 text-light font-weight-light h4">Add translation for popup message <br><strong>(Only Works in PRO)</strong></h2>
            </div>
        </div>
        <div class="row py-2 border-bottom">
            <div class="col-12 col-md-6">
            {product} = Product title <br> {product_link} = Product title linked to product page or affiliate page<br> {time} = Time of purchase<br>{date} => Date of purchase <br>{price} = show product price (available in PRO)
            </div>
            <div class="col-12 col-md-6">
            {country} = Customers Country<br>{state} = Customers State<br> {city} = Customers City<br>{first_name} = Customers first name
            </div>
        </div>
        <div id="pi_translation_container">

        </div>
        <button type="button" class="btn btn-primary my-2" id="btn-add-translation">Add Translation</button><br>
        </form>
       <?php
    }

    function getLanguages(){
        $languages = array();
        $args = array('echo' => 0); 
        $html = wp_dropdown_languages( $args );
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$html);
        libxml_clear_errors();
        $options = $dom->getElementsByTagName('option');
        foreach ($options as $option){
            $value = $option->getAttribute('value');
            $lang = $option->getAttribute('lang');
            $name = $option->nodeValue;
            $languages[] = array( 'value'=>$value, 'name'=> $name, 'lang'=>$lang);
        }
        return $languages;
    }
    
}

new Class_Pi_Sales_Notification_Translate($this->plugin_name);