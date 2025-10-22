<br>
<strong>B. Ketidakhadiran</strong>
<table class="nilai-table" style="width: 50%;">
    <tr>
        <td>Sakit (S)</td>
        <td><?php echo e($absensi['sakit']); ?> hari</td>
    </tr>
    <tr>
        <td>Izin (I)</td>
        <td><?php echo e($absensi['izin']); ?> hari</td>
    </tr>
    <tr>
        <td>Tanpa Keterangan (A)</td>
        <td><?php echo e($absensi['alpha']); ?> hari</td>
    </tr>
</table>

<br>
<strong>C. Catatan Wali Kelas</strong>
<div style="border: 1px solid black; padding: 10px; height: 80px;">
    <p>Tingkatkan terus prestasimu dan jangan cepat puas diri!</p>
</div>

<table class="footer-table">
    <tr>
        <td class="ttd">
            Mengetahui,<br>Orang Tua/Wali
            <br><br><br><br>
            (___________________)
        </td>
        <td style="width: 40%;"></td>
        <td class="ttd">
            Jakarta, <?php echo e(now()->isoFormat('D MMMM Y')); ?><br>
            Wali Kelas,
            <br><br><br><br>
            <strong><?php echo e($siswa->kelas->waliKelas->user->name ?? '(Nama Wali Kelas)'); ?></strong><br>
            NIP: <?php echo e($siswa->kelas->waliKelas->nip ?? '-'); ?>

        </td>
    </tr>
</table><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/raport/partials/halaman-2.blade.php ENDPATH**/ ?>