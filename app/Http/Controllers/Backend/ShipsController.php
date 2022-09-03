<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Agent;
use App\Models\Audio;
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
class ShipsController extends Controller
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
        $category = Ship::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $category->where('ship_nm_vn','like', '%'.$submit_data['title'].'%');
            $category->orWhere('ship_nm_en','like', '%'.$submit_data['title'].'%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $category->where('status', $submit_data['status']);
        }

        $data['categories'] = $category->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.ships.index', $data);
    }

    public function add(Request $request, $category_id = 0)
    {
        $data = [];
        $category = Ship::where('id', $category_id)->first();
        $data['category'] = $category;
        return view('backend.ships.edit', $data);
    }

    public function process(Request $request, $category_id = 0)
    {

        $data = $request->all();
            $request->validate([
                'ship_nm_vn' => ['required', 'string', 'max:255'],
                'ship_nm_en' => ['required', 'string', 'max:255'],
            ]);
        if (isset($data['id']) && $data['id']) {
            Ship::where('id', $data['id'])->update([
                'ship_nm_vn' => $data['ship_nm_vn'],
                'ship_nm_en' => $data['ship_nm_en'],
            ]);
        }else{
            Ship::create([
                'ship_nm_vn' => $data['ship_nm_vn'],
                'ship_nm_en' => $data['ship_nm_en'],
            ]);
        }
        return redirect()->route('admin.ships')->with('status', 'Lưu thông tin thành công');
    }

    public function delete($category_id){
        Ship::where('id', $category_id)->delete();
        return redirect()->route('admin.ships')->with('status', 'Xóa thông tin thành công');
    }

}
