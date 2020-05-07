<nav class="navbar navbar-expand-lg navbar-primary bg-white border-bottom">
    <a class="navbar-brand" href="{{ action('HomeController@loadHomePage') }}">
        <img src="{{ asset('img/logo.png') }}" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-hamburger text-primary" style="font-size:28px;"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item mr-2 ml-2">
                <a class="nav-link text-center" href="{{ action('HomeController@loadHomePage') }}"><h4 class="mb-0"><i class="fas fa-home"></i></h4>{{ __('language.home') }}</a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item mr-2 ml-2">
                    <a class="nav-link text-center" href="{{ action('WallController@loadWallPage') }}"><h4 class="mb-0"><i class="fas fa-stream"></i></h4>{{ __('language.wall') }}</a>
                </li>
                <li class="nav-item mr-2 ml-2">
                    <a class="nav-link text-center" href="{{ action('ProfileController@loadProfilePage', ['username' => \Illuminate\Support\Facades\Auth::user()->username]) }}"><h4 class="mb-0"><i class="fas fa-user"></i></h4>{{ __('language.profile') }}</a>
                </li>
                <li class="nav-item mr-2 ml-2">
                    <a class="nav-link text-center" href="{{ action('ExploreController@loadExplorePage') }}"><h4 class="mb-0"><i class="fas fa-compass"></i></h4>{{ __('language.explore') }}</a>
                </li>
            @endif
        </ul>
        <ul class="navbar-nav ml-auto">
            @if(\Illuminate\Support\Facades\Auth::check())
                <li class="nav-item mr-2 ml-2">
                    <a class="nav-link text-center" href="{{ action('Auth\LoginController@logout') }}"><h4 class="mb-0"><i class="fas fa-sign-out-alt"></i></h4>{{ __('language.logout') }}</a>
                </li>
            @else
                <li class="nav-item mr-2 ml-2">
                    <a class="nav-link text-center" href="{{ route('login') }}"><h4 class="mb-0"><i class="fas fa-sign-in-alt"></i></h4>{{ __('language.login') }}</a>
                </li>
                <li class="nav-item mr-2 ml-2">
                    <a class="nav-link btn btn-primary text-white text-center" href="{{ route('register') }}"><h4 class="mb-0"><i class="fas fa-user-plus"></i></h4>{{ __('language.signup') }}</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
