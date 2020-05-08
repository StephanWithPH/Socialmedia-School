@extends('app')
@section('title', "SocialHub | Post details")
@section('body')
    <div class="img-fluid w-100 vertical-center text-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold">{{ __('language.postdetails') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        @include('flash::message')
        <div class="row d-flex justify-content-center mt-2">
            <div class="col-md-7 col-12 mb-2">
                <div class="card w-100">
                    <a class="mt-4 ml-4 mb-4" href="{{ action('ProfileController@loadProfilePage', $post->user->username) }}">{{ $post->user->username }} @if($post->user->verified)<img src="{{ asset('img/imagecheck.svg') }}" style="height: 15px"/>@endif</a>
                    <img class="card-img-top w-100" src="{{action('WallController@loadPostImage', $post->id)}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{!! strip_tags(preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="/hashtag/$1">#$1</a>', preg_replace('/(?<!\S)@([0-9a-zA-Z]+)/', '<a href="/@$1">@$1</a>', $post->text)), '<a>') !!}</p>
                    </div>
                    <div class="card-footer bg-white">
                        <a class="text-primary mr-1 likeheart" data-post="{{ $post->id }}" style="font-size: 30px;">@if(!$post->likes->contains(\Illuminate\Support\Facades\Auth::user()))<i class="far fa-heart"></i>@else<i class="fas fa-heart"></i>@endif</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-2">
            <div class="col-md-7 col-12 mb-2">
                <div class="card w-100">
                    <div class="card-body">
                        <form method="POST" action="{{action('CommentController@createComment')}}">
                            @csrf
                            <input type="hidden" name="postid" value="{{ $post->id }}">
                            <div class="form-group w-100">
                                <div class="mt-2">
                                    <textarea style="height:200px" id="commenttext" type="textarea" class="form-control @error('commenttext') is-invalid @enderror" name="commenttext" value="{{ old('commenttext') }}" autocomplete="commenttext" autofocus placeholder="{{ __('language.entercommenttext') }}"></textarea>

                                    @error('commenttext')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-right">
                                <input type="submit" class="btn btn-primary text-white text-right" value="{{ __('language.createcomment') }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @forelse($post->comments as $comment)
                <div class="col-md-7 col-12 mb-2">
                    <div class="card w-100">
                        <div class="card-body">
                            <p class="card-text"><strong><a href="{{ action('ProfileController@loadProfilePage', $comment->user->username) }}">{{ $comment->user->username }}</a></strong> {!! strip_tags(preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="/hashtag/$1">#$1</a>', preg_replace('/(?<!\S)@([0-9a-zA-Z]+)/', '<a href="/@$1">@$1</a>', $comment->text)), '<a>') !!}</p>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

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
