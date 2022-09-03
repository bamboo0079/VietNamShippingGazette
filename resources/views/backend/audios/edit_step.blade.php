@extends('layouts.backend')
@section('content')
    <style>
        li{
            list-style-type: none;
        }
        .ui-autocomplete {
            position: absolute;
            z-index: 1000;
            cursor: default;
            padding: 0;
            margin-top: 2px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .ui-autocomplete > li {
            padding: 3px 20px;
        }
        .ui-autocomplete > li.ui-state-focus {
            background-color: #DDD;
        }
        .ui-helper-hidden-accessible {
            display: none;
        }
    </style>
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Thêm công việc") }}</h1>
                <a href="{{ route('admin.audio.detail', $audio_id) }}" class="d-sm-inline-block btn btn-primary btn-add"><i class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Thêm công việc") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.audio.process.step') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        <input type="hidden" name="audio_id" value="{{ $audio_id }}" />
                        @if(isset($step->id) && $step->id)
                            <input type="hidden" name="id" value="{{ $step->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nông trại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select disabled class="form-control @error('book_id') is-invalid @enderror" name="book_id" id="book_id" required>
                                        <option disabled>{{ __("Nông trại") }}</option>
                                        @foreach($books as $book)
                                            <option value="{{ $book->id }}" @if($audio->book_id == $book->id) selected @endif>{{ $book->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Cánh đồng<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select disabled class="form-control @error('chapter_id') is-invalid @enderror" name="chapter_id" id="chapter_id" required>
                                        <option disabled>{{ __("Cánh đồng") }}</option>
                                        @foreach($chapters as $chapter)
                                            <option value="{{ $chapter->id }}" @if($audio->chapter_id == $chapter->id) selected @endif>{{ $chapter->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên sản phẩm<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input readonly id="name" type="text" placeholder="Tên sản phẩm" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ $audio->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Công việc<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="type_id" required>
                                        <option disabled>{{ __("Công việc") }}</option>
                                        @foreach($types as $type)
                                            <option @if(isset($step->type_id) && $step->type_id == $type->id) selected @endif value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nội dung<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="content" type="text" placeholder="Nội dung" class="form-control @error('content') is-invalid @enderror" required name="content" value="{{ isset($step->content)?$step->content:old('content') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-custom hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tình trạng sâu bệnh</label>
                                <div class="input-field col-sm-9">
                                    <input id="status" type="text" placeholder="Tình trạng sâu bệnh" class="form-control @error('status') is-invalid @enderror" name="status" value="{{ isset($step->status)?$step->status:old('status') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-custom hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Giải pháp</label>
                                <div class="input-field col-sm-9">
                                    <input id="summary" type="text" placeholder="Giải pháp" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ isset($step->summary)?$step->summary:old('summary') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-group-custom hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Kết quả</label>
                                <div class="input-field col-sm-9">
                                    <input id="result" type="text" placeholder="Kết quả" class="form-control @error('result') is-invalid @enderror" name="result" value="{{ isset($step->result)?$step->result:old('result') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Khối lượng/thể tích<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="quantity" type="text" placeholder="100kg / 100 ml ..." class="form-control @error('quantity') is-invalid @enderror" required name="quantity" value="{{ isset($step->quantity)?$step->quantity:old('quantity') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Diện tích<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="area" type="text" placeholder="25 m2 ..." class="form-control @error('area') is-invalid @enderror" required name="area" value="{{ isset($step->area)?$step->area:old('area') }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ngày thực hiện<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="area" type="date" placeholder="Ngày thực hiện" class="form-control @error('do_date') is-invalid @enderror" required name="do_date" value="{{ isset($step->do_date)?$step->do_date:date("Y-m-d") }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>

                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.audio.detail', $audio_id) }}" class="btn btn-light"><i class="fa fa-reply"></i> Hủy bỏ</a>
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

            $(document).on("change", "#type_id", function () {
                var _val = $(this).val();
                if(_val == 1 || _val == 4){
                    $("input#content").autocomplete({
                        source: [{!! $txt_phan_bon  !!}],
                        minLength: 0,
                    }).focus(function () {
                        $(this).autocomplete("search");
                    });
                }
                if(_val == 5){
                    $("input#content").autocomplete({
                        source: [{!! $txt_dung_dich  !!}],
                        minLength: 0,
                    }).focus(function () {
                        $(this).autocomplete("search");
                    });
                    $(".form-group-custom").removeClass('hidden');
                }else{
                    $(".form-group-custom").addClass('hidden');
                }
            });

            $("#type_id").trigger("change");
        });

    </script>
@stop