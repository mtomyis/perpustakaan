<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Tamu Perpustakaan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        thead {
            background-color: #343a40;
            color: #ffffff;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h2>Laporan Buku Tamu Perpustakaan</h2>
    <h2>SD Negeri Pangkung Tibah</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengunjung</th>
                <th>Instansi</th>
                <th>Tanggal Kunjungan</th>
                <th>Jam Masuk</th>
                <th>Keperluan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukuTamu as $tamu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tamu->nama_pengunjung }}</td>
                    <td>{{ $tamu->instansi }}</td>
                    <td>{{ $tamu->tanggal_kunjungan }}</td>
                    <td>{{ $tamu->jam_masuk }}</td>
                    <td>{{ $tamu->keperluan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
