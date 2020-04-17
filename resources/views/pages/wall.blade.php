@extends('app')
@section('title', "SocialHub | Wall")
@section('body')
    <div class="img-fluid w-100 vertical-center text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold">{{ \Illuminate\Support\Facades\Auth::user()->username }}'s wall</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @include('flash::message')
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 col-12">
                <div class="card w-100">
                    <div class="card-body w-100">
                        <form method="POST" action="{{action('WallController@createPost')}}" class="fileupload" enctype="multipart/form-data">
                            @csrf
                            <input name="fileuploaded" type="file" class="dropify" data-height="200" />

                            <div class="form-group w-100">

                                <div class="mt-2">
                                    <textarea style="height:200px" id="uploadedfiletext" type="textarea" class="form-control @error('uploadedfiletext') is-invalid @enderror" name="uploadedfiletext" value="{{ old('uploadedfiletext') }}" autocomplete="uploadedfiletext" autofocus placeholder="{{ __('language.enterposttext') }}"></textarea>

                                    @error('uploadedfiletext')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-right">
                                <input type="submit" class="btn btn-primary text-white text-right" value="{{ __('language.createpost') }}"/>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-2">
            @php
                $postsfound = false;
            @endphp
            @forelse(\Illuminate\Support\Facades\Auth::user()->followings as $user )
                @forelse($user->posts()->orderBy('created_at','DESC')->limit(4)->get() as $post)
                    @php
                        $postsfound = true;
                    @endphp
                    <div class="col-md-7 col-12 mb-2">
                        <div class="card w-100">
                            <a class="mt-4 ml-4 mb-4">{{ $user->username }}</a>
                            <img class="card-img-top" src="https://www.w3schools.com/w3css/img_lights.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Like</a>
                                <a href="#" class="btn btn-danger">Comment</a>
                            </div>
                        </div>
                    </div>
                    @empty
                @endforelse
            @empty
            @endforelse
            @if(!$postsfound)
                <div class="col-md-7 col-12 mb-2">
                    <div class="card w-100">
                        <p class="text-center mt-4 mb-4">{{ __('language.nopostsfound') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script type="text/javascript" src="{{ URL::asset('js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
        // select the file input (using a id would be faster)
        // $('input[type=file]').change(function() {
        //     $('.fileupload').submit();
        // });

    </script>
@endsection
