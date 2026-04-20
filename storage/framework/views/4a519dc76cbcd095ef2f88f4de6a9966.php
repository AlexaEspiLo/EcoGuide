
<?php $__env->startSection('content'); ?>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="banner"></div>

        <div class="profile">
            <img src="https://i.pravatar.cc/150" class="avatar">
            <h2><?php echo e($user->name ?? 'Nombre Usuario'); ?></h2>
        </div>
    </div>

    <!-- TABS -->
    <div class="tabs">
        <div class="tab active">❤️ Favorites</div>
        <div class="tab">My Tips</div>
    </div>

    <!-- CARDS DINÁMICAS -->
    <div class="cards">

       <?php $__empty_1 = true; $__currentLoopData = $tips ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card">
                <h3><?php echo e($tip->titulo); ?></h3>
                <p><?php echo e($tip->descripcion); ?></p>

                <div class="card-footer">
                    <button>See Tip</button>
                    <span><?php echo e($tip->likes); ?> ❤️</span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="empty">No hay tips todavía</p>
        <?php endif; ?>

    </div>

</div>

</body>
</html>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\EcoGuide\resources\views/user/profile.blade.php ENDPATH**/ ?>