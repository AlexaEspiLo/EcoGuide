<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>

    <section class="hero-home">
    </section>

    <div class="hero-content">
        <h1 class="title">Sustainable Tips</h1>
        <h2 class="subtitle">For Everyday Life</h2>
        <p class="phrase">Small actions can create a big impact</p>
    </div>

    <div class="filters">
        <div class="category active" data-id="all">
            All
        </div>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="category" data-id="<?php echo e($category->id); ?>">
                #<?php echo e(str_replace(' ', '', Str::title($category->category_name))); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div id="tips-container">
        <?php echo $__env->make('partials.tips', ['tips' => $tips], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="fixed-add-button-container">
        <a href="<?php echo e(route('tips.create')); ?>"" class="fixed-add-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
        </a>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ecoGuide\resources\views/user/home.blade.php ENDPATH**/ ?>