<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Tagihan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Tagihan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Deskripsi Tagihan</p>
                                <p class="font-medium">{{ $tagihan->deskripsi }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah Tagihan</p>
                                <p class="font-medium">Rp {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Tanggal Tagihan</p>
                                <p class="font-medium">{{ \Carbon\Carbon::parse($tagihan->tanggal_tagihan)->isoFormat('D MMMM Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Status</p>
                                @if ($tagihan->status == 'Lunas')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                        Lunas
                                    </span>
                                @elseif ($tagihan->status == 'Sebagian')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                        Dibayar Sebagian
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                        Belum Lunas
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Riwayat Pembayaran</h3>
                        @if ($tagihan->pembayarans->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Tanggal Bayar
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Jumlah Bayar
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Metode Bayar
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Keterangan
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($tagihan->pembayarans as $pembayaran)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->isoFormat('D MMM Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $pembayaran->metode_bayar }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $pembayaran->keterangan ?? '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium">Total Sudah Dibayar:</span>
                                    <span class="font-bold text-lg">Rp {{ number_format($tagihan->pembayarans->sum('jumlah_bayar'), 0, ',', '.') }}</span>
                                </div>
                                @if ($tagihan->status != 'Lunas')
                                    <div class="flex justify-between items-center mt-2">
                                        <span class="font-medium">Sisa Tagihan:</span>
                                        <span class="font-bold text-lg text-red-600 dark:text-red-400">
                                            Rp {{ number_format($tagihan->jumlah_tagihan - $tagihan->pembayarans->sum('jumlah_bayar'), 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">Belum ada pembayaran yang tercatat untuk tagihan ini.</p>
                        @endif
                    </div>

                    <div class="flex justify-start">
                        <a href="{{ route('siswa.tagihan.index') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Kembali ke Daftar Tagihan
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
