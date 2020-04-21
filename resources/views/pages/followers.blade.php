@extends('app')
@section('title', "SocialHub | " . $userProfile->username . "'s followers")
@section('body')
    <div class="img-fluid w-100 vertical-center text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold">{{ $userProfile->username }}'s followers</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @include('flash::message')
            @forelse($userProfile->followers as $follower)
                <div class="row mt-2 mb-2">
                    <div class="col-2 vertical-center" style="height: 7vh;">
                        <img src="@if( $follower->avatar ){{action('ProfileController@loadProfileAvatar', $follower->id)}}@else{{asset('img/default-avatar.png')}}@endif" class="rounded-circle border h-100"/>
                    </div>
                    <div class="col vertical-center" style="height: 7vh">
                        <a class="text-primary font-weight-bold" href="{{ action('ProfileController@loadProfilePage', $follower->username) }}">{{ $follower->username }}</a>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        @if(!\Illuminate\Support\Facades\Auth::user()->followings->contains($follower->id))
                            <div class="col text-right vertical-center" style="height: 7vh;">
                                <a class="btn btn-primary text-white ml-auto" href="{{ action('ProfileController@followProfile', $follower->username) }}">Follow</a>
                            </div>
                        @else
                            <div class="col text-right vertical-center" style="height: 7vh;">
                                <a class="btn btn-outline-primary text-primary ml-auto" href="{{ action('ProfileController@unfollowProfile', $follower->username) }}">Unfollow</a>
                            </div>
                        @endif
                    @endif
                </div>
                @empty
                <div class="row">
                    <div class="col">
                        <div class="card w-100">
                            <div class="card-body w-100">
                                {{ __('language.nofollowersfound') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse

    </div>
@endsection
