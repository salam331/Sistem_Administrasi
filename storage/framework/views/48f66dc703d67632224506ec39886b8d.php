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
            <?php echo e(__('Detail Kelas')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">

                <!-- Header Card -->
                <div
                    class="p-8 bg-gradient-to-r from-blue-600 to-blue-700 text-white flex justify-between items-center">
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0v7" />
                        </svg>
                        Detail Kelas
                    </h3>
                    <div class="space-x-2">
                        <a href="<?php echo e(route('admin.kelas.edit', $kelas)); ?>"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition duration-150">
                            ✏️ Edit
                        </a>
                        <a href="<?php echo e(route('admin.kelas.index')); ?>"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition duration-150">
                            ← Kembali
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <!-- Informasi Kelas -->
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                            <h4 class="text-lg font-semibold mb-4 text-blue-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Informasi Kelas
                            </h4>
                            <div class="space-y-4 text-gray-800">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nama Kelas</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($kelas->nama_kelas); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Tingkat</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($kelas->tingkat); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Wali Kelas</label>
                                    <p class="mt-1 text-base font-semibold">
                                        <?php if($kelas->waliKelas && $kelas->waliKelas->user): ?>
                                            <?php echo e($kelas->waliKelas->user->name); ?> (NIP: <?php echo e($kelas->waliKelas->nip); ?>)
                                        <?php else: ?>
                                            <span class="text-gray-500 italic">Belum ditentukan</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Jumlah Siswa</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($kelas->siswas->count()); ?> siswa</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Dibuat Pada</label>
                                    <p class="mt-1 text-base font-semibold text-gray-700">
                                        <?php echo e($kelas->created_at->format('d M Y H:i')); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                                    <p class="mt-1 text-base font-semibold text-gray-700">
                                        <?php echo e($kelas->updated_at->format('d M Y H:i')); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Daftar Siswa -->
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                            <h4 class="text-lg font-semibold mb-4 text-blue-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-6h13v6m-9 4h4m4-10l-7-7-7 7" />
                                </svg>
                                Daftar Siswa
                            </h4>
                            <?php if($kelas->siswas->count() > 0): ?>
                                <div class="space-y-2 max-h-64 overflow-y-auto">
                                    <?php $__currentLoopData = $kelas->siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="flex justify-between items-center p-3 bg-gray-50 rounded hover:bg-gray-100 transition duration-150">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900"><?php echo e($siswa->user->name); ?></p>
                                                <p class="text-xs text-gray-500">NIS: <?php echo e($siswa->nis); ?></p>
                                            </div>
                                            <span
                                                class="inline-flex px-3 py-1 text-xs font-semibold rounded-full <?php echo e($siswa->status == 'Aktif' ? 'bg-green-100 text-green-800' : ($siswa->status == 'Lulus' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')); ?>">
                                                <?php echo e($siswa->status); ?>

                                            </span>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php else: ?>
                                <p class="text-sm text-gray-500">Belum ada siswa di kelas ini.</p>
                            <?php endif; ?>
                        </div>

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
<?php endif; ?><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/kelas/show.blade.php ENDPATH**/ ?>