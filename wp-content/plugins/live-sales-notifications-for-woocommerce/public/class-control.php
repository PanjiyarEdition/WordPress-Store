<?php

class pisol_sn_control_display{

    function __construct(){
        $this->pi_sn_show_all = get_option('pi_sn_show_all',1);
        $this->pi_sn_show_all = 1; // Since free version will show popup on all pages
        $this->pi_sn_show_front_page = get_option('pi_sn_show_front_page',0);
        $this->pi_sn_show_is_product = get_option('pi_sn_show_is_product',0);
        $this->pi_sn_show_is_cart = get_option('pi_sn_show_is_cart',0);
        $this->pi_sn_show_is_checkout = get_option('pi_sn_show_is_checkout',0);
        $this->pi_sn_show_is_shop = get_option('pi_sn_show_is_shop',0);
        $this->pi_sn_show_is_product_category = get_option('pi_sn_show_is_product_category',0);
        $this->pi_sn_show_is_product_tag = get_option('pi_sn_show_is_product_tag',0);
    }

    function toShowHide(){
        if($this->pi_sn_show_all == 1){
            return true;
        }

        if($this->pi_sn_show_front_page == 1 && is_front_page()){
            return true;
        }

        if($this->pi_sn_show_is_product == 1 && is_product()){
            return true;
        }

        if($this->pi_sn_show_is_cart == 1 && is_cart()){
            return true;
        }

        if($this->pi_sn_show_is_checkout == 1 && is_checkout()){
            return true;
        }

        if($this->pi_sn_show_is_shop == 1 && is_shop()){
            return true;
        }

        if($this->pi_sn_show_is_product_category == 1 && is_product_category()){
            return true;
        }

        if($this->pi_sn_show_is_product_tag == 1 && is_product_tag()){
            return true;
        }

        return false;
    }
}