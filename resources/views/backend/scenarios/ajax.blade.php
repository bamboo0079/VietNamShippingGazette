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