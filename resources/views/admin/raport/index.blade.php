<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cetak Raport Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Pilih siswa, tahun ajaran, dan semester untuk mencetak raport.</p>

                    <form method="GET">

                        <div class="mb-4">
                            <x-input-label for="siswa_id" :value="__('Siswa')" />
                            <select name="siswa_id" id="siswa_id"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswas as $siswa)
                                    <option value="{{ $siswa->id }}">{{ $siswa->user->name }} (NIS: {{ $siswa->nis }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tahun_ajaran" :value="__('Tahun Ajaran')" />
                            <select name="tahun_ajaran" id="tahun_ajaran"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="2024/2025">2024/2025</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <x-input-label for="semester" :value="__('Semester')" />
                            <select name="semester" id="semester"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-3">

                            <button type="submit" formaction="{{ route('admin.raport.lihat') }}" formtarget="_blank"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Lihat Raport') }}
                            </button>

                            <x-primary-button type="submit" formaction="{{ route('admin.raport.cetak') }}"
                                formtarget="_blank">
                                {{ __('Cetak Langsung (PDF)') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>