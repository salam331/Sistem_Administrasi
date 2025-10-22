<x-app-layout>
    {{-- HEADER DASHBOARD --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
            {{-- Tambahkan label sesuai role pengguna --}}
            @if (Auth::user()->hasRole('admin'))
                - Admin
            @elseif(Auth::user()->hasRole('guru'))
                - Guru
            @elseif(Auth::user()->hasRole('siswa'))
                - Siswa
            @elseif(Auth::user()->hasRole('orang_tua'))
                - Orang Tua
            @endif
        </h2>
    </x-slot>

    {{-- KONTEN DASHBOARD --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- ========== DASHBOARD UNTUK ADMIN ========== --}}
                    @role('admin')
                    {{-- Tampilkan pesan sambutan --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("Selamat Datang kembali,") }} <strong>{{ Auth::user()->name }}!</strong>
                        </div>
                    </div>

                    {{-- Grid menu admin --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                        <a href="{{ route('admin.guru.index') }}"
                            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Data Guru</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Kelola profil, NIP, dan data
                                mengajar guru.</p>
                        </a>

                        <a href="{{ route('admin.siswa.index') }}"
                            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Data Siswa</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Kelola profil, NIS, dan data kelas
                                siswa.</p>
                        </a>

                        <a href="{{ route('admin.kelas.index') }}"
                            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Data Kelas</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Atur kelas, jurusan, dan wali
                                kelas.</p>
                        </a>

                        <a href="{{ route('admin.jadwal.index') }}"
                            class="bg-blue-100 dark:bg-blue-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-blue-200 dark:hover:bg-blue-900 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Jadwal Pelajaran</h3>
                            <p class="mt-2 text-sm text-blue-700 dark:text-blue-300">Buat dan kelola jadwal pelajaran
                                per kelas.</p>
                        </a>

                        <a href="{{ route('admin.presensi.index') }}"
                            class="bg-green-100 dark:bg-green-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-green-200 dark:hover:bg-green-900 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-green-900 dark:text-green-100">Presensi Siswa</h3>
                            <p class="mt-2 text-sm text-green-700 dark:text-green-300">Input absensi harian atau per
                                mata pelajaran.</p>
                        </a>

                        <a href="{{ route('admin.nilai.index') }}"
                            class="bg-yellow-100 dark:bg-yellow-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-yellow-200 dark:hover:bg-yellow-900 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-yellow-900 dark:text-yellow-100">Input Nilai</h3>
                            <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">Input nilai Tugas, UTS, dan UAS
                                siswa.</p>
                        </a>

                        <a href="{{ route('admin.raport.index') }}"
                            class="bg-indigo-100 dark:bg-indigo-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-indigo-200 dark:hover:bg-indigo-900 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-indigo-900 dark:text-indigo-100">Cetak Raport</h3>
                            <p class="mt-2 text-sm text-indigo-700 dark:text-indigo-300">Lihat preview dan cetak raport
                                PDF.</p>
                        </a>

                        <a href="{{ route('admin.surat-keluar.index') }}"
                            class="bg-gray-200 dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-300 dark:hover:bg-gray-600 transition ease-in-out duration-150">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Arsip Surat</h3>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Arsipkan dan cetak surat
                                keterangan.</p>
                        </a>

                    </div>
                    @endrole

                    {{-- ========== DASHBOARD UNTUK GURU ========== --}}
                    @role('guru')
                    @include('admin.dashboard.partials.guru')
                    @endrole

                    {{-- ========== DASHBOARD UNTUK SISWA ========== --}}
                    @role('siswa')
                    @include('admin.dashboard.partials.siswa')
                    @endrole

                    {{-- ========== DASHBOARD UNTUK ORANG TUA ========== --}}
                    @role('orang_tua')
                    @include('admin.dashboard.partials.orang_tua')
                    @endrole

                </div>
            </div>
        </div>
    </div>
</x-app-layout>