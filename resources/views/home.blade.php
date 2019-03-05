@extends('layout.master')
@section('title',"Home")
@section('myStyle')
    <style>
        .pagination>li{padding: 3px 10px;border-radius: 1.5px;background: #333;color: #fff;margin-right: 1px;}
    </style>
@endsection
@section('content')   

        <div class="container my-5">
            <h4 class="text-info mb-3">Most Popular</h4>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">
                                {{$product->name}}
                            </div>
                            <div class="card-blog">
                                <img src="{{$product->image}}" alt="" style="width:100%" height="300px">
                                  
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-between">
                                    <a href="{{url('/detail/'.$product->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye text-white"></i>
                                    </a>
                                    <span class="product_price">$ {{$product->price}}</span>
                                <button class="btn btn-success btn-sm" onclick="addToCart('{{$product->id}}')">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>          
        </div>
        <div class="row justify-content-center">
            {!!$pages!!}
        </div>
    <div class="container my-5">
        <h4 class="text-info mb-3">Featured</h4>
            <div class="row">
                @foreach ($featured_products as $product)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">
                                {{$product->name}}
                            </div>
                            <div class="card-blog">
                                <img src="{{$product->image}}" alt="" style="width:100%" height="300px">
                                  
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-between">
                                    <a href="{{url('/detail/'.$product->id)}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye text-white"></i>
                                    </a>
                                    <span class="product_price">$ {{$product->price}}</span>
                                    <button class="btn btn-success btn-sm" onclick="addToCart('{{$product->id}}')">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
