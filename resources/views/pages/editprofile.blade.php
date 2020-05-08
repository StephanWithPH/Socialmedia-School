@extends('app')
@section('title', "SocialHub | Edit profile")
@section('body')
    <div class="img-fluid w-100 vertical-center text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container position-relative" style="top:10vh">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold"><img src="@if( $userProfile->avatar ) {{action('ProfileController@loadProfileAvatar', $userProfile->id)}} @else {{ asset('img/default-avatar.png') }} @endif" class="rounded-circle border bg-white" height="200px" width="200px"/></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="mt-5">
                    @include('flash::message')
                    <div class="card w-100">
                        <div class="card-body w-100">
                            <form method="POST" action="{{ action('ProfileController@submitEditProfile') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="submitteduser" value="{{ \Illuminate\Support\Facades\Auth::user()->username }}"/>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : \Illuminate\Support\Facades\Auth::user()->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ? old('username') : \Illuminate\Support\Facades\Auth::user()->username }}" required autocomplete="username">

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : \Illuminate\Support\Facades\Auth::user()->email}}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>

                                    <div class="col-md-6">
                                        <input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ old('bio') ? old('bio') : \Illuminate\Support\Facades\Auth::user()->bio }}" autocomplete="bio">

                                        @error('bio')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                                    <div class="col-md-6">
                                        <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" autocomplete="avatar">

                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Edit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
