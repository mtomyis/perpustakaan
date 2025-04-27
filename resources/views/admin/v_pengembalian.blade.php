@extends('layout.v_layout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container-fluid">
    <div class="col-12">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <button class="btn btn-outline-dark" onclick="openForm()">Tambah Pengembalian</button>
                <a href="/kirim" class="btn btn-outline-success">Reminder</a>
            </div>
            <div class="card-body">
                <table id="pengembalianTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Tanggal Kembali</th>
                            <th>Kondisi Buku</th>
                            <th>Status Pengembalian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalian as $i => $data)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $data->peminjaman->buku->judul }}</td>
                            <td>{{ $data->tanggal_kembali }}</td>
                            <td>{{ ucfirst($data->kondisi_buku) }}</td>
                            <td>{{ ucfirst($data->status_pengembalian) }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick='editPengembalian(@json($data))'>Edit</button>
                                <form action="{{ route('pengembalian.destroy', $data->id_pengembalian) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Form --}}
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="formPengembalian">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id_pengembalian" id="id_pengembalian">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Peminjaman</label>
                        <select name="id_peminjaman" id="id_peminjaman" class="form-select" required>
                            <option value="">Pilih</option>
                            @foreach ($peminjaman as $p)
                                <option value="{{ $p->id_peminjaman }}">{{ $p->buku->judul }} - {{ $p->tanggal_pinjam }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Kondisi Buku</label>
                        <select name="kondisi_buku" id="kondisi_buku" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="hilang">Hilang</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Status Pengembalian</label>
                        <select name="status_pengembalian" id="status_pengembalian" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="selesai">Selesai</option>
                            <option value="rusak">Rusak</option>
                            <option value="hilang">Hilang</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#pengembalianTable').DataTable();

    function openForm() {
        $('#formPengembalian')[0].reset();
        $('#formMethod').val('POST');
        $('#formPengembalian').attr('action', "{{ route('pengembalian.store') }}");
        $('#modalForm').modal('show');
    }

    function editPengembalian(data) {
        $('#formMethod').val('PUT');
        $('#id_pengembalian').val(data.id_pengembalian);
        $('#id_peminjaman').val(data.id_peminjaman);
        $('#tanggal_kembali').val(data.tanggal_kembali);
        $('#kondisi_buku').val(data.kondisi_buku);
        $('#status_pengembalian').val(data.status_pengembalian);
        $('#formPengembalian').attr('action', `/pengembalian/${data.id_pengembalian}`);
        $('#modalForm').modal('show');
    }
</script>
@endsection