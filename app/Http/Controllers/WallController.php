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
        return view('pages.wall');
    }

    public function createPost()
    {
        flash('Successfully created post!')->success();
        return redirect()->back();
    }
}
