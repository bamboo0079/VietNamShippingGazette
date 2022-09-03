@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Nhập/Xuất kho") }} - {{ $wherehouse->name }}</h1>
                <a href="{{ route('admin.wherehouse.detail', $product_id) }}" class="d-sm-inline-block btn btn-primary btn-add"><i class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Nhập/Xuất kho") }} - {{ $wherehouse->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.wherehouse.process.step') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product_id }}" />
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nhập/Xuất kho<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select class="form-control @error('is_input') is-invalid @enderror" name="is_input" id="is_input" required>
                                        <option disabled>{{ __("Nhập/Xuất kho") }}</option>
                                        <option value="1">Nhập kho</option>
                                        <option value="0">Xuất kho</option>
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Người thực hiện<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="pic" type="text" placeholder="Người thực hiện" class="form-control @error('pic') is-invalid @enderror" required name="pic" value="" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Số lượng<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="qty" type="text" placeholder="Số lượng" class="form-control @error('qty') is-invalid @enderror" required name="qty" value="" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ghi chú</label>
                                <div class="input-field col-sm-9">
                                    <input id="note" type="text" placeholder="Ghi chú ..." class="form-control @error('note') is-invalid @enderror" name="note" value="{{ old('note') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ngày thực hiện<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="area" type="date" placeholder="Ngày thực hiện" class="form-control @error('do_date') is-invalid @enderror" required name="do_date" value="{{ date("Y-m-d") }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.wherehouse.detail', $product_id) }}" class="btn btn-light"><i class="fa fa-reply"></i> Hủy bỏ</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End -->
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="alertModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    {{--<button type="button" class="close" data-dismiss="modal"><span class="fa fa-times"></span></button>--}}
                    <div class="modal_body_inner">
{{--                        <h3 class="margin-bt-25 text-center">{{ config('const.app_name') }}</h3>--}}
                        <p>利用中の音声が削除されますがよろしいでしょうか？</p>
                        <div class="buttons-set text-center">
                            <button type="button" class="btn btn-primary btn-sm min-w120" data-dismiss="modal"><i class="fa fa-save"></i> はい</button>
                            <button type="button" onclick="$('#file').val('')" class="btn btn-light btn-sm min-w120" data-dismiss="modal"><i class="fa fa-reply"></i> いいえ</button>
                        </div>
                    </div>
                </div>
            </div>
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
            $(document).on('change',"#file",function(){
                if($("#chapter_id option:selected").hasClass('has-audio')){
                    $('#alertModal').modal('show');
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
            var val = $("#book_id").val();
            $.get("{{ route('ajax.chapter.book') }}/"+val, function(data, status){
                $("#chapter_id").html(data);
                console.log("Data: " + data + "\nStatus: " + status);
            });

            $(document).on("change", "#book_id", function () {
                var val = $(this).val();
                $.get("{{ route('ajax.chapter.book') }}/"+val, function(data, status){
                    $("#chapter_id").html(data);
                    console.log("Data: " + data + "\nStatus: " + status);
                });
            });
        });

    </script>
@stop