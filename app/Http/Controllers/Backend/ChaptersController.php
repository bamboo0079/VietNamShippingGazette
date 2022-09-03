<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Helper;
use App\Models\Audio;
use App\Models\Step;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class ChaptersController extends Controller
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
        $chapter = Chapter::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $chapter->where('name','like', '%'.$submit_data['title'].'%');
        }
        if (isset($submit_data['book_id']) && $submit_data['book_id'] != -1) {
            $chapter->where('book_id', $submit_data['book_id']);
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $chapter->where('public', $submit_data['status']);
        }

        /*$data['chapters'] = $chapter->orderBy('book_id', 'ASC')
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'ASC')->paginate($this->limit);*/

        $data['chapters'] = $chapter->orderBy('book_id', 'DESC')->orderBy('id', 'DESC')->paginate($this->limit);
        $data['books'] = Book::orderBy('order','ASC')->get();
        return view('backend.chapters.index', $data);
    }

    public function summary(Request $request, $chapter_id = 0)
    {
        $data = [];
        $chapter = Chapter::where('id', $chapter_id)->first();
        if (!$chapter) {
            abort(404);
        }
        $data['chapter'] = $chapter;
        // get list san pham
        $audio_list = Audio::where('chapter_id', $chapter_id)->get()->pluck('id')->toArray();
        $data['steps'] = Step::where('type_id',5)->whereIn('audio_id', $audio_list)->get();
        return view('backend.chapters.summary', $data);
    }

    public function add(Request $request, $chapter_id = 0)
    {
        $data = [];
        $data['books'] = Book::orderBy('order','ASC')->get();
        return view('backend.chapters.edit', $data);
    }

    public function detail(Request $request, $chapter_id = 0)
    {
        $data = [];
        $chapter = Chapter::where('id', $chapter_id)->first();
        if (!$chapter) {
            abort(404);
        }
        $data['chapter'] = $chapter;
        $data['chapter_list'] = Chapter::where('book_id', $chapter->book_id)->/*where('id','<>', $chapter_id)->*/where('public', 1)->orderBy('order','ASC')->get();
        $data['next_book'] = Book::where('order','>',$chapter->book->order)->where('public',1)->orderBy('order','ASC')->first();
        if($data['next_book']){
            $data['next_chapter'] = Chapter::where('book_id',$data['next_book']->id)->where('public',1)->orderBy('order','ASC')->first();
        }
        $data['books'] = Book::orderBy('order','ASC')->get();
        return view('backend.chapters.detail', $data);
    }

    public function process(Request $request, $chapter_id = 0)
    {

        $data = $request->all();
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
        if (isset($data['id']) && $data['id']) {
            Chapter::where('id', $data['id'])->update([
                'name' => $data['name'],
                'title' => $data['title'],
                'book_id' => $data['book_id'],
                'public' => isset($data['public']) ? $data['public'] : 0,
            ]);
        }else{
            $chapter = Chapter::where('book_id', $data['book_id'])->orderBy('order', 'DESC')->first();
            $order = 1;
            if(isset($chapter->order)){
                $order = $chapter->order + 1;
            }
            Chapter::create([
                'name' => $data['name'],
                'title' => $data['title'],
                'book_id' => $data['book_id'],
                'order' => $order,
                'public' => 1,
            ]);
        }
        return redirect()->route('admin.chapter')->with('status', 'Lưu thông tin thành công');
    }

    public function ajaxChapterByBook($book_id){
        $data['chapters'] = Chapter::where('book_id', $book_id)->orderBy('order', 'ASC')->get();
        return view('backend.chapters.ajax', $data);
    }
    public function truncate(){
        Chapter::truncate();
        Book::where('id','>',0)->update(['public' => 0]);
        return redirect()->back();
    }

}
