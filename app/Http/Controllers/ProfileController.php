<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function loadProfilePage($username)
    {
        $userProfile = User::where('username', $username)->first();

        return view('pages.profile', compact('userProfile'));
    }

    public function loadEditProfilePage($username){
        if ($username == Auth::user()->username){
            $userProfile = User::where('username', $username)->first();
            return view('pages.editprofile', compact('userProfile'));
            // return to edit profile page
        }
        else{
            // Return back to previous page because of no access
            flash(__('language.noaccess'))->error();
            return redirect()->action('WallController@loadWallPage');
        }
    }

    public function submitEditProfile(Request $request){
        if (Auth::user()->username == $request->submitteduser){
            $userProfile = User::where('username', $request->submitteduser)->first();
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'min:3', 'max:20', 'unique:users,username,' . $userProfile->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'  . $userProfile->id],
                'bio' => ['nullable', 'string', 'max:155'],
                'avatar' => ['nullable', 'image', 'file'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if ($request->avatar != null){
                $path = Storage::put($userProfile->email, $request->file('avatar'));
                $userProfile->avatar = $path;
            }

            // Store the user...
            $userProfile->name = $request->name;
            $userProfile->username = $request->username;
            $userProfile->email = $request->email;
            $userProfile->bio = $request->bio;
            $userProfile->save();

        flash(__('language.successfuledit'))->success();
        return redirect()->action('ProfileController@loadEditProfilePage', $userProfile->username);
        }
        else {
            flash(__('language.somethingwrong'))->error();
            return redirect()->back();
        }

    }

    public function loadProfileAvatar($id){
        $user = User::find($id);
        if ($user->avatar != null){
            $image = Storage::get($user->avatar);
            $type = Storage::mimeType($user->avatar);
            return response()->make($image, 200, ['content-type' => $type]);
        }
    }

    public function followProfile($username){
        $userProfile = User::where('username', $username)->first();
        if (Auth::user()->username != $username){
            if (!\Illuminate\Support\Facades\Auth::user()->followings->contains($userProfile->id)){
                Auth::user()->followings()->attach($userProfile);
                Auth::user()->save();
            }
        }
        return redirect()->back();
    }

    public function unfollowProfile($username){
        $userProfile = User::where('username', $username)->first();
        if (Auth::user()->username != $username){
            if (\Illuminate\Support\Facades\Auth::user()->followings->contains($userProfile->id)){
                Auth::user()->followings()->detach($userProfile);
                Auth::user()->save();
            }
        }
        return redirect()->back();
    }

    public function loadFollowersPage($username){
        $userProfile = User::where('username', $username)->first();
        return view('pages.followers', compact('userProfile'));
    }

    public function loadFollowingsPage($username){
        $userProfile = User::where('username', $username)->first();
        return view('pages.followings', compact('userProfile'));
    }


}
