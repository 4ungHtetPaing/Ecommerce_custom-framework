<?php $__env->startSection('title',"Login"); ?>
<?php $__env->startSection('myStyle'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
    <div class="container my-5">
        <div class="col-md-4 offset-md-4">
            <h1 class="text-center text-info h4 mb-2">Login</h1>
            <?php if(\App\Classes\Session::has("success_message")): ?>
                <?php echo e(\App\Classes\Session::flash("success_message")); ?>

            <?php endif; ?>
            <?php if(\App\Classes\Session::has("error_message")): ?>
                <?php echo e(\App\Classes\Session::flash("error_message")); ?>

            <?php endif; ?>
        <form action="<?php echo e(url("/user/login")); ?>" method="POST">
                    <input type="hidden" name="token" value="<?php echo e(\App\Classes\CSRFToken::_token()); ?>">
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control rounded-0" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control rounded-0" id="password" name="password">
                    </div>
                    <div class="row justify-content-between no-gutters">
                    <a href="<?php echo e(url("/user/register")); ?>" class="">Please register here!</a>
                        <span>
                            <a href="" class="btn btn-sm btn-outline-secondary">Cancel</a>
                            <button class="btn btn-sm btn-primary">Login</button>
                        </span>
                    </div>

            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>