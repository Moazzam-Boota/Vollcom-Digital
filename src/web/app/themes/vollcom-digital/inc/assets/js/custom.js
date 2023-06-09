jQuery( function ( $ ) {
    'use strict';

    // Sticky navbar
    var admin_menu_height = 0;
    if($("#wpadminbar").length && !$("body").hasClass("is-mobile")){
        admin_menu_height = $("#wpadminbar").height();
    }
    $(".navbar").sticky({
        zIndex: 100,
        stopper: "#footer",
        stickyClass: 'bg-nav-darkblue',
        topSpacing: admin_menu_height
    });

    // Initialize animations
    $( document ).ready(function() {
        new WOW().init();
        $( ".wow" ).addClass( "fadeInUp" );

        var topValue = 0;
        if($("#masthead")){
            topValue += $("#masthead").height();
        }
        topValue += admin_menu_height;
        $(".search-container").css({ top: topValue+'px' });
    });

    /* init Jarallax */
    jarallax(document.querySelectorAll('.jarallax'));

    jarallax(document.querySelectorAll('.jarallax-keep-img'), {
        keepImg: true,
    });

    $('.menu-item-type-search, .close-search-btn').click(function() {
        if($('#main-nav').hasClass('show')){
            $('#main-nav').click();
        }
        $('#searchOverlay .search-input').val("");
        $('#searchOverlay').toggleClass('open');
        $('#searchOverlay').toggleClass('d-none');
        if($('#searchOverlay').hasClass('open')){
            $('#searchOverlay .search-input').focus();
        }
        if($('#main-nav').hasClass('show')){
            $('#main-nav').removeClass('show');
            $('*[data-target="#main-nav"]').addClass("collapsed");
        }
    });

    $(document).click(function (e) {
        if ($("#searchOverlay").hasClass("open")) {
            if(!$('.search-container').is(e.target) && $(e.target).parents('.search-container').length < 1 && $(e.target).parents('.menu-item-type-search').length < 1){
                $("#searchOverlay").removeClass("open");
                $("#searchOverlay").addClass("d-none");
            }
        }

    });

    $('#search_select').on('change', function() {
        if($(this).parents('form').find('input[type=search]').val() != ''){
            $(this).parents('form').submit();
        }
    });

});
