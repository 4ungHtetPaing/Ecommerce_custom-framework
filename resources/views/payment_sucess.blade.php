@extends('layout.master')
@section('title',"Cart")
@section("content")
    <div class="container my-5">
        <h1 class="text-success h4">Payment Success</h1>
        <a href="{{url("/")}}">Go Back Home</a>
    </div>
@endsection
@section('myScript')
    <script>
        localStorage.removeItem("products");
        localStorage.removeItem("items");
        $("#cart_count").html(0);
    </script>
@endsection