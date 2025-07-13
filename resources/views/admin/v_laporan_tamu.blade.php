@extends('layout.v_layout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" />
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-3">Laporan Buku Tamu Perpustakaan</h4>

                    <div class="d-flex align-items-center">
                        <a href="{{ route('cetak.laporan.tamu') }}" class="btn btn-success" target="_blank">Print PDF</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="laporanTable" class="table table-bordered table-striped">
                            <thead class="table-dark">
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
