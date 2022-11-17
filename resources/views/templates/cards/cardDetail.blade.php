@extends('templates.master')
@section('content')
    <style type="text/css">
        .comment-respond {
            margin-bottom: 30px;
            background: var(--c-contrast-50);
            padding: 35px 30px;
            padding-bottom:15px;
        }
        input, textarea, select {
            border: 1px solid var(--c-contrast-150);
            padding: 7px 12px;
            outline: 0;
            height: auto;
            font-size: 14px;
            color: var(--c-contrast-500);
            max-width: 100%;
            border-radius: 2px;
            box-shadow: 0 2px 7px -4px rgb(0 0 0 / 10%);
            background: var(--c-input-bg,var(--c-contrast-0));
        }
        .register-form input {
            width: 350px;
        }
        #regis-submit {
            width: 70px !important;
        }
        .close:focus, .close:hover {
            color: #000;
            text-decoration: none;
            opacity: .75;
        }
        .alert-dismissible .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.75rem 1.25rem;
            color: inherit;
        }
        button.close {
            margin-top: -8px !important;
            padding: 0;
            background-color: transparent;
            border: 0;
            -webkit-appearance: none;
        }
        .close {
            float: right;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
            color: #000;
            text-shadow: 0 1px 0 #fff;
            opacity: .5;
        }
        /*.invoice_info {*/
            /*display: none;*/
        /*}*/
        .removed{
            -webkit-appearance: none;
            padding: var(--btn-pad, 0 17px);
            font-family: var(--ui-font);
            font-size: var(--btn-f-size, 12px);
            font-weight: var(--btn-f-weight, 600);
            line-height: var(--btn-l-height, var(--btn-height));
            height: var(--btn-height);
            letter-spacing: .03em;
            text-transform: uppercase;
            text-align: center;
            box-shadow: var(--btn-shadow);
            transition: .25s ease-in-out;
            background: var(--c-main);
            color: #fff;
            border: 0;
            border-radius: 2px;
        }
        .removed:hover {
            background: var(--c-main) !important;
        }
    </style>
    @php
        $footer_data = file_get_contents(public_path().'/config.json');
        $footer_data = json_decode($footer_data, true);
    @endphp
    <div class="main ts-contain cf right-sidebar">
        <form class="register-form" action="{{ route('register.card') }}" method="post">
            <div class="ts-row">
            <div class="col-5">
                <h1 class="archive-heading"><span>{{ __("messages.CARD_INFO") }}</span> {{ Session::flash('invoice_export') }}</h1>
                <section class="block-wrap block-grid mb-none">
                    <div class="block-content form-body-register">
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
                                {{ Session::get('successMsg') }} <a href="{{ route('login') }}" class="alert-link">{{ __("messages.HERE") }}</a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                            <div class="alert alert-success success_remove_card" role="alert" style="display: none">
                                {{ __("messages.SUCCESS_REMOVE_CARD") }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            @csrf
                            <div id="respond" class="comment-respond">
                                <p class="form-field comment-form-author">
                                    <input name="name" type="text" placeholder="{{ __("messages.FULL_NAME") }} *" value="@if(Session::has('name')) {{ Session::get('name') }} @endif" size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-author">
                                    <input name="company" type="text" placeholder="{{ __("messages.COMPANY") }} *" value="@if(Session::has('company')) {{ Session::get('company') }} @endif" size="150" maxlength="150" required="required">
                                </p>
                                <p class="form-field comment-form-author">
                                    <span>{{ __("messages.INVOICE_EXPORT") }}</span>
                                    <input class="invoice_export" style="width: 20px" type="radio" name="invoice_export" value="0" @if(!Session::has('invoice_export') || Session::get('invoice_export') == 0) {{ "checked" }} @endif> {{ __("messages.NO") }}
                                    <input class="invoice_export" style="width: 20px" type="radio" name="invoice_export" value="1" @if(Session::has('invoice_export') && Session::get('invoice_export') == 1) {{ "checked" }} @endif> {{ __("messages.YES") }}
                                </p>
                                <div class="invoice_info" @if(Session::has('invoice_export') && Session::get('invoice_export') == 1)  style="display: block"  @else style="display: none"  @endif >
                                    <p class="form-field comment-form-author">
                                        <input name="tax_no" type="text" placeholder="{{ __("messages.TAX_NO") }} *" value="@if(Session::has('tax_no')) {{ Session::get('tax_no') }} @endif" size="100" maxlength="100">
                                    </p>
                                    <p class="form-field comment-form-author">
                                        <input name="invoice_address" type="text" placeholder="{{ __("messages.INVOICE_ADDRESS") }} *" value="@if(Session::has('invoice_address')) {{ Session::get('invoice_address') }} @endif" size="100" maxlength="100">
                                    </p>
                                </div>
                                <p class="form-field comment-form-author">
                                    <input name="product_address" type="text" placeholder="{{ __("messages.PRODUCT_ADDRESS") }} *" value="@if(Session::has('product_address')) {{ Session::get('product_address') }} @endif" size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-author">
                                    <input name="tel" type="text" placeholder="{{ __("messages.TEL") }}" value="@if(Session::has('tel')) {{ Session::get('tel') }} @endif" size="100" maxlength="100">
                                </p>
                                <p class="form-field comment-form-author">
                                    <input name="mobile" type="text" placeholder="{{ __("messages.PHONE") }} *" value="@if(Session::has('mobile')) {{ Session::get('mobile') }} @endif" size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-author">
                                    <input name="fax" type="text" placeholder="{{ __("messages.FAX") }} " value="@if(Session::has('fax')) {{ Session::get('fax') }} @endif" size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-author">
                                    <input name="email" type="email" placeholder="{{ __("messages.Email") }} *" value="@if(Session::has('email')) {{ Session::get('email') }} @endif" size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-author">
                                    <textarea placeholder="{{ __("messages.NOTE") }}" class="input-group" style="height: 100px; width: 90%" name="note">@if(Session::has('note')) {{ Session::get('note') }} @endif</textarea>
                                </p>
                                <p class="form-field comment-form-author">
                                    <span>{{ __("messages.PAY_MENT") }}</span>
                                    <input class="payment" style="width: 20px" type="radio" name="payment" value="0" @if(!Session::has('payment') || Session::get('payment') == 0) {{ "checked" }} @endif> {{ __("messages.PAY_DIRECLY") }}
                                    <input class="payment" style="width: 20px" type="radio" name="payment" value="1" @if(Session::has('payment') && Session::get('payment') == 1) {{ "checked" }} @endif> {{ __("messages.PAY_BANKER") }}
                                </p>
                                <div class="form-field comment-form-author payment_method_div" style="margin-bottom:30px; line-height: 29px; @if(Session::has('payment') && Session::get('payment') == 1) {{'display: block' }} @else {{'display: none'}}@endif">
                                    <h4 style="line-height: 40px">{{ __("messages.CARD_TRANSFER_INFO") }}</h4>
                                    {!! $footer_data['bank']??'' !!}
                                </div>
                                <p class="form-submit">
                                    <input name="submit" type="submit" id="regis-submit" class="submit" value="{{ __("messages.CONFIRM_ADD") }}">
                                    <input  style="width: 145px !important; background: black;" name="submit" type="button" class="removed" value="{{ __("messages.REMOVE_CARD") }}">
                                </p>
                            </div>

                    </div>
                </section>
            </div>
            <style type="text/css">
                table {
                    border-collapse: collapse;
                    text-indent: initial;
                    border-spacing: 2px;
                }
                tr {
                    display: table-row;
                    vertical-align: inherit;
                    border-color: inherit;
                }
                .table-bordered td, .table-bordered th {
                    border: 1px solid #dee2e6;
                }
                .table td, .table th {
                    padding: 0.75rem;
                    vertical-align: top;
                    border-top: 1px solid #dee2e6;
                }
                td {
                    display: table-cell;
                    vertical-align: inherit;
                    line-height: 43px;
                }

            </style>
            <div class="col-7">
                <h1 class="archive-heading"><span>{{ __("messages.CARD_INFO") }}</span> {{ Session::flash('invoice_export') }}</h1>
                <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">{{ __("messages.PRODUCT_NAME") }}</th>
                                <th scope="col">{{ __("messages.PRODUCT_QT") }}</th>
                                <th scope="col" colspan="2">{{ __("messages.PRODUCT_PRICE") }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cards as $card)
                            <tr class="card_items">
                                <td>
                                    <a href="{{ route('product.detail', $card['id']) }}">
                                        {!! \App\Helpers\Helper::limitCharacters( $card['product_name_vn'] , 30) !!}
                                    </a>
                                    <input type="hidden" name="prd_name[]" value="{{ $card['product_name_vn'] }}">
                                </td>
                                <td>
                                    <input style=" width: 80px" class="qt" type="number" step="1" name="qt[]" value="{{ $card['qt'] }}" id="theNumber" min="1" max="400" />
                                    <input class="prd_id" name="id[]" type="hidden" value="{{ $card['id'] }}">
                                    <input class="qt_org" type="hidden" name="qt_org" value="{{ $card['qt'] }}">
                                </td>
                                <td>

                                    @if(is_numeric($card['price']))
                                        {{ number_format($card['price']) }}₫
                                    @else
                                        {{ $card['price'] }}
                                    @endif
                                    <input class="prd_price" type="hidden" name="price[]" value="{{ $card['price'] }}">
                                </td>
                                <td width="15%">
                                    <button type="button" class="btn btn-danger delete_card" product_id_item="{{ $card['id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                        </svg>
                                        {{ __("messages.PRODUCT_DELETE") }}
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="1"> {{ __("messages.PRODUCT_TOTAL_PRICE") }}:</td>
                                <td colspan="3">
                                    <strong class="total_count">
                                        <?php
                                            $cards_total = str_replace(',','',$cards_total);
                                        ?>
                                        @if(is_numeric($cards_total))
                                            {{ number_format($cards_total) }}₫
                                        @else
                                            {{ $cards_total }}
                                        @endif
                                    </strong>
                                    <input class="card_total" type="hidden" name="card_total" value="{{ $cards_total }}">
                                </td>
                            </tr>
                            </tbody>
                        </table>
            </div>
        </div>
        </form>
    </div>

    <script type="text/javascript">
        function steponup() {
            let input = document.getElementById('theNumber')
            let val = document.getElementById('incrementor').value

            if (val) {  /* increment with a parameter */
                input.stepUp(val)
            } else {    /* or without a parameter. Try it with 0 */
                input.stepUp()
            }
        }
        $(function () {

            $(".qt").on("mouseleave", function () {

                var arr_data = [];
                var check_changed = false;
                var i = 0;

                $('.card_items').each(function() {

                    var new_qt = $(this).find('.qt').val();
                    var new_old = $(this).find('.qt_org').val();

                    var prd_id = $(this).find('.prd_id').val();
                    var prices = $(this).find('.prd_price').val();

                    arr_data.push({ prd_id:prd_id,qt:new_qt,price:prices});
                    arr_data[i]['qt'] = new_qt;

                    if(new_qt != new_old) {
                        check_changed = true;
                    }
                    i++;
                });


                if(check_changed == true) {

                    let route = "{{ route('updateCard') }}";
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                        },
                        url: route,
                        type: 'POST',
                        data: {data:arr_data},
                        success: function(response) {
                            $('.total_count').html(response.total);
                            $('.card_total').val(response.total);
                            $('.product_total').val(response.total_qt);
                            $('.nb_prd').html('(' + response.total_qt + ' sản phẩm)');
                        },
                        error: function(xhr) {
                            $("#err_card").fadeTo(2000, 500).slideUp(500, function(){
                                $("#err_card").slideUp(500);
                            });
                        }
                    });
                }
            });

            $(".delete_card").on('click',function() {

                var arr_data = [];
                $('.card_items').each(function() {
                    var new_qt = $(this).find('.qt').val();
                    var prd_id = $(this).find('.prd_id').val();
                    var prices = $(this).find('.prd_price').val();
                    arr_data.push({ prd_id:prd_id,qt:new_qt,price:prices});
                });
                if(arr_data.length == 0) {
                    window.location.href('/');
                }

                $(this).parents('tr.card_items').remove();
                var prd_id = $(this).attr('product_id_item');
                let route = "{{ route('deleteCard') }}";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    url: route,
                    type: 'POST',
                    data: {arr_data:arr_data, remove_id:prd_id},
                    success: function (response) {
                        $('.total_count').html(response.total);
                        $('.card_total').val(response.total);
                        $('.product_total').val(response.total_qt);
                        $('.nb_prd').html('(' + response.total_qt + ' sản phẩm)');
                        if($('.card_items').length == 0) {
                            location.reload(true);
                        }
                    }
                });

            });

            $('.invoice_export').on('click',function() {
               var inv_exp = $(this).val();
               if(inv_exp === '0') {
                   $('.invoice_info').fadeOut(500);
               } else {
                   $('.invoice_info').fadeIn(500);
               }
            });

            $('.payment').on('click',function() {
                var payment = $(this).val();
                if(payment === '0') {
                    $('.payment_method_div').fadeOut(500);
                } else {
                    $('.payment_method_div').fadeIn(500);
                }
            });

            $('.close').on('click', function () {
                $(this).parent('.alert').hide();
            });
            $(".removed").on("click", function() {

                let route = "{{ route('removeCard') }}";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}",
                    },
                    url: route,
                    type: 'POST',
                    success: function (response) {
                        $(".success_remove_card").fadeTo(2000, 500).slideUp(500, function () {
                            window.location.href = "/";
                        });
                    }
                });
            });
        })
    </script>
@stop