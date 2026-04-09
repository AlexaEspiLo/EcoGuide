<?php $__env->startSection('content'); ?>
<div class="auth-container">
    <div class="auth-box">
        <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo" class="logo">
        <h1 class="auth-title">Explore new ways to care for the planet</h1>

        <form method="POST" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Full Name" required>
            </div>

            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="example@urbangreen.es" required>
            </div>

            <div class="input-group">
                <div class="password-wrapper">
                        <label>Password</label>
                        <input type="password" name="password" id="password" placeholder="********" required>
                        <img src="<?php echo e(asset('icons/eye-hidden-icon.png')); ?>" class="password-toggle-icon" onclick="toggleInput('password', this)" alt="Toggle Password">
                </div>
            </div>

            <div class="input-group">
                <div class="password-wrapper">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" required>
                    <img src="<?php echo e(asset('icons/eye-hidden-icon.png')); ?>" class="password-toggle-icon" onclick="toggleInput('password_confirmation', this)" alt="Toggle Password">
                </div>
            </div>

            <button type="submit" class="btn-primary">Join</button>
        </form>

        <div class="auth-options">
            <a href="<?php echo e(route('login')); ?>" class="login-link">I already have an account</a><br>
            <span class="divider">or</span>
            <button class="btn-google">Register with a Google account</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ecoGuide\resources\views/auth/register.blade.php ENDPATH**/ ?>