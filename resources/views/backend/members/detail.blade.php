@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Cập nhật người dùng") }}</h1>
                <a href="{{ route('admin.dashboard') }}" class="d-sm-inline-block btn btn-primary btn-add"><i
                            class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Cập nhật người dùng") }}</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                @php
                                $error = str_replace('The email has already been taken.','Email đã tồn tại', $error);
                                $error = str_replace('The password must be at least 6 characters.','Mật khẩu tối thiểu 6 ký tự', $error);
                                $error = str_replace('The password confirmation does not match.','Mật khẩu và xác nhận mật khẩu không chính xác', $error);
                                @endphp
                                <span class="invalid-feedback display-block" role="alert">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.member.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($user->id))
                            <input type="hidden" name="id" value="{{ $user->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Họ tên<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="name" type="text" placeholder="Họ tên" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ $user->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Email<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Điện thoại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="tel" type="tel" placeholder="Điện thoại" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ $user->tel }}" >
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Mật khẩu</label>
                                <div class="input-field col-sm-9">
                                    <input id="password" type="text" placeholder="Mật khẩu" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    <div class="invalid-feedback @error('password') d-none @enderror">{!! __("Vui lòng nhập mật khẩu") !!}</div>
                                    @error('password')
                                    <span id="message-password" class="invalid-feedback display-block" role="alert">
                                                {{ str_replace('The password must be at least 6 characters.','Mật khẩu tối thiểu 6 ký tự',str_replace('The password confirmation does not match.','Mật khẩu và xác nhận mật khẩu không chính xác',$message)) }}
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Trạng thái</label>
                                <div class="input-field col-sm-9">
                                    <select name="block" class="form-control">
                                        <option value="0" @if($user->active == 0) selected @endif>Chưa kích hoạt</option>
                                        <option value="1" @if($user->active == 1) selected @endif>Đang hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Phân cấp</label>
                                <div class="input-field col-sm-9">
                                    <select name="role" class="form-control">
                                        <option value="2" @if($user->role == 2) selected @endif>Admin</option>
                                        <option value="1" @if($user->role == 1) selected @endif>User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu</button>
                            <a href="{{ route('admin.member') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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