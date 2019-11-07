<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function logout($request, $guard = null){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            //$request->session()->invalidate();
            $logout= 'admin.login';
        } else {
            Auth::guard('web')->logout();
            $logout= 'login';
        }
        
        //return redirect($logout);
        return redirect()->route($logout);
    }
}
