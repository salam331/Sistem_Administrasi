<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Nilai Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Pilih kelas, mata pelajaran, dan jenis nilai untuk memulai.</p>

                    <form method="GET" action="{{ route('admin.nilai.create') }}">
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

                        <div class="mb-4">
                            <x-input-label for="mapel_id" :value="__('Mata Pelajaran')" />
                            <select name="mapel_id" id="mapel_id"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($mapels as $mapel)
                                    <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jenis_nilai" :value="__('Jenis Nilai')" />
                            <select name="jenis_nilai" id="jenis_nilai"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Jenis Nilai --</option>
                                <option value="Tugas">Tugas</option>
                                <option value="Harian">Harian</option>
                                <option value="UTS">UTS</option>
                                <option value="UAS">UAS</option>
                            </select>
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