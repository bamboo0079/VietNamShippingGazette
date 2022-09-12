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
    </style>
    <div class="main ts-contain cf right-sidebar">
        <div class="ts-row">
            <div class="col-8 main-content">
                <h1 class="archive-heading"><span>{{ __("messages.CHANGE_INFO") }}</span></h1>
                <section class="block-wrap block-grid mb-none" data-id="8">
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
                                {{ Session::get('successMsg') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif
                        <form class="register-form" action="" method="post">
                            @csrf
                            <div id="respond" class="comment-respond">
                                <p class="form-field comment-form-author">
                                    <input name="name" type="text" placeholder="{{ __("messages.FULL_NAME") }} *" value="{{ $name }}" size="100" maxlength="100" required="required">
                                </p>
                                <p class="form-field comment-form-email">
                                    <input name="email" type="text" placeholder="{{ __("messages.EMAIL") }} *" value="{{ $email }}" size="100" maxlength="100" required="required" disabled>
                                </p>
                                <p class="form-field comment-form-url">
                                    <input name="phone" type="text" placeholder="{{ __("messages.PHONE_NUMBER") }} *" value="{{ $phone }}" size="11" maxlength="11" required="required">
                                </p>
                                <p class="form-submit">
                                    {{--<input name="submit" type="submit" id="regis-submit" class="submit" value="{{ __("messages.UPDATE") }}">--}}
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                                        </svg>
                                        {{ __("messages.UPDATE") }}
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            @include("templates.members.memberManagement")
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            $('.close').on('click', function () {
                $(this).parent('.alert').hide();
            })
        })
    </script>
@stop