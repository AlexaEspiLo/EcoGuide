<footer class="footer">
    <div class="footer-links">
        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(Route::has('page.show')): ?>
                <a href="<?php echo e(route('page.show', $page->slug)); ?>">
                    <?php echo e($page->title); ?>

                </a>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</footer><?php /**PATH C:\laragon\www\ecoGuide\resources\views/partials/footer.blade.php ENDPATH**/ ?>