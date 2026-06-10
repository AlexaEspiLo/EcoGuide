<?php $__env->startSection('title', 'Home'); ?>
<?php $__env->startSection('content'); ?>

    <section class="hero-home" id="hero-home">
    </section>

    <section id="hero-content" class="hero-content">
        <h1 class="title">Sustainable Tips</h1>
        <h2 class="subtitle">For Everyday Life</h2>
    </section>

    <section id="tipsSection" class="tips-section">
        <div class="categories-wrapper">

            <button class="scroll-btn left" id="scrollLeft">
                ❮
            </button>

            <div class="filters-home" id="categoriesContainer">

                <div class="category active" data-id="all">
                    <?php echo e(__('messages.all')); ?>

                </div>

                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="category" data-id="<?php echo e($category->id); ?>">
                        #<?php echo e(str_replace(' ', '', Str::title($category->category_name))); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <button class="scroll-btn right" id="scrollRight">
                ❯
            </button>

        </div>

        <div class="sort-container">

            <div class="custom-select" id="sortSelect">

                <div class="selected-option">
                    <?php echo e(__('messages.sort-by')); ?>

                </div>

                <div class="options-container">

                    <div class="option" data-value="">
                        <?php echo e(__('messages.default')); ?>

                    </div>

                    <div class="option" data-value="newest">
                        <?php echo e(__('messages.newest')); ?>

                    </div>

                    <div class="option" data-value="oldest">
                        <?php echo e(__('messages.oldest')); ?>

                    </div>

                    <div class="option" data-value="most_liked">
                        <?php echo e(__('messages.most-liked')); ?>

                    </div>

                    <div class="option" data-value="title">
                        A-Z
                    </div>

                </div>

            </div>

        </div>

        <div id="tips-container" class="grid-container">
            <?php $__currentLoopData = $tips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.tip', ['tip' => $tip], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if($tips->hasMorePages()): ?>
            <div class="load-more-container">
                <button id="load-more-btn" data-page="2">
                    <?php echo e(__('messages.load-more')); ?>

                </button>
            </div>
        <?php endif; ?>
    </section>







    <div class="fixed-add-button-container">
        <a href="<?php echo e(route('tips.create')); ?>" class=" fixed-add-button">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-plus"
                viewBox="0 0 16 16">
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
        </a>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ecoGuide\resources\views/user/home.blade.php ENDPATH**/ ?>