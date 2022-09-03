@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("利用規約") }}</h1>
                <a href="{{ route('admin.dashboard') }}" class="d-sm-inline-block btn btn-primary btn-add"><i
                            class="fas fa-angle-left"></i> 戻る</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("利用規約") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.how.to.use') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        <div class="form-group">
                            <div class="input-field">
                                @csrf
                                <textarea name="content" rows="20" id="summernote" class="form-control">{!! isset($setting->content)?$setting->content:'' !!}</textarea>
                                <div class="invalid-feedback">{!! __("入力してください。") !!}</div>
                            </div>
                        </div>

                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> 保存</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light"><i class="fa fa-reply"></i>キャンセル</a>
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
    <!-- include summernote css/js -->
    <link href="/backend/css/summernote.min.css" rel="stylesheet">
    <script src="/backend/js/summernote.min.js"></script>
    <script src="/backend/js/summernote-ja-JP.js"></script>
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
            $('#summernote').summernote({
                lang: 'ja-JP',
                height: 500
            });
        });

    </script>
@stop