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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Data Siswa')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl border border-gray-100">

                <!-- Header Card -->
                <div
                    class="p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-white border-b border-gray-200 rounded-t-2xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 sm:mb-0 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Daftar Siswa
                    </h3>
                    <a href="<?php echo e(route('admin.siswa.create')); ?>"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150">
                        + Tambah Siswa Baru
                    </a>
                </div>

                <!-- Flash Message -->
                <?php if(session('success')): ?>
                    <div class="m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <!-- Table -->
                <div class="overflow-x-auto p-6">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($index + 1); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($siswa->user->name); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($siswa->user->email); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($siswa->nis); ?></td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($siswa->alamat ?? '-'); ?></td>
                                    <td class="px-6 py-4">
                                        <?php if($siswa->status == 'Aktif'): ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        <?php elseif($siswa->status == 'Lulus'): ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Lulus</span>
                                        <?php else: ?>
                                            <span
                                                class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800"><?php echo e($siswa->status); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium flex gap-2">
                                        <a href="<?php echo e(route('admin.siswa.show', $siswa)); ?>"
                                            class="text-indigo-600 hover:text-indigo-900 transition">Lihat</a>
                                        <a href="<?php echo e(route('admin.siswa.edit', $siswa)); ?>"
                                            class="text-blue-600 hover:text-blue-900 transition">Edit</a>
                                        <form method="POST" action="<?php echo e(route('admin.siswa.destroy', $siswa)); ?>"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 transition">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data siswa.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php endif; ?><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/siswa/index.blade.php ENDPATH**/ ?>