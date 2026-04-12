

<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('css/admin/account.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="account-page">
    <div class="account-shell">
        <div class="account-top">
            <div class="account-profile">
                <div class="account-avatar">
                    <img src="<?php echo e(asset('images/placeholder_user.png')); ?>" alt="User Avatar">
                    <button type="button" class="avatar-edit" id="openAvatarModal">
                        <img src="<?php echo e(asset('icons/edit2-icon.png')); ?>" alt="Edit avatar">
                    </button>
                </div>
                <div class="account-user">
                    <h1 class="account-user-name">Elías Montoya</h1>
                    <p class="account-user-email">montoyaelias@gmail.com</p>
                </div>
            </div>

            <form action="<?php echo e(route('logout')); ?>" method="POST" class="logout-form">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        </div>

        <div class="account-form-card">
            <form action="" method="POST" class="profile-content">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="Elías Montoya">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="montoyaelias@gmail.com">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <span class="label-instruction">Enter your new password to change it</span>
                    <input type="password" id="password" name="password" placeholder="••••••••">
                </div>
            </form>
        </div>
    </div>

  

    <div class="upload-modal" id="avatarUploadModal" aria-hidden="true">
        <div class="upload-modal-card">
            <button type="button" class="upload-modal-close" id="closeAvatarModal">
                <img src="<?php echo e(asset('icons/x-icon.png')); ?>" alt="Close modal">
            </button>
            <label for="avatarUploadInput" class="upload-dropzone">
                <img src="<?php echo e(asset('icons/load-file-icon.png')); ?>" alt="Upload icon">
                <span>Click to Upload Image</span>
            </label>
            <input id="avatarUploadInput" type="file" accept="image/*" class="upload-file-input">
        </div>
    </div>
</section>

  <?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var openBtn = document.getElementById('openAvatarModal');
        var closeBtn = document.getElementById('closeAvatarModal');
        var modal = document.getElementById('avatarUploadModal');

        if (openBtn && closeBtn && modal) {
            openBtn.addEventListener('click', function () {
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
            });

            closeBtn.addEventListener('click', function () {
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.remove('open');
                    modal.setAttribute('aria-hidden', 'true');
                }
            });
        }
    });
</script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\EcoGuide\resources\views/admin/account.blade.php ENDPATH**/ ?>