{{-- resources/views/layouts/admin-sidebar.blade.php --}}
{{-- === SIDEBAR === --}}
<div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden" @click="sidebarOpen = false"
    x-cloak></div>

<nav class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 bg-slate-800 text-white transform transition-transform duration-300
           -translate-x-full md:translate-x-0 shadow-lg" :class="{ 'translate-x-0': sidebarOpen }" x-cloak>

    {{-- Header Sidebar --}}
    <div class="flex items-center justify-center h-16 bg-slate-900 shadow-md">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
            <x-application-logo class="block h-8 w-auto fill-current text-white" />
            <span class="font-semibold text-white">SMAN 1 Donggo</span>
        </a>
    </div>

    {{-- Menu --}}
    <div class="flex-1 overflow-y-auto mt-4 space-y-1 pb-6">
        @php
            $linkClasses = "flex items-center px-4 py-2 text-slate-300 hover:bg-slate-700 hover:text-white rounded-md mx-2 transition";
            $activeClasses = "flex items-center px-4 py-2 bg-slate-900 text-white rounded-md mx-2";
        @endphp

        <a href="{{ route('dashboard') }}"
            class="{{ request()->routeIs('dashboard') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Dashboard</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Master Data</h3>
        <a href="{{ route('admin.users.index') }}"
            class="{{ request()->routeIs('admin.users.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Data Pengguna</span>
        </a>
        <a href="{{ route('admin.guru.index') }}"
            class="{{ request()->routeIs('admin.guru.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Data Guru</span>
        </a>
        <a href="{{ route('admin.siswa.index') }}"
            class="{{ request()->routeIs('admin.siswa.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Data Siswa</span>
        </a>
        <a href="{{ route('admin.kelas.index') }}"
            class="{{ request()->routeIs('admin.kelas.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Data Kelas</span>
        </a>
        <a href="{{ route('admin.mapel.index') }}"
            class="{{ request()->routeIs('admin.mapel.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Data Mapel</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Akademik</h3>
        <a href="{{ route('admin.jadwal.index') }}"
            class="{{ request()->routeIs('admin.jadwal.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Jadwal Pelajaran</span>
        </a>
        <a href="{{ route('admin.presensi.index') }}"
            class="{{ request()->routeIs('admin.presensi.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Presensi Siswa</span>
        </a>
        <a href="{{ route('admin.nilai.index') }}"
            class="{{ request()->routeIs('admin.nilai.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Input Nilai</span>
        </a>
        <a href="{{ route('admin.raport.index') }}"
            class="{{ request()->routeIs('admin.raport.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Cetak Raport</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Administrasi</h3>
        <a href="{{ route('admin.surat-keluar.index') }}"
            class="{{ request()->routeIs('admin.surat-keluar.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Arsip Surat</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Keuangan</h3>
        <a href="{{ route('admin.tagihan.index') }}"
            class="{{ request()->routeIs('admin.tagihan.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Data Tagihan</span>
        </a>
        <a href="{{ route('admin.pembayaran.index') }}"
            class="{{ request()->routeIs('admin.pembayaran.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Input Pembayaran</span>
        </a>


    </div>
</nav>
