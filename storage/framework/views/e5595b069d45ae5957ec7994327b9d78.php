

<div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden" @click="sidebarOpen = false"
    x-cloak></div>

<nav class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 bg-slate-800 text-white transform transition-transform duration-300
           -translate-x-full md:translate-x-0 shadow-lg" :class="{ 'translate-x-0': sidebarOpen }" x-cloak>

    
    <div class="flex items-center justify-center h-16 bg-slate-900 shadow-md">
        <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center space-x-2">
            <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'block h-8 w-auto fill-current text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'block h-8 w-auto fill-current text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
            <span class="font-semibold text-white">SMAN 1 Donggo</span>
        </a>
    </div>

    
    <div class="flex-1 overflow-y-auto mt-4 space-y-1 pb-6">
        <?php
            $linkClasses = "flex items-center px-4 py-2 text-slate-300 hover:bg-slate-700 hover:text-white rounded-md mx-2 transition";
            $activeClasses = "flex items-center px-4 py-2 bg-slate-900 text-white rounded-md mx-2";
        ?>

        <a href="<?php echo e(route('dashboard')); ?>"
            class="<?php echo e(request()->routeIs('dashboard') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Dashboard</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Master Data</h3>
        <a href="<?php echo e(route('admin.users.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.users.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Data Pengguna</span>
        </a>
        <a href="<?php echo e(route('admin.guru.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.guru.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Data Guru</span>
        </a>
        <a href="<?php echo e(route('admin.siswa.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.siswa.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Data Siswa</span>
        </a>
        <a href="<?php echo e(route('admin.kelas.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.kelas.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Data Kelas</span>
        </a>
        <a href="<?php echo e(route('admin.mapel.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.mapel.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Data Mapel</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Akademik</h3>
        <a href="<?php echo e(route('admin.jadwal.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.jadwal.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Jadwal Pelajaran</span>
        </a>
        <a href="<?php echo e(route('admin.presensi.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.presensi.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Presensi Siswa</span>
        </a>
        <a href="<?php echo e(route('admin.nilai.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.nilai.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Input Nilai</span>
        </a>
        <a href="<?php echo e(route('admin.raport.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.raport.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Cetak Raport</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Administrasi</h3>
        <a href="<?php echo e(route('admin.surat-keluar.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.surat-keluar.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Arsip Surat</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Keuangan</h3>
        <a href="<?php echo e(route('admin.tagihan.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.tagihan.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Data Tagihan</span>
        </a>
        <a href="<?php echo e(route('admin.pembayaran.index')); ?>"
            class="<?php echo e(request()->routeIs('admin.pembayaran.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Input Pembayaran</span>
        </a>


    </div>
</nav>
<?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/layouts/admin-sidebar.blade.php ENDPATH**/ ?>