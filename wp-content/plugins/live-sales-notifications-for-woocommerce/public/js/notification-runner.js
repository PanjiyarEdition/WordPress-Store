(function ($) {
    "use strict";

    $.fn.pi_notification_runner = function () {
        var settings = $.extend({
            first_popup: 100,
            interval_between_popup: 1000,
            how_long_to_show: 1000,
            animation: "fadeIn",
            closing_animation: "fadeOut",
            close: true,
            close_image: "",
            dismiss: false,
            loop: true,
            counter: 0,
            mobile: true

        }, window.pi_notification_runner_setting);

        this.getOrders = function () {
            var parent = this;
            var action = 'pisol_live_orders';
            jQuery.ajax({
                type: 'POST',
                dataType: "json",
                data: {
                    action: 'pisol_live_orders'
                },
                url: settings.wc_ajax_url.toString().replace('%%endpoint%%', action),
                success: function (msg) {
                    parent.popups = shuffle(msg);
                    if (parent.popups.length > 0) {
                        parent.startFirstTimer(parent);
                    }
                }
            })
        }


        this.startFirstTimer = function (obj) {
            setTimeout(function (obj) {
                var popup = obj.makingPopup(obj);
                setTimeout(function (popup) { popup.close(popup); settings.counter++; }, settings.how_long_to_show, popup);
                obj.startLoop(obj);
            }, settings.first_popup, obj);
        }

        this.startLoop = function (obj) {
            var interval = parseInt(settings.interval_between_popup) + parseInt(settings.how_long_to_show);
            setInterval(function (obj) {
                var popup = obj.makingPopup(obj);
                if (popup != undefined) {
                    setTimeout(function (popup) { popup.close(popup); settings.counter++; }, settings.how_long_to_show, popup);
                }
            }, interval, obj);
        }

        this.makingPopup = function (obj) {
            settings.content = obj.popups[settings.counter];
            var popup;
            if (settings.content != undefined) {
                var popup = $(window).pi_notification(settings);
            } else {
                if (settings.loop) {
                    settings.counter = 0;
                }
            }
            return popup;
        }
        this.getOrders();
    }

    jQuery(function ($) {
        $(window).pi_notification_runner();
    })

    /**
     * 
     * Shuffle used to shuffle value,
     *  so even if there is server caching of content user will get random output 
     */
    function shuffle(array) {
        var currentIndex = array.length, temporaryValue, randomIndex;

        // While there remain elements to shuffle...
        while (0 !== currentIndex) {

            // Pick a remaining element...
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;

            // And swap it with the current element.
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    }

})(jQuery);