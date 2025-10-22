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
            <?php echo e(__('Detail Siswa')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">

                <!-- Header -->
                <div
                    class="p-8 bg-gradient-to-r from-blue-600 to-blue-700 text-white flex justify-between items-center">
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0v7" />
                        </svg>
                        Detail Siswa
                    </h3>
                    <div class="space-x-2">
                        <a href="<?php echo e(route('admin.siswa.edit', $siswa)); ?>"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition">
                            ✏️ Edit
                        </a>
                        <a href="<?php echo e(route('admin.siswa.index')); ?>"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition">
                            ← Kembali
                        </a>
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Informasi Pribadi -->
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                            <h4 class="text-lg font-semibold mb-4 text-blue-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Informasi Pribadi
                            </h4>
                            <div class="space-y-4 text-gray-800">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($siswa->user->name); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Email</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($siswa->user->email); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">NIS</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($siswa->nis); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Alamat</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($siswa->alamat ?? '-'); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nama Wali</label>
                                    <p class="mt-1 text-base font-semibold"><?php echo e($siswa->nama_wali ?? '-'); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Status</label>
                                    <span
                                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition
                                                    <?php echo e($siswa->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                                        <?php echo e($siswa->status); ?>

                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Akademik -->
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                            <h4 class="text-lg font-semibold mb-4 text-blue-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-6h13v6m-9 4h4m4-10l-7-7-7 7" />
                                </svg>
                                Informasi Akademik
                            </h4>
                            <div class="space-y-4 text-gray-800">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Kelas</label>
                                    <p class="mt-1 text-base font-semibold">
                                        <?php if($siswa->kelas): ?>
                                            <?php echo e($siswa->kelas->nama_kelas); ?>

                                        <?php else: ?>
                                            <span class="text-gray-500 italic">Belum ditentukan</span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Dibuat Pada</label>
                                    <p class="mt-1 text-base font-semibold text-gray-700">
                                        <?php echo e($siswa->created_at->format('d M Y H:i')); ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                                    <p class="mt-1 text-base font-semibold text-gray-700">
                                        <?php echo e($siswa->updated_at->format('d M Y H:i')); ?></p>
                                </div>
                            </div>
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
<?php endif; ?><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/siswa/show.blade.php ENDPATH**/ ?>