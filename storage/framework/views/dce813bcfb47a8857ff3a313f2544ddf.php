

<?php $__env->startSection('content'); ?>
<div class="auth-container">
    <div class="auth-box" style="background-color: rgba(144, 161, 126, 0.85); padding: 3rem; border-radius: 40px; text-align: center;">
        <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo" class="logo" style="width: 150px; margin-bottom: 1rem;">
        <h1 class="auth-title" style="color: white; font-style: italic; font-size: 1.8rem; margin-bottom: 0.5rem;">Reset Password</h1>
        <p style="color: white; margin-bottom: 2rem; font-size: 0.9rem;">We will send a link to your email</p>

        <?php if(session('status')): ?>
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 10px; margin-bottom: 1rem; font-size: 0.8rem;">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>
            <div style="margin-bottom: 1.5rem; text-align: left;">
                <label style="color: #354024; font-weight: bold; text-transform: uppercase; font-size: 0.8rem;">Email Address</label>
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" style="width: 100%; background: transparent; border: none; border-bottom: 2px solid #354024; color: #354024; padding: 10px 0; outline: none;" placeholder="example@urbangreen.es" required>
            </div>
            
            <button type="submit" class="btn-primary" style="background: #CFBB99; border: none; padding: 1rem; border-radius: 50px; width: 100%; font-weight: bold; color: #4C3D19; cursor: pointer; margin-top: 1rem;">
                SEND RESET LINK
            </button>
        </form>

        <div style="margin-top: 2rem;">
            <a href="<?php echo e(route('login')); ?>" style="color: #354024; text-decoration: none; font-weight: bold; font-size: 0.9rem;">← Back to Login</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\EcoGuide\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>