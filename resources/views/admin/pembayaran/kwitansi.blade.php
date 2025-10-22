<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Pembayaran {{ $pembayaran->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #333;
        }

        .container {
            width: 700px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 25px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .header h3 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
        }

        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }

        .info-table {
            width: 100%;
            margin: 20px 0;
        }

        .info-table td {
            padding: 5px 0;
        }

        .info-table .label {
            width: 150px;
        }

        .info-table .separator {
            width: 15px;
        }

        .payment-details {
            border: 1px solid #333;
            padding: 15px;
            margin: 20px 0;
        }

        .payment-details .total {
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
        }

        .footer-ttd {
            width: 250px;
            float: right;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>SMAN 1 (CONTOH)</h3>
            <p>Alamat: Jl. Pendidikan No. 1, Jakarta - Telp: (021) 123456</p>
        </div>

        <div class="title">KWITANSI PEMBAYARAN</div>

        <table class="info-table">
            <tr>
                <td class="label">No. Kwitansi</td>
                <td class="separator">:</td>
                <td><strong>KW-{{ str_pad($pembayaran->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
            </tr>
            <tr>
                <td class="label">Sudah Diterima dari</td>
                <td class="separator">:</td>
                <td>{{ $pembayaran->siswa->user->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">NIS</td>
                <td class="separator">:</td>
                <td>{{ $pembayaran->siswa->nis ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td class="separator">:</td>
                <td>{{ $pembayaran->siswa->kelas->nama_kelas ?? 'N/A' }}</td>
            </tr>
        </table>

        <div class="payment-details">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 150px;">Untuk Pembayaran</td>
                    <td style="width: 15px;">:</td>
                    <td>{{ $pembayaran->tagihan->deskripsi ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Metode Bayar</td>
                    <td>:</td>
                    <td>{{ $pembayaran->metode_bayar }}</td>
                </tr>
                @if ($pembayaran->keterangan)
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>{{ $pembayaran->keterangan }}</td>
                    </tr>
                @endif
                <tr class="total">
                    <td colspan="2">JUMLAH BAYAR</td>
                    <td>Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div class="footer-ttd">
                <p>Jakarta, {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->isoFormat('D MMMM Y') }}</p>
                <p>Petugas,</p>
                <br><br><br><br>
                <p style="text-decoration: underline;">( {{ Auth::user()->name }} )</p>
            </div>
            <div style="clear: both;"></div>
        </div>
    </div>
</body>

</html>