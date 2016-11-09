@extends('layouts.master')

@section('title')
    Admin Panel
@endsection

@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Reports</a></li>
                        <li><a href="#">Analytics</a></li>
                        <li><a href="#">Export</a></li>
                    </ul>

                </div>
            </div>
        </div>
    <div class="col-sm-9 col-md-9 col-md-offset-3 col-sm-offset-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Post Amount</th>
                    <th>Likes Amount</th>


                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->posts()->count()}}</td>
                    <td>{{$user->likes()->count()}}</td>


                </tr>
                    @endforeach
                </tbody>
                </table>
            </div>

    </div>


@endsection