@extends('admin.dashboard.dashboard')
@section('title',"Product View")
@section('myStyle')
    <style>
        .pagination>li{padding: 3px 10px;border-radius: 1.5px;background: #333;color: #fff;margin-right: 1px;}
    </style>
@endsection
@section('admin_content')   
        <div class="container-fluid my-5">
            <div class="row">               
                <div class="col-md-12">
                    {{-- <legend class="h4 text-center text-primary">View Product</legend> --}}
                    @if(\App\Classes\Session::has('product_delete'))
                        {{ \App\Classes\Session::flash('product_delete') }}
                    @endif
                    @include('layout.alert_message')
                    <div class="row justify-content-end no-gutters mb-2">
                        <a href="#" class="btn rounded-0 btn-success" onclick="showAddProductModal()">Add Product</a>    
                    </div>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Photo</th>
                            <th>Description</th>
                            <th colspan="2">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key=>$product)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                @foreach ($cats as $cat)
                                    @if($cat->id == $product->cat_id)
                                        {{ $cat->category_name }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($sub_cats as $sub_cat)
                                    @if($sub_cat->id == $product->sub_cat)
                                        {{$sub_cat->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <img src="{{$product->image}}" alt="" with="100" height="80">
                            </td>
                            <td>{{$product->description}}</td>
                        <td><a href="#" class="text-success mr-2" onclick="showEditProductModal('{{$product->name}}','{{$product->price}}','{{$product->sub_cat}}','{{$product->image}}','{{$product->description}}')"><i class="fa fa-edit"></i></a>
                            <a href="{{url('/admin/product/delete/'.$product->id)}}" class="text-danger mr-2"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>                       
                    @endforeach
                    </tbody>
                    </table>  
                    <div class="md-5">

                        {!!$pages!!}
                    </div>
                </div>
            </div>
           
        </div>  

        {{--Product Create Model --}}
            <div class="modal fade" id="AddProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content py-2 px-3">
                                <div class="modal-header">
                                    <h1 class="text-center text-info h4">Add Product</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="proCreate">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cat_name">Product Name</label>
                                                    <input type="text" class="form-control rounded-0" id="pro_name" name="pro_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cat_name">Product Price</label>
                                                    <input type="number" step="any" class="form-control rounded-0" id="pro_price" name="pro_price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label for="sub_category">Sub Category</label>
                                                    <select class="form-control rounded-0" id="sub_category" name="sub_category">  
                                                        @foreach ($sub_cats as $sub_cat)
                                                            <option value="{{$sub_cat->id}}">{{$sub_cat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="file">Product Image</label>
                                                    <input type="file" class="form-control-file" id="file" name="file">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control rounded-0" id="description" name="description" rows="3"></textarea>
                                        </div>
                                        <input type="hidden" id="pro_token" name="pro_token" value="{{App\Classes\CSRFToken::_token()}}">                       
                                            <div class="row justify-content-end no-gutters">
                                                <button type="button" class="btn btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success" onclick="produtCreate(event)">Create</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>

        {{-- Product Edit Modal --}}
         <div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content py-2 px-3">
                                <div class="modal-header">
                                    <h1 class="text-center text-info h4">Edit Product</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data" id="proCreate">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cat_name">Product Name</label>
                                                    <input type="text" class="form-control rounded-0" id="pro_edit_name" name="pro_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cat_name">Product Price</label>
                                                    <input type="number" step="any" class="form-control rounded-0" id="pro_edit_price" name="pro_price">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label for="sub_category">Sub Category</label>
                                                    <select class="form-control rounded-0" id="edit_sub_category" name="sub_category" data-aaa="">  
                                                        @foreach ($sub_cats as $sub_cat)
                                                            <option value="{{$sub_cat->id}}" 
                                                            @php
                                                               echo  $sub_cat->id == "data-aaa"  ? "select" : "";
                                                            @endphp>{{$sub_cat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="file">Product Image</label>
                                                    <input type="file" class="form-control-file" id="edit_file" name="file">
                                                    <img src="" alt="" id="pro_pre" width="200" height="100">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control rounded-0" id="edit_description" name="description" rows="3"></textarea>
                                        </div>
                                        <input type="hidden" id="pro_edit_token" name="pro_token" value="{{App\Classes\CSRFToken::_token()}}">                       
                                            <div class="row justify-content-end no-gutters">
                                                <button type="button" class="btn btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success" onclick="produtEdit(event)">Create</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
            </div>
@endsection
@section("myScript")
            <script>
                function showAddProductModal()
                {
                    $('#AddProductModal').modal("show");                   
                }
                function produtCreate(el){
                    el.preventDefault();
                    var name = $('#pro_name').val();
                    var price = $('#pro_price').val();
                    var sub_category = $('#sub_category').val();
                    var file = $('#file').val();
                    var description = $('#description').val();
                    var token = $('#pro_token').val();

                    var fd = new FormData();
                    var files = $('#file')[0].files[0];
                    fd.append('file', files);
                    fd.append('name', name);
                    fd.append('price', price);
                    fd.append('sub_category', sub_category);
                    fd.append('description', description);
                    fd.append('token', token);

                       $.ajax({
                        type : 'POST',
                        url : '/E-commerce/public/admin/product/create',
                        data : fd,          
                        contentType: false,
                        cache: false,
                        processData:false,
                        success : function(result)
                        {        
                            $('#AddProductModal').modal("hide");             
                            window.location.href = "/E-commerce/public/admin/product/home";
                        },
                        error: function(response){
                            var resp = (JSON.parse(response.responseText));
                            alert("resp!!");
                        }
                        
                    });
                }
                function showEditProductModal(name, price, sub_cat, file, description)
                {
                    $('#pro_edit_name').val(name);
                    $('#pro_edit_price').val(price);
                    var data_id = $('#edit_sub_category').attr('data-aaa', sub_cat);
                    $('#pro_pre').attr('src', file);
                    $('#edit_description').val(description);
                    $('#EditProductModal').modal("show");    
                    alert(data-id);               
                }
                 function produtEdit(el){
                    el.preventDefault();
                    var name = $('#pro_edit_name').val();
                    var price = $('#pro_edit_price').val();
                    var sub_category = $('#edit_sub_category').val();
                    var file = $('#edit_file').val();
                    var description = $('#edit_description').val();
                    var token = $('#pro_edit_token').val();

                    var fd = new FormData();
                    var files = $('#file')[0].files[0];
                    fd.append('file', files);
                    fd.append('name', name);
                    fd.append('price', price);
                    fd.append('sub_category', sub_category);
                    fd.append('description', description);
                    fd.append('token', token);

                       $.ajax({
                        type : 'POST',
                        url : '/E-commerce/public/admin/product/create',
                        data : fd,          
                        contentType: false,
                        cache: false,
                        processData:false,
                        success : function(result)
                        {        
                            $('#AddProductModal').modal("hide");             
                            window.location.href = "/E-commerce/public/admin/product/home";
                        },
                        error: function(response){
                            var resp = (JSON.parse(response.responseText));
                            alert("resp!!");
                        }
                        
                    });
                }
            </script>
@endsection
