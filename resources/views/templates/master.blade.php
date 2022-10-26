
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
{{--<script type="text/javascript" id="smartmag-theme-js" src="/public/js/88ec8fcb1e79b74a036e399f073c3276.js" defer></script>--}}
<script type="text/javascript" src="/public/js/delay-load.min.js"data-cfasync="false"></script>
<script src="/public/js/jquery-3.6.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="/public/css/jquery-ui.css">
<script src="/public/src/asset/js/frontend/jquery-3.6.0.min.js"></script>
<script src="/public/frontend/assets/js/jquery/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datetimepicker1" ).datepicker({dateFormat: 'dd/mm/yy'});
            $( "#datetimepicker2" ).datepicker({dateFormat: 'dd/mm/yy'});
        } );
    </script>

<link rel="stylesheet" href="/public/css/prism.css">
<link rel="stylesheet" href="/public/css/chosen.css">
<script src="/public/js/chosen.jquery.js" type="text/javascript"></script>
{{--<script src="https://harvesthq.github.io/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>--}}
<script src="/public/js/init.js" type="text/javascript" charset="utf-8"></script>

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
