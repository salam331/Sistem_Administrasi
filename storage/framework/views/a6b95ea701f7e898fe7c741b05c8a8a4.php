<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" x-data="mainApp()" x-init="init()"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="shortcut icon" href="favicon-32x32.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <script>
        // Inline script untuk hindari FOUC (Flash of Unstyled Content)
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors">

    
    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php if(Auth::user()->hasRole('admin')): ?>
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> 
    <?php elseif(Auth::user()->hasRole('siswa')): ?>
        <?php echo $__env->make('layouts.siswa-navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> 
    <?php elseif(Auth::user()->hasRole('guru')): ?>
         
    <?php endif; ?>
    
    <main class="lg:ml-64 p-10 mt-10">

        
        <section>
            <?php if(isset($header)): ?>
                <header class="bg-gray-50 dark:bg-gray-800 shadow mb-4 p-4 rounded-xl">
                    <?php echo e($header); ?>

                </header>
            <?php endif; ?>

            <div>
                <?php echo e($slot); ?>

            </div>
        </section>
    </main>

    
    <script>
        function mainApp() {
            return {
                darkMode: localStorage.getItem('theme') === 'dark',
                sidebarOpen: false,

                init() {
                    this.updateTheme();
                    window.addEventListener('resize', () => {
                        if (window.innerWidth >= 1024) {
                            this.sidebarOpen = true;
                        }
                    });
                },

                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                    this.updateTheme();
                },

                updateTheme() {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
            }
        }
    </script>
</body>

</html><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/layouts/app.blade.php ENDPATH**/ ?>