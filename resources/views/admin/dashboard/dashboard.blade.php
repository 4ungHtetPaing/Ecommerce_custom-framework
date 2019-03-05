@extends('layout.master')
@section('title',"Dashboard")
@section('myStyle')
@endsection
@section('content')   
        {{-- <h1>Hello! Welcome To MY Dashboard</h1>   --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('layout.admin_sidebar')
                </div>
                <div class="col-md-9">
                    @yield('admin_content')
                </div>
            </div>
        </div>
@endsection
