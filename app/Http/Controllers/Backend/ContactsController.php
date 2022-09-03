<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Support;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class ContactsController extends Controller
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
        $book = Contact::where('id', '>' ,0);
        $data['books'] = $book->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.contacts.index', $data);
    }

    public function add(Request $request, $book_id = 0)
    {
        $data = [];
        return view('backend.contacts.edit', $data);
    }

    public function detail(Request $request, $book_id = 0)
    {
        $data = [];
        $book = Contact::where('id', $book_id)->first();
        if (!$book) {
            abort(404);
        }
        $book->is_read = 1;
        $book->save();
        $data['book'] = $book;
        return view('backend.contacts.detail', $data);
    }


}
