<div class="grid-container">
        <?php $__currentLoopData = $tips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cards">
                <div class="header-card">
                    <h3 class="title-card"><?php echo e($tip->title); ?></h3>
                    <img src="<?php echo e(asset('images/bg-home.jpeg')); ?>" class="category-img" alt="category">
                </div>

                <div class="card-author">
                    <img src="<?php echo e(asset('images/bg-home.jpeg')); ?>" class="author-img" alt="avatar">
                    <span class="author-name"><?php echo e($tip->user->name); ?></span>
                </div>

                <p class="card-description"><?php echo e(Str::limit($tip->description, 80)); ?></p>

                <div class="footer-card">
                    <a class="more" href="<?php echo e(route('tip.show', $tip->id)); ?>">See Tip</a>
                    <div class="tipss like-section" id="<?php echo e($tip->id); ?>" style="cursor: pointer;">
                        <span id="count<?php echo e($tip->id); ?>" class="likes-count">
                            <?php echo e(number_format($tip->likes->count())); ?>

                        </span>
                        
                        <?php if(auth()->guard()->check()): ?>
                            <span id="heart<?php echo e($tip->id); ?>" style="color: <?php echo e($tip->isLikedByLoggedInUser() ? '#354024' : 'var(--beige)'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                </svg>
                            </span>
                        <?php else: ?> 
                            <a href="/login" style="color: var(--beige)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div><?php /**PATH C:\laragon\www\ecoGuide\resources\views/components/tip-card.blade.php ENDPATH**/ ?>