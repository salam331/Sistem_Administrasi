<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lihat Raport: ') }} {{ $siswa->user->name }}
            </h2>

            <a href="{{ route('admin.raport.cetak', request()->query()) }}" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Cetak Versi PDF') }}
            </a>
        </div>
    </x-slot>

    <div classs="py-12" x-data="{ page: 1, totalPages: 2 }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg mt-6">
                <div x-show="page === 1" class="p-8">
                    <style>
                        body {
                            font-family: 'Times New Roman', Times, serif;
                        }

                        .header {
                            text-align: center;
                            margin-bottom: 20px;
                        }

                        .header h3,
                        .header h4 {
                            margin: 2px 0;
                        }

                        .info-table {
                            width: 100%;
                            margin-bottom: 20px;
                        }

                        .info-table td {
                            padding: 3px;
                        }

                        .info-table .label {
                            width: 150px;
                        }

                        .info-table .separator {
                            width: 10px;
                        }

                        .nilai-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }

                        .nilai-table th,
                        .nilai-table td {
                            border: 1px solid black;
                            padding: 6px;
                            text-align: center;
                        }

                        .nilai-table .mapel {
                            text-align: left;
                        }
                    </style>

                    @include('admin.raport.partials.halaman-1')
                </div>

                <div x-show="page === 2" class="p-8" style="display: none;">
                    <style>
                        body {
                            font-family: 'Times New Roman', Times, serif;
                        }

                        .nilai-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }

                        .nilai-table th,
                        .nilai-table td {
                            border: 1px solid black;
                            padding: 6px;
                            text-align: center;
                        }

                        .footer-table {
                            width: 100%;
                            margin-top: 40px;
                        }

                        .footer-table .ttd {
                            width: 30%;
                            text-align: center;
                        }
                    </style>

                    @include('admin.raport.partials.halaman-2')
                </div>
            </div>

            <div class="flex justify-between items-center mt-4 mb-12">
                <x-primary-button @click="page--" x-show="page > 1" style="display: none;">
                    &laquo; {{ __('Sebelumnya') }}
                </x-primary-button>
                <div x-show="page === 1"></div>

                <span class="text-gray-600">Halaman <span x-text="page"></span> dari <span
                        x-text="totalPages"></span></span>

                <x-primary-button @click="page++" x-show="page < totalPages" style="display: none;">
                    {{ __('Berikutnya') }} &raquo;
                </x-primary-button>
                <div x-show="page === totalPages"></div>
            </div>

        </div>
    </div>
</x-app-layout>