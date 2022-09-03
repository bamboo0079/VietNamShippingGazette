@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Cập nhật cánh đồng") }}</h1>
                <a href="{{ route('admin.chapter') }}" class="d-sm-inline-block btn btn-primary btn-add"><i
                            class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Cập nhật cánh đồng") }}</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger mt-0 mb-5">
                            @foreach ($errors->all() as $error)
                                @php
                                $error = str_replace('The email has already been taken.','このメールアドレスは既に登録されています。', $error);
                                $error = str_replace('The password must be at least 6 characters.','パスワードは6文字以上でお願いします。', $error);
                                $error = str_replace('The password confirmation does not match.','パスワードとパスワードの再入力が一致しません', $error);
                                @endphp
                                <span class="invalid-feedback display-block" role="alert">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('admin.chapter.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($chapter->id))
                            <input type="hidden" name="id" value="{{ $chapter->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nông trại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input type="hidden" name="book_id" value="{{ $chapter->book_id }}" />
                                    <select class="form-control @error('book_id') is-invalid @enderror" name="book_id_disable" disabled>
                                        <option disabled>{{ __("Nông trại") }}</option>
                                        @foreach($books as $book)
                                            <option @if($chapter->book_id == $book->id) selected @endif value="{{ $book->id }}">{{ $book->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên cánh đồng<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="name" type="text" placeholder="Tên cánh đồng" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ $chapter->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Diện tích<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="title" type="text" placeholder="Diện tích" class="form-control @error('title') is-invalid @enderror" required name="title" value="{{ $chapter->title }}">
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Trạng thái</label>
                                <div class="input-field col-sm-9">
                                    <select name="public" class="form-control">
                                        <option value="1" @if($chapter->public == 1) selected @endif>Đang hoạt động</option>
                                        <option value="0" @if($chapter->public == 0) selected @endif>Bị khóa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.chapter') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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