@extends('layout.v_layout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-3">Laporan Transaksi Peminjaman & Pengembalian</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="laporanTable" class="table table-bordered table-striped">
                            <thead class="table-dark">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#laporanTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endsection
