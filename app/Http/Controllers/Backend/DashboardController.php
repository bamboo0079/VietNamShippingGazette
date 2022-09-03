<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use Session;
use Illuminate\Support\Facades\App;

class DashboardController extends Controller
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
        $user = User::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $user->where(function ($q) use ($submit_data) {
                $q->where('name', 'like', '%' . $submit_data['title'] . '%')
                    ->orWhere('email', 'like', '%' . $submit_data['title'] . '%');
            });
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $user->where('block', $submit_data['status']);
        }

        $data['users'] = $user->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.users.index', $data);
    }

    public function howToUse(Request $request){
        $data = [];
        if($request->isMethod('post')){
            $submit_data = $request->all();
            Setting::saveData($submit_data);
        }
        $data['setting'] = Setting::where('id','>', 0)->first();

        return view('backend.pages.how_to_use', $data);
    }
    public function language(Request $request, $lang = 'vi'){
        if($lang == 'en'){
            App::setLocale('en');
            Session::put('locale', 'en');
        }else{
            App::setLocale('vi');
            Session::put('locale', 'vi');
        }
        return redirect()->back();
    }

}
