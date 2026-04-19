<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('search')); ?>" method="GET">
    <input type="text" name="query" placeholder="Search by user, category, or tip">
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\EcoGuide\resources\views/user/search.blade.php ENDPATH**/ ?>