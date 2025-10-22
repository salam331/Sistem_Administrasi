<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generate Tagihan Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Gunakan form ini untuk membuat tagihan baru untuk semua siswa dalam satu atau beberapa kelas sekaligus.
                    </p>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded dark:bg-red-900 dark:text-red-300 dark:border-red-700">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.tagihan.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <div class="mb-4">
                                    <x-input-label for="jenis_tagihan" :value="__('Jenis Tagihan')" />
                                    <select name="jenis_tagihan" id="jenis_tagihan" class="block mt-1 w-full dark:bg-gray-900 dark:text-gray-300 border-gray-300 dark:border-gray-700 rounded-md shadow-sm" required>
                                        <option value="SPP">SPP</option>
                                        <option value="Buku">Biaya Buku</option>
                                        <option value="Studi Tur">Biaya Studi Tur</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="deskripsi" :value="__('Deskripsi Tagihan')" />
                                    <x-text-input id="deskripsi" class="block mt-1 w-full" type="text" name="deskripsi" :value="old('deskripsi')" required placeholder="Contoh: SPP Bulan November 2025" />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="jumlah_tagihan" :value="__('Jumlah (Rp)')" />
                                    <x-text-input id="jumlah_tagihan" class="block mt-1 w-full" type="number" name="jumlah_tagihan" :value="old('jumlah_tagihan')" required placeholder="Contoh: 150000" />
                                </div>
                                
                                <div class="mb-4">
                                    <x-input-label for="tanggal_tagihan" :value="__('Tanggal Tagihan')" />
                                    <x-text-input id="tanggal_tagihan" class="block mt-1 w-full" type="date" name="tanggal_tagihan" value="{{ now()->toDateString() }}" required />
                                </div>

                                <div class="mb-4">
                                    <x-input-label for="tanggal_jatuh_tempo" :value="__('Tanggal Jatuh Tempo (Opsional)')" />
                                    <x-text-input id="tanggal_jatuh_tempo" class="block mt-1 w-full" type="date" name="tanggal_jatuh_tempo" :value="old('tanggal_jatuh_tempo')" />
                                </div>
                            </div>
                            <div>
                                <x-input-label :value="__('Generate Untuk Kelas (Pilih satu atau lebih)')" />
                                <div class="mt-2 border border-gray-300 dark:border-gray-700 rounded-md p-4 h-64 overflow-y-auto">
                                    <label class="flex items-center">
                                        <input type="checkbox" id="checkAll" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm">
                                        <span class="ms-2 text-sm text-gray-700 dark:text-gray-300 font-medium">Pilih Semua Kelas</span>
                                    </label>
                                    <hr class="my-2 dark:border-gray-600">
                                    @foreach ($kelases as $kelas)
                                        <label class="flex items-center mt-2">
                                            <input type="checkbox" name="kelas_id[]" value="{{ $kelas->id }}" class="kelas-checkbox rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm">
                                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ $kelas->nama_kelas }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Generate Tagihan') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <script>
                        document.getElementById('checkAll').addEventListener('click', function(e) {
                            document.querySelectorAll('.kelas-checkbox').forEach(function(checkbox) {
                                checkbox.checked = e.target.checked;
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>