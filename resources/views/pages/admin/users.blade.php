@extends('app')
@section('title', "CloudHub | Admin Statistics")
@section('body')
    <div class="img-fluid w-100 vertical-center" style="background-image: url('{{ asset('img/banner-home.jpg') }}'); height: 20vh">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-4 text-white font-weight-bold text-center">{{ __('language.adminusers') }}</h1>
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
                        <table class="table table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Email verified</th>
                                    <th>Admin user</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\User::all() as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if($user->email_verified_at != null) Yes @else No @endif</td>
                                        <td>@if($user->is_admin) Yes @else No @endif</td>
                                        <td><a class="btn btn-primary" href="{{ action('AdminController@loadEditUserPage', $user->id) }}">Edit</a> <a class="btn btn-danger" href="{{ action('AdminController@deleteUser', $user->id) }}">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
