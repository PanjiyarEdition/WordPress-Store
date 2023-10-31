<?php
class pi_sn_ordered_products {
	private $products = array();
	private $popups = array();
	private $orders = array();
	private $pi_sn_time_value = '1'; /* order in last 1 day */
	private $pi_sn_time_unit = 'day'; /* hours, minutes, days */
	private $order_status = array('wc-completed');
	private $sales_message_format;
	private $min_popup = 10;

	function __construct(){
		$this->max_popup = get_option("pi_sn_max_product_show",10);

		$this->order_status = get_option("pi_sn_order_status",array('wc-completed'));
		
		$this->pi_sn_time_unit = get_option("pi_sn_time_unit","day"); // day, week, hour
		$this->pi_sn_time_value = get_option("pi_sn_time_value",1);

		$this->pi_sn_remove_out_of_stock = get_option('pi_sn_remove_out_of_stock',1);

		$this->order_time = "-".$this->pi_sn_time_value." ".$this->pi_sn_time_unit;

		$this->getOrders();
		$this->getProductsObj();
		$this->createMessage();
	}

	function getOrders(){
		
		$args = array(
			'status'=> $this->order_status,
			'orderby' => 'date',
			'order' => 'DESC',
			'date_created' => '>' . ( strtotime($this->order_time) ),
		);
		$this->orders = wc_get_orders($args);
		return shuffle($this->orders);
	}

	function getProductsObj(){
		
		foreach($this->orders as $order){
			$items = $order->get_items();
			
			if(count($this->products) >= $this->max_popup ){
                break;
			}
			
			foreach($items as $item){

				$product = $item->get_product();

				if(!is_object($product)) continue;
				
				$add_to_list = $this->pi_sn_remove_out_of_stock == 1  ? $product->is_in_stock() : true;
              	$add_to_list = true; // We are making it true, as FREE version will show the out of stock product as well
				
				if(count($this->products) >= $this->max_popup ){
					break;
				}

				if($add_to_list){
					$this->products[]= pisol_sn_common::formatProductObj($product, $order);
				}
				
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