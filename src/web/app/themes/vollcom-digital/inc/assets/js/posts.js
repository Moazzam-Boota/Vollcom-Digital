jQuery( function ( $ ) {
    'use strict';

    // Desktop only
    var mediaQuery = window.matchMedia('(min-width: 992px)');
    if (mediaQuery.matches) {
        // Sticky social sharing
        $(".meta-widget").sticky({
            topSpacing: 90,
            zIndex: 30,
            stopper: "#related_articles",
            minWidth: 992,
            stickyClass: 'sticky-top mt-3',
        });
        // Sticky table of content
        $("#toc").sticky({
            topSpacing: 90,
            zIndex: 30,
            stopper: "#related_articles",
            minWidth: 992,
            stickyClass: 'sticky-top mt-3',
        });
    }
});