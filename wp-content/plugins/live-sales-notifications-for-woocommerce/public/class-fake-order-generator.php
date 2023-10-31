<?php

class pisol_sn_fake_order{
    private $first_name;
    private $country;
    private $state;
    private $city;

    function __construct(){
       $this->setFirstName();
       $this->setLocation();
       $this->setTime();
    } 

    function setFirstName(){
        $first_names = $this->getCustomFirstNames();
        $this->first_name = $first_names;
    }

    /**
     * This provide first_name from custom names given by user
     */
    function getCustomFirstNames(){
        $names_string = get_option('pi_sn_custom_first_name',"John\r\nSmith\r\nAdrianus\r\nDirk\r\nAldert");
        if(empty($names_string)){
            $names_string = "John\r\nSmith\r\nAdrianus\r\nDirk\r\nAldert";
        }
        $names_array = explode(PHP_EOL,$names_string);
        $selected_index = trim(array_rand($names_array));
        $name = $names_array[$selected_index];
        return trim($name);
    }

    /**
     * This provide location from location stored by user
     */
    function getCustomLocation(){
        $location_string = get_option('pi_sn_custom_location',"New York City, New York, USA\r\nBernau, Freistaat Bayern, Germany");
        if($location_string == ""){
            $location_string = "New York City, New York, USA\r\nBernau, Freistaat Bayern, Germany";
        }
        $locations_array = explode(PHP_EOL,$location_string);
        foreach( $locations_array as $location_array){
            $locations[] = explode(",",$location_array);
        }
        $location_index = array_rand($locations);
        $location = $locations[$location_index];
        return $location;
    }

    function setLocation(){
        $location = $this->getCustomLocation();
        $this->city = isset($location[0]) ? trim($location[0]): "";
        $this->state = isset($location[1]) ? trim($location[1]): "";
        $this->country = isset($location[2]) ? trim($location[2]): "";
    }

    function setTime(){
        $this->pi_sn_time_unit = get_option("pi_sn_time_unit","day"); // day, week, hour
        $this->pi_sn_time_value = get_option("pi_sn_time_value",1);
        $this->order_time = "-".$this->pi_sn_time_value." ".$this->pi_sn_time_unit;

        $present = time();
        $till = strtotime($this->order_time); // 1 day from present time

        $random_time = rand($till, $present);

        $this->time = date('Y/m/d H:i:s',  $random_time);
    }

    

    /**
     *  This function name are same as used by WooCommerce order object functions 
    */
    public function get_billing_first_name(){
        return $this->first_name;
    }

    public function get_billing_city(){
        return $this->city;
    }

    public function get_billing_state(){
        return $this->state;
    }

    public function get_billing_country(){
        return $this->country;
    }

    public function get_date_created(){
        $obj = new WC_DateTime($this->time);
        return $obj;
    }

    /**
     * End of WC order functions
     */

}