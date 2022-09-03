@extends('layouts.backend')
@section('content')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="/css/image-uploader.min.css">
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Thêm nông trại") }}</h1>
                <a href="{{ route('admin.book') }}" class="d-sm-inline-block btn btn-primary btn-add"><i class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Thêm nông trại") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.book.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($book->id))
                            <input type="hidden" name="id" value="{{ $book->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên nông trại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="name" type="text" placeholder="Tên nông trại" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ old('name') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Địa chỉ<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="addr" type="text" placeholder="Địa chỉ" class="form-control @error('addr') is-invalid @enderror" required name="addr" value="{{ old('addr') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Diện tích</label>
                                <div class="input-field col-sm-9">
                                    <input id="area" type="text" placeholder="Diện tích m2" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Mô tả</label>
                                <div class="input-field col-sm-9">
                                    <textarea name="content" class="form-control" rows="6" cols="40"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Hình ảnh / giấy tờ kiểm nghiệm</label>
                                <div class="col-sm-9 input-field">
                                    <div class="input-images"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Người phụ trách<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="pic" type="text" placeholder="Người phụ trách" class="form-control @error('pic') is-invalid @enderror" required name="pic" value="{{ old('pic') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Điện thoại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="tel" type="text" placeholder="Điện thoại" class="form-control @error('tel') is-invalid @enderror" required name="tel" value="{{ old('tel') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.book') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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
    <script type="text/javascript" src="/js/image-uploader.min.js"></script>
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
            $('.input-images').imageUploader({label:"Bấm vào đây để upload hình ảnh"});
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