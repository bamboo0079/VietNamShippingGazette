@php
    $footer_data = file_get_contents(public_path().'/config.json');
    $footer_data = json_decode($footer_data, true);
@endphp
<footer class="main-footer cols-gap-lg footer-bold s-dark">
    <div class="upper-footer bold-footer-upper">
        <div class="ts-contain wrap">
            <div class="widgets row cf">
                <div class="widget col-4 widget-about">
                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-b is-left has-style">
                        <h5 class="heading">About Us</h5></div>
                    <div class="inner ">
                        <div class="image-logo">
                            <img src="/src/asset/img/system/logo_footer.png" width="176" height="47" alt="About Us"
                                 srcset="/src/asset/img/system/logo_footer.png ,/src/asset/img/system/logo_footer.png 2x"/>
                        </div>
                        <div class="base-text about-text">{!! $footer_data['slogan']??'' !!}
                        </div>
                    </div>
                </div>

                <div class="widget col-4 widget_recent_comments">
                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-b is-left has-style">
                        <h5 class="heading">Address</h5></div>
                    <div id="recentcomments">
                        {!! $footer_data['address']??'' !!}
                    </div>
                </div>
                <div class="widget col-4 widget_recent_comments">
                    <div class="widget-title block-head block-head-ac block-head block-head-ac block-head-b is-left has-style">
                        <h5 class="heading">Contact</h5></div>
                    <div id="recentcomments">
                        {!! $footer_data['contact']??'' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<style>
    footer {
        background: #de333b !important;
        color: #fff !important;
    }
</style>
<script type="text/javascript" id="smartmag-lazyload-js-extra">
    /* <![CDATA[ */
    var BunyadLazy = {"type":"normal"};
    /* ]]> */
</script>