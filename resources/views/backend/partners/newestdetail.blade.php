@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{--{{ __("Ấn phẩm mới nhất") }}--}}</h1>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Ấn phẩm mới nhất") }}</h5>
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($book->id))
                            <input type="hidden" name="id" value="{{ $book->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tiêu đề<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="name" type="text" placeholder="Tiêu đề" class="input-space form-control @error('name') is-invalid @enderror" required name="name" value="{{ $book->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Đường link</label>
                                <div class="input-field col-sm-9">
                                    <input id="link" type="text" placeholder="Đường link" class="input-space form-control @error('link') is-invalid @enderror" name="link" value="{{ $book->link }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Hình ảnh</label>
                                <div class="input-field col-sm-9">
                                    <input type="file" name="img" id="file" class="form-control" onchange="previewFile(this);" />
                                    <img id="previewImg" src="@if($book->img) {{ $book->img }} @else https://upload.wikimedia.org/wikipedia/commons/c/ca/1x1.png @endif" alt="Placeholder">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ẩn/Hiện</label>
                                <div class="input-field col-sm-9">
                                    <select name="is_show" class="form-control">
                                        <option value="1" @if($book->is_show == 1) selected @endif>Hiển thị</option>
                                        <option value="0" @if($book->is_show == 0) selected @endif>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <button type="reset" class="btn btn-light mr-2"> Hủy bỏ</button>
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
    <link href="{{ asset('summernote/summernote.min.css') }}" rel="stylesheet">
    <script src="{{ asset('summernote/summernote.min.js')}}"></script>
    <script>
        function previewFile(input){
            var file = $("#file").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
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
            $(document).on("change", "#type", function () {
                if($(this).val() == 1){
                    $(".input-process").addClass('hidden');
                    $(".self-process").removeClass('hidden');
                }else{
                    $(".input-process").removeClass('hidden');
                    $(".input-space").val(' ');
                    $(".self-process").addClass('hidden');
                }
            });
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