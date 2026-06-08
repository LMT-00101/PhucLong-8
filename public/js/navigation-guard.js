(function($) {
    function appBase() {
        var base = $('base').attr('href') || window.APP_BASE_PATH || '/';
        return base.slice(-1) === '/' ? base : base + '/';
    }

    function normalizeAppUrl(href) {
        if (!href) return '';
        if (href.indexOf('index.php?url=') === 0) {
            return appBase() + href;
        }
        return href;
    }

    function hideInactiveOverlays() {
        $('.offcanvas-menu-overlay:not(.active)').css('pointer-events', 'none');
        $('.offcanvas-menu-overlay.active').css('pointer-events', 'auto');

        if ($('#minicart-overlay').is(':visible')) {
            $('#minicart-overlay').css('pointer-events', 'auto');
        } else {
            $('#minicart-overlay').css('pointer-events', 'none');
        }
    }

    $(hideInactiveOverlays);
    $(document).on('click', '.canvas__open, .offcanvas-menu-overlay, .offcanvas__close, #cart, #close-minicart, #minicart-overlay', function() {
        setTimeout(hideInactiveOverlays, 0);
    });

    $(document).on('click', 'a[href*="index.php?url=dang-nhap"], a[href*="index.php?url=gio-hang"], a[href*="index.php?url=thong-tin-tai-khoan"]', function(e) {
        var href = $(this).attr('href');
        if (!href || href === '#') return;

        setTimeout(function() {
            if (e.isDefaultPrevented && e.isDefaultPrevented()) {
                window.location.href = normalizeAppUrl(href);
            }
        }, 0);
    });
})(jQuery);
