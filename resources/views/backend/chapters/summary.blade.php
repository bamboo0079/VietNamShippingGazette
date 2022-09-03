@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __('Lịch sử sâu bệnh') }}</h1>
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ @$chapter->book->name }} - {{ $chapter->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-left">{{ __('Sản phẩm') }}</th>
                                    <th class="text-left">{{ __('Tình trạng sâu bệnh') }}</th>
                                    <th class="text-left">{{ __('Giải pháp') }}</th>
                                    <th class="text-left">{{ __('Kết quả') }}</th>
                                    <th class="text-left">{{ __('Ngày xử lý') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($steps as $k => $step)
                                <tr>
                                    <td class="text-left"><a href="{{ route('admin.audio.detail', $step->audio_id) }}">{{ @$step->audio->name }}</a></td>
                                    <td class="text-left">{{ $step->status }}</td>
                                    <td class="text-left">{{ $step->summary }}</td>
                                    <td class="text-left">{{ $step->result }}</td>
                                    <td class="text-left">{{ date("d/m/Y", strtotime($step->created_at)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End -->
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