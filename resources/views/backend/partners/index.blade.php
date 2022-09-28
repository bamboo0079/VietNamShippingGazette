@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary"></h1>
                <a href="{{ route('admin.partner.add') }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> Thêm</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Quản lý đối tác</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="50">
                                <col>
                                <col width="200">
                                <col width="200">
                                <col width="200">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">STT</th>
                                    <th class="text-left">Đối tác (VN)</th>
                                    <th class="text-left">Đối tác (EN)</th>
                                    <th class="text-left">Hình ảnh</th>
                                    <th class="text-left">Link</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($books as $k => $book)
                                <tr>
                                    <td class="text-center">{{ (($books->currentPage()-1)*$limit)+$k+1 }}</td>
                                    <td class="text-left"><a href="{{ route('admin.partner.detail', $book->id) }}">{{ $book->title_vn }}</a></td>
                                    <td class="text-left"><a href="{{ route('admin.partner.detail', $book->id) }}">{{ $book->title_en }}</a></td>
                                    <td class="text-left"><img src="{{ $book->img }}" width="200" /></td>
                                    <td class="text-left"><a href="{{ $book->link }}" target="_blank">{{ $book->link }}</a></td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.partner.detail', $book->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Cập nhật</a>
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="{{ route('admin.partner.delete', $book->id) }}" class="btn btn-primary btn-sm btn-delete"><i class="fas fa fa-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $books->appends($_GET)->links('backend.paginations.admin') }}
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