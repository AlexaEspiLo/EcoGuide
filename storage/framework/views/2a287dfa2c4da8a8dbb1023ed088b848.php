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
                 <div class="password-wrapper" style="position: relative;">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required style="width: 100%;">
                    <img src="<?php echo e(asset('icons/eye-hidden-icon.png')); ?>" class="password-toggle-icon" onclick="toggleInput('password')" alt="Toggle Password" style="position: absolute; right: 10px; top: 35px; cursor: pointer; width: 20px;">
                </div>
            </div>

            <button type="submit" class="btn-primary">Sign In</button>
        </form>

        <div class="auth-options">
            <a href="<?php echo e(url('/auth/google')); ?>" class="btn-google" style="text-decoration: none; display: flex; align-items: center; justify-content: center; margin-top: 20px; border: 1px solid #354024; border-radius: 20px; padding: 10px; color: #354024;">
                <img src="<?php echo e(asset('images/google-icon.png')); ?>" alt="" style="margin-right: 10px; width: 20px;"> 
                Enter with a Google account
            </a>
            
            <div style="margin-top: 15px;">
                <a href="<?php echo e(route('register')); ?>" class="btn-outline">Create new Account</a>
            </div>
            
            <a href="<?php echo e(route('password.request')); ?>" class="forgot-link">Forgot password?</a>
        </div>
    </div>
</div>

<script>
    function toggleInput(id) {
        const input = document.getElementById(id);
        input.type = input.type === "password" ? "text" : "password";
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ecoGuide\resources\views/auth/login.blade.php ENDPATH**/ ?>