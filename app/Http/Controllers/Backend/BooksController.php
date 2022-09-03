<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\UserNotify;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;

class BooksController extends Controller
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
        $book = Book::where('id', '>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $book->where('name', 'like', '%' . $submit_data['title'] . '%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $book->where('public', $submit_data['status']);
        }

        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.books.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        return view('backend.books.edit', $data);
    }

    public function detail(Request $request, $book_id = 0)
    {
        $data = [];
        $book = Book::where('id', $book_id)->first();
        if (!$book) {
            abort(404);
        }
        $data['book'] = $book;
        return view('backend.books.detail', $data);
    }

    public function process(Request $request, $book_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'pic' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
        ]);
        if (isset($data['id']) && $data['id']) {
            $update = [
                'name' => $data['name'],
                'pic' => $data['pic'],
                'tel' => $data['tel'],
                'addr' => $data['addr'],
                'content' => $data['content'],
                'area' => $data['area'],
                'public' => isset($data['block']) ? $data['block'] : 0,
            ];

            if($request->hasFile('images'))
            {
                $files = $request->file('images');
                foreach ($files as $key => $file) {
                    $col = $key+1;
                    if($col < 11){
                        $update['image'.$col] = $file->store('images');
                    }
                }
            }
            Book::where('id', $data['id'])->update($update);

        } else {
            $book = Book::orderBy('order', 'DESC')->first();
            $order = 1;
            if (isset($book->order)) {
                $order = $book->order + 1;
            }
            $update = [
                'name' => $data['name'],
                'pic' => $data['pic'],
                'tel' => $data['tel'],
                'order' => $order,
                'addr' => $data['addr'],
                'content' => $data['content'],
                'area' => $data['area'],
                'public' => 1,
            ];
            if($request->hasFile('images'))
            {
                $files = $request->file('images');
                foreach ($files as $key => $file) {
                    $col = $key+1;
                    if($col < 11){
                        $update['image'.$col] = $file->store('images');
                    }
                }
            }
            Book::create($update);
        }
        return redirect()->route('admin.book')->with('status', 'Lưu thông tin thành công');
    }


}
