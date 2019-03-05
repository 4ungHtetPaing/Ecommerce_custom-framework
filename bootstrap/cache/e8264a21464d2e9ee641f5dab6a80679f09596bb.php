<?php $__env->startSection('title',"Dashboard"); ?>
<?php $__env->startSection('myStyle'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>   
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('layout.admin_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                <div class="col-md-9">
                    <?php echo $__env->yieldContent('admin_content'); ?>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>