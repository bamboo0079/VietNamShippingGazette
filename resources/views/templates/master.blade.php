
<html>
<head>
    <title>VIET NAM SHIPPING GAZETTE - @yield('title')</title>
    @include('templates.common.headerTags')

</head>
<body class="home page-template page-template-page-templates page-template-no-wrapper page-template-page-templatesno-wrapper-php page page-id-6 no-sidebar has-lb has-lb-sm layout-normal elementor-default elementor-kit-802 elementor-page elementor-page-6">
    <style type="text/css">
        .color-header {
            color: #de333b;
        }
        .btn {
            --bs-btn-padding-x: 0.65rem;
            --bs-btn-padding-y: 0px !important;
        }
    </style>
    <div class="main-wrap">
        @include('templates.common.menuTop')
        <div class="main-full" style="transform: none; margin-top: 25px; min-height: 1200px">
            @yield('content')
        </div>
        @include('templates.common.footer')
    </div><!-- .main-wrap -->
<script type="text/javascript" id="smartmag-lazyload-js" src="/public/js/92961980b7d92c5290db4bd840c1fd4a.js"></script>
<script type="text/javascript" id="magnific-popup-js" src="/public/js/89ef949d5066fcc7ea828e9ca3102897.js" defer></script>
<script type="text/javascript" id="theia-sticky-sidebar-js" src="/public/js/2df812bc5bf337961f74a4f732a85e32.js" defer></script>
<script type="text/javascript" id="smartmag-theme-js" src="/public/js/88ec8fcb1e79b74a036e399f073c3276.js" defer></script>
<script type="text/javascript" src="/public/js/delay-load.min.js"data-cfasync="false"></script>
<script src="/public/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $(".modal-video").on('hide.bs.modal', function(){
            $("iframe").attr('src', '');
        });

        $(document).on("click", "button.close", function(){
            $(".modal-video").modal('hide');
            $("iframe").attr('src', '');
        });
        $(".modal-video").on('show.bs.modal', function(){
            $("iframe").attr('src', $(this).attr('data-youtube-url'));
        });
    });
</script>
    <script src="/js/table2csv.min.js"></script>
    <script>
        $(document).ready(function () {

            $(document).on("click", "#dl", function () {
                $("#schedule-table").table2csv({
                    filename:'schedule.csv'
                });
            });

        });
    </script>
</body>
</html>
