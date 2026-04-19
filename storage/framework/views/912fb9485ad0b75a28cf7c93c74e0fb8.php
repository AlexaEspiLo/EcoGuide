<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo">
        </div>

            <ul class="nav-center">
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>"><img src="<?php echo e(asset('icons/login-icon.png')); ?>" class="nav-icon">Login</a></li>
                    <li><a href="" class="active"><img src="<?php echo e(asset('icons/home-icon.png')); ?>" class="nav-icon">Home</a></li>
                    <li><a href="<?php echo e(route('register')); ?>"><img src="<?php echo e(asset('icons/register-icon.png')); ?>" class="nav-icon"> Register</a></li>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <li class="nav-links">
                        <a href="#" class="<?php echo e(request()->routeIs('profile') ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('icons/account-icon.png')); ?>" class="nav-icon"> Account
                        </a>
                    </li>

                    <li class="nav-links">
                        <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('icons/home-icon.png')); ?>" class="nav-icon"> Home
                        </a>
                    </li>

                    <li class="nav-links">
                        <a href="/search" class="<?php echo e(request()->path() == 'search' ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('icons/search-icon.png')); ?>" class="nav-icon"> Search
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

    </div>
</nav>

<?php /**PATH C:\laragon\www\EcoGuide\resources\views/partials/topnav.blade.php ENDPATH**/ ?>