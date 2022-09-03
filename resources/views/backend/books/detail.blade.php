@extends('layouts.backend')
@section('content')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="/css/image-uploader.min.css">
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Cập nhật nông trại") }}</h1>
                <a href="{{ route('admin.book') }}" class="d-sm-inline-block btn btn-primary btn-add"><i
                            class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Cập nhật nông trại") }}</h5>
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
                    <form action="{{ route('admin.book.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($book->id))
                            <input type="hidden" name="id" value="{{ $book->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên nông trại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="name" type="text" placeholder="Tên nông trại" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ $book->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Địa chỉ<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="addr" type="text" placeholder="Địa chỉ" class="form-control @error('addr') is-invalid @enderror" required name="addr" value="{{ $book->addr }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Diện tích</label>
                                <div class="input-field col-sm-9">
                                    <input id="area" type="text" placeholder="Diện tích m2" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ $book->area }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Mô tả</label>
                                <div class="input-field col-sm-9">
                                    <textarea name="content" class="form-control" rows="6" cols="40">{{ $book->content }}</textarea>
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
                                <div class="col-sm-9 input-field">
                                    <input id="pic" type="text" placeholder="Người phụ trách" class="form-control @error('pic') is-invalid @enderror" required name="pic" value="{{ $book->pic }}" autofocus>
                                    <div class="invalid-feedback">{!! __("vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Điện thoại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="name" type="text" placeholder="Điện thoại" class="form-control @error('tel') is-invalid @enderror" required name="tel" value="{{ $book->tel }}" autofocus>
                                    <div class="invalid-feedback">{!! __("vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Trạng thái</label>
                                <div class="input-field col-sm-9">
                                    <select name="block" class="form-control">
                                        <option value="1" @if($book->public == 1) selected @endif>Đang hoạt động</option>
                                        <option value="0" @if($book->public == 0) selected @endif>Bị khóa</option>
                                    </select>

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
            @if(isset($book->image1) && $book->image1 != '')
                @php
                    $preloaded = 'preloaded: [';
                    for($i = 1; $i < 11; $i++){
                        $column = 'image'.$i;
                        if(isset($book->$column) && $book->$column != ''){
                            $preloaded .= "{id: $i, src: '/".$book->$column."'},";
                        }
                    }
                    $preloaded .= ' ]';
                @endphp
                $('.input-images').imageUploader({label:"Bấm vào đây để upload hình ảnh", {!! $preloaded  !!}});
            @else
                $('.input-images').imageUploader({label:"Bấm vào đây để upload hình ảnh"});
            @endif
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