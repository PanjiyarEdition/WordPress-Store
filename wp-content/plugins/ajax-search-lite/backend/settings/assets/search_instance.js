jQuery(function ($) {
    WPD.Conditionals.init('.tabscontent');

    $('.tabs a[tabid=1]').on('click', function () {
        $('.tabs a[tabid=101]').trigger('click');
    });

    $('.tabs a[tabid=3]').on('click', function () {
        $('.tabs a[tabid=301]').trigger('click');
    });

    $('.tabs a[tabid=4]').on('click', function () {
        $('.tabs a[tabid=401]').trigger('click');
    });

    $('.tabs a[tabid=7]').on('click', function () {
        $('.tabs a[tabid=701]').trigger('click');
    });

    $('.tabs a').on('click', function () {
        $('#sett_tabid').val($(this).attr('tabid'));
        location.hash = $(this).attr('tabid');
    });

    // Remove the # from the hash, as different browsers may or may not include it
    var hash = location.hash.replace('#', '');

    if (hash != '') {
        hash = parseInt(hash);
        $('.tabs a[tabid=' + Math.floor(hash / 100) + ']').click();
        $('.tabs a[tabid=' + hash + ']').click();
    } else {
        $('.tabs a[tabid=1]').click();
    }

    // Theme options
    $('select[name=theme]').on('change', function(){
        $('.asl_theme').removeClass().addClass('asl_theme asl_theme-' + $(this).val());
    });
    $('select[name=theme]').trigger('change');

    // -------------------------------- MODAL MESSAGES ----------------------------------
    var modalItems = [
        {
            'args': {
                'type'   : 'info', // warning, info
                'header' : 'GDPR & Cookie Notice',
                'headerIcons': true,
                'content': 'When using this option in <strong>POST</strong> mode, cookies might be set during the search redirection to store the search filter status and the phrase for pagination.' +
                ' These cookies are <strong>functional</strong> only, they are not used for marketing nor any other purposes.' +
                '<br><br>The cookie names are: <i>asl_data, asl_id, asl_phrase</i>',
                'buttons': {
                    'okay': {
                        'text': 'Okay',
                        'type': 'okay',
                        'click': function(e, button){}
                    }
                }
            }, // Modal args
            'items': [
                ['override_method', 'post']
            ]
        }
    ];
    function modal_check(items) {
        var ret = false;
        // If at least one of the values does not match, it is a pass, return true
        $.each(items, function(k, item){
            if ( typeof item[2] != 'undefined' ) {
                if ( $('*[name='+item[0]+']').val() == item[1] ) {
                    ret = true;
                    return false;
                }
            } else if ( $('*[name='+item[0]+']').val() != item[1] ) {
                ret = true;
                return false;
            }

        });
        return ret;
    }
    $.each(modalItems, function(k, item){
       $.each(item.items, function(kk, _item){
           $('*[name='+_item[0]+']').data('oldval', $('*[name='+_item[0]+']').val());
           $('*[name='+_item[0]+']').on('change', function() {
                var _this = this;
                if ( !modal_check(item.items) ) {
                    if ( typeof item.args.buttons != 'undefined' ) {
                        if ( typeof item.args.buttons.cancel != 'undefined' )
                            item.args.buttons.cancel.click = function ( e, button ) {
                                if ( $(_this).data('oldval') !== undefined ) {
                                    $(_this).val($(_this).data('oldval'));
                                    $('.triggerer', $(_this).closest('div')).trigger('click');
                                }
                                $(_this).data('oldval', $(_this).val());
                            };
                        if ( typeof item.args.buttons.okay != 'undefined' )
                            item.args.buttons.okay.click = function ( e, button ) {
                                $(_this).data('oldval', $(_this).val());
                            };
                    }
                    WPD_Modal.show(item.args);
                } else {
                    $(_this).data('oldval', $(_this).val());
                }
           });
       });
    });

    // Why pro? Modal message
    $('a.whypro').on('click', function(e){
        e.preventDefault();
        var args = {
            'type'   : 'info', // warning, info
            'header' : 'Why get the Pro version?',
            'headerIcons': true,
            'content': $('#whypro_content').get(0).outerHTML,
            'buttons': {
                'okay': {
                    'text': 'Close',
                    'type': 'okay',
                    'click': function(e, button){}
                }
            }
        };
        WPD_Modal.layout({
            'width': '720px',
            'max-width': '720px'
        });
        WPD_Modal.show(args);
    });

    // -------------------------------- MODAL MESSAGES END ------------------------------
});

