<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Kelas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl border border-gray-100">

                <!-- Header -->
                <div
                    class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white flex justify-between items-center rounded-t-2xl">
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0v7" />
                        </svg>
                        Tambah Kelas Baru
                    </h3>
                    <a href="{{ route('admin.kelas.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition">
                        ← Kembali
                    </a>
                </div>

                <!-- Form -->
                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.kelas.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div>
                                <x-input-label for="nama_kelas" :value="__('Nama Kelas (Contoh: X IPA 1)')" />
                                <x-text-input id="nama_kelas"
                                    class="block mt-1 w-full text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="text" name="nama_kelas" :value="old('nama_kelas')" required autofocus />
                                <x-input-error :messages="$errors->get('nama_kelas')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tingkat" :value="__('Tingkat (10, 11, atau 12)')" />
                                <x-text-input id="tingkat"
                                    class="block mt-1 w-full text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="number" name="tingkat" :value="old('tingkat')" required />
                                <x-input-error :messages="$errors->get('tingkat')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="guru_id" :value="__('Wali Kelas (Opsional)')" />
                                <select name="guru_id" id="guru_id"
                                    class="block mt-1 w-full text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Tidak Ada Wali Kelas --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->user->name }} (NIP: {{ $guru->nip }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('guru_id')" class="mt-2" />
                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('admin.kelas.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                                Batal
                            </a>
                            <x-primary-button>{{ __('Simpan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>