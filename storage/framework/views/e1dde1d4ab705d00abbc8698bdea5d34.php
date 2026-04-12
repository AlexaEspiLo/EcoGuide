

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('css/admin/info-pages.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="info-pages-page">
    <div class="info-pages-inner">
        <div class="info-pages-left">
            <h2 class="info-pages-title">Info Pages</h2>
            <aside class="info-pages-sidebar">
                <nav class="info-pages-nav">
                    <button type="button" class="info-pages-button">
                        <span class="info-pages-icon">+</span>
                        <span>New</span>
                    </button>

                    <a href="#" class="info-pages-link active">
                        <span class="info-pages-arrow">›</span>
                        <span>About Us</span>
                    </a>

                    <a href="#" class="info-pages-link">
                        <span class="info-pages-arrow">›</span>
                        <span>Contact</span>
                    </a>

                    <a href="#" class="info-pages-link">
                        <span class="info-pages-arrow">›</span>
                        <span>Privacy Policy</span>
                    </a>
                </nav>
            </aside>
        </div>

        <main class="info-pages-main">
            <div class="info-pages-card">
                <form action="" method="POST" class="info-pages-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="info-pages-row">
                        <div class="info-pages-label-wrap">
                            <label for="title" class="info-pages-label">Title</label>
                        </div>
                        <br>
                        <div class="info-pages-control">
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="About Us"
                                class="info-pages-input"
                            >
                        </div>
                    </div>

                    <div class="info-pages-row info-pages-row--content">
                        <div class="info-pages-label-wrap">
                            <span class="info-pages-label">Content</span>
                        </div>
                        <br>
                        <div class="info-pages-control">
                            <textarea
                                id="content"
                                name="content"
                                class="info-pages-textarea"
                            >At EcoGuide, our mission is to empower a global community to explore new ways to care for the planet. We are dedicated to providing sustainable tips for everyday life, rooted in the firm belief that small actions can create a big impact on our planet.</textarea>
                        </div>
                    </div>

                    <div class="info-pages-footer">
                        <button type="submit" class="info-pages-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\EcoGuide\resources\views/admin/info-pages.blade.php ENDPATH**/ ?>