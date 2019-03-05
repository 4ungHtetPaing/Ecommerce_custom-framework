<div class="container-fluid bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark px-5">
    <a class="navbar-brand text-white" href="<?php echo e(url('/')); ?>">MY E-Commerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-item nav-link text-white" href="<?php echo e(url('/admin')); ?>">Admin</a>
                    <a class="nav-item nav-link text-white" href="<?php echo e(url('/cart')); ?>">Cart 
                        <span class="badge badge-danger badge-pill" style="position:relative;top:-6px;left:-3px" id="cart_count">0</span></a>
                    <a class="nav-item nav-link text-white" href="#">Contact</a>
                     <div class="dropdown">
                        <a class="nav-item nav-link text-white dropdown-toggle" href="#" id="" data-toggle="dropdown">
                            <?php if(\App\Classes\Auth::check("user_id")): ?>
                                <?php echo e(\App\Classes\Auth::user("user_name")); ?>

                            <?php else: ?>
                               SingUp
                            <?php endif; ?>
                        
                        </a>
                        <div class="dropdown-menu">
                            <?php if(\App\Classes\Auth::check("user_id")): ?>
                                 <a class="dropdown-item" href="<?php echo e(url('/user/logout')); ?>">LogOut</a>
                            <?php else: ?>
                                <a class="dropdown-item" href="<?php echo e(url('/user/login')); ?>">Login</a>
                                <a class="dropdown-item" href="<?php echo e(url('/user/register')); ?>">Register</a>
                            <?php endif; ?>
                       
                        </div>
                    </div>
                </div>
               
            </div>    </nav>
</div>