<?php $__env->startSection('title',"Cart"); ?>
<?php $__env->startSection("content"); ?>
    <div class="container my-5">
        <h1 class="text-success h4">Payment Success</h1>
        <a href="<?php echo e(url("/")); ?>">Go Back Home</a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('myScript'); ?>
    <script>
        localStorage.removeItem("products");
        localStorage.removeItem("items");
        $("#cart_count").html(0);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>