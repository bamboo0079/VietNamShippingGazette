<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Hash;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
class AuthController extends Controller
{
    public function getLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.index');
        }

        return view('backend.login');
    }

    public function postLogin(Request $request)
    {
        $password = $request->get('password');
        $email = $request->get('email');

        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return redirect(route('admin.index'));
        }
        return redirect()->back()->withInput()->with('errors', 'Login failed, please try again!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        \Session::flush();
        return redirect()->route('admin.login');
    }

}
