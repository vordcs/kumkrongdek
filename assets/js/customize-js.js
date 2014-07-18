$(document).ready(function() {
    $('.navbar .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(105);
    });
    $(window).scroll(function() {
        var pt_scroll = $(this).scrollTop() + 80;
        if (pt_scroll >= $('#mainContent').offset().top) {
            $('#scroll-top').removeClass('hidden');
            $('#scroll-top').fadeIn();
        } else {
//            $('#scroll-top').addClass('hidden');
            $('#scroll-top').fadeOut();
        }
    });
    $('#scroll-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });


    $("#owl-1").owlCarousel({
        items: 1, //1 items above 1000px browser width
        itemsDesktop: [1199, 1], //1 items between 1199px and 979px
        itemsDesktopSmall: [979, 1], // betweem 979px and 601px
        itemsTablet: [768, 1], //1 items between 768 and 0
        itemsMobile: false, // itemsMobile disabled - inherit from itemsTablet option

        lazyLoad: true,
        autoPlay: true,
        navigation: true,
        navigationText: ["", ""],
        rewindNav: true,
        scrollPerPage: true,
        //Pagination
        pagination: true,
        paginationNumbers: false,
    });
    $('body').scrollspy({
        target: '.bs-docs-sidebar',
        offset: 100
    });
});
$(document).on('click', '.navbar-collapse.in', function(e) {
    if ($(e.target).is('a')) {
        $(this).collapse('hide');
    }
});