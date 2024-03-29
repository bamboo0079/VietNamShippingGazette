<!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="{{ config('const.app_name') }}">
    <meta name="keywords" content="{{ config('const.app_name') }}" />
    <meta name="author" content="{{ config('const.app_name') }}">
    <title>{{ config('const.app_name') }}</title>
    <link rel="apple-touch-icon" sizes="32x32" href="/frontend/images/favicon.png" />
    <link rel="apple-touch-icon" sizes="64x64" href="/frontend/images/favicon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/frontend/images/favicon.png" />
    <link rel="icon" type="image/png" sizes="64x64" href="/frontend/images/favicon.png" />
    <!-- Custom fonts for this template-->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/admin.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>
<body id="page-top">
<div id="login-wrapper">
    <style>
        .btn-primary {
            color: #fff;
            background-color: #3a6a43;
            border-color: #3a6a43;
        }
    </style>
    <div id="content" class="flexbox flex-align-item">
        <div class="container-fluid">
            <div class="card shadow">
                <div class="card-body">
                    <div class="img-thumb"><img class="logo-login" src="/frontend/images/logo.png" /></div>
                    <form method="POST" action="{{ route('password.update') }}" novalidate class="needs-validation">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <div class="input-field">
                                <input placeholder="メールアドレス" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ str_replace(' ','+',$email) ?? str_replace(' ','+',old('email')) }}" required autocomplete="email" autofocus>
                                <div class="invalid-feedback @error('email') d-none @enderror">
                                    {!! __("メールアドレスをご入力ください。") !!}
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-field">
                                <input placeholder="パスワード" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div class="invalid-feedback @error('password') d-none @enderror">{!! __("入力してください。") !!}</div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ str_replace('The password must be at least 8 characters.','パスワードは8文字以上でお願いします。',str_replace('The password must be at least 6 characters.','パスワードは6文字以上でお願いします。',str_replace('The password confirmation does not match.','パスワードとパスワードの再入力が一致しません',$message))) }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-field">
                                <input placeholder="パスワードの再入力" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div class="invalid-feedback">{!! __("入力してください。") !!}</div>
                            </div>
                        </div>

                        <div class="buttons-set text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('再設定') }}
                                </button>
                        </div>
                        <p class="letter-spacing-7 text-center">
                            <a class="txt-forgot-pw link-underline"  href="{{ route('policy') }}">プライバシーポリシー</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="/backend/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="/backend/vendor/bootstrap/js/bootstrap-toggle.min.js"></script>
<script src="/backend/vendor/jquery/jquery-ui.min.js" type="text/javascript"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    $("#message-password").hide();
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    $("input:invalid").each(function (index) {
                        $(this).parent().next().addClass('display-block');
                    });
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    $(document).ready(function () {
        $('input#tel').keyup(function(event) {
            // skip for arrow keys
            if(event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function(index, value) {
                if(value.length > 11){
                    return value.substring(0, 11);
                }
                return value.replace(/\D/g, "");
            });
        });
    });

</script>
</body>
</html>

