<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoGuide - <?php echo $__env->yieldContent('title', 'Welcome'); ?></title>
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet"> 
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> 
    <link href="<?php echo e(asset('css/general.css')); ?>" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@1,400;1,700&family=Playfair+Display:ital@1&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body class="bg-image">

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const passwordInput = document.querySelector('#password');

            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function (e) {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    if (type === 'text') {
                        this.src = '<?php echo e(asset("icons/eye-visible-icon.png")); ?>';
                    } else {
                        this.src = '<?php echo e(asset("icons/eye-hidden-icon.png")); ?>';
                    }
                });
            }
        });
        function toggleInput(inputId, iconElement) {
        const input = document.getElementById(inputId);
        const eyeVisible = "<?php echo e(asset('icons/eye-visible-icon.png')); ?>";
        const eyeHidden = "<?php echo e(asset('icons/eye-hidden-icon.png')); ?>";

        if (input.type === "password") {
            input.type = "text";
            iconElement.src = eyeVisible;
        } else {
            input.type = "password";
            iconElement.src = eyeHidden;
        }
    }
    </script>

</body>
</html><?php /**PATH C:\laragon\www\ecoGuide\resources\views/layouts/auth.blade.php ENDPATH**/ ?>