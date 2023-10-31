(function ($) {
	'use strict';

	jQuery(function ($) {

		var data = window.pi_saved_translations;

		if (data != undefined) {
			for (var i = 0; i < data.length; i++) {
				data[i].count = i;
				addTranslation(data[i]);
			}


			var count = data.length == 0 ? 0 : (data.length);
		}
		$(document).on("click", ".btn-remove", function () {
			$(this).parent().parent().remove();
		});

		$(document).on("click", "#btn-add-translation", function () {
			addTranslation({ count: count, language: "", message: "" });
			count++;
		})
	});

	function addTranslation(data) {
		var tmpl = $.templates("#pi_translate");
		var html = tmpl.render(data);
		$("#pi_translation_container").append(html);
	}



})(jQuery);
