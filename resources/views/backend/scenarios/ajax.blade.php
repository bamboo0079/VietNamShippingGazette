@if(Session::has('successMsg'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('successMsg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(Session::has('errorMsg'))
    <div class="alert alert-danger" role="alert">
        {{ Session::get('errorMsg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
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
        <th class="text-center">STT</th>
        <th class="text-left">Cảng Xếp</th>
        <th class="text-left">Cảng Dỡ</th>
        <th class="text-left">Cảng Transit</th>
        <th class="text-left">Hãng Tàu</th>
        <th class="text-left">Đại Lý</th>
        <th class="text-left">Ngày Đi</th>
        <th class="text-left">Ngày Đến</th>
    </tr>
    </thead>
    <tbody>
    @forelse($categories as $k => $category)
        <tr>
            @php $class = ($k == 0)?'active':'';@endphp
            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-center">{{ (($categories->currentPage()-1)*$limit)+$k+1 }}</td>
            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ $category->boss->port_nm_vn }}</td>
            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">{{ $category->unloading->port_nm_vn }}</td>
            <td onclick="window.location='{{ route('admin.scenarios') }}?id={{$category->id}}'" class="{{ $class }} text-left">@if(isset($category->transit->port_nm_vn)) {{ $category->transit->port_nm_vn }} @endif</td>
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