@extends('templates.master')
@section('content')
    <style type="text/css">
        .preview {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column; }
        @media screen and (max-width: 996px) {
            .preview {
                margin-bottom: 20px; } }

        .preview-pic {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1; }

        .preview-thumbnail.nav-tabs {
            border: none;
            margin-top: 15px; }
        .preview-thumbnail.nav-tabs li {
            width: 18%;
            margin-right: 2.5%; }
        .preview-thumbnail.nav-tabs li img {
            max-width: 100%;
            display: block; }
        .preview-thumbnail.nav-tabs li a {
            padding: 0;
            margin: 0; }
        .preview-thumbnail.nav-tabs li:last-of-type {
            margin-right: 0; }

        .tab-content {
            overflow: hidden; }
        .tab-content img {
            width: 100%;
            -webkit-animation-name: opacity;
            animation-name: opacity;
            -webkit-animation-duration: .3s;
            animation-duration: .3s; }

        .card {
            margin-top: 50px;
            padding: 1.5em;
            line-height: 1.5em;
            margin-bottom: 50px;
        }

        @media screen and (min-width: 997px) {
            .wrapper {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex; } }

        .details {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -webkit-flex-direction: column;
            -ms-flex-direction: column;
            flex-direction: column; }

        .colors {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1; }

        .product-title, .price, .sizes, .colors {
            text-transform: UPPERCASE;
            font-weight: bold; }

        .checked, .price span {
            color: #ff9f1a; }

        .product-title, .rating, .product-description, .price, .vote, .sizes {
            margin-bottom: 15px; }

        .product-title {
            margin-top: 0; }

        .size {
            margin-right: 10px; }
        .size:first-of-type {
            margin-left: 40px; }

        .color {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            height: 2em;
            width: 2em;
            border-radius: 2px; }
        .color:first-of-type {
            margin-left: 20px; }

        .add-to-cart, .like {
            background: #ff9f1a;
            padding: 1.2em 1.5em;
            border: none;
            text-transform: UPPERCASE;
            font-weight: bold;
            color: #fff;
            -webkit-transition: background .3s ease;
            transition: background .3s ease; }
        .add-to-cart:hover, .like:hover {
            background: #b36800;
            color: #fff; }

        .not-available {
            text-align: center;
            line-height: 2em; }
        .not-available:before {
            font-family: fontawesome;
            content: "\f00d";
            color: #fff; }

        .orange {
            background: #ff9f1a; }

        .green {
            background: #85ad00; }

        .blue {
            background: #0076ad; }

        .tooltip-inner {
            padding: 1.3em; }

        @-webkit-keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3); }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1); } }

        @keyframes opacity {
            0% {
                opacity: 0;
                -webkit-transform: scale(3);
                transform: scale(3); }
            100% {
                opacity: 1;
                -webkit-transform: scale(1);
                transform: scale(1); } }
    </style>
    <div class="main ts-contain cf right-sidebar" data-title="Viet Nam Shipping Gazette" data-url="http://www.vietnamshippinggazette.com/" style="transform: none;">
        <div class="ts-row" style="transform: none;">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>  {{ __("messages.PRODUCT_DETAIL_TITLE") }} </span></h1>
                <div class="card">
                    @if(Session::has('errMsg') && ! Session::has('successMsg'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('errMsg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if(Session::has('successMsg'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('successMsg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <div class="container-fliud">
                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <img src="{{ $news->img }}" />
                            </div>
                            <div class="details col-md-6">
                                <h3 class="product-title">@if(Session::get('locale') == 'vi') {{ $news->title_vn }} @else {{ $news->title_en }} @endif</h3>
                                <h4 class="price">{{ __("messages.PRICE") }}: <span>{{ $news->price }}</span></h4>
                                <p class="special-price">
                                                <span data-bs-toggle="modal" data-bs-target="#buyModal{{$news->id}}"
                                                      class="price-title btn btm-primary">Đặt mua</span>
                                    <div id="buyModal{{$news->id}}"
                                         class="modal fade modal-video bd-example-modal-lg"
                                         style="color: #000000;margin:0 auto;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"><h2 style="color: #000;">Đặt mua
                                                        sản phẩm</h2>
                                                    <button style="background: #fff;color: #000;font-size: 20px;font-weight: bold;text-align: right;"
                                                            type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="register-form"
                                                          action="{{ route('buy.process') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                               value="{{ $news->id }}">
                                                        <div id="respond" class="comment-respond">
                                <p class="form-field comment-form-author">
                                    <input name="name" type="text"
                                           placeholder="{{ __("messages.FULL_NAME") }} *"
                                           value="@if(Session::has('name')) {{ Session::get('name') }} @endif"
                                           size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-email">
                                    <input name="email" type="text"
                                           placeholder="{{ __("messages.EMAIL") }} *"
                                           value="@if(Session::has('email')) {{ Session::get('email') }} @endif"
                                           size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-url">
                                    <input name="phone" type="text"
                                           placeholder="{{ __("messages.PHONE_NUMBER") }} *"
                                           value="@if(Session::has('phone')) {{ Session::get('phone') }} @endif"
                                           size="100" maxlength="11" required="required">
                                </p>
                                <p class="form-field comment-form-url">
                                    <input name="company" type="text"
                                           placeholder="{{ __("messages.COMPANY_NAME") }} *"
                                           value="@if(Session::has('company')) {{ Session::get('company') }} @endif"
                                           size="255" required="required">
                                </p>
                                <p class="form-field comment-form-url">
                                <div style="width: 90px;float:left;">Xuất hóa đơn</div>
                                <div style="width: 50%;float:left;">
                                    <input type="radio" checked id="export_order_yes" name="export_order"
                                           value="1">
                                    <label for="export_order_yes">Có</label>
                                    <input type="radio" id="export_order" name="export_order" value="0">
                                    <label for="export_order">Không</label>
                                </div>
                                <div style="clear:both"></div>
                                </p>
                                <p class="form-field comment-form-url">
                                    <input name="company_tax" type="text"
                                           placeholder="{{ __("messages.COMPANY_TAX") }} *"
                                           value="@if(Session::has('company_tax')) {{ Session::get('company_tax') }} @endif"
                                           size="255" required="required">
                                </p>
                                <p class="form-field comment-form-url">
                                    <input name="company_tax_address" type="text"
                                           placeholder="{{ __("messages.COMPANY_TAX_ADDRESS") }} *"
                                           value="@if(Session::has('company_tax_address')) {{ Session::get('company_tax_address') }} @endif"
                                           size="255" required="required">
                                </p>
                                <p class="form-field comment-form-url">
                                    <input name="address" type="text"
                                           placeholder="{{ __("messages.ADDRESS_RECEIVED") }} *"
                                           value="@if(Session::has('address')) {{ Session::get('address') }} @endif"
                                           size="255" required="required">
                                </p>
                                <p class="form-submit">
                                    <button type="submit" class="btn btn-primary submit_button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-chat-right-dots"
                                             viewBox="0 0 16 16">
                                            <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"></path>
                                            <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"></path>
                                        </svg>
                                        {{ __("messages.BUY") }}
                                    </button>
                                </p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </p>
                                <p class="vote">
                                    @if(Session::get('locale') == 'vi') {!! $news->content_vn !!} @else {!! $news->content_en !!} @endif
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('templates.products.rightBarProduct')
        </div>

    </div>

@stop

