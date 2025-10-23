

<div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden" @click="sidebarOpen = false"
    x-cloak></div>

<nav class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 bg-gray-800 text-white transform transition-transform duration-300
           -translate-x-full md:translate-x-0 shadow-lg" :class="{ 'translate-x-0': sidebarOpen }" x-cloak>

    <div class="flex items-center justify-center h-16 flex-shrink-0 shadow-md bg-gray-900">
        <a href="<?php echo e(route('siswa.dashboard')); ?>">
            <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'block h-9 w-auto fill-current text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'block h-9 w-auto fill-current text-white']); ?>
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
        </a>
    </div>

    <div class="flex-1 overflow-y-auto mt-4 space-y-1">

        <?php
            $linkClasses = "flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md mx-2 transition ease-in-out duration-150";
            $activeClasses = "flex items-center px-4 py-2 bg-gray-900 text-white rounded-md mx-2";
        ?>

        <a href="<?php echo e(route('siswa.dashboard')); ?>"
            class="<?php echo e(request()->routeIs('siswa.dashboard') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Dashboard</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Akademik</h3>

        <a href="<?php echo e(route('siswa.jadwal.index')); ?>" class="<?php echo e(request()->routeIs('siswa.jadwal.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Jadwal Pelajaran</span>
        </a>
        <a href="<?php echo e(route('siswa.presensi.index')); ?>" class="<?php echo e(request()->routeIs('siswa.presensi.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Presensi Saya</span>
        </a>
        <a href="<?php echo e(route('siswa.wali-kelas.show')); ?>" class="<?php echo e(request()->routeIs('siswa.wali-kelas.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Wali Kelas</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Administrasi</h3>
        <a href="<?php echo e(route('siswa.tagihan.index')); ?>" class="<?php echo e(request()->routeIs('siswa.tagihan.*') ? $activeClasses : $linkClasses); ?>">
            <span class="ms-2">Tagihan Saya</span>
        </a>

    </div>
</nav>
<?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/layouts/siswa-sidebar.blade.php ENDPATH**/ ?>