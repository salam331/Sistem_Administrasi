<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Guru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div
                    class="p-8 bg-gradient-to-r from-blue-600 to-blue-700 text-white flex justify-between items-center">
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0v7" />
                        </svg>
                        Detail Guru
                    </h3>
                    <div class="space-x-2">
                        <a href="{{ route('admin.guru.edit', $guru) }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition ease-in-out duration-150">
                            ✏️ Edit
                        </a>
                        <a href="{{ route('admin.guru.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                            ← Kembali
                        </a>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Informasi Pribadi -->
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                            <h4 class="text-lg font-semibold mb-4 text-blue-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Informasi Pribadi
                            </h4>
                            <div class="space-y-4 text-gray-800">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                                    <p class="mt-1 text-base font-semibold">{{ $guru->user->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Email</label>
                                    <p class="mt-1 text-base font-semibold">{{ $guru->user->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">NIP</label>
                                    <p class="mt-1 text-base font-semibold">{{ $guru->nip }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Jabatan</label>
                                    <p class="mt-1 text-base font-semibold">{{ $guru->jabatan }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Status</label>
                                    <span class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150
                                                    {{ $guru->status == 'Aktif'
                                                    ? 'bg-green-100 text-green-800'
                                                    : 'bg-red-100 text-red-800' }}">
                                        {{ $guru->status }}
                                    </span>

                                </div>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-200">
                            <h4 class="text-lg font-semibold mb-4 text-blue-700 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-6h13v6m-9 4h4m4-10l-7-7-7 7" />
                                </svg>
                                Informasi Tambahan
                            </h4>
                            <div class="space-y-4 text-gray-800">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Wali Kelas</label>
                                    <p class="mt-1 text-base font-semibold">
                                        @if($guru->kelasWali)
                                            {{ $guru->kelasWali->nama_kelas }}
                                        @else
                                            <span class="text-gray-500 italic">Tidak menjadi wali kelas</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Dibuat Pada</label>
                                    <p class="mt-1 text-base font-semibold text-gray-700">
                                        {{ $guru->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Terakhir Diupdate</label>
                                    <p class="mt-1 text-base font-semibold text-gray-700">
                                        {{ $guru->updated_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>