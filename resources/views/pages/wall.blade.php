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
            <div class="col text-center">
                <div class="card w-100">
                    <div class="card-body w-100">
                        <form method="POST" action="{{action('WallController@createPost')}}" class="fileupload" enctype="multipart/form-data">
                            @csrf
                            <input name="fileuploaded" type="file" class="dropify" data-height="200" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ URL::asset('js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
        // select the file input (using a id would be faster)
        $('input[type=file]').change(function() {
            $('.fileupload').submit();
        });

    </script>
@endsection
