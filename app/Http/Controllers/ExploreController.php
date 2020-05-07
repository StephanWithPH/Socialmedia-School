<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ExploreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function loadExplorePage()
    {
        return view('pages.explore');
    }

    public function searchByUsername(Request $request){
        $users = User::where('username', 'LIKE', '%'.$request->username.'%')->get();
        if (count($users) != 0){
            return view('components.searchresults', compact('users'));
        }
        else {
            return view('components.noresults');
        }

    }
}
