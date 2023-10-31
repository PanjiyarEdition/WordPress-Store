<?php
/*
v1.0.1
*/
if(!class_exists('pisol_sales_notification_review')){
class pisol_sales_notification_review{
    function __construct($title, $slug ){
        if(function_exists('is_admin') && is_admin()){
        $this->title = $title;
        $this->slug = $slug;
        $this->activation_date = "pi_review_activation_date_{$this->slug}";
        $this->saved_value = "pi_review_saved_value_{$this->slug}";
        $this->review_url = "https://wordpress.org/support/plugin/{$this->slug}/reviews/?rate=5#new-post";
        $this->review_after = 6;

        //update_option($this->saved_value, array('preference'=> 'later', 'update_at'=>'2021/06/10'));
        //delete_option($this->saved_value);
        
        add_action( 'admin_notices', array($this, 'display_admin_notice'),20 );
        add_action( "admin_post_pi_save_review_preference_{$this->slug}", array($this, 'savePreference'),20 );
        }
    }

    function display_admin_notice() {
 
        $options = get_option($this->saved_value);

	    $activation_time = $this->getInstallationDate();

	    $notice = '<div class="notice notice-error is-dismissible">';
        $notice .= '<style>.pisol-review-btn {
            display: block;
            padding: 10px 15px;
            color: #FFF;
            text-decoration: none;
            border-radius: 2px;
        }
        
        .pi-active-btn {
            background-color: #00adb5;
        }
        
        .pi-passive-btn {
            background-color: #ccc;
        }
        </style>';
        $notice .= '<div style="display:flex;">';
        $notice .= '<img style="max-width:90px; height:auto;" src="'.plugin_dir_url( __FILE__ ).'review-icon.svg" alt="pi web solution">';
        $notice .= '<div style="margin-left:20px;">';
        $notice .= '<p>'.__("Hi there, You've been using <strong>{$this->title}</strong> on your site for a few days - I hope it's been helpful. If you're enjoying my plugin, would you mind rating it 5-stars to help spread the word?").'</p>';
        $notice .= '<ul style="margin-top:15px; display: flex;
        grid-template-columns: 1fr 1fr 1fr;
        grid-column-gap: 20px;
        text-align: center;">';
        $notice .= '<li><a val="later" class="pi-active-btn pisol-review-btn" href="'.add_query_arg(array('action' => "pi_save_review_preference_{$this->slug}", 'preference'=>'later',  '_wpnonce'=>wp_create_nonce( "pi_save_review_preference_{$this->slug}" )), admin_url('admin-post.php')).'">'.__("Remind me later").'</a></li>';
        $notice .= '<li><a  class="pi-active-btn pisol-review-btn" style="font-weight:bold;" val="given" href="'.add_query_arg(array('action' => "pi_save_review_preference_{$this->slug}", 'preference'=>'now','_wpnonce'=>wp_create_nonce( "pi_save_review_preference_{$this->slug}" )), admin_url('admin-post.php')).'" target="_blank">'.__("Review Here").'</a></li>';
		$notice .= '<li><a  class="pi-passive-btn pisol-review-btn" val="never" href="'.add_query_arg(array('action' => "pi_save_review_preference_{$this->slug}", 'preference'=>'never', '_wpnonce'=>wp_create_nonce( "pi_save_review_preference_{$this->slug}" )), admin_url('admin-post.php')).'">'.__("I would not").'</a></li>';	        
        $notice .= '</ul>';
        $notice .= '</div>';
        $notice .= '</div>';
        $notice .= '</div>';
        
	    if(!$options && current_time('timestamp') >= strtotime($activation_time." +{$this->review_after} days")){
	        echo $notice;
	    } else if(is_array($options)) {
	        if( array_key_exists('preference', $options) && array_key_exists('update_at', $options) && $options['preference'] =='later'){ 
                if($this->validateDate($options['update_at']) && current_time('timestamp') >= strtotime($options['update_at']." +{$this->review_after} days")){
	                echo $notice;
                }
	        }
	    }
    }

    function savePreference(){
            $nonce = isset($_GET['_wpnonce']) ? $_GET['_wpnonce'] : '' ;
            $preference = isset($_GET['preference']) ? $_GET['preference'] : 'later';

            if(!isset($_GET['_wpnonce']) || !wp_verify_nonce($nonce,"pi_save_review_preference_{$this->slug}")){
                wp_die(__('Link has expired'), '', array('response' => 403));
            }

            $values['update_at'] = current_time('Y/m/d');
            switch($preference){
                case 'later':
                    $values['preference'] = 'later';
                    $redirect = admin_url('index.php');
                    break;
                    
                case 'now':
                    $values['preference'] = 'now';
                    $redirect = $this->review_url;
                    break;
                        
                case 'never':
                    $values['preference'] = 'never';
                    $redirect = admin_url('index.php');
                    break;
            }
            update_option($this->saved_value, $values);
            wp_redirect($redirect);
    }

    function getInstallationDate(){
        $get_install_date = get_option($this->activation_date);
        if(empty($get_install_date) || !$this->validateDate($get_install_date)){
            $now = current_time( "Y/m/d" );
    	    add_option( $this->activation_date, $now );
            return $now;
        }
        return $get_install_date;
    }

    function validateDate($date, $format = 'Y/m/d'){
        if ( empty($date) ) return false;
        
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}

new pisol_sales_notification_review('Live sales notification plugin', 'live-sales-notifications-for-woocommerce');
}