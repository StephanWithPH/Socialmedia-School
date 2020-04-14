@extends('app')
@section('title', "CloudHub | Admin Statistics")
@section('body')
    <div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold text-center">{{ __('language.edituser') }} {{ $user->name }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @include('flash::message')
        <div class="row">

            <div class="col">
                <div class="card w-100">
                    <div class="card-body">
                        <form method="POST" action="{{ action('AdminController@editUserSubmit') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}"/>
                            <label for="#name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"/>
                            <br/>
                            <label for="#email">Email address</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}"/>
                            <br/>
                            <label for="#emailverified">Email verified</label>
                            <select class="form-control" id="emailverified" name="emailverified">
                                <option value="true" @if($user->email_verified_at != null) selected @endif>Yes</option>
                                <option value="false" @if($user->email_verified_at == null) selected @endif>No</option>
                            </select>
                            <br/>
                            <label for="#isadmin">Administrator</label>
                            <select class="form-control" id="isadmin" name="isadmin">
                                <option value="true" @if($user->is_admin) selected @endif>Yes</option>
                                <option value="false" @if(!$user->is_admin) selected @endif>No</option>
                            </select>
                            <br/>
                            <button class="btn btn-primary" type="submit">Edit user</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
