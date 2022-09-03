@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{--{{ __("Thêm tin tức") }}--}}</h1>
                <a href="{{ route('admin.recruit.news') }}" class="d-sm-inline-block btn btn-primary btn-add"><i class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Thêm tin tức tuyển dụng") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.recruit.new.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($book->id))
                            <input type="hidden" name="id" value="{{ $book->id }}" />
                        @endif
                        <div class="form-group hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Danh mục<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select id="category_id" name="category_id" class="form-control">
                                        <option value="0">Danh mục</option>
                                        @foreach($categories as $category)
                                            <option @if($category->id == 17) selected @endif value="{{ $category->id }}">{{ $category->name_vn }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Sản phẩm<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select id="product_category_id" name="product_category_id" class="form-control">
                                        <option value="0">Sản phẩm</option>
                                        @foreach($productcategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_vn }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tiêu đề tiếng việt<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="title_vn" type="text" placeholder="Tiêu đề tiếng việt" class="input-space form-control @error('title_vn') is-invalid @enderror" required name="title_vn" value="{{ old('title_vn') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tiêu đề tiếng anh<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="title_en" type="text" placeholder="Tiêu đề tiếng anh" class="input-space form-control @error('title_vn') is-invalid @enderror" required name="title_en" value="{{ old('title_en') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nội dung tiếng việt<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <textarea id="content_vn" rows="6" name="content_vn" placeholder="Nội dung tiếng việt" class="summernote input-space form-control" @error('content_vn') is-invalid @enderror requried>{{ old('content_vn') }}</textarea>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nội dung tiếng anh<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <textarea id="content_en" rows="6" name="content_en" placeholder="Nội dung tiếng anh" class="summernote input-space form-control" @error('content_en') is-invalid @enderror requried>{{ old('content_en') }}</textarea>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Đường dẫn youtube</label>
                                <div class="input-field col-sm-9">
                                    <input id="youtube_url" type="text" placeholder="Đường dẫn youtube" class="input-space form-control @error('youtube_url') is-invalid @enderror" name="youtube_url" value="{{ old('youtube_url') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Hình ảnh</label>
                                <div class="input-field col-sm-9">
                                    <input type="file" name="img" id="file" class="form-control" onchange="previewFile(this);" />
                                    <img id="previewImg" src="https://upload.wikimedia.org/wikipedia/commons/c/ca/1x1.png" alt="Placeholder">
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Loại tin</label>
                                <div class="input-field col-sm-9">
                                    <input type="checkbox" id="is_hot" name="is_hot" value="1">
                                    <label for="is_hot"> Tin nóng</label><br />
                                    <input type="checkbox" id="is_new" name="is_new" value="1">
                                    <label for="is_new"> Tin mới</label><br />
                                    <input type="checkbox" id="is_paid" name="is_paid" value="1">
                                    <label for="is_paid"> Tin được tài trợ</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Trạng thái</label>
                                <div class="input-field col-sm-9">
                                    <select name="approved" class="form-control">
                                        <option value="0">Chờ duyệt</option>
                                        <option value="1" selected>Xuất bản</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.recruit.news') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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
        $(document).ready(function () {
            $('.summernote').summernote({
                disableDragAndDrop: true,
                height: 300,
                callbacks: {
                    onImageUpload: function(files, welEditable) {
                        var editor = $(this);
                        sendFile(files[0], editor, welEditable);
                    }
                }/*,
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