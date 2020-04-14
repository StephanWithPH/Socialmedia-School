@extends('app')
@section('title', "SocialHub | Home")
@section('body')
    <div class="img-fluid w-100 vertical-center text-md-left text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold position-relative" style="top:100px"><img src="{{ asset('img/default-avatar.png') }}" class="rounded-circle border" height="200px" width="200px"/></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 col-12 mt-5">
                <div class="mt-5">
                    <h4 class="font-weight-bold mb-0">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
                    <h6 class="text-muted mb-3">&commat;{{ \Illuminate\Support\Facades\Auth::user()->username }}</h6>
                    <p class="mb-1">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p><strong>128</strong> <span class="text-muted">followers</span> <strong class="ml-3">30</strong> <span class="text-muted">following</span></p>
                </div>
            </div>
            <div class="col-md-6 col-12 text-md-right">
                <a class="btn btn-outline-primary text-primary">Edit profile</a>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-3 col-4 p-1">
                <img src="{{ asset('img/default-avatar.png') }}" class="w-100"/>
            </div>
            <div class="col-md-3 col-4 p-1">
                <img src="{{ asset('img/default-avatar.png') }}" class="w-100"/>
            </div>
            <div class="col-md-3 col-4 p-1">
                <img src="{{ asset('img/default-avatar.png') }}" class="w-100"/>
            </div>
            <div class="col-md-3 col-4 p-1">
                <img src="{{ asset('img/default-avatar.png') }}" class="w-100"/>
            </div>
            <div class="col-md-3 col-4 p-1">
                <img src="{{ asset('img/default-avatar.png') }}" class="w-100"/>
            </div>
        </div>
    </div>
@endsection
