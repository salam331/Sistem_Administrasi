<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Presensi Kelas: ') }} {{ $kelas->nama_kelas }}
        </h2>
        <p class="text-sm text-gray-500">Mata Pelajaran: {{ $jadwal->mapel->nama_mapel }}</p>
        <p class="text-sm text-gray-500">Tanggal: {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}</p>
        @if($kelas->waliKelas)
            <p class="text-sm text-gray-500">Wali Kelas: {{ $kelas->waliKelas->user->name }}</p>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.presensi.store') }}">
                    @csrf
                    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                    <input type="hidden" name="mapel_id" value="{{ $jadwal->mapel->id }}">
                    <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                            Siswa</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Status Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($kelas->siswas as $siswa)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center justify-center space-x-4">
                                                    <!-- Name menggunakan array agar bisa di-loop di controller -->
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[{{ $siswa->id }}]" value="Hadir"
                                                            checked> <span class="ml-2">Hadir</span></label>
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[{{ $siswa->id }}]" value="Izin">
                                                        <span class="ml-2">Izin</span></label>
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[{{ $siswa->id }}]"
                                                            value="Sakit"> <span class="ml-2">Sakit</span></label>
                                                    <label class="inline-flex items-center"><input type="radio"
                                                            class="form-radio" name="status[{{ $siswa->id }}]"
                                                            value="Alpha"> <span class="ml-2">Alpha</span></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="px-6 py-4 text-center text-gray-500">Tidak ada siswa di
                                                kelas ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex items-center justify-end p-6 bg-gray-50 border-t">
                        <x-primary-button>
                            {{ __('Simpan Presensi') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>