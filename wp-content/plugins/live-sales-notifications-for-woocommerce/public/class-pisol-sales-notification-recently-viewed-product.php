<?php

class pi_sn_recently_viewed_product{

    private $products = array();
    private $popups = array();
    private $max_popup = 10;
    private $min_popup = 10;
    
    function __construct(){
        $this->max_popup = get_option("pi_sn_max_product_show",10);
        
        $this->pi_sn_remove_out_of_stock = get_option('pi_sn_remove_out_of_stock',1);
        $this->getProductsObj();
        $this->createMessage();
	}

    function getProductsObj(){
        global $woocommerce;
        $viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) : array();
        $products = array_map("wc_get_product",$viewed_products);
        if(is_array($products) && count($products) > 0){
          shuffle($products);
          foreach($products as $product){
            
            if(!is_object($product)) continue;

            $add_to_list = $this->pi_sn_remove_out_of_stock == 1  ? $product->is_in_stock() : true;
            $add_to_list = true; // We are making it true, as FREE version will show the out of stock product as well
            
            if(count($this->products) >= $this->max_popup ){
              break;
            }

            if($add_to_list){
              $order = new pisol_sn_fake_order();
              $this->products[]= pisol_sn_common::formatProductObj($product, $order);
            }

            
          }

          if(count($this->products) < $this->max_popup && count($products) > 0){
            $this->getProductsObj();
          }

        }
        return $this->products;
    }


    function createMessage(){

      foreach($this->products as $product){
           
          if(empty($product) || !is_array($product)) continue;

          $this->popups[] = array("desc"=> pisol_sn_common::searchReplace($product), "image"=> $product['image'], "link"=> $product['link']);
      }
		  return $this->popups;
    }

    function getPopups(){
      return $this->popups;
    }
   
}