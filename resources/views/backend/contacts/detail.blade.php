@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary"></h1>
                <a href="{{ route('admin.contacts') }}" class="d-sm-inline-block btn btn-primary btn-add"><i class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Chi tiết liên hệ") }}</h5>
                </div>
                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($book->id))
                            <input type="hidden" name="id" value="{{ $book->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input readonly id="name" type="text" placeholder="Tên" class="input-space form-control @error('name') is-invalid @enderror" required name="name" value="{{ $book->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Email</label>
                                <div class="input-field col-sm-9">
                                    <input readonly id="zalo" type="text" placeholder="Email" class="input-space form-control @error('zalo') is-invalid @enderror" name="zalo" value="{{ $book->email }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Điện thoại</label>
                                <div class="input-field col-sm-9">
                                    <input readonly id="skype" type="text" placeholder="Điện thoại" class="input-space form-control @error('skype') is-invalid @enderror" name="skype" value="{{ $book->phone }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tiêu đề</label>
                                <div class="input-field col-sm-9">
                                    <input readonly id="skype" type="text" placeholder="Tiêu đề" class="input-space form-control @error('skype') is-invalid @enderror" name="skype" value="{{ $book->title }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nội dung</label>
                                <div class="input-field col-sm-9">
                                    <textarea readonly class="form-control" rows="6">{!! $book->content !!}</textarea>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
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