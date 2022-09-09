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
class VSGNewsController extends Controller
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
        $submit_data['category_id'] = 2;
        if (isset($submit_data['category_id']) && $submit_data['category_id']) {
            $book->where('category_id', $submit_data['category_id']);
        }
        if (isset($submit_data['title']) && $submit_data['title']) {
            $book->where('title_vn', 'like', '%' . $submit_data['title'] . '%');
            $book->orWhere('title_en', 'like', '%' . $submit_data['title'] . '%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $book->where('approved', $submit_data['status']);
        }

        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.vsg.index', $data);
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
        return view('backend.vsg.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        $data['categories'] = Category::orderBy('order', 'ASC')->get();
        $data['productcategories'] = ProductCategory::orderBy('order', 'ASC')->get();
        return view('backend.vsg.edit', $data);
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
        return view('backend.vsg.detail', $data);
    }

    public function process(Request $request, $book_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'title_vn' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
        ]);
        if($request->has('img')){
            $extension = $request->file('img')->extension();
            $file_name = uniqid().'.'.$extension;
            $data['img'] = '/'.request()->file('img')->storeAs('certificates',$file_name,'public');
        }else{
            $data['img'] = '';
        }
        if(isset($data['youtube_url']) && strpos($data['youtube_url'], 'v=') !== false){
            $url = $data['youtube_url'];
            parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
            $data['youtube_url'] =  'https://www.youtube.com/embed/'.$my_array_of_vars['v'];
        }
        if (isset($data['id']) && $data['id']) {
            $update = [
                'title_vn' => $data['title_vn'],
                'title_en' => $data['title_en'],
                'category_id' => $data['category_id'],
                'product_category_id' => $data['product_category_id'],
                'content_vn' => $data['content_vn'],
                'content_en' => $data['content_en'],
                'youtube_url' => $data['youtube_url'],
                'approved' => isset($data['approved']) ? $data['approved'] : 1,
                'is_hot' => isset($data['is_hot']) ? $data['is_hot'] : 0,
                'is_new' => isset($data['is_new']) ? $data['is_new'] : 0,
                'is_paid' => isset($data['is_paid']) ? $data['is_paid'] : 0,
            ];
            if($data['img']){
                $update['img'] = $data['img'];
            }
            News::where('id', $data['id'])->update($update);
        } else {
            News::create([
                'title_vn' => $data['title_vn'],
                'title_en' => $data['title_en'],
                'category_id' => $data['category_id'],
                'product_category_id' => $data['product_category_id'],
                'content_vn' => $data['content_vn'],
                'content_en' => $data['content_en'],
                'youtube_url' => $data['youtube_url'],
                'img' => $data['img'],
                'approved' => isset($data['approved']) ? $data['approved'] : 1,
                'is_hot' => isset($data['is_hot']) ? $data['is_hot'] : 0,
                'is_new' => isset($data['is_new']) ? $data['is_new'] : 0,
                'is_paid' => isset($data['is_paid']) ? $data['is_paid'] : 0,
            ]);
        }
        return redirect()->route('admin.vsg.news')->with('status', 'Lưu thông tin thành công');
    }

    public function delete($category_id){
        News::where('id', $category_id)->delete();
        return redirect()->back()->with('status', 'Xóa thông tin thành công');
    }


}
