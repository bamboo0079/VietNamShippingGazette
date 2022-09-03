@extends('layouts.backend')
@section('content')
    <div id="content" class="flexbox flex-align-item">
        <div class="container-fluid">
            <div class="card shadow">
                {{--<div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __("ログイン") }}</h6>
                </div>--}}
                <div class="card-body">
                    <div class="img-thumb"><img class="logo-login" src="/src/asset/img/system/Capture.PNG" /></div>
                    <form action="{{ route('admin.login.post') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        <div class="form-group">
                            <div class="input-field">
                                <input type="hidden" name="admin_login" value="1">
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div class="invalid-feedback @error('email') d-none @enderror">
                                    {!! __("Vui lòng nhập") !!}
                                </div>
                                @error('email')
                                <span class="invalid-feedback is-invalid" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-field">
                                <input id="password" type="password" placeholder="Mật khẩu" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End -->
        </div>
    </div>
@stop
@section('post-js')
    @parent
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
@stop