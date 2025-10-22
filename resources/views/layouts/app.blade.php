<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="mainApp()" x-init="init()"
    :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="favicon-32x32.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Inline script untuk hindari FOUC (Flash of Unstyled Content)
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white transition-colors">

    {{-- === HEADER & SIDEBAR === --}}
    @include('layouts.navigation')
    @if (Auth::user()->hasRole('admin'))
        @include('layouts.navigation') {{-- Sidebar Admin --}}
    @elseif (Auth::user()->hasRole('siswa'))
        @include('layouts.siswa-navigation') {{-- Sidebar Siswa --}}
    @elseif (Auth::user()->hasRole('guru'))
        {{-- @include('layouts.guru-navigation') --}} {{-- Nanti --}}
    @endif
    {{-- === MAIN CONTENT WRAPPER === --}}
    <main class="lg:ml-64 p-10 mt-10">

        {{-- === MAIN CONTENT SLOT === --}}
        <section>
            @if (isset($header))
                <header class="bg-gray-50 dark:bg-gray-800 shadow mb-4 p-4 rounded-xl">
                    {{ $header }}
                </header>
            @endif

            <div>
                {{ $slot }}
            </div>
        </section>
    </main>

    {{-- === ALPINE APP === --}}
    <script>
        function mainApp() {
            return {
                darkMode: localStorage.getItem('theme') === 'dark',
                sidebarOpen: false,

                init() {
                    this.updateTheme();
                    window.addEventListener('resize', () => {
                        if (window.innerWidth >= 1024) {
                            this.sidebarOpen = true;
                        }
                    });
                },

                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                    this.updateTheme();
                },

                updateTheme() {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },
            }
        }
    </script>
</body>

</html>