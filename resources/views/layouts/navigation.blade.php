{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{ sidebarOpen: false, darkMode: false }" x-init="darkMode = localStorage.getItem('theme') === 'dark'; 
             @toggle-theme.window="darkMode = !darkMode;
                           localStorage.setItem('theme', darkMode ? 'dark' : 'light');
                           document.documentElement.classList.toggle('dark', darkMode)"
    class="fixed top-0 left-0 right-0 z-40 bg-blue-100 dark:bg-gray-800 border-b border-blue-200 dark:border-gray-700 shadow">

    {{-- === NAVBAR TOP === --}}
    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
        {{-- Tombol Sidebar (Mobile) --}}
        <button @click="sidebarOpen = !sidebarOpen"
            class="px-3 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-300 md:hidden hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        {{-- Logo (Desktop) --}}
        <div class="hidden md:flex items-center space-x-2">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                <x-application-logo class="block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    SMAN 1 Donggo
                </span>
            </a>
        </div>

        {{-- Tombol Dark Mode + Profil --}}
        <div class="flex items-center space-x-4">
            {{-- Toggle Dark Mode --}}
            <button @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light'); document.documentElement.classList.toggle('dark', darkMode)"
                class="p-2 rounded-full bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none transition">
                <template x-if="!darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 
                              6.364l-1.591-1.591M12 18.75V21m-6.364-.386l1.591-1.591M3 
                              12H.75m.386-6.364l1.591 1.591" />
                    </svg>
                </template>
                <template x-if="darkMode">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-200" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 
                              15.75c-5.385 0-9.75-4.365-9.75-9.75 
                              0-1.33.266-2.597.748-3.752A9.753 
                              9.753 0 003 11.25C3 16.635 7.365 21 
                              12.75 21a9.753 9.753 0 008.25-4.5z" />
                    </svg>
                </template>
            </button>

            {{-- Dropdown Profil --}}
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium 
                               rounded-md text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 
                               hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 
                                      10.586l3.293-3.293a1 1 0 111.414 
                                      1.414l-4 4a1 1 0 01-1.414 
                                      0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>

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
