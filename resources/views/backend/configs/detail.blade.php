@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{--{{ __("Cập Nhật Tin Tức") }}--}}</h1>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Cấu hình chung</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update.config') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf

                        <div class="form-group input-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Banner</label>
                                <div class="input-field col-sm-9">
                                    <input id="file" type="file" name="img1" class="form-control" onchange="previewFile(this);" />
                                    <img id="previewImg" src="@if(isset($img1)) {{ $img1 }} @else https://upload.wikimedia.org/wikipedia/commons/c/ca/1x1.png @endif?v={{ time() }}" alt="Placeholder">
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Quảng cáo trái</label>
                                <div class="input-field col-sm-9">
                                    <input id="file2" type="file" name="img2" class="form-control" onchange="previewFile2(this);" />
                                    <img id="previewImg2" src="@if(isset($img2)) {{ $img2 }} @else https://upload.wikimedia.org/wikipedia/commons/c/ca/1x1.png @endif?v={{ time() }}" alt="Placeholder">
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Quảng cáo phải</label>
                                <div class="input-field col-sm-9">
                                    <input id="file3" type="file" name="img3" class="form-control" onchange="previewFile3(this);" />
                                    <img id="previewImg3" src="@if(isset($img3)) {{ $img3 }} @else https://upload.wikimedia.org/wikipedia/commons/c/ca/1x1.png @endif?v={{ time() }}" alt="Placeholder">
                                </div>
                            </div>
                        </div>

                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Slogan<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <textarea id="slogan" rows="6" name="slogan" placeholder="Slogan" class="summernote input-space form-control" @error('slogan') is-invalid @enderror required>{!! isset($slogan)?$slogan:'' !!}</textarea>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Địa chỉ<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <textarea id="address" rows="6" name="address" placeholder="Địa chỉ" class="summernote input-space form-control" @error('address') is-invalid @enderror required>{!! isset($address)?$address:'' !!}</textarea>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Liên hệ<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <textarea id="contact" rows="6" name="contact" placeholder="Địa chỉ" class="summernote input-space form-control" @error('contact') is-invalid @enderror required>{!! isset($contact)?$contact:'' !!}</textarea>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
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
        function previewFile2(input){
            var file = $("#file2").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg2").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
        function previewFile3(input){
            var file = $("#file3").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg3").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
        $(document).ready(function () {
            $('.summernote').summernote({
                disableDragAndDrop: true,
                height: 300,
                callbacks: {
                    onImageUpload: function(files, welEditable) {
                        var editor = $(this);
                        sendFile(files[0], editor, welEditable);
                    }
                }
                /*,
                emptyPara: '',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'image', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]*/
            });
            function sendFile(file, editor, welEditable) {
                data = new FormData();
                data.append("img", file);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "/admin/upload-file",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(url) {
                        editor.summernote('insertImage', url);
                    }
                });
            }
        });
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
            $(document).on("change", "#approved", function () {
                if($(this).val() == 2){
                    $("#reject_reason").removeClass('hidden');
                }else{
                    $("#reject_reason").addClass('hidden');
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