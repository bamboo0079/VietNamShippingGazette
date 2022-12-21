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
    @media only screen and (max-width: 1419px) {
        #sl1, #sl2{
            display: none !important;
        }
    }
</style>

<div id="sl1" class="sl1" style="top: 195px; max-width:120px; position: fixed; left: 30px;z-index: 9999;">
    <a rel="nofollow" href="#" target="_blank">
        <img type=" max-width:120px; " border="0" alt="qc" src="/images/left_banner.jpg?v={{time()}}" >
    </a>
</div>

<div id="sl2" style="top: 195px; position: fixed; max-width:120px; right: 30px;z-index: 9999;">
    <a rel="nofollow" href="#" target="_blank">
        <img style=" max-width:120px; " border="0" alt="qc" src="/images/right_banner.jpg?v={{time()}}">
    </a>
</div>

<div class="off-canvas-backdrop"></div>
<div class="mobile-menu-container off-canvas s-dark" id="off-canvas">
    <div class="off-canvas-head">
        <a href="#" class="close"><i class="tsi tsi-times"></i></a>
        <div class="ts-logo">
            <img class="logo-mobile logo-image logo-image-dark" src="/src/asset/img/system/LOGO_VSG__white.png" width="176"
                 height="35" alt="Viet Nam Shippinggazette"/>
            <img class="logo-mobile logo-image" src="/src/asset/img/system/LOGO_VSG__white.png" alt="Viet Nam Shippinggazette" width="88" height="18"/>
        </div>
    </div>
    <div class="off-canvas-content">
        <ul class="mobile-menu">
            <li id="menu-item-573" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home  @if(isset($menu_active) && $menu_active == 'index') current-menu-item @endif page_item page-item-6 current_page_item menu-item-573">
                <a href="/" aria-current="page">{{ __("messages.HOME") }}</a>
            </li>
            <li id="menu-item-4536" class="menu-item @if(isset($menu_active) && $menu_active == 'news') current-menu-item @endif  menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4536">
                <a href="{{ route('the.loai', 0) }}">{{ __("messages.NEWS") }}</a>
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
                class="menu-item menu-item-type-custom @if(isset($menu_active) &&  $menu_active == 'gt') current-menu-item @endif menu-item-object-custom menu-item-has-children menu-item-4536">
                <a href="{{ route('the.loai', 345) }}">{{ __("messages.TRADE") }}</a>
                <ul class="sub-menu">
                    @foreach($trades_menu as $menu)
                        <li id="menu-item-4588"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4588">
                            <a rel="noopener" href="{{ route('the.loai', $menu->id) }}">@if(Session::get('locale') == 'vi') {{ $menu->name_vn }} @else {{ $menu->name_en }} @endif</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li id="menu-item-583"
                class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'event') current-menu-item @endif  menu-item-object-custom menu-item-583">
                <a rel="noopener" href="{{ route('the.loai', 1) }}">{{ __("messages.EVENTS") }}</a>
            </li>
            <li id="menu-item-583"
                class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'svg') current-menu-item @endif menu-item-object-custom menu-item-583">
                <a rel="noopener" href="{{ route('tin.svg') }}">{{ __("messages.VSG_NEWS") }}</a>
            </li>
            <li id="menu-item-583" class="menu-item @if(isset($menu_active) &&  $menu_active == 'schedule') current-menu-item @endif menu-item-type-custom menu-item-object-custom menu-item-583">
                <a rel="noopener" href="{{ route('lich.tau') }}">{{ __("messages.BOAT_SCHEDULE") }}</a>
            </li>
            <li id="menu-item-583" class="menu-item @if(isset($menu_active) &&  $menu_active == 'doi_tac') current-menu-item @endif menu-item-type-custom menu-item-object-custom menu-item-583">
                <a rel="noopener" href="{{ route('doi.tac') }}">{{ __("messages.DOI_TAC") }}</a>
            </li>
            <li id="menu-item-4536" class="menu-item  @if(isset($menu_active) && $menu_active == 'product') current-menu-item @endif menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4536">
                <a href="{{ route('loai.san.pham', 0) }}">{{ __("messages.PRODUCTS") }}</a>
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
                class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'rec') current-menu-item @endif menu-item-object-custom menu-item-583">
                <a rel="noopener" href="{{ route('tuyen.dung', 17) }}">{{ __("messages.RECRUITMENT") }}</a>
            </li>
            <li id="menu-item-583"
                class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'contact') current-menu-item @endif menu-item-object-custom menu-item-583">
                <a rel="noopener" href="{{ route('contact') }}">{{ __("messages.CONTACT") }}</a>
            </li>

            @if(Session::has('member'))
                <li id="menu-item-3534"
                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534">
                    <a rel="noopener" href="{{ route('memberInfo') }}">{{ Session::get('member.name') }}</a>
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
            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534" style="list-style-type: none; ">
                <a class="link-a" href="/card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                    {{ __("messages.CARD") }}<span class="nb_prd">@if(Session::has('product_total')) {{ ' ('.Session::get('product_total') .' '. __("messages.PRODUCTS_NUMBER").')' }} @endif </span>
                    <input class="product_total" type="hidden" name="product_total" value="@if(Session::has('product_total')) {{ Session::get('product_total') }} @else {{ 0 }} @endif">
                </a>
            </li>
        </ul>
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

            <style type="text/css">
                .link-a:hover {
                    color: #95999c;
                }
            </style>
            <div class="items items-center empty"> </div>
            <div class="items items-right ">
                <div class="spc-social-block spc-social spc-social-a smart-head-social">
                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3534" style="list-style-type: none; ">
                        <a class="link-a" href="/card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                            </svg>
                            {{ __("messages.CARD") }}<span class="nb_prd">@if(Session::has('product_total')) {{ ' ('.Session::get('product_total') .' '. __("messages.PRODUCTS_NUMBER").')' }} @endif </span>
                            <input class="product_total" type="hidden" name="product_total" value="@if(Session::has('product_total')) {{ Session::get('product_total') }} @else {{ 0 }} @endif">
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </div>
    <div class="smart-head-row smart-head-mid is-light smart-head-row-full">
        <div class="inner wrap">
            <div class="items" style="padding-left: 20px; padding-top: 10px">
                <a href="/" title="Viet Nam Shipping Gazete" rel="home" class="logo-link ts-logo logo-is-image">
                    <h1>
                        <img src="/src/asset/img/system/logo_vietnamshippinggazette.png" class="logo-image logo-image-dark"
                             alt="Viet Nam Shipping Gazete"
                             srcset="/src/asset/img/system/logo_vietnamshippinggazette.png ,/src/asset/img/system/logo_vietnamshippinggazette.png 2x"
                             width="250" height="35"/>
                        <img src="/src/asset/img/system/logo1.jpg" class="logo-image" alt="Viet Nam Shipping Gazete" srcset="/src/asset/img/system/logo_vietnamshippinggazette.png ,/src/asset/img/system/logo_vietnamshippinggazette.png 2x" width="250" height="35"/>
                    </h1>
                </a>
                <img style="margin-top: 7px;height: 91px;margin-top: 15px;" border="0" alt="qc" src="/public/images/header_banner.jpg?v={{time()}}" >
            </div>
        </div>
    </div>
    <div class="smart-head-row smart-head-mid is-light smart-head-row-full">
        <div class="inner wrap">
            <div class="items ">
                <div class="nav-wrap">
                    <nav class="navigation navigation-main nav-hov-a">
                        <ul id="menu-main-menu" class="menu">
                            <li id="menu-item-573" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home  @if(isset($menu_active) && $menu_active == 'index') current-menu-item @endif page_item page-item-6 current_page_item menu-item-573">
                                <a href="/" aria-current="page">{{ __("messages.HOME") }}</a>
                            </li>
                            <li id="menu-item-4536" class="menu-item @if(isset($menu_active) && $menu_active == 'news') current-menu-item @endif  menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4536">
                                <a href="{{ route('the.loai', 0) }}">{{ __("messages.NEWS") }}</a>
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
                                class="menu-item menu-item-type-custom @if(isset($menu_active) &&  $menu_active == 'gt') current-menu-item @endif menu-item-object-custom menu-item-has-children menu-item-4536">
                                <a href="{{ route('the.loai', 345) }}">{{ __("messages.TRADE") }}</a>
                                <ul class="sub-menu">
                                    @foreach($trades_menu as $menu)
                                        <li id="menu-item-4588"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-4588">
                                            <a rel="noopener" href="{{ route('the.loai', $menu->id) }}">@if(Session::get('locale') == 'vi') {{ $menu->name_vn }} @else {{ $menu->name_en }} @endif</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li id="menu-item-583"
                                class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'event') current-menu-item @endif  menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('the.loai', 1) }}">{{ __("messages.EVENTS") }}</a>
                            </li>
                            <li id="menu-item-583"
                                class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'svg') current-menu-item @endif menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('tin.svg') }}">{{ __("messages.VSG_NEWS") }}</a>
                            </li>
                            <li id="menu-item-583" class="menu-item @if(isset($menu_active) &&  $menu_active == 'schedule') current-menu-item @endif menu-item-type-custom menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('lich.tau') }}">{{ __("messages.BOAT_SCHEDULE") }}</a>
                            </li>
                            <li id="menu-item-583" class="menu-item @if(isset($menu_active) &&  $menu_active == 'doi_tac') current-menu-item @endif menu-item-type-custom menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('doi.tac') }}">{{ __("messages.DOI_TAC") }}</a>
                            </li>
                            <li id="menu-item-4536" class="menu-item  @if(isset($menu_active) && $menu_active == 'product') current-menu-item @endif menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-4536">
                                <a href="{{ route('loai.san.pham', 0) }}">{{ __("messages.PRODUCTS") }}</a>
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
                                     class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'rec') current-menu-item @endif menu-item-object-custom menu-item-583">
                                <a rel="noopener" href="{{ route('tuyen.dung', 17) }}">{{ __("messages.RECRUITMENT") }}</a>
                            </li>
                            <li id="menu-item-583"
                                class="menu-item menu-item-type-custom @if(isset($menu_active) && $menu_active == 'contact') current-menu-item @endif menu-item-object-custom menu-item-583">
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
                <a href="/" rel="home" class="logo-link ts-logo logo-is-image">
		            <span>
                        <img class="logo-mobile logo-image logo-image-dark" src="/src/asset/img/system/LOGO_VSG__white.png" width="176" height="35" alt="Viet Nam Shippinggazette"/>
                        <img class="logo-mobile logo-image" src="/src/asset/img/system/LOGO_VSG__white.png" width="88" height="18"  alt="Viet Nam Shippinggazette"/>
					</span>
                </a>
            </div>
        </div>
    </div>
</div>