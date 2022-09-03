@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">Quản lý lịch tàu</h1>
                {{--<a href="{{ route('admin.country.add') }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> Thêm</a>--}}
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Lịch tàu</h5>
                </div>
                <div class="container-fluid mt-2 d-none" id="msgSuccess">
                    <div class="card" style="border: none">
                        <div class="alert alert-success" role="alert">
                            Lưu thông tin thành công!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="block_search mb-3 col-md-3">
                            <form id="frmAjax" method="post" action="{{ route('admin.scenario.process') }}">
                                @csrf
                                <input id="id" type="hidden" name="id" value="{{ isset($_GET['id'])?$_GET['id']:0 }}">
                                <div class="form-group row @if(isset($_GET['id'])) edit-form @endif">
                                    <div class="col-md-12 mb-3">
                                        <select name="boss_port_id" data-placeholder="Cảng Xếp" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Cảng Xếp</option>
                                            @foreach($ports as $port)
                                                <option @if(isset($scenario->boss_port_id) && $scenario->boss_port_id == $port->id) selected @endif value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <select name="unloading_port_id" data-placeholder="Cảng Dỡ" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Cảng Dỡ</option>
                                            @foreach($ports as $port)
                                                <option @if(isset($scenario->unloading_port_id) && $scenario->unloading_port_id == $port->id) selected @endif value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <select name="transit_port_id" data-placeholder="Cảng Transit" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Cảng Transit</option>
                                            @foreach($ports as $port)
                                                <option @if(isset($scenario->transit_port_id) && $scenario->transit_port_id == $port->id) selected @endif value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <select name="ship_id" data-placeholder="Hãng Tàu" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Hãng Tàu</option>
                                            @foreach($ships as $ship)
                                                <option @if(isset($scenario->ship_id) && $scenario->ship_id == $ship->id) selected @endif value="{{ $ship->id }}">{{ $ship->ship_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <select name="agent_id" data-placeholder="Đại lý" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Đại lý</option>
                                            @foreach($agents as $agent)
                                                <option @if(isset($scenario->agent_id) && $scenario->agent_id == $agent->id) selected @endif value="{{ $agent->id }}">{{ $agent->agent_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3 input-daterange">
                                        <div id="datepicker" class="input-daterange input-group group_calendar">
                                            <div class="input-group-prepend input-daterange">
                                                <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i>Ngày đi&nbsp;&nbsp;&nbsp;</span>
                                            </div>
                                            <input id="start_date" placeholder="dd/mm/yyyy" @if(isset($scenario->departure_day) && $scenario->departure_day) value="{{ date("d-m-Y", strtotime($scenario->departure_day)) }}" @endif type="text" class="input-sm form-control mask" name="departure_day">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 input-daterange">
                                        <div id="datepicker" class="input-daterange input-group group_calendar">
                                            <div class="input-group-prepend input-daterange">
                                                <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i>Ngày đến</span>
                                            </div>
                                            <input id="end_date" placeholder="dd/mm/yyyy" @if(isset($scenario->arrival_date) && $scenario->arrival_date) value="{{ date("d-m-Y", strtotime($scenario->arrival_date)) }}" @endif type="text" class="input-sm form-control mask" name="arrival_date">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 text-center">
                                        <button id="btnSubmit" type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus-circle"></i> @if(isset($scenario->id) && $scenario->id) Cập nhật @else Thêm mới @endif</button>
                                        @if(isset($scenario->id) && $scenario->id)
                                            <button onclick="window.location.href = '{{ route('admin.scenario.delete', $scenario->id) }}';"type="button" class="btn btn-light mr-2"><i class="fas fa-times-circle"></i> Xóa</button>
                                        @endif
                                        <button onclick="window.location.href = '{{ route('admin.scenarios') }}';"type="button" class="btn btn-primary @if(isset($scenario->id) && $scenario->id) mt-2 @endif"><i class="fas fa-angle-left"></i> Đặt lại </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="block_search mb-3 col-md-9">
                            <form>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="form-group sandbox-container" id="sandbox-container2">
                                            <div id="datepicker" class="input-daterange input-group group_calendar">
                                                <div class="input-group-prepend input-daterange">
                                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i>Từ Ngày</span>
                                                </div>
                                                <input value="{{ isset($_GET['start'])?$_GET['start']:'' }}" type="text" class="input-sm form-control mask" name="start">
                                                <div class="input-group-prepend input-daterange">
                                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i>Đến Ngày</span>
                                                </div>
                                                <input value="{{ isset($_GET['end'])?$_GET['end']:'' }}" type="text" class="input-sm form-control mask" name="end">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 find_type">
                                        <div class="form-group">
                                            <select name="country" class="form-control">
                                                <option value="-1">All</option>
                                                <option @if(isset($_GET['country']) && $_GET['country'] == 2) selected @endif value="2" {{ (isset($_GET['country']) && $_GET['country'] == 2)?'selected':''}}>OutBound</option>
                                                <option @if(isset($_GET['country']) && $_GET['country'] == 1) selected @endif value="1" {{ (isset($_GET['country']) && $_GET['country'] == 1)?'selected':''}}>InBound</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Tìm kiếm</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <p class="text-right"><a href="{{ $download_link }}"><i class="fa fa-download" aria-hidden="true"></i> Download</a></p>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <colgroup>
                                        <col width="50">
                                        <col>
                                        <col width="180">
                                        <col width="180">
                                        <col width="120">
                                        <col width="120">
                                        <col width="110">
                                        <col width="110">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th class="text-left">Cảng Xếp</th>
                                        <th class="text-left">Cảng Dỡ</th>
                                        <th class="text-left">Cảng Transit</th>
                                        <th class="text-left">Tàu</th>
                                        <th class="text-left">Đại Lý</th>
                                        <th class="text-left">Ngày Đi</th>
                                        <th class="text-left">Ngày Đến</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $k => $category)
                                        <tr>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-center">{{ (($categories->currentPage()-1)*$limit)+$k+1 }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-left">{{ $category->boss->port_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-left">{{ $category->unloading->port_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-left">{{ $category->transit->port_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-left">{{ $category->ship->ship_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-left">{{ $category->agent->agent_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-left">{{ date("Y/m/d", strtotime($category->departure_day)) }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="text-left">{{ date("Y/m/d", strtotime($category->arrival_date)) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Không có dữ liệu</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{ $categories->appends($_GET)->links('backend.paginations.admin') }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End -->
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ユーザー管理</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>消去してもよろしいですか？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">はい</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
    <form id="frmInit" method="post" action="{{ route('admin.scenario.process') }}" class="d-none">
        @csrf
        <input type="hidden" name="id" value="">
        <div class="form-group row">
            <div class="col-md-12 mb-3">
                <select name="boss_port_id" data-placeholder="Cảng Xếp" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                    <option value="0">Cảng Xếp</option>
                    @foreach($ports as $port)
                        <option value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <select name="unloading_port_id" data-placeholder="Cảng Dỡ" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                    <option value="0">Cảng Dỡ</option>
                    @foreach($ports as $port)
                        <option value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <select name="transit_port_id" data-placeholder="Cảng Transit" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                    <option value="0">Cảng Transit</option>
                    @foreach($ports as $port)
                        <option value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <select name="ship_id" data-placeholder="Hãng Tàu" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                    <option value="0">Hãng Tàu</option>
                    @foreach($ships as $ship)
                        <option value="{{ $ship->id }}">{{ $ship->ship_nm_vn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <select name="agent_id" data-placeholder="Đại lý" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                    <option value="0">Đại lý</option>
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->agent_nm_vn }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-12 mb-3 input-daterange">
                <div id="datepicker" class="input-daterange input-group group_calendar">
                    <div class="input-group-prepend input-daterange">
                        <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i>Ngày đi&nbsp;&nbsp;&nbsp;</span>
                    </div>
                    <input id="start_date" placeholder="dd/mm/yyyy" type="text" class="input-sm form-control mask" name="departure_day">
                </div>
            </div>
            <div class="col-md-12 mb-3 input-daterange">
                <div id="datepicker" class="input-daterange input-group group_calendar">
                    <div class="input-group-prepend input-daterange">
                        <span class="input-group-text"><i class="fas fa-fw fa-calendar"></i>Ngày đến</span>
                    </div>
                    <input id="end_date" placeholder="dd/mm/yyyy" type="text" class="input-sm form-control mask" name="arrival_date">
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus-circle"></i> Thêm mới</button>
                <button onclick="window.location.href = '{{ route('admin.scenarios') }}';"type="button" class="btn btn-light mr-2"><i class="fas fa-times-circle"></i> Xóa</button>
            </div>
        </div>
    </form>
    <script src="/src/asset/js/backend/bootstrap-datepicker.min.js"></script>

    <link href="/src/asset/css/frontend/bootstrap-chosen.css" rel="stylesheet">
    <script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
    <script src="/src/asset/js/backend/jquery.maskedinput.js"></script>

    <script>
        $(document).ready(function () {
            $('.chosen-select').chosen();
            $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
            $('.input-daterange input').each(function() {
//                $(this).datepicker();
            });
            $(".mask").mask("99/99/9999");
        });
        $("#frmAjax").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var actionUrl = form.attr('action');
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $(".table-responsive").html(data);
                    $('.chosen-select').val(0).trigger("chosen:updated");
                    $('.mask').val('');
                    $("#id").val(0);
                    $("#msgSuccess").removeClass('d-none');
                    $("#btnSubmit").html('<i class="fas fa-plus-circle"></i>  Thêm mới');
                }
            });

        });
    </script>
@stop