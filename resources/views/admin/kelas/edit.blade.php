<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-6 lg:p-8">

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.kelas.update', $kelas) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="mb-4">
                                <x-input-label for="nama_kelas" :value="__('Nama Kelas (Contoh: X IPA 1)')" />
                                <x-text-input id="nama_kelas"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="text" name="nama_kelas" :value="old('nama_kelas', $kelas->nama_kelas)"
                                    required autofocus />
                                <x-input-error :messages="$errors->get('nama_kelas')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="tingkat" :value="__('Tingkat (10, 11, atau 12)')" />
                                <x-text-input id="tingkat"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="number" name="tingkat" :value="old('tingkat', $kelas->tingkat)" required />
                                <x-input-error :messages="$errors->get('tingkat')" class="mt-2" />
                            </div>

                            <div class="mb-4 md:col-span-2">
                                <x-input-label for="guru_id" :value="__('Wali Kelas (Opsional)')" />
                                <select name="guru_id" id="guru_id"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">-- Tidak Ada Wali Kelas --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}" {{ old('guru_id', $kelas->guru_id) == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->user->name }} (NIP: {{ $guru->nip }})
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('guru_id')" class="mt-2" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('admin.kelas.show', $kelas) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                                ← Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                {{ __('Update Data Kelas') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>