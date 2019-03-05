@extends('layout.master')
@section('title',"Login")
@section('myStyle')
@endsection
@section("content")
    <div class="container my-5">
        <div class="col-md-4 offset-md-4">
            <h1 class="text-center text-info h4 mb-2">Login</h1>
            @if (\App\Classes\Session::has("success_message"))
                {{\App\Classes\Session::flash("success_message")}}
            @endif
            @if (\App\Classes\Session::has("error_message"))
                {{\App\Classes\Session::flash("error_message")}}
            @endif
        <form action="{{url("/user/login")}}" method="POST">
                    <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control rounded-0" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control rounded-0" id="password" name="password">
                    </div>
                    <div class="row justify-content-between no-gutters">
                    <a href="{{url("/user/register")}}" class="">Please register here!</a>
                        <span>
                            <a href="" class="btn btn-sm btn-outline-secondary">Cancel</a>
                            <button class="btn btn-sm btn-primary">Login</button>
                        </span>
                    </div>

            </form>
        </div>
    </div>
@endsection