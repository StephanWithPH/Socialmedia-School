<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function createComment(Request $request){
        $validator = Validator::make($request->all(), [
            'commenttext' => ['required', 'string', 'max:100'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $post = Post::find($request->postid);
        $comment = new Comment();
        $comment->user()->associate(Auth::user());
        $comment->post()->associate($post);
        $comment->text = $request->commenttext;
        $comment->save();

        flash('Successfully created comment!')->success();
        return redirect()->back();
    }
}
