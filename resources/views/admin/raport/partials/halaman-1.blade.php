<div class="header">
    <h3>LAPORAN HASIL BELAJAR SISWA</h3>
    <h4>(RAPORT)</h4>
</div>

<table class="info-table">
    <tr>
        <td class="label">Nama Siswa</td>
        <td class="separator">:</td>
        <td>{{ $siswa->user->name }}</td>
        <td class="label">Kelas</td>
        <td class="separator">:</td>
        <td>{{ $siswa->kelas->nama_kelas ?? '-' }}</td>
    </tr>
    <tr>
        <td class="label">NIS</td>
        <td class="separator">:</td>
        <td>{{ $siswa->nis }}</td>
        <td class="label">Semester</td>
        <td class="separator">:</td>
        <td>{{ $semester }}</td>
    </tr>
    <tr>
        <td class="label">Nama Sekolah</td>
        <td class="separator">:</td>
        <td>SMAN 1 (Contoh)</td>
        <td class="label">Tahun Ajaran</td>
        <td class="separator">:</td>
        <td>{{ $tahun_ajaran }}</td>
    </tr>
</table>

<table class="nilai-table">
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Mata Pelajaran</th>
            <th colspan="4">Komponen Nilai</th>
            <th rowspan="2">Nilai Akhir (NAR)</th>
            <th rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th>Tugas</th>
            <th>Harian</th>
            <th>UTS</th>
            <th>UAS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($raport_data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="mapel">{{ $item['mapel'] }}</td>
                <td>{{ $item['tugas'] }}</td>
                <td>{{ $item['harian'] }}</td>
                <td>{{ $item['uts'] }}</td>
                <td>{{ $item['uas'] }}</td>
                <td>{{ $item['nar'] }}</td>
                <td>{{ $item['keterangan'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>