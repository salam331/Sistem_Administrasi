<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-50 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg border border-blue-200 dark:border-slate-700">
                <div class="p-6 text-blue-900 dark:text-slate-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Kelola Data Pengguna</h3>
                        <a href="{{ route('admin.users.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Pengguna
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($userCounts as $role => $count)
                            <a href="{{ route('admin.users.role', $role) }}" class="block">
                                <div class="bg-{{ $role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green') }}-100 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-lg transition-shadow border border-{{ $role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green') }}-200 dark:border-slate-600">
                                    <h3 class="text-lg font-semibold text-{{ $role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green') }}-900 dark:text-slate-100 capitalize">{{ ucfirst($role) }}</h3>
                                    <p class="mt-2 text-sm text-{{ $role == 'admin' ? 'red' : ($role == 'guru' ? 'blue' : 'green') }}-700 dark:text-slate-300">{{ $count }} pengguna</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
