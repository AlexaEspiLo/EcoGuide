<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoGuide - Register</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css?v=' . time())); ?>">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@1,400;1,700&family=Playfair+Display:ital@1&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header">
        <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo" class="logo">
    </header>

    <main class="login-container">
        <div class="glass-panel">
            
            <h1 class="welcome-title">Welcome</h1>
            <p class="subtitle">Small actions can create a big impact on our planet</p>

            <?php if($errors->any()): ?>
                <div style="color: #ffffff; background: rgba(255, 0, 0, 0.3); padding: 10px; border-radius: 10px; margin-bottom: 20px; font-size: 0.8rem; text-align: center;">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form class="login-form" action="<?php echo e(route('register.post')); ?>" method="POST">
                <?php echo csrf_field(); ?> <div class="input-group">
                    <label for="name" class="field-label">Full Name</label>
                    <div class="input-wrapper">
                        <span class="icon">👤</span> 
                        <input type="text" id="name" name="name" placeholder="Tu nombre completo" value="<?php echo e(old('name')); ?>" required>
                    </div>
                </div>

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
                        <span class="icon">🔒</span>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                        <span class="icon eye-icon" id="togglePassword">&#128065;</span>
                    </div>
                </div>

                <div class="input-group">
                    <label for="password_confirmation" class="field-label">Confirm Password</label>
                    <div class="input-wrapper">
                        <span class="icon">🔒</span>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                         <span class="icon eye-icon" id="togglePasswordConfirm">&#128065;</span>
                    </div>
                </div>

                <a href="<?php echo e(route('login')); ?>" class="forgot-password" style="text-align: center; margin-bottom: 10px;">I already have an account</a>

                <button type="submit" class="sign-in-btn">Register</button>
            </form>

            
        </div>
    </main>

    <div class="corner-leaf bottom-left">&#127809;</div>
    <div class="corner-leaf bottom-right">&#127809;</div>

    <script>
        // Función para mostrar/ocultar contraseña
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });

        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirm = document.querySelector('#password_confirmation');
        togglePasswordConfirm.addEventListener('click', function () {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\EcoGuide\resources\views/auth/register.blade.php ENDPATH**/ ?>