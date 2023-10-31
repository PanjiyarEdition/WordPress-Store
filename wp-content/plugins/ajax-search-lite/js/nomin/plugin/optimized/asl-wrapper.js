window._ASL_load = function () {
    "use strict";
    let $ = WPD.dom;

    window.ASL.instances = {
        instances: [],
        get: function(id, instance) {
            this.clean();
            if ( typeof id === 'undefined' || id == 0) {
                return this.instances;
            } else {
                if ( typeof instance === 'undefined' ) {
                    let ret = [];
                    for ( let i=0; i<this.instances.length; i++ ) {
                        if ( this.instances[i].o.id == id ) {
                            ret.push(this.instances[i]);
                        }
                    }
                    return ret.length > 0 ? ret : false;
                } else {
                    for ( let i=0; i<this.instances.length; i++ ) {
                        if ( this.instances[i].o.id == id && this.instances[i].o.iid == instance ) {
                            return this.instances[i];
                        }
                    }
                }
            }
            return false;
        },
        set: function(obj) {
            if ( !this.exist(obj.o.id, obj.o.iid) ) {
                this.instances.push(obj);
                return true;
            } else {
                return false;
            }
        },
        exist: function(id, instance) {
            this.clean();
            for ( let i=0; i<this.instances.length; i++ ) {
                if ( this.instances[i].o.id == id ) {
                    if (typeof instance === 'undefined') {
                        return true;
                    } else if (this.instances[i].o.iid == instance) {
                        return true;
                    }
                }
            }
            return false;
        },
        clean: function() {
            let unset = [], _this = this;
            this.instances.forEach(function(v, k){
                if ( $('.asl_m_' + v.o.rid).length == 0 ) {
                    unset.push(k);
                }
            });
            unset.forEach(function(k){
                if ( typeof _this.instances[k] !== 'undefined' ) {
                    _this.instances[k].destroy();
                    _this.instances.splice(k, 1);
                }
            });
        },
        destroy: function(id, instance) {
            let i = this.get(id, instance);
            if ( i !== false ) {
                if ( Array.isArray(i) ) {
                    i.forEach(function (s) {
                        s.destroy();
                    });
                    this.instances = [];
                } else {
                    let u = 0;
                    this.instances.forEach(function(v, k){
                        if ( v.o.id == id && v.o.iid == instance) {
                            u = k;
                        }
                    });
                    i.destroy();
                    this.instances.splice(u, 1);
                }
            }
        }
    };

    window.ASL.initialized = false;
    window.ASL.initializeSearchByID = function (id) {
        let instances = ASL.getInstances();
        if (typeof id !== 'undefined' && typeof id != 'object' ) {
            if ( typeof instances[id] !== 'undefined' ) {
                let ni = [];
                ni[id] = instances[id];
                instances = ni;
            } else {
                return false;
            }
        }
        let initialized = 0;
        instances.forEach(function (data, i) {
            // Menu or invalid node detection and replacement
            $('.asl_w_container_' + i).forEach(function(el){
                let $p = $(el).parent();
                if ( $p.is('a') ) {
                    let div = document.createElement('div'),
                        p = $p.get(0);
                    div.innerHTML = p.innerHTML;
                    p.replaceWith(div);
                }
            });
            // noinspection JSUnusedAssignment
            $('.asl_m_' + i).forEach(function(el){
                let $el = $(el);
                if ( typeof $el.get(0).hasAsl != 'undefined') {
                    ++initialized;
                    return true;
                }
                el.hasAsl = true;
                ++initialized;
                return $el.ajaxsearchlite(data);
            });
        });
    }

    window.ASL.getInstances = function() {
        // noinspection JSUnresolvedVariable
        if ( typeof window.ASL_INSTANCES !== 'undefined' ) {
            // noinspection JSUnresolvedVariable
            return window.ASL_INSTANCES;
        } else {
            let instances = [];
            $('.asl_init_data').forEach(function (el) {
                if (typeof el.dataset['asldata'] === "undefined") return true;   // Do not return false, it breaks the loop!
                let data = WPD.Base64.decode(el.dataset['asldata']);
                if (typeof data === "undefined" || data == "") return true;

                instances[el.dataset['aslId']] = JSON.parse(data);
            });
            return instances;
        }
    }

    window.ASL.initialize = function (id) {
        // Some weird ajax loader problem prevention
        if (typeof ASL.version == 'undefined')
            return false;

        if( !!window.IntersectionObserver ){
            if ( ASL.script_async_load || ASL.init_only_in_viewport ) {
                let searches = document.querySelectorAll('.asl_w_container');
                if ( searches.length ) {
                    let observer = new IntersectionObserver(function(entries){
                        entries.forEach(function(entry){
                            if ( entry.isIntersecting ) {
                                ASL.initializeSearchByID(entry.target.dataset.id);
                                observer.unobserve(entry.target);
                            }
                        });
                    });
                    searches.forEach(function(search){
                        observer.observe(search);
                    });
                }
            } else {
                ASL.initializeSearchByID(id);
            }
        } else {
            ASL.initializeSearchByID(id);
        }

        ASL.initializeMutateDetector();
        ASL.initializeHighlight();
        ASL.initializeOtherEvents();

        ASL.initialized = true;
    };

    window.ASL.initializeHighlight = function() {
        let _this = this;
        if (_this.highlight.enabled) {
            let data = localStorage.getItem('asl_phrase_highlight');
            localStorage.removeItem('asl_phrase_highlight');
            if (data != null) {
                data = JSON.parse(data);
                _this.highlight.data.forEach(function (o) {
                    let selector = o.selector != '' && $(o.selector).length > 0 ? o.selector : 'article',
                        $highlighted;
                    selector = $(selector).length > 0 ? selector : 'body';
                    // noinspection JSUnresolvedVariable
                    $(selector).highlight(data.phrase, {
                        element: 'span',
                        className: 'asl_single_highlighted',
                        wordsOnly: o.whole,
                        excludeParents: '.asl_w, .asl-try'
                    });
                    $highlighted = $('.asl_single_highlighted');
                    if (o.scroll && $highlighted.length > 0) {
                        let stop = $highlighted.offset().top - 120;
                        let $adminbar = $("#wpadminbar");
                        if ($adminbar.length > 0)
                            stop -= $adminbar.height();
                        // noinspection JSUnresolvedVariable
                        stop = stop + o.scroll_offset;
                        stop = stop < 0 ? 0 : stop;
                        $('html').animate({
                            "scrollTop": stop
                        }, 500);
                    }
                    return false;
                });
            }
        }
    };

    window.ASL.initializeOtherEvents = function() {
        let ttt, ts, $body = $('body'), _this = this;
        // Known slide-out and other type of menus to initialize on click
        ts = '#menu-item-search, .fa-search, .fa, .fas';
        // Avada theme
        ts = ts + ', .fusion-flyout-menu-toggle, .fusion-main-menu-search-open';
        // Be theme
        ts = ts + ', #search_button';
        // The 7 theme
        ts = ts + ', .mini-search.popup-search';
        // Flatsome theme
        ts = ts + ', .icon-search';
        // Enfold theme
        ts = ts + ', .menu-item-search-dropdown';
        // Uncode theme
        ts = ts + ', .mobile-menu-button';
        // Newspaper theme
        ts = ts + ', .td-icon-search, .tdb-search-icon';
        // Bridge theme
        ts = ts + ', .side_menu_button, .search_button';
        // Jupiter theme
        ts = ts + ', .raven-search-form-toggle';
        // Elementor trigger lightbox & other elementor stuff
        ts = ts + ', [data-elementor-open-lightbox], .elementor-button-link, .elementor-button';
        ts = ts + ', i[class*=-search], a[class*=-search]';

        // Attach this to the document ready, as it may not attach if this is loaded early
        $body.on('click touchend', ts, function () {
            clearTimeout(ttt);
            ttt = setTimeout(function () {
                _this.initializeSearchByID();
            }, 300);
        });

        // Elementor popup events (only works with jQuery)
        if ( typeof jQuery != 'undefined' ) {
            jQuery(document).on('elementor/popup/show', function(){
                setTimeout(function () {
                    _this.initializeSearchByID();
                }, 10);
            });
        }
    };

    window.ASL.initializeMutateDetector = function() {
        let t;
        if ( typeof ASL.detect_ajax != "undefined" && ASL.detect_ajax == 1 ) {
            let o = new MutationObserver(function() {
                clearTimeout(t);
                t = setTimeout(function () {
                    ASL.initializeSearchByID();
                }, 500);
            });
            o.observe(document.querySelector("body"), {subtree: true, childList: true});
        }
    };

    window.ASL.ready = function () {
        let _this = this;

        if (document.readyState === "complete" || document.readyState === "loaded"  || document.readyState === "interactive") {
            // document is already ready to go
            _this.initialize();
        } else {
            $(document).on('DOMContentLoaded', _this.initialize);
        }
    };

    window.ASL.loadScriptStack = function (stack) {
        let scriptTag;
        if ( stack.length > 0 ) {
            scriptTag = document.createElement('script');
            scriptTag.src = stack.shift()['src'];
            scriptTag.onload = function () {
                if ( stack.length > 0 ) {
                    window.ASL.loadScriptStack(stack)
                } else {
                    window.ASL.ready();
                }
            }
            document.body.appendChild(scriptTag);
        }
    }

    window.ASL.init = function () {
        // noinspection JSUnresolvedVariable
        if (ASL.script_async_load) {   // Opimized Normal
            // noinspection JSUnresolvedVariable
            window.ASL.loadScriptStack(ASL.additional_scripts);
        } else {
            if (typeof WPD.ajaxsearchlite !== 'undefined') {   // Classic normal
                window.ASL.ready();
            }
        }
    };

    window.WPD.intervalUntilExecute(window.ASL.init, function() {
        return typeof window.ASL.version != 'undefined' && $.fn.ajaxsearchlite != 'undefined'
    });
};
// Run on document ready
(function() {
    // Preload script executed?
    if ( typeof WPD != 'undefined' && typeof WPD.dom != 'undefined' ) {
        window._ASL_load();
    } else {
        document.addEventListener('wpd-dom-core-loaded', window._ASL_load);
    }
})();