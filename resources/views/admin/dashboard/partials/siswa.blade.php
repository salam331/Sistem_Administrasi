{{-- ========== DASHBOARD UNTUK SISWA ========== --}}
{{-- Tampilkan pesan sambutan --}}
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        {{ __("Selamat Datang kembali,") }} <strong>{{ Auth::user()->name }}!</strong>
    </div>
</div>

{{-- Grid menu siswa --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    <div class="bg-blue-100 dark:bg-blue-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Jadwal Pelajaran</h3>
        <p class="mt-2 text-sm text-blue-700 dark:text-blue-300">Lihat jadwal pelajaran Anda.</p>
    </div>

    <div class="bg-green-100 dark:bg-green-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-green-900 dark:text-green-100">Presensi</h3>
        <p class="mt-2 text-sm text-green-700 dark:text-green-300">Lihat status absensi Anda.</p>
    </div>

    <div class="bg-yellow-100 dark:bg-yellow-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-yellow-900 dark:text-yellow-100">Nilai</h3>
        <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">Lihat nilai Tugas, UTS, dan UAS Anda.</p>
    </div>

    <div class="bg-indigo-100 dark:bg-indigo-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-semibold text-indigo-900 dark:text-indigo-100">Raport</h3>
        <p class="mt-2 text-sm text-indigo-700 dark:text-indigo-300">Lihat dan cetak raport Anda.</p>
    </div>

</div>
