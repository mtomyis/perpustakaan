@extends('layout.v_layout')
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<div class="container-fluid">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                @if(auth()->user()->role == 'admin')
                        <button class="btn btn-outline-dark" onclick="openForm()">Tambah Peminjaman</button>
                    @endif
                    @if(auth()->user()->role == 'siswa')
                        <h4 class="mb-3">Data Peminjaman</h4>
                    @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="peminjamanTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Nama Siswa</th>
                            @if(auth()->user()->role == 'admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->buku->judul }}</td>
                                <td>{{ $item->tanggal_pinjam }}</td>
                                <td>{{ $item->tanggal_jatuh_tempo }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $item->jenis_peminjaman)) }}</td>
                                <td>
                                    @if ($item->status == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="mb-0">
                                        @foreach ($item->siswa as $s)
                                            <li>{{ $s->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                @if(auth()->user()->role == 'admin')
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick='editPeminjaman(@json($item))'>Edit</button>
                                    <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah/Edit --}}
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="formPeminjaman">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id_peminjaman" id="id_peminjaman">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="divIdBuku" class="mb-2">
                        <label>Buku</label>
                        <select name="id_buku" id="id_buku" class="form-control">
                            <option value="">Pilih Buku</option>
                            @foreach ($buku as $bk)
                                <option value="{{ $bk->id_buku }}">{{ $bk->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Tanggal Jatuh Tempo</label>
                        <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Jenis Peminjaman</label>
                        <select name="jenis_peminjaman" id="jenis_peminjaman" class="form-control" required>
                            <option value="dibawa_pulang">Dibawa Pulang</option>
                            <option value="di_perpustakaan">Di Perpustakaan</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Nama Siswa</label>
                        <select name="siswa[]" id="siswa" class="form-control" multiple required>
                            @foreach ($siswa as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>
                        <small>Pilih lebih dari satu jika perlu</small>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $('#peminjamanTable').DataTable();

    function openForm() {
        $('#formPeminjaman')[0].reset();
        $('#formMethod').val('POST');
        $('#formPeminjaman').attr('action', "{{ route('peminjaman.store') }}");
        $('#siswa').val(null).trigger('change');
        $('#divIdBuku').show();
        $('#modalForm').modal('show');
    }

    function editPeminjaman(data) {
        $('#formMethod').val('PUT');
        $('#id_peminjaman').val(data.id_peminjaman);
        $('#id_buku').val(data.id_buku);
        $('#tanggal_pinjam').val(data.tanggal_pinjam);
        $('#tanggal_jatuh_tempo').val(data.tanggal_jatuh_tempo);
        $('#jenis_peminjaman').val(data.jenis_peminjaman);
        $('#siswa').val(data.siswa.map(s => s.id)).trigger('change');
        $('#formPeminjaman').attr('action', `/peminjaman/${data.id_peminjaman}`);
        $('#divIdBuku').hide();

        $('#modalForm').modal('show');
    }
</script>
@endsection
