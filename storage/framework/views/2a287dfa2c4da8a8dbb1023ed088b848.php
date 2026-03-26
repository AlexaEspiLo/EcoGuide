<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('content'); ?>
    <main class="login-container">
        <div class="glass-panel">
            <h1 class="welcome-title">Welcome</h1>
            <p class="subtitle">Explore new ways to care for the planet</p>

            <?php if($errors->any()): ?>
                <div style="color: #721c24; background: #f8d7da; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.8rem; text-align: center;">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form class="login-form" action="<?php echo e(route('login.post')); ?>" method="POST">
                <?php echo csrf_field(); ?> 
                <div class="input-group">
                    <label for="email" class="field-label">Email</label>
                    <div class="input-wrapper">
                        <span class="icon">&#127809;</span> 
                        <input type="email" id="email" name="email" placeholder="example@urbangreen.es" value="<?php echo e(old('email')); ?>" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password" class="field-label">Password</label>
                    <div class="input-wrapper">
                        <span class="icon">&#128274;</span>
                        <input type="password" id="password" name="password" required>
                        <span class="icon eye-icon" id="togglePassword" style="cursor:pointer;">&#128065;</span>
                    </div>
                    <a href="#" class="forgot-password">I forgot my password</a>
                </div>

                <button type="submit" class="sign-in-btn">Sign In</button>
            </form>

            <div class="social-login">
                <p>Or enter with:</p>
                <button type="button" class="google-btn" style="background:none; border:none; cursor:pointer;">
                    <img src="<?php echo e(asset('images/google_icon.png?v=' . time())); ?>" alt="Google Logo" class="google-icon">
                </button>
            </div>

            <div style="margin-top: 20px; text-align: center; font-family: 'Poppins', sans-serif; font-size: 0.9rem;">
                <p style="color: #444;">Don't have an account? 
                    <a href="<?php echo e(route('register')); ?>" style="color: #2d5a27; font-weight: bold; text-decoration: none; border-bottom: 1px solid #2d5a27;">Sign Up</a>
                </p>
            </div>
            
            <footer class="panel-footer" style="margin-top:20px; font-size: 0.8rem; text-align:center; opacity:0.6;">
                <p>Green and Sustainable by Nature</p>
            </footer>
        </div>
    </main>

    <div class="corner-leaf bottom-left">&#127809;</div>
    <div class="corner-leaf bottom-right">&#127809;</div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ecoGuide\resources\views/auth/login.blade.php ENDPATH**/ ?>