<?php $__env->startSection('title',"Home"); ?>
<?php $__env->startSection('myStyle'); ?>
    <style>
        .pagination>li{padding: 3px 10px;border-radius: 1.5px;background: #333;color: #fff;margin-right: 1px;}

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>   
        <div class="container my-5">
            <h4 class="text-info mb-3">Product Detail</h4>
            <div class="jumbotron">
                <div class="row">
                    <div class="col-md-4">
                    <img src="<?php echo e($product->image); ?>" alt="" style="width:100%">
                    </div>
                    <div class="col-md-8">
                    <h4 class="text-info h4"><?php echo e($product->name); ?></h4>
                        <p><?php echo e($product->description); ?></p>
                    <button class="btn btn-warning btn-sm rounded-0"> $ <?php echo e($product->price); ?></button>
                        <button class="btn btn-success btn-sm rounded-0" onclick="addToCart('<?php echo e($product->id); ?>')">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                        <div class="my-3">
                        <span>
                            Rate :
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star-half text-warning"></i>
                        </span>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>