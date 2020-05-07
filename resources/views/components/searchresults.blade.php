@foreach($users as $user)
    <div class="row mt-2 mb-2 d-flex justify-content-center">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body w-100">
                    <div class="row">
                        <div class="col-4 col-md vertical-center" style="height: 7vh;">
                            <a class="text-primary font-weight-bold h-100" href="{{ action('ProfileController@loadProfilePage', $user->username) }}"><img src="@if( $user->avatar ){{action('ProfileController@loadProfileAvatar', $user->id)}}@else{{asset('img/default-avatar.png')}}@endif" class="rounded-circle border h-100 bg-white"/></a>
                        </div>
                        <div class="col-4 vertical-center" style="height: 7vh">
                            <a class="text-primary font-weight-bold" href="{{ action('ProfileController@loadProfilePage', $user->username) }}">{{ $user->username }}</a>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if(!\Illuminate\Support\Facades\Auth::user()->followings->contains($user->id))
                                <div class="col-4 text-right vertical-center" style="height: 7vh;">
                                    <a class="btn btn-primary text-white ml-auto" href="{{ action('ProfileController@followProfile', $user->username) }}">Follow</a>
                                </div>
                            @else
                                <div class="col-4 text-right vertical-center" style="height: 7vh;">
                                    <a class="btn btn-outline-primary text-primary ml-auto" href="{{ action('ProfileController@unfollowProfile', $user->username) }}">Unfollow</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
@endforeach
