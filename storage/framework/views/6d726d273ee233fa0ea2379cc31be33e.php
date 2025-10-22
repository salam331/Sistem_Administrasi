

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <?php echo e(__("Selamat Datang kembali,")); ?> <strong><?php echo e(Auth::user()->name); ?>!</strong>
    </div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <div class="bg-blue-100 dark:bg-blue-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Jadwal Mengajar</h3>
        <p class="mt-2 text-sm text-blue-700 dark:text-blue-300">Lihat jadwal pelajaran Anda.</p>
    </div>

    <div class="bg-green-100 dark:bg-green-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-green-900 dark:text-green-100">Input Presensi</h3>
        <p class="mt-2 text-sm text-green-700 dark:text-green-300">Input absensi siswa per mata pelajaran.</p>
    </div>

    <div class="bg-yellow-100 dark:bg-yellow-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-yellow-900 dark:text-yellow-100">Input Nilai</h3>
        <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">Input nilai Tugas, UTS, dan UAS siswa.</p>
    </div>

    <div class="bg-indigo-100 dark:bg-indigo-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-indigo-900 dark:text-indigo-100">Lihat Raport</h3>
        <p class="mt-2 text-sm text-indigo-700 dark:text-indigo-300">Lihat dan cetak raport siswa.</p>
    </div>

</div>
<?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/dashboard/partials/guru.blade.php ENDPATH**/ ?>