(function(){
    "use strict";

    window.WPD = typeof window.WPD !== 'undefined' ? window.WPD : {};
    window.WPD.ajaxsearchlite = new function (){
        this.prevState = null;
        this.firstIteration = true;
        this.helpers = {};
        this.plugin = {};
        this.addons = {
            addons: [],
            add: function(addon) {
                if ( this.addons.indexOf(addon) == -1 ) {
                    let k = this.addons.push(addon);
                    this.addons[k-1].init();
                }
            },
            remove: function(name) {
                this.addons.filter(function(addon){
                    if ( addon.name == name ) {
                        if ( typeof addon.destroy != 'undefined' ) {
                            addon.destroy();
                        }
                        return false;
                    } else {
                        return true;
                    }
                });
            }
        }
    };
})();(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        setFilterStateInput: function( timeout ) {
            let $this = this;
            if ( typeof timeout == 'undefined' ) {
                timeout = 65;
            }
            let process = function(){
                if ( JSON.stringify($this.originalFormData) != JSON.stringify(helpers.formData($('form', $this.n('searchsettings'))) ) )
                    $this.n('searchsettings').find('input[name=filters_initial]').val(0);
                else
                    $this.n('searchsettings').find('input[name=filters_initial]').val(1);
            };
            if ( timeout == 0 ) {
                process();
            } else {
                // Need a timeout > 50, as some checkboxes are delayed (parent-child selection)
                setTimeout(function () {
                    process();
                }, timeout);
            }
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        liveLoad: function(selector, url, updateLocation, forceAjax) {
            if ( selector == 'body' || selector == 'html' ) {
                console.log('Ajax Search Pro: Do not use html or body as the live loader selector.');
                return false;
            }

            // Store the current page HTML for the live loaders
            // It needs to be requested here as the dom does store the processed HTML, and it is no good.
            if ( ASL.pageHTML == "" ) {
                if ( typeof ASL._ajax_page_html === 'undefined' ) {
                    ASL._ajax_page_html = true;
                    $.fn.ajax({
                        url: location.href,
                        method: 'GET',
                        success: function(data){
                            ASL.pageHTML = data;
                        },
                        dataType: 'html'
                    });
                }
            }

            function process(data) {
                data = helpers.Hooks.applyFilters('asl/live_load/raw_data', data, $this);
                let parser = new DOMParser;
                let dataNode = parser.parseFromString(data, "text/html");
                let $dataNode = $(dataNode);

                // noinspection JSUnresolvedVariable
                if ( $this.o.statistics ) {
                    $this.stat_addKeyword($this.o.id, $this.n('text').val());
                }
                if ( data != '' && $dataNode.length > 0 && $dataNode.find(selector).length > 0 ) {
                    data = data.replace(/&asl_force_reset_pagination=1/gmi, '');
                    data = data.replace(/%26asl_force_reset_pagination%3D1/gmi, '');
                    data = data.replace(/&#038;asl_force_reset_pagination=1/gmi, '');

                    // Safari having issues with srcset when ajax loading
                    if ( helpers.isSafari() ) {
                        data = data.replace(/srcset/gmi, 'nosrcset');
                    }

                    data = helpers.Hooks.applyFilters('asl/live_load/html', data, $this.o.id, $this.o.iid);
                    data = helpers.wp_hooks_apply_filters('asl/live_load/html', data, $this.o.id, $this.o.iid);
                    $dataNode = $(parser.parseFromString(data, "text/html"));

                    //$el.replaceWith($dataNode.find(selector).first());
                    let replacementNode = $dataNode.find(selector).get(0);
                    replacementNode = helpers.Hooks.applyFilters('asl/live_load/replacement_node', replacementNode, $this, $el.get(0), data);
                    if ( replacementNode != null ) {
                        $el.get(0).parentNode.replaceChild(replacementNode, $el.get(0));
                    }

                    // get the element again, as it no longer exists
                    $el = $(selector).first();
                    if ( updateLocation ) {
                        document.title = dataNode.title;
                        history.pushState({}, null, url);
                    }

                    // WooCommerce ordering fix
                    $(selector).first().find(".woocommerce-ordering").on("change","select.orderby", function(){
                        $(this).closest("form").trigger('submit');
                    });

                    // Single highlight on live results
                    // noinspection JSUnresolvedVariable
                    if ( $this.o.singleHighlight == 1 ) {
                        $(selector).find('a').on('click', function(){
                            localStorage.removeItem('asl_phrase_highlight');
                            if ( helpers.unqoutePhrase( $this.n('text').val() ) != '' )
                                localStorage.setItem('asl_phrase_highlight', JSON.stringify({
                                    'phrase': helpers.unqoutePhrase( $this.n('text').val() )
                                }));
                        });
                    }

                    helpers.Hooks.applyFilters('asl/live_load/finished', url, $this, selector, $el.get(0));

                    // noinspection JSUnresolvedVariable
                    ASL.initialize();
                    $this.lastSuccesfulSearch = $('form', $this.n('searchsettings')).serialize() + $this.n('text').val().trim();
                    $this.lastSearchData = data;
                }
                $this.n('s').trigger("asl_search_end", [$this.o.id, $this.o.iid, $this.n('text').val(), data], true, true);
                $this.gaEvent?.('search_end', {'results_count': 'unknown'});
                $this.gaPageview?.($this.n('text').val());
                $this.hideLoader();
                $el.css('opacity', 1);
                $this.searching = false;
                if ( $this.n('text').val() != '' ) {
                    $this.n('proclose').css({
                        display: "block"
                    });
                }
            }

            updateLocation = typeof updateLocation == 'undefined' ? true : updateLocation;
            forceAjax = typeof forceAjax == 'undefined' ? false : forceAjax;

            // Alternative possible selectors from famous themes
            let altSel = [
                '.search-content',
                '#content', '#Content', 'div[role=main]',
                'main[role=main]', 'div.theme-content', 'div.td-ss-main-content',
                'main.l-content', '#primary'
            ];
            if ( selector != '#main' )
                altSel.unshift('#main');

            if ( $(selector).length < 1 ) {
                altSel.forEach(function(s){
                    if ( $(s).length > 0 ) {
                        selector = s;
                        return false;
                    }
                });
                if ( $(selector).length < 1 ) {
                    console.log('Ajax Search Lite: The live search selector does not exist on the page.');
                    return false;
                }
            }

            selector = helpers.Hooks.applyFilters('asl/live_load/selector', selector, this);

            let $el = $(selector).first(),
                $this = this;

            $this.searchAbort();
            $el.css('opacity', 0.4);

            helpers.Hooks.applyFilters('asl/live_load/start', url, $this, selector, $el.get(0));

            if (
                !forceAjax &&
                $this.n('searchsettings').find('input[name=filters_initial]').val() == 1 &&
                $this.n('text').val() == ''
            ) {
                window.WPD.intervalUntilExecute(function(){
                    process(ASL.pageHTML);
                }, function(){
                    return ASL.pageHTML != ''
                });
            } else {
                $this.searching = true;
                $this.post = $.fn.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data){
                        process(data);
                    },
                    dataType: 'html',
                    fail: function(jqXHR){
                        $el.css('opacity', 1);
                        if ( jqXHR.aborted ) {
                            return;
                        }
                        $el.html("This request has failed. Please check your connection.");
                        $this.hideLoader();
                        $this.searching = false;
                        $this.n('proclose').css({
                            display: "block"
                        });
                    }
                });
            }
        },
        getCurrentLiveURL: function() {
            let $this = this;
            let url = 'asl_ls=' + helpers.nicePhrase( $this.n('text').val() ),
                start = '&',
                location = window.location.href;

            // Correct previous query arguments (in case of paginated results)
            location = location.indexOf('asl_ls=') > -1 ? location.slice(0, location.indexOf('asl_ls=')) : location;
            location = location.indexOf('asl_ls&') > -1 ? location.slice(0, location.indexOf('asl_ls&')) : location;

            // Was asl_ls missing but there are ASL related arguments? (ex. when using ASL.api('getStateURL'))
            location = location.indexOf('p_asid=') > -1 ? location.slice(0, location.indexOf('p_asid=')) : location;
            location = location.indexOf('asl_') > -1 ? location.slice(0, location.indexOf('asl_')) : location;

            if ( location.indexOf('?') === -1 ) {
                start = '?';
            }

            let final = location + start + url + "&asl_active=1&asl_force_reset_pagination=1&p_asid=" +
                $this.o.id + "&p_asl_data=1&" + $('form', $this.n('searchsettings')).serialize();
            // Possible issue when the URL ends with '?' and the start is '&'
            final = final.replace('?&', '?');

            return final;
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        showLoader: function( ) {
            this.n('proloading').css({
                display: "block"
            });
        },

        hideLoader: function( ) {
            let $this = this;

            $this.n('proloading').css({
                display: "none"
            });
            $this.n('results').css("display", "");
        },
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        loadASLFonts: function() {
            if ( ASL.font_url !== false ) {
                let font = new FontFace(
                    'aslsicons2',
                    'url(' + ASL.font_url + ')',
                    { style: 'normal', weight: 'normal', 'font-display': 'swap' }
                );
                font.load().then(function(loaded_face) {
                    document.fonts.add(loaded_face);
                }).catch(function(er) {});
                ASL.font_url = false;
            }
        },

        /**
         * Updates the document address bar with the ajax live search attributes, without push state
         */
        updateHref: function( ) {
            if ( this.o.trigger.update_href && !this.usingLiveLoader ) {
                if (!window.location.origin) {
                    window.location.origin = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
                }
                let url = this.getStateURL() + (this.resultsOpened ? '&asl_s=' : '&asl_ls=') + this.n('text').val();
                history.replaceState('', '', url.replace(location.origin, ''));
            }
        },

        /**
         * Checks if an element with the same ID and Instance was already registered
         */
        fixClonedSelf: function() {
            let $this = this,
                oldInstanceId = $this.o.iid,
                oldRID = $this.o.rid;
            while ( !ASL.instances.set($this) ) {
                ++$this.o.iid;
                if ($this.o.iid > 50) {
                    break;
                }
            }
            // oof, this was cloned
            if ( oldInstanceId != $this.o.iid ) {
                $this.o.rid = $this.o.id + '_' + $this.o.iid;
                $this.n('search').get(0).id = "ajaxsearchlite" + $this.o.rid;
                $this.n('search').removeClass('asl_m_' + oldRID).addClass('asl_m_' + $this.o.rid).data('instance', $this.o.iid);
                $this.n('searchsettings').get(0).id = $this.n('searchsettings').get(0).id.replace('settings'+ oldRID, 'settings' + $this.o.rid);
                if ( $this.n('searchsettings').hasClass('asl_s_' + oldRID) ) {
                    $this.n('searchsettings').removeClass('asl_s_' + oldRID)
                        .addClass('asl_s_' + $this.o.rid).data('instance', $this.o.iid);
                } else {
                    $this.n('searchsettings').removeClass('asl_sb_' + oldRID)
                        .addClass('asl_sb_' + $this.o.rid).data('instance', $this.o.iid);
                }
                $this.n('resultsDiv').get(0).id = $this.n('resultsDiv').get(0).id.replace('prores'+ oldRID, 'prores' + $this.o.rid);
                $this.n('resultsDiv').removeClass('asl_r_' + oldRID)
                    .addClass('asl_r_' + $this.o.rid).data('instance', $this.o.iid);
                $this.n('container').find('.asl_init_data').data('instance', $this.o.iid);
                $this.n('container').find('.asl_init_data').get(0).id =
                    $this.n('container').find('.asl_init_data').get(0).id.replace('asl_init_id_'+ oldRID, 'asl_init_id_' + $this.o.rid);

                $this.n('prosettings').data('opened', 0);
            }
        },
        destroy: function () {
            let $this = this;
            Object.keys($this.nodes).forEach(function(k){
               $this.nodes[k].off?.();
            });
            $this.n('searchsettings').remove?.();
            $this.n('resultsDiv').remove?.();
            $this.n('search').remove?.();
            $this.n('container').remove?.();
            $this.documentEventHandlers.forEach(function(h){
                $(h.node).off(h.event, h.handler);
            });
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);// noinspection HttpUrlsUsage,JSUnresolvedVariable

(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        isRedirectToFirstResult: function() {
            let $this = this;
            // noinspection JSUnresolvedVariable
            return (
                    $('.asl_res_url', $this.n('resultsDiv')).length > 0 ||
                    $('.asl_es_' + $this.o.id + ' a').length > 0 ||
                    ( $this.o.resPage.useAjax && $($this.o.resPage.selector + 'a').length > 0)
                ) &&
                (
                    ($this.o.redirectOnClick == 1 && $this.ktype == 'click' && $this.o.trigger.click == 'first_result') ||
                    ($this.o.redirectOnEnter == 1 && ($this.ktype == 'input' || $this.ktype == 'keyup') && $this.keycode == 13 && $this.o.trigger.return == 'first_result')
                );
        },

        doRedirectToFirstResult: function() {
            let $this = this,
                _loc, url;

            if ( $this.ktype == 'click' ) {
                _loc = $this.o.trigger.click_location;
            } else {
                _loc = $this.o.trigger.return_location;
            }

            if ( $('.asl_res_url', $this.n('resultsDiv')).length > 0 ) {
                url =  $( $('.asl_res_url', $this.n('resultsDiv')).get(0) ).attr('href');
            } else if ( $('.asl_es_' + $this.o.id + ' a').length > 0 ) {
                url =  $( $('.asl_es_' + $this.o.id + ' a').get(0) ).attr('href');
            } else if ( $this.o.resPage.useAjax && $($this.o.resPage.selector + 'a').length > 0 ) {
                url =  $( $($this.o.resPage.selector + 'a').get(0) ).attr('href');
            }

            if ( url != '' ) {
                if (_loc == 'same') {
                    location.href = url;
                } else {
                    helpers.openInNewTab(url);
                }

                $this.hideLoader();
                $this.hideResults();
            }
            return false;
        },

        doRedirectToResults: function( ktype ) {
            let $this = this,
                _loc;

            if ( ktype == 'click' ) {
                _loc = $this.o.trigger.click_location;
            } else {
                _loc = $this.o.trigger.return_location;
            }
            let url = $this.getRedirectURL(ktype);

            // noinspection JSUnresolvedVariable
            if ($this.o.overridewpdefault) {
                // noinspection JSUnresolvedVariable
                if ( $this.o.resPage.useAjax == 1 ) {
                    $this.hideResults();
                    // noinspection JSUnresolvedVariable
                    $this.liveLoad($this.o.resPage.selector, url);
                    $this.showLoader();
                    if ($this.o.blocking == false) {
                        $this.hideSettings();
                    }
                    return false;
                }
                // noinspection JSUnresolvedVariable
                if ( $this.o.override_method == "post") {
                    helpers.submitToUrl(url, 'post', {
                        asl_active: 1,
                        p_asl_data: $('form', $this.n('searchsettings')).serialize()
                    }, _loc);
                } else {
                    if ( _loc == 'same' ) {
                        location.href = url;
                    } else {
                        helpers.openInNewTab(url);
                    }
                }
            } else {
                // The method is not important, just send the data to memorize settings
                helpers.submitToUrl(url, 'post', {
                    np_asl_data: $('form', $this.n('searchsettings')).serialize()
                }, _loc);
            }

            $this.n('proloading').css('display', 'none');
            $this.hideLoader();
            $this.hideResults();
            $this.searchAbort();
        },
        getRedirectURL: function(ktype) {
            let $this = this,
                url, source, final, base_url;
            ktype = typeof ktype !== 'undefined' ? ktype : 'enter';

            if ( ktype == 'click' ) {
                source = $this.o.trigger.click;
            } else {
                source = $this.o.trigger.return;
            }

            if ( source == 'results_page' || source == 'ajax_search' ) {
                url = '?s=' + helpers.nicePhrase( $this.n('text').val() );
            } else if ( source == 'woo_results_page' ) {
                url = '?post_type=product&s=' + helpers.nicePhrase( $this.n('text').val() );
            } else {
                base_url = $this.o.trigger.redirect_url;
                url = base_url.replace(/{phrase}/g, helpers.nicePhrase( $this.n('text').val() ));
            }
            // Is this an URL like xy.com/?x=y
            if ( $this.o.homeurl.indexOf('?') > 1 && url.indexOf('?') === 0 ) {
                url = url.replace('?', '&');
            }

            if ( $this.o.overridewpdefault && $this.o.override_method != 'post' ) {
                // We are about to add a query string to the URL, so it has to contain the '?' character somewhere.
                // ..if not, it has to be added
                let start = '&';
                if ( $this.o.homeurl.indexOf('?') === -1 && url.indexOf('?') === -1 ) {
                    start = '?';
                }
                let addUrl = url + start + "asl_active=1&p_asl_data=1&" + $('form', $this.n('searchsettings')).serialize();
                final = $this.o.homeurl + addUrl;
            } else {
                final = $this.o.homeurl + url;
            }

            // Double backslashes - negative lookbehind (?<!:) is not supported in all browsers yet, ECMA2018
            // This section should be only: final.replace(//(?<!:)\/\//g, '/');
            // Bypass solution, but it works at least everywhere
            final = final.replace('https://', 'https:///');
            final = final.replace('http://', 'http:///');
            final = final.replace(/\/\//g, '/');

            final = helpers.Hooks.applyFilters('asl/redirect/url', final, $this.o.id, $this.o.iid);
            final = helpers.wp_hooks_apply_filters('asl/redirect/url', final, $this.o.id, $this.o.iid);

            return final;
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        showResults: function( ) {
            let $this = this;

            $this.initResults();

            // Create the scrollbars if needed
            $this.createVerticalScroll();
            $this.showVerticalResults();

            $this.hideLoader();

            $this.n('proclose').css({
                display: "block"
            });

            if ($this.n('showmore') != null) {
                if ($this.n('items').length > 0) {
                    $this.n('showmore').css({
                        'display': 'block'
                    });
                } else {
                    $this.n('showmore').css({
                        'display': 'none'
                    });
                }
            }

            if ( typeof WPD.lazy != 'undefined' ) {
                setTimeout(function(){
                    // noinspection JSUnresolvedVariable
                    WPD.lazy('.asl_lazy');
                }, 100)
            }

            $this.resultsOpened = true;
        },

        hideResults: function( blur ) {
            let $this = this;
            blur = typeof blur == 'undefined' ? true : blur;

            if ( !$this.resultsOpened ) return false;

            $this.n('resultsDiv').removeClass($this.resAnim.showClass).addClass($this.resAnim.hideClass);
            setTimeout(function(){
                $this.n('resultsDiv').css($this.resAnim.hideCSS);
            }, $this.resAnim.duration);

            $this.n('proclose').css({
                display: "none"
            });

            if ( helpers.isMobile() && blur )
                document.activeElement.blur();

            $this.resultsOpened = false;

            $this.n('s').trigger("asl_results_hide", [$this.o.id, $this.o.iid], true, true);
        },

        showResultsBox: function() {
            let $this = this;

            $this.n('s').trigger("asl_results_show", [$this.o.id, $this.o.iid], true, true);

            $this.n('resultsDiv').css({
                display: 'block',
                height: 'auto'
            });

            $this.n('resultsDiv').css($this.resAnim.showCSS);
            $this.n('resultsDiv').removeClass($this.resAnim.hideClass).addClass($this.resAnim.showClass);

            $this.fixResultsPosition(true);
        },

        scrollToResults: function( ) {
            let $this = this,
                tolerance = Math.floor( window.innerHeight * 0.1 ),
                stop;

            if (
                !$this.resultsOpened ||
                $this.o.scrollToResults.enabled !=1 ||
                $this.n('resultsDiv').inViewPort(tolerance)
            ) return;

            if ($this.o.resultsposition == "hover") {
                stop = $this.n('probox').offset().top - 20;
            } else {
                stop = $this.n('resultsDiv').offset().top - 20;
            }
            stop = stop + $this.o.scrollToResults.offset;

            let $adminbar = $("#wpadminbar");
            if ($adminbar.length > 0)
                stop -= $adminbar.height();
            stop = stop < 0 ? 0 : stop;
            window.scrollTo({top: stop, behavior:"smooth"});
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        createVerticalScroll: function () {}
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);// noinspection JSUnresolvedVariable

(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        searchAbort: function() {
            let $this = this;
            if ( $this.post != null ) {
                $this.post.abort();
            }
        },

        searchWithCheck: function( timeout ) {
            let $this = this;
            if ( typeof timeout == 'undefined' )
                timeout = 50;

            if ($this.n('text').val().length < $this.o.charcount) return;
            $this.searchAbort();

            clearTimeout($this.timeouts.searchWithCheck);
            $this.timeouts.searchWithCheck = setTimeout(function() {
                $this.search();
            }, timeout);
        },

        search: function () {
            let $this = this;

            if ($this.searching && 0) return;
            if ($this.n('text').val().length < $this.o.charcount) return;

            $this.searching = true;
            $this.n('proloading').css({
                display: "block"
            });
            $this.n('proclose').css({
                display: "none"
            });

            let data = {
                action: 'ajaxsearchlite_search',
                aslp: $this.n('text').val(),
                asid: $this.o.id,
                options: $('form', $this.n('searchsettings')).serialize()
            };

            data = helpers.Hooks.applyFilters('asl/search/data', data);
            data = helpers.wp_hooks_apply_filters('asl/search/data', data);

            if ( JSON.stringify(data) === JSON.stringify($this.lastSearchData) ) {
                if ( !$this.resultsOpened )
                    $this.showResults();
                $this.hideLoader();
                if ( $this.isRedirectToFirstResult() ) {
                    $this.doRedirectToFirstResult();
                    return false;
                }
                return false;
            }

            $this.gaEvent?.('search_start');

            if ( $('.asl_es_' + $this.o.id).length > 0 ) {
                $this.liveLoad('.asl_es_' + $this.o.id, $this.getCurrentLiveURL(), false);
            } else if ( $this.o.resPage.useAjax ) {
                $this.liveLoad($this.o.resPage.selector, $this.getRedirectURL());
            } else {
                $this.post = $.fn.ajax({
                    'url': ASL.ajaxurl,
                    'method': 'POST',
                    'data': data,
                    'success': function (response) {
                        response = response.replace(/^\s*[\r\n]/gm, "");
                        response = response.match(/___ASLSTART___(.*[\s\S]*)___ASLEND___/)[1];

                        response = helpers.Hooks.applyFilters('asl/search/html', response);
                        response = helpers.wp_hooks_apply_filters('asl/search/html', response);

                        $this.n('resdrg').html("");
                        $this.n('resdrg').html(response);

                        $(".asl_keyword", $this.n('resdrg')).on('click', function () {
                            $this.n('text').val($(this).html());
                            $('input.orig', $this.n('container')).val($(this).html()).trigger('keydown');
                            $('form', $this.n('container')).trigger('submit', 'ajax');
                            $this.search();
                        });

                        $this.nodes.items = $('.item', $this.n('resultsDiv'));

                        $this.gaEvent?.('search_end', {'results_count': $this.n('items').length});

                        $this.gaPageview?.($this.n('text').val());

                        if ($this.isRedirectToFirstResult()) {
                            $this.doRedirectToFirstResult();
                            return false;
                        }

                        $this.hideLoader();
                        $this.showResults();
                        $this.scrollToResults();
                        $this.lastSuccesfulSearch = $('form', $this.n('searchsettings')).serialize() + $this.n('text').val().trim();
                        $this.lastSearchData = data;

                        $this.updateHref();

                        if ($this.n('items').length == 0) {
                            if ($this.n('showmore') != null) {
                                $this.n('showmore').css('display', 'none');
                            }
                        } else {
                            if ($this.n('showmore') != null) {
                                $this.n('showmore').css('display', 'block');

                                $('span', $this.n('showmore')).off();
                                $('span', $this.n('showmore')).on('click', function () {
                                    let source = $this.o.trigger.click, url;

                                    if (source == 'results_page') {
                                        url = '?s=' + helpers.nicePhrase($this.n('text').val());
                                    } else if (source == 'woo_results_page') {
                                        url = '?post_type=product&s=' + helpers.nicePhrase($this.n('text').val());
                                    } else {
                                        url = $this.o.trigger.redirect_url.replace('{phrase}', helpers.nicePhrase($this.n('text').val()));
                                    }

                                    if ($this.o.overridewpdefault) {
                                        if ($this.o.override_method == "post") {
                                            helpers.submitToUrl($this.o.homeurl + url, 'post', {
                                                asl_active: 1,
                                                p_asl_data: $('form', $this.n('searchsettings')).serialize()
                                            });
                                        } else {
                                            location.href = $this.o.homeurl + url + "&asl_active=1&p_asid=" + $this.o.id + "&p_asl_data=1&" + $('form', $this.n('searchsettings')).serialize()
                                        }
                                    } else {
                                        helpers.submitToUrl($this.o.homeurl + url, 'post', {
                                            np_asl_data: $('form', $this.n('searchsettings')).serialize()
                                        });
                                    }
                                });
                            }
                        }
                    },
                    'fail': function (jqXHR) {
                        if (jqXHR.aborted)
                            return;
                        $this.n('resdrg').html("");
                        $this.n('resdrg').html('<div class="asl_nores">The request failed. Please check your connection! Status: ' + jqXHR.status + '</div>');
                        $this.nodes.items = $('.item', $this.n('resultsDiv'));
                        $this.hideLoader();
                        $this.showResults();
                        $this.scrollToResults();
                    }
                });
            }
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        searchFor: function( phrase ) {
            if ( typeof phrase != 'undefined' ) {
                this.n('text').val(phrase);
            }
            this.n('textAutocomplete').val('');
            this.search(false, false, false, true);
        },

        toggleSettings: function( state ) {
            // state explicitly given, force behavior
            if (typeof state != 'undefined') {
                if ( state == "show") {
                    this.showSettings();
                } else {
                    this.hideSettings();
                }
            } else {
                if ( this.n('prosettings').data('opened') == 1 ) {
                    this.hideSettings();
                } else {
                    this.showSettings();
                }
            }
        },

        closeResults: function( clear ) {
            if (typeof(clear) != 'undefined' && clear) {
                this.n('text').val("");
                this.n('textAutocomplete').val("");
            }
            this.hideResults();
            this.n('proloading').css('display', 'none');
            this.hideLoader();
            this.searchAbort();
        },

        getStateURL: function() {
            let url = location.href,
                sep;
            url = url.split('p_asid');
            url = url[0];
            url = url.replace('&asl_active=1', '');
            url = url.replace('?asl_active=1', '');
            url = url.slice(-1) == '?' ? url.slice(0, -1) : url;
            url = url.slice(-1) == '&' ? url.slice(0, -1) : url;
            sep = url.indexOf('?') > 1 ? '&' :'?';
            return url + sep + "p_asid=" + this.o.id + "&p_asl_data=1&" + $('form', this.n('searchsettings')).serialize();
        },

        resetSearch: function() {
            this.resetSearchFilters();
        },

        filtersInitial: function() {
            return this.n('searchsettings').find('input[name=filters_initial]').val() == 1;
        },

        filtersChanged: function() {
            return this.n('searchsettings').find('input[name=filters_changed]').val() == 1;
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        Hooks: window.WPD.Hooks,

        deviceType: function () {
            let w = window.innerWidth;
            if ( w <= 640 ) {
                return 'phone';
            } else if ( w <= 1024 ) {
                return 'tablet';
            } else {
                return 'desktop';
            }
        },
        detectIOS: function() {
            if (
                typeof window.navigator != "undefined" &&
                typeof window.navigator.userAgent != "undefined"
            )
                return window.navigator.userAgent.match(/(iPod|iPhone|iPad)/) != null;
            return false;
        },
        /**
         * IE <11 detection, excludes EDGE
         * @returns {boolean}
         */
        detectIE: function() {
            let ua = window.navigator.userAgent,
                msie = ua.indexOf('MSIE '),         // <10
                trident = ua.indexOf('Trident/');   // 11

            if ( msie > 0 || trident > 0 )
                return true;

            // other browser
            return false;
        },
        isMobile: function() {
            try {
                document.createEvent("TouchEvent");
                return true;
            } catch(e){
                return false;
            }
        },
        isTouchDevice: function() {
            return "ontouchstart" in window;
        },

        isSafari: function() {
            return (/^((?!chrome|android).)*safari/i).test(navigator.userAgent);
        },

        /**
         * Gets the jQuery object, if "plugin" defined, then also checks if the plugin exists
         * @param plugin
         * @returns {boolean|function}
         */
        whichjQuery: function( plugin ) {
            let jq = false;

            if ( typeof window.$ != "undefined" ) {
                if ( typeof plugin === "undefined" ) {
                    jq = window.$;
                } else {
                    if ( typeof window.$.fn[plugin] != "undefined" ) {
                        jq = window.$;
                    }
                }
            }
            if ( jq === false && typeof window.jQuery != "undefined" ) {
                jq = window.jQuery;
                if ( typeof plugin === "undefined" ) {
                    jq = window.jQuery;
                } else {
                    if ( typeof window.jQuery.fn[plugin] != "undefined" ) {
                        jq = window.jQuery;
                    }
                }
            }

            return jq;
        },
        formData: function(form, data) {
            let $this = this,
                els = form.find('input,textarea,select,button').get();
            if ( arguments.length === 1 ) {
                // return all data
                data = {};

                els.forEach(function(el) {
                    if (el.name && !el.disabled && (el.checked
                        || /select|textarea/i.test(el.nodeName)
                        || /text/i.test(el.type)
                        || $(el).hasClass('hasDatepicker')
                        || $(el).hasClass('asl_slider_hidden'))
                    ) {
                        if(data[el.name] == undefined){
                            data[el.name] = [];
                        }
                        if ( $(el).hasClass('hasDatepicker') ) {
                            data[el.name].push($(el).parent().find('.asl_datepicker_hidden').val());
                        } else {
                            data[el.name].push($(el).val());
                        }
                    }
                });
                return JSON.stringify(data);
            } else {
                if ( typeof data != "object" ) {
                    data = JSON.parse(data);
                }
                els.forEach(function(el) {
                    if (el.name) {
                        if (data[el.name]) {
                            let names = data[el.name],
                                _this = $(el);
                            if(Object.prototype.toString.call(names) !== '[object Array]'){
                                names = [names]; //backwards compat to old version of this code
                            }
                            if(el.type == 'checkbox' || el.type == 'radio') {
                                let val = _this.val(),
                                    found = false;
                                for(let i = 0; i < names.length; i++){
                                    if(names[i] == val){
                                        found = true;
                                        break;
                                    }
                                }
                                _this.prop("checked", found);
                            } else {
                                _this.val(names[0]);

                                if ( $(el).hasClass('asl_gochosen') || $(el).hasClass('asl_goselect2') ) {
                                    WPD.intervalUntilExecute(function(_$){
                                        _$(el).trigger("change.asl_select2");
                                    }, function(){
                                        return $this.whichjQuery('asl_select2');
                                    }, 50, 3);
                                }

                                if ( $(el).hasClass('hasDatepicker') ) {
                                    WPD.intervalUntilExecute(function(_$){
                                        let value = names[0],
                                            format = _$(_this.get(0)).datepicker("option", 'dateFormat' );
                                        _$(_this.get(0)).datepicker("option", 'dateFormat', 'yy-mm-dd');
                                        _$(_this.get(0)).datepicker("setDate", value );
                                        _$(_this.get(0)).datepicker("option", 'dateFormat', format);
                                        _$(_this.get(0)).trigger('selectnochange');
                                    }, function(){
                                        return $this.whichjQuery('datepicker');
                                    }, 50, 3);
                                }
                            }
                        } else {
                            if(el.type == 'checkbox' || el.type == 'radio') {
                                $(el).prop("checked", false);
                            }
                        }
                    }
                });
                return form;
            }
        },
        submitToUrl: function(action, method, input, target) {
            let form;
            form = $('<form style="display: none;" />');
            form.attr('action', action);
            form.attr('method', method);
            $('body').append(form);
            if (typeof input !== 'undefined' && input !== null) {
                Object.keys(input).forEach(function (name) {
                    let value = input[name];
                    let $input = $('<input type="hidden" />');
                    $input.attr('name', name);
                    $input.attr('value', value);
                    form.append($input);
                });
            }
            if ( typeof (target) != 'undefined' && target == 'new') {
                form.attr('target', '_blank');
            }
            form.get(0).submit();
        },
        openInNewTab: function(url) {
            Object.assign(document.createElement('a'), { target: '_blank', href: url}).click();
        },
        isScrolledToBottom: function(el, tolerance) {
            return el.scrollHeight - el.scrollTop - $(el).outerHeight() < tolerance;
        },
        getWidthFromCSSValue: function(width, containerWidth) {
            let min = 100,
                ret;

            width = width + '';
            // Pixel value
            if ( width.indexOf('px') > -1 ) {
                ret = parseInt(width, 10);
            } else if ( width.indexOf('%') > -1 ) {
                // % value, calculate against the container
                if ( typeof containerWidth != 'undefined' && containerWidth != null ) {
                    ret = Math.floor(parseInt(width, 10) / 100 * containerWidth);
                } else {
                    ret = parseInt(width, 10);
                }
            } else {
                ret = parseInt(width, 10);
            }

            return ret < 100 ? min : ret;
        },

        nicePhrase: function(s) {
            // noinspection RegExpRedundantEscape
            return encodeURIComponent(s).replace(/\%20/g, '+');
        },

        unqoutePhrase: function(s) {
            return s.replace(/["']/g, '');
        },

        decodeHTMLEntities: function(str) {
            let element = document.createElement('div');
            if(str && typeof str === 'string') {
                // strip script/html tags
                str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
                str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
                element.innerHTML = str;
                str = element.textContent;
                element.textContent = '';
            }
            return str;
        },

        isScrolledToRight: function(el) {
            return el.scrollWidth - $(el).outerWidth() === el.scrollLeft;
        },

        isScrolledToLeft: function(el) {
            return el.scrollLeft === 0;
        },

        /**
         * @deprecated 2022 Q1
         * @returns {any|boolean}
         */
        wp_hooks_apply_filters: function() {
            if ( typeof wp != 'undefined' && typeof wp.hooks != 'undefined' && typeof wp.hooks.applyFilters != 'undefined' ) {
                return wp.hooks.applyFilters.apply(null, arguments);
            } else {
                return typeof arguments[1] != 'undefined' ? arguments[1] : false;
            }
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.helpers, functions);
})(WPD.dom);// noinspection JSUnresolvedVariable

(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        detectAndFixFixedPositioning: function() {
            let $this = this,
                fixedp = false,
                n = $this.n('search').get(0);

            while (n) {
                n = n.parentElement;
                if ( n != null && window.getComputedStyle(n).position == 'fixed' ) {
                    fixedp = true;
                    break;
                }
            }

            if ( fixedp || $this.n('search').css('position') == 'fixed' ) {
                if ( $this.n('resultsDiv').css('position') == 'absolute' ) {
                    $this.n('resultsDiv').css({
                        'position':'fixed',
                        'z-index': 2147483647
                    });
                }
                if ( !$this.o.blocking ) {
                    $this.n('searchsettings').css({
                        'position':'fixed',
                        'z-index': 2147483647
                    });
                }
            } else {
                if ( $this.n('resultsDiv').css('position') == 'fixed' )
                    $this.n('resultsDiv').css('position', 'absolute');
                if ( !$this.o.blocking )
                    $this.n('searchsettings').css('position', 'absolute');
            }
        },

        fixResultsPosition: function(ignoreVisibility) {
            ignoreVisibility = typeof ignoreVisibility == 'undefined' ? false : ignoreVisibility;
            let $this = this,
                $body = $('body'),
                bodyTop = 0,
                rpos = $this.n('resultsDiv').css('position');

            if ( $._fn.bodyTransformY() != 0 || $body.css("position") != "static" ) {
                bodyTop = $body.offset().top;
            }

            /**
             * When CSS transform is present, then Fixed element are no longer fixed
             * even if the CSS declaration says. It is better to change them to absolute then.
             */
            if ( $._fn.bodyTransformY() != 0 && rpos == 'fixed' ) {
                rpos = 'absolute';
                $this.n('resultsDiv').css('position', 'absolute');
            }

            // If still fixed, no need to remove the body position
            if ( rpos == 'fixed' ) {
                bodyTop = 0;
            }

            if ( rpos != 'fixed' && rpos != 'absolute' ) {
                return;
            }

            if (ignoreVisibility == true || $this.n('resultsDiv').css('visibility') == 'visible') {
                let _rposition = $this.n('search').offset(),
                    bodyLeft = 0;

                if ( $._fn.bodyTransformX() != 0 || $body.css("position") != "static" ) {
                    bodyLeft = $body.offset().left;
                }

                if ( typeof _rposition != 'undefined' ) {
                    let vwidth, adjust = 0;
                    if ( helpers.deviceType() == 'phone' ) {
                        vwidth = $this.o.results.width_phone;
                    } else if ( helpers.deviceType() == 'tablet' ) {
                        vwidth = $this.o.results.width_tablet;
                    } else {
                        vwidth = $this.o.results.width;
                    }
                    if ( vwidth == 'auto') {
                        vwidth = $this.n('search').outerWidth() < 240 ? 240 : $this.n('search').outerWidth();
                    }
                    $this.n('resultsDiv').css('width', !isNaN(vwidth) ? vwidth + 'px' : vwidth);
                    if ( $this.o.resultsSnapTo == 'right' ) {
                        adjust = $this.n('resultsDiv').outerWidth() - $this.n('search').outerWidth();
                    } else if (( $this.o.resultsSnapTo == 'center' )) {
                        adjust = Math.floor( ($this.n('resultsDiv').outerWidth() - parseInt($this.n('search').outerWidth())) / 2 );
                    }

                    $this.n('resultsDiv').css({
                        top: (_rposition.top + $this.n('search').outerHeight(true) - bodyTop) + 'px',
                        left: (_rposition.left - adjust - bodyLeft) + 'px'
                    });
                }
            }
        },

        fixSettingsPosition: function(ignoreVisibility) {
            ignoreVisibility = typeof ignoreVisibility == 'undefined' ? false : ignoreVisibility;
            let $this = this,
                $body = $('body'),
                bodyTop = 0,
                settPos = $this.n('searchsettings').css('position');

            if ( $._fn.bodyTransformY() != 0 || $body.css("position") != "static" ) {
                bodyTop = $body.offset().top;
            }

            /**
             * When CSS transform is present, then Fixed element are no longer fixed
             * even if the CSS declaration says. It is better to change them to absolute then.
             */
            if ( $._fn.bodyTransformY() != 0 && settPos == 'fixed' ) {
                settPos = 'absolute';
                $this.n('searchsettings').css('position', 'absolute');
            }

            // If still fixed, no need to remove the body position
            if ( settPos == 'fixed' ) {
                bodyTop = 0;
            }

            if ( ignoreVisibility == true || $this.n('prosettings').data('opened') != 0 ) {
                let $n, sPosition, top, left,
                    bodyLeft = 0;

                if ( $._fn.bodyTransformX() != 0 || $body.css("position") != "static" ) {
                    bodyLeft = $body.offset().left;
                }
                $this.fixSettingsWidth();

                if ( $this.n('prosettings').css('display') != 'none' ) {
                    $n = $this.n('prosettings');
                } else {
                    $n = $this.n('promagnifier');
                }

                sPosition = $n.offset();

                top = (sPosition.top + $n.height() - 2 - bodyTop) + 'px';
                left = ($this.o.settingsimagepos == 'left' ?
                    sPosition.left : (sPosition.left + $n.width() - $this.n('searchsettings').width()) );
                left = left - bodyLeft + 'px';

                $this.n('searchsettings').css({
                    display: "block",
                    top: top,
                    left: left
                });
            }
        },

        fixSettingsWidth: function () {
            // There is always only 1 column in lite version
        },

        hideOnInvisibleBox: function() {
            let $this = this;
            if (
                $this.o.detectVisibility == 1 &&
                !$this.n('search').hasClass('hiddend') &&
                ($this.n('search').is(':hidden') || !$this.n('search').is(':visible'))
            ) {
                $this.hideSettings?.();
                $this.hideResults();
            }
        },
    }

    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        initMagnifierEvents: function() {
            let $this = this, t;
            $this.n('promagnifier').on('click', function (e) {
                $this.keycode = e.keyCode || e.which;
                $this.ktype = e.type;

                $this.gaEvent?.('magnifier');

                // If redirection is set to the results page, or custom URL
                // noinspection JSUnresolvedVariable
                if (
                    $this.n('text').val().length >= $this.o.charcount &&
                    $this.o.redirectOnClick == 1 &&
                    $this.o.trigger.click != 'first_result'
                ) {
                    $this.doRedirectToResults('click');
                    clearTimeout(t);
                    return false;
                }

                if ( !( $this.o.trigger.click == 'ajax_search' || $this.o.trigger.click == 'first_result' ) ) {
                    return false;
                }

                $this.searchAbort();
                clearTimeout($this.timeouts.search);
                $this.n('proloading').css('display', 'none');

                $this.timeouts.search = setTimeout(function () {
                    // If the user types and deletes, while the last results are open
                    if (
                        ($('form', $this.n('searchsettings')).serialize() + $this.n('text').val().trim()) != $this.lastSuccesfulSearch ||
                        (!$this.resultsOpened && !$this.usingLiveLoader)
                    ) {
                        $this.search();
                    } else {
                        if ( $this.isRedirectToFirstResult() )
                            $this.doRedirectToFirstResult();
                        else
                            $this.n('proclose').css('display', 'block');
                    }
                }, $this.o.trigger.delay);
            });
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        initInputEvents: function() {
            let $this = this, initialized = false;
            let initTriggers = function() {
                $this.n('text').off('mousedown touchstart keydown', initTriggers);
                if ( !initialized ) {
                    $this._initFocusInput();
                    if ( $this.o.trigger.type ) {
                        $this._initSearchInput();
                    }
                    $this._initEnterEvent();
                    $this._initFormEvent();
                    $this.initAutocompleteEvent?.();
                    initialized = true;
                }
            };
            $this.n('text').on('mousedown touchstart keydown', initTriggers, {passive: true});
        },

        _initFocusInput: function() {
            let $this = this;

            // Some kind of crazy rev-slider fix
            $this.n('text').on('click', function(e){
                /**
                 * In some menus the input is wrapped in an <a> tag, which has an event listener attached.
                 * When clicked, the input is blurred. This prevents that.
                 */
                e.stopPropagation();
                e.stopImmediatePropagation();

                $(this).trigger('focus');
                $this.gaEvent?.('focus');

                // Show the results if the query does not change
                if (
                    ($('form', $this.n('searchsettings')).serialize() + $this.n('text').val().trim()) == $this.lastSuccesfulSearch
                ) {
                    if ( !$this.resultsOpened && !$this.usingLiveLoader ) {
                        $this._no_animations = true;
                        $this.showResults();
                        $this._no_animations = false;
                    }
                    return false;
                }
            });
            $this.n('text').on('focus input', function(e){
                if ( $this.searching ) {
                    return;
                }
                if ( $(this).val() != '' ) {
                    $this.n('proclose').css('display', 'block');
                } else {
                    $this.n('proclose').css({
                        display: "none"
                    });
                }
            });
        },

        _initSearchInput: function() {
            let $this = this,
                previousInputValue = $this.n('text').val();

            $this.n('text').on('input', function(e){
                $this.keycode =  e.keyCode || e.which;
                $this.ktype = e.type;
                if ( helpers.detectIE() ) {
                    if ( previousInputValue == $this.n('text').val() ) {
                        return false;
                    } else {
                        previousInputValue = $this.n('text').val();
                    }
                }

                $this.updateHref();

                // Is the character count sufficient?
                // noinspection JSUnresolvedVariable
                if ( $this.n('text').val().length < $this.o.charcount ) {
                    $this.n('proloading').css('display', 'none');
                    if ($this.o.blocking == false) {
                        $this.hideSettings?.();
                    }
                    $this.hideResults(false);
                    $this.searchAbort();
                    clearTimeout($this.timeouts.search);
                    return false;
                }

                $this.searchAbort();
                clearTimeout($this.timeouts.search);
                $this.n('proloading').css('display', 'none');

                $this.timeouts.search = setTimeout(function () {
                    // If the user types and deletes, while the last results are open
                    if (
                        ($('form', $this.n('searchsettings')).serialize() + $this.n('text').val().trim()) != $this.lastSuccesfulSearch ||
                        (!$this.resultsOpened && !$this.usingLiveLoader)
                    ) {
                        $this.search();
                    } else {
                        if ( $this.isRedirectToFirstResult() )
                            $this.doRedirectToFirstResult();
                        else
                            $this.n('proclose').css('display', 'block');
                    }
                }, $this.o.trigger.delay);
            });
        },

        _initEnterEvent: function() {
            let $this = this,
                rt, enterRecentlyPressed = false;
            // The return event has to be dealt with on a keyup event, as it does not trigger the input event
            $this.n('text').on('keyup', function(e) {
                $this.keycode =  e.keyCode || e.which;
                $this.ktype = e.type;

                // Prevent rapid enter key pressing
                if ( $this.keycode == 13 ) {
                    clearTimeout(rt);
                    rt = setTimeout(function(){
                        enterRecentlyPressed = false;
                    }, 300);
                    if ( enterRecentlyPressed ) {
                        return false;
                    } else {
                        enterRecentlyPressed = true;
                    }
                }

                let isInput = $(this).hasClass("orig");
                // noinspection JSUnresolvedVariable
                if ( $this.n('text').val().length >= $this.o.charcount && isInput && $this.keycode == 13 ) {
                    $this.gaEvent?.('return');
                    if ( $this.o.redirectOnEnter == 1 ) {
                        if ($this.o.trigger.return != 'first_result') {
                            $this.doRedirectToResults($this.ktype);
                        } else {
                            $this.search();
                        }
                    } else if ( $this.o.trigger.return == 'ajax_search' ) {
                        if (
                            ($('form', $this.n('searchsettings')).serialize() + $this.n('text').val().trim()) != $this.lastSuccesfulSearch ||
                            (!$this.resultsOpened && !$this.usingLiveLoader)
                        ) {
                            $this.search();
                        }
                    }
                    clearTimeout($this.timeouts.search);
                }
            });
        },

        _initFormEvent: function(){
            let $this = this;
            // Handle the submit/mobile search button event
            $($this.n('text').closest('form').get(0)).on('submit', function (e, args) {
                e.preventDefault();
                // Mobile keyboard search icon and search button
                if ( helpers.isMobile() ) {
                    if ( $this.o.redirectOnEnter ) {
                        let event = new Event("keyup");
                        event.keyCode = event.which = 13;
                        this.n('text').get(0).dispatchEvent(event);
                    } else {
                        $this.search();
                        document.activeElement.blur();
                    }
                } else if (typeof(args) != 'undefined' && args == 'ajax') {
                    $this.search();
                }
            });
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        initNavigationEvents: function () {
            let $this = this;

            let handler = function (e) {
                let keycode =  e.keyCode || e.which;
                // noinspection JSUnresolvedVariable
                if (
                    $('.item', $this.n('resultsDiv')).length > 0 && $this.n('resultsDiv').css('display') != 'none' &&
                    $this.o.resultstype == "vertical"
                ) {
                    if ( keycode == 40 || keycode == 38 ) {
                        let $hovered = $this.n('resultsDiv').find('.item.hovered');
                        $this.n('text').trigger('blur');
                        if ( $hovered.length == 0 ) {
                            $this.n('resultsDiv').find('.item').first().addClass('hovered');
                        } else {
                            if (keycode == 40) {
                                if ( $hovered.next('.item').length == 0 ) {
                                    $this.n('resultsDiv').find('.item').removeClass('hovered').first().addClass('hovered');
                                } else {
                                    $hovered.removeClass('hovered').next('.item').addClass('hovered');
                                }
                            }
                            if (keycode == 38) {
                                if ( $hovered.prev('.item').length == 0 ) {
                                    $this.n('resultsDiv').find('.item').removeClass('hovered').last().addClass('hovered');
                                } else {
                                    $hovered.removeClass('hovered').prev('.item').addClass('hovered');
                                }
                            }
                        }
                        e.stopPropagation();
                        e.preventDefault();
                        if ( !$this.n('resultsDiv').find('.resdrg .item.hovered').inViewPort(50, $this.n('resultsDiv').get(0)) ) {
                            let n = $this.n('resultsDiv').find('.resdrg .item.hovered').get(0);
                            if ( n != null && typeof n.scrollIntoView != "undefined" ) {
                                n.scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
                            }
                        }
                    }

                    // Trigger click on return key
                    if ( keycode == 13 && $('.item.hovered', $this.n('resultsDiv')).length > 0 ) {
                        e.stopPropagation();
                        e.preventDefault();
                        $('.item.hovered a.asl_res_url', $this.n('resultsDiv')).get(0).click();
                    }

                }
            };
            $this.documentEventHandlers.push({
                'node': document,
                'event': 'keydown',
                'handler': handler
            });
            $(document).on('keydown', handler);
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let _static = window.WPD.ajaxsearchlite;
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        initOtherEvents: function() {
            let $this = this, handler, handler2;

            if ( helpers.isMobile() && helpers.detectIOS() ) {
                /**
                 * Memorize the scroll top when the input is focused on IOS
                 * as fixed elements scroll freely, resulting in incorrect scroll value
                 */
                $this.n('text').on('touchstart', function () {
                    $this.savedScrollTop = window.scrollY;
                    $this.savedContainerTop = $this.n('search').offset().top;
                });
            }

            $this.n('proclose').on($this.clickTouchend, function (e) {
                //if ($this.resultsOpened == false) return;
                e.preventDefault();
                e.stopImmediatePropagation();
                $this.n('text').val("");
                $this.n('textAutocomplete').val("");
                $this.hideResults();
                $this.n('text').trigger('focus');

                $this.n('proloading').css('display', 'none');
                $this.hideLoader();
                $this.searchAbort();

                if ( $('.asl_es_' + $this.o.id).length > 0 ) {
                    $this.showLoader();
                    $this.liveLoad('.asl_es_' + $this.o.id, $this.getCurrentLiveURL(), false);
                } else if ( $this.o.resPage.useAjax ) {
                    $this.showLoader();
                    $this.liveLoad($this.o.resPage.selector, $this.getRedirectURL());
                }

                $this.n('text').get(0).focus();
            });

            if ( helpers.isMobile() ) {
                handler = function () {
                    $this.orientationChange();
                    // Fire once more a bit delayed, some mobile browsers need to re-zoom etc..
                    setTimeout(function(){
                        $this.orientationChange();
                    }, 600);
                };
                $this.documentEventHandlers.push({
                    'node': window,
                    'event': 'orientationchange',
                    'handler': handler
                });
                $(window).on("orientationchange", handler);
            } else {
                handler = function () {
                    $this.resize();
                };
                $this.documentEventHandlers.push({
                    'node': window,
                    'event': 'resize',
                    'handler': handler
                });
                $(window).on("resize", handler, {passive: true});
            }

            handler2 = function () {
                $this.scrolling(false);
            };
            $this.documentEventHandlers.push({
                'node': window,
                'event': 'scroll',
                'handler': handler2
            });
            $(window).on('scroll', handler2, {passive: true});

            // Mobile navigation focus
            // noinspection JSUnresolvedVariable
            if ( helpers.isMobile() && $this.o.mobile.menu_selector != '' ) {
                // noinspection JSUnresolvedVariable
                $($this.o.mobile.menu_selector).on('touchend', function(){
                    let _this = this;
                    setTimeout(function () {
                        let $input = $(_this).find('input.orig');
                        $input = $input.length == 0 ? $(_this).next().find('input.orig') : $input;
                        $input = $input.length == 0 ? $(_this).parent().find('input.orig') : $input;
                        $input = $input.length == 0 ? $this.n('text') : $input;
                        if ( $this.n('search').inViewPort() ) {
                            $input.get(0).focus();
                        }
                    }, 300);
                });
            }

            // Prevent zoom on IOS
            if ( helpers.detectIOS() && helpers.isMobile() && helpers.isTouchDevice() ) {
                if ( parseInt($this.n('text').css('font-size')) < 16 ) {
                    $this.n('text').data('fontSize', $this.n('text').css('font-size')).css('font-size', '16px');
                    $this.n('textAutocomplete').css('font-size', '16px');
                    $('body').append('<style>#ajaxsearchlite'+$this.o.rid+' input.orig::-webkit-input-placeholder{font-size: 16px !important;}</style>');
                }
            }
        },

        orientationChange: function() {
            let $this = this;
            $this.detectAndFixFixedPositioning();
            $this.fixSettingsPosition();
            $this.fixResultsPosition();

            if ( $this.o.resultstype == "isotopic" && $this.n('resultsDiv').css('visibility') == 'visible' ) {
                $this.calculateIsotopeRows();
                $this.showPagination(true);
                $this.removeAnimation();
            }
        },

        resize: function () {
            let $this = this;
            $this.detectAndFixFixedPositioning();
            $this.fixSettingsPosition();
            $this.fixResultsPosition();

            if ( $this.o.resultstype == "isotopic" && $this.n('resultsDiv').css('visibility') == 'visible' ) {
                $this.calculateIsotopeRows();
                $this.showPagination(true);
                $this.removeAnimation();
            }
        },

        scrolling: function (ignoreVisibility) {
            let $this = this;
            $this.detectAndFixFixedPositioning();
            $this.hideOnInvisibleBox();
            $this.fixSettingsPosition(ignoreVisibility);
            $this.fixResultsPosition(ignoreVisibility);
        },

        initTryThisEvents: function() {
            let $this = this;
            // Try these search button events
            if ( $this.n('trythis').find('a').length > 0 ) {
                $this.n('trythis').find('a').on('click touchend', function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    document.activeElement.blur();
                    $this.n('textAutocomplete').val('');
                    $this.n('text').val($(this).html());
                    $this.gaEvent?.('try_this');
                    $this.searchWithCheck(80);
                });
                $this.n('trythis').css({
                    visibility: "visible"
                });
            }
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        initResultsEvents: function() {
            let $this = this;

            $this.n('resultsDiv').css({
                opacity: "0"
            });

            let handler = function (e) {
                let keycode =  e.keyCode || e.which,
                    ktype = e.type;

                if ( $(e.target).closest('.asl_w').length == 0 ) {
                    $this.hideOnInvisibleBox();

                    // If not right click
                    if( ktype != 'click' || ktype != 'touchend' || keycode != 3 ) {
                        // noinspection JSUnresolvedVariable
                        if ($this.resultsOpened == false || $this.o.closeOnDocClick != 1) return;

                        if ( !$this.dragging ) {
                            $this.hideLoader();
                            $this.searchAbort();
                            $this.hideResults();
                        }
                    }
                }
            };
            $this.documentEventHandlers.push({
                'node': document,
                'event': $this.clickTouchend,
                'handler': handler
            });
            $(document).on($this.clickTouchend, handler);

            // GTAG on results click
            $this.n('resultsDiv').on('click', '.results .item', function() {
                $this.gaEvent?.('result_click', {
                    'result_title': $(this).find('a.asl_res_url').text(),
                    'result_url': $(this).find('a.asl_res_url').attr('href')
                });

                // Results highlight on results page
                // noinspection JSUnresolvedVariable
                if ( $this.o.singleHighlight == 1 ) {
                    localStorage.removeItem('asl_phrase_highlight');
                    if (  $this.n('text').val().replace(/["']/g, '')  != '' ) {
                        localStorage.setItem('asl_phrase_highlight', JSON.stringify({
                            'phrase': $this.n('text').val().replace(/["']/g, '')
                        }));
                    }
                }
            });
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        monitorTouchMove: function() {
            let $this = this;
            $this.dragging = false;
            $("body").on("touchmove", function(){
                $this.dragging = true;
            }).on("touchstart", function(){
                $this.dragging = false;
            });
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let functions = {
        initAutop: function () {
            let $this = this;

            if ( $this.o.autop.state == "disabled" ) return false;

            let location = window.location.href;
            // Correct previous query arguments (in case of paginated results)
            let stop = location.indexOf('asl_ls=') > -1 || location.indexOf('asl_ls&') > -1;

            if ( stop ) {
                return false;
            }
            // noinspection JSUnresolvedVariable
            let count = $this.o.autop.count;
            window.WPD.intervalUntilExecute(function(){
                    $this.isAutoP = true;
                    if ($this.o.autop.state == "phrase") {
                        if ( !$this.o.is_results_page ) {
                            $this.n('text').val($this.o.autop.phrase);
                        }
                        $this.search(count);
                    } else if ($this.o.autop.state == "latest") {
                        $this.search(count, 1);
                    } else {
                        $this.search(count, 2);
                    }
                },
                function() { return (!window.ASL.css_async || typeof window.ASL.css_loaded != 'undefined') }
            );
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        initEtc: function() {
            helpers.Hooks.addFilter('asl/init/etc', this);
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);// noinspection JSUnresolvedVariable

(function($){
    "use strict";
    let _static = window.WPD.ajaxsearchlite;
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        init: function (options, elem) {
            let $this = this;

            $this.searching = false;
            $this.triggerPrevState = false;

            $this.isAutoP = false;
            $this.autopStartedTheSearch = false;
            $this.autopData = {};

            $this.settingsInitialized = false;
            $this.resultsInitialized = false;
            $this.settingsChanged = false;
            $this.resultsOpened = false;
            $this.post = null;
            $this.postAuto = null;
            $this.scroll = {};
            $this.savedScrollTop = 0;   // Save the window scroll on IOS devices
            $this.savedContainerTop = 0;
            $this.disableMobileScroll = false;
            /**
             * on IOS touch (iPhone, iPad etc..) the 'click' event does not fire, when not bound to a clickable element
             * like a link, so instead, use touchend
             * Stupid solution, but it works..
             */
            $this.clickTouchend = 'click touchend';
            $this.mouseupTouchend = 'mouseup touchend';
            // NoUiSliders storage
            $this.noUiSliders = [];

            // An object to store various timeout events across methods
            $this.timeouts = {
                "compactBeforeOpen": null,
                "compactAfterOpen": null,
                "search": null,
                "searchWithCheck": null
            };

            $this.eh = {}; // this.EventHandlers -> storage for event handler references
            // Document and Window event handlers. Used to detach them in the destroy() method
            $this.documentEventHandlers = [
                /**
                 * {"node": document|window, "event": event_name, "handler": function()..}
                 */
            ];

            $this.settScroll = null;
            $this.currentPage = 1;
            $this.isotopic = null;
            $this.sIsotope = null;
            $this.lastSuccesfulSearch = ''; // Holding the last phrase that returned results
            $this.lastSearchData = {};      // Store the last search information
            $this._no_animations = false; // Force override option to show animations
            // Repetitive call related
            $this.call_num = 0;
            $this.results_num = 0;

            // this.n and this.o available afterwards
            // also, it corrects the clones and fixes the node varialbes
            $this.o = $.fn.extend({}, options);
            $this.nodes = {};
            $this.nodes.search = $(elem);

            // Make parsing the animation settings easier
            if ( helpers.isMobile() ) {
                $this.animOptions = $this.o.animations.mob;
            } else {
                $this.animOptions = $this.o.animations.pc;
            }

            // Fill up the this.n and correct the cloned notes as well
            $this.initNodeVariables();

            /**
             * Default animation opacity. 0 for IN types, 1 for all the other ones. This ensures the fluid
             * animation. Wrong opacity causes flashes.
             */
            $this.animationOpacity = $this.animOptions.items.indexOf("In") < 0 ? "opacityOne" : "opacityZero";

            $this.o.redirectOnClick = $this.o.trigger.click != 'ajax_search' && $this.o.trigger.click != 'nothing';
            $this.o.redirectOnEnter = $this.o.trigger.return != 'ajax_search' && $this.o.trigger.return != 'nothing';
            $this.usingLiveLoader = ($this.o.resPage.useAjax && $($this.o.resPage.selector).length > 0) || $('.asl_es_' + $this.o.id).length > 0;
            if ($this.usingLiveLoader) {
                $this.o.trigger.type = $this.o.resPage.trigger_type;
                $this.o.trigger.facet = $this.o.resPage.trigger_facet;
                if ($this.o.resPage.trigger_magnifier) {
                    $this.o.redirectOnClick = 0;
                    $this.o.trigger.click = 'ajax_search';
                }

                if ($this.o.resPage.trigger_return) {
                    $this.o.redirectOnEnter = 0;
                    $this.o.trigger.return = 'ajax_search';
                }
            }

            // Sets $this.dragging to true if the user is dragging on a touch device
            $this.monitorTouchMove();

            // Rest of the events
            $this.initEvents();

            // Auto populate
            $this.initAutop();

            // Etc stuff..
            $this.initEtc();

            // After the first execution, this stays false
            _static.firstIteration = false;

            // Init complete event trigger
            $this.n('s').trigger("asl_init_search_bar", [$this.o.id, $this.o.iid], true, true);

            return this;
        },

        n: function(k){
            if ( typeof this.nodes[k] !== 'undefined' ) {
                return this.nodes[k];
            } else {
                switch( k ) {
                    case 's':
                        this.nodes[k] = this.nodes.search;
                        break;
                    case 'container':
                        this.nodes[k] = this.nodes.search.closest('.asl_w_container');
                        break;
                    case 'searchsettings':
                        this.nodes[k] = $('.asl_s', this.n('container'));
                        break;
                    case 'resultsDiv':
                        this.nodes[k] = $('.asl_r', this.n('container'));
                        break;
                    case 'probox':
                        this.nodes[k] = $('.probox', this.nodes.search);
                        break;
                    case 'proinput':
                        this.nodes[k] = $('.proinput', this.nodes.search);
                        break;
                    case 'text':
                        this.nodes[k] = $('.proinput input.orig', this.nodes.search);
                        break;
                    case 'textAutocomplete':
                        this.nodes[k] = $('.proinput input.autocomplete', this.nodes.search);
                        break;
                    case 'proloading':
                        this.nodes[k] = $('.proloading', this.nodes.search);
                        break;
                    case 'proclose':
                        this.nodes[k] = $('.proclose', this.nodes.search);
                        break;
                    case 'promagnifier':
                        this.nodes[k] = $('.promagnifier', this.nodes.search);
                        break;
                    case 'prosettings':
                        this.nodes[k] = $('.prosettings', this.nodes.search);
                        break;
                    case 'settingsAppend':
                        this.nodes[k] = $('#wpdreams_asl_settings_' + this.o.id);
                        break;
                    case 'resultsAppend':
                        this.nodes[k] = $('#wpdreams_asl_results_' + this.o.id);
                        break;
                    case 'trythis':
                        this.nodes[k] = $("#asp-try-" + this.o.rid);
                        break;
                    case 'hiddenContainer':
                        this.nodes[k] = $('.asl_hidden_data', this.n('container'));
                        break;
                    case 'aspItemOverlay':
                        this.nodes[k] = $('.asl_item_overlay', this.n('hiddenContainer'));
                        break;
                    case 'showmore':
                        this.nodes[k] = $('.showmore', this.n('resultsDiv'));
                        break;
                    case 'items':
                        this.nodes[k] = $('.item', this.n('resultsDiv')).length > 0 ? $('.item', this.n('resultsDiv')) : $('.photostack-flip', this.n('resultsDiv'));
                        break;
                    case 'results':
                        this.nodes[k] = $('.results', this.n('resultsDiv'));
                        break;
                    case 'resdrg':
                        this.nodes[k] = $('.resdrg', this.n('resultsDiv'));
                        break;
                }
                return this.nodes[k];
            }
        },

        initNodeVariables: function(){
            let $this = this;

            $this.o.id = $this.nodes.search.data('id');
            $this.o.iid = $this.nodes.search.data('instance');
            $this.o.rid = $this.o.id + "_" + $this.o.iid;
            // Fix any potential clones and adjust the variables
            $this.fixClonedSelf();
        },


        initEvents: function () {
            this.initSettingsSwitchEvents?.();
            this.initOtherEvents();
            //this.initTryThisEvents();
            this.initMagnifierEvents();
            this.initInputEvents();
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        /**
         * This function should be called on-demand to init the results events and all. Do not call on init, only when needed.
         */
        initResults: function() {
            if ( !this.resultsInitialized ) {
                this.initResultsBox();
                this.initResultsEvents();
                this.initNavigationEvents?.();
            }
        },
        initResultsBox: function() {
            let $this = this;

            // Calculates the results animation attributes
            $this.initResultsAnimations();

            if ( helpers.isMobile() && $this.o.mobile.force_res_hover == 1) {
                $this.o.resultsposition = 'hover';
                //$('body').append($thisn('resultsDiv').detach());
                $this.nodes.resultsDiv = $this.n('resultsDiv').clone();
                $('body').append($this.nodes.resultsDiv);
                $this.nodes.resultsDiv.css({
                    'position': 'absolute'
                });
                $this.detectAndFixFixedPositioning();
            } else {
                // Move the results div to the correct position
                if ($this.o.resultsposition == 'hover' && $this.n('resultsAppend').length <= 0) {
                    $this.nodes.resultsDiv = $this.n('resultsDiv').clone();
                    $('body').append($this.n('resultsDiv'));
                } else  {
                    $this.o.resultsposition = 'block';
                    $this.n('resultsDiv').css({
                        'position': 'static'
                    });
                    if ( $this.n('resultsAppend').length > 0  ) {
                        if ( $this.n('resultsAppend').find('.asl_w').length > 0 ) {
                            $this.nodes.resultsDiv = $this.n('resultsAppend').find('.asl_w');
                        } else {
                            $this.nodes.resultsDiv = $this.n('resultsDiv').clone();
                            $this.nodes.resultsAppend.append($this.n('resultsDiv'));
                        }
                    }
                }
            }

            $this.nodes.showmore = $('.showmore', $this.n('resultsDiv'));
            $this.nodes.items = $('.item', $this.n('resultsDiv')).length > 0 ? $('.item', $this.n('resultsDiv')) : $('.photostack-flip', $this.n('resultsDiv'));
            $this.nodes.results = $('.results', $this.n('resultsDiv'));
            $this.nodes.resdrg = $('.resdrg', $this.n('resultsDiv'));

            $this.n('resultsDiv').get(0).id = $this.n('resultsDiv').get(0).id.replace('__original__', '');
            $this.detectAndFixFixedPositioning();

            $this.resultsInitialized = true;
        },

        initResultsAnimations: function() {
            let $this = this,
                animDur = 300;

            $this.resAnim = {
                "showClass": "asl_an_fadeInDrop",
                "showCSS": {
                    "visibility": "visible",
                    "display": "block",
                    "opacity": 1,
                    "animation-duration": animDur  + 'ms'
                },
                "hideClass": "asl_an_fadeOutDrop",
                "hideCSS": {
                    "visibility": "hidden",
                    "opacity": 0,
                    "display": "none"
                },
                "duration": animDur
            };

            $this.n('resultsDiv').css({
                "-webkit-animation-duration": animDur + "ms",
                "animation-duration": animDur + "ms"
            });
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);window.ASL = typeof window.ASL !== 'undefined' ? window.ASL : {};
window.ASL.api = (function() {
    "use strict";
    let a4 = function(id, instance, func, args) {
        let s = ASL.instances.get(id, instance);
        return s !== false && s[func].apply(s, [args]);
    },
    a3 = function(id, func, args) {
        let s;
        if ( !isNaN(parseFloat(func)) && isFinite(func) ) {
            s = ASL.instances.get(id, func);
            return s !== false && s[args].apply(s);
        } else {
            s = ASL.instances.get(id);
            return s !== false && s.forEach(function(i){
                i[func].apply(i, [args]);
            });
        }
    },
    a2 = function(id, func) {
        let s;
        if ( func == 'exists' ) {
            return ASL.instances.exist(id);
        }
        s = ASL.instances.get(id);
        return s !== false && s.forEach(function(i){
            i[func].apply(i);
        });
    };
    if ( arguments.length == 4 ){
        return(
            a4.apply( this, arguments )
        );
    } else if ( arguments.length == 3 ) {
        return(
            a3.apply( this, arguments )
        );
    } else if ( arguments.length == 2 ) {
        return(
            a2.apply( this, arguments )
        );
    } else if ( arguments.length == 0 ) {
        console.log("Usage: ASL.api(id, [optional]instance, function, [optional]args);");
        console.log("For more info: https://knowledgebase.ajaxsearchlite.com/other/javascript-api");
    }
});