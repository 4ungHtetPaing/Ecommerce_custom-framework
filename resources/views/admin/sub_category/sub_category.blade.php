@extends('admin.dashboard.dashboard')
@section('title',"Category")
@section('myStyle')
    <style>
        .pagination>li{padding: 3px 10px;border-radius: 1.5px;background: #333;color: #fff;margin-right: 1px;}
    </style>
@endsection
@section('admin_content')   
        {{-- <h1>Hello! Welcome To MY Category</h1>   --}}
        <div class="container-fluid my-5">
            <div class="row">               
                <div class="col-md-8 offset-2">
                    <legend class="h4 mb-5 text-center">View Sub Category</legend>
                    @if(\App\Classes\Session::has('sub_category_delete'))
                        {{ \App\Classes\Session::flash('sub_category_delete') }}
                    @endif
                    @include('layout.alert_message')
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th colspan="2">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sub_cats as $key=>$sub_cat)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$sub_cat->name}}</td>
                            <td>{{$sub_cat->cat_id}}</td>
                            <td><a href="#" class="text-success mr-2" onclick="showEditModal('{{$sub_cat->name}}','{{$sub_cat->id}}', {{$sub_cat->cat_id}})"><i class="fa fa-edit"></i></a>
                            <a href="{{url('/admin/sub_category/delete/'.$sub_cat->id)}}" class="text-danger mr-2"><i class="fa fa-trash"></i></a>
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

        {{-- Sub Category Create Model --}}
            <div class="modal fade" id="SubCategoryEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title text-center text-primary h4">Sub Category Edit</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">

                                            <div class="form-group">
                                                <label>Parent Category</label>
                                                <input type="text" class="form-control" id="sub_cat_cate_name" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Sub Category</label>
                                                <input type="text" class="form-control" id="sub_cat_edit_name">
                                            </div>
                                            <input type="hidden" id="sub_cat_edit_token" value="{{App\Classes\CSRFToken::_token()}}">
                                            <input type="hidden" id="sub_cat_edit_id" value="">
                                    
                                            <div class="row justify-content-end no-gutters">
                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-primary" onclick="subCatUpdate(event)">Update</button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
            </div>
      
@endsection
@section("myScript")
            <script>
                function showEditModal(name, id, cat_id){
                    $('#sub_cat_cate_name').val(cat_id);
                    $("#sub_cat_edit_name").val(name);
                    $("#sub_cat_edit_id").val(id);
                    $("#SubCategoryEditModal").modal("show");           
                }
                function subCatUpdate(el){
                    el.preventDefault();
                    name = $("#sub_cat_edit_name").val();
                    token = $("#sub_cat_edit_token").val(); 
                    id = $("#sub_cat_edit_id").val();
                    $("#SubCategoryEditModal").modal("hide");

                    $.ajax({
                        type : 'POST',
                        url : '/E-commerce/public/admin/sub_category/update/'+ id,
                        data : {
                            'name' : name,
                            'token' : token,
                            'id' : id
                        },
                        success : function(result)
                        {                          
                            window.location.href = "/E-commerce/public/admin/sub_category/home";
                        },
                        error: function(response){
                            var resp = (JSON.parse(response.responseText));
                            alert(resp.name);
                        }
                        
                    });
                }
            </script>
@endsection
