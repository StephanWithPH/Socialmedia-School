@extends('app')
@section('title', "SocialHub | Home")
@section('body')
<div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 text-center text-lg-left">
                <h1 class="display-4 text-white font-weight-bold">{{ __('language.displaytitle') }}</h1>
            </div>
            <div class="col-lg-6 col-12 text-center text-lg-left">
                <div class="card" style="width: 100%;">
                    <div class="card-body m-3 text-center">
                        <h3 class="card-title text-center text-primary font-weight-bold">{{ __('language.signupnow') }}</h3>
                        <p class="card-text">{{ __('language.signupnow-description') }}</p>
                        <p class="text-muted font-weight-light">{{ __('language.signupnow-orloginwith') }}</p>
                        <div class="text-center">
                            <a class="btn btn-primary btn-lg text-white" href="{{ route('login') }}"><i class="far fa-envelope"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
