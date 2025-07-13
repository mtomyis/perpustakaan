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
                <button class="btn btn-outline-dark" onclick="openForm()">Tambah Denda</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dendaTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Buku</th>
                            <th>Tanggal Kembali</th>
                            {{-- <th>Total Denda</th> --}}
                            {{-- <th>Sisa Denda</th> --}}
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($denda as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->pengembalian->peminjaman->buku->judul ?? '-' }}</td>
                                <td>{{ $item->pengembalian->tanggal_kembali }}</td>
                                {{-- <td>Rp{{ number_format($item->total_denda, 2, ',', '.') }}</td> --}}
                                {{-- <td>Rp{{ number_format($item->sisa_denda, 2, ',', '.') }}</td> --}}
                                <td>{{ ucfirst($item->status_pembayaran) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick='editDenda(@json($item))'>Edit</button>
                                    <form action="{{ route('denda.destroy', $item->id_denda) }}" method="POST" style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
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
<div class="modal fade" id="modalForm" tabindex="-1">
    <div class="modal-dialog">
        <form id="formDenda" method="POST">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Denda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Pengembalian</label>
                        <select name="id_pengembalian" class="form-select" required>
                            <option value="">-- Pilih Pengembalian --</option>
                            @foreach ($pengembalian as $p)
                                <option value="{{ $p->id_pengembalian }}">
                                    {{ $p->peminjaman->buku->judul ?? '-' }} ({{ $p->tanggal_kembali }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label>Total Denda</label>
                        <input type="number" step="0.01" name="total_denda" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Sisa Denda</label>
                        <input type="number" step="0.01" name="sisa_denda" class="form-control" required>
                    </div> --}}
                    <div class="mb-3">
                        <label>Status Denda</label>
                        <select name="status_pembayaran" class="form-select" required>
                            <option value="lunas">Lunas (Ganti Baru)</option>
                            <option value="belum_lunas">Belum Lunas</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#dendaTable').DataTable();

    function openForm() {
        $('#formDenda')[0].reset();
        $('#formMethod').val('POST');
        $('#formDenda').attr('action', "{{ route('denda.store') }}");
        $('#modalForm').modal('show');
    }

    function editDenda(data) {
        $('#formMethod').val('PUT');
        $('#formDenda').attr('action', '/denda/' + data.id_denda);
        $('[name="id_pengembalian"]').val(data.id_pengembalian);
        // $('[name="total_denda"]').val(data.total_denda);
        // $('[name="sisa_denda"]').val(data.sisa_denda);
        $('[name="status_pembayaran"]').val(data.status_pembayaran);
        $('#modalForm').modal('show');
    }
</script>
@endsection
