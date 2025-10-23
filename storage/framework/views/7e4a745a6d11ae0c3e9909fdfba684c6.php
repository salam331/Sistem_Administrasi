<!-- resources/views/admin/presensi/show.blade.php -->
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
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <?php echo e(__('Data Presensi Kelas: ')); ?> <?php echo e($kelas->nama_kelas); ?>

                </h2>
                <p class="text-sm text-gray-500">Mata Pelajaran: <?php echo e($jadwal->mapel->nama_mapel); ?></p>
                <p class="text-sm text-gray-500">Tanggal: <?php echo e(\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y')); ?></p>
                <?php if($kelas->waliKelas): ?>
                    <p class="text-sm text-gray-500">Wali Kelas: <?php echo e($kelas->waliKelas->user->name); ?></p>
                <?php endif; ?>
            </div>
            <?php if(!$presensis->isEmpty()): ?>
                <a href="<?php echo e(route('admin.presensi.edit', ['kelas_id' => $kelas->id, 'mapel_id' => $jadwal->mapel->id, 'tanggal' => $tanggal])); ?>"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <?php echo e(__('Edit Presensi')); ?>

                </a>
            <?php else: ?>
                <a href="<?php echo e(route('admin.presensi.index')); ?>"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <?php echo e(__('Kembali')); ?>

                </a>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <?php if(session('success')): ?>
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($presensis->isEmpty()): ?>
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">Tidak ada siswa yang absen di <?php echo e(\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y')); ?>.</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Siswa</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            NIS</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__empty_1 = true; $__currentLoopData = $kelas->siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($siswa->user->name); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($siswa->nis); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php
                                                    $presensi = $presensis->get($siswa->id);
                                                    $status = $presensi ? $presensi->status : 'Belum Diisi';
                                                    $statusClass = match($status) {
                                                        'Hadir' => 'bg-green-100 text-green-800',
                                                        'Izin' => 'bg-yellow-100 text-yellow-800',
                                                        'Sakit' => 'bg-blue-100 text-blue-800',
                                                        'Alpha' => 'bg-red-100 text-red-800',
                                                        default => 'bg-gray-100 text-gray-800'
                                                    };
                                                ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($statusClass); ?>">
                                                    <?php echo e($status); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                                Belum ada siswa di kelas ini.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
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
<?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/presensi/show.blade.php ENDPATH**/ ?>