<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Nilai: ') }} {{ $mapel->nama_mapel }}
        </h2>
        <p class="text-sm text-gray-500">
            Kelas: {{ $kelas->nama_kelas }} | Jenis Nilai: {{ $jenisNilai }}
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.nilai.store') }}">
                    @csrf
                    <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                    <input type="hidden" name="jenis_nilai" value="{{ $jenisNilai }}">

                    <div class="p-6 text-gray-900">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama
                                            Siswa</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Input Nilai (0-100)</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($kelas->siswas as $siswa)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $siswa->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <x-text-input type="number" name="nilai[{{ $siswa->id }}]"
                                                    class="block mt-1 w-full" min="0" max="100" step="0.01"
                                                    value="{{ $nilaiSudahAda[$siswa->id] ?? old('nilai.' . $siswa->id, 0) }}" />
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
                            {{ __('Simpan Nilai') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>