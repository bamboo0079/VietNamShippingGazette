<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\UserNotify;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use App\Models\WhereHouse;
use App\Models\WhereHouseHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;

class WherehousesController extends Controller
{
    var $limit = 20;

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
        $book = WhereHouse::where('id', '>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $book->where('name', 'like', '%' . $submit_data['title'] . '%');
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            if($submit_data['status'] == 1){
                $book->where('qty', '>', 0);
            }else{
                $book->where('qty', 0);
            }
        }

        $data['books'] = $book->orderBy('updated_at', 'DESC')->paginate($this->limit);
        return view('backend.wherehouses.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        return view('backend.wherehouses.edit', $data);
    }

    public function detail(Request $request, $book_id = 0)
    {
        $data = [];
        $book = WhereHouse::where('id', $book_id)->first();
        if (!$book) {
            abort(404);
        }
        $data['histories'] = WhereHouseHistory::where('product_id', $book_id)->orderBy('id','DESC')->get();
        $data['book'] = $book;
        return view('backend.wherehouses.detail', $data);
    }

    public function process(Request $request, $book_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'numeric'],
            'unit' => ['required', 'string', 'max:255'],
        ]);
        if (isset($data['id']) && $data['id']) {
            WhereHouse::where('id', $data['id'])->update([
                'name' => $data['name'],
                'qty' => $data['qty'],
                'unit' => $data['unit'],
            ]);
        } else {
            WhereHouse::create([
                'name' => $data['name'],
                'qty' => $data['qty'],
                'unit' => $data['unit'],
            ]);
        }
        return redirect()->route('admin.wherehouse')->with('status', 'Lưu thông tin thành công');
    }

    public function addStep(Request $request, $product_id = 0)
    {
        $data = [];
        $data['wherehouse'] = WhereHouse::where('id', $product_id)->first();
        $data['product_id'] = $product_id;
        return view('backend.wherehouses.edit_step', $data);
    }
    public function processStep(Request $request, $chapter_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'pic' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'numeric'],
            'product_id' => ['required'],
        ]);
        if (isset($data['id']) && $data['id']) {
            WhereHouseHistory::where('id', $data['id'])->update([
                'pic' => $data['pic'],
                'qty' => $data['qty'],
                'note' => $data['note'],
                'do_date' => $data['do_date'],
                'product_id' => $data['product_id'],
                'is_input' => $data['is_input'],
            ]);

        }else{
            if($data['is_input'] == 1){
                $wh = WhereHouse::where('id', $data['product_id'])->first();
                $wh->qty = $wh->qty + $data['qty'];
                $wh->save();
            }else{
                $wh = WhereHouse::where('id', $data['product_id'])->first();
                $wh->qty = $wh->qty - $data['qty'];
                $wh->save();
            }
            WhereHouseHistory::create([
                'pic' => $data['pic'],
                'qty' => $data['qty'],
                'note' => $data['note'],
                'do_date' => $data['do_date'],
                'product_id' => $data['product_id'],
                'is_input' => $data['is_input'],
            ]);
        }

        return redirect()->route('admin.wherehouse.detail', $data['product_id'])->with('status', 'Lưu thông tin thành công');
    }


}
