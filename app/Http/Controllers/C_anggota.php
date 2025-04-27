<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class C_anggota extends Controller
{
    public function index()
    {
        $anggota = User::where('role', 'admin')->get();
        return view('admin.v_anggota', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // 'nis' => 'nullable',
            // 'kelas' => 'nullable',
            // 'kontak' => 'nullable',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.v_anggota')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $anggota = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$anggota->id,
            'nis' => 'nullable',
            'kelas' => 'nullable',
            'kontak' => 'nullable',
        ]);

        $anggota->update([
            'name' => $request->name,
            'email' => $request->email,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'kontak' => $request->kontak,
        ]);

        return redirect()->route('admin.v_anggota')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.v_anggota')->with('success', 'Anggota berhasil dihapus.');
    }
}
