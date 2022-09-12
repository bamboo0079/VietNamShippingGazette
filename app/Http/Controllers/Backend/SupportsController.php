<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Support;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class SupportsController extends Controller
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
        $book = Support::where('id', '>' ,0);
        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.supports.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        return view('backend.supports.edit', $data);
    }

    public function detail(Request $request, $book_id = 0)
    {
        $data = [];
        $book = Support::where('id', $book_id)->first();
        if (!$book) {
            abort(404);
        }
        $data['book'] = $book;
        return view('backend.supports.detail', $data);
    }

    public function process(Request $request, $book_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        if (isset($data['id']) && $data['id']) {
            $update = [
                'name' => $data['name'],
                'zalo' => $data['zalo'],
                'skype' => $data['skype'],
                'phone' => $data['phone'],
                'sex' => $data['sex'],
                'is_show' => isset($data['is_show'])?$data['is_show']:1,
            ];
            Support::where('id', $data['id'])->update($update);
        } else {
            Support::create([
                'name' => $data['name'],
                'zalo' => $data['zalo'],
                'skype' => $data['skype'],
                'phone' => $data['phone'],
                'sex' => $data['sex'],
                'is_show' => isset($data['is_show'])?$data['is_show']:1
            ]);
        }
        return redirect()->route('admin.supports')->with('status', 'Lưu thông tin thành công');
    }


}
