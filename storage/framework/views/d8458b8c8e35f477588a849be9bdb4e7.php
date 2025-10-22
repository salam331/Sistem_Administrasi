<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat <?php echo e($surat->nomor_surat); ?></title>
    <style>
        /* Menggunakan inline style block agar lebih mudah dibaca di preview */
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
            /* Hapus margin agar pas di wrapper 'lihat' */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .header h3,
        .header h4 {
            margin: 0;
        }

        .logo {
            width: 80px;
            position: absolute;
            left: 50px;
            top: 30px;
        }

        .line {
            border-bottom: 2px solid black;
            margin-top: 10px;
        }

        .content {
            margin-top: 30px;
        }

        .content p {
            text-align: justify;
        }

        .info-table {
            margin-left: 40px;
        }

        .info-table td {
            padding: 2px 5px;
        }

        .footer {
            margin-top: 50px;
        }

        /* Gunakan 'width: 100%' agar float bekerja baik di PDF */
        .footer-ttd {
            width: 250px;
            float: right;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="header">
        <h4>PEMERINTAH PROVINSI (CONTOH)</h4>
        <h3>DINAS PENDIDIKAN DAN KEBUDAYAAN</h3>
        <h3>SMAN 1 (CONTOH)</h3>
        <p style="font-size: 12px;">Alamat: Jl. Pendidikan No. 1, Jakarta - Telp: (021) 123456</p>
    </div>
    <div class="line"></div>

    <div class="content">
        <h4 style="text-align: center; margin-bottom: 20px; text-decoration: underline;">
            SURAT KETERANGAN SISWA AKTIF
        </h4>
        <p style="text-align: center; margin-top: -15px;">
            Nomor: <?php echo e($surat->nomor_surat); ?>

        </p>

        <p>Yang bertanda tangan di bawah ini, Kepala SMAN 1 (Contoh), dengan ini menerangkan bahwa:</p>

        <?php if($siswa): ?>
            <table class="info-table">
                <tr>
                    <td style="width: 120px;">Nama Lengkap</td>
                    <td style="width: 10px;">:</td>
                    <td><strong><?php echo e($siswa->user->name); ?></strong></td>
                </tr>
                <tr>
                    <td>NIS / NISN</td>
                    <td>:</td>
                    <td><?php echo e($siswa->nis); ?> / (Nomor NISN jika ada)</td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><?php echo e($siswa->kelas->nama_kelas ?? 'Belum ada kelas'); ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo e($siswa->alamat ?? '-'); ?></td>
                </tr>
            </table>

            <p>Adalah benar-benar siswa aktif di SMAN 1 (Contoh) Tahun Ajaran
                <?php echo e($surat->created_at->year); ?>/<?php echo e($surat->created_at->year + 1); ?>.</p>
        <?php else: ?>
            <p style="text-align: center; color: red;">(Data siswa tidak ditemukan)</p>
        <?php endif; ?>

        <p>Surat keterangan ini dibuat untuk keperluan <?php echo e($surat->perihal); ?>.</p>

        <p>Demikian surat keterangan ini kami buat agar dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="footer">
        <div class="footer-ttd">
            <p>Jakarta, <?php echo e(\Carbon\Carbon::parse($surat->tanggal_surat)->isoFormat('D MMMM Y')); ?></p>
            <p>Kepala Sekolah,</p>
            <br><br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">(Nama Kepala Sekolah)</p>
            <p style="margin-top: -10px;">NIP: (NIP Kepala Sekolah)</p>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>

</html><?php /**PATH D:\laragon\www\sistem_administrasi\resources\views/admin/surat/izin-kunjungan.blade.php ENDPATH**/ ?>