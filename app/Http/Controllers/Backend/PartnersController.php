<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\News;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class PartnersController extends Controller
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
        $data['limit'] = $this->limit;
        $book = Partner::where('type', 1);
        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.partners.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        return view('backend.partners.edit', $data);
    }

    public function detail(Request $request, $book_id = 0)
    {
        $data = [];
        $book = Partner::where('id', $book_id)->first();
        if (!$book) {
            abort(404);
        }
        $data['book'] = $book;
        return view('backend.partners.detail', $data);
    }

    public function newesetDetail(Request $request)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = $request->all();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'link' => ['required', 'string', 'max:255'],
            ]);
            if($request->has('img')){
                $data['img'] = '/'.request()->file('img')->store('certificates','public');
            }else{
                $data['img'] = '';
            }
            $update = [
                'name' => $data['name'],
                'link' => $data['link'],
                'is_show' => $data['is_show'],
            ];
            if($data['img']){
                $update['img'] = $data['img'];
            }
            Partner::where('id', $data['id'])->update($update);
            return redirect()->back()->with('status', 'Lưu thông tin thành công');
        }

        $data = [];
        $book = Partner::where('type', 2)->first();
        if (!$book) {
            abort(404);
        }
        $data['book'] = $book;
        return view('backend.partners.newestdetail', $data);
    }

    public function process(Request $request, $book_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'title_vn' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'link' => ['required', 'string', 'max:255'],
        ]);
        if($request->has('img')){
            $extension = $request->file('img')->extension();
            $file_name = uniqid().'.'.$extension;
            $data['img'] = '/'.request()->file('img')->storeAs('certificates',$file_name,'public');
        }else{
            $data['img'] = '';
        }
        if (isset($data['id']) && $data['id']) {
            $update = [
                'title_vn' => $data['title_vn'],
                'title_en' => $data['title_vn'],
                'content_vn' => $data['content_vn'],
                'content_en' => $data['content_en'],
                'link' => $data['link'],
            ];
            if($data['img']){
                $update['img'] = $data['img'];
            }
            Partner::where('id', $data['id'])->update($update);
        } else {
            Partner::create([
                'title_vn' => $data['title_vn'],
                'title_en' => $data['title_en'],
                'content_vn' => $data['content_vn'],
                'content_en' => $data['content_en'],
                'link' => $data['link'],
                'img' => $data['img'],
            ]);
        }
        return redirect()->route('admin.partners')->with('status', 'Lưu thông tin thành công');
    }

    public function delete($category_id){
        Partner::where('id', $category_id)->delete();
        return redirect()->route('admin.partners')->with('status', 'Xóa thông tin thành công');
    }

    public function updateConfig(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
//            print_r($data);die;
            if($request->has('img1')){
                $data['img1'] = '/'.request()->file('img1')->storeAs('images','header_banner.jpg'/*,'public'*/);
            }
            if($request->has('img2')){
                $data['img2'] = '/'.request()->file('img2')->storeAs('images','left_banner.jpg'/*,'public'*/);
            }
            if($request->has('img3')){
                $data['img3'] = '/'.request()->file('img3')->storeAs('images','right_banner.jpg'/*,'public'*/);
            }
            unset($data['_token']);

            $data_final = file_get_contents(public_path().'/config.json');
            $data_final = json_decode($data_final, true);
            foreach ($data as $key => $item){
                $data_final[$key] = $item;
            }
            $json = json_encode($data_final);
            file_put_contents(public_path().'/config.json', $json);
        }
        $data = file_get_contents(public_path().'/config.json');
        $data = json_decode($data, true);
//        print_r($data);die;
        return view('backend.configs.detail', $data);
    }

}
