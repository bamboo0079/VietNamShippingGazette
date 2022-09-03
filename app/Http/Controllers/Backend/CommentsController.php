<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use Illuminate\Support\Facades\Storage;


class CommentsController extends Controller
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
        $book = Comment::where('id', '>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $book->where('name', 'like', '%' . $submit_data['title'] . '%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $book->where('public', $submit_data['status']);
        }

        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.comments.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        return view('backend.comments.edit', $data);
    }

    public function detail(Request $request, $book_id = 0)
    {
        $data = [];
        $book = Comment::where('id', $book_id)->first();
        if (!$book) {
            abort(404);
        }
        $data['book'] = $book;
        return view('backend.comments.detail', $data);
    }

    public function process(Request $request, $book_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        if($request->has('certificate')){
            $data['certificate'] = request()->file('certificate')->store('certificates','public');
        }else{
            $data['certificate'] = '';
        }
        if($data['type'] == 1){
            $data['quantity'] = $data['quantity_2'];
            $data['do_date'] = $data['do_date_2'];
        }else{
            $data['exp_date'] = $data['exp_date_2'];
        }
        if (isset($data['id']) && $data['id']) {
            $update = [
                'name' => $data['name'],
                'type' => $data['type'],
                'material' => $data['material'],
                'process' => $data['process'],
                'finish_date' => $data['finish_date'],
                'factory' => $data['factory'],
                'quantity' => $data['quantity'],
                'do_date' => $data['do_date'],
                'exp_date' => $data['exp_date'],
                'public' => isset($data['block']) ? $data['block'] : 0,
            ];
            if($data['certificate']){
                $update['certificate'] = $data['certificate'];
            }
            Comment::where('id', $data['id'])->update($update);
        } else {
            Comment::create([
                'name' => $data['name'],
                'type' => $data['type'],
                'material' => $data['material'],
                'process' => $data['process'],
                'finish_date' => $data['finish_date'],
                'factory' => $data['factory'],
                'quantity' => $data['quantity'],
                'do_date' => $data['do_date'],
                'exp_date' => $data['exp_date'],
                'certificate' => $data['certificate'],
                'public' => 1,
            ]);
        }
        return redirect()->route('admin.comment')->with('status', 'Lưu thông tin thành công');
    }


}
