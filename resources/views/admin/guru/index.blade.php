<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Guru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-xl sm:rounded-2xl border border-gray-100">

                <!-- Header Card -->
                <div
                    class="p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-white border-b border-gray-200 rounded-t-2xl">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4 sm:mb-0 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19V6h13v13H9zM5 10h.01M5 14h.01M5 18h.01" />
                        </svg>
                        Daftar Guru
                    </h3>
                    <a href="{{ route('admin.guru.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Guru Baru
                    </a>
                </div>

                <!-- Flash Message -->
                @if(session('success'))
                    <div class="m-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Table -->
                <div class="overflow-x-auto p-6">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIP</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jabatan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($gurus as $index => $guru)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $guru->user->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $guru->user->email }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $guru->nip }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $guru->jabatan }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-semibold rounded-full
                                                {{ $guru->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $guru->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium flex gap-2">
                                        <a href="{{ route('admin.guru.show', $guru) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition">Lihat</a>
                                        <a href="{{ route('admin.guru.edit', $guru) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition">Edit</a>
                                        <form method="POST" action="{{ route('admin.guru.destroy', $guru) }}"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus guru ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 transition">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data guru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>