<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Peminjaman & Pengembalian</title>
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

    <h2>Laporan Transaksi Peminjaman & Pengembalian</h2>
    <h2>SD Negeri Pangkung Tibah</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Status Peminjaman</th>
                <th>Status Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $pinjam)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pinjam->siswa->pluck('name')->implode(', ') }}</td>
                    <td>{{ $pinjam->buku->judul ?? '-' }}</td>
                    <td>{{ $pinjam->tanggal_pinjam }}</td>
                    <td>{{ $pinjam->tanggal_jatuh_tempo }}</td>
                    <td>{{ $pinjam->pengembalian->tanggal_kembali ?? '-' }}</td>
                    <td>{{ ucfirst($pinjam->status) }}</td>
                    <td>{{ $pinjam->pengembalian->status_pengembalian ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
