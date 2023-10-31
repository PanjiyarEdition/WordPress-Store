(function($){
    "use strict";
    let functions = {
        gaPageview: function(term) {
            let $this = this;
            let tracking_id = $this.gaGetTrackingID();
            // noinspection JSUnresolvedVariable
            if ( typeof ASL.analytics == 'undefined' || ASL.analytics.method != 'pageview' )
                return false;
            // noinspection JSUnresolvedVariable
            if ( ASL.analytics.string != '' ) {
                // YOAST uses __gaTracker, if not defined check for ga, if nothing go null, FUN EH??
                // noinspection JSUnresolvedVariable
                let _ga = typeof __gaTracker == "function" ? __gaTracker : (typeof ga == "function" ? ga : false);
                let _gtag = typeof gtag == "function" ? gtag : false;

                if (!window.location.origin) {
                    window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
                }
                // Multisite Subdirectory (if exists)
                // noinspection JSUnresolvedVariable
                let url = $this.o.homeurl.replace(window.location.origin, '');

                // GTAG bypass pageview tracking method
                if ( _gtag !== false ) {
                    if ( tracking_id !== false ) {
                        // noinspection JSUnresolvedVariable
                        tracking_id.forEach(function(id) {
                            _gtag('config', id, {'page_path': url + ASL.analytics.string.replace("{asl_term}", term)});
                        });
                    }
                } else if ( _ga !== false ) {
                    let params = {
                        'page': url + ASL.analytics.string.replace("{asl_term}", term),
                        'title': 'Ajax Search'
                    };
                    if ( tracking_id !== false ) {
                        tracking_id.forEach(function(id) {
                            _ga('create', id, 'auto');
                            _ga('send', 'pageview', params);
                        });
                    } else {
                        _ga('send', 'pageview', params);
                    }
                }
            }
        },

        gaEvent: function(which, data) {
            let $this = this;
            let tracking_id = $this.gaGetTrackingID();
            // noinspection JSUnresolvedVariable
            if ( typeof ASL.analytics == 'undefined' || ASL.analytics.method != 'event' )
                return false;

            // Get the scope
            let _gtag = typeof gtag == "function" ? gtag : false;
            // noinspection JSUnresolvedVariable
            let _ga = typeof window.__gaTracker == "function" ? window.__gaTracker :
                (typeof window.ga == "function" ? window.ga : false);

            if ( _gtag === false && _ga === false && typeof window.dataLayer == 'undefined'  )
                return false;

            // noinspection JSUnresolvedVariable
            if (
                typeof (ASL.analytics.event[which]) != 'undefined' &&
                ASL.analytics.event[which].active == 1
            ) {
                let def_data = {
                    "search_id": $this.o.id,
                    "search_name": $this.o.name,
                    "phrase": $this.n('text').val(),
                    "option_name": '',
                    "option_value": '',
                    "result_title": '',
                    "result_url": '',
                    "results_count": ''
                };
                // noinspection JSUnresolvedVariable
                let event = {
                    'event_category': ASL.analytics.event[which].category,
                    'event_label': ASL.analytics.event[which].label,
                    'value': ASL.analytics.event[which].value
                };
                data = $.fn.extend(def_data, data);
                Object.keys(data).forEach(function (k) {
                    let v = data[k];
                    v = String(v).replace(/[\s\n\r]+/g, " ").trim();
                    Object.keys(event).forEach(function (kk) {
                        let regex = new RegExp('\{' + k + '\}', 'gmi');
                        event[kk] = event[kk].replace(regex, v);
                    });
                });

                if ( _ga !== false ) {
                    if ( tracking_id !== false ) {
                        tracking_id.forEach(function(id){
                            _ga('create', id, 'auto');
                            // noinspection JSUnresolvedVariable
                            _ga('send', 'event',
                                event.event_category,
                                ASL.analytics.event[which].action,
                                event.event_label,
                                event.value
                            );
                        });
                    } else {
                        // noinspection JSUnresolvedVariable
                        _ga('send', 'event',
                            event.event_category,
                            ASL.analytics.event[which].action,
                            event.event_label,
                            event.value
                        );
                    }
                } else if ( _gtag !== false ) {
                    if ( tracking_id !== false ) {
                        tracking_id.forEach(function(id){
                            event.send_to = id;
                            // noinspection JSUnresolvedVariable
                            _gtag('event', ASL.analytics.event[which].action, event);
                        });
                    } else {
                        // noinspection JSUnresolvedVariable
                        _gtag('event', ASL.analytics.event[which].action, event);
                    }
                } else if ( typeof window.dataLayer.push != 'undefined' ) {
                    window.dataLayer.push({
                        'event': 'gaEvent',
                        'eventCategory': event.event_category,
                        'eventAction': ASL.analytics.event[which].action,
                        'eventLabel': event.event_label
                    });
                }
            }
        },

        gaGetTrackingID: function() {
            let ret = false;
            // noinspection JSUnresolvedVariable
            if ( typeof ASL.analytics == 'undefined' )
                return ret;

            // noinspection JSUnresolvedVariable
            if ( typeof ASL.analytics.tracking_id != 'undefined' && ASL.analytics.tracking_id != '' ) {
                // noinspection JSUnresolvedVariable
                return [ASL.analytics.tracking_id];
            } else {
                // GTAG bypass pageview tracking method
                let _gtag = typeof window.gtag == "function" ? window.gtag : false;
                if ( _gtag === false && typeof window.ga != 'undefined' && typeof window.ga.getAll != 'undefined' ) {
                    let id = [];
                    window.ga.getAll().forEach( function(tracker) {
                        id.push( tracker.get('trackingId') );
                    });
                    return id.length > 0 ? id : false;
                }
            }

            return ret;
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);