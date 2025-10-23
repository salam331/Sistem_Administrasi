<!-- resources/views/admin/presensi/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Presensi Kelas: ') }} {{ $kelas->nama_kelas }}
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
                <form method="POST" action="{{ route('admin.presensi.update') }}">
                    @csrf
                    @method('PUT')
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
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                                            Status Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($kelas->siswas as $siswa)
                                        @php
                                            $presensi = $presensis->get($siswa->id);
                                            $currentStatus = $presensi ? $presensi->status : 'Hadir';
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nis }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center justify-center space-x-4">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio" name="status[{{ $siswa->id }}]" value="Hadir" {{ $currentStatus == 'Hadir' ? 'checked' : '' }}>
                                                        <span class="ml-2">Hadir</span>
                                                    </label>
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio" name="status[{{ $siswa->id }}]" value="Izin" {{ $currentStatus == 'Izin' ? 'checked' : '' }}>
                                                        <span class="ml-2">Izin</span>
                                                    </label>
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio" name="status[{{ $siswa->id }}]" value="Sakit" {{ $currentStatus == 'Sakit' ? 'checked' : '' }}>
                                                        <span class="ml-2">Sakit</span>
                                                    </label>
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" class="form-radio" name="status[{{ $siswa->id }}]" value="Alpha" {{ $currentStatus == 'Alpha' ? 'checked' : '' }}>
                                                        <span class="ml-2">Alpha</span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada siswa di
                                                kelas ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex items-center justify-end p-6 bg-gray-50 border-t">
                        <a href="{{ route('admin.presensi.show', ['kelas_id' => $kelas->id, 'mapel_id' => $jadwal->mapel->id, 'tanggal' => $tanggal]) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                            {{ __('Batal') }}
                        </a>
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
