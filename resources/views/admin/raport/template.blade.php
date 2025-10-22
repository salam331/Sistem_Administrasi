<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Raport {{ $siswa->user->name }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 25px;
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
            font-size: 11px;
        }

        .nilai-table .mapel {
            text-align: left;
        }

        .footer-table {
            width: 100%;
            margin-top: 40px;
        }

        .footer-table .ttd {
            width: 30%;
            text-align: center;
        }

        /* CSS untuk memecah halaman di PDF */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <main>
        @include('admin.raport.partials.halaman-1')
    </main>

    <div class="page-break"></div>

    <main>
        @include('admin.raport.partials.halaman-2')
    </main>

</body>

</html>