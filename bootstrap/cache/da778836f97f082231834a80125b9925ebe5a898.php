<?php $__env->startSection('title',"Home"); ?>
<?php $__env->startSection('myStyle'); ?>
    <style>
         @keyframes  myRotate{

            0% {transform:rotate(0deg)};

        }
        img{
            animation-name: myRotate;
            animation-duration: 3s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;

        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>   
        
        <img src="<?php echo e(asset('images/dell.jpg')); ?>" alt="" style="width:200px;height:200px;display:block;margin:50px auto;transform:rotate(360deg)">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>