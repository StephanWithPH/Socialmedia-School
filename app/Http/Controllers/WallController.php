<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function createPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uploadedfiletext' => ['required', 'string', 'max:200'],
            'uploadedimage' => ['required', 'image', 'file'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post();
        $path = Storage::put(Auth::user()->email, $request->file('uploadedimage'));
        $post->image = $path;
        $post->text = $request->uploadedfiletext;
        $post->user()->associate(Auth::user());
        $post->save();

        flash('Successfully created post!')->success();
        return redirect()->back();
    }

    public function loadPostImage($id){
        $post = Post::find($id);
        if ($post->image != null){
            $image = Storage::get($post->image);
            $type = Storage::mimeType($post->image);
            return response()->make($image, 200, ['content-type' => $type]);
        }
    }
}
