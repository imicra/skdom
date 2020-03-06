jQuery(document).ready(function($) {
    'use strict';
    if($(window).width() > 768){

        $(window).stellar({
            horizontalScrolling: false,
            verticalOffset: 0,
            horizontalOffset: 0,
            responsive: true,
            hideDistantElements: true
        });

    }
});