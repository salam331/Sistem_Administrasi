<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Pembayaran Tagihan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mb-6 border-b dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-medium">Detail Tagihan</h3>
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            <p><strong>Siswa:</strong> {{ $tagihan->siswa->user->name }}</p>
                            <p><strong>Kelas:</strong> {{ $tagihan->siswa->kelas->nama_kelas ?? 'N/A' }}</p>
                            <p><strong>Tagihan:</strong> {{ $tagihan->deskripsi }}</p>
                            <p><strong>Total Tagihan:</strong> Rp
                                {{ number_format($tagihan->jumlah_tagihan, 0, ',', '.') }}</p>
                            <p class="font-semibold text-red-600 dark:text-red-400"><strong>Sisa Tagihan: Rp
                                    {{ number_format($sisa_tagihan, 0, ',', '.') }}</strong></p>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div
                            class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded dark:bg-red-900 dark:text-red-300 dark:border-red-700">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.pembayaran.store') }}">
                        @csrf
                        <input type="hidden" name="tagihan_id" value="{{ $tagihan->id }}">
                        <input type="hidden" name="siswa_id" value="{{ $tagihan->siswa_id }}">

                        <div class="mb-4">
                            <x-input-label for="jumlah_bayar" :value="__('Jumlah Pembayaran (Rp)')" />
                            <x-text-input id="jumlah_bayar" class="block mt-1 w-full" type="number" name="jumlah_bayar"
                                value="{{ old('jumlah_bayar', $sisa_tagihan) }}" required />
                            <x-input-error :messages="$errors->get('jumlah_bayar')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="tanggal_bayar" :value="__('Tanggal Bayar')" />
                            <x-text-input id="tanggal_bayar" class="block mt-1 w-full" type="date" name="tanggal_bayar"
                                value="{{ old('tanggal_bayar', now()->toDateString()) }}" required />
                            <x-input-error :messages="$errors->get('tanggal_bayar')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="metode_bayar" :value="__('Metode Pembayaran')" />
                            <select name="metode_bayar" id="metode_bayar"
                                class="block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 border-gray-300 dark:border-gray-700 rounded-md shadow-sm"
                                required>
                                <option value="Tunai" @if(old('metode_bayar') == 'Tunai') selected @endif>Tunai</option>
                                <option value="Transfer Bank" @if(old('metode_bayar') == 'Transfer Bank') selected @endif>
                                    Transfer Bank</option>
                                <option value="Lainnya" @if(old('metode_bayar') == 'Lainnya') selected @endif>Lainnya
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('metode_bayar')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="keterangan" :value="__('Keterangan (Opsional)')" />
                            <x-text-input id="keterangan" class="block mt-1 w-full" type="text" name="keterangan"
                                :value="old('keterangan')" placeholder="Contoh: Cicilan ke-1" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Simpan Pembayaran') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>