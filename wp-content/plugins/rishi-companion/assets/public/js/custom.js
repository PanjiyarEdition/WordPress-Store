jQuery(document).ready(function ($) {

    /** Lightbox */
    if (RishiCompanionCustom.lightbox === 'yes') {

        $('.entry-content').find('.gallery-columns-1').find('.gallery-icon > a').attr('data-fancybox', 'group1');
        $('.entry-content').find('.gallery-columns-2').find('.gallery-icon > a').attr('data-fancybox', 'group2');
        $('.entry-content').find('.gallery-columns-3').find('.gallery-icon > a').attr('data-fancybox', 'group3');
        $('.entry-content').find('.gallery-columns-4').find('.gallery-icon > a').attr('data-fancybox', 'group4');
        $('.entry-content').find('.gallery-columns-5').find('.gallery-icon > a').attr('data-fancybox', 'group5');
        $('.entry-content').find('.gallery-columns-6').find('.gallery-icon > a').attr('data-fancybox', 'group6');
        $('.entry-content').find('.gallery-columns-7').find('.gallery-icon > a').attr('data-fancybox', 'group7');
        $('.entry-content').find('.gallery-columns-8').find('.gallery-icon > a').attr('data-fancybox', 'group8');
        $('.entry-content').find('.gallery-columns-9').find('.gallery-icon > a').attr('data-fancybox', 'group9');

        $('.entry-content').find('.wp-block-gallery.columns-1').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group1');
        $('.entry-content').find('.wp-block-gallery.columns-2').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group2');
        $('.entry-content').find('.wp-block-gallery.columns-3').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group3');
        $('.entry-content').find('.wp-block-gallery.columns-4').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group4');
        $('.entry-content').find('.wp-block-gallery.columns-5').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group5');
        $('.entry-content').find('.wp-block-gallery.columns-6').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group6');
        $('.entry-content').find('.wp-block-gallery.columns-7').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group7');
        $('.entry-content').find('.wp-block-gallery.columns-8').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group8');
        $('.entry-content').find('.wp-block-gallery.columns-9').find('.li.blocks-gallery-item figure > a').attr('data-fancybox', 'group9');


        $("a[href$='.jpg'],a[href$='.jpeg'],a[href$='.png'],a[href$='.gif'],[data-fancybox]").attr("rel","gallery").fancybox({
            buttons: [
                "zoom",
                //"share",
                "slideShow",
                "fullScreen",
                //"download",
                // "thumbs",
                "close"
            ]
        });
    }
});