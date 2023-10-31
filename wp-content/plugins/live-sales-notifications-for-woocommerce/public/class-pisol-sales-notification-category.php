<?php

class pi_sn_selected_category{

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
  
  static function getSelectedCategories(){
    $categories = get_option('pi_sn_selected_category',array());
    return is_array($categories) ? $categories : array();
  }

  static function getProductFromCategory($cat_id){
    $products = new WP_Query( array(
      'post_type'   => 'product',
      'post_status' => 'publish',
      'posts_per_page'=> -1,
      'fields'      => 'ids',
      'tax_query'   => array(
          'relation' => 'AND',
          array(
              'taxonomy' => 'product_cat',
              'field'    => 'term_id',
              'terms'    => $cat_id,
          )
      ),

     ) );

     return $products->posts;
  }

  function getProducts(){
    $categories = self::getSelectedCategories();
    $products = array();
    foreach($categories as $category){
      $products_list = self::getProductFromCategory((int)$category);
      if(is_array($products_list)){
      $products = array_merge($products, $products_list);
      }
    }
    $products = array_unique($products);
    shuffle($products);
    $products = array_map("wc_get_product",$products);
    return ($products);
  }

    function getProductsObj(){
       
        //$products = array_map("wc_get_product",$viewed_products);
        $products = $this->getProducts();

        if(is_array($products) && count($products) > 0){
          
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