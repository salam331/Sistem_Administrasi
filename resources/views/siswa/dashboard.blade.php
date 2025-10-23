<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Selamat Datang,") }} <strong>{{ Auth::user()->name }}!</strong>

                    {{-- Kita panggil relasi 'siswa' dari User --}}
                    @if (Auth::user()->siswa)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            NIS: {{ Auth::user()->siswa->nis }} |
                            Kelas: {{ Auth::user()->siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="{{ route('siswa.jadwal.index') }}"
                    class="bg-blue-100 dark:bg-blue-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-blue-200 dark:hover:bg-blue-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100">Jadwal Pelajaran</h3>
                    <p class="mt-2 text-sm text-blue-700 dark:text-blue-300">Lihat jadwal pelajaran mingguan Anda.</p>
                </a>

                <a href="{{ route('siswa.presensi.index') }}"
                    class="bg-green-100 dark:bg-green-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-green-200 dark:hover:bg-green-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-green-900 dark:text-green-100">Presensi Saya</h3>
                    <p class="mt-2 text-sm text-green-700 dark:text-green-300">Lihat riwayat presensi Anda.</p>
                </a>

                <a href="{{ route('siswa.wali-kelas.show') }}"
                    class="bg-purple-100 dark:bg-purple-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-purple-200 dark:hover:bg-purple-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-purple-900 dark:text-purple-100">Wali Kelas</h3>
                    <p class="mt-2 text-sm text-purple-700 dark:text-purple-300">
                        @if($waliKelas)
                            {{ $waliKelas->user->name }}
                        @else
                            Belum ditentukan
                        @endif
                    </p>
                </a>

                <a href="{{ route('siswa.tagihan.index') }}"
                    class="bg-yellow-100 dark:bg-yellow-900/50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-yellow-200 dark:hover:bg-yellow-900 transition ease-in-out duration-150">
                    <h3 class="text-lg font-semibold text-yellow-900 dark:text-yellow-100">Status Tagihan</h3>
                    <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                        Anda memiliki {{ $jumlahTagihanBelumLunas }} tagihan belum lunas.
                    </p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
