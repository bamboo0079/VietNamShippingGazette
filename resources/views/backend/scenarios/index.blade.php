@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Quản lý lịch tàu</h5>
                </div>
                {{--<div class="container-fluid mt-2 d-none" id="msgSuccess">
                    <div class="card" style="border: none">
                        <div class="alert alert-success" role="alert">
                            Lưu thông tin thành công!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>--}}
                {{--@if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif--}}
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
                                        {{--<input class="btn btn-primary btn-medium pull-right" type="submit" name="yt0" value="Thêm mới">--}}
                                        <button style="margin-top: 0px !important;" id="btnSubmit" type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus-circle"></i> @if(isset($scenario->id) && $scenario->id) Cập nhật @else Thêm mới @endif</button>
                                        <button style="background: #0e6dcd; margin-top: 0px !important;" onclick="window.location.href = '{{ route('admin.scenarios') }}';"type="button" class="btn btn-primary @if(isset($scenario->id) && $scenario->id) mt-2 @endif"><i class="fas fa-reply-all"></i> Đặt lại </button>
                                        @if(isset($scenario->id) && $scenario->id)
                                            <button style="background: #de333b; color: white; width: 249px; margin-left: 10px; margin-top: 5px" onclick="window.location.href = '{{ route('admin.scenario.delete', $scenario->id) }}';"type="button" class="btn btn-light mr-2"><i class="fas fa-trash"></i> Xóa</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="block_search mb-3 col-md-9">
                            <form id="frm_search">
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
                                            <select id="is_inbound" name="is_inbound" class="form-control">
                                                <option @if(isset($_GET['is_inbound']) && $_GET['is_inbound'] == 0) selected @endif value="0" {{ (isset($_GET['is_inbound']) && $_GET['is_inbound'] == 0)?'selected':''}}>InBound</option>
                                                <option @if(isset($scenario->country_id) && $scenario->country_id == 1) selected @endif @if(isset($_GET['is_inbound']) && $_GET['is_inbound'] == 1) selected @endif value="1" {{ (isset($_GET['is_inbound']) && $_GET['is_inbound'] == 1)?'selected':''}}>OutBound</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button style="padding: 9px 5px;" type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Tìm kiếm</button>
                                        <button style="padding: 9px 10px;" type="button" class="btn btn-primary mr-2" title="Download File">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                            <a style="color: white;" href="{{ $download_link }}">DL</a>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
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
                                        <th class="text-center"><button class="btn btn-primary btn-sm btn-delete" type="button" id="btn_delete_all"><i class="fas fa fa-trash"></i></button></th>
                                        <th class="text-left">Cảng Xếp</th>
                                        <th class="text-left">Cảng Dỡ</th>
                                        <th class="text-left">Cảng Transit</th>
                                        <th class="text-left">Tên Tàu</th>
                                        <th class="text-left">Đại Lý</th>
                                        <th class="text-left">Ngày Đi</th>
                                        <th class="text-left">Ngày Đến</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $k => $category)
                                        <tr>
                                            @php $class = (isset($_GET['id']) && $_GET['id'] == $category->id)?'active':'';@endphp
                                            <td class="{{ $class }} text-center"><input name="scenarios_id[]" value="{{$category->id}}" type="checkbox" class="scenarios_id"></td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ $category->boss->port_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ $category->unloading->port_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ $category->transit->port_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ $category->ship->ship_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ $category->agent->agent_nm_vn }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ date("Y/m/d", strtotime($category->departure_day)) }}</td>
                                            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ date("Y/m/d", strtotime($category->arrival_date)) }}</td>
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
                <select name="ship_id" data-placeholder="Tên con tàu" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                    <option value="0">Tên con tàu</option>
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
                <button style="background: #de333b" onclick="window.location.href = '{{ route('admin.scenarios') }}';"type="button" class="btn btn-light mr-2"><i class="fas fa-times-circle"></i> Xóa</button>
            </div>
        </div>
    </form>
    <style type="text/css">
       button:focus {
           background: #32627c;
           border: 1px solid #0a0505;
       }
       table tr td {
           cursor: pointer;
       }
        td.active{
            background: #dddfeb;
        }
    </style>
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
            $(document).on("change", "#is_inbound", function () {
                $("#frm_search").submit();
            });
            $(document).on("click", "#btn_delete_all", function () {
                var list_scenarios_id = '';
                $(".scenarios_id").each(function () {
                    if($(this).is(":checked")){
                        list_scenarios_id = list_scenarios_id + $(this).val() + ',';
                    }
                });
                if(list_scenarios_id.length){
                    console.log(list_scenarios_id);
                    window.location.href = '{{ route('admin.scenario.delete.multiple') }}?list_scenarios_id='+list_scenarios_id;
                }
            });
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
                    if($(".alert-danger").length == 0){
                        $('.chosen-select').val(0).trigger("chosen:updated");
                        $('.mask').val('');
                        $("#id").val(0);
                        $("#msgSuccess").removeClass('d-none');
                        $("#btnSubmit").html('<i class="fas fa-plus-circle"></i>  Thêm mới');
                    }
                    setTimeout(function() {
                        $(".alert-danger").remove();
                        $(".alert-success").remove();
                    }, 3000);
                }
            });

        });
    </script>
@stop