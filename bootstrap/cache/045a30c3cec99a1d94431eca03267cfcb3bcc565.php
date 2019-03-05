<?php $__env->startSection('title',"Home"); ?>
<?php $__env->startSection('myStyle'); ?>
    <style>
        .pagination>li{padding: 3px 10px;border-radius: 1.5px;background: #333;color: #fff;margin-right: 1px;}
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>   

        <div class="container my-5">
            <h4 class="text-info mb-3">Most Popular</h4>
            <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <?php echo e($product->name); ?>

                            </div>
                            <div class="card-blog">
                                <img src="<?php echo e($product->image); ?>" alt="" style="width:100%" height="300px">
                                  
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-between">
                                    <a href="<?php echo e(url('/detail/'.$product->id)); ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye text-white"></i>
                                    </a>
                                    <span class="product_price">$ <?php echo e($product->price); ?></span>
                                <button class="btn btn-success btn-sm" onclick="addToCart('<?php echo e($product->id); ?>')">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>          
        </div>
        <div class="row justify-content-center">
            <?php echo $pages; ?>

        </div>
    <div class="container my-5">
        <h4 class="text-info mb-3">Featured</h4>
            <div class="row">
                <?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <?php echo e($product->name); ?>

                            </div>
                            <div class="card-blog">
                                <img src="<?php echo e($product->image); ?>" alt="" style="width:100%" height="300px">
                                  
                            </div>
                            <div class="card-footer">
                                <div class="row justify-content-between">
                                    <a href="<?php echo e(url('/detail/'.$product->id)); ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye text-white"></i>
                                    </a>
                                    <span class="product_price">$ <?php echo e($product->price); ?></span>
                                    <button class="btn btn-success btn-sm" onclick="addToCart('<?php echo e($product->id); ?>')">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>