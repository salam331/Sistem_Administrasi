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
            <?php echo e(__('Data Pengguna')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg border border-blue-200 dark:border-slate-700">
                <div class="p-6 text-blue-900 dark:text-slate-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Kelola Data Pengguna</h3>
                        <a href="<?php echo e(route('admin.users.create')); ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Pengguna
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $userCounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('admin.users.role', $role)); ?>" class="block">
                                <div class="bg-<?php echo e($role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green')); ?>-100 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-lg transition-shadow border border-<?php echo e($role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green')); ?>-200 dark:border-slate-600">
                                    <h3 class="text-lg font-semibold text-<?php echo e($role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green')); ?>-900 dark:text-slate-100 capitalize"><?php echo e(ucfirst($role)); ?></h3>
                                    <p class="mt-2 text-sm text-<?php echo e($role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green')); ?>-700 dark:text-slate-300"><?php echo e($count); ?> pengguna</p>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
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
<?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/users/index.blade.php ENDPATH**/ ?>