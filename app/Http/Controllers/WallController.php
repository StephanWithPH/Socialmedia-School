<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WallController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function loadWallPage()
    {
        return view('pages.home');
    }
}
