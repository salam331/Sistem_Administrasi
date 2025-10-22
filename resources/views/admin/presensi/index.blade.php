<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Presensi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Silakan pilih kelas dan tanggal untuk memulai input presensi.</p>

                    <!-- Form ini akan mengarah ke halaman 'create' dengan parameter -->
                    <form method="GET" action="{{ route('admin.presensi.create') }}">
                        <!-- Pilih Kelas -->
                        <div class="mb-4">
                            <x-input-label for="kelas_id" :value="__('Kelas')" />
                            <select name="kelas_id" id="kelas_id"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelases as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Tanggal -->
                        <div class="mb-4">
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <!-- Set default ke tanggal hari ini -->
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal"
                                value="{{ now()->toDateString() }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Lanjutkan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>