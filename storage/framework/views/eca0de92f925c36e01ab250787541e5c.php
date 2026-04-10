<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo">
        </div>

            <ul class="nav-center">
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('categories')); ?>"><img src="<?php echo e(asset('icons/categories-icon.png')); ?>" class="nav-icon">Categories</a></li>
                <?php endif; ?>

                <li><a href="<?php echo e(route('tips')); ?>" class="active"><img src="<?php echo e(asset('icons/tip-icon.png')); ?>" class="nav-icon">Tips</a></li>

                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('users')); ?>"><img src="<?php echo e(asset('icons/users-icon.png')); ?>" class="nav-icon"> Users</a></li>
                <?php endif; ?>

                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('info-pages')); ?>"><img src="<?php echo e(asset('icons/info-pages-icon.png')); ?>" class="nav-icon"> Pages</a></li>
                    <?php endif; ?>

                    <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('account')); ?>"><img src="<?php echo e(asset('icons/account-icon.png')); ?>" class="nav-icon">Account</a></li>
                    <?php endif; ?>


                <?php if(auth()->guard()->check()): ?>
                    
                   
                <?php endif; ?>
            </ul>

    </div>
</nav><?php /**PATH C:\laragon\www\EcoGuide\resources\views/partials/admin/topnav.blade.php ENDPATH**/ ?>