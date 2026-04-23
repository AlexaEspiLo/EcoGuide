<?php $__env->startSection('content'); ?>

<section class="hero-home">
</section>

    <div class="hero-content">
        <h1 class="title">Sustainable Tips</h1>
        <h2 class="subtitle">For Everyday Life</h2>
        <p class="phrase">Small actions can create a big impact</p>
    </div>

    <div style="background-color: #d9e4dd; width: 100vw; position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; padding: 15px 0; margin-bottom: 30px;">
        <form action="<?php echo e(route('search')); ?>" method="GET" style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 40px;">
            <input 
                type="text" 
                name="query" 
                placeholder="Search by user, category, or tip" 
                value="<?php echo e($query ?? ''); ?>"
                style="background: transparent; border: none; outline: none; font-style: italic; color: #4a5568; width: 90%; font-size: 18px;"
            >
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#6b7280" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </form>
    </div>

    <div class="filters">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="category">
                #<?php echo e(str_replace(' ', '', Str::title($category->category_name))); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit">Cerrar Sesión</button>
        </form>
    </div>

    <?php if(isset($results)): ?>
        <div class="search-results-label" style="padding: 0 20px; margin-bottom: 20px;">
            <p style="color: #666;">Mostrando resultados para: <strong><?php echo e($query); ?></strong></p>
        </div>
        <div class="results-container">
            <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php echo $__env->make('components.tip-card', ['tip' => $tip], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="text-align: center; padding: 40px;">No se encontraron tips que coincidan con tu búsqueda.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <?php echo $__env->make('components.tip-card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div class="fixed-add-button-container">
        <a href="#" class="fixed-add-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
        </a>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\EcoGuide\resources\views/user/home.blade.php ENDPATH**/ ?>