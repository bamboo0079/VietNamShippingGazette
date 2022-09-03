if (typeof Scripts == "undefined") {
    var Scripts = {};
}

Scripts.Scripts = {
    winWidthModule: $(window).width(),init: function () {}
};

Scripts.Modules = {
    winWidth: $(window).width(),
    scrollTop: $(window).scrollTop(),
    init: function() {
        /* Define Scrollbar */
        const container = document.querySelectorAll('.scrollWrapper');

        for(let i = 0; i < container.length; i++){
            new PerfectScrollbar(container[i], {
                suppressScrollX: true
            });
        }

        this.createMenu();
    },
    createMenu: function() {
        if ($('header .btn-navbar').length > 0) {
            let event = "click";

            if($('html').hasClass('mobile')) {
                event = 'touchstart';
            }

            $(document).on(event, ".btn-navbar", function() {
                if ($('html').hasClass('nav-open')) {
                    $('html').removeClass('nav-open');
                } else {
                    setTimeout(function () {
                        $('html').addClass('nav-open');
                    }, 100);
                }
            });
        }
    }
};

$(document).ready(function () {
    Scripts.Modules.winWidth = $(window).width();
    Scripts.Modules.init();

    // Click outSite hide Element
    $(document).mouseup(function (e) {
        if(!$(e.target).closest('.btn-navbar').length && !$(e.target).closest('.menuSidebar').length){
            $('html').removeClass('nav-open');
        }
    });

    $(document).on('click', '.book-list .skipLink', function() {
        var self = $(this);

        self.parents('.book-list').find('.skipLink').removeClass('active');
        self.addClass('active');
    });
});

var windowResize_w;

$(window).resize(function () {
    var winNewWidth = $(window).width();

    if (Scripts.Modules.winWidth != winNewWidth) {
        clearTimeout(windowResize_w);
        windowResize_w = setTimeout(function() {
            Scripts.Modules.winWidth = winNewWidth;
        }, 200);
    }
});