<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat & Arsipkan Surat Keluar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">...</div>
                    @endif

                    <form method="POST" action="{{ route('admin.surat-keluar.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="jenis_surat" :value="__('Jenis Surat')" />
                            <select name="jenis_surat" id="jenis_surat" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                <option value="Keterangan Siswa Aktif">Surat Keterangan Siswa Aktif</option>
                                <option value="Izin Kunjungan">Surat Izin Kunjungan</option>
                                <option value="Undangan Orang Tua">Surat Undangan Orang Tua</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="perihal" :value="__('Perihal Surat')" />
                            <x-text-input id="perihal" class="block mt-1 w-full" type="text" name="perihal" :value="old('perihal')" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tanggal_surat" :value="__('Tanggal Surat Dibuat')" />
                            <x-text-input id="tanggal_surat" class="block mt-1 w-full" type="date" name="tanggal_surat" value="{{ now()->toDateString() }}" required />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="siswa_id" :value="__('Siswa Terkait (Jika Ada)')" />
                            <select name="siswa_id" id="siswa_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Tidak Terkait Siswa --</option>
                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->user->name }} (NIS: {{ $siswa->nis }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <p class="text-sm text-gray-500 mb-4">Nomor surat akan dibuat otomatis oleh sistem saat disimpan.</p>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Simpan & Arsipkan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>