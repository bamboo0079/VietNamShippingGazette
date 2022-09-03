@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Cập nhật phân bón") }}</h1>
                <a href="{{ route('admin.comment') }}" class="d-sm-inline-block btn btn-primary btn-add"><i
                            class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Cập nhật phân bón") }}</h5>
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
                    <form action="{{ route('admin.comment.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($book->id))
                            <input type="hidden" name="id" value="{{ $book->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Loại phân bón<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select id="type" name="type" class="form-control">
                                        <option @if($book->type == 1) selected @endif value="1">Tự sản xuất</option>
                                        <option @if($book->type == 2) selected @endif value="2">Phân nhập</option>
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên phân bón<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="name" type="text" placeholder="Tên phân bón" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ $book->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nguyên vật liệu<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="material" type="text" placeholder="Nguyên vật liệu" class="input-space form-control @error('material') is-invalid @enderror" required name="material" value="{{ $book->material }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Quá trình sản xuất<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <textarea id="process" rows="6" name="process" placeholder="Quá trình sản xuất" class="input-space form-control" @error('process') is-invalid @enderror required>{{ $book->process }}</textarea>
{{--                                    <input id="process" type="text" placeholder="Quá trình sản xuất" class="input-space form-control @error('process') is-invalid @enderror" required name="process" value="{{ $book->process }}" autofocus>--}}
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Số lượng</label>
                                <div class="input-field col-sm-9">
                                    <input id="quantity_2" type="text" placeholder="Số lượng" class="form-control @error('quantity_2') is-invalid @enderror" name="quantity_2" value="{{ $book->quantity }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ngày sản xuất</label>
                                <div class="input-field col-sm-9">
                                    <input id="do_date_2" type="date" placeholder="Ngày sản xuất" class="form-control @error('do_date_2') is-invalid @enderror" name="do_date_2" value="{{ ($book->do_date)?$book->do_date:date("Y-m-d") }}" />
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ngày hoàn thành<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="finish_date" type="date" placeholder="Ngày hoàn thành" class="form-control @error('finish_date') is-invalid @enderror" required name="finish_date" value="{{ ($book->finish_date)?$book->finish_date:date("Y-m-d") }}" />
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group self-process">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Hạn sử dụng<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input id="exp_date" type="date" placeholder="Hạn sử dụng" class="form-control @error('exp_date') is-invalid @enderror" required name="exp_date" value="{{ ($book->exp_date)?$book->exp_date:date("Y-m-d") }}" />
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Đơn vị nhập</label>
                                <div class="input-field col-sm-9">
                                    <input id="factory" type="text" placeholder="Đơn vị nhập" class="form-control @error('factory') is-invalid @enderror" name="factory" value="{{ $book->factory }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Giấy tờ kiểm nghiệm</label>
                                <div class="input-field col-sm-9">
                                    <input type="file" name="certificate" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Số lượng nhập</label>
                                <div class="input-field col-sm-9">
                                    <input id="quantity" type="text" placeholder="Số lượng nhập" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $book->quantity?$book->quantity:0 }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ngày sản xuất</label>
                                <div class="input-field col-sm-9">
                                    <input id="do_date" type="date" placeholder="Ngày sản xuất" class="form-control @error('do_date') is-invalid @enderror" name="do_date" value="{{ ($book->do_date)?$book->do_date:date("Y-m-d") }}" />
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group input-process hidden">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Hạn sử dụng</label>
                                <div class="input-field col-sm-9">
                                    <input id="exp_date_2" type="date" placeholder="Hạn sử dụng" class="form-control @error('exp_date_2') is-invalid @enderror" name="exp_date_2" value="{{ ($book->exp_date)?$book->exp_date:date("Y-m-d") }}" />
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Trạng thái</label>
                                <div class="input-field col-sm-9">
                                    <select name="block" class="form-control">
                                        <option value="1" @if($book->public == 1) selected @endif>Đang sử dụng</option>
                                        <option value="0" @if($book->public == 0) selected @endif>Ngưng sử dụng</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.comment') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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
            if($("#type").val() == 1){
                $(".input-process").addClass('hidden');
                $(".self-process").removeClass('hidden');
            }else{
                $(".input-process").removeClass('hidden');
                $(".input-space").val(' ');
                $(".self-process").addClass('hidden');
            }
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