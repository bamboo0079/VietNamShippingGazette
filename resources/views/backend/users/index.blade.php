@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">Quản lý người dùng</h1>
                <a href="{{ route('admin.user.add') }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> Thêm</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Quản lý người dùng</h5>
                </div>
                <div class="card-body">
                    <div class="block_search">
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input name="title" value="{{ isset($_GET['title'])?$_GET['title']:'' }}" type="text" class="form-control" placeholder="Email"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="-1">Trạng thái</option>
                                            <option value="0" {{ (isset($_GET['status']) && $_GET['status'] == 0)?'selected':''}}>Đang hoạt động</option>
                                            <option value="1" {{ (isset($_GET['status']) && $_GET['status'] == 1)?'selected':''}}>Bị khóa</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Tìm kiếm</button>
                                    <button onclick="window.location.href = '{{ route('admin.dashboard') }}';"type="button" class="btn btn-light mr-2"><i class="fas fa-times-circle"></i> Tìm Tất Cả</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="60">
                                <col>
                                <col>
                                {{--<col width="165">--}}
                                <col width="110">
                                <col width="200">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-left">Tên</th>
                                    <th class="text-left">Email</th>
                                    {{--<th class="text-center">{{ __('Điện thoại') }}</th>--}}
                                    <th class="text-left text-nowrap">Trạng thái</th>
                                    <th class="text-right">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $k => $user)
                                <tr>
                                    <td class="text-center">{{ (($users->currentPage()-1)*$limit)+$k+1 }}</td>
                                    <td><a href="{{ route('admin.user.detail', $user->id) }}">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    {{--<td class="text-center text-nowrap">{{ $user->tel }}</td>--}}
                                    <td class="text-left">
                                        @if($user->block == 1)
                                            <span class="badge badge-light">Bị khóa</span>
                                        @else
                                            <span class="badge badge-info">Đang hoạt động</span>
                                        @endif
                                    </td>
                                    <td class="text-right text-nowrap">
                                        <a href="{{ route('admin.user.detail', $user->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Cập nhật</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-primary btn-sm btn-delete"><i class="fas fa fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $users->appends($_GET)->links('backend.paginations.admin') }}
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
                    <h5 class="modal-title">Quản lý người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa không</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Có</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#deleteModal').on('show.bs.modal', function(e) {
                $(this).find('.btn-primary').attr('form',$(e.relatedTarget).data('form'));
            });
            $('#deleteModal').on('click', '.btn-primary', function(e) {
                $($(this).attr('form')).submit();
                $(e.delegateTarget).modal('hide');
            });
        })
    </script>
@stop