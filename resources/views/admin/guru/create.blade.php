<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Guru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">

                <!-- Header -->
                <div
                    class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white flex justify-between items-center rounded-t-2xl">
                    <h3 class="text-2xl font-bold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0v7" />
                        </svg>
                        Tambah Guru Baru
                    </h3>
                    <a href="{{ route('admin.guru.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition">
                        ← Kembali
                    </a>
                </div>

                <!-- Form -->
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.guru.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Nama & Email -->
                            <div>
                                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-sm text-gray-500" />
                                <x-text-input id="name" class="block mt-1 w-full text-base" type="text" name="name"
                                    :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" class="text-sm text-gray-500" />
                                <x-text-input id="email" class="block mt-1 w-full text-base" type="email" name="email"
                                    :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" :value="__('Password')" class="text-sm text-gray-500" />
                                <x-text-input id="password" class="block mt-1 w-full text-base" type="password"
                                    name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')"
                                    class="text-sm text-gray-500" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full text-base"
                                    type="password" name="password_confirmation" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- NIP & Jabatan -->
                            <div>
                                <x-input-label for="nip" :value="__('NIP')" class="text-sm text-gray-500" />
                                <x-text-input id="nip" class="block mt-1 w-full text-base" type="text" name="nip"
                                    :value="old('nip')" required />
                                <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="jabatan" :value="__('Jabatan')" class="text-sm text-gray-500" />
                                <x-text-input id="jabatan" class="block mt-1 w-full text-base" type="text"
                                    name="jabatan" :value="old('jabatan')" required />
                                <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div class="md:col-span-2">
                                <x-input-label for="status" :value="__('Status')" class="text-sm text-gray-500" />
                                <select id="status" name="status"
                                    class="block mt-1 w-full text-base border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('admin.guru.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition">
                                ← Batal
                            </a>
                            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>