@extends('layouts.backend')
@section('content')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="/css/image-uploader.min.css">

    <div id="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("Cập nhật sản phẩm") }}</h1>
                <a href="{{ route('admin.audio') }}" class="d-sm-inline-block btn btn-primary btn-add"><i
                            class="fas fa-angle-left"></i> Quay lại</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ $audio->name }} - {{ @$audio->book->name }} - {{ @$audio->chapter->name }}</h5>
                </div>
                <div class="card-body">
                    <p class="text-right"><a href="{{ route('admin.audio.add.step', $audio->id) }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> {{ __('Thêm mới') }}</a></p>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="80">
                                <col width="200">
                                <col>
                                <col width="180">
                                <col width="100">
                                <col width="150">
                            </colgroup>
                            <thead>
                            <tr>
                                <th class="text-center">{{ __('STT') }}</th>
                                <th>{{ __('Công đoạn') }}</th>
                                <th class="text-left">{{ __('Nội dung') }}</th>
                                <th class="text-left">{{ __('Khối lượng/thể tích') }}</th>
                                <th class="text-left">{{ __('Diện tích') }}</th>
                                <th class="text-right">{{ __('Ngày thực hiện') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($audio->steps as $k => $item)
                                <tr>
                                <tr>
                                    <td class="text-center">{{ $k+1 }}</td>
                                    <td><a href="{{ route('admin.audio.add.step', [$item->audio_id, $item->id]) }}">{!! @$item->type->name !!}</a></td>
                                    <td>{!! $item->content !!}</td>
                                    <td>{!! $item->quantity !!}</td>
                                    <td>{!! $item->area !!}</td>
                                    <td>{!! date("m-d-Y", strtotime($item->created_at)) !!}</td>
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
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("Cập nhật thông tin sản phẩm") }}</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                @php
                                $error = str_replace('The email has already been taken.','このメールアドレスは既に登録されています。', $error);
                                $error = str_replace('The password must be at least 6 characters.','パスワードは6文字以上でお願いします。', $error);
                                $error = str_replace('The password confirmation does not match.','パスワードとパスワードの再入力が一致しません', $error);
                                @endphp
                                <span class="invalid-feedback display-block" role="alert">{{ $error }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.audio.process') }}" enctype="multipart/form-data" method="post" novalidate class="needs-validation">
                        @csrf
                        @if(isset($audio->id))
                            <input type="hidden" name="id" value="{{ $audio->id }}" />
                        @endif
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Mã QR</label>
                                <div class="input-field col-sm-9">
                                    <a href="{!! $qr_link !!}" download="qrcode_{{$audio->id}}.png"><img src="{!! $qr_link !!}" title="{{ $audio->name }}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Nông trại<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <input type="hidden" name="book_id" value="{{ $audio->book_id }}" />
                                    <select class="form-control @error('book_id') is-invalid @enderror" name="book_id" id="book_id" disabled>
                                        <option disabled>{{ __("Nông trại") }}</option>
                                        @foreach($books as $book)
                                            <option @if($audio->book_id == $book->id) selected @endif value="{{ $book->id }}">{{ $book->name }}</option>
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
                                    <input type="hidden" name="chapter_id" value="{{ $audio->chapter_id }}" />
                                    <select class="form-control @error('chapter_id') is-invalid @enderror" name="chapter_id" id="chapter_id" disabled>
                                        <option disabled>{{ __("Cánh đồng") }}</option>
                                        @foreach($chapters as $chapter)
                                            @if($audio->book_id == $chapter->book_id)
                                                <option @if($chapter->id == $audio->chapter_id) selected @endif value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Loại sản phẩm<span class="required-label">（<small>*</small>）</span></label>
                                <div class="input-field col-sm-9">
                                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" required>
                                        <option disabled>{{ __("Loại sản phẩm") }}</option>
                                        @foreach($categories as $category)
                                            <option @if($category->id == $audio->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{!! __("Vui lòng chọn") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Tên sản phẩm<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="name" type="text" placeholder="Tên sản phẩm" class="form-control @error('name') is-invalid @enderror" required name="name" value="{{ $audio->name }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Ngày dự kiến thu hoạch<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="harvest_date" type="date" placeholder="Ngày dự kiến thu hoạch" class="form-control @error('harvest_date') is-invalid @enderror" required name="harvest_date" value="{{ ($audio->harvest_date)?$audio->harvest_date:date("Y-m-d") }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Sản lượng dự kiến<span class="required-label">（<small>*</small>）</span></label>
                                <div class="col-sm-9 input-field">
                                    <input id="expected_quantity" type="text" placeholder="Sản lượng dự kiến" class="form-control @error('expected_quantity') is-invalid @enderror" required name="expected_quantity" value="{{ $audio->expected_quantity }}" autofocus>
                                    <div class="invalid-feedback">{!! __("Vui lòng nhập") !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Hình ảnh sản phẩm</label>
                                <div class="col-sm-9 input-field">
                                    <div class="input-images"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="control-label col-sm-3 text-right">Trạng thái</label>
                                <div class="input-field col-sm-9">
                                    <select name="public" class="form-control">
                                        <option value="2" @if($audio->public == 2) selected @endif>Đang trồng</option>
                                        <option value="1" @if($audio->public == 1) selected @endif>Đang thu hoạch</option>
                                        <option value="0" @if($audio->public == 0) selected @endif>Đã thu hoạch</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="buttons-set text-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Lưu lại</button>
                            <a href="{{ route('admin.audio') }}" class="btn btn-light"><i class="fa fa-reply"></i>Hủy bỏ</a>
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
    <script type="text/javascript" src="/js/image-uploader.min.js"></script>
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
            @if(isset($audio->image1) && $audio->image1 != '')
                @php
                    $preloaded = 'preloaded: [';
                    for($i = 1; $i < 11; $i++){
                        $column = 'image'.$i;
                        if(isset($audio->$column) && $audio->$column != ''){
                            $preloaded .= "{id: $i, src: '/".$audio->$column."'},";
                        }
                    }
                    $preloaded .= ' ]';
                @endphp
                $('.input-images').imageUploader({label:"Bấm vào đây để upload hình ảnh", {!! $preloaded  !!}});
            @else
                $('.input-images').imageUploader({label:"Bấm vào đây để upload hình ảnh"});
            @endif
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
            /*var val = $("#book_id").val();
            $.get("{{ route('ajax.chapter.book') }}/"+val, function(data, status){
                $("#chapter_id").html(data);
                console.log("Data: " + data + "\nStatus: " + status);
            });*/

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