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
            $('#scroll-top').fadeOut();

        }
    });
    $('#scroll-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
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