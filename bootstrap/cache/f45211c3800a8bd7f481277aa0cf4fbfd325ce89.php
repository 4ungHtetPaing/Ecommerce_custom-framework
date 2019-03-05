   
   <?php $__env->startSection('title',"Category Create"); ?>      
   <?php $__env->startSection('content'); ?>
       
   <div class="container my-5">
       <div class="col-md-6 offset-md-3 table-bordered p-5">
            <?php echo $__env->make('layout.alert_message', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
           <form action="<?php echo e(url('/admin/category/create')); ?>" method="post" enctype="multipart/form-data">
            <h1 class="text-center text-primary h3">Create Category</h1>
            <div class="form-group">
                <label for="cat_name">Category Name</label>
                <input type="text" class="form-control" id="cat_name" placeholder="Enter Category Name" name="category_name" re>
            
            </div>
            
            <input type="hidden" name="token" value="<?php echo e(App\Classes\CSRFToken::_token()); ?>">
       
            <div class="row justify-content-end no-gutters">
            <a href="<?php echo e(url('/admin/category/category')); ?>" class="btn btn-secondary mr-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
       
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>