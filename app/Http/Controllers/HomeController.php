<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function loadHomePage()
    {
        if (Auth::check()){
            return redirect()->action('WallController@loadWallPage');
        }
        else {
            return view('pages.home');
        }
    }
}
