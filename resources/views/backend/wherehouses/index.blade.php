@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __('messages.WhereHouse_Managements') }}</h1>
                <a href="{{ route('admin.wherehouse.add') }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> {{ __('messages.add') }}</a>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __('messages.WhereHouse_Managements') }}</h5>
                </div>
                <div class="card-body">
                    <div class="block_search">
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input name="title" value="{{ isset($_GET['title'])?$_GET['title']:'' }}" type="text" class="form-control" placeholder="{{ __("messages.productName") }}"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="-1">{{ __("messages.status") }}</option>
                                            <option value="0" {{ (isset($_GET['status']) && $_GET['status'] == 0)?'selected':''}}>{{ __("messages.Outofstock") }}</option>
                                            <option value="1" {{ (isset($_GET['status']) && $_GET['status'] == 1)?'selected':''}}>{{ __("messages.Instock") }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> {{ __("messages.search") }}</button>
                                    <button onclick="window.location.href = '{{ route('admin.wherehouse') }}';"type="button" class="btn btn-light mr-2"><i class="fas fa-times-circle"></i> {{ __("messages.reset") }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col width="80">
                                <col>
                                <col width="200">
                                <col width="150">
                                <col width="150">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('messages.no') }}</th>
                                    <th class="text-left">{{ __('messages.productName') }}</th>
                                    <th class="text-left">{{ __('messages.Quantityinstock') }}</th>
                                    <th class="text-center">{{ __('messages.UpdatedDate') }}</th>
                                    <th class="text-center">{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($books as $k => $book)
                                <tr>
                                    <td class="text-center">{{ (($books->currentPage()-1)*$limit)+$k+1 }}</td>
                                    <td class="text-left"><a href="{{ route('admin.wherehouse.detail', $book->id) }}">{{ $book->name }}</a></td>
                                    <td class="text-left">{{ number_format($book->qty) }} {{ $book->unit }}</td>
                                    <td class="text-center">{{ date("d-m-Y", strtotime($book->updated_at)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.wherehouse.detail', $book->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> {{ __('messages.edit') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">{{ __('messages.NoData') }}</td>
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