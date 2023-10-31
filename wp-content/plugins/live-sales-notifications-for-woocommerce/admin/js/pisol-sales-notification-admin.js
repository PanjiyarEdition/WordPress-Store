(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	jQuery(function ($) {



		/**
		 * Control tab
		 */
		/*
		$("#pi_sn_show_all").on("change", function () {
			if ($(this).is(":checked")) {
				$("#pi_control .row").not("#row_pi_sn_show_all").fadeOut();
			} else {
				$("#pi_control .row").not("#row_pi_sn_show_all").fadeIn()
			}
		});
		$("#pi_sn_show_all").trigger('change');
		*/
		/* End control tab */

		/**
		 * Product selection tab
		 */
		$("#pi_sn_product_selection").on("change", function () {
			var selected = $("#pi_sn_product_selection option:selected").val();
			virtual_name_location(selected);
			selected_product(selected);
			selected_category(selected);
			orders(selected);
		});

		$("#pi_sn_product_selection").trigger('change');

		$("#pi_sn_selected_product").selectWoo({
			ajax: {
				url: window.pi_ajax_object.ajax_url,
				dataType: 'json',
				type: "GET",
				delay: 250,
				data: function (params) {
					return {
						keyword: params.term,
						action: "pi_search_product"
					};
				},
				processResults: function (data) {
					return {
						results: data
					};

				},
			}
		});

		$("#pi_sn_selected_category").selectWoo({
			ajax: {
				url: window.pi_ajax_object.ajax_url,
				dataType: 'json',
				type: "GET",
				delay: 250,
				data: function (params) {
					return {
						keyword: params.term,
						action: "pi_search_category"
					};
				},
				processResults: function (data) {
					return {
						results: data
					};

				},
			}
		});

		$("#pi_sn_order_status").selectWoo();
		/* End product selection tab */

		function hideProFeature() {
			var load_status = localStorage.getItem('pisol-sales_notification-pro-feature-state');
			if (load_status == '' || load_status == undefined || load_status == 'show') {
				jQuery("#hid-pro-feature").html('Hide Pro feature');
				jQuery(".free-version, #promotion-sidebar, .hide-pro").fadeIn();
			} else {
				jQuery("#hid-pro-feature").html('Show Pro feature');
				jQuery(".free-version, #promotion-sidebar, .hide-pro").fadeOut();
			}

			jQuery("#hid-pro-feature").on("click", function () {
				var state = localStorage.getItem('pisol-sales_notification-pro-feature-state');
				if (state == '' || state == undefined || state == 'show') {
					localStorage.setItem('pisol-sales_notification-pro-feature-state', 'hidden');
					jQuery("#hid-pro-feature").html('Show Pro feature');
					jQuery(".free-version, #promotion-sidebar, .hide-pro").fadeOut();
				} else {
					localStorage.setItem('pisol-sales_notification-pro-feature-state', 'show');
					jQuery("#hid-pro-feature").html('Hide Pro feature');
					jQuery(".free-version, #promotion-sidebar, .hide-pro").fadeIn();
				}
			});
		}

		hideProFeature();

	});

	function virtual_name_location(selected) {
		if (selected == "recently-viewed-products" || selected == "selected-products" || selected == "selected-categories") {
			$("#virtual-name-location").fadeIn();
		} else {
			$("#virtual-name-location").fadeOut();
		}
	}

	function selected_product(selected) {
		if (selected == "selected-products") {
			$("#selected-products").fadeIn();
		} else {
			$("#selected-products").fadeOut();
		}
	}

	function selected_category(selected) {
		if (selected == "selected-categories") {
			$("#selected-categories").fadeIn();
		} else {
			$("#selected-categories").fadeOut();
		}
	}

	function orders(selected) {
		if (selected == "orders") {
			$("#orders").fadeIn();
		} else {
			$("#orders").fadeOut();
		}
	}


})(jQuery);
