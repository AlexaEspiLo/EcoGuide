<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo">
        </div>

            <ul class="nav-center">
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>"><img src="<?php echo e(asset('icons/login-icon.png')); ?>" class="nav-icon">Login</a></li>
                <?php endif; ?>

                <li><a href="<?php echo e(route('home')); ?>" class="active"><img src="<?php echo e(asset('icons/home-icon.png')); ?>" class="nav-icon">Home</a></li>

                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('register')); ?>"><img src="<?php echo e(asset('icons/register-icon.png')); ?>" class="nav-icon"> Register</a></li>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <li><a href="<?php echo e(route('tips.create')); ?>"><img src="<?php echo e(asset('icons/add-icon.png')); ?>" class="nav-icon"> Add Tip</a>
                    </li>
                    <li><a href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('icons/account-icon.png')); ?>" class="nav-icon"> Account</a></li>
                <?php endif; ?>
            </ul>

        <div class="nav-right">
            <a href="#">
                <img src="<?php echo e(asset('icons/search-icon.png')); ?>" class="nav-icon">
            </a>
        </div>

    </div>
</nav><?php /**PATH C:\laragon\www\ecoGuide\resources\views/partials/topnav.blade.php ENDPATH**/ ?>