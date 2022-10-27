@extends('templates.master')
@section('content')

    <style type="text/css">
        .h2_title a {
            padding-top: 0px !important;
            line-height: 1.4em;
            word-break: break-word;
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            min-height: 2.8em;
            max-height: 2.8em;
            font-size: 0.78em;
            color: #333333 !important;
        }

        .product-media {
            height: auto;
        }

        .special-price {
            line-height: 10px;
            font-size: 14px !important;
            color: #C92127;
            font-weight: 600;
        }

        .price-title {
            color: #454d55;

        }

        .product-items {
            border: 2px solid #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            min-height: 300px;
        }

        .product-items:hover {
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            -ms-transition: all 1s ease;
            transition: all 1s ease;
            border: 2px solid #F1FD6D;
            border-radius: 5px;

        }
    </style>
    <div class="main ts-contain cf right-sidebar">
        <div class="elementor-element elementor-element-3d4c96b elementor-widget elementor-widget-smartmag-grid">
            <div class="elementor-widget-container">

                <h1 class="archive-heading"><span>{{ __("messages.PRODUCT_LIST") }}</span></h1>
                <section class="block-wrap block-grid block-sc s-dark" data-id="12">
                    <div class="block-content">
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
                        <div class="loop loop-grid loop-grid-base grid grid-4 md:grid-4 xs:grid-1">
                            @forelse($news as $new)
                                <article class="l-post grid-base-post grid-post product-items">
                                    <div class="media product-media" style="height: 240px;">
                                        <a href="{{ route('product.detail', $new->id) }}"
                                           title="@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif">
                                            <img class="media-img" style="height: 240px" src="{{ $new->img }}">
                                        </a>
                                    </div>
                                    <div class="elementor-widget-container">

                                        <div class="post-meta post-meta-a has-below">
                                            <h2 class="h2_title">
                                                <a href="{{ route('product.detail', $new->id) }}">@if(Session::get('locale') == 'vi') {{ $new->title_vn }} @else {{ $new->title_en }} @endif</a>
                                            </h2>
                                            <div class="post-meta-items meta-below">
                                            <span class="meta-item date">
                                                <span class="date-link">
                                                    <time class="post-date"
                                                          datetime="{{ $new->created_at }}">{{ $new->created_at }}</time>
                                                </span>
                                            </span>
                                            </div>
                                            <p class="special-price">
                                                <span class="price-title">{{ __("messages.PRICE") }}: </span>
                                                <span class="price">{{ $new->price }}</span>
            </p>
                                            <p class="special-price">
                                                <span data-bs-toggle="modal" data-bs-target="#buyModal{{$new->id}}"
                                                      class="price-title btn btm-primary">Đặt mua</span>
                                                <div id="buyModal{{$new->id}}"
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
                                                                           value="{{ $new->id }}">
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
        </div>

    </div>
    </article>
    @empty

        <p>{{ __("messages.PRODUCT_UPDATING") }}</p>

        @endforelse

        </div>
        {{ $news->appends($_GET)->links('paginations.admin') }}
        </div>
        </section>
        </div>

        </div>
        </div>

@stop