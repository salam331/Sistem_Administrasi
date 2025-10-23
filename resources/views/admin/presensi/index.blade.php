<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presensi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Input Presensi Baru</h3>
                        <p class="mb-4">Silakan pilih kelas, mata pelajaran, dan tanggal untuk memulai input presensi.</p>

                        <!-- Form ini akan mengarah ke halaman 'create' dengan parameter -->
                        <form method="GET" action="{{ route('admin.presensi.create') }}" id="presensi-form">
                            <!-- Pilih Kelas -->
                            <div class="mb-4">
                                <x-input-label for="kelas_id" :value="__('Kelas')" />
                                <select name="kelas_id" id="kelas_id"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelases as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Mata Pelajaran -->
                            <div class="mb-4">
                                <x-input-label for="mapel_id" :value="__('Mata Pelajaran')" />
                                <select name="mapel_id" id="mapel_id"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required disabled>
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                </select>
                            </div>

                            <!-- Pilih Tanggal -->
                            <div class="mb-4">
                                <x-input-label for="tanggal" :value="__('Tanggal')" />
                                <!-- Set default ke tanggal hari ini -->
                                <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal"
                                    value="{{ now()->toDateString() }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-primary-button>
                                    {{ __('Input Presensi') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                    <div class="border-t pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Lihat Presensi yang Sudah Ada</h3>
                        <p class="mb-4">Pilih kelas, mata pelajaran, dan tanggal untuk melihat data presensi yang sudah diinput.</p>

                        <!-- Form untuk melihat presensi yang sudah ada -->
                        <form method="GET" action="{{ route('admin.presensi.show') }}" id="view-presensi-form">
                            <!-- Pilih Kelas -->
                            <div class="mb-4">
                                <x-input-label for="kelas_id" :value="__('Kelas')" />
                                <select name="kelas_id" id="kelas_id_show"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelases as $kelas)
                                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Pilih Mata Pelajaran -->
                            <div class="mb-4">
                                <x-input-label for="mapel_id" :value="__('Mata Pelajaran')" />
                                <select name="mapel_id" id="mapel_id_show"
                                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required disabled>
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                </select>
                            </div>

                            <!-- Pilih Tanggal -->
                            <div class="mb-4">
                                <x-input-label for="tanggal" :value="__('Tanggal')" />
                                <x-text-input id="tanggal_show" class="block mt-1 w-full" type="date" name="tanggal"
                                    value="{{ now()->toDateString() }}" required />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Lihat Presensi') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kelasSelect = document.getElementById('kelas_id');
            const mapelSelect = document.getElementById('mapel_id');
            const kelasSelectShow = document.getElementById('kelas_id_show');
            const mapelSelectShow = document.getElementById('mapel_id_show');

            function loadMapel(kelasId, targetSelect) {
                if (kelasId) {
                    fetch(`/admin/presensi/get-mapel/${kelasId}`)
                        .then(response => response.json())
                        .then(data => {
                            targetSelect.innerHTML = '<option value="">-- Pilih Mata Pelajaran --</option>';
                            data.forEach(mapel => {
                                const option = document.createElement('option');
                                option.value = mapel.id;
                                option.textContent = mapel.nama_mapel;
                                targetSelect.appendChild(option);
                            });
                            targetSelect.disabled = false;
                        })
                        .catch(error => console.error('Error loading mapel:', error));
                } else {
                    targetSelect.innerHTML = '<option value="">-- Pilih Mata Pelajaran --</option>';
                    targetSelect.disabled = true;
                }
            }

            kelasSelect.addEventListener('change', function() {
                loadMapel(this.value, mapelSelect);
            });

            kelasSelectShow.addEventListener('change', function() {
                loadMapel(this.value, mapelSelectShow);
            });
        });
    </script>
</x-app-layout>
