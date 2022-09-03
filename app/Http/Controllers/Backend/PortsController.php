<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Agent;
use App\Models\Audio;
use App\Models\Country;
use App\Models\Port;
use App\Models\ProductCategory;
use App\Models\Ship;
use App\Models\Step;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class PortsController extends Controller
{
    var $limit = 10;

    public function __construct()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
    }

    public function index(Request $request)
    {
        $submit_data = $request->all();
        $data['limit'] = $this->limit;
        $category = Port::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $category->where('port_nm_vn','like', '%'.$submit_data['title'].'%');
            $category->orWhere('port_nm_en','like', '%'.$submit_data['title'].'%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $category->where('status', $submit_data['status']);
        }

        $data['categories'] = $category->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.ports.index', $data);
    }

    public function add(Request $request, $category_id = 0)
    {
        $data = [];
        $category = Port::where('id', $category_id)->first();
        $data['category'] = $category;
        $data['countries'] = Country::get();
        return view('backend.ports.edit', $data);
    }

    public function process(Request $request, $category_id = 0)
    {

        $data = $request->all();
            $request->validate([
                'port_nm_vn' => ['required', 'string', 'max:255'],
                'port_nm_en' => ['required', 'string', 'max:255'],
                'country_id' => ['required'],
            ]);
        if (isset($data['id']) && $data['id']) {
            Port::where('id', $data['id'])->update([
                'port_nm_vn' => $data['port_nm_vn'],
                'port_nm_en' => $data['port_nm_en'],
                'country_id' => $data['country_id'],
            ]);
        }else{
            Port::create([
                'port_nm_vn' => $data['port_nm_vn'],
                'port_nm_en' => $data['port_nm_en'],
                'country_id' => $data['country_id'],
            ]);
        }
        return redirect()->route('admin.ports')->with('status', 'Lưu thông tin thành công');
    }

    public function delete($category_id){
        Port::where('id', $category_id)->delete();
        return redirect()->route('admin.ports')->with('status', 'Xóa thông tin thành công');
    }

}
