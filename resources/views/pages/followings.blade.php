@extends('app')
@section('title', "SocialHub | " . $userProfile->username . "'s followings")
@section('body')
    <div class="img-fluid w-100 vertical-center text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold">{{ $userProfile->username }}'s followings</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @include('flash::message')
            @forelse($userProfile->followings as $following)
                <div class="row mt-2 mb-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body w-100">
                                <div class="row">
                                    <div class="col-4 vertical-center" style="height: 7vh;">
                                        <a class="text-primary font-weight-bold h-100" href="{{ action('ProfileController@loadProfilePage', $following->username) }}"><img src="@if( $following->avatar ){{action('ProfileController@loadProfileAvatar', $following->id)}}@else{{asset('img/default-avatar.png')}}@endif" class="rounded-circle border bg-white" style="object-fit: cover;" width="80px" height="80px"/></a>
                                    </div>
                                    <div class="col-4 vertical-center" style="height: 7vh">
                                        <a class="text-primary font-weight-bold" href="{{ action('ProfileController@loadProfilePage', $following->username) }}">{{ $following->username }}</a>
                                    </div>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        @if(\Illuminate\Support\Facades\Auth::user()->username != $following->username)
                                            @if(!\Illuminate\Support\Facades\Auth::user()->followings->contains($following->id))
                                                <div class="col-4 text-right vertical-center" style="height: 7vh;">
                                                    <a class="btn btn-primary text-white ml-auto" href="{{ action('ProfileController@followProfile', $following->username) }}">Follow</a>
                                                </div>
                                            @else
                                                <div class="col-4 text-right vertical-center" style="height: 7vh;">
                                                    <a class="btn btn-outline-primary text-primary ml-auto" href="{{ action('ProfileController@unfollowProfile', $following->username) }}">Unfollow</a>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @empty
                <div class="row">
                    <div class="col">
                        <div class="card w-100">
                            <div class="card-body w-100">
                                {{ __('language.nofollowings') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse

    </div>
@endsection
