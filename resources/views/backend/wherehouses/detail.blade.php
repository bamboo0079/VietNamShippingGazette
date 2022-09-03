@extends('layouts.backend')
@section('content')
    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Cập nhật kho") }}</h1>
                <a href="{{ route('admin.wherehouse') }}" class="d-sm-inline-block btn btn-primary btn-add"><i
                            class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Nhập Xuất kho - {{ $book->name }}</h5>
                </div>
                <div class="card-body">
                    <p class="text-right"><a href="{{ route('admin.wherehouse.add.step', $book->id) }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> {{ __('Thêm mới') }}</a></p>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="80">
                                <col width="200">
                                <col width="180">
                                <col width="100">
                                <col>
                                <col width="150">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="text-center">{{ __('STT') }}</th>
                                <th class="text-left">{{ __('Nhập/Xuất') }}</th>
                                <th>{{ __('Người thực hiện') }}</th>
                                <th class="text-left">{{ __('Số lượng') }}</th>
                                <th class="text-left">{{ __('Ghi chú') }}</th>
                                <th class="text-right">{{ __('Ngày thực hiện') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($histories as $k => $history)
                                <tr>
                                <tr>
                                    <td class="text-center">{{ $k+1 }}</td>
                                    <td class="text-center">{!! ($history->is_input)?'Nhập kho':'Xuất kho' !!}</td>
                                    <td class="text-center">{!! $history->pic !!}</td>
                                    <td class="text-center">{!! $history->qty !!} {!! $book->unit !!}</td>
                                    <td>{!! $history->note !!}</td>
                                    <td class="text-center">{!! date("d-m-Y", strtotime($history->do_date)) !!}</td>
                                </tr>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Chưa có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Cập nhật kho") }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.wherehouse.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($book->id))
                            <input type="hidden" name="id" value="{{ $book->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên sản phẩm<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="name" type="text" placeholder="Tên sản phẩm" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ $book->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Số lượng<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input type="hidden" name="qty" value="{{ $book->qty }}">
                                    <input readonly class="form-control" name="qty2" value="{{ $book->qty }}" autofocus>
                                    <div class="invalid-feedback">{!! __("vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Đơn vị tính<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="unit" type="text" placeholder="Đơn vị tính" class="form-control @error('unit') is-invalid @enderror" required name="unit" value="{{ $book->unit }}" autofocus>
                                    <div class="invalid-feedback">{!! __("vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.wherehouse') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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