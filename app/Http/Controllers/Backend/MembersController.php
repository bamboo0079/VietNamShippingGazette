<?php

namespace App\Http\Controllers\Backend;

use App\Models\Card;
use App\Models\Comment;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use App\Helpers;
class MembersController extends Controller
{
    var $limit = 10;

    public function __construct()
    {
        if (!Auth::check()) {
            return redirect('/admin/login/');
        }
    }

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/admin/login/');
        }
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
            $user->where('active', $submit_data['status']);
        }

        $data['users'] = $user->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.users.index', $data);
    }

    public function member(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/admin/login/');
        }
        $submit_data = $request->all();
        $data['limit'] = $this->limit;
        $user = Member::where('id','>', 0);
        if (isset($submit_data['title']) && $submit_data['title']) {
            $user->where(function ($q) use ($submit_data) {
                $q->where('name', 'like', '%' . $submit_data['title'] . '%')
                    ->orWhere('email', 'like', '%' . $submit_data['title'] . '%');
            });
        }
        if (isset($submit_data['status']) && $submit_data['status'] != -1) {
            $user->where('active', $submit_data['status']);
        }

        $data['users'] = $user->orderBy('id', 'DESC')->paginate($this->limit);
        return view('backend.members.index', $data);
    }

    public function addUser(Request $request, $user_id = 0)
    {
        $data = [];
        return view('backend.users.edit', $data);
    }

    public function userDetail(Request $request, $user_id = 0)
    {
        $data = [];
        $user = User::where('id', $user_id)->first();
        if (!$user) {
            abort(404);
        }
        $data['user'] = $user;
        $data['limit'] = $this->limit;

        return view('backend.users.detail', $data);
    }

    public function memberDetail(Request $request, $user_id = 0)
    {
        $data = [];
        $user = Member::where('id', $user_id)->first();
        if (!$user) {
            abort(404);
        }
        $data['user'] = $user;
        $data['limit'] = $this->limit;

        return view('backend.members.detail', $data);
    }

    public function processUser(Request $request, $user_id = 0)
    {

        $data = $request->all();
        if (isset($data['id']) && $data['id']) {
            $validate = [
                'name' => ['required', 'string', 'max:255'],
            ];
            $current_user = User::where('id', $data['id'])->first();
            if ($current_user->email != $data['email']) {
                $validate['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            }
            $request->validate($validate);
            $update = [
                'name' => $data['name'],
                'email' => $data['email'],
                'tel' => isset($data['tel'])?$data['tel']:'',
                'role' => $data['role'],
                'block' => isset($data['block']) ? $data['block'] : 0,
            ];
            if(isset($data['password']) && strlen($data['password']) > 5){
                $update['password'] = md5($data['password']);
            }

            User::where('id', $data['id'])->update($update);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'tel' => ['string', 'max:255'],
                'role' => ['string', 'max:255'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'tel' => isset($data['tel'])?$data['tel']:'',
                'role' => $data['role'],
                'password' => md5($data['password']),
            ]);
        }

        return redirect()->route('admin.dashboard')->with('status', 'Lưu thành công');
    }

    public function processMember(Request $request, $user_id = 0)
    {

        $data = $request->all();
        if (isset($data['id']) && $data['id']) {
            $validate = [
                'name' => ['required', 'string', 'max:255'],
            ];
            $current_user = Member::where('id', $data['id'])->first();
            if ($current_user->email != $data['email']) {
                $validate['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
            }
            $request->validate($validate);
            $update = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => isset($data['tel'])?$data['tel']:'',
//                'role' => $data['role'],
                'active' => isset($data['block']) ? $data['block'] : 0,
            ];
            if(isset($data['password']) && strlen($data['password']) > 5){
                $update['password'] = md5($data['password']);
            }
            Member::where('id', $data['id'])->update($update);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'tel' => ['string', 'max:255'],
                'role' => ['string', 'max:255'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $user = Member::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => isset($data['tel'])?$data['tel']:'',
//                'role' => $data['role'],
                'password' => md5($data['password']),
            ]);
        }

        return redirect()->route('admin.member')->with('status', 'Lưu thành công');
    }

    public function delete($category_id){
        User::where('id', $category_id)->delete();
        return redirect()->route('admin.dashboard')->with('status', 'Xóa thông tin thành công');
    }

    public function memberDelete($category_id){
        Member::where('id', $category_id)->delete();
        return redirect()->route('admin.member')->with('status', 'Xóa thông tin thành công');
    }


}
