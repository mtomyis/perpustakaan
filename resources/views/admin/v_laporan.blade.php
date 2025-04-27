@extends('layout.v_layout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-3">Laporan Transaksi Peminjaman & Pengembalian</h4>
            </div>
            <div class="card-body">
                {{-- <div class="row mb-3">
                    <div class="col-md-3">
                        <select id="filterStatus" class="form-control">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div> --}}
                <div class="table-responsive">
                    <table id="laporanTable" class="table table-bordered">
                        <thead class="thead-dark">
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
                            @php $no = 1; @endphp
                            @foreach($peminjaman as $no => $pinjam)
                                <tr>
                                    <td>{{ $no++ }}</td>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#laporanTable').DataTable();

        $('#filterStatus').on('change', function () {
            var val = $(this).val();
            table.columns(7).search(val).draw(); // kolom status peminjaman
        });
    });
</script>
@endsection
