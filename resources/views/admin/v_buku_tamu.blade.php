@extends('layout.v_layout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-outline-dark" onclick="openForm()">Tambah Buku Tamu</button>
                </div>
                <div class="card-body">
                    <table id="bukuTamuTable" class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Pengunjung</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Keperluan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukuTamu as $index => $tamu)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tamu->nama_pengunjung }}</td>
                                <td>{{ $tamu->tanggal_kunjungan }}</td>
                                <td>{{ $tamu->keperluan }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick='editTamu(@json($tamu))'>Edit</button>
                                    <form method="POST" action="{{ route('buku-tamu.destroy', $tamu->id_tamu) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Modal Tambah/Edit --}}
            <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" id="formTamu">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <input type="hidden" name="id_tamu" id="id_tamu">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Form Buku Tamu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label>Nama Pengunjung</label>
                                    <input type="text" name="nama_pengunjung" id="nama_pengunjung" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Tanggal Kunjungan</label>
                                    <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" required>
                                </div>
                                <div class="mb-2">
                                    <label>Keperluan</label>
                                    <textarea name="keperluan" id="keperluan" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $('#bukuTamuTable').DataTable({});

    function openForm() {
        $('#formTamu')[0].reset();
        $('#formMethod').val('POST');
        $('#formTamu').attr('action', "{{ route('buku-tamu.store') }}");
        $('#modalForm').modal('show');
    }

    function editTamu(data) {
        $('#formMethod').val('PUT');
        $('#id_tamu').val(data.id_tamu);
        $('#nama_pengunjung').val(data.nama_pengunjung);
        $('#tanggal_kunjungan').val(data.tanggal_kunjungan);
        $('#keperluan').val(data.keperluan);
        $('#formTamu').attr('action', `/buku-tamu/${data.id_tamu}`);
        $('#modalForm').modal('show');
    }
</script>
@endsection
