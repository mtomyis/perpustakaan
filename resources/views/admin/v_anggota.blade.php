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
                <button class="btn btn-outline-dark" onclick="openForm()">Tambah Anggota</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" id="anggotaTable">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $i => $a)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $a->name }}</td>
                            <td>{{ $a->email }}</td>
                            <td>{{ $a->nis }}</td>
                            <td>{{ $a->kelas }}</td>
                            <td>{{ $a->kontak }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick='editAnggota(@json($a))'>Edit</button>
                                <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
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

<!-- Modal Tambah/Edit Anggota -->
<div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="formAnggota">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            <input type="hidden" name="id" id="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="siswa">Siswa</option>
                            <option value="admin">Admin</option>
                            <option value="kepsek">Kepala Sekolah</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-2 password-row">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                    </div>
                    <div class="mb-2">
                        <label>NIS</label>
                        <input type="text" name="nis" id="nis" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Kelas</label>
                        <input type="text" name="kelas" id="kelas" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Kontak</label>
                        <input type="text" name="kontak" id="kontak" class="form-control">
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
    $('#anggotaTable').DataTable();

    function openForm() {
        $('#formAnggota')[0].reset();
        $('#formMethod').val('POST');
        $('#formAnggota').attr('action', "{{ route('anggota.store') }}");
        $('.password-row').show();
        $('#modalForm').modal('show');
    }

    function editAnggota(data) {
        $('#formMethod').val('PUT');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#role').val(data.role);
        $('#email').val(data.email);
        $('#nis').val(data.nis);
        $('#kelas').val(data.kelas);
        $('#kontak').val(data.kontak);
        $('#password').val('');
        $('.password-row').hide(); // sembunyikan input password saat edit
        $('#formAnggota').attr('action', `/anggota/${data.id}`);
        $('#modalForm').modal('show');
    }
</script>
@endsection
