jQuery(function() {
    jQuery('#partner-carousel-multi  .carousel-item').each(function () {
        var next = jQuery(this).next();
        if (!next.length) {
            next = jQuery(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo(jQuery(this));

        for (var i = 0; i < 4; i++) {
            next = next.next();
            if (!next.length) {
                next = jQuery(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo(jQuery(this));
        }
    });
});
