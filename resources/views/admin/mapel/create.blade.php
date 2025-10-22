<!-- resources/views/admin/mapel/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mata Pelajaran Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.mapel.store') }}">
                        @csrf

                        <!-- Nama Mapel -->
                        <div class="mb-4">
                            <x-input-label for="nama_mapel" :value="__('Nama Mata Pelajaran')" />
                            <x-text-input id="nama_mapel" class="block mt-1 w-full" type="text" name="nama_mapel"
                                :value="old('nama_mapel')" required autofocus />
                        </div>

                        <!-- Alokasi Jam -->
                        <div class="mb-4">
                            <x-input-label for="alokasi_jam" :value="__('Alokasi Jam per Minggu')" />
                            <x-text-input id="alokasi_jam" class="block mt-1 w-full" type="number" name="alokasi_jam"
                                :value="old('alokasi_jam')" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>