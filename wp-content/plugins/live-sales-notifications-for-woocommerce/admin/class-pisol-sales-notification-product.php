<?php

class Class_Pi_Sales_Notification_Product{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'default';

    private $tab_name = "Product selection";

    private $setting_key = 'pi_sn_product_setting';
    
    private $product_selection_method = array('orders'=>'Orders placed', 'recently-viewed-products'=>'Recently viewed products','selected-products'=>'Show selected products', 'selected-categories'=>'Show product from selected category');

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->settings = array(
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Which products to show in popup",'pisol-sales-notification'), 'type'=>"setting_category"),
            array('field'=>'pi_sn_product_selection', 'label'=>__('Select product from','pisol-sales-notification'),'type'=>'select', 'default'=>"recently-viewed-products", 'value'=>$this->product_selection_method,  'desc'=>__('Using this you can set which product will be shown in the notification popup','pisol-sales-notification')),
            array('field'=>'pi_sn_custom_first_name'),
            array('field'=>'pi_sn_custom_location'),
            array('field'=>'pi_sn_selected_product'),
            array('field'=>'pi_sn_selected_category'),
            array('field'=>'pi_sn_order_status'),
            array('field'=>'pi_sn_time_unit'),
            array('field'=>'pi_sn_time_value'),
            array('field'=>'pi_sn_max_product_show'),
        );


        $this->tab = sanitize_text_field(filter_input( INPUT_GET, 'tab'));
        $this->active_tab = $this->tab != "" ? $this->tab : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),1);

        add_action( 'wp_ajax_pi_search_product', array( $this, 'search_product' ) );
        add_action( 'wp_ajax_pi_search_category', array( $this, 'search_category' ) );
        
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
        <span class="dashicons dashicons-products"></span> <?php _e( $this->tab_name); ?> 
        </a>
        <?php
    }

    function tab_content(){
       $vname = get_option("pi_sn_custom_first_name","John&#10;Smith&#10;Adrianus&#10;Dirk&#10;Aldert");
       $vlocation = get_option("pi_sn_custom_location","New York City, New York, USA&#10;Bernau, Freistaat Bayern, Germany");
       $selected_products = get_option("pi_sn_selected_product",array());
       $selected_categories = get_option("pi_sn_selected_category",array());
       $selected_order_status = get_option("pi_sn_order_status",array('wc-completed'));
       $pi_sn_time_unit = get_option("pi_sn_time_unit",'day');
       $pi_sn_time_value = get_option("pi_sn_time_value",1);
       $pi_sn_max_product_show = get_option("pi_sn_max_product_show",10);
       ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <?php
            foreach($this->settings as $setting){
                new pisol_class_form_sn_v3_7($setting, $this->setting_key);
            }
        ?>
        <div id="orders">
            <div class="row py-4 border-bottom align-items-center bg-primary text-light">
                <div class="col-12">
                <h2 class="mt-0 mb-0 text-light font-weight-light h4">Order related options</h2>
                </div>
            </div>
            <div class="row py-4 border-bottom align-items-center ">
                <div class="col-12">
                    <label for="pi_sn_order_status" class="h6">Based on the order status orders will be selected</label>
                    <select id="pi_sn_order_status" name="pi_sn_order_status[]" multiple="multiple" style="width:100%;">
                        <?php 
                            $order_status = wc_get_order_statuses(); 
                            foreach($order_status as $key=>$val){
                                echo '<option value="'.$key.'" '.(in_array($key, $selected_order_status) ? ' selected="selected" ': '').'>'.$val.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            
        </div>
        
        <div id="selected-products">
            <div class="row py-4 border-bottom align-items-center bg-primary text-light">
                <div class="col-12">
                <h2 class="mt-0 mb-0 text-light font-weight-light h4">Select product to show in popup</h2>
                </div>
            </div>
            <div class="row py-4 border-bottom align-items-center ">
                <div class="col-12">
                    <label for="pi_sn_selected_product" class="h6">Select product</label><br>
                    <select type="text" id="pi_sn_selected_product" name="pi_sn_selected_product[]" class="pi_add_product" style="width:100%;" multiple="multiple">
                        <?php
                        if(is_array($selected_products)):
                            foreach($selected_products as $product){
                                echo '<option value="'.$product.'" selected="selected">'.pisol_sn_common::getTitle($product)." (ID: {$product})".'</option>';
                            }
                        endif;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div id="selected-categories">
            <div class="row py-4 border-bottom align-items-center bg-primary text-light">
                <div class="col-12">
                <h2 class="mt-0 mb-0 text-light font-weight-light h4">Select category to show product</h2>
                </div>
            </div>
            <div class="row py-4 border-bottom align-items-center ">
                <div class="col-12">
                    <label for="pi_sn_selected_category" class="h6">Select category</label><br>
                    <select id="pi_sn_selected_category" name="pi_sn_selected_category[]" class="pi_add_category" style="width:100%;" multiple="multiple">
                        <?php
                        if(is_array($selected_categories)):
                            foreach($selected_categories as $category_id){
                                $obj = get_term_by( 'id', $category_id, 'product_cat' );
                                if(!is_object($obj)) continue;
                                echo '<option value="'.$category_id.'" selected="selected">'.$obj->name ." (ID: {$category_id})".'</option>';
                            }
                        endif;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div id="virtual-name-location">
        <div class="row py-4 border-bottom align-items-center bg-primary text-light">
            <div class="col-12">
            <h2 class="mt-0 mb-0 text-light font-weight-light h4">Virtual First name and Location</h2>
            </div>
        </div>
        <div class="row py-4 border-bottom align-items-center ">
            <div class="col-12">
                
                    <label for="pi_sn_custom_first_name" class="h6">Virtual first name</label><br>
                    <small>This name will be used, when you decide to show virtual sales, Enter one name on one line</small>
                    <textarea name="pi_sn_custom_first_name" id="pi_sn_custom_first_name" class="form-control" style="height:200px !important;" placeholder="John&#10;Smith&#10;Adrianus&#10;Dirk&#10;Aldert"><?php echo esc_html($vname); ?></textarea>
                
            </div>
        </div>
        <div class="row py-4 border-bottom align-items-center free-version">
            <div class="col-6">
                
                    <label for="pi_sn_use_geolocation" class="h6">Use visitor country in the fake sames popup instead of random virtual location (So visitor will think people from his location also buy this product and they are more likely to buy)</label><br>
                    <small>In the fake sales notification customer location will be shown as the visitors country</small><br>
                    <small>If you use this option then you can only use short code {country} and {state} in the message, {city} short code will not work</small>
                    
                
            </div>
            <div class="col-6">
                <div class="custom-control custom-switch">
                    <input type="checkbox" value="1" class="custom-control-input" name="pi_sn_use_geolocation" id="pi_sn_use_geolocation" >
                    <label class="custom-control-label" for="pi_sn_use_geolocation"></label>
                </div>            
            </div>
        </div>
        <div class="row py-4 border-bottom align-items-center ">
            <div class="col-12">
                
                    <label for="pi_sn_custom_location" class="h6">Virtual location</label><br>
                    <small>One location on one line eg: city, state, country if you dont have state then this will be like this <br>e.g: city , , country, if you dont have city then e.g: , state, country</small>
                    <textarea name="pi_sn_custom_location" id="pi_sn_custom_location" class="form-control" style="height:200px !important;" placeholder="City, State, Country&#10;New York City, New York, USA&#10;Bernau, Freistaat Bayern, Germany"><?php echo esc_html($vlocation); ?></textarea>
                
            </div>
        </div>
        </div>
        <div id="order-timing" class="hide-pro">
            <div class="row py-4 border-bottom align-items-center bg-primary text-light">
                <div class="col-12">
                <h2 class="mt-0 mb-0 text-light font-weight-light h4">How much old order should be shown <br><span class="h4">(FREE VERSION WILL SHOW ORDER PLACED IN LAST <u>ONE DAY</u> ONLY, PRO VERSION YOU CAN CHANGE THIS)</span></h2>
                </div>
            </div>
            <div class="row py-4 border-bottom align-items-center free-version">
                <div class="col-12">
                    <label for="pi_sn_order_status" class="h6">Show orders placed in last<br> e.g: 1 day: will show order placed in last one day <br>e.g: 1 hour: will show order placed in last one hour</label>
                </div>
                <div class="col-12 col-md-10">
                    <input type="number" min="1" step="1" name="pi_sn_time_value" value="<?php echo $pi_sn_time_value; ?>"  class="form-control">
                </div>
                <div class="col-12 col-md-2">
                    <select name="pi_sn_time_unit" value="<?php echo $pi_sn_time_unit; ?>" class="form-control">
                        <option value="hour" <?php echo $pi_sn_time_unit == "hour" ? " selected='selected' ": ""; ?>>Hour</option>
                        <option value="day" <?php echo $pi_sn_time_unit == "day" ? " selected='selected' ": ""; ?>>Day</option>
                        <option value="week" <?php echo $pi_sn_time_unit == "week" ? " selected='selected' ": ""; ?>>Week</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="max-notification">
            <div class="row py-4 border-bottom align-items-center bg-primary text-light">
                <div class="col-12">
                <h2 class="mt-0 mb-0 text-light font-weight-light h4">How many notification to show on one page</h2>
                </div>
            </div>
            <div class="row py-4 border-bottom align-items-center ">
                <div class="col-12 col-md-12">
                    <label for="pi_sn_order_status" class="h6">How many notification to show (make sure number is grater then 1)</label>
                    <input type="number" min="1" step="1" id="pi_sn_max_product_show" name="pi_sn_max_product_show" value="<?php echo $pi_sn_max_product_show; ?>"  class="form-control">
                    <small>For virtual orders this many notification will be created, but for original orders if it is less then this number no virtual order will be created</small>
                </div>
                
            </div>
        </div>
        <input type="submit" class="mt-3 btn btn-primary btn-sm" value="Save Option" />
        </form>
       <?php
    }

    public function search_product( $x = '', $post_types = array( 'product' ) ) {

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

        ob_start();
        
        if(!isset($_GET['keyword'])) die;

		$keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : "";

		if ( empty( $keyword ) ) {
			die();
		}
		$arg            = array(
			'post_status'    => 'publish',
			'post_type'      => $post_types,
			'posts_per_page' => 50,
			's'              => $keyword

		);
		$the_query      = new WP_Query( $arg );
		$found_products = array();
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$prd = wc_get_product( get_the_ID() );

				if ( $prd->has_child() && $prd->is_type( 'variable' ) ) {
					$product_children = $prd->get_children();
					if ( count( $product_children ) ) {
						foreach ( $product_children as $product_child ) {
							if ( woocommerce_version_check() ) {
								$product = array(
									'id'   => $product_child,
									'text' => str_replace("&#8211;",">",get_the_title( $product_child ))." (ID: {$product_child})"
								);

							} else {
								$child_wc  = wc_get_product( $product_child );
								$get_atts  = $child_wc->get_variation_attributes();
								$attr_name = array_values( $get_atts )[0];
								$product   = array(
									'id'   => $product_child,
									'text' => get_the_title() . ' - ' . $attr_name." (ID: {$product_child})"
								);

							}
							$found_products[] = $product;
						}

					}
				} else {
					$product_id    = get_the_ID();
					$product_title = get_the_title();
					$the_product   = new WC_Product( $product_id );
					if ( ! $the_product->is_in_stock() ) {
						$product_title .= ' (Out of stock)';
					}
					$product          = array( 'id' => $product_id, 'text' => $product_title." (ID: {$product_id})" );
					$found_products[] = $product;
				}
			}
        }
		wp_send_json( $found_products );
		die;
    }
    
    public function search_category() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		ob_start();

		$keyword = sanitize_text_field(filter_input( INPUT_GET, 'keyword'));

		if ( empty( $keyword ) ) {
			die();
		}
		$categories = get_terms(
			array(
				'taxonomy' => 'product_cat',
				'orderby'  => 'name',
				'order'    => 'ASC',
				'search'   => $keyword,
				'number'   => 100
			)
		);
		$items      = array();
		if ( count( $categories ) ) {
			foreach ( $categories as $category ) {
				$item    = array(
					'id'   => $category->term_id,
					'text' => $category->name." (ID:{$category->term_id})"
				);
				$items[] = $item;
			}
		}
		wp_send_json( $items );
		die;
    }
    
   
}

new Class_Pi_Sales_Notification_Product($this->plugin_name);

/**
 *
 * @param string $version
 *
 * @return bool
 */
if ( ! function_exists( 'woocommerce_version_check' ) ) {
	function woocommerce_version_check( $version = '3.0' ) {
		global $woocommerce;

		if ( version_compare( $woocommerce->version, $version, ">=" ) ) {
			return true;
		}

		return false;
	}
}