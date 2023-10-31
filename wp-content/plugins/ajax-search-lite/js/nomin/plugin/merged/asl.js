(function(){
    "use strict";

    const version = 1;

    window.WPD = typeof window.WPD !== 'undefined' ? window.WPD : {};

    if ( typeof WPD.dom != "undefined" ) {
        return false;	// Terminate
    }

    WPD.dom = function() {
        if ( typeof WPD.dom.fn == "undefined" || typeof WPD.dom.fn.a == "undefined") {
            WPD.dom.fn = {
                a: [],
                is_wpd_dom: true,
                length: 0,
                get: function (n) {
                    return typeof n == "undefined" ? this.a.slice() : (typeof this.a[n] != 'undefined' ? this.a[n] : null);
                },
                _: function (s) {
                    if ( s.charAt(0) === '<' ) {
                        return WPD.dom._fn.createElementsFromHTML(s);
                    }
                    return Array.prototype.slice.call(document.querySelectorAll(s));
                },
                $: function (s, $node) {
                    let _this = this.copy(this, true);
                    if ( typeof $node != "undefined" ) {
                        _this.a = $node !== null ? $node.find(s).get() : [];
                    } else {
                        if (typeof s == "string") {
                            _this.a = _this._(s);
                        } else {
                            _this.a = s!== null ? [s] : [];
                        }
                    }
                    _this.length = _this.a.length;
                    return _this;
                },
                extend: function () {
                    for (let i = 1; i < arguments.length; i++)
                        for (let key in arguments[i])
                            if (arguments[i].hasOwnProperty(key))
                                arguments[0][key] = arguments[i][key];
                    return arguments[0];
                },
                copy: function(source, deep) {
                    let o, prop, type;
                    if (typeof source != 'object' || source === null) {
                        // What do to with functions, throw an error?
                        o = source;
                        return o;
                    }
                    o = new source.constructor();
                    for (prop in source) {
                        if (source.hasOwnProperty(prop)) {
                            type = typeof source[prop];
                            if (deep && type === 'object' && source[prop] !== null) {
                                o[prop] = this.copy(source[prop]);
                            } else {
                                o[prop] = source[prop];
                            }
                        }
                    }
                    return o;
                },
                parent: function (s) {
                    let el = this.get(0);
                    let _this = this.copy(this, true);
                    _this.a = [];
                    if (el != null) {
                        el = el.parentElement;
                        if (typeof s != 'undefined') {
                            if (el.matches(s)) {
                                _this.a = [el];
                            }
                        } else {
                            _this.a = el == null ? [] : [el];
                        }
                        return _this;
                    }
                    return _this;
                },
                first: function () {
                    let _this = this.copy(this, true);
                    _this.a = typeof _this.a[0] != 'undefined' ? [_this.a[0]] : [];
                    _this.length = _this.a.length;
                    return _this;
                },
                last: function () {
                    let _this = this.copy(this, true);
                    _this.a = _this.a.length > 0 ? [_this.a[_this.a.length - 1]] : [];
                    _this.length = _this.a.length;
                    return _this;
                },
                prev: function (s) {
                    let _this = this.copy(this, true);
                    if ( typeof s == "undefined" ) {
                        _this.a = typeof _this.a[0] != 'undefined' && _this.a[0].previousElementSibling != null ?
                            [_this.a[0].previousElementSibling] : [];
                    } else {
                        if ( typeof _this.a[0] != 'undefined' ) {
                            let n = _this.a[0].previousElementSibling;
                            _this.a = [];
                            while ( n != null ) {
                                if ( n.matches(s) ) {
                                    _this.a = [n];
                                    break;
                                }
                                n = n.previousElementSibling;
                            }
                        }
                    }
                    _this.length = _this.a.length;
                    return _this;
                },
                next: function (s) {
                    let _this = this.copy(this, true);
                    if ( typeof s == "undefined" ) {
                        _this.a = typeof _this.a[0] != 'undefined' && _this.a[0].nextElementSibling != null ?
                            [_this.a[0].nextElementSibling] : [];
                    } else {
                        if ( typeof _this.a[0] != 'undefined' ) {
                            let n = _this.a[0].nextElementSibling;
                            _this.a = [];
                            while ( n != null ) {
                                if ( n.matches(s) ) {
                                    _this.a = [n];
                                    break;
                                }
                                n = n.nextElementSibling;
                            }
                        }
                    }
                    _this.length = _this.a.length;
                    return _this;
                },
                closest: function (s) {
                    let el = this.get(0);
                    let _this = this.copy(this, true);
                    _this.a = [];
                    if ( typeof s === "string" ) {
                        if (el !== null && typeof el.matches != 'undefined' && s !== '') {
                            if (!el.matches(s)) {
                                // noinspection StatementWithEmptyBodyJS
                                while ((el = el.parentElement) && !el.matches(s)) ;
                            }
                            _this.a = el == null ? [] : [el];
                        }
                    } else {
                        if (el !== null && typeof el.matches != 'undefined' && typeof s.matches != 'undefined') {
                            if ( el !== s ) {
                                // noinspection StatementWithEmptyBodyJS
                                while ((el = el.parentElement) && el !== s) ;
                            }
                            _this.a = el == null ? [] : [el];
                        }
                    }
                    _this.length = _this.a.length;
                    return _this;
                },
                add: function( el ) {
                    if ( typeof el !== "undefined" ) {
                        if (typeof el.nodeType !== "undefined") {
                            if (this.a.indexOf(el) == -1) {
                                this.a.push(el);
                            }
                        } else if (typeof el.a !== "undefined") {
                            let _this = this;
                            el.a.forEach(function (el) {
                                if (_this.a.indexOf(el) == -1) {
                                    _this.a.push(el);
                                }
                            });
                        }
                    }
                    return this;
                },
                find: function (s) {
                    let _this = this.copy(this, true);
                    _this.a = [];
                    this.forEach(function(el){
                        if ( el !== null && typeof el.querySelectorAll != 'undefined') {
                            _this.a = _this.a.concat(Array.prototype.slice.call(el.querySelectorAll(s)));
                        }
                    });
                    _this.length = _this.a.length;
                    return _this;
                },
                forEach: function (callback) {
                    this.a.forEach(function (node, index, array) {
                        callback.apply(node, [node, index, array]);
                    });
                    return this;
                },
                each: function (c) {
                    return this.forEach(c);
                },
                hasClass: function (c) {
                    let el = this.get(0);
                    return el != null ? el.classList.contains(c) : false;
                },
                addClass: function (c) {
                    let args = c;
                    if (typeof c == 'string') {
                        args = c.split(' ');
                    }
                    args = args.filter(function (i) {
                        return i.trim() !== ''
                    });
                    if (args.length > 0) {
                        this.forEach(function (el) {
                            el.classList.add.apply(el.classList, args);
                        });
                    }
                    return this;
                },
                removeClass: function (c) {
                    if ( typeof c != 'undefined' ) {
                        let args = c;
                        if (typeof c == 'string') {
                            args = c.split(' ');
                        }
                        args = args.filter(function (i) {
                            return i.trim() !== ''
                        });
                        if (args.length > 0) {
                            this.forEach(function (el) {
                                el.classList.remove.apply(el.classList, args);
                            });
                        }
                    } else {
                        this.forEach(function (el) {
                            if ( el.classList.length > 0 ) {
                                el.classList.remove.apply(el.classList, el.classList);
                            }
                        });
                    }
                    return this;
                },
                is: function(s){
                    let el = this.get(0);
                    if ( el != null ) {
                        return el.matches(s);
                    }
                    return false;
                },
                val: function(v) {
                    let el = this.get(0);
                    if ( el != null ) {
                        if (arguments.length == 1) {
                            if ( el.type == 'select-multiple' ) {
                                v = typeof v === 'string' ? v.split(',') : v;
                                for ( let i = 0, l = el.options.length, o; i < l; i++ ) {
                                    o = el.options[i];
                                    o.selected = v.indexOf(o.value) != -1;
                                }
                            } else {
                                el.value = v;
                            }
                        } else {
                            if ( el.type == 'select-multiple' ) {
                                return Array.prototype.map.call(el.selectedOptions, function(x){ return x.value });
                            } else {
                                return el.value;
                            }
                        }
                    }
                    return this;
                },
                isVisible: function() {
                    let el = this.get(0), visible = true, style;
                    while (el !== null) {
                        style = window.getComputedStyle(el);
                        if (
                            style['display'] == 'none' ||
                            style['visibility'] == 'hidden' ||
                            style['opacity'] == 0
                        ) {
                            visible = false;
                            break;
                        }
                        el = el.parentElement;
                    }
                    return visible;
                },
                attr: function (a, v) {
                    let ret, args = arguments, _this = this;
                    this.forEach(function(el) {
                        if ( args.length == 2 ) {
                            el.setAttribute(a, v);
                            ret = _this;
                        } else {
                            if ( typeof a === 'object' ) {
                                Object.keys(a).forEach(function(k){
                                    el.setAttribute(k, a[k]);
                                });
                            } else {
                                ret = el.getAttribute(a);
                            }
                        }
                    });
                    return ret;
                },
                removeAttr: function(a) {
                    this.forEach(function(el) {
                        el.removeAttribute(a);
                    });
                    return this;
                },
                prop: function(a, v) {
                    let ret, args = arguments;
                    this.forEach(function(el) {
                        if ( args.length == 2 ) {
                            el[a] = v;
                        } else {
                            ret = typeof el[a] != "undefined" ? el[a] : null;
                        }
                    });
                    if ( args.length == 2 ) {
                        return this;
                    } else {
                        return ret;
                    }
                },
                data: function(d, v) {
                    let el = this.get(0),
                        s = d.replace(/-([a-z])/g, function (g) {
                        return g[1].toUpperCase();
                    });
                    if ( el != null ) {
                        if ( arguments.length == 2 ) {
                            el.dataset[s] = v;
                            return this;
                        } else {
                            return typeof el.dataset[s] == "undefined" ? '' : el.dataset[s];
                        }
                    }
                    return '';
                },
                html: function(v) {
                    let el = this.get(0);
                    if ( el != null ) {
                        if ( arguments.length == 1 ) {
                            el.innerHTML = v;
                            return this;
                        } else {
                            return el.innerHTML;
                        }
                    }
                    return '';
                },
                text: function(v) {
                    let el = this.get(0);
                    if ( el != null ) {
                        if ( arguments.length == 1 ) {
                            el.textContent = v;
                            return this;
                        } else {
                            return el.textContent;
                        }
                    }
                    return '';
                },
                css: function(prop, v) {
                    let els = this.get(), el;
                    for (let i=0; i<els.length; i++) {
                        el = els[i];
                        if ( arguments.length == 1 ) {
                            if ( typeof prop == "object" ) {
                                Object.keys(prop).forEach(function(k){
                                    el.style[k] = prop[k];
                                });
                            } else {
                                return window.getComputedStyle(el)[prop];
                            }
                        } else {
                            el.style[prop] = v;
                        }
                    }
                    return this;
                },
                position: function() {
                    let el = this.get(0);
                    if ( el != null ) {
                        return {'top': el.offsetTop, 'left': el.offsetLeft};
                    } else {
                        return {'top': 0, 'left': 0};
                    }
                },
                offset: function() {
                    let el = this.get(0);
                    if ( el != null ) {
                        if ( WPD.dom._fn.hasFixedParent(el) ) {
                            return el.getBoundingClientRect();
                        } else {
                            return WPD.dom._fn.absolutePosition(el);
                        }
                    } else {
                        return {'top': 0, 'left': 0};
                    }
                },
                outerWidth: function(margin) {
                    margin = margin || false;
                    let el = this.get(0);
                    if ( el != null ) {
                        return !margin ? parseInt( el.offsetWidth ) :
                            (
                                parseInt( el.offsetWidth ) +
                                parseInt( this.css('marginLeft') ) +
                                parseInt( this.css('marginRight') )
                            );
                    }
                },
                outerHeight: function(margin) {
                    margin = margin || false;
                    return !margin ? parseInt( this.css('height') ) :
                        (
                            parseInt( this.css('height') ) +
                            parseInt( this.css('marginTop') ) +
                            parseInt( this.css('marginBottom') )
                        );
                },
                innerWidth: function() {
                    let el = this.get(0);
                    if ( el != null ) {
                        let cs = window.getComputedStyle(el);
                        return this.outerWidth() - parseFloat(cs.borderLeftWidth) - parseFloat(cs.borderRightWidth);
                    }
                    return 0;
                },
                width: function() {
                    return this.outerWidth();
                },
                height: function() {
                    return this.outerHeight();
                },
                on: function() {
                    let args = arguments,
                        func = function(args, e) {
                            let $el;
                            if ( e.type == 'mouseenter' || e.type == 'mouseleave' || e.type == 'hover' ) {
                                let el = document.elementFromPoint(e.clientX, e.clientY);
                                if ( !el.matches(args[1]) ) {
                                    // noinspection StatementWithEmptyBodyJS
                                    while ((el = el.parentElement) && !el.matches(args[1])) ;
                                }
                                if ( el != null ) {
                                    $el = WPD.dom(el);
                                }
                            } else {
                                $el = WPD.dom(e.target).closest(args[1]);
                            }
                            if (
                                $el != null &&
                                $el.closest(this).length > 0
                            ){
                                let argd = [];
                                argd.push(e);
                                if ( typeof args[4] != 'undefined' ) {
                                    for (let i=4; i<args.length; i++) {
                                        argd.push(args[i]);
                                    }
                                }
                                args[2].apply($el.get(0), argd);
                            }
                        };
                    let events = args[0].split(' ');
                    for (let i=0;i<events.length;i++) {
                        let type = events[i];
                        if ( typeof args[1] == "string" ) {
                            this.forEach(function(el){
                                if ( !WPD.dom._fn.hasEventListener(el, type, args[2]) ) {
                                    let f = func.bind(el, args);
                                    el.addEventListener(type, f, args[3]);
                                    // Store the trigger in the selected elements, not the parent node
                                    el._wpd_el = typeof el._wpd_el == "undefined" ? [] : el._wpd_el;
                                    el._wpd_el.push({
                                        'type': type,
                                        'selector': args[1],
                                        'func': f,  // The bound function called by the event listener
                                        'trigger': args[2], // The function within the bound function, used in this.trigger(..)
                                        'args': args[3]
                                    });
                                }
                            });
                        } else {
                            for (let i=0;i<events.length;i++) {
                                let type = events[i];
                                this.forEach(function (el) {
                                    if ( !WPD.dom._fn.hasEventListener(el, type, args[1]) ) {
                                        el.addEventListener(type, args[1], args[2]);
                                        el._wpd_el = typeof el._wpd_el == "undefined" ? [] : el._wpd_el;
                                        el._wpd_el.push({
                                            'type': type,
                                            'func': args[1],
                                            'trigger': args[1],
                                            'args': args[2]
                                        });
                                    }
                                });
                            }
                        }
                    }
                    return this;
                },
                off: function(listen, callback) {
                    this.forEach(function (el) {
                        if ( typeof el._wpd_el != "undefined" && el._wpd_el.length > 0 ) {
                            if ( typeof listen === 'undefined' ) {
                                let cb;
                                while (cb = el._wpd_el.pop()) {
                                    el.removeEventListener(cb.type, cb.func, cb.args);
                                }
                                el._wpd_el = [];
                            } else {
                                listen.split(' ').forEach(function(type){
                                    if (typeof callback == "undefined") {
                                        let cb;
                                        while (cb = el._wpd_el.pop()) {
                                            el.removeEventListener(type, cb.func, cb.args);
                                        }
                                        el._wpd_el = [];
                                    } else {
                                        let remains = [];
                                        el._wpd_el.forEach(function(cb){
                                            if ( cb.type == type && cb.trigger == callback ) {
                                                el.removeEventListener(type, cb.func, cb.args);
                                            } else {
                                                remains.push(cb);
                                            }
                                        });
                                        el._wpd_el = remains;
                                    }
                                });
                            }
                        }
                    });
                    return this;
                },
                offForced: function(){
                    let _this = this;
                    this.forEach(function(el, i){
                        let ne = el.cloneNode(true);
                        el.parentNode.replaceChild(ne, el);
                        _this.a[i] = ne;
                    });
                    return this;
                },
                trigger: function(type, args, native ,jquery) {
                    native = native || false;
                    jquery = jquery || false;
                    this.forEach(function(el){
                        let triggered = false;
                        // noinspection JSUnresolvedVariable,JSUnresolvedFunction
                        if (
                            jquery &&
                            typeof jQuery != "undefined" &&
                            typeof jQuery._data != 'undefined' &&
                            typeof jQuery._data(el, 'events') != 'undefined' &&
                            typeof jQuery._data(el, 'events')[type] != 'undefined'
                        ) {
                            // noinspection JSUnresolvedVariable,JSUnresolvedFunction
                            jQuery(el).trigger(type, args);
                            triggered = true;
                        }
                        if ( !triggered && native ) {
                            // Native event handler
                            let event = new Event(type);
                            event.detail = args;
                            el.dispatchEvent(event);
                        }

                        if (typeof el._wpd_el != "undefined") {
                            // Case 1, regularly attached
                            el._wpd_el.forEach(function(data){
                                if ( data.type == type ) {
                                    let event = new Event(type);
                                    data.trigger.apply(el, [event].concat(args));
                                }
                            });
                        } else {
                            // Case 2, attached to a selector: $elem.on('click', 'selector'...
                            let found = false, p = el;
                            // Find parents, where event infomration is stored
                            while ( true ) {
                                p = p.parentElement;
                                if ( p == null ) {
                                    break;
                                }
                                if (typeof p._wpd_el != "undefined") {
                                    p._wpd_el.forEach(function(data){
                                        if ( typeof data.selector !== "undefined" ) {
                                            let targets = WPD.dom(p).find(data.selector);
                                            if (
                                                targets.length > 0 &&
                                                targets.get().indexOf(el) >=0 &&
                                                data.type == type
                                            ) {
                                                let event = new Event(type);
                                                data.trigger.apply(el, [event].concat(args));
                                                found = true;
                                            }
                                        }
                                    });
                                }
                                if ( found ) {
                                    break;
                                }
                            }
                        }
                    });
                    return this;
                },
                clone: function() {
                    let el = this.get(0);
                    if ( el != null ) {
                        this.a = [el.cloneNode(true)];
                        this.length = this.a.length;
                    } else {
                        this.a = [];
                    }
                    this.length = this.a.length;
                    return this;
                },
                remove: function(elem) {
                    if ( typeof elem != "undefined" ) {
                        return elem.parentElement.removeChild(elem);
                    } else {
                        this.forEach(function(el) {
                            if ( el.parentElement != null ) {
                                return el.parentElement.removeChild(el);
                            }
                        });
                        this.a = [];
                        this.length = this.a.length;
                        return null;
                    }
                },
                detach: function() {
                    let _this = this, n = [];
                    this.forEach(function(elem){
                        let el = _this.remove(elem);
                        if ( el != null ) {
                            n.push(el)
                        }
                    });
                    this.a = n;
                    this.length = this.a.length;
                    return this;
                },
                prepend: function(prepend) {
                    if ( typeof prepend == 'string' ) {
                        prepend = WPD.dom._fn.createElementsFromHTML(prepend);
                    }
                    prepend = Array.isArray(prepend) ? prepend : [prepend];
                    this.forEach(function(el){
                        prepend.forEach(function(pre){
                            if ( typeof pre.is_wpd_dom != 'undefined' ) {
                                pre.forEach(function(pr){
                                    el.insertBefore(pr, el.children[0]);
                                });
                            } else {
                                el.insertBefore(pre, el.children[0]);
                            }
                        });
                    });
                    return this;
                },
                append: function(append) {
                    if ( typeof append == 'string' ) {
                        append = WPD.dom._fn.createElementsFromHTML(append);
                    }
                    append = Array.isArray(append) ? append : [append];
                    this.forEach(function(el){
                        append.forEach(function(app) {
                            if ( app != null ) {
                                if (typeof app.is_wpd_dom != 'undefined') {
                                    app.forEach(function (ap) {
                                        el.appendChild(ap);
                                    });
                                } else {
                                    el.appendChild(app.cloneNode(true));
                                }
                            }
                        });
                    });
                    return this;
                },
                uuidv4: function() {
                    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                        let r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                        return v.toString(16);
                    });
                }
            }
            WPD.dom._fn = {
                bodyTransform: function() {
                    let x = 0, y = 0;
                    if ( typeof WebKitCSSMatrix !== 'undefined' ) {
                        let style = window.getComputedStyle(document.body);
                        if ( typeof style.transform != 'undefined' ) {
                            let matrix = new WebKitCSSMatrix(style.transform);
                            if ( matrix.m41 != 'undefined' ) {
                                x = matrix.m41;
                            }
                            if ( matrix.m42 != 'undefined' ) {
                                y = matrix.m42;
                            }
                        }
                    }

                    return {x: x, y: y};
                },
                bodyTransformY: function() {
                    return this.bodyTransform().y;
                },
                bodyTransformX: function() {
                    return this.bodyTransform().x;
                },
                hasFixedParent: function(el) {
                    /**
                     * When CSS transform is present, then Fixed element are no longer fixed
                     * even if the CSS declaration says.
                     */
                    if ( WPD.dom._fn.bodyTransformY() != 0 ) {
                        return false;
                    }
                    do {
                        if ( window.getComputedStyle(el)['position'] == 'fixed' ) {
                            return true;
                        }
                    } while( el = el.parentElement );
                    return false;
                },

                hasEventListener: function(el, type, trigger) {
                    if (typeof el._wpd_el == "undefined") {
                        return false;
                    }
                    for (let i = 0; i < el._wpd_el.length; i++) {
                        if ( el._wpd_el[i].trigger == trigger && el._wpd_el[i].type == type ) {
                            return true;
                        }
                    }
                    return false;
                },

                allDescendants: function(node) {
                    let nodes = [], _this = this;
                    if ( !Array.isArray(node) ) {
                        node = [node];
                    }
                    node.forEach( function(n){
                        for (let i = 0; i < n.childNodes.length; i++) {
                            let child = n.childNodes[i];
                            nodes.push(child);
                            nodes = nodes.concat(_this.allDescendants(child));
                        }
                    });
                    return nodes;
                },

                createElementsFromHTML: function(htmlString) {
                    let template = document.createElement('template');
                    template.innerHTML = htmlString.replace(/(\r\n|\n|\r)/gm, "");
                    return Array.prototype.slice.call(template.content.childNodes);
                },

                absolutePosition: function(el) {
                    if ( !el.getClientRects().length ) {
                        return { top: 0, left: 0 };
                    }

                    let rect = el.getBoundingClientRect();
                    let win = el.ownerDocument.defaultView;
                    return ({
                        top: rect.top + win.pageYOffset,
                        left: rect.left + win.pageXOffset
                    });
                },

                // Create a plugin based on a defined object
                plugin: function (name, object) {
                    WPD.dom.fn[name] = function (options) {
                        if ( typeof(options) != 'undefined' && object[options] ) {
                            return object[options].apply( this, Array.prototype.slice.call( arguments, 1 ));
                        } else {
                            return this.each(function (elem) {
                                elem['wpd_dom_' + name] = Object.create(object).init(options, elem);
                            });
                        }

                    };
                }
            }

            WPD.dom.version = version;
        }

        if ( arguments.length >= 1 ) {
            return WPD.dom.fn.$.apply(WPD.dom.fn, arguments);
        } else {
            return WPD.dom.fn;
        }
    };
    WPD.dom();
    document.dispatchEvent(new Event('wpd-dom-core-loaded'));
}());(function() {
    // Prevent duplicate loading
    if ( typeof WPD.dom.fn.animate != "undefined" ) {
        return false;	// Terminate
    }
    WPD.dom.fn._animate = {
        "easing": {
            "linear": function(x) { return x; },
            "easeInOutQuad": function(x) {
                return x < 0.5 ? 2 * x * x : 1 - Math.pow(-2 * x + 2, 2) / 2;
            },
            "easeOutQuad": function(x) {
                return 1 - (1 - x) * (1 - x);
            }
        }
    };
    WPD.dom.fn.animate = function(props, duration, easing) {
        let _this = this;
        duration = duration || 200;
        easing = easing || "linear";
        this.forEach(function(el){
            let frames, currentFrame = 0, fps = 60, multiplier, origProps = {}, propsDiff = {},
                handlers, handler, easingFn;
            handlers = _this.prop('_wpd_dom_animations');
            handlers = handlers == null ? [] : handlers;

            if ( props === false ) {
                handlers.forEach(function(handler){
                    // noinspection JSCheckFunctionSignatures
                    clearInterval(handler);
                });
            } else {
                if ( typeof _this._animate.easing[easing] != "undefined" ) {
                    easingFn = _this._animate.easing[easing];
                } else {
                    easingFn = _this._animate.easing.easeInOutQuad;
                }
                Object.keys(props).forEach(function(prop){
                    if ( prop.indexOf('scroll') > -1 ) {
                        origProps[prop] = el[prop];
                        propsDiff[prop] = props[prop] - origProps[prop];
                    } else {
                        origProps[prop] = parseInt( window.getComputedStyle(el)[prop] );
                        propsDiff[prop] = props[prop] - origProps[prop];
                    }
                });

                function move() {
                    currentFrame++;
                    if ( currentFrame > frames ) {
                        clearInterval(handler);
                        return;
                    }
                    multiplier = easingFn(currentFrame / frames);
                    Object.keys(propsDiff).forEach(function(prop){
                        if ( prop.indexOf('scroll') > -1 ) {
                            el[prop] = origProps[prop] + propsDiff[prop] * multiplier;
                        } else {
                            el.style[prop] =
                                origProps[prop] + propsDiff[prop] * multiplier + 'px';
                        }
                    });
                }

                frames = duration / 1000 * fps;

                handler = setInterval(move, 1000 / fps);
                handlers.push(handler);
                _this.prop('_wpd_dom_animations', handlers);
            }
        });
        return this;
    };
    document.dispatchEvent(new Event('wpd-dom-animate-loaded'));
}());/*
 * WPD.dom Highlight plugin
 *
 * Based on highlight v3 by Johann Burkard
 * http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html
 * Copyright (c) 2009 Bartek Szopka
 *
 * Licensed under MIT license.
 *
 */
(function() {
    let $ = WPD.dom;

    // Prevent duplicate loading
    if ( typeof WPD.dom.fn.unhighlight != "undefined" ) {
        return false;	// Terminate
    }

    WPD.dom.fn.unhighlight = function (options) {
        let settings = {className: 'highlight', element: 'span'};
        $.fn.extend(settings, options);

        return this.find(settings.element + "." + settings.className).each(function () {
            let parent = this.parentNode;
            parent.replaceChild(this.firstChild, this);
            parent.normalize();
        });
    };

    WPD.dom.fn.highlight = function (words, options) {
        let settings = {
            className: 'highlight',
            element: 'span',
            caseSensitive: false,
            wordsOnly: false,
            excludeParents: ''
        };
        $.fn.extend(settings, options);

        if (words.constructor === String) {
            words = [words];
        }
        words = words.filter(function(el){
            return el != '';
        });
        words.forEach(function(w, i, o){
            o[i] = w.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&").normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        });

        if (words.length == 0) {
            return this;
        }

        let flag = settings.caseSensitive ? "" : "i";
        let pattern = "(" + words.join("|") + ")";
        if (settings.wordsOnly) {
            pattern = "(?:,|^|\\s)" + pattern + "(?:,|$|\\s)";
        }
        let re = new RegExp(pattern, flag);
        function highlight(node, re, nodeName, className, excludeParents) {
            excludeParents = excludeParents == '' ? '.exhghttt' : excludeParents;
            if (node.nodeType === 3) {
                let normalized = node.data.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                let match = normalized.match(re);
                if (match) {
                    let highlight = document.createElement(nodeName || 'span');
                    let index;
                    highlight.className = className || 'highlight';
                    if (/\.|,|\s/.test(match[0].charAt(0)))
                        index = match.index + 1;
                    else
                        index = match.index;
                    let wordNode = node.splitText(index);
                    wordNode.splitText(match[1].length);
                    let wordClone = wordNode.cloneNode(true);
                    highlight.appendChild(wordClone);
                    wordNode.parentNode.replaceChild(highlight, wordNode);
                    return 1; //skip added node in parent
                }
            } else if ((node.nodeType === 1 && node.childNodes) && // only element nodes that have children
                !/(script|style)/i.test(node.tagName) && // ignore script and style nodes
                !$(node).closest(excludeParents).length > 0 &&
                !(node.tagName === nodeName.toUpperCase() && node.className === className)) { // skip if already highlighted
                for (let i = 0; i < node.childNodes.length; i++) {
                    i += highlight(node.childNodes[i], re, nodeName, className, excludeParents);
                }
            }
            return 0;
        }

        return this.each(function (el) {
            highlight(el, re, settings.element, settings.className, settings.excludeParents);
        });
    };
}());(function() {
    // Prevent duplicate loading
    if ( typeof WPD.dom.fn.serialize != "undefined" ) {
        return false;	// Terminate
    }
    WPD.dom.fn.serialize = function() {
        let form = this.get(0);
        if ( !form || form.nodeName !== "FORM" ) {
            return;
        }
        let i, j, q = [];
        for (i = form.elements.length - 1; i >= 0; i = i - 1) {
            if (form.elements[i].name === "") {
                continue;
            }
            switch (form.elements[i].nodeName) {
                case 'INPUT':
                    switch (form.elements[i].type) {
                        case 'text':
                        case 'hidden':
                        case 'password':
                        case 'button':
                        case 'reset':
                        case 'submit':
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                            break;
                        case 'checkbox':
                        case 'radio':
                            if (form.elements[i].checked) {
                                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                            }
                            break;
                        case 'file':
                            break;
                    }
                    break;
                case 'TEXTAREA':
                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                    break;
                case 'SELECT':
                    switch (form.elements[i].type) {
                        case 'select-one':
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                            break;
                        case 'select-multiple':
                            for (j = form.elements[i].options.length - 1; j >= 0; j = j - 1) {
                                if (form.elements[i].options[j].selected) {
                                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j].value));
                                }
                            }
                            break;
                    }
                    break;
                case 'BUTTON':
                    switch (form.elements[i].type) {
                        case 'reset':
                        case 'submit':
                        case 'button':
                            q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                            break;
                    }
                    break;
            }
        }
        return q.join("&");
    };
    WPD.dom.fn.serializeForAjax = function(obj, prefix) {
        let str = [],
            p;
        for (p in obj) {
            if (obj.hasOwnProperty(p)) {
                let k = prefix ? prefix + "[" + p + "]" : p,
                    v = obj[p];
                str.push((v !== null && typeof v === "object") ?
                    WPD.dom.fn.serializeForAjax(v, k) :
                    encodeURIComponent(k) + "=" + encodeURIComponent(v));
            }
        }
        return str.join("&");
    };
    document.dispatchEvent(new Event('wpd-dom-serialize-loaded'));
}());(function() {
    // Prevent duplicate loading
    if ( typeof WPD.dom.fn.inViewPort != "undefined" ) {
        return false;	// Terminate
    }
    WPD.dom.fn.inViewPort = function (tolerance, viewport) {
        "use strict";
        let element = this.get(0), vw, vh;
        if (element == null)
            return false;
        tolerance = typeof tolerance == 'undefined' ? 0 : tolerance;
        viewport = typeof viewport == 'undefined' ? window :
            ( typeof viewport == 'string' ? document.querySelector(viewport) : viewport );
        let ref = element.getBoundingClientRect(),
            top = ref.top, bottom = ref.bottom,
            left = ref.left, right = ref.right,
            invisible = false;

        if (viewport == null) {
            viewport = window;
        }
        if (viewport === window) {
            vw = window.innerWidth || 0;
            vh = window.innerHeight || 0;
        } else {
            vw = viewport.clientWidth
            vh = viewport.clientHeight
            let vr = viewport.getBoundingClientRect();

            // recalculate these relative to viewport
            top = top - vr.top;
            bottom = bottom - vr.top;
            left = left - vr.left;
            right = right - vr.left;
        }

        tolerance = ~~Math.round(parseFloat(tolerance));
        if (right <= 0 || left >= vw) {
            return invisible
        }

        // if the element is bound to some tolerance
        invisible = tolerance > 0 ? top >= tolerance && bottom < (vh - tolerance) :
            ( bottom > 0 && top <= (vh - tolerance) ) |
            ( top <= 0 && bottom > tolerance);

        return invisible;
    };
    document.dispatchEvent(new Event('wpd-dom-viewport-loaded'));
}());(function() {
    // Prevent duplicate loading
    if ( typeof WPD.dom.fn.ajax != "undefined" ) {
        return false;	// Terminate
    }
    WPD.dom.fn.ajax = function(args) {
        let defaults = {
            'url': '',
            'method': 'GET',
            'cors': 'cors', // cors, no-cors
            'data': {},
            'success': null,
            'fail': null,
            'accept': 'text/html',
            'contentType': 'application/x-www-form-urlencoded; charset=UTF-8'
        }
        args = this.extend(defaults, args);

        if ( args.cors != 'cors' ) {
            let fn = 'ajax_cb_' + this.uuidv4().replaceAll('-', '');
            WPD.dom.fn[fn] = function() {
                args.success.apply(this, arguments);
                delete WPD.dom.fn[args.data.fn];
            };
            args.data.callback = 'WPD.dom.fn.' + fn;
            args.data.fn = fn;
            let script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = args.url + '?' + this.serializeForAjax(args.data);
            script.onload = function(){this.remove();};
            document.body.appendChild(script);
        } else {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if ( args.success != null ) {
                    if ( this.readyState == 4 && this.status == 200 ) {
                        args.success(this.responseText);
                    }
                }
                if ( args.fail != null ) {
                    if ( this.readyState == 4 && this.status >= 400 ) {
                        args.fail(this);
                    }
                }
            };

            xhttp.open(args.method.toUpperCase(), args.url, true);
            xhttp.setRequestHeader('Content-type', args.contentType);
            xhttp.setRequestHeader('Accept', args.accept);

            xhttp.send(this.serializeForAjax(args.data));
            return xhttp;
        }
    };
    document.dispatchEvent(new Event('wpd-dom-xhttp-loaded'));
}());window.WPD = window.WPD || {};
window.WPD.Base64 = {
    // private property
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

    // public method for encoding
    encode: function (input) {
        let output = "", chr1, chr2, chr3, enc1, enc2, enc3, enc4, i = 0;

        input = this._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },

    // public method for decoding
    decode: function (input) {
        let output = "", chr1, chr2, chr3, enc1, enc2, enc3, enc4, i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = this._utf8_decode(output);

        return output;

    },

    // private method for UTF-8 encoding
    _utf8_encode: function (string) {
        string = string.replace(/\r\n/g, "\n");
        let utftext = "";

        for (let n = 0; n < string.length; n++) {

            let c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            } else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            } else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode: function (utftext) {
        let string = "", i = 0, c = 0, c2, c3;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            } else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            } else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

};// https://gist.github.com/rheinardkorf/c6592b59fb061f9f8310
(function(){
    window.WPD = window.WPD || {};
    WPD.Hooks = WPD.Hooks || {};
    let Hooks = WPD.Hooks;
    Hooks.filters = Hooks.filters || {};
    /**
     * Adds a callback function to a specific programmatically triggered tag (hook)
     *
     * @param tag - the hook name
     * @param callback - the callback function variable name
     * @param priority - (optional) default=10
     * @param scope - (optional) function scope. When a function is executed within an object scope, the object variable should be passed.
     */
    Hooks.addFilter = function( tag, callback, priority, scope ) {
        priority = typeof priority === "undefined" ? 10 : priority;
        scope = typeof scope === "undefined" ? null : scope;
        Hooks.filters[ tag ] = Hooks.filters[ tag ] || [];
        Hooks.filters[ tag ].push( { priority: priority, scope: scope, callback: callback } );
    }

    /**
     * Removes a callback function from a hook
     *
     * @param tag - the hook name
     * @param callback - the callback function variable
     */
    Hooks.removeFilter = function( tag, callback ) {
        if ( typeof Hooks.filters[ tag ] != 'undefined' ) {
            if ( typeof callback == "undefined" ) {
                Hooks.filters[tag] = [];
            } else {
                Hooks.filters[tag].forEach(function (filter, i) {
                    if (filter.callback === callback) {
                        Hooks.filters[tag].splice(i, 1);
                    }
                });
            }
        }
    }
    Hooks.applyFilters = function( tag ) {
        let filters = [],
            args = Array.prototype.slice.call(arguments),
            value = arguments[1];
        if( typeof Hooks.filters[ tag ] !== "undefined" && Hooks.filters[ tag ].length > 0 ) {
            Hooks.filters[ tag ].forEach( function( hook ) {
                filters[ hook.priority ] = filters[ hook.priority ] || [];
                filters[ hook.priority ].push( {
                    scope: hook.scope,
                    callback: hook.callback
                } );
            } );
            args.splice(0, 2);
            filters.forEach( function( hooks ) {
                hooks.forEach( function( obj ) {
                    /**
                     * WARNING!
                     * If, this function is called with a referanced parameter like OBJECT or ARRAY argument
                     * as the first argument - then the callback function MUST return that value, otherwise
                     * it is overwritten with NULL!
                     * Ex.:
                     * Hooks.applyFilters('my_filter', object);
                     * Hooks.addFilter('my_filter', function(obj){
                     *     do things..
                     *     return obj; <--- IMPORTANT IN EVERY CASE
                     * });
                     */
                    value = obj.callback.apply( obj.scope, [value].concat(args) );
                } );
            } );
        }
        return value;
    }
}());window.WPD = window.WPD || {};
/**
 * Checks "criteria" until not false, then executes function "f". No delay on first execution, like with simple
 * setInterval().
 * @param f
 * @param criteria Function or variable reference - preferably function
 * @param interval
 * @param maxTries
 * @returns {*}
 */
window.WPD.intervalUntilExecute = function(f, criteria, interval, maxTries) {
    let t, tries = 0,
        res = typeof criteria === "function" ? criteria() : criteria;
    interval = typeof interval == "undefined" ? 100 : interval;
    maxTries = typeof maxTries == "undefined" ? 50 : maxTries;

    if ( res === false ) {
        t = setInterval(function (){
            res = typeof criteria === "function" ? criteria() : criteria;
            tries++;
            if ( tries > maxTries ) {
                clearInterval(t);
                return false;
            }
            if ( res !== false ) {
                clearInterval(t);
                return f(res);
            }
        }, interval)
    } else {
        return f(res);
    }
};(function(){
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
})();WPD.dom._fn.plugin('ajaxsearchlite', window.WPD.ajaxsearchlite.plugin);(function($){
    "use strict";
    let functions = {
        // If only google source is used, this is much faster..
        autocompleteGoogleOnly: function () {
            let $this = this,
                val = $this.n('text').val();
            if ($this.n('text').val() == '') {
                $this.n('textAutocomplete').val('');
                return;
            }
            let autocompleteVal = $this.n('textAutocomplete').val();
            if (autocompleteVal != '' && autocompleteVal.indexOf(val) == 0) {
                return;
            } else {
                $this.n('textAutocomplete').val('');
            }
            let lang = $this.o.autocomplete.lang;
            ['wpml_lang', 'polylang_lang', 'qtranslate_lang'].forEach( function(v){
                if (
                    $('input[name="'+v+'"]', $this.n('searchsettings')).length > 0 &&
                    $('input[name="'+v+'"]', $this.n('searchsettings')).val().length > 1
                ) {
                    lang = $('input[name="' + v + '"]', $this.n('searchsettings')).val();
                }
            });
            // noinspection JSUnresolvedVariable
            if ( $this.n('text').val().length >= $this.o.autocomplete.trigger_charcount ) {
                $.fn.ajax({
                    url: 'https://clients1.google.com/complete/search',
                    cors: 'no-cors',
                    data: {
                        q: val,
                        hl: lang,
                        nolabels: 't',
                        client: 'hp',
                        ds: ''
                    },
                    success: function (data) {
                        if (data[1].length > 0) {
                            let response = data[1][0][0].replace(/(<([^>]+)>)/ig, "");
                            response = $('<textarea />').html(response).text();
                            response = response.substr(val.length);
                            $this.n('textAutocomplete').val(val + response);
                            $this.fixAutocompleteScrollLeft();
                        }
                    }
                });
            }
        },

        fixAutocompleteScrollLeft: function() {
            this.n('textAutocomplete').get(0).scrollLeft = this.n('text').get(0).scrollLeft;
        }
    }
    $.fn.extend(window.WPD.ajaxsearchlite.plugin, functions);
})(WPD.dom);(function($){
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
        showVerticalResults: function () {
            let $this = this;

            $this.showResultsBox();

            if ($this.n('items').length > 0) {
                // noinspection JSUnresolvedVariable
                let count = (($this.n('items').length < $this.o.itemscount) ? $this.n('items').length : $this.o.itemscount);
                count = count <= 0 ? 9999 : count;
                let groups = $('.asl_group_header', $this.n('resultsDiv'));

                // So if the result list is short, we dont even need to do the match
                // noinspection JSUnresolvedVariable
                if ($this.o.itemscount == 0 || $this.n('items').length <= $this.o.itemscount) {
                    $this.n('results').css({
                        height: 'auto'
                    });
                } else {

                    // Set the height to a fictive value to refresh the scrollbar
                    // .. otherwise the height is not calculated correctly, because of the scrollbar width.
                    if ( $this.call_num < 1 )
                        $this.n('results').css({
                            height: "30px"
                        });

                    if ( $this.call_num < 1 ) {
                        // Here now we have the correct item height values with the scrollbar enabled
                        let i = 0,
                            h = 0,
                            final_h = 0,
                            highest = 0;

                        $this.n('items').forEach(function () {
                            h += $(this).outerHeight(true);
                            if ($(this).outerHeight(true) > highest)
                                highest = $(this).outerHeight(true);
                            i++;
                        });

                        // Get an initial height based on the highest item x viewport
                        final_h = highest * count;
                        // Reduce the final height to the overall height if exceeds it
                        if (final_h > h)
                            final_h = h;

                        // Count the average height * viewport size
                        i = i < 1 ? 1 : i;
                        h = h / i * count;

                        /*
                         Groups need a bit more calculation
                         - determine group position by index and occurence
                         - one group consists of group header, items + item spacers per item
                         - only groups within the viewport are calculated
                         */
                        if (groups.length > 0) {
                            groups.forEach(function (el, index) {
                                let position = Array.prototype.slice.call(el.parentNode.children).indexOf(el),
                                    group_position = position - index - Math.floor(position / 3);
                                if (group_position < count) {
                                    final_h += $(this).outerHeight(true);
                                }
                            });
                        }
                        $this.n('results').css({
                            height: final_h + 'px'
                        });

                    }
                }

                // Mark the last item
                $this.n('items').last().addClass('asl_last_item');
                // Before groups as well
                $this.n('results').find('.asl_group_header').prev('.item').addClass('asl_last_item');
                if ($this.o.highlight == 1) {
                    // noinspection JSUnresolvedVariable
                    $("div.item", $this.n('resultsDiv')).highlight($this.n('text').val().split(" "), {
                        element: 'span', className: 'highlighted', wordsOnly: $this.o.highlightWholewords
                    });
                }


            }
            $this.resize();
            if ($this.n('items').length == 0) {
                $this.n('results').css({
                    height: 'auto'
                });
            }
            $this.n('results').css({
                'overflowY': 'auto'
            });

            // Scroll to top
            $this.n('results').get(0).scrollTop = 0;

            $this.fixResultsPosition(true);
            $this.searching = false;
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
    let functions = {
        showSettings: function () {
            let $this = this;

            $this.initSettings?.();

            $this.n('searchsettings').css($this.settAnim.showCSS);
            $this.n('searchsettings').removeClass($this.settAnim.hideClass).addClass($this.settAnim.showClass);

            $this.n('prosettings').data('opened', 1);
            $this.fixSettingsPosition(true);
        },
        hideSettings: function () {
            let $this = this;

            $this.initSettings?.();

            $this.n('searchsettings').removeClass($this.settAnim.showClass).addClass($this.settAnim.hideClass);
            setTimeout(function(){
                $this.n('searchsettings').css($this.settAnim.hideCSS);
            }, $this.settAnim.duration);

            $this.n('prosettings').data('opened', 0);
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
        initAutocompleteEvent: function () {
            let $this = this;
            if ( $this.o.autocomplete.enabled == 1 ) {
                $this.n('text').on('keyup', function (e) {
                    $this.keycode = e.keyCode || e.which;
                    $this.ktype = e.type;
                    let thekey = 39;
                    // Lets change the keykode if the direction is rtl
                    if ($('body').hasClass('rtl'))
                        thekey = 37;
                    if ($this.keycode == thekey && $this.n('textAutocomplete').val() != "") {
                        e.preventDefault();
                        $this.n('text').val($this.n('textAutocomplete').val());
                        if ($this.post != null) $this.post.abort();
                        $this.search();
                    } else {
                        if ($this.postAuto != null) $this.postAuto.abort();
                        $this.autocompleteGoogleOnly();
                    }
                });
                $this.n('text').on('keyup mouseup input blur select', function(){
                   $this.fixAutocompleteScrollLeft();
                });
            }
        }
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
    let functions = {
        initFacetEvents: function() {
            let $this = this;
            $('input[type=checkbox]', $this.n('searchsettings')).on('asl_chbx_change', function(e){
                $this.ktype = e.type;
                $this.n('searchsettings').find('input[name=filters_changed]').val(1);
                $this.gaEvent?.('facet_change', {
                    'option_label': $(this).closest('fieldset').find('legend').text(),
                    'option_value': $(this).closest('.asl_option').find('.asl_option_label').text() + ($(this).prop('checked') ? '(checked)' : '(unchecked)')
                });
                $this.setFilterStateInput(65);
                $this.searchWithCheck(80);
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
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        initSettingsSwitchEvents: function() {
            let $this = this;
            $this.n('prosettings').on("click", function () {
                if ($this.n('prosettings').data('opened') == 0) {
                    $this.showSettings();
                } else {
                    $this.hideSettings();
                }
            });

            if ($this.o.settingsVisible == 1) {
                $this.showSettings(false);
            }
        },

        initSettingsEvents: function() {
            let $this = this, t;

            let formDataHandler = function(){
                // Let everything initialize (datepicker etc..), then get the form data
                if ( typeof $this.originalFormData === 'undefined' ) {
                    $this.originalFormData = helpers.formData($('form', $this.n('searchsettings')));
                }
                $this.n('searchsettings').off('mousedown touchstart mouseover', formDataHandler);
            };
            $this.n('searchsettings').on('mousedown touchstart mouseover', formDataHandler);

            let handler = function (e) {
                if ( $(e.target).closest('.asl_w').length == 0 ) {
                    if ( !$this.dragging ) {
                        $this.hideSettings?.();
                    }
                }
            };
            $this.documentEventHandlers.push({
                'node': document,
                'event': $this.clickTouchend,
                'handler': handler
            });
            $(document).on($this.clickTouchend, handler);

            // Note if the settings have changed
            $this.n('searchsettings').on('click', function(){
                $this.settingsChanged = true;
            });

            $this.n('searchsettings').on($this.clickTouchend, function (e) {
                $this.updateHref();

                /**
                 * Stop propagation on settings clicks, except the noUiSlider handler event.
                 * If noUiSlider event propagation is stopped, then the: set, end, change events does not fire properly.
                 */
                if ( typeof e.target != 'undefined' && !$(e.target).hasClass('noUi-handle') ) {
                    e.stopImmediatePropagation();
                } else {
                    // For noUI case, still cancel if this is a click (desktop device)
                    if ( e.type == 'click' )
                        e.stopImmediatePropagation();
                }
            });

            // Category level automatic checking and hiding
            $('.asl_option_cat input[type="checkbox"]', $this.n('searchsettings')).on('asl_chbx_change', function(){
                $this.settingsCheckboxToggle( $(this).closest('.asl_option_cat') );
            });
            // Init the hide settings
            $('.asl_option_cat', $this.n('searchsettings')).forEach(function(el){
                $this.settingsCheckboxToggle( $(el), false );
            });

            // Emulate click on checkbox on the whole option
            //$('div.asl_option', $this.n('searchsettings')).on('mouseup touchend', function(e){
            $('div.asl_option', $this.n('searchsettings')).on($this.mouseupTouchend, function(e){
                e.preventDefault(); // Stop firing twice on mouseup and touchend on mobile devices
                e.stopImmediatePropagation();

                if ( $this.dragging ) {
                    return false;
                }
                $(this).find('input[type="checkbox"]').prop("checked", !$(this).find('input[type="checkbox"]').prop("checked"));
                // Trigger a custom change event, for max compatibility
                // .. the original change is buggy for some installations.
                clearTimeout(t);
                let _this = this;
                t = setTimeout(function() {
                    $(_this).find('input[type="checkbox"]').trigger('asl_chbx_change');
                }, 50);

            });

            $('div.asl_option label', $this.n('searchsettings')).on('click', function(e){
                e.preventDefault(); // Let the previous handler handle the events, disable this
            });

            // Change the state of the choose any option if all of them are de-selected
            $('fieldset.asl_checkboxes_filter_box', $this.n('searchsettings')).forEach(function(){
                let all_unchecked = true;
                $(this).find('.asl_option:not(.asl_option_selectall) input[type="checkbox"]').forEach(function(){
                    if ($(this).prop('checked') == true) {
                        all_unchecked = false;
                        return false;
                    }
                });
                if ( all_unchecked ) {
                    $(this).find('.asl_option_selectall input[type="checkbox"]').prop('checked', false).removeAttr('data-origvalue');
                }
            });

            // Mark last visible options
            $('fieldset' ,$this.n('searchsettings')).forEach(function(){
                $(this).find('.asl_option:not(.hiddend)').last().addClass("asl-o-last");
            });

            // Select all checkboxes
            $('.asl_option_cat input[type="checkbox"], .asl_option_cff input[type="checkbox"]', $this.n('searchsettings')).on('asl_chbx_change', function(){
                let className = $(this).data("targetclass");
                if ( typeof className == 'string' && className != '')
                    $("input." + className, $this.n('searchsettings')).prop("checked", $(this).prop("checked"));
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
})(WPD.dom);(function($){
    "use strict";
    let helpers = window.WPD.ajaxsearchlite.helpers;
    let functions = {
        /**
         * This function should be called on-demand to init the settings. Do not call on init, only when needed.
         */
        initSettings: function() {
            if ( !this.settingsInitialized ) {
                this.loadASLFonts?.();
                this.initSettingsBox?.();
                this.initSettingsEvents?.();
                this.initFacetEvents?.();
            }
        },

        initSettingsBox: function() {
            let $this = this;
            let appendSettingsTo = function($el) {
                let old = $this.n('searchsettings').get(0);
                $this.nodes.searchsettings = $this.n('searchsettings').clone();
                $el.append($this.n('searchsettings'));


                $(old).find('*[id]').forEach(function(el){
                    if ( el.id.indexOf('__original__') < 0 ) {
                        el.id = '__original__' + el.id;
                    }
                });
                $this.n('searchsettings').find('*[id]').forEach(function(el){
                    if ( el.id.indexOf('__original__') > -1 ) {
                        el.id =  el.id.replace('__original__', '');
                    }
                });
            }

            // Calculates the settings animation attributes
            $this.initSettingsAnimations?.();

            appendSettingsTo($('body'));
            $this.n('searchsettings').get(0).id = $this.n('searchsettings').get(0).id.replace('__original__', '');
            $this.detectAndFixFixedPositioning();

            $this.settingsInitialized = true;
        },
        initSettingsAnimations: function() {
            let $this = this;
            $this.settAnim = {
                "showClass": "",
                "showCSS": {
                    "visibility": "visible",
                    "display": "block",
                    "opacity": 1,
                    "animation-duration": $this.animOptions.settings.dur + 'ms'
                },
                "hideClass": "",
                "hideCSS": {
                    "visibility": "hidden",
                    "opacity": 0,
                    "display": "none"
                },
                "duration": $this.animOptions.settings.dur + 'ms'
            };

            if ($this.animOptions.settings.anim == "fade") {
                $this.settAnim.showClass = "asl_an_fadeIn";
                $this.settAnim.hideClass = "asl_an_fadeOut";
            }

            if ($this.animOptions.settings.anim == "fadedrop" &&
                !$this.o.blocking ) {
                $this.settAnim.showClass = "asl_an_fadeInDrop";
                $this.settAnim.hideClass = "asl_an_fadeOutDrop";
            } else if ( $this.animOptions.settings.anim == "fadedrop" ) {
                // If does not support transitio, or it is blocking layout
                // .. fall back to fade
                $this.settAnim.showClass = "asl_an_fadeIn";
                $this.settAnim.hideClass = "asl_an_fadeOut";
            }

            $this.n('searchsettings').css({
                "-webkit-animation-duration": $this.settAnim.duration + "ms",
                "animation-duration": $this.settAnim.duration + "ms"
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
});window._ASL_load = function () {
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