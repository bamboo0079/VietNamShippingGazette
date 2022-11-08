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
        .invoice_info {
            display: none;
        }
    </style>
    <div class="main ts-contain cf right-sidebar">
        <div class="ts-row">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>{{ __("messages.CARD_INFO") }}</span></h1>
                <section class="block-wrap block-grid mb-none" data-id="8">
                    @if(Session::has('successMsg'))
                    <div class="block-content form-body-register">
                        {{ Session::get('successMsg') }}
                    </div>
                    @endif
                    @if(Session::has('errMsg'))
                    <div class="block-content form-body-register">
                        {{ Session::get('errMsg') }}
                    </div>
                    @endif
                </section>
                    <a href="/">
                        <input style="width: 150px !important; margin-top: 20px" name="bott" type="submit" id="regis-submit" class="submit" value="{{ __("messages.BACK_TO_HOME") }}">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {

            $('.invoice_export').on('click',function() {
                var inv_exp = $(this).val();
                if(inv_exp === '0') {
                    $('.invoice_info').fadeOut(500);
                } else {
                    $('.invoice_info').fadeIn(500);
                }
            });

            $('.close').on('click', function () {
                $(this).parent('.alert').hide();
            })
        })
    </script>
@stop