<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        if(isset($_COOKIE['cookie-app-kikuradio'])){
            Auth::loginUsingId($_COOKIE['cookie-app-kikuradio']);
        }
    }

    public function logout(Request $request){
        if(isset($_COOKIE['cookie-app-kikuradio'])){
            unset($_COOKIE['cookie-app-kikuradio']);
            setcookie('cookie-app-kikuradio', null, -1, '/');
        }
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    public function authenticated(Request $request)
    {
        $user = Auth::user();
        if(isset($user->id)){
            setcookie('cookie-app-kikuradio', $user->id, time() + (86400 * 30), "/");
        }
        if(isset($user->block) && ($user->block == 1 || $user->block == 3)){
            Auth::logout();
            throw ValidationException::withMessages([
                $this->username() => 'Tài khoản bị khóa',
            ]);
        }
    }
}
