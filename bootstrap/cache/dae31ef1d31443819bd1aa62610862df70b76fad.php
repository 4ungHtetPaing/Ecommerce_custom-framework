<?php $__env->startSection('title',"Category"); ?>
<?php $__env->startSection('myStyle'); ?>
    <style>
        .pagination>li{padding: 3px 10px;border-radius: 1.5px;background: #333;color: #fff;margin-right: 1px;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_content'); ?>   
        
        <div class="container-fluid my-5">
            <div class="row">               
                <div class="col-md-8 offset-2">
                    <legend class="h4">View Category</legend>
                    <?php if(\App\Classes\Session::has('category_delete')): ?>
                        <?php echo e(\App\Classes\Session::flash('category_delete')); ?>

                    <?php endif; ?>
                    <?php echo $__env->make('layout.alert_message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="row justify-content-end no-gutters mb-2">
                        <a href="<?php echo e(url('/admin/category/create')); ?>" class="btn rounded-0 btn-success ">Add Category</a>    
                    </div>
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th colspan="2">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td><?php echo e($cat->category_name); ?></td>
                            <td><a href="#" class="text-success mr-2" onclick="fun('<?php echo e($cat->category_name); ?>','<?php echo e($cat->id); ?>')"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo e(url('/admin/category/delete/'.$cat->id)); ?>" class="text-danger mr-2"><i class="fa fa-trash"></i></a>
                            <a href="#" class="text-primary" onclick="createSubCatStart('<?php echo e($cat->category_name); ?>','<?php echo e($cat->id); ?>')"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>                       
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    </table>  
                    <div class="md-5">

                        <?php echo $pages; ?>

                    </div>
                </div>
            </div>
           
        </div>  

        
            <div class="modal fade" id="CategoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title text-center text-primary h4">Edit Category</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">

                                            <div class="form-group">
                                                <label for="cat_name">Category Name</label>
                                                <input type="text" class="form-control" id="edit_cat_name">
                                            </div>
                                            <input type="hidden" id="edit_cat_token" value="<?php echo e(App\Classes\CSRFToken::_token()); ?>">
                                            <input type="hidden" id="edit_cat_id" value="">
                                    
                                            <div class="row justify-content-end no-gutters">
                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary" onclick="startEdit(event)">Create</button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
            </div>
        
            <div class="modal fade" id="SubCategoryCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title text-center text-primary h4">Sub Category Create Form</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">

                                            <div class="form-group">
                                                <label>Parent Category</label>
                                                <input type="text" class="form-control" id="parent_cat_name" disable>
                                            </div>
                                            <div class="form-group">
                                                <label>Sub Category Name</label>
                                                <input type="text" class="form-control" id="sub_cat_name">
                                            </div>
                                            <input type="hidden" id="sub_cat_token" value="<?php echo e(App\Classes\CSRFToken::_token()); ?>">
                                            <input type="hidden" id="sub_cat_id" value="">
                                    
                                            <div class="row justify-content-end no-gutters">
                                            <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancel</button>
                                            <button class="btn btn-primary" onclick="subCatCreate(event)">Create</button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
            </div>
      
<?php $__env->stopSection(); ?>
<?php $__env->startSection("myScript"); ?>
            <script>
                function fun(name, id){
                    $("#edit_cat_name").val(name);
                    $("#edit_cat_id").val(id);
                    $("#CategoryEditModel").modal("show");           
                }
                function startEdit(el){
                    el.preventDefault();
                    name = $("#edit_cat_name").val();
                    token = $("#edit_cat_token").val(); 
                    id = $("#edit_cat_id").val();
                    $("#CategoryEditModel").modal("hide");

                    $.ajax({
                        type : 'POST',
                        url : '/E-commerce/public/admin/category/'+id+'/update',
                        data : {
                            'category_name' : name,
                            'token' : token,
                            'id' : id
                        },
                        success : function(result)
                        {                          
                            window.location.href = "/E-commerce/public/admin/category/category";
                        },
                        error: function(response){
                            var resp = (JSON.parse(response.responseText));
                            alert(resp.category_name);
                        }
                        
                    });
                }

                function createSubCatStart(name, id)
                {
                    $('#parent_cat_name').val(name);
                    $('#sub_cat_id').val(id);
                    $('#SubCategoryCreateModal').modal("show");
                    
                }
                function subCatCreate(el){
                    el.preventDefault();
                    var name = $('#sub_cat_name').val();
                    var token = $('#sub_cat_token').val();
                    var id = $('#sub_cat_id').val();

                    $('#SubCategoryCreateModal').modal("hide");

                       $.ajax({
                        type : 'POST',
                        url : '/E-commerce/public/admin/sub_category/create/'+id,
                        data : {
                            'name' : name,
                            'token' : token,
                            'id' : id
                        },
                        success : function(result)
                        {            
                            console.log(result);              
                            // window.location.href = "/E-commerce/public/admin/category/category";
                        },
                        error: function(response){
                            var resp = (JSON.parse(response.responseText));
                            alert(resp.name);
                        }
                        
                    });
                }
            </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>