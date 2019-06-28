<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/dashboard2310';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /*public function authenticated(Request $request)
    {
        $users = User::where('id',\Auth::user()->id)->with(['roles'])->first();
        $rol = array_pluck($users->roles,'rol');
        if (in_array('Admin',$rol)){

            if ($request->input("json") === "true"){
                return "/dashboard2310";
            }

            return redirect('/dashboard2310');
        }else{

            if ($request->input("json") === "true"){
                return "/login";
            }

            return redirect('/login');
        }
    }*/
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }
}
