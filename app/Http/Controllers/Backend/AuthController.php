<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use Hash;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Cookie;
class AuthController extends Controller
{
    public function getLogin(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('admin.dashboard');
        }
        return view('backend.login');
    }

    public function postLogin(Request $request)
    {
        $password = $request->get('password');
        $email = $request->get('email');
        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            if($user->block == 1){
                Auth::guard('admin')->logout();
                Auth::guard('web')->logout();
                throw ValidationException::withMessages([
                    'email' => ['Tài khoản bị khóa'],
                ]);
                return redirect()->back();
            }
            return redirect(route('admin.dashboard'));
        }
        throw ValidationException::withMessages([
            'email' => ['Email hoặc mật khẩu không chính xác'],
        ]);
        return redirect()->back();
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }

}
