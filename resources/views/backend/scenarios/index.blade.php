@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Quản lý lịch tàu</h5>
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
                                        <select name="ship_id" data-placeholder="Tên Tàu" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Tên Tàu</option>
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
                                </div>
                                <div class="row clss-group2">
                                    <div class="col-md-3 mb-3">
                                        <select name="country_id" data-placeholder="Cảng Xếp" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Quốc gia</option>
                                            @foreach($countries as $country)
                                                <option {{ isset($_GET['country_id']) && $_GET['country_id'] == $country->id  ? 'selected="selected"' :'' }} value="{{ $country->id }}">{{ $country->country_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select name="boss_port_id" data-placeholder="Cảng Xếp" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Cảng Xếp</option>
                                            @foreach($ports as $port)
                                                <option  {{ isset($_GET['boss_port_id']) && $_GET['boss_port_id'] == $port->id  ? 'selected="selected"' :'' }} value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select name="unloading_port_id" data-placeholder="Cảng Dỡ" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Cảng Dỡ</option>
                                            @foreach($ports as $port)
                                                <option {{ isset($_GET['unloading_port_id']) && $_GET['unloading_port_id'] == $port->id  ? 'selected="selected"' :'' }} value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select name="transit_port_id" data-placeholder="Cảng Transit" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Cảng Transit</option>
                                            @foreach($ports as $port)
                                                <option {{ isset($_GET['transit_port_id']) && $_GET['transit_port_id'] == $port->id  ? 'selected="selected"' :'' }} value="{{ $port->id }}">{{ $port->port_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select name="ship_id" data-placeholder="Tên Tàu" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Tên Tàu</option>
                                            @foreach($ships as $ship)
                                                <option {{ isset($_GET['ship_id']) && $_GET['ship_id'] == $ship->id  ? 'selected="selected"' :'' }} value="{{ $ship->id }}">{{ $ship->ship_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <select name="agent_id" data-placeholder="Đại lý" class="chosen-select border-0 mb-1 px-4 py-4 rounded shadow mb-3 form-control-sm ">
                                            <option value="0">Đại lý</option>
                                            @foreach($agents as $agent)
                                                <option {{ isset($_GET['agent_id']) && $_GET['agent_id'] == $agent->id  ? 'selected="selected"' :'' }} value="{{ $agent->id }}">{{ $agent->agent_nm_vn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <select id="is_inbound" name="is_inbound" class="form-control" style="height: 39px;line-height: 16px;">
                                                <option @if(isset($_GET['is_inbound']) && $_GET['is_inbound'] == 0) selected @endif value="0" {{ (isset($_GET['is_inbound']) && $_GET['is_inbound'] == 0)?'selected':''}}>InBound</option>
                                                <option @if(isset($scenario->country_id) && $scenario->country_id == 1) selected @endif @if(isset($_GET['is_inbound']) && $_GET['is_inbound'] == 1) selected @endif value="1" {{ (isset($_GET['is_inbound']) && $_GET['is_inbound'] == 1)?'selected':''}}>OutBound</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <button style="padding: 6px 5px; margin-top: 0px;" type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Tìm kiếm</button>
                                        <a href="{{ route('admin.scenarios') }}">
                                            <button style="padding: 6px 5px; margin-top: 0px;" type="button" class="btn btn-primary mr-2"><i class="fas fa-random"></i> Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <div class="row" style="margin-left: 0px;margin-bottom: 10px;margin-top: 0px;">
                                <button style="padding: 6px 5px; margin-top: 0px;" class="btn btn-primary btn-sm btn-delete" type="button" id="btn_delete_all"><i class="fas fa fa-trash"></i> Xóa Lịch Đã Chọn</button>
                                <button style="padding: 6px 5px; margin-top: 0px; margin-left: 10px" type="button" class="btn btn-primary mr-2" title="Download File">
                                    <a style="color: white;text-decoration:none;" href="{{ $download_link }}"><i class="fa fa-download" aria-hidden="true"></i> Tải Lịch</a>
                                </button>
                            </div>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover" id="dataTable" style="width: 140%" cellspacing="0">
                                    <colgroup>
                                        <col width="50">
                                        <col>
                                        <col width="280">
                                        <col width="180">
                                        <col width="120">
                                        <col width="120">
                                        <col width="110">
                                        <col width="110">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th class="text-center"><input id="checkAll" name="checked_all" value="1" type="checkbox" class="scenarios_id"></th>
                                        <th class="text-left" width="10%">Cảng Xếp</th>
                                        <th class="text-left"  width="10%">Cảng Dỡ</th>
                                        <th class="text-left"  width="10%">Cảng Transit</th>
                                        <th class="text-left">Tên Tàu</th>
                                        <th class="text-left">Đại Lý</th>
                                        <th class="text-left" width="10%">Ngày Đi</th>
                                        <th class="text-left" width="10%">Ngày Đến</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($categories as $k => $category)
                                        @if(isset($category->boss->port_nm_vn) && $category->boss->port_nm_vn != "")
                                            <tr>
                                                @php $class = (isset($_GET['id']) && $_GET['id'] == $category->id)?'active':'';@endphp
                                                <td class="{{ $class }} text-center"><input name="scenarios_id[]" value="{{$category->id}}" type="checkbox" class="scenarios_id"></td>
                                                <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ isset($category->boss->port_nm_vn) ? $category->boss->port_nm_vn : "" }}</td>
                                                <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ isset($category->unloading->port_nm_vn) ? $category->unloading->port_nm_vn : "" }}</td>
                                                <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">@if(isset($category->transit->port_nm_vn)) {{ $category->transit->port_nm_vn }} @endif</td>
                                                <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ isset($category->ship->ship_nm_vn) ? $category->ship->ship_nm_vn : "" }}</td>
                                                <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ isset($category->agent->agent_nm_vn) ? $category->agent->agent_nm_vn : "" }}</td>
                                                <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ isset($category->departure_day) ? date("d/m/Y", strtotime($category->departure_day)) : "" }}</td>
                                                <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ isset($category->arrival_date) ? date("d/m/Y", strtotime($category->arrival_date)) : "" }}</td>
                                            </tr>
                                        @endif
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
    <script src="/src/asset/js/backend/chosen.jquery.js"></script>
    <script src="/src/asset/js/backend/jquery.maskedinput.js"></script>

    <script>
        $(function() {
           $("#checkAll").on('click',function() {
               if($(this).is(":checked")) {
                   $('.scenarios_id').prop('checked', true);
               } else {
                   $('.scenarios_id').prop('checked', false);
               }
           });
        });

        $(document).ready(function () {
            $('.chosen-select').chosen();
            $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
            var currentTime = new Date()
            var month = currentTime.getMonth() + 1
            var day = currentTime.getDate()
            var year = currentTime.getFullYear()
            var full_date = month + "/" + day + "/" + year;

            $(".mask").mask("99/99/9999");

            // $('#start_date').val(full_date);
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