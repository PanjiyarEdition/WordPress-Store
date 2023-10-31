jQuery(function($){
    $('select[name=analytics]').on('change', function(){
        var v = $(this).val();
        if ( v == '0' ) {
            $('.asl_al_pageview').addClass('hiddend');
            $('.asl_al_event').addClass('hiddend');
            $('.asl_al_both').addClass('hiddend');
        } else if ( v == 'pageview' ) {
            $('.asl_al_pageview').removeClass('hiddend');
            $('.asl_al_event').addClass('hiddend');
            $('.asl_al_both').removeClass('hiddend');
        } else if ( v == 'event' ) {
            $('.asl_al_pageview').addClass('hiddend');
            $('.asl_al_event').removeClass('hiddend');
            $('.asl_al_both').removeClass('hiddend');
        }
    }).trigger('change');
    $('.asl_gtag_switch input[isparam]').on('change', function(){
        if ( $(this).val() == 1 ) {
            $(this).closest('fieldset').find('.asl_gtag_inputs').removeClass('disabled');
        } else {
            $(this).closest('fieldset').find('.asl_gtag_inputs').addClass('disabled');
        }
    }).trigger('change');
    $('.asl_submit_reset').on('click', function(){
        if(confirm('Do you really want to reset the options to defaults?')) {
            return true;
        }
        return false;
    });
});