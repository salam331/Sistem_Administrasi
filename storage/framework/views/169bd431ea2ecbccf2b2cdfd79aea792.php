<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <?php echo e(__('Dashboard Siswa')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <?php echo e(__("Selamat Datang,")); ?> <strong><?php echo e(Auth::user()->name); ?>!</strong>

                    
                    <?php if(Auth::user()->siswa): ?>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            NIS: <?php echo e(Auth::user()->siswa->nis); ?> |
                            Kelas: <?php echo e(Auth::user()->siswa->kelas->nama_kelas ?? 'Belum ada kelas'); ?>

                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="<?php echo e(route('siswa.jadwal.index')); ?>"
                    class="bg-blue-100 dark:bg-blue-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-blue-200 dark:hover:bg-blue-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Jadwal Pelajaran</h3>
                    <p class="mt-2 text-sm text-blue-700 dark:text-blue-300">Lihat jadwal pelajaran mingguan Anda.</p>
                </a>

                <a href="<?php echo e(route('siswa.presensi.index')); ?>"
                    class="bg-green-100 dark:bg-green-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-green-200 dark:hover:bg-green-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-green-900 dark:text-green-100">Presensi Saya</h3>
                    <p class="mt-2 text-sm text-green-700 dark:text-green-300">Lihat riwayat presensi Anda.</p>
                </a>

                <a href="<?php echo e(route('siswa.wali-kelas.show')); ?>"
                    class="bg-purple-100 dark:bg-purple-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-purple-200 dark:hover:bg-purple-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-purple-900 dark:text-purple-100">Wali Kelas</h3>
                    <p class="mt-2 text-sm text-purple-700 dark:text-purple-300">
                        <?php if($waliKelas): ?>
                            <?php echo e($waliKelas->user->name); ?>

                        <?php else: ?>
                            Belum ditentukan
                        <?php endif; ?>
                    </p>
                </a>

                <a href="<?php echo e(route('siswa.tagihan.index')); ?>"
                    class="bg-yellow-100 dark:bg-yellow-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-yellow-200 dark:hover:bg-yellow-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-yellow-900 dark:text-yellow-100">Status Tagihan</h3>
                    <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                        Anda memiliki <?php echo e($jumlahTagihanBelumLunas); ?> tagihan belum lunas.
                    </p>
                </a>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/siswa/dashboard.blade.php ENDPATH**/ ?>