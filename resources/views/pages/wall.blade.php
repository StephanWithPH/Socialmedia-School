@extends('app')
@section('title', "SocialHub | Wall")
@section('body')
    <div class="img-fluid w-100 vertical-center text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold">Wall</h1>
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

                            <div class="form-group w-100">
                                <div>
                                    <input id="uploadedimage" type="file" class="dropify form-control @error('uploadedimage') is-invalid @enderror" name="uploadedimage" autocomplete="uploadedimage">
                                    @error('uploadedimage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

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
                            <a class="mt-4 ml-4 mb-4" href="{{ action('ProfileController@loadProfilePage', $user->username) }}">{{ $user->username }} @if($user->verified)<img src="{{ asset('img/imagecheck.svg') }}" style="height: 15px"/>@endif</a>
                            <a href="{{ action('WallController@loadPostDetailsPage', $post->id) }}"><img class="card-img-top w-100" src="{{action('WallController@loadPostImage', $post->id)}}" alt="Card image cap"/></a>
                            <div class="card-body">
                                <p class="card-text">{!! strip_tags(preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="/hashtag/$1">#$1</a>', preg_replace('/(?<!\S)@([0-9a-zA-Z]+)/', '<a href="/@$1">@$1</a>', $post->text)), '<a>') !!}</p>
                            </div>
                            <div class="card-footer bg-white">
                                <a class="text-primary mr-1 likeheart" data-post="{{ $post->id }}" style="font-size: 30px;">@if(!$post->likes->contains(\Illuminate\Support\Facades\Auth::user()))<i class="far fa-heart"></i>@else<i class="fas fa-heart"></i>@endif</a>
                                <a href="{{ action('WallController@loadPostDetailsPage', $post->id) }}" class="text-dark ml-1" style="font-size: 30px;"><i class="far fa-comment"></i></a>
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

        $.ajaxSetup({
            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
        });

        $(".likeheart").click(function(e){
            e.preventDefault();
            var clickedElement = this;
            var id = $(this).data('post');

            $.ajax({
                type:'POST',
                url:'{{ action('WallController@likePost') }}',
                data:{id:id},

                success:function(data){
                    if(data.type === 'like') {
                        $(clickedElement).find('i').removeClass('far').addClass('fas');
                    }
                    else if(data.type === 'unlike') {
                        $(clickedElement).find('i').removeClass('fas').addClass('far');
                    }
                }
            });
        });
    </script>
@endsection
