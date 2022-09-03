@extends('layouts.backend')
@section('content')
    <div id="content" xmlns="http://www.w3.org/1999/html">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-primary">{{ __("messages.Products_Managements") }}</h1>
                <a href="{{ route('admin.audio.add') }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> {{ __('messages.add') }}</a>
{{--                <a href="{{ route('admin.audio.truncate') }}" class="btn btn-primary min-w140"><i class="fas fa-plus-circle"></i> {{ __('XOA DU LIEU') }}</a>--}}
            </div>
            <!-- End Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">{{ __("messages.Products_Managements") }}</h5>
                </div>
                <div class="card-body">
                    <div class="block_search mb-3">
                        <form>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input name="title" value="{{ isset($_GET['title'])?$_GET['title']:'' }}" type="text" class="form-control" placeholder="{{ __("messages.productName") }}"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="book_id" id="book_id">
                                            <option value="-1">{{ __("messages.farmname") }}</option>
                                            @foreach($books as $book)
                                                <option @if(isset($_GET['book_id']) && $_GET['book_id'] == $book->id) selected @endif value="{{ $book->id }}">{{ $book->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="form-control" name="chapter_id" id="chapter_id">
                                            <option value="-1">{{ __("messages.land") }}</option>
                                            @foreach($chapters as $chapter)
                                                <option @if(isset($_GET['chapter_id']) && $_GET['chapter_id'] == $chapter->id) selected @endif value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="-1">{{ __("messages.status") }}</option>
                                            <option value="2" {{ (isset($_GET['status']) && $_GET['status'] == 2)?'selected':''}}>{{ __("messages.planting") }}</option>
                                            <option value="1" {{ (isset($_GET['status']) && $_GET['status'] == 1)?'selected':''}}>{{ __("messages.harvesting") }}</option>
                                            <option value="0" {{ (isset($_GET['status']) && $_GET['status'] == 0)?'selected':''}}>{{ __("messages.harvested") }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> {{ __("messages.search") }}</button>
                                    <button onclick="window.location.href = '{{ route('admin.audio') }}';"type="button" class="btn btn-light mr-2"><i class="fas fa-times-circle"></i> {{ __("messages.reset") }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <colgroup>
                                <col>
                                <col width="250">
                                <col width="200">
                                <col width="200">
                                <col width="120">
                                <col width="120">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>{{ __('messages.productName') }}</th>
                                    <th class="text-left">{{ __('messages.farmname') }}</th>
                                    <th class="text-left">{{ __('messages.land') }}</th>
                                    <th class="text-left">{{ __('messages.OutputExpected') }}</th>
                                    <th class="text-left">{{ __('messages.status') }}</th>
                                    <th class="text-right">{{ __('messages.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($audios as $k => $audio)
                                <tr>
                                    <td><a href="{{ route('admin.audio.detail', $audio->id) }}">{!! $audio->name !!}</a></td>
                                    <td class="text-left"><a href="{{ route('admin.book.detail', $audio->book_id) }}">{{ @$audio->book->name }}</a></td>
                                    <td class="text-left"><a href="{{ route('admin.chapter.detail', $audio->chapter_id) }}">{{ @$audio->chapter->name }}</a></td>
                                    <td class="text-left">{{ $audio->quantity->sum('quantity_number') }} / {{ $audio->expected_quantity }}</td>
                                    <td class="text-left">
                                        @if($audio->public == 0)
                                            <span class="badge badge-light">{{ __("messages.harvested") }}</span>
                                        @elseif($audio->public == 1)
                                            <span class="badge badge-warning">{{ __("messages.harvesting") }}</span>
                                        @else
                                            <span class="badge badge-info">{{ __("messages.planting") }}</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.audio.detail', $audio->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> {{ __("messages.edit") }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Chưa có dữ liệu</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $audios->appends($_GET)->links('backend.paginations.admin') }}
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
            $(document).on("change", "#book_id", function () {
                var val = $(this).val();
                $.get("{{ route('ajax.chapter.book') }}/"+val, function(data, status){
                    $("#chapter_id").html('<option value="-1">{{ __('messages.land') }}</option>');
                    $("#chapter_id").append(data);
                    $("#chapter_id option:disabled").remove();
                    console.log("Data: " + data + "\nStatus: " + status);
                });
            });
        })
    </script>
@stop