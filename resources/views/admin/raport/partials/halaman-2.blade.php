<br>
<strong>B. Ketidakhadiran</strong>
<table class="nilai-table" style="width: 50%;">
    <tr>
        <td>Sakit (S)</td>
        <td>{{ $absensi['sakit'] }} hari</td>
    </tr>
    <tr>
        <td>Izin (I)</td>
        <td>{{ $absensi['izin'] }} hari</td>
    </tr>
    <tr>
        <td>Tanpa Keterangan (A)</td>
        <td>{{ $absensi['alpha'] }} hari</td>
    </tr>
</table>

<br>
<strong>C. Catatan Wali Kelas</strong>
<div style="border: 1px solid black; padding: 10px; height: 80px;">
    <p>Tingkatkan terus prestasimu dan jangan cepat puas diri!</p>
</div>

<table class="footer-table">
    <tr>
        <td class="ttd">
            Mengetahui,<br>Orang Tua/Wali
            <br><br><br><br>
            (___________________)
        </td>
        <td style="width: 40%;"></td>
        <td class="ttd">
            Jakarta, {{ now()->isoFormat('D MMMM Y') }}<br>
            Wali Kelas,
            <br><br><br><br>
            <strong>{{ $siswa->kelas->waliKelas->user->name ?? '(Nama Wali Kelas)' }}</strong><br>
            NIP: {{ $siswa->kelas->waliKelas->nip ?? '-' }}
        </td>
    </tr>
</table>