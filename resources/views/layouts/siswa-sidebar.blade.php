{{-- resources/views/layouts/siswa-sidebar.blade.php --}}
{{-- === SIDEBAR === --}}
<div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden" @click="sidebarOpen = false"
    x-cloak></div>

<nav class="fixed inset-y-0 left-0 z-40 flex flex-col w-64 bg-gray-800 text-white transform transition-transform duration-300
           -translate-x-full md:translate-x-0 shadow-lg" :class="{ 'translate-x-0': sidebarOpen }" x-cloak>

    <div class="flex items-center justify-center h-16 flex-shrink-0 shadow-md bg-gray-900">
        <a href="{{ route('siswa.dashboard') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-white" />
        </a>
    </div>

    <div class="flex-1 overflow-y-auto mt-4 space-y-1">

        @php
            $linkClasses = "flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md mx-2 transition ease-in-out duration-150";
            $activeClasses = "flex items-center px-4 py-2 bg-gray-900 text-white rounded-md mx-2";
        @endphp

        <a href="{{ route('siswa.dashboard') }}"
            class="{{ request()->routeIs('siswa.dashboard') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Dashboard</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Akademik</h3>

        <a href="{{ route('siswa.jadwal.index') }}" class="{{ request()->routeIs('siswa.jadwal.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Jadwal Pelajaran</span>
        </a>
        <a href="{{ route('siswa.presensi.index') }}" class="{{ request()->routeIs('siswa.presensi.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Presensi Saya</span>
        </a>
        <a href="{{ route('siswa.wali-kelas.show') }}" class="{{ request()->routeIs('siswa.wali-kelas.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Wali Kelas</span>
        </a>

        <h3 class="px-4 pt-4 pb-1 text-xs font-semibold text-gray-500 uppercase tracking-wider">Administrasi</h3>
        <a href="{{ route('siswa.tagihan.index') }}" class="{{ request()->routeIs('siswa.tagihan.*') ? $activeClasses : $linkClasses }}">
            <span class="ms-2">Tagihan Saya</span>
        </a>

    </div>
</nav>
