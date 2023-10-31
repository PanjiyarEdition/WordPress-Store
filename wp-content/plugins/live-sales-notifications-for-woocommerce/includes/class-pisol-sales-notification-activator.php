<?php
class Pisol_Sales_Notification_Activator {

	public static function activate() {
		add_option('pi_sales_notification_do_activation_redirect', true);
	}

}
