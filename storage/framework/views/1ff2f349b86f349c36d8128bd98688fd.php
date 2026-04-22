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
                <div class="password-wrapper" style="position: relative;">
                    <label>Password</label>
                    <input type="password" name="password" id="password" placeholder="********" required style="width: 100%;">
                    <img src="<?php echo e(asset('icons/eye-hidden-icon.png')); ?>" class="password-toggle-icon" onclick="toggleInput('password')" style="position: absolute; right: 10px; top: 35px; cursor: pointer; width: 20px;">
                </div>
            </div>

            <div class="input-group">
                <div class="password-wrapper" style="position: relative;">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" required style="width: 100%;">
                    <img src="<?php echo e(asset('icons/eye-hidden-icon.png')); ?>" class="password-toggle-icon" onclick="toggleInput('password_confirmation')" style="position: absolute; right: 10px; top: 35px; cursor: pointer; width: 20px;">
                </div>
            </div>

            <button type="submit" class="btn-primary">Join</button>
        </form>

        <div class="auth-options">
            <a href="<?php echo e(route('login')); ?>" class="login-link">I already have an account</a><br>
            <span class="divider">or</span>
            
            <a href="<?php echo e(url('/auth/google')); ?>" class="btn-google" style="text-decoration: none; display: flex; align-items: center; justify-content: center; border: 1px solid #354024; border-radius: 20px; padding: 10px; color: #354024;">
                <img src="<?php echo e(asset('images/google-icon.png')); ?>" alt="" style="margin-right: 10px; width: 18px;">
                Register with a Google account
            </a>
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
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ecoGuide\resources\views/auth/register.blade.php ENDPATH**/ ?>