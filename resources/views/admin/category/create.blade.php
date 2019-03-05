   @extends('layout.master')
   @section('title',"Category Create")      
   @section('content')
       
   <div class="container my-5">
       <div class="col-md-6 offset-md-3 table-bordered p-5">
            @include('layout.alert_message')
           <form action="{{url('/admin/category/create')}}" method="post" enctype="multipart/form-data">
            <h1 class="text-center text-primary h3">Create Category</h1>
            <div class="form-group">
                <label for="cat_name">Category Name</label>
                <input type="text" class="form-control" id="cat_name" placeholder="Enter Category Name" name="category_name" re>
            {{-- <small class="form-text text-danger">

            </small> --}}
            </div>
            {{-- <div class="form-group">
                <label for="cat_img">Category Image</label>
                <input type="file" class="form-control" id="cat_img" name="file">
                <small class="form-text text-muted"></small>
            </div> --}}
            <input type="hidden" name="token" value="{{App\Classes\CSRFToken::_token()}}">
       
            <div class="row justify-content-end no-gutters">
            <a href="{{url('/admin/category/category')}}" class="btn btn-secondary mr-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
       
@endsection