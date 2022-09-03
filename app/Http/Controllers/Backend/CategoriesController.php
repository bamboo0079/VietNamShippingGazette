<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Audio;
use App\Models\ProductCategory;
use App\Models\Step;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class CategoriesController extends Controller
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
        $category = Category::where('type', 1)->where('show_menu', 1);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $category->where('name_vn','like', '%'.$submit_data['title'].'%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $category->where('public', $submit_data['status']);
        }

        $data['categories'] = $category->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.categories.index', $data);
    }

    public function add(Request $request, $category_id = 0)
    {
        $data = [];
        $category = Category::where('id', $category_id)->first();
        $data['category'] = $category;
        return view('backend.categories.edit', $data);
    }

    public function process(Request $request, $category_id = 0)
    {

        $data = $request->all();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
        if (isset($data['id']) && $data['id']) {
            Category::where('id', $data['id'])->update([
                'name_vn' => $data['name'],
                'name_en' => $data['name_en'],
            ]);
        }else{
            $order = Category::where('type', 1)->count();
            Category::create([
                'name_vn' => $data['name'],
                'name_en' => $data['name_en'],
                'order' => $order,
            ]);
        }
        return redirect()->route('admin.category')->with('status', 'Lưu thông tin thành công');
    }

    public function productTypes(Request $request)
    {
        $submit_data = $request->all();
        $data['limit'] = $this->limit;
        $category = ProductCategory::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $category->where('name_vn','like', '%'.$submit_data['title'].'%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $category->where('public', $submit_data['status']);
        }

        $data['categories'] = $category->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.categories.product_types', $data);
    }

    public function addProductType(Request $request, $category_id = 0)
    {
        $data = [];
        $category = ProductCategory::where('id', $category_id)->first();
        $data['category'] = $category;
        return view('backend.categories.edit_product_type', $data);
    }

    public function processProductType(Request $request, $category_id = 0)
    {

        $data = $request->all();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
        if (isset($data['id']) && $data['id']) {
            ProductCategory::where('id', $data['id'])->update([
                'name_vn' => $data['name'],
                'name_en' => $data['name_en'],
            ]);
        }else{
            ProductCategory::create([
                'name_vn' => $data['name'],
                'name_en' => $data['name_en'],
            ]);
        }
        return redirect()->route('admin.product.type')->with('status', 'Lưu thông tin thành công');
    }

    public function delete($category_id){
        Category::where('id', $category_id)->delete();
        return redirect()->route('admin.category')->with('status', 'Xóa thông tin thành công');
    }

    public function deleteProductType($category_id){
        ProductCategory::where('id', $category_id)->delete();
        return redirect()->route('admin.product.type')->with('status', 'Xóa thông tin thành công');
    }

}
