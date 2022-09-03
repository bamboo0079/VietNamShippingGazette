<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class AppNewsController extends Controller
{
    var $limit = 10;

    public function __construct()
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }
    }

    public function index(Request $request)
    {
        $submit_data = $request->all();
        $data['limit'] = $this->limit;
        $book = News::where('id', '>', 0);
        if (isset($submit_data['category_id']) && $submit_data['category_id']) {
            $book->where('category_id', $submit_data['category_id']);
        }else{
            $book->whereNotIn('category_id', [2,3,4,5,17]);
            $book->where('product_category_id', 0);
        }
        if (isset($submit_data['title']) && $submit_data['title']) {
            $book->where('title_vn', 'like', '%' . $submit_data['title'] . '%');
            $book->orWhere('title_en', 'like', '%' . $submit_data['title'] . '%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $book->where('approved', $submit_data['status']);
        }

        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.app.index', $data);
    }

    public function products(Request $request)
    {
        $submit_data = $request->all();
        $data['limit'] = $this->limit;
        $book = News::where('product_category_id', '>', 0);
        if (isset($submit_data['product_category_id']) && $submit_data['product_category_id']) {
            $book->where('product_category_id', $submit_data['product_category_id']);
        }
        if (isset($submit_data['title']) && $submit_data['title']) {
            $book->where('title_vn', 'like', '%' . $submit_data['title'] . '%');
            $book->orWhere('title_en', 'like', '%' . $submit_data['title'] . '%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $book->where('approved', $submit_data['status']);
        }

        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.app.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        $data['categories'] = Category::orderBy('order', 'ASC')->get();
        $data['productcategories'] = ProductCategory::orderBy('order', 'ASC')->get();
        return view('backend.app.edit', $data);
    }

    public function detail(Request $request, $book_id = 0)
    {
        $data = [];
        $data['categories'] = Category::orderBy('order', 'ASC')->get();
        $data['productcategories'] = ProductCategory::orderBy('order', 'ASC')->get();
        $book = News::where('id', $book_id)->first();
        if (!$book) {
            abort(404);
        }
        $data['book'] = $book;
        return view('backend.app.detail', $data);
    }

    public function process(Request $request, $book_id = 0)
    {

        $data = $request->all();
        if (isset($data['id']) && $data['id']) {
            $update = [
                'approved' => isset($data['approved']) ? $data['approved'] : 1,
            ];
            News::where('id', $data['id'])->update($update);
        }
        $news = News::where('id', $data['id'])->first();
        $redirect = route('admin.app.news').'?category_id='.$news->category_id;
        return redirect($redirect)->with('status', 'Lưu thông tin thành công');
    }

    public function delete($category_id){
        News::where('id', $category_id)->delete();
        return redirect()->back()->with('status', 'Xóa thông tin thành công');
    }


}
