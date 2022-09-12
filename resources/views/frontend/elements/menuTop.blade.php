<style>
    .modal{
        margin: 200px auto;
    }
    .spc-alp-loader.ts-spinner{
        display: none;
    }
    #hidden {
        display: none;
    }
    .menu-item:hover #hidden {
        display: block;
    }
    @media only screen and (max-width: 1175px) {
        #sl1, #sl2{
            display: none !important;
        }
    }
</style>

<div id="sl1" class="sl1" style="top: 195px; max-width:120px; position: fixed; left: 30px;z-index: 9999;">
    <a rel="nofollow" href="#" target="_blank">
        <img type=" max-width:120px; " border="0" alt="qc" src="/images/left_banner.jpg" >
    </a>
</div>

<div id="sl2" style="top: 195px; position: fixed; max-width:120px; right: 30px;z-index: 9999;">
    <a rel="nofollow" href="#" target="_blank">
        <img style=" max-width:120px; " border="0" alt="qc" src="/images/left_banner.jpg">
    </a>
</div>

<div class="off-canvas-backdrop"></div>
<div class="mobile-menu-container off-canvas s-dark" id="off-canvas">
    <div class="off-canvas-head">
        <a href="#" class="close"><i class="tsi tsi-times"></i></a>
        <div class="ts-logo">
            <img class="logo-mobile logo-image logo-image-dark" src="/src/asset/img/system/Capture.PNG" width="176"
                 height="35" alt="SmartMag ProMag"/>
            <img class="logo-mobile logo-image" src="/src/asset/img/system/Capture.PNG" width="88" height="18" alt="SmartMag ProMag"/>
        </div>
    </div>
    <div class="off-canvas-content">
        <ul class="mobile-menu"></ul>
    </div>
</div>
<div class="smart-head smart-head-a smart-head-main" id="smart-head" data-sticky="auto" data-sticky-type="smart"
     data-sticky-full>
    <div class="smart-head-row smart-head-top s-dark smart-head-row-full">
        <div class="inner wrap">
            <div class="items items-left ">

                <button class="offcanvas-toggle has-icon" type="button" aria-label="Menu">
                        <span class="hamburger-icon hamburger-icon-a">
                            <span class="inner"></span>
                        </span>
                </button>
                <div class="nav-wrap">
                    <nav class="navigation navigation-small nav-hov-a">
                        <ul id="menu-top-nav" class="menu">
                            @if(Session::has('member'))
                                <li id="menu-item-3534"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534">
                                    <a rel="noopener" href="{{ route('memberInfo') }}">{{ Session::get('member.name') }}</a>
                                    <ul id="hidden">
                                        <li><a href="{{ route('reset') }}">Đổi mật khẩu</a></li>
                                        <li><a href="{{ route('chaomua') }}">Quản lý tin</a></li>
                                    </ul>
                                </li>
                                <li id="menu-item-3534"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534">
                                    <a rel="noopener" href="{{ route('logout') }}">{{ __("messages.Logout") }}</a>
                                </li>
                            @else
                                <li id="menu-item-3534"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534">
                                    <a rel="noopener" href="{{ route('register') }}">{{ __("messages.Register") }}</a>
                                </li>
                                <li id="menu-item-3534"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534">
                                    <a rel="noopener" href="{{ route('login') }}">{{ __("messages.Login") }}</a>
                                </li>
                            @endif
                            @if(Session::get('locale') == 'vi')
                                <li id="menu-item-3534"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534">
                                    <a href="/language/en">English</a>
                                </li>
                            @else
                                <li id="menu-item-3534"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534">
                                    <a rel="noopener" href="/language/vi">Tiếng Việt</a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="items items-center empty">
            </div>
            {{--<div class="items items-right ">--}}
                {{--<a href="#" class="search-icon has-icon-only is-icon" title="Search">--}}
                    {{--<i class="tsi tsi-search"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
    </div>
    <div class="smart-head-row smart-head-mid is-light smart-head-row-full">
        <div class="inner wrap">
            <div class="items" style="padding-left: 20px; padding-top: 10px">
                <a href="/" title="SmartMag ProMag" rel="home" class="logo-link ts-logo logo-is-image">
                    <h1>
                        <img src="/src/asset/img/system/Capture.PNG" class="logo-image logo-image-dark"
                             alt="SmartMag ProMag"
                             srcset="/src/asset/img/system/Capture.PNG ,/src/asset/img/system/Capture.PNG 2x"
                             width="176" height="35"/>
                        <img src="/src/asset/img/system/logo1.jpg" class="logo-image" alt="SmartMag ProMag" srcset="/src/asset/img/system/Capture.PNG ,/src/asset/img/system/Capture.PNG 2x" width="176" height="35"/>
                    </h1>
                </a>
                <img style="margin-top: 7px;" border="0" alt="qc" src="/public/images/header_banner.jpg" >
            </div>
        </div>
    </div>
    <div class="smart-head-row smart-head-mid is-light smart-head-row-full">
        <div class="inner wrap">
            <div class="items ">
                <div class="nav-wrap">
                    <nav class="navigation navigation-main nav-hov-a">
                        <ul id="menu-main-menu" class="menu">
                            <li id="menu-item-573"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-6 current_page_item menu-item-573">
                                <a href="/" aria-current="page">{{ __("messages.HOME") }}</a>
                            </li>
                            <li id="menu-item-583"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('lich.tau') }}">{{ __("messages.BOAT_SCHEDULE") }}</a>
                            </li>
                            <li id="menu-item-4536"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4536">
                                <a href="#">{{ __("messages.NEWS") }}</a>
                                <ul class="sub-menu">
                                    @foreach($categories_menu as $menu)
                                        <li id="menu-item-4588"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4588">
                                            <a rel="noopener" href="{{ route('the.loai', $menu->id) }}">@if(Session::get('locale') == 'vi') {{ $menu->name_vn }} @else {{ $menu->name_en }} @endif</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li id="menu-item-4536"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4536">
                                <a href="#">{{ __("messages.TRADE") }}</a>
                                <ul class="sub-menu">
                                    @foreach($trades_menu as $menu)
                                        <li id="menu-item-4588"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4588">
                                            <a rel="noopener" href="{{ route('the.loai', $menu->id) }}">@if(Session::get('locale') == 'vi') {{ $menu->name_vn }} @else {{ $menu->name_en }} @endif</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li id="menu-item-4536"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4536">
                                <a href="#">{{ __("messages.PRODUCTS") }}</a>
                                <ul class="sub-menu">

                                    @foreach($product_categories_menu as $menu)
                                        <li id="menu-item-4588"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4588">
                                            <a rel="noopener" href="{{ route('loai.san.pham', $menu->id) }}">@if(Session::get('locale') == 'vi') {{ $menu->name_vn }} @else {{ $menu->name_en }} @endif</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li id="menu-item-583"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('the.loai', 1) }}">{{ __("messages.EVENTS") }}</a>
                            </li>
                            <li id="menu-item-583"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('the.loai', 2) }}">{{ __("messages.VSG_NEWS") }}</a>
                            </li>
                            <li id="menu-item-583"
                                     class="menu-item menu-item-type-custom menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('the.loai', 17) }}">{{ __("messages.RECRUITMENT") }}</a>
                            </li>
                            <li id="menu-item-583"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('contact') }}">{{ __("messages.CONTACT") }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="smart-head smart-head-a smart-head-mobile" id="smart-head-mobile" data-sticky="mid"
     data-sticky-type="smart" data-sticky-full>
    <div class="smart-head-row smart-head-mid smart-head-row-3 s-dark smart-head-row-full">
        <div class="inner wrap">
            <div class="items items-left ">
                <button class="offcanvas-toggle has-icon" type="button" aria-label="Menu">
                        <span class="hamburger-icon hamburger-icon-a">
                            <span class="inner"></span>
                        </span>
                </button>
            </div>
            <div class="items items-center ">
                <a href="" title="SmartMag ProMag" rel="home" class="logo-link ts-logo logo-is-image">
		            <span>
                        <img class="logo-mobile logo-image logo-image-dark" src="/src/asset/img/system/Capture.PNG" width="176" height="35" alt="SmartMag ProMag"/>
                        <img class="logo-mobile logo-image" src="/src/asset/img/system/logo1.jpg" width="88" height="18"  alt="SmartMag ProMag"/>
					</span>
                </a>
            </div>
            {{--<div class="items items-right ">--}}
                {{--<a href="#" class="search-icon has-icon-only is-icon" title="Search">--}}
                    {{--<i class="tsi tsi-search"></i>--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
    </div>
</div>