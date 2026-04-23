

<?php $__env->startSection('content'); ?>

<div style="background-color: #F3EFE0; min-height: 100vh; width: 100%; display: flex; flex-direction: column; padding-top: 80px;">

    
    <div style="background-color: #94b894; width: 100%; padding: 25px 0; margin-bottom: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
        <form action="<?php echo e(route('search')); ?>" method="GET" style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 40px;">
            <input 
                type="text" 
                name="query" 
                placeholder="Search by user, category, or tip" 
                value="<?php echo e($query ?? ''); ?>"
                style="background: transparent; border: none; outline: none; color: #4a5568; width: 90%; font-size: 20px; font-weight: 500; letter-spacing: 0.5px;"
                autofocus
            >
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#4a5568" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </form>
    </div>

    
    <div style="flex-grow: 1; max-width: 1200px; width: 100%; margin: 0 auto; padding: 0 20px;">
        <?php if(isset($query) && $query != ''): ?>
            
            
            <?php if(isset($users) && $users->isNotEmpty()): ?>
                <div style="margin-bottom: 40px;">
                    <h3 style="color: #2d3748; font-weight: bold; border-bottom: 2px solid #d9e4dd; padding-bottom: 8px; margin-bottom: 20px; text-transform: uppercase; font-size: 13px; letter-spacing: 2px;">Usuarios</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="background: white; padding: 8px 22px; border-radius: 50px; box-shadow: 0 2px 5px rgba(0,0,0,0.04); font-weight: 600; font-size: 14px; color: #4a5568;">
                                👤 <?php echo e($user->name); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            
            <div>
                <h3 style="color: #2d3748; font-weight: bold; border-bottom: 2px solid #d9e4dd; padding-bottom: 8px; margin-bottom: 25px; text-transform: uppercase; font-size: 13px; letter-spacing: 2px;">Tips encontrados</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
                    <?php $__empty_1 = true; $__currentLoopData = $tips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php echo $__env->make('components.tip-card', ['tip' => $tip], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 80px 0;">
                            <p style="font-size: 18px; color: #a0aec0; font-style: italic;">No encontramos resultados para tu búsqueda.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php else: ?>
            <div style="text-align: center; padding: 100px 0; color: #cbd5e0;">
                <p style="font-size: 22px; font-weight: 300;"></p>
            </div>
        <?php endif; ?>
    </div>

    
    <footer style="background-color: white; padding: 40px 0; border-top: 1px solid #edf2f7; width: 100%;">
        <div style="max-width: 800px; margin: 0 auto; display: flex; justify-content: space-around; font-weight: bold; letter-spacing: 3px; font-size: 10px; text-transform: uppercase; color: #2d3748;">
            <a href="#" style="text-decoration: none; color: inherit;">About Us</a>
            <a href="#" style="text-decoration: none; color: inherit;">Contact</a>
            <a href="#" style="text-decoration: none; color: inherit;">Privacy Policy</a>
        </div>
    </footer>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\EcoGuide\resources\views/search_results.blade.php ENDPATH**/ ?>