@extends('layout.master')
@section('title',"Register")
@section('myStyle')
@endsection
@section("content")
    <div class="container my-5">
        <div class="col-md-4 offset-md-4">
            <h1 class="text-center text-success h4 mb-2">Register</h1>
            @if (\App\Classes\Session::has("error_message"))
                {{\App\Classes\Session::flash("error_message")}}
            @endif
            <form action="{{url('/user/register')}}" method="POST">
                    <input type="hidden" name="token" value="{{\App\Classes\CSRFToken::_token()}}">
                    <div class="form-group">
                        <label for="name">Name </label>
                        <input type="text" class="form-control rounded-0" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control rounded-0" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control rounded-0" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="con_pass">Confirm Password</label>
                        <input type="password" class="form-control rounded-0" id="con_pass" name="con_pass" required>
                    </div>
                    <div class="row justify-content-between no-gutters">
                    <a href="{{url('/user/login')}}">Already register? Login here!</a>
                        <span>
                            <button class="btn btn-sm btn-outline-warning">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Register</button>
                        </span>
                    </div>
            </form>
        </div>
    </div>
@endsection