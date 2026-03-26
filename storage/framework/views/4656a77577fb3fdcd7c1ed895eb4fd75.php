<div class="flex min-h-screen bg-white">
    <div class="hidden lg:flex lg:w-1/2 items-center justify-center p-12">
        <img src="<?php echo e(asset('images/logo_ecoguide.png')); ?>" alt="Logo" class="absolute top-10 left-10 w-32">
        <img src="<?php echo e(asset('images/decoracion_plantas.jpg')); ?>" class="max-w-full h-auto">
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="bg-[#94a386] rounded-3xl p-10 w-full max-w-md shadow-2xl text-white">
            <h1 class="text-4xl font-serif mb-2">Welcome</h1>
            <p class="mb-8 opacity-90">Explore new ways to care for the planet</p>

            <form action="#" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-6 border-b border-white/50 pb-2">
                    <label class="block text-sm">Email</label>
                    <div class="flex items-center">
                        <span class="mr-2">📧</span>
                        <input type="email" name="email" class="bg-transparent border-none focus:ring-0 w-full placeholder-white/70" placeholder="example@urbangreen.es">
                    </div>
                </div>

                <div class="mb-2 border-b border-white/50 pb-2">
                    <label class="block text-sm">Password</label>
                    <div class="flex items-center">
                        <span class="mr-2">🔒</span>
                        <input type="password" id="password" name="password" class="bg-transparent border-none focus:ring-0 w-full" placeholder="••••••••">
                        <button type="button" id="togglePassword" class="ml-2 focus:outline-none">👁️</button>
                    </div>
                </div>

                <div class="text-right mb-8">
                    <a href="#" class="text-xs hover:underline">I forgot my password</a>
                </div>

                <button type="submit" class="w-full bg-[#d9c5b2] text-[#4a5d3f] font-bold py-3 rounded-full hover:bg-[#c8b39e] transition">
                    Sign In
                </button>

                <div class="text-center my-6 text-sm">Or enter with:</div>

                <div class="flex justify-center">
                    <a href="/auth/google" class="bg-white p-2 rounded-full shadow-md hover:scale-105 transition">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-6 h-6">
                    </a>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\ecoGuide\resources\views/login.blade.php ENDPATH**/ ?>