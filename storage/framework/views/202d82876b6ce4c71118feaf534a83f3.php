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
            <?php echo e(__('Input Presensi Kelas: ')); ?> <?php echo e($kelas->nama_kelas); ?>

        </h2>
        <p class="text-sm text-gray-500">Tanggal: <?php echo e(\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y')); ?></p>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="<?php echo e(route('admin.presensi.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="kelas_id" value="<?php echo e($kelas->id); ?>">
                    <input type="hidden" name="tanggal" value="<?php echo e($tanggal); ?>">

                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                            Siswa</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Status Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__empty_1 = true; $__currentLoopData = $kelas->siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap"><?php echo e($siswa->user->name); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center justify-center space-x-4">
                                                    <!-- Name menggunakan array agar bisa di-loop di controller -->
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[<?php echo e($siswa->id); ?>]" value="Hadir"
                                                            checked> <span class="ml-2">Hadir</span></label>
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[<?php echo e($siswa->id); ?>]" value="Izin">
                                                        <span class="ml-2">Izin</span></label>
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[<?php echo e($siswa->id); ?>]"
                                                            value="Sakit"> <span class="ml-2">Sakit</span></label>
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[<?php echo e($siswa->id); ?>]"
                                                            value="Alpha"> <span class="ml-2">Alpha</span></label>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada siswa di
                                                kelas ini.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex items-center justify-end p-6 bg-gray-50 border-t">
                        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                            <?php echo e(__('Simpan Presensi')); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/presensi/create.blade.php ENDPATH**/ ?>