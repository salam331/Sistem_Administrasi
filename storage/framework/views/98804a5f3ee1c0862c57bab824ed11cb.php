<div class="header">
    <h3>LAPORAN HASIL BELAJAR SISWA</h3>
    <h4>(RAPORT)</h4>
</div>

<table class="info-table">
    <tr>
        <td class="label">Nama Siswa</td>
        <td class="separator">:</td>
        <td><?php echo e($siswa->user->name); ?></td>
        <td class="label">Kelas</td>
        <td class="separator">:</td>
        <td><?php echo e($siswa->kelas->nama_kelas ?? '-'); ?></td>
    </tr>
    <tr>
        <td class="label">NIS</td>
        <td class="separator">:</td>
        <td><?php echo e($siswa->nis); ?></td>
        <td class="label">Semester</td>
        <td class="separator">:</td>
        <td><?php echo e($semester); ?></td>
    </tr>
    <tr>
        <td class="label">Nama Sekolah</td>
        <td class="separator">:</td>
        <td>SMAN 1 (Contoh)</td>
        <td class="label">Tahun Ajaran</td>
        <td class="separator">:</td>
        <td><?php echo e($tahun_ajaran); ?></td>
    </tr>
</table>

<table class="nilai-table">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Mata Pelajaran</th>
            <th colspan="4">Komponen Nilai</th>
            <th rowspan="2">Nilai Akhir (NAR)</th>
            <th rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th>Tugas</th>
            <th>Harian</th>
            <th>UTS</th>
            <th>UAS</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $raport_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td class="mapel"><?php echo e($item['mapel']); ?></td>
                <td><?php echo e($item['tugas']); ?></td>
                <td><?php echo e($item['harian']); ?></td>
                <td><?php echo e($item['uts']); ?></td>
                <td><?php echo e($item['uas']); ?></td>
                <td><?php echo e($item['nar']); ?></td>
                <td><?php echo e($item['keterangan']); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/raport/partials/halaman-1.blade.php ENDPATH**/ ?>