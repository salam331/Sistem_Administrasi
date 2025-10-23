<!-- resources/views/admin/presensi/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Data Presensi Kelas: ') }} {{ $kelas->nama_kelas }}
                </h2>
                <p class="text-sm text-gray-500">Mata Pelajaran: {{ $jadwal->mapel->nama_mapel }}</p>
                <p class="text-sm text-gray-500">Tanggal: {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}</p>
                @if($kelas->waliKelas)
                    <p class="text-sm text-gray-500">Wali Kelas: {{ $kelas->waliKelas->user->name }}</p>
                @endif
            </div>
            @if(!$presensis->isEmpty())
                <a href="{{ route('admin.presensi.edit', ['kelas_id' => $kelas->id, 'mapel_id' => $jadwal->mapel->id, 'tanggal' => $tanggal]) }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit Presensi') }}
                </a>
            @else
                <a href="{{ route('admin.presensi.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Kembali') }}
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($presensis->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">Tidak ada siswa yang absen di {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Siswa</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            NIS</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($kelas->siswas as $siswa)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->nis }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $presensi = $presensis->get($siswa->id);
                                                    $status = $presensi ? $presensi->status : 'Belum Diisi';
                                                    $statusClass = match($status) {
                                                        'Hadir' => 'bg-green-100 text-green-800',
                                                        'Izin' => 'bg-yellow-100 text-yellow-800',
                                                        'Sakit' => 'bg-blue-100 text-blue-800',
                                                        'Alpha' => 'bg-red-100 text-red-800',
                                                        default => 'bg-gray-100 text-gray-800'
                                                    };
                                                @endphp
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                    {{ $status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                                Belum ada siswa di kelas ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
