<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    /*protected $redirectTo = RouteServiceProvider::HOME;*/

    protected function authenticated() {
        if (Auth::check()) {
            if(Auth::user()->is_admin){
                return redirect('/admin');
            }
            else{
                if (Auth::check()) {
                    if(isset(session('url')['intended'])){
                        return redirect(session('url')['intended']);
                    }
                    else {
                        return redirect()->action('HomeController@loadHomePage');
                    }
                }
            }
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->action('HomeController@loadHomePage');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
