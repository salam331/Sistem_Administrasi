<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Guru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-6 lg:p-8">
                    <form method="POST" action="{{ route('admin.guru.update', $guru) }}">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <x-input-label for="name" :value="__('Nama Lengkap')" />
                                <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="text" name="name" :value="old('name', $guru->user->name)" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="email" name="email" :value="old('email', $guru->user->email)" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="nip" :value="__('NIP')" />
                                <x-text-input id="nip" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="text" name="nip" :value="old('nip', $guru->nip)" required />
                                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="jabatan" :value="__('Jabatan')" />
                                <x-text-input id="jabatan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    type="text" name="jabatan" :value="old('jabatan', $guru->jabatan)" required />
                                <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                            </div>

                            <div class="mb-4 md:col-span-2">
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" {{ old('status', $guru->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status', $guru->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('admin.guru.show', $guru) }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                               ← Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
