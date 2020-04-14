<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{asset('css/app.scss')}}" rel="stylesheet">
    <!-- CSRF Token Meta Added -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('css/dropify.min.css') }}" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

</head>
<body class="loading">
<div class="preloader" style="background-image: url('{{asset('img/loadingspinner.gif')}}');"></div>
@include('includes.topbar')
@yield('body')
@include('includes.footer')

<!-- Google Font Roboto -->
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link href="https://db.onlinewebfonts.com/c/ac9525e5f200f57332b3080d0db9d8f6?family=Sailec-Medium" rel="stylesheet" type="text/css"/>
<link href="https://db.onlinewebfonts.com/c/61b43418b9624db49ba89da5d1b7eec8?family=Sailec-Bold" rel="stylesheet" type="text/css"/>
<link href="https://db.onlinewebfonts.com/c/2fe381b3d8cf4ee5f331668970d8a65a?family=Sailec-Light" rel="stylesheet" type="text/css"/>
<!-- FontAwesome -->
<script src="https://kit.fontawesome.com/c3da043785.js" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script>
    $(window).load(function() {
        $('.preloader').fadeOut(950);
        $('body').removeClass('loading');
    });
</script>
</body>
</html>
