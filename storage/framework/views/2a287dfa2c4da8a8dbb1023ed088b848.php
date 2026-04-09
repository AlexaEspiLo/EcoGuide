<?php $__env->startSection('content'); ?>
<div class="auth-container">
    <div class="auth-box">
        <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo" class="logo">
        
        <h1 class="auth-title">Explore new ways to care for the planet</h1>
        <?php if($errors->any()): ?>
                <div style="color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.8rem; text-align: center;">
                    <?php echo e($errors->first()); ?>

                </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@urbangreen.es" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="input-group">
                 <div class="password-wrapper">
                    <label>Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <img src="<?php echo e(asset('icons/eye-hidden-icon.png')); ?>" alt="Toggle Password" id="togglePassword" class="password-toggle-icon">
                </div>
            </div>

            <button type="submit" class="btn-primary">Sign In</button>
        </form>

        <div class="auth-options">
            <button class="btn-google">
                <img src="<?php echo e(asset('images/google-icon.png')); ?>" alt=""> Enter with a Google account
            </button>
            
            <a href="<?php echo e(route('register')); ?>" class="btn-outline">Create new Account</a>
            
            <a href="#" class="forgot-link">Forgot password?</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ecoGuide\resources\views/auth/login.blade.php ENDPATH**/ ?>