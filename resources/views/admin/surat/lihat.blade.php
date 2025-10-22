<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lihat Surat: ') }} {{ $surat->nomor_surat }}
            </h2>

            <a href="{{ route('admin.surat-keluar.cetak', $surat->id) }}" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Cetak Versi PDF') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">

                <div class="p-8 md:p-12">
                    @include($template_path, ['surat' => $surat, 'siswa' => $siswa])
                </div>

            </div>

        </div>
    </div>
</x-app-layout>