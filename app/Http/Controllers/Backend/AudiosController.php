<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Notify;
use App\Models\Step;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Book;
use App\Models\Audio;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;

class AudiosController extends Controller
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
        $audio = Audio::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $audio->where('name','like', '%'.$submit_data['title'].'%');
        }
        if (isset($submit_data['book_id']) && $submit_data['book_id'] != -1) {
            $audio->where('book_id', $submit_data['book_id']);
        }else{
            $submit_data['book_id'] = -1;
        }
        if (isset($submit_data['chapter_id']) && $submit_data['chapter_id'] != -1) {
            $audio->where('chapter_id', $submit_data['chapter_id']);
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $audio->where('public', $submit_data['status']);
        }

        $data['audios'] = $audio->orderBy('id', 'DESC')->paginate($this->limit);
        $data['books'] = Book::orderBy('order','ASC')->get();
        $data['chapters'] = Chapter::where('book_id', $submit_data['book_id'])->orderBy('order','ASC')->get();
        return view('backend.audios.index', $data);
    }

    public function scanqr(Request $request)
    {
        $submit_data = $request->all();
        $data['limit'] = $this->limit;
        $audio = Audio::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $audio->where('name','like', '%'.$submit_data['title'].'%');
        }
        if (isset($submit_data['book_id']) && $submit_data['book_id'] != -1) {
            $audio->where('book_id', $submit_data['book_id']);
        }else{
            $submit_data['book_id'] = -1;
        }
        if (isset($submit_data['chapter_id']) && $submit_data['chapter_id'] != -1) {
            $audio->where('chapter_id', $submit_data['chapter_id']);
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $audio->where('public', $submit_data['status']);
        }

        $data['audios'] = $audio->orderBy('id', 'DESC')->paginate($this->limit);
        $data['books'] = Book::orderBy('order','ASC')->get();
        $data['chapters'] = Chapter::where('book_id', $submit_data['book_id'])->orderBy('order','ASC')->get();
        return view('backend.audios.scanqr', $data);
    }

    public function add(Request $request, $chapter_id = 0)
    {
        $data = [];
        $data['books'] = Book::orderBy('order','ASC')->get();
        $data['chapters'] = Chapter::orderBy('order','ASC')->get();
        $data['categories'] = Category::orderBy('id','ASC')->get();
        return view('backend.audios.edit', $data);
    }

    public function detail(Request $request, $chapter_id = 0)
    {
        $data = [];
        $audio = Audio::where('id', $chapter_id)->first();
        if (!$audio) {
            abort(404);
        }
        $data['audio'] = $audio;
        $data['books'] = Book::orderBy('order','ASC')->get();
        $data['chapters'] = Chapter::orderBy('order','ASC')->get();
        $data['categories'] = Category::orderBy('id','ASC')->get();
        $encode = urlencode(url('/san-pham/'.$chapter_id));
        $url = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$encode.'&choe=UTF-8';
        $img = public_path().'/qrcode/'.$chapter_id.'.png';
        file_put_contents($img, file_get_contents($url));
        $data['qr_link'] = '/qrcode/'.$chapter_id.'.png';
        return view('backend.audios.detail', $data);
    }

    public function process(Request $request, $chapter_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        if (isset($data['id']) && $data['id']) {
            $update = [
                'name' => $data['name'],
                'book_id' => $data['book_id'],
                'chapter_id' => $data['chapter_id'],
                'category_id' => $data['category_id'],
                'expected_quantity' => $data['expected_quantity'],
                'harvest_date' => $data['harvest_date'],
                'public' => isset($data['public']) ? $data['public'] : 1,
            ];
            if($request->hasFile('images'))
            {
                $files = $request->file('images');
                foreach ($files as $key => $file) {
                    $col = $key+1;
                    $update['image'.$col] = $file->store('images');
                }
            }
            Audio::where('id', $data['id'])->update($update);
        }else{
            Audio::create([
                'name' => $data['name'],
                'book_id' => $data['book_id'],
                'chapter_id' => $data['chapter_id'],
                'category_id' => $data['category_id'],
                'expected_quantity' => $data['expected_quantity'],
                'harvest_date' => ($data['harvest_date'])?$data['harvest_date']:null,
            ]);
        }

        return redirect()->route('admin.audio')->with('status', 'Lưu thông tin thành công');
    }
    public function truncate(){
        Audio::truncate();
        return redirect()->back();
    }



    public function addStep(Request $request, $audio_id = 0, $step_id = 0)
    {
        $data = [];
        $data['books'] = Book::orderBy('order','ASC')->get();
        $data['chapters'] = Chapter::orderBy('order','ASC')->get();
        $data['types'] = Type::orderBy('order','ASC')->get();
        $data['audio'] = Audio::where('id', $audio_id)->first();
        $data['step'] = Step::where('id', $step_id)->first();
        $data['audio_id'] = $audio_id;
        $list_phan_bon = Comment::get()->pluck('name')->toArray();
        $txt_phan_bon = '';
        foreach ($list_phan_bon as $phan_bon){
            $txt_phan_bon .= '"'.$phan_bon.'", ';
        }
        $txt_phan_bon = trim($txt_phan_bon, ', ');
        $list_dung_dich = Notify::get()->pluck('name')->toArray();
        $txt_dung_dich = '';
        foreach ($list_dung_dich as $dung_dich){
            $txt_dung_dich .= '"'.$dung_dich.'", ';
        }
        $txt_dung_dich = trim($txt_dung_dich, ', ');
        $data['txt_phan_bon'] = $txt_phan_bon;
        $data['txt_dung_dich'] = $txt_dung_dich;
        return view('backend.audios.edit_step', $data);
    }

    public function processStep(Request $request, $chapter_id = 0)
    {

        $data = $request->all();
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
        ]);
        if (isset($data['id']) && $data['id']) {
            Step::where('id', $data['id'])->update([
                'content' => $data['content'],
                'quantity' => $data['quantity'],
                'quantity_number' => preg_replace("/[^0-9]/", "", $data['quantity'] ),
                'area' => $data['area'],
                'audio_id' => $data['audio_id'],
                'type_id' => $data['type_id'],
                'do_date' => $data['do_date'],
                'status' => $data['status'],
                'summary' => $data['summary'],
                'result' => $data['result'],
                'public' => isset($data['public']) ? $data['public'] : 1,
            ]);

        }else{
            Step::create([
                'content' => $data['content'],
                'quantity' => $data['quantity'],
                'quantity_number' => preg_replace("/[^0-9]/", "", $data['quantity'] ),
                'area' => $data['area'],
                'audio_id' => $data['audio_id'],
                'type_id' => $data['type_id'],
                'do_date' => $data['do_date'],
                'status' => $data['status'],
                'summary' => $data['summary'],
                'result' => $data['result'],
                'public' => isset($data['public']) ? $data['public'] : 1,
            ]);
        }

        return redirect()->route('admin.audio.detail', $data['audio_id'])->with('status', 'Lưu thông tin thành công');
    }


}
