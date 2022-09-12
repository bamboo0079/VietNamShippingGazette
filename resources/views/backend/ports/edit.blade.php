@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary"></h1>
                <a href="{{ route('admin.ports') }}" class="d-sm-inline-block btn btn-primary btn-add"><i class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Cảng") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.port.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($category->id))
                            <input type="hidden" name="id" value="{{ $category->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Quốc gia<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select id="country_id" name="country_id" class="form-control">
                                        @foreach($countries as $country)
                                            <option @if(isset($category->country_id) && $category->country_id == $country->id) selected @endif value="{{ $country->id }}">{{ $country->country_nm_vn }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên cảng tiếng việt<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="port_nm_vn" type="text" placeholder="Tên cảng tiếng việt" class="form-control @error('port_nm_vn') is-invalid @enderror" required name="port_nm_vn" value="{{ (isset($category->port_nm_vn))?$category->port_nm_vn:old('port_nm_vn') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên tàu tiếng anh<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="port_nm_en" type="text" placeholder="Tên tàu tiếng anh" class="form-control @error('port_nm_en') is-invalid @enderror" required name="port_nm_en" value="{{ (isset($category->port_nm_en))?$category->port_nm_en:old('port_nm_en') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.ports') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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