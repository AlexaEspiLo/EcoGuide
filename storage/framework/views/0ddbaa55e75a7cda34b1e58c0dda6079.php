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
<body>
    <header class="header">
        <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="EcoGuide Logo" class="logo">
    </header>
    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html><?php /**PATH C:\laragon\www\ecoGuide\resources\views/layouts/auth.blade.php ENDPATH**/ ?>