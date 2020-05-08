@extends('app')
@section('title', "SocialHub | " . $userProfile->username)
@section('body')
    <div class="img-fluid w-100 vertical-center text-md-left text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container position-relative" style="top:10vh">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold"><img src="@if( $userProfile->avatar ){{action('ProfileController@loadProfileAvatar', $userProfile->id)}}@else{{asset('img/default-avatar.png')}}@endif" class="rounded-circle border bg-white" height="200px" width="200px"/></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 col-12 mt-5">
                <div class="mt-5">
                    <h4 class="font-weight-bold mb-0">{{ $userProfile->name }} @if($userProfile->verified)<img src="{{ asset('img/imagecheck.svg') }}" style="height: 20px"/>@endif</h4>
                    <h6 class="text-muted mb-3">&commat;{{ $userProfile->username }}</h6>
                    <p class="mb-1">@if( $userProfile->bio ) {{ $userProfile->bio }} @endif</p>
                    <p>
                        <a href="{{ action('ProfileController@loadFollowersPage', $userProfile->username) }}">
                            <strong>{{$userProfile->followers()->count() }}</strong> <span class="text-muted">followers</span>
                        </a>
                        <a href="{{ action('ProfileController@loadFollowingsPage', $userProfile->username) }}">
                            <strong class="ml-3">{{ $userProfile->followings()->count() }}</strong> <span class="text-muted">following</span>
                        </a>
                    </p>
                </div>
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                @if(\Illuminate\Support\Facades\Auth::user()->username == $userProfile->username)
                    <div class="col-md-6 col-12 text-md-right">
                        <a class="btn btn-outline-primary text-primary" href="{{ action('ProfileController@loadEditProfilePage', \Illuminate\Support\Facades\Auth::user()->username) }}">Edit profile</a>
                    </div>
                @else
                    @if(!\Illuminate\Support\Facades\Auth::user()->followings->contains($userProfile->id))
                        <div class="col-md-6 col-12 text-md-right">
                            <a class="btn btn-primary text-white" href="{{ action('ProfileController@followProfile', $userProfile->username) }}">Follow</a>
                        </div>
                    @else
                        <div class="col-md-6 col-12 text-md-right">
                            <a class="btn btn-outline-primary text-primary" href="{{ action('ProfileController@unfollowProfile', $userProfile->username) }}">Unfollow</a>
                        </div>
                    @endif
                    {{-- Check here if the user is followed or not and place the correct button --}}
                @endif
            @endif
        </div>
        @include('flash::message')
        <hr/>
        <div class="row">
            @forelse($userProfile->posts()->orderBy('created_at', 'desc')->get() as $post)
                <div class="col-md-3 col-4 p-1">
                    <a href="#">
                        <div class="image w-100 position-relative overflow-hidden" style="padding-bottom: 100%;">
                            <a href="{{ action('WallController@loadPostDetailsPage', $post->id) }}">
                                <img src="{{action('WallController@loadPostImage', $post->id)}}" class="w-100 img-fluid position-absolute"/>
                            </a>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col">
                    <div class="card w-100">
                        <div class="card-body w-100">
                            <p class="text-center mt-2 mb-2">{{ __('language.nopostsprofile') }}</p>
                        </div>
                    </div>
                </div>
            @endforelse

        </div>
    </div>
@endsection
